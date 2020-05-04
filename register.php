<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once(__DIR__ . '/classes/user.php');
include_once(__DIR__ . '/classes/db.php');
if (!empty($_POST)) {
    try {

        $user = new User();
        $user->setFirstname($_POST["firstname"]);
        $user->setLastname($_POST["lastname"]);
        $user->setEmail($_POST["email"]);
        $user->setClass($_POST["klas"]);
        $user->setBuddy($_POST["buddy"]);
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConfirmation = $_POST["password_confirmation"];
        $email = trim($email);
        $domain = explode("@", $email);
        $domain = $domain[(count($domain) - 1)];
        $whitelist = array('student.thomasmore.be');



        if (!empty($firstname) && !empty($lastname) && !empty($email) && in_array($domain, $whitelist)) {
            /*$sql_e = $conn->query("SELECT * FROM users WHERE email='$email'");
        $res_e = mysqli_query($conn, $sql_e);*/

            $emailcheck = User::checkDouble($email);
            // var_dump($emailcheck);
            if (count($emailcheck) > 0) {
                $error = "Sorry... email already taken";
            } else {
                if (!empty($password) && $password === $passwordConfirmation) {
                    
                    $password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 16]);

                    $user->setPassword($password);

                
                    
                        header("location: thankYou.php");
                    
                    $user->save();
                } else {
                    $error = "Password cannot be empty";
                }
            }
        } else {
            $error = "Email cannot be empty and/or you dont use your school email";
        }
    } catch (\Throwable $th) {
        $error = $th->getMessage();
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

<body style="background-image: url('images/backgroundpic.jpg'); background-repeat: no-repeat; background-size:cover; ">
    <div class="phpBuddyLogin phpBuddyLogin--register container">
        <div class="form form--login text-center" style="margin-top: 15%">
            <form class="form-signin  rounded p-3 mb-2 bg-dark text-white" style="width: 50%; margin:auto;" action="" method="post">
                <h2 style="margin-top: 2%" class=" form__title">Sign up for an account</h2>

                <?php if (isset($error)) : ?>
                    <div style="margin-top: 2%">
                        <p>
                            <?php echo $error; ?>
                        </p>
                    </div>
                <?php endif; ?>
                

            
                <div class="form-group row" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label class="col-sm-2 col-form-label" for="firstname">Firstname</label>
                    <input class="form-control border border-info rounded" type="text" id="firstname" name="firstname">
                </div>
                <div class="form-group row" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label class="col-sm-2 col-form-label" for="lastname">Lastname</label>
                    <input class="form-control border border-info rounded" type="text" id="lastname" name="lastname">
                </div>
                <div class="form-group row" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <input class="form-control border border-info rounded" type="text" id="email" name="email" placeholder="r123456@student.thomasmore.be">
                </div>
                <div class="form-group row" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                    <input class="form-control border border-info rounded" type="password" id="password" name="password">
                </div>

                <div class="form-group row" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                    <input class="form-control border border-info rounded" type="password" id="password" name="password_confirmation">
                </div>

                <div class="form-group" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label for="exampleFormControlSelect1">class</label>
                    <select name="klas" class="form-control" id="exampleFormControlSelect1">
                        <option value="1IMD">1IMD</option>
                        <option value="2IMD">2IMD</option>
                        <option value="3IMD">3IMD</option>
                    </select>
                </div>

                <div class="form-group" style="width: 80%; margin:auto; padding-top:2%; padding-bottom:2%;">
                    <label for="exampleFormControlSelect1">buddy</label>
                    <select name="buddy" class="form-control" id="exampleFormControlSelect1">
                        <option value="BuddySearcher">I'm searching for a buddy</option>
                        <option value="BuddyHolder">I want to take care of a buddy</option>
                    </select>

                </div>
                <div>
                    <input type="submit" value="Sign me up!" class="btn btn-outline-light">
                    <br>
                    <a style="color:white; text-decoration: underline;" href="login.php">Already have an account?</a>
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