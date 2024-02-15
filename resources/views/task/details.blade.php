@extends('layout.app')

@section('title', 'Task Details')

@section('content')
  <div class="flex items-center justify-center flex-col">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md border-black/20 border border-gray-300 w-3/6">
      <h2 class="text-3xl font-semibold mb-6 text-blue-600">Task Details</h2>

      <div class="mb-4">
        <strong class="text-gray-600">Task ID:</strong> {{ $task->idT }}
      </div>

      <div class="mb-4">
        <strong class="text-gray-600">Project:</strong> {{ $task->project->name }}
      </div>

      <div class="mb-4">
        <strong class="text-gray-600">Developer:</strong> {{ $task->developer->firstName }}
        {{ $task->developer->lastName }}
      </div>

      <div class="mb-4">
        <strong class="text-gray-600">Duration:</strong> {{ $task->durationHours }} hours
      </div>

      <div class="mb-4">
        <strong class="text-gray-600">Price per Hour:</strong> {{ $task->priceHour }} $
      </div>

      <div class="mb-4">
        <strong class="text-gray-600">State:</strong> {{ $task->state }}
      </div>

      <div class="flex space-x-4">

        <a href="{{ route('tasks.index') }}"
          class="bg-violet-500 text-white px-4 py-2 rounded-md hover:bg-violet-600 focus:outline-none focus:border-violet-700 focus:ring focus:ring-gray-200">
          Back to Task List
        </a>
      </div>
    </div>
  </div>
@endsection
