  @extends('layout.app')

  @section('title', 'Projects')

  @section('content')
    <div class="flex items-center justify-between mb-3">
      <h2 class="text-3xl font-bold mb-4 text-violet-500">Projects : {{ count($projects) }} </h2>
      @if (session('status'))
        <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-[400px]"
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
      <a href="{{ route('projects.create') }}" class="text-white bg-black py-3 px-5 font-semibold rounded-lg"> Add </a>
    </div>
    <form action="{{ route('projects.searchTasks') }}" method="GET" autocomplete="off" class="mb-2">
      <select name="searchTasks"
        class="border p-2 px-3 rounded-md w-[15rem] bg-gray-200 focus:outline-none @error('searchTasks') border-red-500 bg-red-500 text-white @enderror">
        <option value="" disabled selected>Select a project</option>
        @foreach ($projects as $project)
          <option value="{{ $project->idP }}" class="bg-gray-50 text-black font-semibold">
            {{ $project->name }}
          </option>
        @endforeach
      </select>
      <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">Show tasks</button>
    </form>


    @error('searchTasks')
      <p class="text-red-500">{{ $message }}</p>
    @enderror
    <table class="min-w-full bg-white border border-gray-300 text-left">
      <thead>
        <tr class="border-b">
          <th class="py-2 px-4 ">ID</th>
          <th class="py-2 px-4 ">Name</th>
          <th class="py-2 px-4 ">Description</th>
          <th class="py-2 px-4 ">Total Cost</th>
          <th class="py-2 px-4 ">Average Cost</th>
          <th class="py-2 px-4 ">Picture</th>
          <th class="py-2 px-4  text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @if ($projects->count() > 0)
          @foreach ($projects as $project)
            <tr class="border-b">
              <td class="py-2 px-4 border-b">{{ $project->idP }}</td>
              <td class="py-2 px-4 border-b">{{ $project->name }}</td>
              <td class="py-2 px-4 border-b">{{ $project->description }}</td>
              <td class="py-2 px-4 border-b font-semibold text-slate-700">
                @if ($project->totalCost === 0 || $project->totalCost === null)
                  No tasks
                @else
                  {{ number_format($project->totalCost, 2) }} $
                @endif
              </td>
              <td class="py-2 px-4 border-b font-semibold text-slate-700">
                @if ($project->averageCost === 0 || $project->averageCost === null)
                  No tasks
                @else
                  {{ number_format($project->averageCost, 2) }} $
                @endif
              </td>
              <td class="py-2 px-4 border-b">
                <img src="/{{ $project->picture }}" alt="Project Picture" class="h-10 w-10 object-cover rounded-full">
              </td>
              <td class="py-2 px-2  flex items-center justify-center gap-x-1">
                <a href="{{ route('projects.edit', $project) }}" class="text-white  bg-blue-500 p-2 rounded-lg">
                  Update
                </a>
                <form action="{{ route('projects.destroy', $project) }}" method="Post" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-white bg-red-500 p-2 rounded-lg">
                    Delete
                  </button>
                </form>
                <a href="{{ route('projects.details', $project) }}"
                  class="text-white  bg-green-500 p-2 rounded-lg">Details</a>
              </td>
            </tr>
          @endforeach
        @else
          <tr class="border border-b">
            <td colspan="7" class="text-xl font-semibold text-center">No projects</td>
          </tr>
        @endif
      </tbody>
    </table>
  @endsection
