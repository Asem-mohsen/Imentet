<!DOCTYPE html>
<html lang="en">

    @include('layout.header.pyramids-head')

    <body>

        @include('layout.preloader.preloader')

        <div class="page-wrapper">

            @include('layout.navbar.pyramids-navbar')

            @yield('content')

            @include('layout.footer.pyramids-footer')

        </div>

        @include('layout.side-menu.pyramids-menu')

        @include('layout.scripts.scripts')

    </body>

</html>