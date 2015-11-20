var passport = require('passport');
var googleStrategy =  require('passport-google-oauth').OAuth2Strategy;
var user = require('../models/user');
module.exports = function(passport) {
	var configAuth = require('./auth');
	 // used to serialize the user for the session
	    passport.serializeUser(function(user, done) {
	        done(null, user.id);
	    });

	    // used to deserialize the user
	    passport.deserializeUser(function(id, done) {
	        User.findById(id, function(err, user) {
	            done(err, user);
	        });
	    passport.use(new GoogleStrategy({

	        clientID        : configAuth.googleAuth.clientID,
	        clientSecret    : configAuth.googleAuth.clientSecret,
	        callbackURL     : configAuth.googleAuth.callbackURL,
	    },
    });
