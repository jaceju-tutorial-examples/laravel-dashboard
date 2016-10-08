<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Dashboard</title>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,900' rel='stylesheet'
          type='text/css'>
    <link href="{{ elixir("css/app.css") }}" rel="stylesheet"/>
    <meta name="google" value="notranslate">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div id="app" class="dashboard">
@yield('content')
</div>

<script src="{{ elixir("js/app.js") }}"></script>
</body>
</html>
