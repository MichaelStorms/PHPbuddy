<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("init.php");
include("loginCheck.inc.php");


if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
	$size = 2097152;
	$filetypes = array('jpg');

	try {
		$user = new User();
		if ($_FILES['avatar']['size'] <= $size) {
			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

			if (in_array($extensionUpload, $filetypes)) {
				$image = $user_data->id . "." . $extensionUpload;
				$route = __DIR__ . "/images/" . $image;
				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $route);

				if ($resultat) {
					$user->setImage($image);
					$user->userUpdateImage();
					$error = '<h3>foto geupload </h3>';
					$succesUploadImage = $image;
				}
			} else {
				$error = "<h3>file size of type is niet goed</h3>";
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
			$error = '<h3>description updated</h3>';
		} else {
			$error = "<h3>description niet gelukt </h3>";
		}
	} catch (\Throwable $th) {
		$error = $th->getMessage();
	}
}
// //pasword change



if (!empty($_POST['passwordOld'])) {
	$passwordOld = $_POST['passwordOld'];
	if (!empty($_POST['passwordNew'])) {
		if (!empty($_POST['passwordCheck'])) {
			if ($user->passwordCheck($user_data->email, $passwordOld)) {
				try {
					$user = new User();
					if (!empty($_POST['passwordNew']) == !empty($_POST['passwordCheck'])) {
						$password = $_POST['passwordNew'];

						$password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 16]);
						$user->setPassword($password);
						$user->userUpdatePassword();
						$error = '<h3>wachtwoord geweizigd</h3>';
					} else {
						$error = "<h3>Wachtwoord is niet het zelfde</h3>";
					}
				} catch (\Throwable $th) {
					$error = $th->getMessage();
				}
			} else {
				$error = "<h3>Oud wachtoord klopt niet</h3>";
			}
		} else {
			$error = "<h3>De Herhaal nieuw wachtwoord moet ingevuld zijn</h3>";
		}
	} else {
		$error = "<h3>De nieuwe wachhtwoord is niet ingevuld</h3>";
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

					$error = "<h3>Email is veranderd</h3>";
				}
			} else {
				$error = '<h3>EmailCheck</h3>';
			}
		} catch (\Throwable $th) {
			$error = $th->getMessage();
		}
	} else {
		$error = '<h3>Email is niet het zelfde</h3>';
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>change profile</title>
</head>

<body>
	<header>
		<div class="navbar navbar-dark bg-dark box-shadow">
			<div class="container d-flex justify-content-between">
				<?php include_once("nav.inc.php"); ?>
			</div>
		</div>
	</header>
	<div class="container">
		<?php if (isset($error)) : ?>
			<div class="form__error">
				<?php echo $error; ?>
			</div>
		<?php endif; ?>

		<form class="form-group bg-light p-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" style="margin-top: 2%;">
			<div class="row " style="width: 100%">
				<div class="col">
					<h2>Verander profiel foto</h2>
					<small>Moet jpg formaat zijn</small>
					<input class="form-control-file" type="file" name="avatar">
					<br>
					
					<textarea class="form-control" name="description" rows="9" placeholder="Foto beschrijving"></textarea>
				</div>
				<div class="col">
					<img src="images/<?php echo $user_data->image ?>" alt="profile picture of <?php echo  $user_data->firstname . " " . $user_data->lastname; ?>" style="width: 100%">
					<p><?php echo $user_data->imgDescription ?></p>
				</div>
			</div>

			<div>
				<h2>Verander wachtwoord</h2>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Oud wachtwoord</label>
					<div class="col-sm-10">
						<input type="password" name="passwordOld" class="form-control" placeholder="Oud wachtwoord">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nieuw wachtwoord</label>
					<div class="col-sm-10">
						<input type="password" name="passwordNew" class="form-control" placeholder="Nieuw wachtwoord">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Herhaal nieuw wachtwoord</label>
					<div class="col-sm-10">
						<input type="password" name="passwordCheck" class="form-control" placeholder="Herhaal wachtwoord">
					</div>
				</div>

			</div>
			<div>
				<h2>Verander Email</h2>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Oude email adres</label>
					<div class="col-sm-10">
						<input type="text" name="emailOld" class="form-control" placeholder="email@example.com">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nieuwe email adres</label>
					<div class="col-sm-10">
						<input type="text" name="emailNew" class="form-control" placeholder="email@example.com">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Herhaal nieuwe email adres</label>
					<div class="col-sm-10">
						<input type="text" name="emailCheck" class="form-control" placeholder="email@example.com">
					</div>
				</div>
			</div>

			<div style="width: 50%; margin:auto;">
				<input class="btn btn-outline-dark" type="submit" value="Submit" style="width: 100%;  text-align: center;">
			</div>
			
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>