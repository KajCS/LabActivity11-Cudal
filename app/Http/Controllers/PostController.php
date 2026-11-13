<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true);

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->input('q') . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($tagQuery) use ($request) {
                $tagQuery->where('name', $request->input('tag'));
            });
        }

        $posts = $query->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

        public function create(Request $request)
    {
        abort_unless($request->user()->author, 403);

        $categories = ['Announcement', 'Health', 'Peace & Order', 'Ayuda', 'Livelihood'];
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->safe()->except('tags');
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        $post = $request->user()->author->posts()->create($data);
        $post->tags()->sync($request->validated('tags'));

        if (! $post->is_published) {
            return redirect()->route('posts.index')->with('status', 'Draft saved.');
        }

        return redirect()->route('posts.show', $post->id)->with('status', 'Post published.');
    }

    public function show($id)
    {
        $post = Post::where('is_published', true)->findOrFail($id);

        $post->views = $post->views + 1;
        $post->save();

        $post->load([
            'author',
            'tags',
            'comments' => fn ($query) => $query->latest(),
            'comments.user',
        ]);

        return view('posts.show', compact('post'));
    }
}