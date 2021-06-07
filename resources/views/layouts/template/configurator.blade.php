<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.template.page.head')
<body>
@yield('content')

@include('layouts.template.page.scripts')
@stack('scripts')
</body>
</html>
