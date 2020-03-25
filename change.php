<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . "/settings/setting.php");
include(__DIR__ . "/classe/db.php");
session_start();
$conn = new mysqli(SETTINGS['db']['host'], SETTINGS['db']['user'], SETTINGS['db']['password'], SETTINGS['db']['db']);

// if (!empty($_POST)) {
//     $image = $_POST['image'];
//     $conn = new mysqli(SETTINGS['db']['host'], SETTINGS['db']['user'],SETTINGS['db']['password'],SETTINGS['db']['db']);



//      $sql = "SELECT * FROM users id";
//      $result= mysqli_query($conn, $sql);
//      $query = "INSERT INTO users(image) VALUES('$image')";
// }
$_SESSION["id"] = 1;
$_SESSION["password"] = "lol";

$test = $_SESSION["password"];

if (isset($_SESSION['id'])) {
	// $requser = $conn->prepare('SELECT * FROM users WHERE id = ?');
	// $requser -> bind_param("s", $_SESSION['id']);
	// $requser->execute();
	// $user = $requser->fetch();
	// print_r($requser);

	if (isset($_POST['avatar'])) {
		$updateAvatar = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
		$updateAvatar->bind_param("si", $_SESSION['id'], $_SESSION['id']);
		$updateAvatar->execute();
	}
	var_dump($test);
	if (!empty($_POST['passwordOld']) == $test) {
		
		if (!empty($_POST['passwordNew']) === !empty($_POST['passwordCheck'])) {
			$updateAvatar = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
			$updateAvatar->bind_param("si", $_POST['passwordNew'], $_SESSION['id']);
			$updateAvatar->execute();
			echo "succes";
		}else {
			echo "<h3>Wachtwoord is niet het zelfde</h3>";
		}
	}else {
		echo "<h3>doesnt work</h3>";
	}

	// if(!empty($_POST['password']) === !empty($_POST['passwordcheck'])) {
	// 	$updateAvatar = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
	// 	$updateAvatar->bind_param("si", $_POST['password'], $_SESSION['id']);
	// 	$updateAvatar->execute();

	// } else{
	// 	echo "<h3>Wachtwoord is niet het zelfde</h3>";
	// }


	// 	if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
	// 		$size = 2097152;
	// 		$filetypes = array('jpg', 'jpeg', 'gif', 'png');
	// 		if ($_FILES['avatar']['size'] <= $size) {
	// 			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

	// 			if (in_array($extensionUpload, $filetypes)) {
	// 				$route = __DIR__ . "images/" . $_SESSION['id'] . "." . $extensionUpload;
	// 				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $route);
	// 				if ($resultat) {
	// 					 $updateAvatar = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
	// 					 $updateAvatar -> bind_param("ss",$_SESSION['id'] . "." . $extensionUpload, $_SESSION['id']);
	// 					 $updateAvatar->execute();
	// 				} {
	// 					$error = "Kon de file niet uploden";
	// 				}
	// 			} else {
	// 				$error = "Het formaat van de file is niet tiegestaan. Het moet een formaat jpg, png of gif zijn.";
	// 			}
	// 		} else {
	// 			$msg = "andere file grote of type";
	// 		}
	// 	}
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
		<input type="file" name="avatar">
		<br>
		<h2>password change</h2>
		<p>old password</p>
		<input type="password" name="passwordOld">
		<p>new password</p>
		<input type="password" name="passwordNew">
		<p>repeat password</p>
		<input type="password" name="passwordCheck">
		<br>
		<p>email change</p>
		<br>
		<input type="text" name="email" id="">


		<input type="submit" value="submit">
	</form>
</body>

</html>