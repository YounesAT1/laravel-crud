@extends('layout.app')

@section('title', 'Search Results')

@section('content')
  <div class="container mx-auto p-4 flex flex-col">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-300 p-6 mb-6">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4 text-center">Search Results {{ $firstName }}</h2>

      @if (count($projects) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($projects as $project)
            <div class="bg-gray-100 p-4 rounded-md">
              <div class="mb-4 md:mb-0">
                <img src="/{{ $project->project_picture }}" alt="{{ $project->name }}" class="w-auto h-20">
              </div>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">ID Project :</span>
                {{ $project->idP }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Project Name :</span>
                {{ $project->name }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Project Description :</span>
                {{ $project->description }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Project Created Date :</span>
                {{ $project->created_at }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Project Last Update Date
                  :</span>
                {{ $project->updated_at }}
              </p>

            </div>
          @endforeach
        </div>
      @else
        <p class="text-lg text-gray-500">No projects found.</p>
      @endif
    </div>
    <a class="text-white bg-indigo-500 px-4 py-2 rounded-md mt-auto self-end" href="{{ route('developers.index') }}">Back
      to developers list</a>
  </div>
@endsection
