@extends('layout.app')

@section('title', 'Update Developer')

@section('content')
  <div class="flex items-center justify-center flex-col">
    <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded-md border border-gray-300 w-3/6">
      <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold ">Update developer</h2>

        <img src="/{{ $developer->picture }}" alt="developer image" class="h-12 w-12 object-cover rounded-full ">
      </div>
      <div class="mb-4">
        <a href="/{{ $developer->cv }}" target="_blank" class="text-indigo-500 font-semibold">
          Resume
        </a>
      </div>

      <form action="{{ route('developers.update', $developer) }}" method="post" enctype="multipart/form-data"
        autocomplete="off">
        @csrf
        @method('put')
        <div class="mb-4">
          <input type="text" id="name" name="firstName" placeholder="First Name"
            value="{{ $developer->firstName }}"
            class="mt-1 p-2 px-3 w-full border rounded-md bg-gray-100 placeholder:text-gray-400 placeholder:font-semibold focus:outline-none @error('firstName') border-red-500 @enderror">
          @error('firstName')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <input type="text" id="name" name="lastName" placeholder="Last Name" value="{{ $developer->lastName }}"
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
          Update
        </button>
        <a href="{{ route('developers.index') }}"
          class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 w-full mt-2 block text-center">
          Cancel
        </a>


      </form>
    </div>
  </div>

@endsection
