function validateEmail(InputText)
{
	# decide on a fromat on which u will validate 
	var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(InputText.value.match(mailFormat))
	{
		alert("You have entered a valid email address!");
		document.adminverify.ename.focus();
		return true;
	}
	else
	{
		alert("You have entered an invalid email address!");
		document.adminverify.ename.focus();
		return false; 
	}
}