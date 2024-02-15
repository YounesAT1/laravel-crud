@extends('layout.app')

@section('title', 'Developer Details')

@section('content')
  <div class="container mx-auto p-4">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-200 p-6 mb-6 flex flex-col">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">{{ $developer->firstName }} Information</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="mb-4 md:mb-0">
          <img src="/{{ $developer->picture }}" alt="{{ $developer->firstName }}" class="w-[100px] h-[100px]">
        </div>
        <div class="md:col-span-2 mt-8">
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">ID : </span> {{ $developer->idD }}
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">First Name : </span>
            {{ $developer->firstName }}
          </p>
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Last Name : </span>
            {{ $developer->lastName }}
          </p>
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Resume : </span>
            <a href="/{{ $developer->cv }}" target="_blank" class="text-black font-semibold">
              Show
            </a>
          </p>

          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Addition date : </span>
            {{ $developer->created_at->format('Y-m-d H:i:s') }}</p>
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Last update : </span>
            {{ $developer->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
      </div>

      <a class="text-white bg-indigo-500 px-4 py-2 rounded-md self-end mt-auto"
        href="{{ route('developers.index') }}">Back
        to developers list</a>
    </div>
  </div>
@endsection
