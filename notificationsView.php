<h1>Notifications</h1>

<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();

    include_once(__DIR__ . "/notificationFunctions.php");
    $id = $_GET['id'];

  
    performQuery("UPDATE `notifications` SET `status` = 'read' WHERE `id` = '$id'");
    

    $query = "SELECT * from `notifications` where `id` = '$id'";
    if(count(fetchAll($query))>0){
        foreach(fetchAll($query) as $i){
            if($i['type']=='like'){
                echo ucfirst($i['name'])." liked your post. <br/>".$i['date'];
            }else if($i['type']=='❤'){
                echo ucfirst($i['name'])." ❤ your post. <br/>".$i['date'];
            }
            else if($i['type']=='😂'){
                echo ucfirst($i['name'])." 😂 your post. <br/>".$i['date'];
            }else if($i['type']=='😮'){
                echo ucfirst($i['name'])." 😮 your post. <br/>".$i['date'];
            }else if($i['type']=='😥'){
                echo ucfirst($i['name'])." 😥 your post. <br/>".$i['date'];
            }else if($i['type']=='😡'){
                echo ucfirst($i['name'])." 😡 your post. <br/>".$i['date'];
            }
            else{
                echo "Some commented on your post.<br/>".$i['message'];
            }
        }
    }
    
?><br/>
<a href="notifications.php">Back</a>