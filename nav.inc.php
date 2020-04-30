<?php

// TOTAL REQUESTS
$get_req_num = $buddy->request_notification($_SESSION['id'], false);
// TOTAL FRIENDS
$get_frnd_num = $buddy->get_all_friends($_SESSION['id'], false);

?>

<style>
    nav {
        width: 100%;
    }

    ul {
        width: 100%;
        justify-content: space-evenly;
    }

    li {
        width: 10%;
        margin: 0 5%;
        list-style: none;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="index.php">IMDBuddy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="index.php">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="notifications.php">Requests<span class="badge <?php
                                                                                        if ($get_req_num > 0) {
                                                                                            echo 'redBadge';
                                                                                        }
                                                                                        ?>"><?php echo $get_req_num; ?></span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link"href="chatPage.php">Chat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="buddies.php">Friends<span class="badge"><?php echo $get_frnd_num; ?></span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Profile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="userPage.php">Profile</a>
                    <a class="dropdown-item" href="profileFeatures.php">Hobby update</a>
                    <a class="dropdown-item" href="profilepage.php">Setting veranderinegen</a>
                </div>
            </li>
            <li><a class="nav-link"  href="logout.php" rel="noopener noreferrer">Logout</a></li>
        </ul>
    </div>


    </ul> -->
</nav>