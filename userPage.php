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
    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <?php include_once("nav.inc.php"); ?>
            </div>
        </div>
    </header>
    <div class="bg-light">
        <div class="container bg-light mt-3">
            <h1 class="text-dark p-3">Your profile</h1>
            <div class="container p-3">
                <div class="row">
                    <div class="col">
                        <img class="profile_image" src="images/<?php echo htmlspecialchars($profile[0]["image"]) ?>" alt="<?php echo htmlspecialchars($profile[0]["imgDescription"]) ?>" style="width: 100%">
                    </div>
                    <div class="col">
                        <h2 class="profile_name text-dark"><?php echo htmlspecialchars($profile[0]["firstname"]) . " " . htmlspecialchars($profile[0]["lastname"]); ?></h2>
                        <h3 class="text-dark">Interests = <?php echo $profile[0]["interests"] ?></h3>
                        <h3 class="text-dark">Hobby = <?php echo $profile[0]["hobby"] ?></h3>
                        <h3 class="text-dark">Extra = <?php echo $profile[0]["extra"] ?></h3>
                        <h3 class="text-dark">Lives in : <a class="text-dark" href="#"><?php echo htmlspecialchars($profile[0]["locatie"]) ?></a></h3>
                    </div>
                </div>


            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>