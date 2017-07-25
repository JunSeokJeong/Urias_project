var express = require('express');
var router = express.Router();
var indexController = require('../controllers/indexController');

/* GET home page. */

router.get('/', indexController.index);
//device 토큰 전송

module.exports = router;
