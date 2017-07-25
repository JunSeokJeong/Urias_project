
//이미지 경로
var img_path = process.argv[2];

//이미지 이름
var name = process.argv[3];
//파일 모듈
var fs = require('fs');

//vision api
var vision = require('google-vision-api-client');
var requtil = vision.requtil;

//인증파일 경로
var jsonfile = './js/Tutorial Project-9f1a7e5f2d3a.json';

//vision api 인증
vision.init(jsonfile);



//Build the request payloads
var d = requtil.createRequests().addRequest(
            //이미지 경로
            requtil.createRequest(img_path)
            .withFeature('TEXT_DETECTION', 3)
            .build()
        );


//Do query to the api server

vision.query(d, function(e, r, d){

    if(e) console.log('ERROR:', e);
  
    var data = JSON.stringify(d);
  
    fs.writeFile('./blindcare/obj_detection/'+ name +'.json',data,'utf8',
    function(error){
        // console.log("wrtie end");
    });
});

////end for