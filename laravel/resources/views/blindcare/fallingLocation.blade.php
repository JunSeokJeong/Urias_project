@extends('layouts.fall_master')
@section('title', 'Page Title')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
    #map {
        /*margin-left:5%;*/
        height:80%;
        width: 80%;
        /*float:right;*/
    }
    .img{
        width:150px;
    }
    .div_display{
        padding:5px;
        /*float:left;*/
        display: inline-block;
    }
    .btn{
        width:100px;
        background-color:white;
    }
    .center{
        margin-left:90px;
    }
    th, td {
    text-align: center;
    vertical-align: middle;
}
  
</style>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD55WE3Jmg-P5fWHQbp-oDFFY5oNgsz9co&callback=initMap">
</script>
<script type="text/javascript" charset="utf-8">

        //맵생성
        function initMap() {
            var infowindow = 0;
            var setmarker = 0;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                //center: {lat: 35.871389, lng: 128.601389}
                center: {lat: 35.8966353, lng: 128.6201967}
            });
            @foreach($result as $location)
            
            var marker{{$location->f_num}} = new google.maps.Marker({
                position: {lat: {{$location->lat}}, lng: {{$location->lng}}},
                map: map
            });
            
            marker{{$location->f_num}}.addListener('click', function() {
                
                if(infowindow) {
                    setmarker.setVisible(true);
                    infowindow.close();
                }
                setmarker = marker{{$location->f_num}};
                infowindow = new google.maps.InfoWindow({
                    position: new google.maps.LatLng({{$location->lat}}, {{$location->lng}})
                });
                infowindow.addListener('closeclick', function() {
                    marker{{$location->f_num}}.setVisible(true);
                });
                infowindow.setContent(
                    "<table class='test'>" +
                    "<tr><td rowspan='3' class='row-xs-1'><img src='{{$location->falling_img}}' height='50px'></td></td><td colspan='2'>{{$location->l_title}}</td></tr>" +
                    "<tr><td colspan='2'>{{$location->f_content}}</td></tr>" +
                    "<tr><td>{{$location->falling_user}}</td><td>{{$location->register_user}}</td></tr>" +
                    "</table>" +
                    "<a href='/blindcare/fallingInfo/{{$location->f_num}}'>상세정보</a>"
                    // "<img src='{{$location->falling_img}}'><br>" +
                    // "낙상지 : {{$location->l_title}}<br>" + 
                    // "등록자 : {{$location->register_user}}<br>" + 
                    // "낙상자 : {{$location->falling_user}}<br>" + 
                    // "내용 : {{$location->f_content}}<br>"
                    );
                marker{{$location->f_num}}.setVisible(false);
                infowindow.open(map);
            });
            
            
            
            @endforeach
            
        }
        
</script>
      
    <div class="row">
        <div class="page-header">
            <center>
                <br><br>
                <h1>낙상사고 발생 지역</h1>
            </center>
        </div>
            <div class="div_display center" style="overflow:scroll;width:500px;height:580px">
            <table class="table table-bordered">
                <thead>
                    <th> </th>
                    <th><center>위치</center></th>
                    <th><center>등록자&nbsp;</center></th>
                    <th><center>날짜</center></th>
                </thead>
                
                @foreach($result as $loca)
                <tbody>
                    <tr>
                        <td><img class="img" src='{{$loca->falling_img}}'></td>
                        <td><button class="btn btn-white"><a href="/blindcare/fallingInfo/{{$loca->f_num}}">{{$loca->l_title}}</a></button></td>
                        <td>{{$loca->register_user}} </td>
                        <?php  $f_date_cut = explode(' ', $loca->f_date); ?>
                        <td>{{$f_date_cut[0]}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <hr>
        </div>
        <div class="div_display" >
            <div id="map" style="width:800px;"></div>
        </div>
         
    </div>
       
    
    <!--<div class="col-sm-3 col-md-2 ">-->
        <!--<ul id="slide-out" >-->
        <!--<li>-->
    <!--        <div class="userView">-->
    <!--            <div class="background">-->
                 
    <!--            </div>-->
    <!--        </div>-->
        <!--</li>-->
        <!--<li><a class="subheader"></a></li>-->
    <!--    @foreach($result as $loca)-->
        <!--<li>-->
    <!--        <i class="material-icons"><img class="img" src='{{$loca->falling_img}}'></i>-->
    <!--        <span><a href="/blindcare/fallingInfo/{{$loca->f_num}}">{{$loca->l_title}}</a>-->
    <!--        </span><br><span>{{$loca->f_content}}</span><br>-->
    <!--        <span>등록자 :{{$loca->register_user}}</span>&nbsp;&nbsp;<span>낙상자:{{$loca->falling_user}}</span>-->
        <!--</li>-->
    <!--    <hr>-->
    <!--    @endforeach-->
        <!--<li><a href="#"><i class="material-icons">cloud</i>Second Link</a></li>-->
        <!--<li><a class="waves-effect" href="#!">Third Link With Waves</a></li>-->
    <!--</ul>-->
    <!--</div>-->
    
        <!--<div class="col-md-offset-1">-->
            
        <!--</div>-->
<!-- <div class="col-md-10 col-md-offset-4">-->
<!--            <div id="map"></div>-->
<!--</div>    -->
    
    
    

    
    


        