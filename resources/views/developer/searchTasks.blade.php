@extends('layout.app')

@section('title', 'Search Results')

@section('content')
  <div class="max-w-3xl mx-auto mt-8 bg-white rounded-md border border-gray-300 p-6">
    <h1 class="text-3xl font-semibold text-violet-500 mb-4 text-center">{{ $firstName }}'s Tasks</h1>

    <div class="mb-8">
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
          @if (count($tasks) > 0)
            @foreach ($tasks as $task)
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
          @else
            <tr>
              <td class="p-3 border border-gray-300 text-center font-semibold" colspan="4">
                No tasks for {{ $firstName }}
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    <a class="text-white bg-indigo-500 px-4 py-2 rounded-md self-end mt-auto" href="{{ route('developers.index') }}">Back
      to Developers List</a>
  </div>
@endsection
