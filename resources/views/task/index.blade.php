@extends('layout.app')

@section('title', 'Tasks')

@section('content')
  <div class="flex items-center justify-between mb-3">
    <h2 class="text-3xl font-bold mb-4 underline">Tasks : {{ count($tasks) }}</h2>
    @if (session('status'))
      <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-[450px]"
        role="alert">
        <span class="block sm:inline">{{ session('status') }}.</span>
        <button id="closeBtn" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
          <svg class="h-6 w-6 fill-current text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
              d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
          </svg>
        </button>
      </div>
      <script>
        document.getElementById('closeBtn').addEventListener('click', function() {
          document.getElementById('alert').style.display = 'none';
        });
      </script>
    @endif
    <a href="{{ route('tasks.create') }}" class="text-white bg-black py-3 px-5 font-semibold rounded-lg"> Add </a>
  </div>
  <form action="{{ route('tasks.search') }}" method="GET" autocomplete="off" class="mb-2">
    <input type="text" name="search" placeholder="Search by developer name"
      class="border p-2 px-3 rounded-md w-64 bg-gray-200 placeholder:text-gray-600 placeholder:font-semibold  focus:outline-none"
      @if ($tasks->count() === 0) disabled @endif>
    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">Search</button>
  </form>
  @error('search')
    <p class="text-red-500">{{ $message }}</p>
  @enderror
  <table class="min-w-full bg-white border border-gray-300 text-left">
    <thead>
      <tr class="border-b">
        <th class="py-2 px-4 ">ID</th>
        <th class="py-2 px-4 ">Project Name</th>
        <th class="py-2 px-4 ">Developer Name</th>
        <th class="py-2 px-4 ">Duration (H)</th>
        <th class="py-2 px-4 ">Price (H)</th>
        <th class="py-2 px-4 ">State</th>
        <th class="py-2 px-4  text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @if ($tasks->count() > 0)
        @foreach ($tasks as $task)
          <tr class="border-b">
            <td class="py-2 px-4 border-b">{{ $task->idT }}</td>
            <td class="py-2 px-4 border-b">{{ $task->project->name }}</td>
            <td class="py-2 px-4 border-b">{{ $task->developer->firstName }}</td>
            <td class="py-2 px-4 border-b">{{ $task->durationHours }}</td>
            <td class="py-2 px-4 border-b">{{ $task->priceHour }} $</td>
            <td class="py-2 px-4 border-b">{{ $task->state }}</td>


            <td class="py-2 px-2  flex items-center justify-center gap-x-1">
              <a href="{{ route('tasks.edit', $task) }}" class="text-white  bg-blue-500 p-2 rounded-lg">Update</a>
              <form action="{{ route('tasks.destroy', $task) }}" method="Post" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white bg-red-500 p-2 rounded-lg">Delete</button>
              </form>
              <a href="{{ route('tasks.details', $task) }}" class="text-white  bg-green-500 p-2 rounded-lg">Details</a>
            </td>
          </tr>
        @endforeach
      @else
        <tr class="border border-b">
          <td colspan="7" class="text-xl font-semibold text-center">No tasks</td>
        </tr>
      @endif
    </tbody>
  </table>
@endsection
