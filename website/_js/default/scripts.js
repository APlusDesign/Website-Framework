
/******************/
/* OnReady       */
/****************/

function startApplication() {
	// Base url for all your ajax calls
  	websiteFramework.BASE_URL = document.getElementsByTagName('base')[0].href;
  	// Local switch
	websiteFramework.LOCAL 		= $('#local-root').length;
	// User login, register, logout, contact controls
	websiteFramework.controls = userControls();
	// Fancy box set-up
	fancy_setup();
	// New windows on class '_blank'
	newWindow_setup();
	// View the website object
	console.log(websiteFramework)
}



/*******************/
/* New windows    */
/*****************/
function newWindow_setup() {
	var tmp = $("._blank");
	$.each(tmp, function(i, val) { 
		$(this).attr('target', '_blank').removeClass('_blank')
	});
}



/*******************/
/* Fancybox setup */
/*****************/
function fancy_setup() {
	$(".fancylink").fancybox({
		nextMethod : 'resizeIn',
		nextSpeed  : 250,
		prevMethod : false,
		beforeShow : function() {
			// Maybe edit the title?
		}
	});
}







/******************/
/* USER CONTROLS */
/****************/

function userControls () {

	// Login Button event + Login page actions
	var btnLogin = $('.btn-login');
	if(btnLogin.length) {
		btnLogin.fancybox({ 
			ajax : {
				type: 'GET',
				data: {
					ajax: 1
				}
			},
			afterShow : function() {
				new loginUser();
			}
		});
	}
	
	// Logout Button event + Logout actions
	var btnLogout = $('.btn-logout');
	if(btnLogout.length) {
		btnLogout.bind({
		 'click' : function(e){
			e.preventDefault(); 
			logoutUser();
		  }
		});
	}

	// Register Button event + Register page actions
	var btnRegister = $('.btn-register');
	if(btnRegister.length) {
		btnRegister.fancybox({
			ajax : {
				type: 'GET',
				data: {
					ajax: 1
				}
			},
			afterShow : function() {
				new registerUser();
			},
			afterClose: function() {
				// Do you need a redirect after login?
				// window.location.reload();
			}
		});	
	}

	// Contact Button event + Contact page actions
	var btnContact = $('.btn-contact');
	if(btnContact.length) {
		btnContact.fancybox({
			ajax : {
				type: 'GET',
				data: {
					ajax: 1
				}
			},
			afterShow : function() {
				new contact();
			}
		});	
	}
	
	return {
		'login'		: btnLogin,
		'logout'	: btnLogout,
		'register'	: btnRegister,
		'contact' 	: btnContact
	}
	
}




/*********************************************************/
/* Controls and actions for the AJAXIAN USER system 	*/
/*******************************************************/


/***********************/
/* Registering a user */ 

function registerUser (el, options) {
	
	var settings = {}

	this.options 	= jQuery.extend(settings, options);
	
	this.init = function(){
		this.getElements();
		this.setElements();
	},
	
	this.getElements = function(t){
		this.form 		= $('#registration');
		this.userName 	= $('#reg-username input');
		this.userPass 	= $('#reg-password input');
		this.userPass2 	= $('#reg-password2 input');
		this.userEmail 	= $('#reg-email input');
		this.wrapper 	= $('.register-action');
		// Remove the submit button in favor of a nicer button
		this.wrapper.find('input[type="submit"]').remove();
	},
	
	this.setElements = function(t){
		var obj = this;
		this.button = $("<button>")
			.html('<div></div><span>Register with us</span>')
			.addClass('framework-button large register-button')
			.click(function (e) { 
				e.preventDefault();		
				obj.regCheck();
				return false;
			});
		this.wrapper.append(this.button);
		this.error = new errorHelper(this.wrapper);
	},
	
	this.regCheck = function() {
		this.button.attr('disabled', 'disabled');
		this.overlay = new ajaxLoader('.fancybox-wrap');
		this.data = {	
			'username' 	: this.userName.val(),
			'password' 	: this.userPass.val(),
			'password2' : this.userPass2.val(),
			'email' 	: this.userEmail.val(),
			'flag'		: 'register'
		}
		this.save();	
	},	
	
	this.save = function() {
		var obj = this;
		var oCallback = function (response) {
			var res = response;
			obj.overlay.remove();
			if (res.errors) {
				obj.error.insertErrors(res);
				obj.button.attr('disabled', false);
			} else {
				$('.fancybox-wrap').find(".pre-window-wrap").html(res.html);
			}
		}
		$.getJSON(websiteFramework.BASE_URL+'ajax/', this.data, oCallback);
	}	
	
	this.init();
};



/****************/
/* Login users */

