var express = require('express');
var router = express.Router();
var indexController = require('../controllers/indexController');
var libraryController = require('../controllers/libraryController');

/* GET home page. */
router.get('/', indexController.index);

router.get('/rental',function(req,res){
//     res.header('Content-type','application/json');
//     res.header('Charset','utf8');
//     res.send(req.query.callback + '('+ JSON.stringify({a:[1,2,3]}) + ');');
// 	console.log('body: ' + JSON.stringify(req.body));
	libraryController.index(req, res);
})
module.exports = router;
