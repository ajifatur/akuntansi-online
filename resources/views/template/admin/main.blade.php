<!DOCTYPE html>
<html lang="en">
    <head>
        @include('template.admin._meta')
        @include('template.admin._head')
        @include('template.admin._css')
        @yield('css-extra')
        <title>@yield('title') | Akuntansi Online</title>
    </head>
    <body class="app sidebar-mini">
		@yield('content')
        @include('template.admin._js')
        @yield('js-extra')
    </body>
</html>