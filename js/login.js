$(document).ready(function() {
			
	// resize right menu to correct height
	//viewport_h = ($(window).height()-$('#header').outerHeight());
	//main_h = $('#main').outerHeight();
	//$('#right-menu').height(Math.max(viewport_h,main_h));

	//window height
	window_height = ($(window).height());
	window_width = ($(window).width());

	$('#login-container').css("left",(window_width/2)-300);
	$('#login-container').css("top",(window_height/2)-140);
	$('#top-login').css("height",(window_height/2)-40);
	$('#bottom-login').css("height",(window_height/2)+40);
		
	$('#user').mouseover(function() {
		if(this.value=="username") {
			this.value="";
			this.focus();
		}
	});

	$('#user').mouseout(function() {
		if(this.value == "") {
			this.value="username";
			this.blur();
		}
	});

	$('#pass').mouseover(function() {
		if(this.value=="password") {
			this.value="";
			this.focus();
		}
	});

	$('#pass').mouseout(function() {
		if(this.value == "") {
			this.value="password";
			this.blur();
		}
	});
	
});
	

