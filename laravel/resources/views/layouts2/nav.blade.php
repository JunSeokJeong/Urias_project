 <div class="logo">
    <font><font>
        <a href="{{ route('index') }}"><img src="/urias_logo.png" height="30px"></img></a>
    </font></font>
</div>
@if (Auth::check())

    <p style="text-align:right; font-size:20px">      
        <button type="button" class="btn btn-default" style="font-size:20px ;border:0.1px">  환영합니다 {{Auth::user()->name}}님 </button>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            로그아웃
        </a>
    </p>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
              
   
@else
    <p style="text-align:right"> 
        <a href="{{route('login') }} "> 
            <button type="button" class="btn btn-default">로그인</button>
        </a>
        
    </p>
    
@endif

<nav>
    <ul class="nav nav-justified">
        <li alt="메인" id="main"><a href="{{ route('home') }}"><font><font>Home</font></font></a></li>
        <li><a href="{{ route('library') }}"><font><font>E-library</font></font></a></li>
        <li><a href="#"><font><font>공구판매</font></font></a></li>
        <li><a href="{{ route('study') }}"><font><font>온라인점자학교</font></font></a></li>
        <li><a href="#"><font><font>블라인드케어</font></font></a></li>
        <li><a href="#"><font><font>지원부탁</font></font></a></li>
    </ul>
</nav>