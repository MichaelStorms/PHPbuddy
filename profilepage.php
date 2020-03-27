<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . "/settings/settings.php");
include(__DIR__ . "/classes/db.php");
session_start();
//$conn = new mysqli(SETTINGS['db']['host'], SETTINGS['db']['user'], SETTINGS['db']['password'], SETTINGS['db']['db']);
$conn = Db::getConnection();

$_SESSION["id"] = 1;
$_SESSION["password"] = "123";
$_SESSION["email"] = "test@test.com";

$paswordDb = $_SESSION["password"];
$emailDb = $_SESSION["email"];


// image insert

if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
	$size = 2097152;
	$filetypes = array('jpg', 'jpeg', 'gif', 'png');
	if ($_FILES['avatar']['size'] <= $size) {
		$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

		if (in_array($extensionUpload, $filetypes)) {
			$route = __DIR__ . "/images/" . $_SESSION['id'] . "." . $extensionUpload;
			$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $route);
			if ($resultat) {
				$updateAvatar = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
				$updateAvatar->bindparam("ss", $_SESSION['id'], $_SESSION['id']);
				$updateAvatar->execute();
			} {
				$error = "Kon de file niet uploden";
			}
		} else {
			$error = "Het formaat van de file is niet tiegestaan. Het moet een formaat jpg, png of gif zijn.";
		}
	} else {
		$msg = "andere file grote of type";
	}

	if (!empty($_POST["description"])) {
		$description = $_POST['description'];
		$cleanDescription = htmlspecialchars($description);
		$updateAvatar = $conn->prepare("UPDATE users SET imgDescription = ? WHERE id = ?");
		$updateAvatar->bindparam("si", $cleanDescription, $_SESSION['id']);
		$updateAvatar->execute();
		echo "<h3>succes</h3>";
	} else {
		echo "<h3>de field is leeg</h3>";
	}
}



//pasword change

if (!empty($_POST['passwordOld'])) {
	$passwordNew = $_POST["passwordNew"];
	$passwordCheck = $_POST['passwordCheck'];
	if (!empty($_POST['passwordOld']) == $paswordDb) {
		if ($passwordNew == $passwordCheck) {
			$updateAvatar = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
			$updateAvatar->bindparam("si", $_POST['passwordNew'], $_SESSION['id']);
			$updateAvatar->execute();
			echo "<h3>succes</h3>";
		} else {
			echo "<h3>Wachtwoord is niet het zelfde</h3>";
		}
	} else {
		echo "<h3>doesnt work</h3>";
	}
}
//email change

if (!empty($_POST['emailOld'])) {
	$emailNew = $_POST['emailNew'];
	$emailCheck = $_POST['emailCheck'];
	if (!empty($_POST['emailOld']) === $emailDb) {
		if ($emailNew === $emailCheck) {
			$updateAvatar = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
			$updateAvatar->bindparam("si", $_POST['emailNew'], $_SESSION['id']);
			$updateAvatar->execute();
			echo "<h3>succes</h3>";
		} else {
			echo "<h3>email is niet het zelfde</h3>";
		}
	} else {
		echo "<h3>Niet het zelde email adres</h3>";
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
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<h2>change Profile pic</h2>
		<input type="file" name="avatar">
		<br>
		<h3>description</h3>
		<textarea name="description" cols="30" rows="10"></textarea>
		<h2>change password</h2>
		<p>old password</p>
		<input type="password" name="passwordOld">
		<p>new password</p>
		<input type="password" name="passwordNew">
		<p>repeat password</p>
		<input type="password" name="passwordCheck">
		<br>
		<h2>change Email</h2>
		<p>email old</p>
		<input type="text" name="emailOld" id="">
		<br>
		<p>email new</p>
		<input type="text" name="emailNew" id="">
		<br>
		<p>email check</p>
		<input type="text" name="emailCheck" id="">
		<br>


		<input type="submit" value="submit">
	</form>
</body>

</html>