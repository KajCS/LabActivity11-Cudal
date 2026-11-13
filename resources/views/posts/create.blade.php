@extends('layouts.app')

@section('title', 'New post – Barangay Bulletin – Purok Cudal')

@section('content')
    <h1 class="text-2xl font-bold mb-4">New post</h1>

    <form method="POST" action="{{ route('posts.store') }}" class="bg-white rounded shadow p-6 flex flex-col gap-4 max-w-2xl">
        @csrf

        @if ($errors->any())
            <ul class="bg-red-100 text-red-700 rounded px-4 py-2 text-sm list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div>
            <label for="title" class="font-semibold block mb-1">Title</label>
            <input id="title" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2">
            @error('title')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category" class="font-semibold block mb-1">Category</label>
            <select id="category" name="category" class="w-full border rounded px-3 py-2">
                <option value="">Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            @error('category')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="body" class="font-semibold block mb-1">Body</label>
            <textarea id="body" name="body" rows="6" class="w-full border rounded px-3 py-2">{{ old('body') }}</textarea>
            @error('body')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <p class="font-semibold mb-1">Tags</p>
            <div class="flex flex-wrap gap-4">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-1">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               @checked(in_array($tag->id, old('tags', [])))>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            @error('tags')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
            @error('tags.*')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))>
            Publish now (leave unchecked to save as a draft)
        </label>
        @error('is_published')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <button class="self-start bg-emerald-700 text-white rounded px-4 py-2">Save post</button>
    </form>
@endsection