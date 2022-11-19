<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset("css/app.css")}}">
    <link rel="stylesheet" href="{{ asset("fonts/font.css")}}">
</head>
<body>
@section('content')
@show
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{asset("css/app.js")}}"></script>
@if(session()->has('title'))
{{-- test --}}
<script>swal({
    title: "{{ session()->get('title') }}",
    text: "{{ session()->get('text') }}",
    icon: "{{ session()->get('icon') }}"
});</script>
@endif
</html>
