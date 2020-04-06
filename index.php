<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Welcome to your Buddy App</title>
</head>

<body>
  <h1 style="margin:2.5%;">Welcome to your Buddy App!</h1>
  <p style="margin:2.5%;">Welcome to IMD, with this Buddy App you can ask for help from students off all grades of IMD.<br> You can also give advice to students off all grades of IMD. </p>
  

<!--     buddyRegistration -->
  <div class ="registerbutton" style="margin:2.5%; ">
  <button onclick="window.location.href = './register.php';" style="border-radius: 5px; margin: 5px; background-color:cadetblue;">New here? Click here for registration</button>   
  </div>

<!--     buddyLogin -->
<div class ="loginbutton" style="margin:2.5%; ">
    <button onclick="window.location.href = './login.php';" style="border-radius: 5px; margin: 5px; background-color:lightskyblue">Already a member? Log in here</button>   
</div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>