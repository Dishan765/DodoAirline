//var nameErr = (emailErr = FnameErr = LnameErr = passwordErr = true);

function printError(elemId, hintMsg) {
	document.getElementById(elemId).innerHTML = hintMsg;
}

function checkNameIllegalChar(obj) {
	//check for illegal characters
	//accept letters and spaces only
	var regex = /^[a-zA-Z\s]+$/;
	if (regex.test(obj) === false) {
		printError("FNameErr", "Name contails illegal characters");
		return false;
	}
	return true;
}

function checkName() {
	//value property of text field
    var name = document.getElementById("fname").value;
    
	//var name = document.contactForm.fname.value;

	//check if name is blank
	if (name.length == 0) {
		//alert("Name cannot be blank");
		printError("FNameErr", "First Name cannot be blank");
		return false;
	} else {
		//if (!checkNameIllegalChar2(name)) return false;
		if (!checkNameIllegalChar(name)) {
			return false;
		} else {
			printError("FNameErr", "");
			return true;
		}
	}
}

function checkNameIllegalChar2(obj) {
	//check for illegal characters
	//accept letters and spaces only
	var regex = /^[a-zA-Z\s]+$/;
	if (regex.test(obj) === false) {
		printError("LNameErr", "Name contails illegal characters");
		return false;
	}
	return true;
}

function checkName2() {
	//value property of text field
	var name = document.getElementById("lname").value;
	//var name = document.contactForm.fname.value;

	//check if name is blank
	if (name.length == 0) {
		//alert("Name cannot be blank");
		printError("LNameErr", "Last Name cannot be blank");
		return false;
	} else {
		//if (!checkNameIllegalChar2(name)) return false;
		if (!checkNameIllegalChar2(name)) {
			return false;
		} else {
			printError("LNameErr", "");
			return true;
		}
	}
}

function checkEmail() {
	var Email = document.getElementById("email").value;

	if (Email.length == 0) {
		printError("emailErr", "Please enter your email address");
		return false;
	} else {
		// Regular expression for basic email validation
		//start with any number of non-whitespace characters
		//followed by @ symbol
		//followed by any number of non-whitespace characters
		//followed by a dot
		//then ending with any number of non-whitespace characters
		var regex = /^\S+@\S+\.\S+$/;
		if (regex.test(Email) === false) {
			printError("emailErr", "Please enter a valid email address");
			return false;
		} else {
			printError("emailErr", "");
			return true;
		}
	}
}

function checkPassword() {
	var pass = document.getElementById("pass").value;

	if (pass.length == 0) {
		printError("passwordErr", "Please enter a password");
		return false;
	} else {
		// To check a password between 6 to 20 characters
		// which contain at least one numeric digit,
		// one uppercase and one lowercase letter
        var regex = /^^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{4,}$$/;
		if (regex.test(pass) === false) {
			// printError(
			// 	"passwordErr",
			// 	"Password must be between 6 to 20 characters,contain at least one numeric digit,one uppercase and one lowercase letter"
            // );
            alert("Password must be greater than 4 characters,contain at least one numeric digit,one uppercase and one lowercase letter,one special character")
			return false;
		} else {
			printError("passwordErr", "");
			return true;
		}
	}
}

function validateForm() {
	//if checkName() is false then validateForm() return false
    if (!checkName()) return false;
    
	if (!checkName2()) return false;

	if (!checkEmail()) return false;

	 if (!checkPassword()) return false;

	//alert("Sucess");
	return true;
}
