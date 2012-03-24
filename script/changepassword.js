$(document).ready(function(){

	$("#changePassword").validate({
		rules: {
		
			curPassword: {required: true},
			newPassword: {required: true, minlength: 8},
			confirmPassword: {equalTo: "#newPassword"},			
   			
		}
	});
	
	$("#changeItButton").bind("click", btnSubmitClick);
	
});

function btnSubmitClick()
{
	var newPassword = document.getElementById("newPassword");
	var curPassword = document.getElementById("curPassword");
	var comfPassword = document.getElementById("confirmPassword");
	
	var hdnPassword = document.getElementById("hPassword");
	var hcPassword = document.getElementById("hcPassword");

	hdnPassword.value = Sha1.hash(newPassword.value);
	hcPassword.value = Sha1.hash(curPassword.value);
	
	hdnPassword.setAttribute("name","hPassword");
	hcPassword.setAttribute("name","hcPassword");
	
	newPassword.removeAttribute("name");
	curPassword.removeAttribute("name");
	comfPassword.removeAttribute("name");
}