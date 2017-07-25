<!--Navbar-->
<nav class="navbar navbar-toggleable-md navbar-dark bg-primary">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       <a class="navbar-brand" href="{{ route('index') }}" title="유리아스 로고" role="button"><img src="/urias_logo_white.png" height="40" width="150"></img></a>
            <strong>Navbar</strong>
        </a>
        <div class="collapse navbar-collapse" id="navbarNav1">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <!--<a class="nav-link">Features</a>-->
                    <a class="nav-link" href="{{ route('library') }}" style="color:white;" title="E-library" role="button">E-library</a>
                </li>
                <li class="nav-item">
                    <!--<a class="nav-link">Pricing</a>-->
                    <a class="nav-link" href="{{ route('blindIndex') }}" style="color:white;" title="Blind care" role="button">Blind care</a>
                </li>
                <li class="nav-item">
                    <!--<a class="nav-link">Pricing</a>-->
                    <a class="nav-link" href="{{ route('study') }}" style="color:white;" title="온라인 점자 학교" role="button">Online braille school</a>
                </li>
                <li class="nav-item">
                    <!--<a class="nav-link">Pricing</a>-->
                    <a class="nav-link" href="{{ route('boardList') }}" style="color:white;" title="도서관 소식" role="button">Library news</a>
                </li>
                <li class="nav-item">
                    <!--<a class="nav-link">Pricing</a>-->
                    <a class="nav-link" href="#" style="color:white;" role="button">Shop</a>
                </li>
            </ul>
            <form class="form-inline waves-effect waves-light">
                <!--<input class="form-control" type="text" placeholder="Search">-->
            </form>
        </div>
    </div>
</nav>