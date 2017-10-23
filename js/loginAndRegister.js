var xhr = createRequest();

function customerLogin()
{
	if(!validateLoginForm()){
		return;
	}
	
	var email = document.getElementById('email').value.trim();
	var password = document.getElementById('password').value;	
	var requestbody = "email=" + encodeURIComponent(email) 
					+ "&password=" + encodeURIComponent(password)
					+ "&action=login";
	if (xhr)
		createAsyncConectionWithCallBack(xhr, "php/login.php", "get", requestbody, redirectToBuyOnlinePage(document.getElementById("spanxhr")));
}

function validateLoginForm()
{
	var email = document.getElementById('email').value.trim();
	var password = document.getElementById('password').value.trim();
	var mailformat = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
	if(email.length  < 1 && !(mailformat.match(mailformat)))
	{
		document.registerForm.email.focus();
		alert('Please enter valid  Email Address');
		return false;
	}
	return true;
}

function redirectToBuyOnlinePage(elementToAppendOnCallBack)
{
	if (xhr.readyState == 4 && xhr.status == 200) 
	{
		if(xhr.responseText.trim() == 'success')
		{
			alert("You have sucessfully registered");
			elementToAppendOnCallBack.innerHTML = "<h3> Successfully logged in!, Now you will be redirected to Shopping Catalog page.. <h3>";
			setTimeout(function(){ window.location="buyonline.htm"; }, 0);
		}
		else
			elementToAppendOnCallBack.innerHTML = xhr.responseText;
	}
}

function managerLogin()
{
	var managername = document.getElementById('managername').value;
	var mpassword = document.getElementById('mpassword').value;	
	var requestbody = "managername=" + encodeURIComponent(managername) 
					 + "&mpassword=" + encodeURIComponent(mpassword);
	if (xhr)
		createAsyncConectionWithCallBack(xhr, "php/mlogin.php", "get", requestbody, enableProcessingAndListingMenuForManager(document.getElementById("spant")));
		//createAsyncConection(xhr, "php/mlogin.php", "get", requestbody, document.getElementById("spant"));
}

function enableProcessingAndListingMenuForManager(elementToAppendOnCallBack)
{
	if (xhr.readyState == 4 && xhr.status == 200) 
	{
		if(xhr.responseText.trim() == 'success')
		{
			var processing = document.getElementById("processing");
			var listing = document.getElementById("listing");
			processing.style.display = '';
			shoppingCatalog.style.display = '';
			listing.style.display = '';
			elementToAppendOnCallBack.innerHTML = "<h3> Successfully logged in!, Now you will be redirected to Processing Catalog page.. <h3>";
			setTimeout(function(){ window.location="processing.htm"; }, 0);
		}
		else
			elementToAppendOnCallBack.innerHTML = xhr.responseText;
	}
}

function validateRegistrationForm()
{
	
	
	var firstname = document.getElementById('firstname').value.trim();
	var lastname = document.getElementById('lastname').value.trim();
	var phoneNumber = document.getElementById('phoneNumber').value.trim();
	var password = document.getElementById('password').value.trim();
	var email = document.getElementById('email').value.trim();
	
	var letters = /^[A-Za-z]+$/;  
	
	if(firstname.length  < 1 && !(firstname.match(letters)))
	{
		document.registerForm.firstname.focus();
		alert('Invalid First Name');
		return false;
	} 
	
	if(lastname.length  < 1 && !(lastname.match(letters)))
	{
		document.registerForm.lastname.focus();
		alert('Invalid Last Name');
		return false;
	} 
	
	var mailformat = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
	if(email.length  < 1 && !(mailformat.match(mailformat)))
	{
		document.registerForm.email.focus();
		alert('Invalid Email Address');
		return false;
	}
	
	return true;
}

function register()
{
	if(!validateRegistrationForm()){
		return;
	}
	
	var firstname = document.getElementById('firstname').value.trim();
	var lastname = document.getElementById('lastname').value.trim();
	var phoneNumber = document.getElementById('phoneNumber').value.trim();
	var password = document.getElementById('password').value.trim();
	var email = document.getElementById('email').value.trim();

	var requestbody = "firstname=" + encodeURIComponent(firstname) 
					 + "&lastname=" + encodeURIComponent(lastname)
					 + "&phoneNumber=" + encodeURIComponent(phoneNumber)
					 + "&password=" + encodeURIComponent(password)
					 + "&email=" + encodeURIComponent(email);
	if (xhr)
		createAsyncConectionWithCallBack(xhr, "php/register.php", "get", requestbody, redirectToBuyOnlinePage(document.getElementById("spanxhr")));
}

function validatePasswordFields()
{
	var password = document.getElementById('password').value.toUpperCase().trim();
	var retypepassword = document.getElementById('retypepassword').value.toUpperCase().trim();

	if(password.length > 0 && retypepassword.length > 0 &&retypepassword!==password){
		alert('Passwords did not match!.. Please try again');
		document.registerForm.retypepassword.focus();
		return false;
	}
}

function validatePhoneNumber()
{
	var phoneNumber = document.getElementById('phoneNumber').value;
	phoneNumber = phoneNumber.replace(/\D/g,'');
	 var reg = /^\(?([0-9]{4})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
	var isValidPhoneNum = phoneNumber.length == 12 && reg.exec(phoneNumber);

	if(!isValidPhoneNum)
	{
		alert('Invalid Phone number, Please enter in this format:: 0d dddddddd');
		document.registerForm.phoneNumber.focus();
		return false;
	}
}