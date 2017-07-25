//파일 읽기 컨트롤러
var fileReadController = require('./fileReadController');

module.exports.index = function(req, res, next){
    
    fileReadController.library(req, res);
}
