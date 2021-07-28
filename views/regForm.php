<?php
include '../operations/login_operations.php';

$username = $fname = $lname = $gender = $birthday = $Religion = $email = $password = $presentAddress = $permenentAddress = $personalWebsiteLink = $phone = "";
$passwordErr = $usernameErr =  $fnameErr = $lnameErr = $genderErr = $birthdayErr = $successfulErr = $ReligionErr = $presentAddressErr = $emailErr = $phoneErr = $permenentAddressErr = $personalWebsiteLinkErr = $passwordErr =  $message = "";
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$fname = htmlspecialchars($_POST['fname']);
	$lname = htmlspecialchars($_POST['lname']);
	if (!empty($_POST['gender']))
		$gender = htmlspecialchars($_POST['gender']);
	$birthday = htmlspecialchars($_POST['birthday']);
	$Religion = htmlspecialchars($_POST['Religion']);
	$email = htmlspecialchars($_POST['email']);
	$permenentAddress = htmlspecialchars($_POST['permanent_address']);
	$presentAddress = htmlspecialchars($_POST['present_address']);
	$phone = htmlspecialchars($_POST['phone']);
	$personalWebsiteLink = htmlspecialchars($_POST['personal_web_link']);
	$password = htmlspecialchars($_POST['pwd']);
	$username = htmlspecialchars($_POST['Username']);


	if (empty($fname)) {
		$fnameErr = "First name cannot be empty!";
		$flag = true;
	}

	if (empty($lname)) {
		$lnameErr = "Last Name cannot be empty!";
		$flag = true;
	}

	if (empty($gender)) {
		$genderErr = "Gender Cant be empty!";
		$flag = true;
	}

	if (empty($birthday)) {
		$birthdayErr = "Birthday can not be empty!";
		$flag = true;
	}

	if (empty($Religion)) {
		$ReligionErr = "Religion can not be empty!";
		$flag = true;
	}

	if (empty($email)) {
		$emailErr = "Email can not be empty!";
		$flag = true;
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$message = "Invalid email format";
		$flag = true;
	}

	if (empty($phone)) {
		$phoneErrr = "phone can not be empty!";
		$flag = true;
	}

	if (empty($permenentAddress)) {
		$permenentAddressErr = "permenent address can not be empty!";
		$flag = true;
	}

	if (empty($presentAddress)) {
		$presentAddressErr = "present address error can not be empty!";
		$flag = true;
	}

	if (empty($personalWebsiteLink)) {
		$personalWebsiteLinkErr = "personl website link can not be empty!";
		$flag = true;
	}



	if (empty($username)) {
		$usernameErr = "User name can not be empty!";
		$flag = true;
	}

	if (empty($password)) {
		$passwordErr = "Password can not be empty!";
		$flag = true;
	}

	if (!$flag) {

		$user = new User();

		$user->setFirstName($fname);
		$user->setLastName($lname);
		$user->setGender($gender);
		$user->setBirthDay($birthday);
		$user->setReligion($Religion);
		$user->setEmail($email);
		$user->setPhone($phone);
		$user->setPresentAddress($presentAddress);
		$user->setPermenentAddress($permenentAddress);
		$user->setPersonalWebsiteLink($personalWebsiteLink);
		$user->setPassword($password);
		$user->setUserName($username);

		//debugPrint($_POST);
		//debugPrint($user);

		saveLoginData($user);



		$successfulErr = "successfully registered ";
	}
}
?>


<form id="form" method="post">
    <fieldset>
        <legend>
            <h2>Registration Form:</h2>
        </legend>

        <label for="fname">First name:</label>
        <input type="text" id="fname" name="fname" required><br><br>

        <label for="lname">Last name:</label>
        <input type="text" id="lname" name="lname" required><br><br>

        <label for="gender">Gender:</label>

        <input type="radio" id="gender" name="gender" value="Male" required>
        <label for="male">Male</label>

        <input type="radio" id="female" name="gender" value="female" required>
        <label for="female">Female</label><br><br>

        <label for="birthday">DOB:</label>
        <input type="date" id="birthday" name="birthday" required><br><br>


        <label for="Religion">Religion:</label>
        <select name="Religion" id="Religion">
            <option value="ISLAM">ISLAM</option>
            <option value="saab">CHRISTIANITY</option>
            <option value="mercedes">HINDUISM</option>
            <option value="audi">BUDDHISM</option>
        </select>
        <br><br>



    </fieldset>

    <fieldset>
        <legend>Contact Information:</legend>


        <b><label for="present_address">Present Address: </label></b>&nbsp;&nbsp;
        <textarea id="present_address" name="present_address">

        </textarea><br><br>

        <b><label for="permanent_address">Permanent Address: </label></b>&nbsp;&nbsp;&nbsp;
        <textarea id="permanent_address" name="permanent_address">

        </textarea><br><br>


        <label for="phone"> phone:</label>
        <input type="tel" id="phone" name="phone"><br><br>


        <label for="email"> email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="personal_web_link">Personal Website Link:</label>
        <input type="personal_web_link" id="personal_web_link" name="personal_web_link">
        <br><br>


    </fieldset>


    <fieldset>



        <legend>Contact Information:</legend>


        <br><br>


        <label for="Username">Username:</label>
        <input type="text" id="Username" name="Username" ><br><br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required>

        <p id="errormsg"></p>


    </fieldset>

    <input type="submit" value="Submit">

    <script>
    document.querySelector('#form').addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Entered fetch function");
        var xhttp = new XMLHttpRequest();
        var username, password;
        var fname, lname, gender, birthday, email;
        

        xhttp.onreadystatechange = function() {
			console.log("Inside xhttp onreadystatechange func");
            if (this.readyState == 4 && this.status == 200) {
                fname = document.getElementById("fname").innerHTML;
                lname = document.getElementById("lname").innerHTML;
                gender = document.getElementById("gender").innerHTML;
                birthday = document.getElementById("birthday").innerHTML;
                username = document.getElementById("Username").innerHTML;
                password = document.getElementById("pwd").innerHTML;
                email = document.getElementById("email").innerHTML;

                if (username == null || username == "") {
                    document.getElementById("errormsg").innerHTML = "Invalid user name";
                } else if (passward == null || passward == "") {
                    document.getElementById("errormsg").innerHTML = "Invalid passwaerd";
                } else if (passward == null || fname == "") {
                    document.getElementById("errormsg").innerHTML = "Invalid fname";
                } else if (passward == null || lname == "") {
                    document.getElementById("errormsg").innerHTML = "Invalid lname";
                } else if (passward == null || gender == "") {
                    document.getElementById("errormsg").innerHTML = "Invalid gender";
                } else if (passward == null || birthday == "") {
                    document.getElementById("errormsg").innerHTML = "Invalid birthday";
                } else if (passward == null || email == "") {
                    document.getElementById("errormsg").innerHTML = "Invalid email";
                } else {
					window.location.replace("loginForm.php");
                }
            }
        };

        xhttp.open("POST", "regForm.php", true);
        xhttp.send();
        


    });
    </script>








</form>