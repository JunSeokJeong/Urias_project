'use strict';

// var webrtc_server_url = 'https://webrtc-server-wjdwnstjr26.c9users.io:8080';
var webrtc_server_url = 'https://urias-cloned-cloned-cloned-heoyongjun.c9users.io:8081';
var server_base_url = 'https://urias-heoyongjun.c9users.io';
var socket = io.connect(webrtc_server_url);
var socket_id;
var user_email;

function email(email) {
  user_email = email;

  console.log('내 user_email : ' + user_email);
}

socket.on('id', function(id) {
  socket_id = id;
  console.log('내 socket id : ' + socket_id);

  socket.emit('id_save', {id: socket_id, email: user_email});
});

socket.on('invite', function(room) {
  console.log(room);
  
  $('#income_call').modal();

  $(document).on('click', '.j-accept', function() {
    socket.emit('call_response', {response: 'accept', room: room});
    
    console.log('수신 동의');
    
    window.location.href = server_base_url + '/blindcare/rtcChat';
  });
  
  $(document).on('click', '.j-decline', function() {
    socket.emit('call_response', {response: 'decline', room: room});
    
    console.log('수신 거절');
    
    $('#income_call').modal('hide');
  });
  
  // 1분 동안 응답이 없으면 수신 거절 처리
  setTimeout(function() {
    socket.emit('call_response', {response: 'decline', room: room});
    
    console.log('수신 거절');
    
    $('#income_call').modal('hide');
  }, 60000);
});