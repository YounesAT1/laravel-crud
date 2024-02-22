@extends('layout.app')

@section('title', 'Add Task')

@section('content')
  <div class="flex items-center justify-center flex-col">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md border border-gray-300 w-3/6">
      <h2 class="text-2xl font-semibold mb-4">Add a New Task</h2>

      <form action="{{ route('tasks.store') }}" method="post" autocomplete="off">
        @csrf

        <div class="mb-4">
          <select id="project_id" name="idP"
            class="mt-1 p-2 w-full border rounded-md bg-gray-100 @error('idP') border-red-500 @enderror">
            <option value="" disabled selected>Choose a project name</option>
            @foreach ($projects as $project)
              <option value="{{ $project->idP }}">{{ $project->name }}</option>
            @endforeach
          </select>
          @error('idP')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <select id="developer_id" name="idD"
            class="mt-1 p-2 w-full border rounded-md bg-gray-100 @error('idD') border-red-500 @enderror">
            <option value="" disabled selected>Choose a developer name</option>
            @foreach ($developers as $developer)
              <option value="{{ $developer->idD }}">{{ $developer->firstName }}</option>
            @endforeach
          </select>
          @error('idD')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <input type="text" id="duration_hours" name="durationHours" placeholder="Duration in Hours"
            class="mt-1 p-2 px-3 w-full border rounded-md bg-gray-100 placeholder:text-gray-400 placeholder:font-semibold focus:outline-none @error('durationHours') border-red-500 @enderror">
          @error('durationHours')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <input type="text" id="price_hour" name="priceHour" placeholder="Price per Hour"
            class="mt-1 p-2 px-3 w-full border rounded-md bg-gray-100 placeholder:text-gray-400 placeholder:font-semibold focus:outline-none @error('priceHour') border-red-500 @enderror">
          @error('priceHour')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <select id="state" name="state"
            class="mt-1 p-2 w-full border rounded-md bg-gray-100 @error('state') border-red-500 @enderror">
            <option value="" disabled selected>Choose a state</option>
            <option value="Ongoing">Ongoing</option>
            <option value="Done">Done</option>
            <option value="Not_started">Not Started Yet</option>
          </select>
          @error('state')
            <p class="text-red-500">{{ $message }}</p>
          @enderror
        </div>



        <button type="submit"
          class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 w-full">
          Add Task
        </button>
        <a href="{{ route('tasks.index') }}"
          class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 w-full mt-2 block text-center">
          Cancel
        </a>

      </form>
    </div>
  </div>

@endsection
