<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("init.php");
include("loginCheck.inc.php");

include("notificationFunctions.php");


// TOTAL REQUESTS
$get_req_num = $buddy->request_notification($_SESSION['id'], false);
// TOTAL FRIENDS
$get_frnd_num = $buddy->get_all_friends($_SESSION['id'], false);
$get_all_req_sender = $buddy->request_notification($_SESSION['id'], true);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PhpBuddy</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
  <header>
    <div class="navbar navbar-dark bg-dark box-shadow">
      <div class="container d-flex justify-content-between">
        <?php include_once("nav.inc.php"); ?>
      </div>
    </div>
  </header>



  <div class="dropdown float-left mt-3 position-fixed">
    <button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <a class="text-dark" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications
        <?php
        $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
        if (count(fetchAll($query)) > 0) { ?>
          <span class="badge badge-light"><?php echo count(fetchAll($query)); ?></span>
        <?php } ?>
      </a>
    </button>
    <div class="dropdown-menu"  aria-labelledby="dropdownMenu2">
      <button class="dropdown-item" type="button"><?php
                                                  $query = "SELECT * from `notifications` order by `date` DESC";
                                                  if (count(fetchAll($query)) > 0) {
                                                    foreach (fetchAll($query) as $i) {
                                                  ?>
            <a style="<?php if ($i['status'] == 'unread') {
                                                        echo 'font-weight:bold;';
                                                      } ?>" class="dropdown-item" href="notificationsView.php?id=<?php echo $i['id'] ?>">
              <small><i><?php echo date('F j, Y, g:i a', strtotime($i['date'])) ?></i></small><br />
              <?php

                                                      if ($i['type'] == 'comment') {
                                                      } else if ($i['type'] == 'like') {
                                                      }

              ?>
            </a>
            <div class="dropdown-divider"></div>
        <?php
                                                    }
                                                  } else {
                                                    echo "No Records yet.";
                                                  }
        ?>
      </button>

    </div>
  </div>

  <main role="main" class="container bg-light mt-3">


    <div>
      <?php

      if (isset($_POST['submit'])) {
        $message = htmlspecialchars($_POST['message']);
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '', 'comment', '$message', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:notifications.php");
        }
      }

      ?>
      <div class="p-3">
        <form method="post" class="">
          <input name="message" class="" type="text" placeholder="Message" style=" width:300px; height:200px; " required>
          <button name="submit" class="" type="submit">Submit</button>
        </form>
      </div>

      <br>
      <?php

      if (isset($_POST['like'])) {
        $name = htmlspecialchars($_POST['name']);
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', 'like', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }

      if (isset($_POST['lol'])) {
        $name = htmlspecialchars($_POST['name']);
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😂', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['heart'])) {
        $name = htmlspecialchars($_POST['name']);
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '❤', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['ooh'])) {
        $name =htmlspecialchars($_POST['name']);
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😮', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['sad'])) {
        $name = htmlspecialchars($_POST['name']);
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😥', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['angry'])) {
        $name = htmlspecialchars($_POST['name']);
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😡', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }

      ?>
      <form method="post" class="p-3">
        <input name="name" class="" type="text" placeholder="Name" style=" width:300px; height:200px;" required>
        <button name="like" class="" type="submit">Like </button>
        <button name="heart" class="" type="submit">❤</button>
        <button name="lol" class="" type="submit">😂</button>
        <button name="ooh" class="" type="submit">😮</button>
        <button name="sad" class="" type="submit">😥</button>
        <button name="angry" class="" type="submit">😡</button>
      </form>

      <br>


  </main><!-- /.container -->

  <!-- Vanaf hier friend request -->
  <div class="container bg-light mt-3">

    <div class="inner_profile p-3">
      <div class="img">
        <img src="images/<?php echo htmlspecialchars($user_data->image); ?>" alt="Profile image" style="width: auto; height:200px">
      </div>
      <h1><?php echo  htmlspecialchars($user_data->firstname) . " " . htmlspecialchars($user_data->lastname); ?></h1>
    </div>

    <div class="all_users p-3">
      <h3>All request senders</h3>
      <div class="usersWrapper">
        <?php
        if ($get_req_num > 0) {
          foreach ($get_all_req_sender as $row) {
            echo '<div class="user_box">
                                <div class="user_img"><img src="profile_images/' . htmlspecialchars($row->image) . '" alt="Profile image"></div>
                                <div class="user_info"><span>' . htmlspecialchars($row->firstname) . " " . htmlspecialchars($row->lastname) . '</span>
                                <span><a href="UserFriendProfile.php?id=' . htmlspecialchars($row->sender) . '" class="see_profileBtn">See profile</a></div>
                            </div>';
          }
        } else {
          echo '<h4>You have no friend requests!</h4>';
        }
        ?>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>