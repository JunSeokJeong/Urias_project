var fs = require('fs');




module.exports.index=function(req, res, next) {
  res.render('index', { title: 'Express' });
}








// module.exports.file=function(req, res, next) {
//   fs.readFile('../../public/test.txt','utf8',function(err,data){
//       console.log(data);
//   })
// }