<?php
include_once(__DIR__ . "/classes/Filter.php");
  session_start();
  $i = 0;
  $email = $_SESSION["user"];
  $filter = new Filter();
  $users = $filter->getUsers();
  if(!empty($_GET)){

  }
  else{
    shuffle($users);
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

<body>
    <div>
    <form action="" method="get">
      <div class="form__field">
      <label for="search">zoek een persoon</label>
      <input type="text" placeholder="search" id="search" name="search" >
      </div>
      <?php if(!empty(Filter::getLocation($email)[0]["locatie"])): ?>
      <div class="form__field">
      <label for="locatie">zoek op <?php echo ucfirst(Filter::getLocation($email)[0]["locatie"]); ?></label>
      <input type="checkbox" id="locatie" name="locatie" value="<?php echo ucfirst(Filter::getLocation($email)[0]["locatie"]); ?>">
      </div>
      <?php endif; ?>
      <?php if(!empty(Filter::getInterests($email)[0]["interests"])): ?>
      <div class="form__field">
      <label for="interests">zoek op <?php echo Filter::getInterests($email)[0]["interests"]; ?></label>
      <input type="checkbox" id="interests" name="interests" value="<?php echo Filter::getInterests($email)[0]["interests"]; ?>">
      </div>
      <?php endif; ?>
      <?php if(!empty(Filter::getHobby($email)[0]["hobby"])): ?>
      <div class="form__field">
      <label for="hobby">zoek op <?php echo Filter::getHobby($email)[0]["hobby"]; ?></label>
      <input type="checkbox" id="hobby" name="hobby" value="<?php echo Filter::getHobby($email)[0]["hobby"]; ?>">
      </div>
      <?php endif; ?>
      <?php if(!empty(Filter::getExtra($email)[0]["extra"])): ?>
      <div class="form__field">
      <label for="extra">zoek op <?php echo Filter::getExtra($email)[0]["extra"]; ?></label>
      <input type="checkbox" id="extra" name="extra" value="<?php echo Filter::getExtra($email)[0]["extra"]; ?>">
      </div>
      <?php endif; ?>
      <div class="form__field">
      <input value="Find a buddy!" type="submit" id="submit" class="btn btn--primary">
      </div>

    </form>
    </div>
    <div class="user__list"> 
    <?php foreach($users as $key => $user){ ?>
    <div class="user" style="margin-top:50px; margin-left:20px;">
    <a href="profilePage.php?id=<?php  echo $key; ?>" style="background-image: url(<?php echo $user["image"] ?>)"></a>
    <a href="profilePage.php?id=<?php  echo $key; ?>"><p><?php echo $user["Firstname"] ." " . $user["LastName"] ?></p></a>
    <p>woont in: <?php echo $user["locatie"] ?></p>
    <p>zit in klas: <?php echo $user["class"] ?></p>
    </div>
    <?php if(++$i == 10) break; ?>
    <?php } ?>
    </div> 



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>