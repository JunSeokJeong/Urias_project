<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>시각장애인 정보 - @yield('title')</title>
    </head>
    @include('layouts.css')
    <body>
        <!-- nav -->
       @include('layouts.nav') 

        <!--container-->
        <div class="container">
            <!--jumbotron content-->
            <div class="jumbotron" style="background-color:white;">
                @yield('content')
            </div>
            <!--footer-->
            <footer class="footer">
                @include('layouts.foot')
            </footer>
        </div><!--container-->
    </body>
</html>