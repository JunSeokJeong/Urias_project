<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>시각장애인 정보 - @yield('title')</title>
    </head>
    @include('layouts.css')
    <body>
       <!-- nav -->
       @include('layouts.nav')
       <!-- slider -->
       @include('layouts.slider')
       
       <!--container-->
       <div class="conteiner">
              <br><br>
               @yield('content')

              <!--footer-->
              <footer class="footer">
                     @include('layouts.foot')
              </footer>
        </div><!--container-->
    </body>
</html>