<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include("init.php");
include("loginCheck.inc.php");
include("classes/Filter.php");

$filter = new Filter();
$email = $_SESSION["user"];

if (!empty($_POST)) {
	//echo "test";
	try {



		$locatie = $_POST['locatie'];
		$course = $_POST['course'];
		$hobby = $_POST['hobby'];
		$extra = $_POST['extra'];
		$class = $_POST['class'];
		$friend = $_POST['buddy'];

		if (!empty($locatie) || !empty($hobby) || !empty($course) || !empty($extra) || !empty($class) || !empty($friend)) {

			//echo "succes";
			$user->setLocatie($_POST["locatie"]);
			$user->setCourse($_POST["course"]);
			$user->setHobby($_POST["hobby"]);
			$user->setExtra($_POST["extra"]);
			$user->setClass($_POST["class"]);
			$user->setBuddy($_POST["buddy"]);

			$user->updateProfile();
		} else if (!empty($locatie) || !empty($hobby) || !empty($course) || !empty($extra)) {

			$user->setLocatie($_POST["locatie"]);
			$user->setCourse($_POST["course"]);
			$user->setHobby($_POST["hobby"]);
			$user->setExtra($_POST["extra"]);
			$user->updateProfileNoClassBuddy();
		} else {
			//echo "niet succes";

		}
	} catch (\Throwable $th) {
		$error = $th->getMessage();
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"">
	<script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
	</script>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Profile Settings</title>
</head>

<body>
	<header>
		<div class="navbar navbar-dark bg-dark box-shadow">
			<div class="container d-flex justify-content-between">
				<?php include_once("nav.inc.php"); ?>
			</div>
		</div>
	</header>
	<div class="container bg-light p-3">
		<h3>Update Profile Information</h3>
		<form method="post" action="">

			<?php if (isset($error)) : ?>
				<div class="form__error">
					<p><?php echo $error; ?></p>
				</div>
			<?php endif; ?>
			<div class="form-group">
				<label>Locatie:</label><br>
				<input class="form-control" style="width:30%" type="text" name="locatie" placeholder="Waar woon je/ zit je op kot?" />
			</div>
			<div class="dropdown form-group row">
            <label class="col-sm-2 col-form-label">Wat is je richting:</label>
            <div class="col-sm-10">
              <select class="form-control" name="course" id="course">
              <?php if (!empty(Filter::getInterests($email)[0]["interests"])){ ?>
                <option class="border border-info" value="<?php echo Filter::getInterests($email)[0]["interests"] ?>"><?php echo Filter::getInterests($email)[0]["interests"] ?></option>
              <?php }else{ ?>
                <option class="border border-info" value="">kies</option>
              <?php } ?>
                <?php foreach ($coursesList as $course) : ?>
                  <option value="<?php echo $course ?>"><?php echo $course ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="dropdown form-group row">
            <label class="col-sm-2 col-form-label">wat zijn je hobbies:</label>
            <div class="col-sm-10">
              <select class="form-control" name="hobby" id="hobby">
        <?php if(!empty(Filter::getHobby($email)[0]["hobby"])){ ?>
               <option class="border border-info" value="<?php echo Filter::getHobby($email)[0]["hobby"]; ?>"><?php echo Filter::getHobby($email)[0]["hobby"]; ?></option>
        <?php }else{ ?>
                <option class="border border-info" value="">Kies</option>
        <?php } ?>
                <?php foreach ($hobbyList as $hobby) : ?>
                  <option value="<?php echo $hobby ?>"><?php echo $hobby ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="dropdown form-group row">
            <label class="col-sm-2 col-form-label">extra:</label>
            <div class="col-sm-10">
              <select class="form-control" name="extra" id="extra">
             <?php if(!empty(Filter::getExtra($email)[0]["extra"])){ ?>
                <option class="border border-info" value="<?php echo Filter::getExtra($email)[0]["extra"]; ?>"><?php echo Filter::getExtra($email)[0]["extra"]; ?></option>
             <?php } else{ ?>
                <option class="border border-info" value="">kies</option>
               <?php } ?>
                <?php foreach ($extraList as $extra) : ?>
                  <option value="<?php echo $extra ?>"><?php echo $extra ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
		  </div>
		  
			<div class="dropdown form-group row">
				<label class="col-sm-2 col-form-label">Welke klas zit je in:</label><br>
				<div class="col-sm-10">
				<select class="form-control" name="class" id="class">
				<?php if(!empty(Filter::getClass($email)[0]["class"])){ ?>
                <option class="border border-info" value="<?php echo Filter::getClass($email)[0]["class"]; ?>"><?php echo Filter::getClass($email)[0]["class"]; ?></option>
             <?php } else{ ?>
                <option class="border border-info" value="">kies</option>
               <?php } ?>
					<option class="border border-info" value="1IMD">1IMD</option>
					<option class="border border-info" value="2IMD">2IMD</option>
					<option class="border border-info" value="3IMD">3IMD</option>
				</select>
			</div>
			</div>

			<div class="dropdown form-group row">
				<label class="col-sm-2 col-form-label">Zoek je een buddy of wil je een buddy onder hoede nemen:</label><br>
				<div class="col-sm-10">
				<select class="form-control" name="buddy" id="buddy" style="width: 30%">
					<option class="border border-info" value="BuddySearcher">Ik zoek een buddy</option>
					<option class="border border-info" value="BuddyHolder">Ik wil een buddy onder mijn hoede</option>
				</select>
			</div>
			</div>
			<input class="btn btn-outline-dark" style="margin-top:2%; width:30%;" type="submit" name="profileupdate" value="Update" />
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>