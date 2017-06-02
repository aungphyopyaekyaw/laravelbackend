<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('backend.head')
@include('backend.header')
@include('backend.sidebar')
@yield('content')
@include('backend.footer')
@include('backend.sidebar2')

</html>
