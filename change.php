<?php
    include(__DIR__ . "/settings/setting.php");
    include("/classe/db.php");

    $conn = new mysqli(SETTINGS['db']['host'], SETTINGS['db']['user'],SETTINGS['db']['password'],SETTINGS['db']['db']);
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
     }else{
        echo "Connected successfully";
     }
       
    if (!empty($_POST)) {
        $image = $_POST['image'];
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
    <form action="" method="post">
        <input type="file" name="image">
        <input type="submit" value="change">
    </form>
</body>

</html>