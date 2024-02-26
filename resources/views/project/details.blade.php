@extends('layout.app')

@section('title', 'Project Details')

@section('content')
  <div class="container mx-auto p-4">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-200 p-6 mb-6">
      <div class="flex items-center justify-between mx-auto mb-3">
        <h2 class="text-3xl font-bold text-indigo-700 mb-4">{{ $project->name }}'s information</h2>
        <img src="/{{ $project->picture }}" alt="Project Picture" class="h-12 w-12 object-cover rounded-full">
      </div>

      <table class="w-full border-collapse border border-gray-300 mb-4">
        @foreach ($projectDetails as $detail)
          <tr>
            <th class="p-3 border border-gray-300 text-left">ID</th>
            <td class="p-3 border border-gray-300">{{ $detail->idP }}</td>
          </tr>
          <tr>
            <th class="p-3 border border-gray-300 text-left">Name</th>
            <td class="p-3 border border-gray-300">{{ $detail->name }}</td>
          </tr>
          <tr>
            <th class="p-3 border border-gray-300 text-left">Description</th>
            <td class="p-3 border border-gray-300">{{ $detail->description }}</td>
          </tr>
          <tr>
            <th class="p-3 border border-gray-300 text-left">Developers</th>
            <td class="p-3 border border-gray-300">
              <table class="w-full border-collapse border border-gray-300">
                <thead>
                  <tr>
                    <th class="p-3 border border-gray-300"> ID</th>
                    <th class="p-3 border border-gray-300">First Name</th>
                    <th class="p-3 border border-gray-300">Last Name</th>
                    <th class="p-3 border border-gray-300">Picture</th>

                  </tr>
                </thead>
                <tbody>
                  @if ($detail->tasks->count() > 0)
                    @foreach ($detail->tasks as $task)
                      <tr>
                        <td class="p-3 border border-gray-300">{{ $task->developer->idD }}</td>
                        <td class="p-3 border border-gray-300">{{ $task->developer->firstName }}</td>
                        <td class="p-3 border border-gray-300">{{ $task->developer->lastName }}</td>
                        <td class="p-3  border-gray-300 flex items-center justify-center">
                          <img src="/{{ $task->developer->picture }}" alt="Developer Picture"
                            class="h-10 w-10 object-cover rounded-full">

                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td class="p-3 border border-gray-300 text-center" colspan="4">No Developers Available</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </td>
          </tr>
        @endforeach
      </table>

      <a class="text-white bg-indigo-500 px-4 py-2 rounded-md self-end mt-auto" href="{{ route('projects.index') }}">Back
        to Projects List</a>
    </div>
  </div>
@endsection
