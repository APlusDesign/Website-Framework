
/******************/
/* USER CONTROLS */
/****************/

function userControls () {

	// Login Button event + Login page actions
	var btnLogin = $('.btn-login');
	if(btnLogin.length) {
		btnLogin.fancybox({
			afterShow : function() {
				new loginUser();
			}
		});
	}
	
	// Register Button event + Register page actions
	var btnRegister = $('.btn-register');
	if(btnRegister.length) {
		btnRegister.fancybox({
			afterShow : function() {
				new registerUser();
			},
			afterClose: function() {
				// Do you need a redirect after login?
	    		// window.location.reload();
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
	
	
	// Contact Button event + Contact page actions
	var btnContact = $('.btn-contact');
	if(btnContact.length) {
		btnContact.fancybox({
			afterShow : function() {
				new contact();
			}
		});	
	}
	
}


/*********************************************************/
/* Controls and actions for the USER system 			*/
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
			.html('<div></div><span>Register with us<span>')
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
		this.overlay = new ajaxLoader('#fancybox-content');
		this.data = {	
			'username' 	: this.userName.attr('value'),
			'password' 	: this.userPass.attr('value'),
			'password2' : this.userPass2.attr('value'),
			'email' 	: this.userEmail.attr('value'),
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
				$('#fancybox-content').find("#pre-window-wrap").html(res.html);
			}
		}
		$.getJSON(siteObj.BASE_URL+'ajax/switch.php', this.data, oCallback);
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
		var btnForgot = $('.forgot-password');
		if(btnForgot.length) {
			btnForgot.fancybox({
				onComplete : function() {
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
		this.overlay = new ajaxLoader('#fancybox-content');
		this.data = {	
			'username' 	: this.userName.attr('value'),
			'password' 	: this.userPass.attr('value'),
			'auto'		: this.auto.attr('value'),
			'flag'		: 'login'
		}
		this.save();	
	},	
	
	this.save = function() {
		
		this.container = $('#fancybox-content').children(":first");
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
						window.location.reload();
						// You might want to take them to the user page after login, I typically do not want that to happen so I just refresh the page.
					} else {
						alert("Error: Not sure what went wrong with your request, please refresh the page");
					}
				}
			
		}
		$.getJSON(siteObj.BASE_URL+'ajax/switch.php', this.data, oCallback);
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
		this.overlay = new ajaxLoader('#fancybox-content');
		this.data = {	
			'email' 	: this.userEmail.attr('value'),
			'flag'		: 'forgot'
		}
		this.save();	
	},	
	
	this.save = function() {
		this.container = $('#fancybox-content').children(":first");
		var obj = this;
		var oCallback = function (response) {
			var res = response;
			obj.overlay.remove();
			if (res.errors) {
				obj.error.insertErrors(res);
				obj.button.attr('disabled', false);
			} else {
				$('#fancybox-content').find("#pre-window-wrap").html(res.html);
			}
		}
		$.getJSON(siteObj.BASE_URL+'ajax/switch.php', this.data, oCallback);
	}	
	
	this.init();
};


/*******************/
/* Log a user out */

var logoutUser = function (o, parent) {
	var options = o;
	$.ajax({
		type	: "POST",
		cache	: false,
		url		: siteObj.BASE_URL+'ajax/switch.php',
		data	: {'flag':'logout'},
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
		this.message 	= $('#contact-message');
		this.wrapper = $('.contact-action');
		// Remove the submit button in favor of a nicer button
		this.wrapper.find('input[type="submit"]').remove();
	},
	
	this.setElements = function(t){
		var obj = this;
		
		this.button = $("<button>").html('<div></div><span>Contact us</span>').addClass('framework-button large contact-button').click(function (e) {
			e.preventDefault();																																							
		  	obj.formCheck();
		  	return false;
		});
		this.wrapper.append(this.button);
		this.error = new errorHelper(this.wrapper);	
	},
	
	this.formCheck = function() {
		this.button.attr('disabled', 'disabled');
		this.overlay = new ajaxLoader('#fancybox-content');
		this.data = {	
			'name' 		: this.name.attr('value'),
			'email' 	: this.email.attr('value'),
			'message'	: this.message.attr('value'),
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
				$('#fancybox-content').find("#pre-window-wrap").html(res.html);
			}
		}
		$.getJSON(siteObj.BASE_URL+'ajax/switch.php', this.data, oCallback);
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
		var obj = this,
		err = res.errors;
		obj.removeErrors();
		$.each(err, function(i, val) { 
			obj.insertError(val);
		});
	},
	
	this.insertError = function(val) {
		this.errorWrapper.append($("<span>").html(val).addClass('reg-error'));
	},
	
	this.removeErrors = function() {
		var arr = this.errorWrapper.find("span");
		$.each(arr, function(i, o) { 
			$(o).remove();
		});
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
			'width':container.width(),
			'height':container.height(),
			'position':'absolute',
			'top':'0px',
			'left':'0px',
			'z-index':1000
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

