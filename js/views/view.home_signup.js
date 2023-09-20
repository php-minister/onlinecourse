/*
Name: 			View - Contact
Written by: 	Crivos - (http://www.crivos.com)
Version: 		1.0
*/

var Newsletter = {

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

		$("#newsletter_signup").validate({
			submitHandler: function(form) {

				$.ajax({
					type: "GET",
					url: "http://localhost/school/main/newsletter_signup",
					data: {
						"first_name": $("#newsletter_signup #first_name").val(),
						"last_name": $("#newsletter_signup #last_name").val(),						
						"email": $("#newsletter_signup #email").val()
					},
					dataType: "json",
					success: function (data) {	
						if (data.response == "success") {

							$("#contactSuccess").removeClass("hidden");
							$("#contactError").addClass("hidden");

							$("#newsletter_signup #first_name, #newsletter_signup #last_name, #newsletter_signup #email")
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
						else {

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
				first_name: {
					required: true
				},
				last_name: {
					required: true,
					
				},
				email: {
					required: true,
					email: true
				},
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

Newsletter.initialize();