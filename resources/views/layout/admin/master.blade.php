<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layout.website.element.head')

    <body class="flex flex-col h-screen text-base md:text-lg text-slate-800">

        @include('layout.global.element.topbar')

        @include('layout.admin.element.menu')

        <main>
            @yield('content')
        </main>

        @include('layout.global.element.footer')

        @stack('scripts')

    </body>

</html>
