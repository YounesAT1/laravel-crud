@extends('layout.app')

@section('title', 'Search Results')

@section('content')
  <div class="container mx-auto p-4">
    <div class="bg-white rounded-lg overflow-hidden border border-gray-300 p-6 mb-6">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4 text-center">{{ $firstName }}'s Projects</h2>

      @if (count($projects) > 0)
        <table class="w-full border-collapse border border-gray-300 mb-4">
          <thead>
            <tr>
              <th class="p-3 border border-gray-300">ID</th>
              <th class="p-3 border border-gray-300">Picture</th>
              <th class="p-3 border border-gray-300">Name</th>
              <th class="p-3 border border-gray-300">Description</th>
              <th class="p-3 border border-gray-300">Creation Date</th>
              <th class="p-3 border border-gray-300">Last Update Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
              <tr>
                <td class="p-3 border border-gray-300">{{ $project->idP }}</td>
                <td class="p-3 border border-gray-300">
                  <img src="/{{ $project->project_picture }}" alt="Developer Picture"
                    class="h-10 w-10 object-cover rounded-full">
                </td>
                <td class="p-3 border border-gray-300">{{ $project->name }}</td>
                <td class="p-3 border border-gray-300">{{ $project->description }}</td>

                <td class="p-3 border border-gray-300">{{ $project->created_at }}</td>
                <td class="p-3 border border-gray-300">{{ $project->updated_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <p class="text-lg text-gray-500">No projects found.</p>
      @endif
    </div>
    <a class="text-white bg-indigo-500 px-4 py-2 rounded-md mt-auto self-end" href="{{ route('developers.index') }}">Back
      to developers list</a>
  </div>
@endsection
