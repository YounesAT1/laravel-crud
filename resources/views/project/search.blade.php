@extends('layout.app')

@section('title', 'Search Results')

@section('content')
  <div class="container mx-auto p-4 flex flex-col">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-300 p-6 mb-6">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4 text-center">Tasks related to {{ $project->name }}</h2>

      @if ($searchResults->count() > 0)
        <table class="w-full border-collapse border border-gray-300 mb-4">
          <thead>
            <tr>
              <th class="p-3 border border-gray-300 text-left">ID</th>
              <th class="p-3 border border-gray-300 text-left">Duration</th>
              <th class="p-3 border border-gray-300 text-left">Price per Hour</th>
              <th class="p-3 border border-gray-300 text-left">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($searchResults as $task)
              <tr>
                <td class="p-3 border border-gray-300">{{ $task->idT }} </td>
                <td class="p-3 border border-gray-300">{{ $task->durationHours }} hours</td>
                <td class="p-3 border border-gray-300">{{ $task->priceHour }} $</td>
                <td class="p-3 border border-gray-300">
                  <span
                    class="px-4 py-2 rounded-md text-white
                        @if ($task->state == 'Done') bg-green-500 
                        @elseif($task->state == 'Not_started') bg-red-500 
                        @elseif($task->state == 'Ongoing') bg-yellow-500 
                        @else bg-white @endif;">
                    {{ $task->state }}
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <p class="text-lg text-gray-500">No tasks found.</p>
      @endif
    </div>
    <a class="text-white bg-indigo-500 px-4 py-2 rounded-md mt-auto w-[11rem]" href="{{ route('projects.index') }}">Back
      to
      projects list</a>

  </div>
@endsection
