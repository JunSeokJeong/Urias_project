//파일 읽기 컨트롤러
var fileReadController = require('./fileReadController');


//점자 교육
module.exports.index=function(req, res, next) {
  
  fileReadController.study(req, res);
  
}
//퀴즈목록 추가해야함
module.exports.quiz=function(req, res, next) {
       
  fileReadController.quiz(req, res);
  
}