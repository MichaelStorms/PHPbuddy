<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include("notificationFunctions.php");
include("requestFunctions.php");

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Document</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications
            <?php
            $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
            if (count(fetchAll($query)) > 0) {
            ?>
              <span class="badge badge-light"><?php echo count(fetchAll($query)); ?></span>
            <?php
            }
            ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <?php
            $query = "SELECT * from `notifications` order by `date` DESC";
            if (count(fetchAll($query)) > 0) {
              foreach (fetchAll($query) as $i) {
            ?>

                <a style="
                         <?php
                          if ($i['status'] == 'unread') {
                            echo "font-weight:bold;";
                          }
                          ?>
                         " class="dropdown-item" href="notificationsView.php?id=<?php echo $i['id'] ?>">
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
          </div>
        </li>
      </ul>
  </nav>
  <main role="main" class="container">

    <div class="starter-template">
      <h1>Bootstrap starter template</h1>
    </div>

    <div>
      <?php

      if (isset($_POST['submit'])) {
        $message = $_POST['message'];
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '', 'comment', '$message', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:notifications.php");
        }
      }

      ?>
      <form method="post" class="" style="padding:10px;">
        <input name="message" class="" type="text" placeholder="Message" style=" width:300px; height:200px; " required>
        <button name="submit" class="" type="submit">Submit</button>
      </form>
      <br>
      <?php

      if (isset($_POST['like'])) {
        $name = $_POST['name'];
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', 'like', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['lol'])) {
        $name = $_POST['name'];
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😂', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['heart'])) {
        $name = $_POST['name'];
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '❤', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['ooh'])) {
        $name = $_POST['name'];
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😮', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['sad'])) {
        $name = $_POST['name'];
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😥', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }
      if (isset($_POST['angry'])) {
        $name = $_POST['name'];
        $query = "INSERT INTO `notifications` (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', '😡', '', 'unread', CURRENT_TIMESTAMP)";
        if (performQuery($query)) {
          //header("location:index.php");
        }
      }

      ?>
      <form method="post" class="" style="padding:10px;">
        <input name="name" class="" type="text" placeholder="Name" style=" width:300px; height:200px;" required>
        <button name="like" class="" type="submit">Like </button>
        <button name="heart" class="" type="submit">❤</button>
        <button name="lol" class="" type="submit">😂</button>
        <button name="ooh" class="" type="submit">😮</button>
        <button name="sad" class="" type="submit">😥</button>
        <button name="angry" class="" type="submit">😡</button>
      </form>

      <br>
      <form method="post" action="">     
        <?php if (isset($error)) : ?>
          <div class="form__error">
            <p><?php echo $error; ?></p>
          </div>
          <?php endif; ?>   


          <img src="https://avataaars.io/?avatarStyle=Transparent&topType=LongHairStraight&accessoriesType=Blank&hairColor=Brown&facialHairType=Blank&clotheType=ShirtVNeck&clotheColor=PastelBlue&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Pale" height="100" width="100" alt="BuddyTo">
          <p id="name"><b>Julie</b></p>

          <div id="sending">
            <input type="submit" onclick="this.disabled=true;this.value='Request has been sent';this.form.submit();" class="button" name="send" value="Send Request" />
          </div>
      </form>

  </main><!-- /.container -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>