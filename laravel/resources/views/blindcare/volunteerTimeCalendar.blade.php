@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<link href='../css/fullcalendar.css' rel='stylesheet' />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/2.2.2/js/bootstrap.min.js"></script>
<script src='../js/moment.min.js'></script>
<script src='../js/fullcalendar.js'></script>

<script>
    var server_base_url = "https://urias-heoyongjun.c9users.io";    // urias 웹 서버 url
    var choose_day;                                                 // 캘린더에서 선택한 날짜
    var user_email;                                                 // 유저 이메일
    var user_type;                                                  // 유저 타입

    // 봉사 가능한 시간 목록 로드
    $.ajax({
        url: server_base_url + '/blindcare/volunteerTimeListApp',
        data: {},
        dataType: 'jsonp',
        success: function(data) {
            if(data.result == "success") {
                var time_list = new Array();
            
                // 봉사자의 봉사가능한 시간 목록 로드
                for(var i = 0 ; i < data.time_list.length ; i++) {
                    time_list[i] = {
                        'title': data.time_list[i]['writer'],
                        'start': data.time_list[i]['action_day'] + 'T' + data.time_list[i]['action_start_time'],
                        'end': data.time_list[i]['action_day'] + 'T' + data.time_list[i]['action_end_time']
                    };
                }
        
                // 오늘날짜
                var today = new Date();
                
                // 달력 출력 부분
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        // right: 'month,agendaWeek,agendaDay'
                        right:'month'
                    },
                    defaultDate: today,
                    editable: true,
                    eventLimit: true,
                    events: time_list,
                    loading: function(bool) {
                        $('#loading').toggle(bool);
                    }
                });
            }
            else {
                window.alert('오류가 발생했습니다.');
            }
        },
        error: function() {
            window.alert('오류가 발생했습니다.');
        }
    });

    // 날짜 선택시 창 뜸
    $(document).on('click', '.fc-day', function() {
        choose_day = $(this).attr('data-date');
        var days = choose_day;
        
        console.log(days);
        
        $('#day_choose').modal();
        
        
        
        
        $('#day_choose')
            .find('.modal-lg')
            .find('.modal-content')
            .find('.modal-header')
            .append('<h3>봉사자들의 ' + days + '의 봉사일정입니다.</h3>');
    
        for(var i = 8 ; i <= 21 ; i++) {
            if(i < 10) {
                $('#day_choose')
                .find('.modal-lg')
                .find('.modal-content')
                .find('.modal-footer')
                .find('.time')
                .append('<option value="0' + i + '">' + i + '</option>');
            }
            else {
                $('#day_choose')
                .find('.modal-lg')
                .find('.modal-content')
                .find('.modal-footer')
                .find('.time')
                .append('<option value="' + i + '">' + i + '</option>');
            }
        }
        
        $('#day_choose')
            .find('.modal-lg')
            .find('.modal-content')
            .find('.modal-footer')
            .find('.minute')
            .append('<option value="00">00</option>')
            .append('<option value="30">30</option>');
    
        
        
        // 선택한 날짜 하루동안의 봉사시간 리스트 로드
        $.ajax({
            url: server_base_url + '/blindcare/volunteerTimeListApp',
            data: {
                days: days
            },
            dataType: 'jsonp',
            success: function(data) {
                if(data.result == "success") {
                    var time_list = new Array();
    
                    for(var i = 0 ; i < data.time_list.length ; i++) {
                        time_list[i] = {
                            'title': data.time_list[i]['writer'],
                            'start': data.time_list[i]['action_start_time'],
                            'end': data.time_list[i]['action_end_time']
                        };
                        
                        $('#day_choose')
                            .find('.modal-lg')
                            .find('.modal-content')
                            .find('.modal-body')
                            .append('<p>시간 : ' + time_list[i].start + ' ~ ' + time_list[i].end + '</p>')
                            .append('<p>회원 : ' + time_list[i].title + '</p>')
                            .append('<hr />');
                    }
                }
                else {
                    window.alert('등록된 시간정보가 없습니다.');
                }
            },
            error: function() {
                window.alert('서버 오류 발생');
            }
        });
    });
    
    // 시간 등록
    $(document).on('click', '.time_regist', function() {
        var days = choose_day;
        var times = {
            'start_times': $('.start_times').val(),
            'start_minutes': $('.start_minutes').val(),
            'end_times': $('.end_times').val(),
            'end_minutes': $('.end_minutes').val()
        }
        var kind = $('.kind').val();
        
        if(!times.start_times) {
            window.alert('시작시간대 시간을 선택하세요');
    
            return false;
        }
        else if(!times.start_minutes) {
            window.alert('시작시간대 분을 선택하세요');
    
            return false;
        }
        else if(!times.end_minutes) {
            window.alert('끝시간대 시간을 선택하세요');
    
            return false;
        }
        else if(!times.end_minutes) {
            window.alert('끝시간대 분을 선택하세요');
    
            return false;
        }
        
        if(times.start_times == times.end_times && times.start_minutes == times.end_minutes) {
            window.alert('시작시간대와 끝시간대가 일치합니다. 다시 선택해주세요');
    
            return false;
        }
    
        // 봉사시간 등록
        $.ajax({
            url: server_base_url + '/blindcare/volunteerTimeRegistApp',
            data: {
                user: user_email,
                days: days,
                times: times,
                kind: kind
            },
            dataType: 'jsonp',
            success: function(data) {
                if(data.result == "success") {
                    window.alert('시간 저장에 성공하셨습니다.');
    
                    location.href = server_base_url + "/blindcare/volunteerTimeCalendar";
                }
                else {
                    window.alert('오류가 발생했습니다.');
                }
            },
            error: function() {
                window.alert('오류가 발생했습니다.');
            }
        });
    });
    
    // 시간 등록 취소
    $(document).on('click', '.time_cancel', function() {
        // 시간 등록창 초기화
        $('#day_choose')
            .find('.modal-lg')
            .find('.modal-content')
            .find('.modal-header')
            .empty();
    
        $('#day_choose')
            .find('.modal-lg')
            .find('.modal-content')
            .find('.modal-body')
            .empty();
    
        $('#day_choose')
            .find('.modal-lg')
            .find('.modal-content')
            .find('.modal-footer')
            .find('.row')
            .find('.col-sm-3')
            .find('.time')
            .empty();
        
        $('#day_choose').modal('hide');
    });
    
    // 접속한 유저 이메일과 타입 받아서 저장 
    function email(email, type) {
      user_email = email;
      user_type = type;
    
      console.log('내 user_email : ' + user_email);
      console.log('내 user_type : ' + user_type);
    }
