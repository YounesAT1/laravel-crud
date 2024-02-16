<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    @vite('resources/css/app.css')
    <title>@yield('title')</title>
  </head>

  <body>

    <div class="container mx-auto">
      <nav class="bg-gray-100 p-4 mb-6 rounded-b-md">
        <div class="flex justify-between items-center">
          <a href="/" class="text-slate-700 text-xl font-bold">Chi logo</a>
          <div class="flex space-x-4">
            <a href="{{ route('projects.index') }}"
              class="text-slate-700 font-semibold {{ request()->is('projects*') ? 'text-violet-700' : '' }}">Projects</a>
            <a href="{{ route('developers.index') }}"
              class="text-slate-700 font-semibold {{ request()->is('developers*') ? 'text-violet-700' : '' }}">Developers</a>
            <a href="{{ route('tasks.index') }}"
              class="text-slate-700 font-semibold {{ request()->is('tasks*') ? 'text-violet-700' : '' }}">Tasks</a>
          </div>
        </div>
      </nav>
      @yield('content')
    </div>
  </body>

</html>
