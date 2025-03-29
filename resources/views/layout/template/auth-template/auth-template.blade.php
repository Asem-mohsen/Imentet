<!DOCTYPE html>
<html lang="en">

    @include('layout.header.gem-head')

    <body>

        @include('layout.preloader.preloader')

        <div class="page-wrapper">
            
            @include('layout.navbar.auth-navbar')

            @yield('content')

        </div>

        @include('layout.side-menu.auth-menu')

        @include('layout.scripts.scripts')

    </body>

</html>