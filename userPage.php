<?php
include("init.php");
include("loginCheck.inc.php");
$email = $_SESSION["user"];
$profile = $user->getUser($email);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <div>
    <img class="profile_image" src="<?php echo $profile[0]["image"] ?>" alt="<?php echo $profile[0]["imgDescription"] ?>">
    <p class="profile_name"><?php echo $profile[0]["firstname"] . " " . $profile[0]["lastname"]; ?></p>
    <div>
        <p>interests = <?php echo $profile[0]["interests"] ?></p>
        <p>hobby = <?php echo $profile[0]["hobby"] ?></p>
        <p>extra = <?php echo $profile[0]["extra"] ?></p>
    </div>
    <p>lives in : <a href="#"><?php echo $profile[0]["locatie"] ?></a></p>
    </div>
</body>
</html>