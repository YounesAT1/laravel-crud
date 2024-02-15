@extends('layout.app')

@section('title', 'Search Results')

@section('content')
  <div class="container mx-auto p-4 flex flex-col">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-300 p-6 mb-6">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4 text-center">Search Results</h2>

      @if ($searchResults->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($searchResults as $task)
            <div class="bg-gray-100 p-4 rounded-md">
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Task ID:</span>
                {{ $task->idT }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Project:</span>
                {{ $task->project->name }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Developer:</span>
                {{ $task->developer->firstName }} {{ $task->developer->lastName }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Duration:</span>
                {{ $task->durationHours }} hours
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">Price per Hour:</span>
                ${{ $task->priceHour }}
              </p>
              <p class="text-lg font-semibold text-black mb-2"><span class="text-indigo-500">State:</span>
                {{ $task->state }}
              </p>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-lg text-gray-500">No tasks found.</p>
      @endif
    </div>
    <a class="text-white bg-indigo-500 px-4 py-2 rounded-md mt-auto self-end" href="{{ route('tasks.index') }}">Back
      to tasks list</a>
  </div>
@endsection
