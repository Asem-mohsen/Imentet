<!DOCTYPE html>
<html lang="en">

    @include('layout.header.gem-head')

    <body>

        @include('layout.preloader.preloader')

        <div class="page-wrapper">
            
            @include('layout.navbar.gem-navbar')

            @yield('content')

            @include('layout.footer.gem-footer')

        </div>

        @include('layout.side-menu.gem-menu')

        @include('layout.scripts.scripts')

    </body>

</html>