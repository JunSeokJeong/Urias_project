var fs = require('fs');


//도서 리스트
module.exports.bookList = function(query,book_number,book_name,req,res){
    var mysql = require('mysql');
    var result;
    var connection = mysql.createConnection({
        host : 'localhost',
        user : 'root',
        password : '',
        port     : 3306,
        database : 'c9'
    });
    connection.connect();
    connection.query(query+book_number,function(err,rows){
        if(err) throw err;
        
        var str_array = [];//파일의 문자열이 들어간 배열

        var array = []; //요음 앞에 있는 문자인덱스 배열
        var number = 0; //array의 인덱스 변수
  
        var send_array = [];//app에 전송할 문자열이 들어있는 배열
        var str = ""; // send_array배열에 값을 할당할 때 쓰는 변수
        var send_number = 0; // str을 send_array배열에 값을 하당할 때 판정하는 수
        var number2 = 0;// send_array의 인덱스
  
        //도서파일명
        var file_dir = "../laravel/public";
        console.log(rows);
        var file_path = file_dir+rows[0]['text_file_dir']+"/"+book_name;
        console.log("파일이름"+book_name);
        console.log(rows);
        console.log("파일경로"+file_path);
  
        fs.readFile(file_path,'utf8',function(err,data){
            if(err) console.log('error');
       
                
            var data = data.replace(/\n/g,"");//개행문자 제거
                data = data.replace(/\r/g,"");
                data = data.replace(/ /g,"");
                
                //data = data.substring(6);
            //문자열 배열 할당
            for(var i=0; i<data.length;i++){
                
              str_array[i] = data[i];
               
        
            }
            //요음 앞에 부분 인덱스 찾기 
            for(var i=0; i<str_array.length; i++){
                if(str_array[i].charCodeAt(0)==12419 || str_array[i].charCodeAt(0)==12421 || str_array[i].charCodeAt(0)==12423){
              //      var v;
              //      v = i;
                    array[number] = i-1;
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
                    //
                    if(send_number == 8){
                        send_array[number2] = str; //문자열 배열 할당
                        number2++ // send_array index 증가 
                        var a = send_array[number2-1].length;
                        str = ""; // 문자열 초기화
                        send_number = 0; //인덱스 초기화
                      
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
                          
                         if(send_number == 7){ //요음 앞 문자가 str의 마지막 문자열일때
                              str += 'x';
                              i--;
                              number--;
                         }
                         else{   str += str_array[i];  }
                        
                         send_number++;
                         number++;
                      }//end if
                      
                      //다를 떄(탁음 ,반탁음, 그냥)
                      else{
                    
                         if(send_number == 7){
                          if(12364 <= str_array[i].charCodeAt(0) && str_array[i].charCodeAt(0) <= 12386 && str_array[i].charCodeAt(0)%2 == 0){
                             str += 'x';
                             send_number++;
                             i--;
                          }
                          else if(str_array[i].charCodeAt(0) == 12389 || str_array[i].charCodeAt(0) == 12391 || str_array[i].charCodeAt(0) == 12393){
                             str += 'x';
                             send_number++;
                       
                             i--;
                          }
                          else if(str_array[i].charCodeAt(0) == 12400 || str_array[i].charCodeAt(0) == 12403 || 
                                  str_array[i].charCodeAt(0) == 12405 || str_array[i].charCodeAt(0) == 12409 || 
                                  str_array[i].charCodeAt(0) == 12412){
                             str += 'x';
                             send_number++;
                             i--;
                          }
                          else if(str_array[i].charCodeAt(0) == 12401 || str_array[i].charCodeAt(0) == 12404 ||
                                  str_array[i].charCodeAt(0) == 12407 || str_array[i].charCodeAt(0) == 12410 || 
                                  str_array[i].charCodeAt(0) == 12413){
                             str += 'x';
                             send_number++;
                             i--;
                          }
                          else{//탁음,반탁음 제외
                             str += str_array[i];
                             send_number++;
                          }
                         }
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
                             send_number++;
                             send_number++;
                          }
                          else{//탁음,반탁음 제외
                             str += str_array[i];
                             send_number++;
                          }
                         }
                      }//end else
                    }//end else  
                  }//end else
              }//end for
              console.log(send_array);
              res.send(req.query.callback + '('+ JSON.stringify({a:send_array}) + ');');
        });
        
    connection.end();
    
    }
)}
//교육 리스트
module.exports.studyList = function(query,id,req,res){
    var mysql = require('mysql');
    var result;
    var connection = mysql.createConnection({
        host : 'localhost',
        user : 'root',
        password : '',
        port     : 3306,
        database : 'c9'
    });
    connection.connect();
    connection.query(query+id,function(err,rows){
        if(err) throw err;
        
        var ssttrr = "";
        var str_array = [];//파일의 문자열이 들어간 배열
        var str_array2 = []; //새로 추가

        var array = []; //요음 앞에 있는 문자인덱스 배열
        var number = 0; //array의 인덱스 변수
  
        var send_array = [];//app에 전송할 문자열이 들어있는 배열
        var str = ""; // send_array배열에 값을 할당할 때 쓰는 변수
        var send_number = 0; // str을 send_array배열에 값을 하당할 때 판정하는 수
        var number2 = 0;// send_array의 인덱스
  
        //도서파일명
        var file_dir = "../laravel/public";
        var file_path = file_dir+rows[0]['path'];
        console.log(file_path);
  
  
        fs.readFile(file_path,'utf8',function(err,data){
             if(err) console.log('error');
             var data = data.replace(/\n/g,"");//개행문자 제거
                 data = data.replace(/\r/g,"");
                 data = data.replace(/ /g,"");
                 data = data.split(',');
                 console.log(data);
            
            for(var i=0; i<data.length; i++){
                str_array[i] = new Array();
                array[i] = new Array();
                send_array[i] = new Array();
            }
            
            for(var i=0; i<data.length; i++){
                for(var j=0; j<data[i].length; j++){
                    str_array[i][j] = data[i][j];
                }
            }
            
            for(var m=0; m<str_array.length; m++){
                 if(m > 0){
                        number = 0;
                        str = ""; // send_array배열에 값을 할당할 때 쓰는 변수
                        send_number = 0; // str을 send_array배열에 값을 하당할 때 판정하는 수
                        number2 = 0;
                 }
                for(var i=0; i<str_array[m].length; i++){
                    if(str_array[m][i].charCodeAt(0)==12419 || str_array[m][i].charCodeAt(0)==12421 || str_array[m][i].charCodeAt(0)==12423){
                        var v;
                        v = i;
                        array[m][number] = v-1;
                        number++;
                    }
                }
            //str_array index initialization
                number = 0;
              
                for(var i=0; i<str_array[m].length; i++){
                    //i가 배열 마지막일때 나머지 문자열 배열 배열 할당
                    if(i == str_array[m].length-1){
                        if(send_number == 10){
                            console.log(str);
                            send_array[m][number2] = str; //문자열 배열 할당
                            number2++;
                            str = ""; // 문자열 초기화
                            send_number = 0; //인덱스 초기화
                            str += str_array[m][i];
                            send_array[m][number2] = str;
                        }
                        else{
                            str += str_array[m][i];
                            send_array[m][number2] = str;    
                        }
                         
                    }//end if(i == str_array.length-1)
                      
                    else{ //i가 마지막이 아닐때 
                    
                        if(send_number == 10){
                            
                            send_array[m][number2] = str; //문자열 배열 할당
                            // console.log(send_array[m][number2]);
                            number2++ // send_array index 증가 
                            var a = send_array[m][number2-1].length;
                            str = ""; // 문자열 초기화
                            send_number = 0; //인덱스 초기화
                          
                            if(i == array[m][number]){
                              str += str_array[m][i];
                              send_number++;
                              number++;
                            }//end if
                            else{//다를 떄(탁음 ,반탁음, 그냥)
                            
                                if(12364 <= str_array[m][i].charCodeAt(0) && str_array[m][i].charCodeAt(0) <= 12386 && str_array[m][i].charCodeAt(0)%2 == 0){
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else if(str_array[m][i].charCodeAt(0) == 12389 || str_array[m][i].charCodeAt(0) == 12391 || str_array[m][i].charCodeAt(0) == 12393){
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else if(str_array[m][i].charCodeAt(0) == 12400 || str_array[m][i].charCodeAt(0) == 12403 || 
                                        str_array[m][i].charCodeAt(0) == 12405 || str_array[m][i].charCodeAt(0) == 12409 || str_array[m][i].charCodeAt(0) == 12412){
                                  
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else if(str_array[m][i].charCodeAt(0) == 12401 || str_array[m][i].charCodeAt(0) == 12404 ||
                                        str_array[m][i].charCodeAt(0) == 12407 || str_array[m][i].charCodeAt(0) == 12410 || str_array[m][i].charCodeAt(0) == 12413){
                                    
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else{//탁음,반탁음 제외
                                  str += str_array[m][i];  
                                  send_number++;
                                }
                             }//end else
                         }//end if(send_number == 10)
                        
                         else{ //send_number이 10이 아닐때 
                          //인덱스 같을때(요음앞에 탁음 반탁음있을때)
                          if(i == array[m][number]){
                              
                             if(send_number == 9){ //요음 앞 문자가 str의 마지막 문자열일때
                                  str += 'x';
                                  i--;
                                  number--;
                             }
                             else{   str += str_array[m][i];  }
                            
                             send_number++;
                             number++;
                          }//end if
                          
                          //다를 떄(탁음 ,반탁음, 그냥)
                          else{
                             if(send_number == 9){
                              if(12364 <= str_array[m][i].charCodeAt(0) && str_array[m][i].charCodeAt(0) <= 12386 && str_array[m][i].charCodeAt(0)%2 == 0){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12389 || str_array[m][i].charCodeAt(0) == 12391 || str_array[m][i].charCodeAt(0) == 12393){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12400 || str_array[m][i].charCodeAt(0) == 12403 || 
                                      str_array[m][i].charCodeAt(0) == 12405 || str_array[m][i].charCodeAt(0) == 12409 || 
                                      str_array[m][i].charCodeAt(0) == 12412){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12401 || str_array[m][i].charCodeAt(0) == 12404 ||
                                      str_array[m][i].charCodeAt(0) == 12407 || str_array[m][i].charCodeAt(0) == 12410 || 
                                      str_array[m][i].charCodeAt(0) == 12413){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else{//탁음,반탁음 제외
                                 str += str_array[m][i];
                                 send_number++;
                              }
                             }
                             else{
                              if(12364 <= str_array[m][i].charCodeAt(0) && str_array[m][i].charCodeAt(0) <= 12386 && str_array[m][i].charCodeAt(0)%2 == 0){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12389 || str_array[m][i].charCodeAt(0) == 12391 || str_array[m][i].charCodeAt(0) == 12393){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12400 || str_array[m][i].charCodeAt(0) == 12403 || 
                                      str_array[m][i].charCodeAt(0) == 12405 || str_array[m][i].charCodeAt(0) == 12409 || 
                                      str_array[m][i].charCodeAt(0) == 12412){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12401 || str_array[m][i].charCodeAt(0) == 12404 ||
                                      str_array[m][i].charCodeAt(0) == 12407 || str_array[m][i].charCodeAt(0) == 12410 || 
                                      str_array[m][i].charCodeAt(0) == 12413){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else{//탁음,반탁음 제외
                                 str += str_array[m][i];
                                 send_number++;
                              }
                             }
                          }//end else
                        }//end else  
                    }//end else
                }//end for    
            }//end for(m)
             //console.log(str_array);
        
              console.log(send_array);
            res.send(req.query.callback + '('+ JSON.stringify({a:send_array}) + ');');
        });
        
    connection.end();
    
    }
)}
//퀴즈 리스트
module.exports.quizList = function(query,id,req,res){
    var mysql = require('mysql');
    var result;
    var connection = mysql.createConnection({
        host : 'localhost',
        user : 'root',
        password : '',
        port     : 3306,
        database : 'c9'
    });
    connection.connect();
    connection.query(query+id,function(err,rows){
        if(err) throw err;
        
        var ssttrr = "";
        var str_array = [];//파일의 문자열이 들어간 배열
        var str_array2 = []; //새로 추가

        var array = []; //요음 앞에 있는 문자인덱스 배열
        var number = 0; //array의 인덱스 변수
  
        var send_array = [];//app에 전송할 문자열이 들어있는 배열
        var str = ""; // send_array배열에 값을 할당할 때 쓰는 변수
        var send_number = 0; // str을 send_array배열에 값을 하당할 때 판정하는 수
        var number2 = 0;// send_array의 인덱스
  
        //도서파일명
        var file_dir = "../laravel/public";
        var file_path = file_dir+rows[0]['path'];
        
  
        fs.readFile(file_path,'utf8',function(err,data){
             if(err) console.log('error');
                   
             var data = data.replace(/\n/g,"");//개행문자 제거
                 data = data.replace(/\r/g,"");
                 data = data.replace(/ /g,"");
                 data = data.split(',');
                 console.log(data);
            
            for(var i=0; i<data.length; i++){
                str_array[i] = new Array();
                array[i] = new Array();
                send_array[i] = new Array();
            }
            
            for(var i=0; i<data.length; i++){
                for(var j=0; j<data[i].length; j++){
                    str_array[i][j] = data[i][j];
                }
            }
            
            for(var m=0; m<str_array.length; m++){
                 if(m > 0){
                        number = 0;
                        str = ""; // send_array배열에 값을 할당할 때 쓰는 변수
                        send_number = 0; // str을 send_array배열에 값을 하당할 때 판정하는 수
                        number2 = 0;
                 }
                for(var i=0; i<str_array[m].length; i++){
                    if(str_array[m][i].charCodeAt(0)==12419 || str_array[m][i].charCodeAt(0)==12421 || str_array[m][i].charCodeAt(0)==12423){
                        var v;
                        v = i;
                        array[m][number] = v-1;
                        number++;
                    }
                }
            //str_array index initialization
                number = 0;
              
                for(var i=0; i<str_array[m].length; i++){
                    //i가 배열 마지막일때 나머지 문자열 배열 배열 할당
                    if(i == str_array[m].length-1){
                        if(send_number == 10){
                            console.log(str);
                            send_array[m][number2] = str; //문자열 배열 할당
                            number2++;
                            str = ""; // 문자열 초기화
                            send_number = 0; //인덱스 초기화
                            str += str_array[m][i];
                            send_array[m][number2] = str;
                        }
                        else{
                            str += str_array[m][i];
                            send_array[m][number2] = str;    
                        }
                         
                    }//end if(i == str_array.length-1)
                      
                    else{ //i가 마지막이 아닐때 
                    
                        if(send_number == 10){
                            
                            send_array[m][number2] = str; //문자열 배열 할당
                            // console.log(send_array[m][number2]);
                            number2++ // send_array index 증가 
                            var a = send_array[m][number2-1].length;
                            str = ""; // 문자열 초기화
                            send_number = 0; //인덱스 초기화
                          
                            if(i == array[m][number]){
                              str += str_array[m][i];
                              send_number++;
                              number++;
                            }//end if
                            else{//다를 떄(탁음 ,반탁음, 그냥)
                            
                                if(12364 <= str_array[m][i].charCodeAt(0) && str_array[m][i].charCodeAt(0) <= 12386 && str_array[m][i].charCodeAt(0)%2 == 0){
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else if(str_array[m][i].charCodeAt(0) == 12389 || str_array[m][i].charCodeAt(0) == 12391 || str_array[m][i].charCodeAt(0) == 12393){
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else if(str_array[m][i].charCodeAt(0) == 12400 || str_array[m][i].charCodeAt(0) == 12403 || 
                                        str_array[m][i].charCodeAt(0) == 12405 || str_array[m][i].charCodeAt(0) == 12409 || str_array[m][i].charCodeAt(0) == 12412){
                                  
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else if(str_array[m][i].charCodeAt(0) == 12401 || str_array[m][i].charCodeAt(0) == 12404 ||
                                        str_array[m][i].charCodeAt(0) == 12407 || str_array[m][i].charCodeAt(0) == 12410 || str_array[m][i].charCodeAt(0) == 12413){
                                    
                                  str += str_array[m][i];
                                  send_number++;
                                  send_number++;
                                }
                                else{//탁음,반탁음 제외
                                  str += str_array[m][i];  
                                  send_number++;
                                }
                             }//end else
                         }//end if(send_number == 10)
                        
                         else{ //send_number이 10이 아닐때 
                          //인덱스 같을때(요음앞에 탁음 반탁음있을때)
                          if(i == array[m][number]){
                              
                             if(send_number == 9){ //요음 앞 문자가 str의 마지막 문자열일때
                                  str += 'x';
                                  i--;
                                  number--;
                             }
                             else{   str += str_array[m][i];  }
                            
                             send_number++;
                             number++;
                          }//end if
                          
                          //다를 떄(탁음 ,반탁음, 그냥)
                          else{
                             if(send_number == 9){
                              if(12364 <= str_array[m][i].charCodeAt(0) && str_array[m][i].charCodeAt(0) <= 12386 && str_array[m][i].charCodeAt(0)%2 == 0){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12389 || str_array[m][i].charCodeAt(0) == 12391 || str_array[m][i].charCodeAt(0) == 12393){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12400 || str_array[m][i].charCodeAt(0) == 12403 || 
                                      str_array[m][i].charCodeAt(0) == 12405 || str_array[m][i].charCodeAt(0) == 12409 || 
                                      str_array[m][i].charCodeAt(0) == 12412){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12401 || str_array[m][i].charCodeAt(0) == 12404 ||
                                      str_array[m][i].charCodeAt(0) == 12407 || str_array[m][i].charCodeAt(0) == 12410 || 
                                      str_array[m][i].charCodeAt(0) == 12413){
                                 str += 'x';
                                 send_number++;
                                 i--;
                              }
                              else{//탁음,반탁음 제외
                                 str += str_array[m][i];
                                 send_number++;
                              }
                             }
                             else{
                              if(12364 <= str_array[m][i].charCodeAt(0) && str_array[m][i].charCodeAt(0) <= 12386 && str_array[m][i].charCodeAt(0)%2 == 0){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12389 || str_array[m][i].charCodeAt(0) == 12391 || str_array[m][i].charCodeAt(0) == 12393){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12400 || str_array[m][i].charCodeAt(0) == 12403 || 
                                      str_array[m][i].charCodeAt(0) == 12405 || str_array[m][i].charCodeAt(0) == 12409 || 
                                      str_array[m][i].charCodeAt(0) == 12412){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else if(str_array[m][i].charCodeAt(0) == 12401 || str_array[m][i].charCodeAt(0) == 12404 ||
                                      str_array[m][i].charCodeAt(0) == 12407 || str_array[m][i].charCodeAt(0) == 12410 || 
                                      str_array[m][i].charCodeAt(0) == 12413){
                                 str += str_array[m][i];
                                 send_number++;
                                 send_number++;
                              }
                              else{//탁음,반탁음 제외
                                 str += str_array[m][i];
                                 send_number++;
                              }
                             }
                          }//end else
                        }//end else  
                    }//end else
                }//end for    
            }//end for(m)
             //console.log(str_array);
        
              console.log(send_array);
            res.send(req.query.callback + '('+ JSON.stringify({a:send_array}) + ');');
        });
        
    connection.end();
    
    }
)}
