@extends('layout.app')

@section('title', 'Developers')

@section('content')
  <div class="flex items-center justify-between mb-3">
    <h2 class="text-3xl font-bold mb-4 text-violet-500">Developers : {{ count($developers) }}</h2>
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
    <a href="{{ route('developers.create') }}" class="text-white bg-black py-3 px-5 font-semibold rounded-lg"> Add </a>
  </div>

  <div class="flex items-center justify-between mb-3">
    {{-- FORM FOR TASK LIST --}}
    <div>
      <form action="{{ route('developers.searchTasks') }}" method="GET" autocomplete="off" class="mb-2">
        <select name="searchTasks"
          class="border p-2 px-3 rounded-md w-[15rem] bg-gray-200 focus:outline-none  @error('searchTasks') bg-red-500 text-white border-red-500" @enderror">
          <option value="" disabled selected>Select a developer</option>
          @foreach ($developers as $developer)
            <option value="{{ $developer->firstName }}" class="bg-gray-50 text-black font-semibold">
              {{ $developer->firstName }} {{ $developer->lastName }}</option>
          @endforeach
        </select>
        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">Show Tasks</button>
      </form>
      @error('searchTasks')
        <p class="text-red-500">{{ $message }}</p>
      @enderror
    </div>

    {{-- FORM FOR PROJECT LIST --}}
    <div>
      <form action="{{ route('developers.searchProjects') }}" method="GET" autocomplete="off" class="mb-2">
        <select name="searchProjects"
          class="border p-2 px-3 rounded-md w-[15rem] bg-gray-200 focus:outline-none  @error('searchProjects') bg-red-500 text-white border-red-500" @enderror">
          <option value="" disabled selected>Select a developer</option>
          @foreach ($developers as $developer)
            <option value="{{ $developer->firstName }}" class="bg-gray-50 text-black font-semibold">
              {{ $developer->firstName }} {{ $developer->lastName }}
            </option>
          @endforeach
        </select>
        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">Show Projects</button>
      </form>
      @error('searchProjects')
        <p class="text-red-500">{{ $message }}</p>
      @enderror
    </div>

  </div>




  <table class="min-w-full bg-white border border-gray-300 text-left">
    <thead>
      <tr class="border-b">
        <th class="py-2 px-4 ">ID</th>
        <th class="py-2 px-4 ">First Name</th>
        <th class="py-2 px-4 ">Last Name</th>
        <th class="py-2 px-4 ">Picture</th>
        <th class="py-2 px-4 ">Resume</th>
        <th class="py-2 px-4 ">Total Revenue</th>
        <th class="py-2 px-4  text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @if ($developers->count() > 0)
        @foreach ($developers as $developer)
          <tr class="border-b">
            <td class="py-2 px-4 border-b">{{ $developer->idD }}</td>
            <td class="py-2 px-4 border-b">{{ $developer->firstName }}</td>
            <td class="py-2 px-4 border-b">{{ $developer->lastName }}</td>
            <td class="py-2 px-4 border-b">
              <img src="/{{ $developer->picture }}" alt="Developer Picture" class="h-10 w-10 object-cover rounded-full">
            </td>
            <td class="py-2 px-4 border-b">
              <a href="/{{ $developer->cv }}" target="_blank" class="text-indigo-500 font-semibold">
                Show Resume
              </a>
            </td>
            <td class="py-2 px-4 border-b font-semibold text-slate-700">{{ number_format($developer->totalRevenue, 2) }}
              $</td>


            <td class="py-2 px-2  flex items-center justify-center gap-x-1">
              <a href="{{ route('developers.edit', $developer) }}"
                class="text-white  bg-blue-500 p-2 rounded-lg">Update</a>
              <form action="{{ route('developers.destroy', $developer) }}" method="Post" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white bg-red-500 p-2 rounded-lg">Delete</button>
              </form>
              <a href="{{ route('developers.details', $developer) }}"
                class="text-white  bg-green-500 p-2 rounded-lg">Details</a>
            </td>
          </tr>
        @endforeach
      @else
        <tr class="border border-b">
          <td colspan="7" class="text-xl font-semibold text-center">No Developers</td>
        </tr>
      @endif
    </tbody>
  </table>
@endsection
