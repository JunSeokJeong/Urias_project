var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

var index = require('./app_server/routes/index');
var users = require('./app_server/routes/users');

// view engine setup
app.set('views', path.join(__dirname, 'app_server', 'views'));
app.set('view engine', 'jade');

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', index);
app.use('/rental',index);
app.use('/brailStudy',index);
app.use('/users', users);
//점자 강의 ajax 요청
app.get('/education',function(req, res){
  var path = req.query.path;
  var brailStudyController = require('./app_server/controllers/brailStudyController');
  brailStudyController.index(req, res);
  // console.log(req.query.path);
  // res.send(req.query.callback + '('+ JSON.stringify({a:path}) + ');');
})
//점자 퀴즈 ajax 요청
app.get('/brailQuiz',function(req, res){
  
  var path = req.query.path;
  console.log(path);
  var brailStudyController = require('./app_server/controllers/brailStudyController');
  brailStudyController.quiz(req, res);
  
})
  
  
var socket_ids_web = []; //점자 교육관련 web socket id의 array_list
var socket_ids_app = []; //점자 교육관련 app socket id의 array_list

var socket_ids_webQ = []; //점자 퀴즈관련 web socket id의 array_list
var socket_ids_appQ = []; //점자 퀴즈관련 app socket id의 array_list


//점자 교육관련 io connect 
io.on('connection',function(socket){
    
    //web에서 socket connect 이벤트 발생했을때(점자교육)
    socket.on('study start web',function(data){
      console.log("web접속"+data.id);
      socket_ids_web[data.id] = socket.id; // key : 로그인 id , value : socket.id
      
      var app_socket_id = socket_ids_app[data.id]; 
      console.log(socket_ids_app);
      io.to(app_socket_id).emit('aaa',"bbb"); 
    });
    //app에서 socket connect 이벤트 발생했을때(점자교육)
    socket.on('connect cordova',function(data){
      console.log(socket.id);
      console.log("app접속"+data.id);
      socket_ids_app[data.id] = socket.id; // key : 로그인 id , value : socket.id
    });
    //app에서 socket event 발생했을때
    socket.on('bbb',function(data){
      console.log(data.id);
      var web_socket_id = socket_ids_web[data.id];
      io.to(web_socket_id).emit('receive web',"sdfsdf");
    });
    
    //*점자 퀴즈 관련*//   
    socket.on('cordova',function(data){
      socket_ids_appQ[data.id] = socket.id; // key : 로그인 id , value : socket.id
    })
    //web에서 socket 이벤트 발생 했을때
    socket.on('quizSend',function(data){
      console.log(data.id);
      socket_ids_webQ[data.id] = socket.id; // key : 로그인 id , value : socket.id
      var app_socket_id = socket_ids_appQ[data.id];
      io.to(app_socket_id).emit('quizApp','bbb');
    })
    //app에서 socket 이벤트 발생 했을때
    socket.on('quizReq',function(data){
      console.log(data.id);
      var web_socket_id = socket_ids_webQ[data.id];
      io.to(web_socket_id).emit('quizWeb',data);
    })
}) 


http.listen(8081,function(){
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
