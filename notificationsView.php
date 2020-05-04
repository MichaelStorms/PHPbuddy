<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("init.php");
include_once("loginCheck.inc.php");

include_once(__DIR__ . "/notificationFunctions.php");
$id = $_GET['id'];


performQuery("UPDATE `notifications` SET `status` = 'read' WHERE `id` = '$id'");


$query = "SELECT * from `notifications` where `id` = '$id'";
if (count(fetchAll($query)) > 0) {
    foreach (fetchAll($query) as $i) {
        if ($i['type'] == 'like') {
            $liked = ucfirst($i['name']) . ' liked your post. <br/>' . $i['date'];
        } else {
            $comment = "Some commented on your post.<br/>" . $i['message'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container">
        <div class="text-center rounded p-3 mb-2 bg-light" style="width: 50%; margin:auto;margin-top:5%">
            <h1>Notifications</h1>
            <p><?php if (isset($liked)) : ?>

                    <div>
                        <?php echo $liked; ?>
                    </div>

                <?php endif; ?></p>
            <p><?php if (isset($comment)) : ?>

                    <div>
                        <?php echo $comment; ?>
                    </div>

                <?php endif; ?></p>

            <br />
            <a href="notifications.php">Back</a>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </div>
</body>



</html>