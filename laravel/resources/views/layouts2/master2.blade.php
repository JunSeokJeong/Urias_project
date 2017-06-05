<html>
    <head>
        <title>시각장애인 정보 - @yield('title')</title>
    </head>
     @include('layouts2.css')
    <body>
       
        <!--container-->
        <div class="container">
            
            <!--masthead 네비게이션바-->
            <div class="masthead">
                @include('layouts2.nav')    
            </div>
            <!--jumbotron content-->
            <div class="jumbotron">
                @yield('content')
                @include('layouts2.sidebar')
            </div>
            <!--footer-->
            <footer class="footer">
                @include('layouts2.foot')
            </footer>
            
        </div><!--container-->
    </body>
</html>