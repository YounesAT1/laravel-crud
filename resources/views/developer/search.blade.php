@extends('layout.app')

@section('title', 'Search Results')

@section('content')
  <div class="container mx-auto p-4 flex flex-col">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-300 p-6 mb-6">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4 text-center">Search Results</h2>

      @if ($searchResults->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($searchResults as $developer)
            <div class="bg-gray-100 p-4 rounded-md">
              <img src="/{{ $developer->picture }}" alt="{{ $developer->name }}"
                class="w-10 h-10 object-cover mb-4 rounded-md">
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">ID:</span>
                {{ $developer->idD }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">First Name:</span>
                {{ $developer->firstName }}</p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Last Name:</span>
                {{ $developer->lastName }}</p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Addition date :</span>
                {{ $developer->created_at->format('Y-m-d H:i:s') }}</p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Date of last update :</span>
                {{ $developer->updated_at->format('Y-m-d H:i:s') }}</p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Resume :</span>
                <a href="/{{ $developer->cv }}" target="_blank" class="text-black font-semibold">
                  Show
                </a>
              </p>

            </div>
          @endforeach
        </div>
      @else
        <p class="text-lg text-gray-500">No developers found.</p>
      @endif
    </div>
    <a class="text-white bg-indigo-500 px-4 py-2 rounded-md mt-auto self-end" href="{{ route('developers.index') }}">Back
      to developers list</a>
  </div>
@endsection
