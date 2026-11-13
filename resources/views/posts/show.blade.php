@extends('layouts.app')

@section('title', $post->title . ' – Barangay Bulletin – Purok Cudal')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sm text-emerald-700 hover:underline">&larr; Back to all posts</a>

    <article class="bg-white rounded shadow p-6 mt-4">
        <div class="flex flex-wrap gap-2 text-xs mb-2">
            @if ($post->is_pinned)
                <span class="bg-yellow-200 text-yellow-900 rounded px-2 py-0.5 font-semibold">Pinned</span>
            @endif
            <span class="bg-emerald-100 text-emerald-800 rounded px-2 py-0.5">{{ $post->category }}</span>
        </div>

        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>

        <p class="text-sm text-gray-500 mt-1">
            {{ $post->published_at->format('M j, Y g:i A') }} · {{ $post->views }} views · Author #{{ $post->author_id }}
        </p>

        <div class="mt-4 whitespace-pre-line leading-relaxed">{{ $post->body }}</div>
    </article>
@endsection