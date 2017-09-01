

var dbConnect = require('../models/dbConnection');

var bookListQuery  = "select * from book_lists where b_no = ";
var studyListQuery = "select * from aduinoPaths where id = ";
var quizListQuery  = "select * from aduinoquizPaths where id = ";

module.exports.library=function(req, res, next) {

  
  var book_number = req.query.bookNumber;
  var book_name = req.query.bookName;
  console.log(book_number);
  console.log(book_name);
  //var result;
  dbConnect.bookList(bookListQuery,book_number,book_name,req,res);
  
      
  //     console.log(send_array);
  //     res.header('Content-type','application/json');
  //     res.header('Charset','utf8');
  //});  
//   res.header('Content-type','application/json');
//   res.header('Charset','utf8');
//   console.log(send_array[0]);
//   res.send(req.query.callback + '('+ JSON.stringify({a:send_array}) + ');');
}
module.exports.study=function(req, res, next) {

  
  var id   = req.query.id;
  var path = req.query.path;
  console.log(id);
  console.log(path);
  dbConnect.studyList(studyListQuery,id,req,res);
  
}
//점자 퀴즈 요청
module.exports.quiz=function(req, res, next) {

  
  var id   = req.query.id;
  var path = req.query.path;
  console.log(id);
  console.log(path);
  dbConnect.quizList(quizListQuery,id,req,res);
  
}