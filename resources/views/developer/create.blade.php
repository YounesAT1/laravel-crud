@extends('layout.app')

@section('title', 'Add Developer')

@section('content')
  <div class="flex items-center justify-center flex-col">
    <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded-md border border-gray-300 w-3/6">
      <h2 class="text-2xl font-semibold mb-4">Add a New Developer</h2>

      <form action="{{ route('developers.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="mb-4">
          <input type="text" id="firstName" name="firstName" placeholder="First Name" value=""
            class="mt-1 p-2 px-3 w-full border rounded-md bg-gray-100 placeholder:text-gray-400 placeholder:font-semibold focus:outline-none @error('firstName') border-red-500 @enderror">
          @error('firstName')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <input type="text" id="lastName" name="lastName" placeholder="Last Name" value=""
            class="mt-1 p-2 px-3 w-full border rounded-md bg-gray-100 placeholder:text-gray-400 placeholder:font-semibold focus:outline-none @error('lastName') border-red-500 @enderror">
          @error('lastName')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="image" class="text-slate-700 font-semibold">Picture :</label>
          <input type="file" id="image" name="picture"
            class="mt-1 p-2 w-full border rounded-md bg-gray-100 @error('picture') border-red-500 @enderror">
          @error('picture')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label for="cv" class="text-slate-700 font-semibold">CV :</label>

          <input type="file" id="cv" name="cv"
            class="mt-1 p-2 w-full border rounded-md bg-gray-100 @error('cv') border-red-500 @enderror">
          @error('cv')
            <p class="text-red-500">{{ $message }}</p>
          @enderror

        </div>

        <button type="submit"
          class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 w-full">
          Add
        </button>
        <a href="{{ route('developers.index') }}"
          class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 w-full mt-2 block text-center">
          Cancel
        </a>


      </form>
    </div>
  </div>

@endsection
