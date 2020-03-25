<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . "/settings/setting.php");
include(__DIR__ . "/classe/db.php");
session_start();
$conn = new mysqli(SETTINGS['db']['host'], SETTINGS['db']['user'], SETTINGS['db']['password'], SETTINGS['db']['db']);

$_SESSION["id"] = 1;
$_SESSION["password"] = "123";
$_SESSION["email"] = "test@test.com";

$paswordDb = $_SESSION["password"];
$emailDb = $_SESSION["email"];

if (isset($_POST['avatar'])) {
	$size = 2097152;
	$filetypes = array('jpg', 'jpeg', 'gif', 'png');
	$avatar = $_POST['avatar'];


	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
	$uploadOk = 1;
	$sizeFile = getimagesize($_FILES['avatar']);

	if($sizefile !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	
	
	if ($sizefile <= $size) {
		if (isset($_SESSION['id'])) {
			if (isset($_POST['avatar'])) {
				$updateAvatar = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
				$updateAvatar->bind_param("si", $_SESSION['id'], $_SESSION['id']);
				$updateAvatar->execute();
			}
		}else {
			echo "File is te groot of foute file type";
		}

	} else {
		echo "lol";
	}


	if (!empty($_POST['passwordOld'])) {
		$passwordNew = $_POST["passwordNew"];
		$passwordCheck = $_POST['passwordCheck'];
		if (!empty($_POST['passwordOld']) == $paswordDb) {
			if ($passwordNew == $passwordCheck) {
				$updateAvatar = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
				$updateAvatar->bind_param("si", $_POST['passwordNew'], $_SESSION['id']);
				$updateAvatar->execute();
				echo "<h3>succes</h3>";
			} else {
				echo "<h3>Wachtwoord is niet het zelfde</h3>";
			}
		} else {
			echo "<h3>doesnt work</h3>";
		}
	}

	if (!empty($_POST['emailOld'])) {
		$emailNew = $_POST['emailNew'];
		$emailCheck = $_POST['emailCheck'];
		if (!empty($_POST['emailOld']) === $emailDb) {
			if ($emailNew === $emailCheck) {
				$updateAvatar = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
				$updateAvatar->bind_param("si", $_POST['emailNew'], $_SESSION['id']);
				$updateAvatar->execute();
				echo "<h3>succes</h3>";
			} else {
				echo "<h3>email is niet het zelfde</h3>";
			}
		} else {
			echo "<h3>Niet het zelde email adres</h3>";
		}
	}


	// if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
	// 	$size = 2097152;
	// 	$filetypes = array('jpg', 'jpeg', 'gif', 'png');
	// 	if ($_FILES['avatar']['size'] <= $size) {
	// 		$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

	// 		if (in_array($extensionUpload, $filetypes)) {
	// 			$route = __DIR__ . "images/" . $_SESSION['id'] . "." . $extensionUpload;
	// 			$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $route);
	// 			if ($resultat) {
	// 				 $updateAvatar = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
	// 				 $updateAvatar -> bind_param("ss",$_SESSION['id'] . "." . $extensionUpload, $_SESSION['id']);
	// 				 $updateAvatar->execute();
	// 			} {
	// 				$error = "Kon de file niet uploden";
	// 			}
	// 		} else {
	// 			$error = "Het formaat van de file is niet tiegestaan. Het moet een formaat jpg, png of gif zijn.";
	// 		}
	// 	} else {
	// 		$msg = "andere file grote of type";
	// 	}
	// }
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
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h2>change Profile pic</h2>
		<input type="file" name="avatar">
		<br>
		<h2>change password</h2>
		<p>old password</p>
		<input type="password" name="passwordOld">
		<p>new password</p>
		<input type="password" name="passwordNew">
		<p>repeat password</p>
		<input type="password" name="passwordCheck">
		<br>
		<h2>change Email</h2>
		<p>email change</p>
		<input type="text" name="emailOld" id="">
		<br>
		<p>email change</p>
		<input type="text" name="emailNew" id="">
		<br>
		<p>email change</p>
		<input type="text" name="emailCheck" id="">
		<br>


		<input type="submit" value="submit">
	</form>
</body>

</html>