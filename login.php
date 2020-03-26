<?php 
  include_once(__DIR__ . '/classes/user.php');
  include_once(__DIR__ . '/classes/db.php');
  
function canLogin($email,$password){
$conn = new mysqli('localhost','root','','phpsamen');
$email = $conn->real_escape_string($email); //DIT IS KANKER BELANGRIJK ALTIJD DOEN ANDERS SQL INJECTIE MOGELIJK
$query = "select * from users where email = '$email'";
$result = $conn->query($query);
$user = $result->fetch_assoc();
if(password_verify($password, $user['password'])){
	return true;
} else {
	return false;
}
}



// detecteer of er ge-submit werd
if(!empty ($_POST)){

// velden uitlezen in variabelen
$email = $_POST['email'];
$password = $_POST['password'];

// validatie: velden mogen niet leeg zijn
if(!empty($email) && !empty($password)){
// indien oke: login checken
if(canLogin($email,$password)){
	session_start();
	$_SESSION['user'] = $email;
	/*
	$salt = "fuckingkankerhomo";
	// check of login "net@flix.com" password ="12345"
	$cookieValue = $email . "," . md5($email.$salt);
	setcookie("loggedin",$cookieValue, time()+60*60*24*7); // die rare maaltafels zijn een week in seconden
	// redirect naar index.php
	// + onthouden dat user aangelogd is*/

	header("Location: index.php");
} else {
	$error = "Incorrect info";
}

	
} else {
	$error = "Email and password are required.";
	// indien leeg -> error genereren
}


}
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="Buddylogin">
        <div class="form form--login">
            <form action="" method="post">
                <h2 form__title>Sign In</h2>
 
                <?php if(isset($error)): ?>
                <div class="form__error">
                    <p><?php echo $error; ?></p>
                </div>
                <?php endif; ?>
 

                <div class="form__field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text">
                </div>
                <div class="form__field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password">
                </div>
 
                <div class="form__field">
                    <input type="submit" value="Sign in" class="btn btn--primary"> 
                    <input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
                </div>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>