function loginUser (el, options) {
	
	var settings = {}

	this.options 	= jQuery.extend(settings, options);
	
	this.init = function(){
		this.getElements();
		this.setElements();
	},
	
	this.getElements = function(t){
		this.form 		= $('#login');
		this.userName 	= $('#reg-username input');
		this.userPass 	= $('#reg-password input');
		this.auto 		= $('#reg-auto input[name=auto]');
		this.wrapper 	= $('.login-action');
		// Remove the submit button in favor of a nicer button
		this.wrapper.find('input[type="submit"]').remove();
	},
	
	this.setElements = function(t){
		var obj = this;
		// Forgot password link
		// Dragons, attaches fancybox event everytime we open the login window..
		var btnForgot = $('.forgot-password');
		if(btnForgot.length) {
			btnForgot.fancybox({
				afterShow : function() {
					new forgotUser();
				}
			});	
		}
		// Submit login details button
		this.button = $("<button>")
			.html('<div></div><span>Login</span>')
			.addClass('framework-button large login-button')
			.click(function (e) {
				e.preventDefault();																																							
				obj.regCheck();
				return false;
			});
		this.wrapper.append(this.button);
		this.error = new errorHelper(this.wrapper);	
	},
	
	this.regCheck = function() {
		this.button.attr('disabled', 'disabled');
		this.overlay = new ajaxLoader('.fancybox-wrap');
		this.data = {	
			'username' 	: this.userName.val(),
			'password' 	: this.userPass.val(),
			'auto'		: this.auto.val(),
			'flag'		: 'login'
		}
		this.save();	
	},	
	
	this.save = function() {
		
		var obj = this;
		var oCallback = function (response) {
				var res = response;
				obj.overlay.remove();
				if (res.errors) {
					obj.error.insertErrors(res);
					obj.button.attr('disabled', false);
				} else {
					$.fancybox.close()
					if (res.updates) {
						// Successful login action
						//console.log(res);
						window.location = '/user';
						// You might want to take them to the user page after login, I typically do not want that to happen so I just refresh the page.
					} else {
						alert("Error: Not sure what went wrong with your request, please refresh the page");
					}
				}
			
		}
		$.getJSON(websiteFramework.BASE_URL+'ajax/', this.data, oCallback);
	}	
	
	this.init();
};


/**************************/
/* Forgot password users */

function forgotUser (el, options) {
	
	var settings = {}

	this.options 	= jQuery.extend(settings, options);
	
	this.init = function(){
		this.getElements();
		this.setElements();
		return this;
	},
	
	this.getElements = function(t){
		this.form 		= $('#forgot');
		this.userEmail 	= $('#forgot-email input');
		this.wrapper 	= $('.forgot-action');
		// Remove the submit button in favor of a nicer button
		this.wrapper.find('input[type="submit"]').remove();
	},
	
	this.setElements = function(t){
		var obj = this;
		this.button = $("<button>").html('<div></div><span>Reset</span>').addClass('framework-button large forgot-button').click(function (e) {
			e.preventDefault();																																							
			obj.regCheck();
			return false;
		});
		this.wrapper.append(this.button);
		this.error = new errorHelper(this.wrapper);	
	},
	
	this.regCheck = function() {
		this.button.attr('disabled', 'disabled');
		this.overlay = new ajaxLoader('.fancybox-wrap');
		this.data = {	
			'email' 	: this.userEmail.val(),
			'flag'		: 'forgot'
		}
		this.save();	
	},	
	
	this.save = function() {
		var obj = this;
		var oCallback = function (response) {
			var res = response;
			obj.overlay.remove();
			if (res.errors) {
				obj.error.insertErrors(res);
				obj.button.attr('disabled', false);
			} else {
				$('.fancybox-wrap').find(".pre-window-wrap").html(res.html);
			}
		}
		$.getJSON(websiteFramework.BASE_URL+'ajax/', this.data, oCallback);
	}	
	
	return this.init();
};


/*******************/
/* Log a user out */

var logoutUser = function (o, parent) {
	var options = o;
	new ajaxLoader('body');
	$.ajax({
		type	: "POST",
		cache	: false,
		url		: websiteFramework.BASE_URL+'ajax/',
		data	: {'flag':'logout', 'ajax': 1},
		complete : function(data) {
			window.location.reload();
		}
	});
}



/*******************/
/* Contact script */

