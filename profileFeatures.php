<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	session_start();

	include(__DIR__."/classes/db.php");
	include_once(__DIR__ . '/classes/user.php'); 
	
	//var_dump($_SESSION['user']);
	
	if (!empty($_POST)) {
		//echo "test";

		$location = $_POST['location'];
		$course = $_POST['course'];
		$hobby = $_POST['hobby'];
		$extra = $_POST['extra'];
		
		//$email = $_SESSION['user']; (nodig om te laten sturen)

		$result = user::updateProfile($location,$course,$hobby,$extra,$email);

	}


	function profileUpdate( $field ){
		if (preg_match("/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/", $field)){
			return true;
		}
		return false;
	}

?><!DOCTYPE html>
<html>
    <head>  
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">	
		<title>Profile Settings</title>
    </head> 
	<body style="margin-left:20px;">      
		<h3>Update Profile Information</h3> 

	       <form method="post" action="">     
				<?php if(isset($error)): ?>
					<div class="form__error">
						<p><?php echo $error; ?></p>
					</div>
				<?php endif; ?>   
				    			
				<label>Location:</label><br> 
		         <input style="width:100px" type="text" name="location" placeholder="Waar woon je/ zit je op kot?" /><br> 

				<div class="dropdown">
					<label>Interesse in de richting IMD:</label><br> 
						<select name="course" id="course" >
							<option value="0">Kies</option>
							<option value="Voetbal">Development</option>
							<option value="Basketbal">Design</option>
							<option value="Gaming">Design & Development</option>
						</select>
				</div>

		        
		         <div class="dropdown">
					<label>Hobby:</label><br> 
						<select name="hobby" id="hobby">
							<option value="0">Kies</option>
							<option value="Voetbal">Voetbal</option>
							<option value="Basketbal">Basketbal</option>
							<option value="Gaming">Gaming</option>
							<option value="Films kijken">Films kijken</option>
						</select>
				</div>

		              
		         <div class="dropdown">
					<label>Extra:</label><br> 
						<select name="extra" id="extra">
							<option value="0">Kies</option>
							<option value="foodie">Ik ben een foodie</option>
							<option value="party">Ik vind een stevige party wel tof</option>
						</select>
				</div>
			        
			<input style="margin:2.5%;" type="submit" name="profileupdate" value="Update" />    <!-- button ipv input    --> 
		</form>    
	</body>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>

