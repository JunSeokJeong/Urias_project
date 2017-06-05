var fs = require('fs');




module.exports.index=function(req, res, next) {
  var str_array = [];//파일의 문자열이 들어간 배열

  var array = []; //요음 앞에 있는 문자인덱스 배열
  var number = 0; //array의 인덱스 변수
  
  var send_array = [];//app에 전송할 문자열이 들어있는 배열
  var str = ""; // send_array배열에 값을 할당할 때 쓰는 변수
  var send_number = 0; // str을 send_array배열에 값을 하당할 때 판정하는 수
  var number2 = 0;// send_array의 인덱스
  
  fs.readFile('test.txt','utf8',function(err,data){
      if(err) console.log('error');
      
      //문자열 배열 할당
      for(var i=0; i<data.length-2;i++){
          str_array[i] = data[i];
      }
      //요음 앞에 부분 인덱스 찾기 
      for(var i=0; i<str_array.length; i++){
          if(str_array[i].charCodeAt(0)==12419 || str_array[i].charCodeAt(0)==12421 || str_array[i].charCodeAt(0)==12423){
              var v;
              v = i;
              array[number] = v-1;
              number++;
          }
      }
      //str_array index initialization
      number = 0;
      
      for(var i=0; i<str_array.length; i++){
          
          //i가 배열 마지막일때 나머지 문자열 배열 배열 할당
          if(i == str_array.length-1){
              str += str_array[i];
              send_array[number2] = str; 
          }//end if(i == str_array.length-1)
          
          else{ //i가 마지막이 아닐때 
            if(send_number == 10){
              send_array[number2] = str; //문자열 배열 할당
              number2++ // send_array index 증가 
              var a = send_array[number2-1].length;
              str = ""; // 문자열 초기화
              send_number = 0; //인덱스 초기화
              
              //인덱스 같을때(요음앞에 탁음 반탁음있을때)
            //   if(send_array[number2-1][a-1] == "x"){
            //       str += str_array[i-1];
            //       str += str_array[i];
            //       send_number++;
            //       send_number++;
            //       console.log("응"+str);
            //   }
              if(i == array[number]){
                 str += str_array[i];
                 send_number++;
                 number++;
              }//end if
              else{//다를 떄(탁음 ,반탁음, 그냥)
                  if(12364 <= str_array[i].charCodeAt(0) && str_array[i].charCodeAt(0) <= 12386 && str_array[i].charCodeAt(0)%2 == 0){
                    str += str_array[i];
                    send_number++;
                    send_number++;
                  }
                  else if(str_array[i].charCodeAt(0) == 12389 || str_array[i].charCodeAt(0) == 12391 || str_array[i].charCodeAt(0) == 12393){
                    str += str_array[i];
                    send_number++;
                    send_number++;
                  }
                  else if(str_array[i].charCodeAt(0) == 12400 || str_array[i].charCodeAt(0) == 12403 || 
                          str_array[i].charCodeAt(0) == 12405 || str_array[i].charCodeAt(0) == 12409 || str_array[i].charCodeAt(0) == 12412){
                    str += str_array[i];
                    send_number++;
                    send_number++;
                  }
                  else if(str_array[i].charCodeAt(0) == 12401 || str_array[i].charCodeAt(0) == 12404 ||
                          str_array[i].charCodeAt(0) == 12407 || str_array[i].charCodeAt(0) == 12410 || str_array[i].charCodeAt(0) == 12413){
                    str += str_array[i];
                    send_number++;
                    send_number++;
                  }
                  else{//탁음,반탁음 제외
                    str += str_array[i];  
                    send_number++;
                  }
              }//end else
            }//end if(send_number == 10)
            
            
            else{ //send_number이 10이 아닐때 
            
              //인덱스 같을때(요음앞에 탁음 반탁음있을때)
              if(i == array[number]){
                  
                if(send_number == 9){ //요음 앞 문자가 str의 마지막 문자열일때
                      str += 'x';
                      i--;
                      number--;
                }else{
                     str += str_array[i];
                }
                 send_number++;
                 number++;
              }//end if
              //다를 떄(탁음 ,반탁음, 그냥)
              else{
                  if(12364 <= str_array[i].charCodeAt(0) && str_array[i].charCodeAt(0) <= 12386 && str_array[i].charCodeAt(0)%2 == 0){
                    str += str_array[i];
                    send_number++;
                    send_number++;
                  }
                  else if(str_array[i].charCodeAt(0) == 12389 || str_array[i].charCodeAt(0) == 12391 || str_array[i].charCodeAt(0) == 12393){
                    str += str_array[i];
                    send_number++;
                    send_number++;
                  }
                  else if(str_array[i].charCodeAt(0) == 12400 || str_array[i].charCodeAt(0) == 12403 || 
                          str_array[i].charCodeAt(0) == 12405 || str_array[i].charCodeAt(0) == 12409 || 
                          str_array[i].charCodeAt(0) == 12412){
                    str += str_array[i];
                    send_number++;
                    send_number++;
                  }
                  else if(str_array[i].charCodeAt(0) == 12401 || str_array[i].charCodeAt(0) == 12404 ||
                          str_array[i].charCodeAt(0) == 12407 || str_array[i].charCodeAt(0) == 12410 || 
                          str_array[i].charCodeAt(0) == 12413){
                    str += str_array[i];
                    console.log(i+"똥"+str);
                    send_number++;
                    send_number++;
                  }
                  else{//탁음,반탁음 제외
                    str += str_array[i];  
                    send_number++;
                  }
              }//end else
            }//end else  
          }//end else
      }//end for
      
      console.log(send_array);
      console.log(send_array[4].length);
  })  
  res.render('index', { title: 'Express' });
}