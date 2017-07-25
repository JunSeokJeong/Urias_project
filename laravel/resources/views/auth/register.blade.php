@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">회원가입</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">이름</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail주소</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">비밀번호</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                            
                        
                            

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">비밀번호 확인</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            
                           
                            
                        </div>
                         <div class="form-group">
                        
                                <label for="type" class="col-md-4 control-label">가입유형</label>
                                 <div class="col-md-6">
                               <input type="text" class="form-control" id="type" name="type" value="시각장애인"  readonly >
                                <center>
                                <button type="button" onclick="first()" class="btn btn-default" >일반인 </button>
                                <button type="button" onclick="fourth()" class="btn btn-default" >보호자</button>
                                <button type="button" onclick="third()" class="btn btn-default" >관리자</button>
                                <button type="button" onclick="second()" class="btn btn-default" >시각장애인</button>
                             </center>
                                    </div>
                        
                             </div>
                            
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    가입하기
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script >
    function first(){
        document.getElementById('type').value='일반인';
    }
    function second(){
        document.getElementById('type').value='시각장애인';
    }
    function third(){
        document.getElementById('type').value='관리자';
    }
    function fourth(){
        document.getElementById('type').value='보호자';
    }
</script>