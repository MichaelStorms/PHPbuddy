<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("init.php");


if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
	$size = 2097152;
	$filetypes = array('jpg');

	try {
		$user = new User();
		if ($_FILES['avatar']['size'] <= $size) {
			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

			if (in_array($extensionUpload, $filetypes)) {
				$image = $_SESSION['user'] . "." . $extensionUpload;
				$route = __DIR__ . "/images/" . $image;
				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $route);

				if ($resultat) {
					$user->setImage($image);
					$user->userUpdateImage();
					echo 'foto geupload';
					$succesUploadImage = $image;
				}
			} else {
				echo "<h3>file size of type is niet goed</h3>";
			}
		}
	} catch (\Throwable $th) {
		$error = $th->getMessage();
	}
}

if (!empty($_POST['description'])) {
	try {
		$user = new User();
		if (!empty($_POST['description'])) {
			$description = $_POST['description'];

			
			$user->setDescription($description);
			$user->userUpdateDescription();
			echo 'description updated';
		} else {
			echo "<h3>description niet gelukt </h3>";
		}
	} catch (\Throwable $th) {
		$error = $th->getMessage();
	}
}
// //pasword change



if (!empty($_POST['esuserUpdateDescriptionOld'])) {
	try {
		$user = new User();
		if (!empty($_POST['passwordNew']) == !empty($_POST['passwordCheck'])) {
			$password = $_POST['passwordNew'];

			$password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 16]);
			$user->setPassword($password);
			$user->userUpdatePassword();
			echo 'wachtwoord geweizigd';
		} else {
			echo "<h3>Wachtwoord is niet het zelfde</h3>";
		}
	} catch (\Throwable $th) {
		$error = $th->getMessage();
	}
}

//email change
if (!empty($_POST['emailOld'])) {
	if ($_POST['emailOld'] == $_SESSION['user']) {
		try {
			$user = new User();

			$email = $_POST['emailNew'];
			if (!empty($email)) {
				if ($email == $_POST['emailCheck']) {
					$user->setEmail($email);
					$user->userUpdateEmail();
					$_SESSION['user'] = $email;

					echo "<h3>Email is veranderd</h3>";
				}
			} else {
				echo '<h3>EmailCheck</h3>';
			}
		} catch (\Throwable $th) {
			$error = $th->getMessage();
		}
	} else {
		echo '<h3>Email is niet het zelfde</h3>';
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>change profile</title>
</head>

<body>
<?php include_once("nav.inc.php"); ?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<h2>change Profile pic</h2>
		<input type="file" name="avatar">
		<br>
		<h3>description</h3>
		<textarea name="description" cols="30" rows="10"></textarea>
		<?php echo '<img src=" $succesUploadImage ">'; ?>
		
		<h2>change password</h2>
		<p>old password</p>
		<input type="password" name="passwordOld">
		<p>new password</p>
		<input type="password" name="passwordNew">
		<p>repeat password</p>
		<input type="password" name="passwordCheck">
		<br>
		<h2>change Email</h2>
		<p>old email</p>
		<input type="text" name="emailOld" id="">
		<br>
		<p>new email</p>
		<input type="text" name="emailNew" id="">
		<br>
		<p>email check</p>
		<input type="text" name="emailCheck" id="">
		<br>


		<input type="submit" value="submit">
	</form>
</body>

</html>