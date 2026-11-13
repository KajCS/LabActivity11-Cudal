@extends('layouts.app')

@section('title', $post->title . ' – Barangay Bulletin – Purok Cudal')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sm text-emerald-700 hover:underline">&larr; Back to all posts</a>

    @if (session('status'))
        <p class="bg-emerald-100 text-emerald-800 rounded px-4 py-2 mt-4">{{ session('status') }}</p>
    @endif

    <article class="bg-white rounded shadow p-6 mt-4">
        <div class="flex flex-wrap gap-2 text-xs mb-2">
            @if ($post->is_pinned)
                <span class="bg-yellow-200 text-yellow-900 rounded px-2 py-0.5 font-semibold">Pinned</span>
            @endif
            <span class="bg-emerald-100 text-emerald-800 rounded px-2 py-0.5">{{ $post->category }}</span>
        </div>

        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>

        <p class="text-sm text-gray-500 mt-1">
            By <a href="{{ route('authors.show', $post->author) }}" class="text-emerald-700 hover:underline">{{ $post->author->name }}</a>
            · {{ $post->published_at->format('M j, Y g:i A') }}
            · {{ $post->views }} views
        </p>

        <div class="flex flex-wrap gap-1 mt-2">
            @foreach ($post->tags as $tag)
                <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
                   class="bg-gray-200 text-gray-700 rounded px-2 py-0.5 text-xs hover:bg-gray-300">#{{ $tag->name }}</a>
            @endforeach
        </div>

        <div class="mt-4 whitespace-pre-line leading-relaxed">{{ $post->body }}</div>
    </article>

    <section class="mt-8">
        <h2 class="text-xl font-bold mb-4">Comments ({{ $post->comments->count() }})</h2>

        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}"
                  class="bg-white rounded shadow p-4 mb-6 flex flex-col gap-2">
                @csrf

                @if ($errors->any())
                    <ul class="bg-red-100 text-red-700 rounded px-4 py-2 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <label for="body" class="font-semibold">Add a comment</label>
                <textarea id="body" name="body" rows="3" class="border rounded px-3 py-2">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror

                <button class="self-start bg-emerald-700 text-white rounded px-4 py-2">Post comment</button>
            </form>
        @endauth

        @guest
            <p class="mb-6">
                <a href="{{ route('login') }}" class="text-emerald-700 hover:underline">Sign in to comment</a>
            </p>
        @endguest

        @forelse ($post->comments as $comment)
            <div class="bg-white rounded shadow p-4 mb-3">
                <p class="text-sm text-gray-500">
                    <strong class="text-gray-800">{{ $comment->user->name }}</strong>
                    · {{ $comment->created_at->diffForHumans() }}
                </p>
                <p class="mt-1">{{ $comment->body }}</p>
            </div>
        @empty
            <p class="text-gray-500">No comments yet.</p>
        @endforelse
    </section>
@endsection