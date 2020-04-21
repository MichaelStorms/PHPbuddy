<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("init.php");

if(isset($_SESSION['id']) && isset($_SESSION['user'])){
  $user_data = $user->find_user_by_id($_SESSION['id']);
  if($user_data ===  false){
      header('Location: logout.php');
      exit;
  }
}
else{
  header('Location: logout.php');
  exit;
}
// TOTAL REQUESTS
$get_req_num = $buddy->request_notification($_SESSION['id'], false);
// TOTLA FRIENDS
$get_frnd_num = $buddy->get_all_friends($_SESSION['id'], false);
// GET MY($_SESSION['id']) ALL FRIENDS
$get_all_friends = $buddy->get_all_friends($_SESSION['id'], true);


$buddy = Buddy::getAll();

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
</head>

<body>
<?php //include_once("nav.inc.php"); ?>
  <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <img src="profile_images/<?php echo $user_data->image; ?>" alt="Profile image">
            </div>
            <h1><?php echo  $user_data->firstname ." ". $user_data->lastname;?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="profile.php" rel="noopener noreferrer">Home</a></li>
                <li><a href="notifications.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                <li><a href="buddies.php" rel="noopener noreferrer" class="active">Friends<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="all_users">
            <h3>All friends</h3>
            <div class="usersWrapper">
                <?php
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="profile_images/'.$row->image.'" alt="Profile image"></div>
                                <div class="user_info"><span>'.$row->firstname ." ". $row->lastname.'</span>
                                <span><a href="user_profile.php?id='.$row->id.'" class="see_profileBtn">See profile</a></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>You have no friends!</h4>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
</body>

</html>