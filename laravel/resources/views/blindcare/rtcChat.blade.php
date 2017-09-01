@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<style>
    #map {
        width: 40%;
        height: 40%;
    }
    #localVideo {
        display:none;
    }
</style>

<link rel="stylesheet" href="../css/main.css" />

<script>
    if(document.location.protocol == 'http:') {
        document.location.href = document.location.href.replace('http:', 'https:');
    }
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<script src="https://webrtc-server-wjdwnstjr26.c9users.io/socket.io/socket.io.js"></script>-->
<script src="https://urias-cloned-cloned-cloned-heoyongjun.c9users.io:8081/socket.io/socket.io.js"></script>
<script src="../js/lib/adapter.js"></script>
<script src="../js/mainIn.js"></script>
<!--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB4QCFd8E3dERx3xv85EAloCzEYvpD2fHw"></script>-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4QCFd8E3dERx3xv85EAloCzEYvpD2fHw"></script>
<script>
socket.on('latlng_take', function(data) {
    var lat = data.lat;
    var lng = data.lng;
    
    console.log('lat : ' + lat);
    console.log('lng : ' + lng);
    
    // 구글맵 좌표 지정
    var options = {
        zoom: 18,
        center: {
            lat: lat,
            lng: lng
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    var map = new google.maps.Map(document.getElementById('map'), options);
    
    var infoWindow = new google.maps.InfoWindow({map: map});
    
    var marker = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.DROP,
        position: {
            lat: lat,
            lng: lng
        }
  });
});
</script>


<h1>실시간 영상</h1>

<div id="videos">
    <!-- 내 화면 -->
    <video id="localVideo" autoplay muted></video>
  
    <!-- 상대 화면 -->
    <video id="remoteVideo" autoplay></video>
    
    <div id="map"></div>
    
    </div>
</div>



<!--<div>-->
<!--    <button id="callButton" onclick="call();">Call</button>-->
<!--    <button id="hangupButton" onclick="hangup();">Hang Up</button>-->
<!--</div>-->

@endsection