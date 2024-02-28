@extends('layout.app')

@section('title', 'Developer Details')

@section('content')
  <div class="container mx-auto p-4">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-200 p-6 mb-6">

      <div class="flex items-center justify-between mb-3">
        <h2 class="text-3xl font-bold text-indigo-700 mb-4">{{ $dev->firstName }}'s Information</h2>
        <img src="/{{ $dev->picture }}" alt="Developer Picture" class="h-10 w-10 object-cover rounded-full">
      </div>

      <table class="w-full border-collapse border border-gray-300 mb-4">
        <tr>
          <th class="p-3 border border-gray-300 text-left">ID</th>
          <td class="p-3 border border-gray-300">{{ $dev->idD }}</td>
        </tr>
        <tr>
          <th class="p-3 border border-gray-300 text-left">First Name</th>
          <td class="p-3 border border-gray-300">{{ $dev->firstName }}</td>
        </tr>
        <tr>
          <th class="p-3 border border-gray-300 text-left">Last Name</th>
          <td class="p-3 border border-gray-300">{{ $dev->lastName }}</td>
        </tr>
        <tr>
          <th class="p-3 border border-gray-300 text-left">Resume</th>
          <td class="p-3 border border-gray-300">
            <a href="/{{ $dev->cv }}" target="_blank" class="text-indigo-500 font-semibold">
              Show
            </a>
          </td>
        </tr>
        <tr>
          <th class="p-3 border border-gray-300 text-left">Addition Date</th>
          <td class="p-3 border border-gray-300">{{ $dev->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
          <th class="p-3 border border-gray-300 text-left">Last Update</th>
          <td class="p-3 border border-gray-300">{{ $dev->updated_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
          <th class="p-3 border border-gray-300 text-left">Tasks</th>
          <td class="p-3 border border-gray-300">
            <table class="w-full border-collapse border border-gray-300">
              <tr>
                <th class="p-3 border border-gray-300 text-left"> ID</th>
                <th class="p-3 border border-gray-300 text-left">Duration(H)</th>
                <th class="p-3 border border-gray-300 text-left">Price(H)</th>
                <th class="p-3 border border-gray-300 text-left">Status</th>

              </tr>
              @if ($dev->tasks->count() > 0)
                @foreach ($dev->tasks as $task)
                  <tr>
                    <td class="p-3 border border-gray-300">{{ $task->idT }}</td>
                    <td class="p-3 border border-gray-300">{{ $task->durationHours }}</td>
                    <td class="p-3 border border-gray-300 text-slate-700 font-semibold">
                      {{ number_format($task->priceHour, 2) }} $</td>
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
                @endforeach
              @else
                <tr>
                  <td class="p-3 border border-gray-300 font-semibold text-slate-950 text-center" colspan="4">No Tasks
                    Available !!</td>
                </tr>
              @endif
            </table>
          </td>
        </tr>

      </table>

      <a class="text-white bg-indigo-500 px-4 py-2 rounded-md self-end mt-auto"
        href="{{ route('developers.index') }}">Back
        to Developers List</a>
    </div>
  </div>
@endsection
