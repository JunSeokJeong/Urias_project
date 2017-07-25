'use strict';

var socket = io.connect('https://urias-heoyongjun.c9users.io:8082');

var id = socket.id;
var email;

$.ajax({
  url: 'https://urias-heoyongjun.c9users.io/blindcare/idRegistApp',
  data: {
    user_id: socket.id,
    user_email: user_email
  },
  dataType: 'jsonp',
  success: function(data) {
      if(data.result == "success") {
          
      }
      else {
          
      }
  },
  error: function() {
      window.alert('서버 접속 오류 발생');
  }
});

socket.on('invite', function(room) {
  
  console.log(room);
  
  $('#income_call').modal();

  $(document).on('click', '.j-accept', function() {
    alert(room + '방에 입장하셨습니다.');
    
    window.location.href = 'https://urias-heoyongjun.c9users.io/blindcare/rtcChat';
  });
  
  $(document).on('click', '.j-decline', function() {
    alert('decline');

    $('#income_call').modal('hide');
  });
});