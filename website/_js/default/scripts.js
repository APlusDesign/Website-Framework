
/******************/
/* OnReady       */
/****************/

function startApplication() {
	// Local switch
	websiteFramework.LOCAL = $('#local-root').length;
	// User login, register, logout, contact controls
	websiteFramework.controls = userControls();
	// Dom Helper
	domHelpers();
	// View the website framework object
	console.log(websiteFramework);
}




/********************************/
/* Special dom imporvements    */
/******************************/

function domHelpers() {
	// New windows on class '_blank'
	newWindows();
	// Fancybox links for images, galleries and normal links
	fancyLinks();
}


/*****************************/
/* New windows	 			*/
/***************************/

function newWindows() {
	$("._blank").each( function( index, element ){
	    $(this).attr('target', '_blank').removeClass('_blank');
	});
}


/*********************************/
/* Fancy Box links + Galleries  */
/*******************************/

function fancyLinks() {
	$(".fancylink").fancybox({
		nextMethod : 'resizeIn',
		nextSpeed  : 250,
		prevMethod : false,
		type : 'ajax',
		beforeLoad : function(){
			// If gallery link, remove ajax type
  			var el = $(this.element);
  			if(el.data('fancyboxGroup') == 'gallery') {
  				this.type = 'image';
  			}
 		},
		beforeShow : function() {
			// Normal images
			if(this.title != '') {
				this.title += ' - ';	
			}
			this.title += '<a class="btn-contact" href="/ajax?view=contact">Contact Us</a>';	
		},
		helpers : {
			overlay : {
				locked : false
			}
		}
	});
}






/*******************************/
/* Begin Framework ************/
/*****************************/



/******************/
/* USER CONTROLS */

function userControls () {

	// Logout Button event + Logout actions
	var btnLogout = $('.btn-logout');
	if(btnLogout.length) {
		btnLogout.click(function(e){
			e.preventDefault(); 
			logoutUser();
		});
	}

	
	// Add these buttons to the framework object
	return {
		'login'	 : fancyboxAjaxForm($('.btn-login'), function() {
			new formHelper({
				'formId': 'login',
				'buttonTxt': 'Login',
				'callback': function(res) {
					$.fancybox.close()
					if (res.updates) {
						// Successful login action
						window.location.reload();
					} else {
						alert("Error: Not sure what went wrong with your request, please refresh the page");
					}
				}
			});
			// Other actions
			var btnForgot = $('.forgot-password');
			if(btnForgot.length) {
				btnForgot.fancybox({
					type : 'ajax',
					afterShow : function() {
						new formHelper({
							'formId': 'forgot',
							'buttonTxt': 'Reset',
						});
					}
				});	
			}
		}),
		'register'	: fancyboxAjaxForm($('.btn-register'), function() {
			new formHelper({
				'formId': 'register',
				'buttonTxt': 'Register',
			});
		}),
		'contact' 	: fancyboxAjaxForm($('.btn-contact'), function() {
			new formHelper({
				'formId': 'contact'
			});
		}),
		'logout'	: btnLogout
	}
	
}




/*********************************************************/
/* Controls and actions for the AJAXIAN USER system 	*/
/*******************************************************/


/*******************************************/
/* Helper to set up the fancybox requests */

function fancyboxAjaxForm(btn, callback) {
	// Attach event to a btn, run a function after fancybox content is loaded
	if(btn.length) {
		btn.fancybox({
			'type': 'ajax',
			'ajax': {
				type: 'GET',
				data: {
					ajax: 1
				}
			},
			'afterShow': callback
		});	
	}
	return btn
}


/*********************/
/* Ajax form helper */

function formHelper (options) {
	
	var settings = {
		formId: '',
		buttonClass: '',
		buttonTxt: 'Submit',
		callback: function(res) {
			$(".window-wrapper").html(res.html);
		}
	}

	this.options 	= jQuery.extend(settings, options);
	
	this.init = function(){
		this.getElements();
		this.setElements();
	},
	
	this.getElements = function(t){
		this.form 		= $('#'+this.options.formId);
		this.submit 	= this.form.find('input[type="submit"]');
		this.wrapper 	= $('.actions');
	},
	
	this.setElements = function(t){
		var $this = this;
		this.submit.remove();
		this.button = $("<button class='framework-button "+this.options.formId+"-button'></button>")
		.html(this.options.buttonTxt)
		.addClass(this.options.buttonClass)
		.click(function (e) {
			e.preventDefault();		
			$this.formCheck();
			return false;
		});
		this.wrapper.append(this.button);
		this.error = new errorHelper(this.form);	
	},
	
	this.formCheck = function() {
		this.button.attr('disabled', 'disabled');
		this.overlay = new ajaxLoader('.fancybox-wrap');
		this.send();	
	},	
	
	this.send = function() {
		var $this = this;
		var oCallback = function (response) {
			var res = response;
			$this.overlay.remove();
			if (res.errors) {
				$this.error.insertErrors(res);
				$this.button.attr('disabled', false);
			} else {
				$this.options.callback(res);
			}
		}
		$.getJSON(this.form.attr('action'), this.form.serializeObject(), oCallback);
	}	
	
	this.init();
};



/*******************/
/* Log a user out */

var logoutUser = function () {
	new ajaxLoader('body');
	$.ajax({
		type	: "POST",
		cache	: false,
		url		: '/ajax/',
		data	: {'flag':'logout', 'ajax': 1},
		complete : function(data) {
			window.location.reload();
		}
	});
}



/******************************/
/* Ajax forms error handling */

function errorHelper (el, options) {
	
	var settings = {}

	this.options 	= jQuery.extend(settings, options);
	
	this.init = function(){
		this.errorWrapper = $("<div>").addClass('error-wrap');
		this.form.append(this.errorWrapper);
	},
	
	this.insertErrors = function(res) {
		var 
			$this = this,
			err = res.errors;
		this.removeErrors();
		$.each(err, function(i, val) { 
			$this.insertError(val);
			$this.displayError(i);
		});
	},
	
	this.insertError = function(val) {
		this.errorWrapper.append($("<p class='reg-error'></p>").html(val));
	},

	this.displayError = function(i) {
		var tmp = $('#'+i);
		if(tmp.length) {
			tmp.parent().addClass('error');
		}
	},
	
	this.removeErrors = function() {
		this.errorWrapper.find("p.reg-error").remove();
		this.form.find(".error").removeClass('error');
	}
	
	this.form = el;
	if(this.form.length) {
		this.init();
	}
};
	













/*******************/
/* Helpers 		  */
/*****************/



/*******************************************************************/
/* Serialises a forms input data into a json object for transport */

$.fn.serializeObject = function(){
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name]) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};	




/***********************/
/* transitions helper */

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





/****************/
/* Ajax loader */

function ajaxLoader (el, options) {

	var defaults = {
		bgColor         : '#fff',
		duration        : 300,
		opacity         : 0.7,
		classOveride    : false
	}
	this.options    = jQuery.extend(defaults, options);
	this.container  = $(el);
	
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
				$('<div></div>').addClass('imgSpinner icon-spin5')
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

