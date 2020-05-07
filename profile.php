<?php
require 'init.php';
if (isset($_SESSION['id']) && isset($_SESSION['user'])) {
    $user_data = $user->find_user_by_id($_SESSION['id']);
    if ($user_data ===  false) {
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    $all_users = $user->all_users($_SESSION['id']);
} else {
    header('Location: logout.php');
    exit;
}
// REQUEST NOTIFICATION NUMBER
$get_req_num = $buddy->request_notification($_SESSION['id'], false);
// TOTAL FRIENDS
$get_frnd_num = $buddy->get_all_friends($_SESSION['id'], false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  htmlspecialchars($user_data->firstname) . " " . htmlspecialchars($user_data->lastname); ?></title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <?php include_once("nav.inc.php"); ?>
            </div>
        </div>
    </header>
    <div class="profile_container container">

        <div class="inner_profile">
            <div class="img">
                <img src="images/<?php echo htmlspecialchars($user_data->image); ?>" alt="Profile image " style="width: 20%;">
            </div>
            <h1><?php echo  htmlspecialchars($user_data->firstname) . " " . htmlspecialchars($user_data->lastname); ?></h1>
        </div>

        <div class="all_users">
            <h3>All friends</h3>
            <div class="usersWrapper">
                <?php
                if ($all_users) {
                    foreach ($all_users as $row) {
                        echo '<div class="user_box">
                                <div class=""><img src="images/' . htmlspecialchars($row->image) . '" alt="Profile image"  style="width: 20%"></div>
                                <div class="user_info"><span>' . htmlspecialchars($row->firstname) . " " . htmlspecialchars($row->lastname) . '</span>
                                <span><a href="UserFriendProfile.php?id=' . $row->id . '" class="see_profileBtn">See profile</a></div>
                                <hr>
                            </div>';
                    }
                } else {
                    echo '<h4>There is no user!</h4>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>