var express = require('express'),
	app = express(),
	classroom = express(),
	student = express(),
	resource = express(),
	home = express(),
	session=require('express-session'),
	GoogleStrategy = require('passport-google-oauth').OAuth2Strategy,
	passport = require('passport'),
	PDFReader = require(__dirname+"/public/js/reader.js").PDFReader,
	PDFImage = require("pdf-image").PDFImage;

var http = require('http').Server(app);
var io = require('socket.io')(http);
app.use(express.static(__dirname + '/public'));
app.set('views', __dirname + '/views/www');
var expressHbs = require('express3-handlebars');

app.use(session({secret: 'supernova', saveUninitialized: true, resave: true}));
app.use(passport.initialize());
app.use(passport.session());
// Session-persisted message middleware
app.use(function(req, res, next){
  var err = req.session.error,
      msg = req.session.notice,
      success = req.session.success;

  delete req.session.error;
  delete req.session.success;
  delete req.session.notice;

  if (err) res.locals.error = err;
  if (msg) res.locals.notice = msg;
  if (success) res.locals.success = success;

  next();
});
app.engine('hbs', expressHbs({extname:'hbs'}));
app.set('view engine', 'hbs');

/*
Passport authen
*/
passport.use(new GoogleStrategy({  
        clientID: "266817110876-a777fba8d0sj93snj0b4l17cqfqc8v71.apps.googleusercontent.com",
        clientSecret: "GzypQrXM0V2hq4rO-gTBUkHD",
        callbackURL: "http://bksoict.ddns.net:3000/auth/google/callback/"
    },
    function(accessToken, refreshToken, profile, done) {
     	console.log(profile);
     	//Luu profile
     	return done(null,profile);
    }
));
passport.serializeUser(function(user, done) {  
    done(null, user.id);
});
passport.deserializeUser(function(id, done) {  
    // db.findUserById(id, function(err, user) {
        
    // });
	done(null, id);
});
//
app.use(express.static('public'));
app.get('/',ensureAuthenticated,function(req,res){
	res.render("home");
});
app.get('/index',function(req,res){
	res.render("index");
});
app.get('/btl',function(req,res){
	res.render('btl');
});
app.get('/login',function(req,res){
	if(!req.isAuthenticated())
		res.render('loginGoogle');
	else 
		res.redirect("/");
});
app.get('/group',function(req,res){
	res.render('group');
});
app.get('/classroom',function(req,res){
	res.render('class');
});

//Route for authentication
app.get('/auth/google', passport.authenticate('google',  
    { scope: ['https://www.googleapis.com/auth/userinfo.profile',
      'https://www.googleapis.com/auth/userinfo.email'] }),
    function(req, res){} // this never gets called
);
app.get('/auth/google/callback', passport.authenticate('google',  
    { successRedirect: '/', failureRedirect: '/login' }
));
function ensureAuthenticated(req, res, next) {  
    if (!req.isAuthenticated()) { return res.redirect('login'); }
    else return next();
    res.sendStatus(401);
}
//End route authentication
//Route service convert pdf to jpeg
app.get('/convert',function(req,res){

	pdfName = "CloudSim2010";
	pdfPath = __dirname+'/public/slides/CloudSim2010/CloudSim2010.pdf';
	imagePath = __dirname+'/public/slides/'+pdfName+'page-0';
    var pdfImage = new PDFImage(pdfPath);
    var pdfReader = new PDFReader(pdfPath);
    var allPage = 0;
 	pdfReader.on('ready',function(pdf){
 		allPage = pdf.getPages();
 		for(var i = 0;i<allPage;i++){
	 		pdfImage.convertPage(i).then(function (imagePath) {
		      console.log("Done");
		    }, function (err) {
		      res.send(err, 500);
		    });
	 	}
	 	res.json({result:true});
 	});
});
app.get('/slides',function(req,res){
	var name="CloudSim2010/CloudSim2010-";
	var length = 25;
	result = [];
	for(var i = 0;i<length;i++)
	{
		var tempName = name+i+".png";
		result.push(tempName);
	}
	res.json(result);
});
/*
	Socket io connection
*/
io.on('connection',function(socket){
	console.log("Listen 3000");
	socket.on('event',function(data){
		console.log(data);
		io.emit('event', data);
	});
	console.log('a user connected');
 	socket.on('disconnect', function(){
    	console.log('user disconnected');
  	});
  	socket.on('message',function(data){
  		socket.broadcast.emit("message",data);
  	});
  	socket.on('update',function(data){
  		socket.broadcast.emit("update",data);
  	});
});
var router = express.Router();
var fs = require('fs');
var server = http.listen(3000,function(){
	console.log("Listening");
});
//End socket connection
