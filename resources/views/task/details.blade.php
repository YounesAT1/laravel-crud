@extends('layout.app')

@section('title', 'Task Details')

@section('content')
  <div class="max-w-3xl mx-auto mt-8 bg-white rounded-md border border-gray-300 p-6">
    <h1 class="text-3xl font-semibold text-violet-600 mb-4">Task Details - ID {{ $task->idT }}</h1>

    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-4">Task :</h2>
      <table class="w-full border-collapse border border-gray-300 mb-4">
        <tr>
          <th class="p-3 border border-gray-300 text-left">Duration (H)</th>
          <td class="p-3 border border-gray-300">{{ $task->durationHours }}</td>
          <th class="p-3 border border-gray-300 text-left">Price</th>
          <td class="p-3 border border-gray-300 font-semibold text-slate-700">{{ number_format($task->priceHour, 2) }} $
          </td>
          <th class="p-3 border border-gray-300 text-left">Status</th>
          <td class="p-3 border border-gray-300">
            <span
              class="px-4 py-2 rounded-md  text-white
                @if ($task->state == 'Done') bg-green-500 
                @elseif($task->state == 'Not_started') bg-red-500 
                @elseif($task->state == 'Ongoing') bg-yellow-500 
                @else bg-white @endif;">
              {{ $task->state }}
            </span>
          </td>
        </tr>
      </table>
    </div>
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-4">Assigned to :</h2>
      <table class="w-full border-collapse border border-gray-300 mb-4">
        <tr>
          <th class="p-3 border border-gray-300 text-left">Name</th>
          <td class="p-3 border border-gray-300">
            {{ $task->developer->firstName }} {{ $task->developer->lastName }}
          </td>
          <th class="p-3 border border-gray-300 text-left">Developer ID</th>
          <td class="p-3 border border-gray-300">{{ $task->developer->idD }}</td>
        </tr>
      </table>
    </div>


    <div>
      <h2 class="text-xl font-semibold mb-4">For :</h2>
      <table class="w-full border-collapse border border-gray-300 mb-4">
        <tr>
          <th class="p-3 border border-gray-300 text-left">Project Name</th>
          <td class="p-3 border border-gray-300">{{ $task->project->name }}</td>
          <th class="p-3 border border-gray-300 text-left">Project ID</th>
          <td class="p-3 border border-gray-300">{{ $task->project->idP }}</td>
        </tr>
      </table>
    </div>

    <div class="mt-8">
      <a href="{{ route('tasks.index') }}"
        class="bg-violet-500 text-white px-4 py-2 rounded-md hover:bg-violet-600 focus:outline-none focus:border-violet-700 focus:ring focus:ring-gray-200">
        Back to Task List
      </a>
    </div>
  </div>
@endsection
