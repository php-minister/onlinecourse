/*
Name: 			View - Contact
Written by: 	Crivos - (http://www.crivos.com)
Version: 		1.0
*/

var Contact = {

	initialized: false,

	initialize: function() {

		if (this.initialized) return;
		this.initialized = true;

		this.build();
		this.events();

	},

	build: function() {

		this.validations();

	},

	events: function() {

		

	},

	validations: function() {

		$("#contactForm").validate({
			submitHandler: function(form) {

				$.ajax({
					type: "GET",
					url: "http://localhost/school/contact/contact_admin",
					data: {
						"name": $("#contactForm #name").val(),
						"email": $("#contactForm #email").val(),
						"subject": $("#contactForm #subject").val(),
						"message": $("#contactForm #message").val(),
						"captcha" : $("#contactForm #captcha").val()
					},
					dataType: "json",
					success: function (data) {	
						if (data.response == "success") {

							$("#contactSuccess").removeClass("hidden");
							$("#contactError").addClass("hidden");
							$("#contactErrorCaptcha").addClass("hidden");

							$("#contactForm #name, #contactForm #email, #contactForm #subject, #contactForm #message , #contactForm #captcha")
								.val("")
								.blur()
								.closest(".control-group")
								.removeClass("success")
								.removeClass("error");

							if(($("#contactSuccess").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#contactSuccess").offset().top - 80
								}, 300);								
							}
							
						} 
						else if(data.response == "captcha") {

							$("#contactErrorCaptcha").removeClass("hidden");
							$("#contactSuccess").addClass("hidden");
							$("#contactError").addClass("hidden");

							if(($("#contactError").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#contactError").offset().top - 80
								}, 300);								
							}

						}else {

							$("#contactError").removeClass("hidden");
							$("#contactSuccess").addClass("hidden");

							if(($("#contactError").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#contactError").offset().top - 80
								}, 300);								
							}

						}
					}

				});
			},
			rules: {
				name: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				subject: {
					required: true
				},
				message: {
					required: true
				},
				captcha: {
					required: true
				}
			},
			highlight: function (element) {
				$(element)
					.closest(".control-group")
					.removeClass("success")
					.addClass("error");
			},
			success: function (element) {
				$(element)
					.closest(".control-group")
					.removeClass("error")
					.addClass("success");
			}
		});

	}

};

Contact.initialize();