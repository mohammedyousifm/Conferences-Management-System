<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- title --}}
    <title>@yield('title' , 'LPU - National and International Conferences')</title>

    {{-- Style --}}
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css.css') }}">
</head>
<body>
      <ul>
        <a href="{{ route('author.dashboard') }}">author</a>
        <a href="{{ route('controller.dashboard') }}">controller</a>
        <a href="{{ route( 'reviewer.dashboard') }}">reviewer</a>
        <a href="{{ route('home') }}">home</a>
      </ul>

      @yield('content')

</body>
</html>