function contact (el, options) {
	
	var settings = {}

	this.options 	= jQuery.extend(settings, options);
	
	this.init = function(){
		this.getElements();
		this.setElements();
	},
	
	this.getElements = function(t){
		this.form 		= $('#contact');
		this.name 		= $('#contact-name');
		this.email 		= $('#contact-email');
		this.phone 		= $('#contact-phone');
		this.message 	= $('#contact-message');
		this.wrapper = $('.contact-action');
		// Remove the submit button in favor of a nicer button
		this.wrapper.find('input[type="submit"]').remove();
	},
	
	this.setElements = function(t){
		var obj = this;
		
		this.button = $("<button>").html('<div></div><span>Submit</span>').addClass('framework-button large contact-button').click(function (e) {
			e.preventDefault();																																							
			obj.formCheck();
			return false;
		});
		this.wrapper.append(this.button);
		this.error = new errorHelper(this.wrapper);	
	},
	
	this.formCheck = function() {
		this.button.attr('disabled', 'disabled');
		this.overlay = new ajaxLoader('.fancybox-wrap');
		this.data = {	
			'name' 		: this.name.val(),
			'email' 	: this.email.val(),
			'phone' 	: this.phone.val(),
			'message'	: this.message.val(),
			'flag'		: 'contact'
		}
		this.send();	
	},	
	
	this.send = function() {
		var obj = this;
		var oCallback = function (response) {
			var res = response;
			obj.overlay.remove();
			if (res.errors) {
				obj.error.insertErrors(res);
				obj.button.attr('disabled', false);
			} else {
				$('.fancybox-wrap').find(".pre-window-wrap").html(res.html);
			}
		}
		$.getJSON(websiteFramework.BASE_URL+'ajax/', this.data, oCallback);
	}	
	
	this.init();
};



/******************************/
/* Ajax forms error handling */

function errorHelper (el, options) {
	
	var settings = {}

	this.options 	= jQuery.extend(settings, options);
	
	this.init = function(){
		this.errorWrapper = $("<div>").addClass('error-wrap');
		this.parent.append(this.errorWrapper);
	},
	
	this.insertErrors = function(res) {
		var 
			obj = this,
			err = res.errors;
		obj.removeErrors();
		$.each(err, function(i, val) { 
			obj.insertError(val);
		});
	},
	
	this.insertError = function(val) {
		this.errorWrapper.append($("<p>").html(val).addClass('reg-error'));
	},
	
	this.removeErrors = function() {
		this.errorWrapper.find("p.reg-error").remove();
	}
	
	this.parent = el;
	if(this.parent) {
		this.init();
	}
};
	


/****************/
/* Ajax loader */
/**************/

function ajaxLoader (el, options) {
	// Becomes this.options
	var defaults = {
		bgColor 		: '#fff',
		duration		: 300,
		opacity			: 0.7,
		classOveride 	: false
	}
	this.options 	= jQuery.extend(defaults, options);
	this.container 	= $(el);
	
	this.init = function() {
		var container = this.container;
		// Delete any other loaders
		this.remove(); 
		// Create the overlay 
		var overlay = $('<div></div>').css({
			'background-color': this.options.bgColor,
			'opacity':this.options.opacity,
			'width':container.outerWidth(),
			'height':container.outerHeight(),
			'position':'absolute',
			'top':'0',
			'left':'0'
		}).addClass('ajax_overlay');
		// add an overiding class name to set new loader style 
		if (this.options.classOveride) {
			overlay.addClass(this.options.classOveride);
		}
		// insert overlay and loader into DOM 
		container.append(
			overlay.append(
				$('<div></div>').addClass('ajax_loader')
			).fadeIn(this.options.duration)
		);
	};
	
	this.remove = function(flag){
		var overlay = this.container.children(".ajax_overlay");
		if (overlay.length) {
			if(flag) {
				overlay.remove();
			} else {
				overlay.fadeOut(this.options.classOveride, function() {
					overlay.remove();
				});
			}
		}	
	}

	this.init();
}	


	
/*******************/
/* Helper Methods */
/*****************/

/* is empty object */
function isEmpty(object) {
	for(var i in object) { return true; }
	return false;
}

// transitions helper
(function ($, F) {
	F.transitions.resizeIn = function() {
		var previous = F.previous,
			current  = F.current,
			startPos = previous.wrap.stop(true).position(),
			endPos   = $.extend({opacity : 1}, current.pos);

		startPos.width  = previous.wrap.width();
		startPos.height = previous.wrap.height();

		previous.wrap.stop(true).trigger('onReset').remove();

		delete endPos.position;

		current.inner.hide();

		current.wrap.css(startPos).animate(endPos, {
			duration : current.nextSpeed,
			easing   : current.nextEasing,
			step     : F.transitions.step,
			complete : function() {
				F._afterZoomIn();

				current.inner.fadeIn("fast");
			}
		});
	};

}(jQuery, jQuery.fancybox));

