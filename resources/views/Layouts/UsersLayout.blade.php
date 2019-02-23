<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!--Bootstrap-->
@include('Includes.boostrap')

<!--CSS for home-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/footer.css') }}">
    @yield('usercss')

    @yield('user_js')

    <title>@yield('title')</title>

</head>

<body>
@yield('nav')

<!--home navigation-->
@include('Includes.usernav')

@yield('body')

@include('Includes.footer')
@yield('footer')
<!--Footer-->

</body>

</html>
