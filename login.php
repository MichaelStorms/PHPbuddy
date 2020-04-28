<?php
include_once(__DIR__ . '/classes/user.php');
include_once(__DIR__ . '/classes/db.php');
include_once(__DIR__ . '/classes/Chat.php');

// detecteer of er ge-submit werd
if (!empty($_POST)) {

    // velden uitlezen in variabelen
    $email = $_POST['email'];
    $password = $_POST['password'];

    // validatie: velden mogen niet leeg zijn
    if (!empty($email) && !empty($password)) {
        // indien oke: login checken
        $user = new User();
        $chat = new Chat();
        if ($user->canLogin($email, $password)) {
            session_start();

            $_SESSION['user'] = $email;
            $userlist = $user->getUser($email);

            $id = $userlist[0]["id"];
            $_SESSION['id'] = $id;

            $chat->updateUserOnline($id, 1);

            $lastInsertId = $chat->insertUserLoginDetails($userlist[0]['id']);
            $_SESSION['login_details_id'] = $lastInsertId;
            header("Location: index.php");
        } else {
            $error = "Incorrect info";
        }
    } else {
        $error = "Email and password are required.";
    }
}
?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body style="height: 100%" class="bg-light">
    <div class="Buddylogin container ">
        <div class="form form--login text-center " style="margin-top: 5%">
            <form class="form-signin  rounded p-3 mb-2 bg-dark text-white" action="" style="width: 50%; margin:auto;" method="post">
                <h2 style="margin-top: 2%" form__title>Sign In</h2>

                <?php if (isset($error)) : ?>
                    <div class="form__error">
                        <p><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>


                <div class="form-group row" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10" style="">
                        <input id="email" class="form-control border border-info rounded" name="email" type="text">
                    </div>

                </div>

                <div class="form-group row" style=" width: 80%; margin:auto;padding-bottom:2%;">
                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                    <div class="col-sm-10">
                        <input id="password" class="form-control border border-info rounded" name="password" type="password">
                    </div>

                </div>

                <div class="form__field">
                    <input type="submit" value="Sign in" class="btn btn-outline-light" style="margin:2%; width:40%">
                    <br>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="rememberMe">
                        <label for="rememberMe" class="custom-control-label">Remember me</label>
                    </div>
                    <a class="nav-link" href="register.php" style="color:white; text-decoration: underline;">Register</a>

                </div>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>