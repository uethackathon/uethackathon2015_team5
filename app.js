var express = require('express'),
	app = express();
app.use(express.static(__dirname + '/public'));
app.set('views', __dirname + '/views/www');
var expressHbs = require('express3-handlebars');
app.engine('hbs', expressHbs({extname:'hbs'}));
app.set('view engine', 'hbs');

var router = express.Router();
var fs = require('fs');
var server = app.listen(3000,function(){
	console.log("Listening");
});
var clients = [];
app.use(express.static('public'));
app.get('/',function(req,res){
	res.render("home");
});
app.get('/index',function(req,res){
	res.render("index");
});
app.get('/btl',function(req,res){
	res.render('btl');
});
app.get('/login',function(req,res){
	res.render('login');
});

