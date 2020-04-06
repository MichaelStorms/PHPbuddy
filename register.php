<?php

include_once(__DIR__ . "/classes/db.php");
include_once(__DIR__ . "/classes/user.php");

session_start();

 if(!empty($_POST)){
     try{

    $user = new User();
    $user->setFirstname($_POST["firstname"]);
    $user->setLastname($_POST["lastname"]);
    $user->setEmail($_POST["email"]);
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirmation = $_POST["password_confirmation"];
    $email = trim($email);
    $domain = explode("@", $email);
    $domain = $domain[(count($domain)-1)];
    $whitelist = array('student.thomasmore.be');



    if( !empty($firstname) && !empty($lastname) && !empty($email) && in_array($domain,$whitelist) ){
        /*$sql_e = $conn->query("SELECT * FROM users WHERE email='$email'");
        $res_e = mysqli_query($conn, $sql_e);*/
        
        $emailcheck = User::checkDouble($email);
        // var_dump($emailcheck);
        if(count($emailcheck) > 0){
            $error = "Sorry... email already taken"; 
        }else{
            if(!empty($password) && $password === $passwordConfirmation ){

                $password = password_hash($password,PASSWORD_DEFAULT,["cost" => 16]);

                $user->setPassword($password);
                session_start();
                $_SESSION["user"] = $email;
                header("location: /../profileFeatures.php");
    
                $user->save();
                /*$query = "INSERT INTO `users`(`firstname`,`lastname`,`email`, `password`) VALUES ('$firstname','$lastname','$email','$password')";
                $results = $conn->query($query);*/
            }
            else{
                $error = "password cannot be empty";
            }
        }
       
    }else{
        $error = "email cannot be empty and/or you dont use your school email";
    }
    
}
catch(\Throwable $th){
    $error = $th->getMessage();
}}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Buddy App</title>
  </head>
  <body>
    	<div class="phpBuddyLogin phpBuddyLogin--register">
		<div  style=" margin:2.5%;" class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign up for an account</h2>

				<?php if( isset($error) ): ?>
				<div class="form__error">
					<p>
						<?php echo $error; ?>
					</p>
				</div>
				<?php endif; ?>
				<div class="form__field">
					<label for="firstname">Firstname</label>
					<input type="text" id="firstname" name="firstname">
				</div>	
                <div class="form__field">
					<label for="lastname">Lastname</label>
					<input type="text" id="lastname" name="lastname">
				</div>
				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email" placeholder="r123456@student.thomasmore.be" style="width:250px;">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

                <div class="form__field">
					<label for="password_confirmation">Confirm your password</label>
					<input type="password" id="password_confirmation" name="password_confirmation">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign me up!" class="btn btn--primary" style=" margin:2.5%; border-radius:5px; border:1px solid; background-color:forestgreen;">	
				</div>
			</form>
        </div>
    
    <!--     Home -->
    <div class ="homebutton" style="margin:2.5%; ">
        <button onclick="window.location.href = './index.php';" style="border-radius: 5px; margin: 5px; background-color:lightskyblue">Home</button>   
    </div>

	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>