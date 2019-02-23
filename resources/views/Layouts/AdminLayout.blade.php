<!doctype>
<html lang="{{app()->getLocale()}}">
<head>
    @include('Includes.boostrap')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/adminnav.css') }}">
    <script src="{{ URL::asset('js/navbar.js') }}"></script>
    <style>
       #body{
           background-image: url("../Media/Images/1.jpg");
           background-positon:50% 50%;
           background-attachment:fixed;
           background-repeat:no-repeat;
           background-size:cover;
           opacity: 0.9;
       }
    </style>
    @yield('admin_css')
    @yield('admin_js')
    <title>@yield('title')</title>
</head>

<body id="body">
<div class="container-home">
    @include('Includes.admin_nav')
</div>
<br>

@yield('body')

</body>

</html>