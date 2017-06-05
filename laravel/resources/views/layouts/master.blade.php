<html>
    <head>
        <title>시각장애인 정보 - @yield('title')</title>
      
    
    </head>
    
    @include('layouts.css')
    <body>
       
        <!--container-->
        <div class="container">
            
            <!--masthead 네비게이션바-->
            <div class="masthead">
                @include('layouts.nav')    
            </div>
            <!--jumbotron content-->
            <div class="jumbotron">
                @yield('content')
            </div>
            <!--footer-->
            <footer class="footer">
                @include('layouts.foot')
            </footer>
        </div><!--container-->
    </body>
</html>