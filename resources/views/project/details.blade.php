@extends('layout.app')

@section('title', 'Project Details')

@section('content')
  <div class="container mx-auto p-4">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-200 p-6 mb-6 flex flex-col">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">Project Information</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="mb-4 md:mb-0">
          <img src="/{{ $project->picture }}" alt="{{ $project->name }}" class="w-auto h-[300px]">
        </div>
        <div class="md:col-span-2 mt-8">
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">ID : </span> {{ $project->idP }}
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Name : </span> {{ $project->name }}
          </p>
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Description : </span>
            {{ $project->description }}
          </p>
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Creation date : </span>
            {{ $project->created_at->format('Y-m-d H:i:s') }}</p>
          <p class="text-lg"><span class="font-semibold text-indigo-500 underline">Last update : </span>
            {{ $project->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
      </div>

      <a class="text-white bg-indigo-500 px-4 py-2 rounded-md self-end mt-auto" href="{{ route('projects.index') }}">Back
        to dashboard</a>
    </div>
  </div>
@endsection
