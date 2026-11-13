@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Cudal')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Barangay Bulletin</h1>

    <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-2 mb-6">
        <input name="q" value="{{ request('q') }}" placeholder="Search title"
               class="flex-1 border rounded px-3 py-2">

        <select name="category" class="border rounded px-3 py-2">
            <option value="">All categories</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>

        @if (request('tag'))
            <input type="hidden" name="tag" value="{{ request('tag') }}">
        @endif
        
        <button class="bg-emerald-700 text-white rounded px-4 py-2">Filter</button>
    </form>

    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
        @forelse ($posts as $post)
            <article class="bg-white rounded shadow p-4 flex flex-col gap-2">
                <div class="flex flex-wrap gap-2 text-xs">
                    @if ($post->is_pinned)
                        <span class="bg-yellow-200 text-yellow-900 rounded px-2 py-0.5 font-semibold">Pinned</span>
                    @endif
                    <span class="bg-emerald-100 text-emerald-800 rounded px-2 py-0.5">{{ $post->category }}</span>
                </div>

                <h2 class="font-semibold text-lg">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                </h2>

                <p class="text-sm text-gray-500">
                    By <a href="{{ route('authors.show', $post->author) }}" class="text-emerald-700 hover:underline">{{ $post->author->name }}</a>
                    · {{ $post->published_at->format('M j, Y') }}
                    · {{ $post->views }} views
                    · {{ $post->comments_count }} comments
                </p>

                <div class="flex flex-wrap gap-1">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
                           class="bg-gray-200 text-gray-700 rounded px-2 py-0.5 text-xs hover:bg-gray-300">#{{ $tag->name }}</a>
                    @endforeach
                </div>
            </article>
        @empty
            <p>No posts match your search.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

    @if ($posts->total() > 0)
        <p class="text-sm text-gray-500 mt-2">
            Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
        </p>
    @endif
@endsection