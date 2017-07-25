var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);


var FCM = require('fcm-push'); //fcm push 모듈
var serverKey = 'AAAAGfQR6Uo:APA91bGLbT_FRHJbMrRxX90BLb_Ug5UFJbJMEG_lJpKZoCjCPUD-TRbKbzcJFx9GZ0MvLbBpf10ULnXyeaJ88XU0Ibou_N-gQHaOU61Cr_oO2n-U5N6pdhsbVdpIyVarInpP2-jYGlAI';
var fcm = new FCM(serverKey);

var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

var index = require('./app_server/routes/index');
var users = require('./app_server/routes/users');





// view engine setup

app.set('views', path.join(__dirname,'app_server','views'));
app.set('view engine', 'jade');

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', index);
app.use('/users', users);
app.get('/appPush',function(req,res){
  console.log(req.query.s);
})

var message = {
        to : 'fmSnqxqHM98:APA91bGHZjosnOXrNE4CpBKr0CJYr6n0Ty6Hf8u97ehINDXx_mLLYlx1rf5cFKSgDDENVZh-NptbdAvWOwvXzssVse2xXy59m9qbr60NYQvhQ8QWoNsAHNUSKDV-GaCUcHvqNt_ortvP',
       
        collapse_key: 'com.example.push',
        //collapse_key: 'net.tigoe.simpleserial',
        //보내는 데이터
        data: {
            kind: '',
            data: ''
        },
        //push 알림
        notification: {
            title: '',
            body: '',
            sound:"default"
        }
};

io.on('connection',function(socket){
      
      socket.emit('php event',{hello:'php'});
      socket.on('study start event',function(data){
        console.log(data);
        console.log(data.hello);
        message.data.kind = "study";
        message.data.data = data.hello;
        message.notification.title = "강의 목록으로 들어가세요";
        message.notification.body  = "강의 목록";
        fcm.send(message, function(err, response){
          if (err) console.log("Something has gone wrong!"); 
          else console.log("Successfully sent with response: ", response); 
        });
      });
      
      socket.emit('quizReq',{hello:'php'});
      socket.on('quiz start event',function(data){
        console.log(data);
        // console.log(data.hello);
        message.data.kind = "quiz";
        message.data.data = data.hello;
        message.notification.title = "퀴즈 목록으로 들어가세요";
        message.notification.body  = "퀴즈 목록";
        fcm.send(message, function(err, response){
          if (err) console.log("Something has gone wrong!"); 
          else console.log("Successfully sent with response: ", response); 
        });
      });
        
});//end socket on


//서버 포트 설정 
http.listen(8082,function(){
  console.log("start");
})
// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});
app.use(function (req, res, next) {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept-Type');
    res.header('Access-Control-Allow-Credentials', 'true');
    next();
})
// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = app;