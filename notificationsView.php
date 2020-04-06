<h1>Notifications</h1>

<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();

    include ("/notificationFunctions.php");
    $id = $_GET['id'];

    $query ="UPDATE `notifications` SET `status` = 'read' WHERE `id` = $id;";
    performQuery($query);

    $query = "SELECT * from `notifications` where `id` = '$id';";
    if(count(fetchAll($query))>0){
        foreach(fetchAll($query) as $i){
            if($i['type']=='like'){
                echo ucfirst($i['name'])." liked your post. <br/>".$i['date'];
            }else{
                echo "Some commented on your post.<br/>".$i['message'];
            }
        }
    }
    
?><br/>
<a href="notifications.php">Back</a>