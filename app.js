var express = require('express'),
	app = express(),
	classroom = express(),
	student = express(),
	resource = express(),
	home = express(),
	session=require('express-session'),
	GoogleStrategy = require('passport-google-oauth').OAuth2Strategy,
	passport = require('passport');
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

var router = express.Router();
var fs = require('fs');
var server = app.listen(3000,function(){
	console.log("Listening");
});
/*
Passport authen
*/
passport.use(new GoogleStrategy({  
        clientID: "266817110876-a777fba8d0sj93snj0b4l17cqfqc8v71.apps.googleusercontent.com",
        clientSecret: "GzypQrXM0V2hq4rO-gTBUkHD",
        callbackURL: "http://localhost:3000/auth/google/callback"
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
	if(!req.isAuthenticated())
		res.render('loginGoogle');
	else 
		res.redirect("/");
});
app.get('/group',function(req,res){
	res.render('group');
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
    if (req.isAuthenticated()) { return next(); }
    res.sendStatus(401);
}
//End route

