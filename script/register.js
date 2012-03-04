$(document).ready(function(){
	/*
	jQuery.validator.setDefaults({
		debug: true,
		success: "valid"
	});;*/

	jQuery.validator.addMethod("student_id", function( value, element ) {
		return this.optional(element) || /^[aA]\d{8}$/.test(value);
	}, "Your student id must begin with an 'A' and be followed by eight digits.");

	$("#registration").validate({
		rules: {
			fname : {required: true},
			lname : {required: true},
		
			passwordRegister: {required: true, minlength: 8},
			passwordConfirm: {equalTo: "#passwordRegister"},
		
			studentID: {
				student_id: true,
				required: true
			},
		
			email: {
      				required: true,
      				email: true
   			},
			emailConfirm: {equalTo: "#email"},
   			
   			agree: "required"
   			
		}
	});
	
});
