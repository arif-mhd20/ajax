<?php
include '../operations/login_operations.php';


$password = $username = "";
$passwordErr = $usernameErr = $message = "";
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $username = htmlspecialchars($_POST['Username']);
    $password = htmlspecialchars($_POST['pwd']);

    if (empty($username)) {
        $usernameErr = "User name can not be empty!";
        $flag = true;
    }
    if (empty($password)) {
        $passwordErr = "Password can not be empty!";
        $flag = true;
    }
    if (!$flag) {

        $loginInfo = getLoginData($username, $password);


        if($loginInfo){
            header("Location: welcome_page.php");
        }
        else{
            debugPrint("Login failed!!!");
        }
        //debugPrint($loginInfo);

        /*
        $size = count($loginInfo);

        for ($x = 0; $x < $size; $x++) {
            if ($loginInfo[$x]->getUserName() == $username && $loginInfo[$x]->getPassword() == $password) {
                session_start();
                if (isset($_SESSION["username"])) {
                    unset($_SESSION["username"]);
                }
                if (isset($_SESSION["profile"])) {
                    unset($_SESSION["profile"]);
                }

                $_SESSION["username"] = $username;
                $_SESSION["profile"] = json_encode($loginInfo[$x]);


                

                return;
            }
        }

        $message = "Log-in failed!";
        */
    }
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">




    <fieldset>
        <legend>Login Form:</legend>

        <label for="Username">Username:</label>
        <input type="text" id="Username" name="Username" required><br><br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required>




    </fieldset><br>
    <input style="padding-left:0em" type="submit" value="Log In">
</form>