@extends('layout.app')

@section('title', 'Update project')

@section('content')
  <div class="flex items-center justify-center flex-col">
    <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded-md border border-gray-300 w-3/6">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold ">Update Project</h2>
        <img src="/{{ $project->picture }}" alt="project image" class="h-12 w-12 object-cover rounded-full ">
      </div>

      <form action="{{ route('projects.update', $project) }}" method="post" enctype="multipart/form-data"
        autocomplete="off">
        @csrf
        @method('put')
        <div class="mb-4">
          <input type="text" id="name" name="name" placeholder="Project name" value="{{ $project->name }}"
            class="mt-1 p-2 px-3 w-full border rounded-md bg-gray-100 placeholder:text-gray-400 placeholder:font-semibold focus:outline-none @error('name') border-red-500 @enderror">
          @error('name')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <textarea id="description" name="description" rows="4" placeholder="Project description"
            class="mt-1 p-2 px-3 w-full border rounded-md bg-gray-100 placeholder:text-gray-400 placeholder:font-semibold focus:outline-none @error('description') border-red-500 @enderror">{{ $project->description }}</textarea>
          @error('description')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">

          <input type="file" id="image" name="picture"
            class="mt-1 p-2 w-full border rounded-md bg-gray-100 @error('picture') border-red-500 @enderror">

          @error('picture')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
          @if (session('status'))
            <p class="text-red-500 text-l font-semibold">{{ session('status') }}</p>
          @endif
        </div>

        <button type="submit"
          class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 w-full">
          Update
        </button>
        <a href="{{ route('projects.index') }}"
          class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 w-full mt-2 block text-center">
          Cancel
        </a>


      </form>
    </div>
  </div>

@endsection
