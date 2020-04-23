<?php

// TOTAL REQUESTS
$get_req_num = $buddy->request_notification($_SESSION['id'], false);
// TOTAL FRIENDS
$get_frnd_num = $buddy->get_all_friends($_SESSION['id'], false);

?>
<style>
    nav{
        width: 100%;
    }
    ul{
        width: 100%;
        display : flex;
        justify-content:space-evenly;
    }
    li{
        width: 10%;
        margin: 0 5%;
    }
</style>
<nav class="navbar" >

            <ul >
                <li><a href="index.php" rel="noopener noreferrer">Home</a></li>
                <li><a href="notifications.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>

                <li><a href="buddies.php" rel="noopener noreferrer">Friends<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="userPage.php">Go to my profile.</a></li>

                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
