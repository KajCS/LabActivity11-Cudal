@extends('layouts.app')

@section('title', $author->name . ' – Barangay Bulletin – Purok Cudal')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sm text-emerald-700 hover:underline">&larr; Back to all posts</a>

    <div class="bg-white rounded shadow p-6 mt-4 mb-6">
        <h1 class="text-2xl font-bold">{{ $author->name }}</h1>
        <p class="text-gray-600">{{ $author->position }}</p>
        <p class="mt-2 text-sm">
            <strong>{{ $posts->count() }}</strong> published posts
            · <strong>{{ $commentsReceived }}</strong> comments received
        </p>
    </div>

    <h2 class="text-xl font-bold mb-4">Posts by {{ $author->name }}</h2>

    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
        @forelse ($posts as $post)
            <article class="bg-white rounded shadow p-4 flex flex-col gap-2">
                <div class="flex flex-wrap gap-2 text-xs">
                    @if ($post->is_pinned)
                        <span class="bg-yellow-200 text-yellow-900 rounded px-2 py-0.5 font-semibold">Pinned</span>
                    @endif
                    <span class="bg-emerald-100 text-emerald-800 rounded px-2 py-0.5">{{ $post->category }}</span>
                </div>

                <h3 class="font-semibold text-lg">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                </h3>

                <p class="text-sm text-gray-500">
                    {{ $post->published_at->format('M j, Y') }}
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
            <p>This author has no published posts yet.</p>
        @endforelse
    </div>
@endsection