</script>
<script>
    email('{{Auth::user()->email}}, {{Auth::user()->type}}');
</script>


<!-- 날짜 클릭시 나오는 시간 목록 레이어 -->
<div class="modal fade" id="day_choose" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
            </div>

            <div class="modal-body">
                
            </div>

            <div class="modal-footer">
                <table class="time_register">
                    <tr>
                        <td><select class="form-control time start_times" style="width:100px;"></select></td>
                        <td>시</td>
                        <td><select class="form-control minute start_minutes" style="width:100px;"></select></td>
                        <td>분</td>
                        <td> ~ </td>
                        <td><select class="form-control time end_times" style="width:100px;"></select></td>
                        <td>시</td>
                        <td><select class="form-control minute end_minutes" style="width:100px;"></select></td>
                        <td>분</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>봉사 유형</td>
                        <td>
                            <select class="form-control kind">
                                <option value="길안내">길 안내</option>
                                <option value="물건설명">물건 설명</option>
                                <option value="전문서적설명">전문서적 설명</option>
                                <option value="기타">기타</option>
                            </select>
                        </td>
                    </tr>
                </table>
                
                <button type="button" class="btn btn-default time_regist">등록</button>
                <button type="button" class="btn btn-default time_cancel">취소</button>
            </div>
        </div>
    </div>
</div>

<!-- 캘린더 표시 부분 -->
<div id='calendar'>
    
</div>  <!-- end div calendar -->

<div class="footer">
    <div class="">이전 메뉴로</div>
</div>  <!-- end div footer -->




@endsection