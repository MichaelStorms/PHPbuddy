<?php
    include(__DIR__ . "/settings/setting.php");
    include("/classe/db.php");
    
    

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