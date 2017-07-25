<style type="text/css">
#orange {
    background-color:#D55E00;
}
#green{
    background-color:#009E73;
}
#yellow{
    background-color:#E69F00;
}
#pink{
    background-color:#CC79A7;
}
.li_font{
    color:white;
}
.a_font{
    color:white;
}
.box{
    position:absolute;
    right:1%;
    top:8%;
}    

</style>


<!-- top menu -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('index') }}" title="유리아스 로고" role="button"><img src="/urias_logo_white.png" height="40" width="150"></img></a>
    </div>
    <div class="collapse navbar-collapse" style="color:white;" id="myNavbar">
      <ul class="nav navbar-nav">
          <li><a  href="{{ route('library') }}" style="color:white;" title="E-library" role="button">E-library</a></button></li>
          <li><a href="{{ route('blindIndex') }}" style="color:white;" title="Blind care" role="button">Blind care</a></li>
          <li><a href="{{ route('study') }}" style="color:white;" title="온라인 점자 학교" role="button">Online braille school</a></li>
          <li><a href="{{ route('boardList') }}" style="color:white;" title="도서관 소식" role="button">Library news</a></li>
          <li><a href="#" style="color:white;" role="button">Shop</a></li>
      </ul>
      
      
      <!-- 오른쪽 메뉴(로그인) -->
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
            <li><a href="#" role="button" style="color:white;"> {{Auth::user()->type}}사용자입니다</a></li>
            @if(Session::has('message'))
                @if(Session::get('message') > 0)
                    <li><a href="{{ route('mypage') }}" title="{{Session::get('message')}}개의 메세지가 도착했습니다" role="button" style="color:white;" >
                        <span class="glyphicon glyphicon-envelope"></span>
                        <span class="badge" style="background-color:red;">{{Session::get('message')}}</span>
                        <!--<a href="#" title="{{Session::get('message')}}개의 메세지가 도착했습니다"></a>-->
                        </a>
                    </li>
                @else
                <li><a href="{{ route('mypage') }}" srole="button" tyle="color:white;"><span class="glyphicon glyphicon-envelope"></span></a></li>
                @endif
            @endif
            
            <li><a href="{{ route('logout') }}" role="button" style="color:white;"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-in"> </span> Logout</a></li>
                
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            
            
                
        @else
            <li><a href="{{route('login') }} " style="color:white;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <li><a href="{{route('register') }}" style="color:white;"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>



<!--<div class="box">-->
    <!-- 메뉴바 색상 바꾸기 버튼 -->
<!--    <button id="orange" class="btn btn-default">orange</button>-->
<!--    <button id="green" class="btn btn-default">green</button>-->
<!--    <button id="yellow" class="btn btn-default">yellow</button>-->
<!--    <button id="pink" class="btn btn-default">pink</button>-->

</div>

