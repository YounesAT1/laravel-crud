<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
  </head>

  <body>

    <div class="container mx-auto">
      <nav class="bg-gray-100 p-4 mb-6 rounded-b-md">
        <div class="flex justify-between items-center">
          <a href="/" class="text-slate-900 text-xl font-bold">
            <img src="/Logo.png" alt="Logo" class="w-auto h-[50px]"></a>
          <div class="flex space-x-4">
            <a href="{{ route('projects.index') }}"
              class="text-slate-700 font-semibold {{ request()->is('projects*') ? 'text-violet-700  font-bold' : '' }}">Projects</a>
            <a href="{{ route('developers.index') }}"
              class="text-slate-700 font-semibold {{ request()->is('developers*') ? 'text-violet-700 font-bold' : '' }}">Developers</a>
            <a href="{{ route('tasks.index') }}"
              class="text-slate-700 font-semibold {{ request()->is('tasks*') ? 'text-violet-700 font-bold' : '' }}">Tasks</a>
          </div>
        </div>
      </nav>
      @yield('content')
    </div>
  </body>

</html>
