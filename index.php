<?php
include("init.php");
include("loginCheck.inc.php");

include_once(__DIR__ . "/classes/Filter.php");
include_once("filterArray.php");


$i = 0;
$email = $_SESSION["user"];
$filter = new Filter();
$locatie = '';
$users = $filter->getUsers();
if (!empty($_GET)) {
  $search = htmlspecialchars($_GET["search"]);
  $course = $_GET["course"];
  if (!empty($locatie)) {
    $locatie = $_GET["locatie"];
  }
  $hobby = $_GET["hobby"];
  $extra = $_GET["extra"];
  if (!empty($search)) {
    $searchResult = $filter->searchPerson($search);
  } else if (!empty($course) || !empty($locatie) || !empty($hobby) || !empty($extra)) {
    $searchResult = $filter->filterSearch($course, $locatie, $hobby, $extra);
  }
} else {
  shuffle($users);
}

$numOfCols = 4;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
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
  <header>
    <div class="navbar navbar-dark bg-dark box-shadow">
      <div class="container d-flex justify-content-between">
        <?php include_once("nav.inc.php"); ?>
      </div>
    </div>
  </header>
  <section class="jumbotron text-center" style="margin: 0">
    <div class="container">
      <h1>Hello, <?php echo  $user_data->firstname . " " . $user_data->lastname; ?></h1>
      <img class="img-thumbnail" src="images/<?php echo $user_data->image ?>" alt="profile picture of <?php echo  $user_data->firstname . " " . $user_data->lastname; ?>" style="width: 250px">
      <p> <?php echo  $user_data->imgDescription ?></p>
      <!--     buddies on the site -->
      <div>
        <p>There are currently : <?php echo $buddy->getUserAmount(); ?> people registred.</p>
        <p>And there have been <?php echo $buddy->getFriendAmount(); ?> friendships made </p>

      </div>
    </div>

  </section>


  <div class="album py-5 bg-light">


    <div class="container">
      <h2>Search for your buddy</h2>
      <form action="" method="get">

        <div class="form__field form-group row">

          <label class="col-sm-2 col-form-labe">Zoek een persoon</label>
          <div class="col-sm-10">
            <input class="border form-control" type="text" placeholder="search" id="search" name="search">
          </div>
        </div>
        <?php if (!empty(Filter::getLocation($email)[0]["locatie"])) : ?>

          <div class="f form-group row">
            <label class="col-sm-2 col-form-labe">Zoek op:</label>
            <div class="col-sm-10">
              <input class=" form-check-input" style="margin-left: 1px;" type="checkbox" id="locatie" name="locatie" value="<?php echo ucfirst(Filter::getLocation($email)[0]["locatie"]); ?>">
              <label class="form-check-label" style="margin-left: 2%;" for="locatie">
                <h5><?php echo ucfirst(Filter::getLocation($email)[0]["locatie"]); ?></h5>
              </label>
            </div>

          </div>
        <?php endif; ?>

        
          <div class="dropdown form-group row">
            <label class="col-sm-2 col-form-label">Filter op richting:</label>
            <div class="col-sm-10">
              <select class="form-control" name="course" id="course">
              <?php if (!empty(Filter::getInterests($email)[0]["interests"])){ ?>
                <option class="border border-info" value="<?php echo Filter::getInterests($email)[0]["interests"] ?>"><?php echo Filter::getInterests($email)[0]["interests"] ?></option>
              <?php }else{ ?>
                <option class="border border-info" value="">kies</option>
              <?php } ?>
                <?php foreach ($coursesList as $course) : ?>
                  <option value="<?php echo $course ?>"><?php echo $course ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="dropdown form-group row">
            <label class="col-sm-2 col-form-label">Filter op hobby:</label>
            <div class="col-sm-10">
              <select class="form-control" name="hobby" id="hobby">
        <?php if(!empty(Filter::getHobby($email)[0]["hobby"])){ ?>
               <option class="border border-info" value="<?php echo Filter::getHobby($email)[0]["hobby"]; ?>"><?php echo Filter::getHobby($email)[0]["hobby"]; ?></option>
        <?php }else{ ?>
                <option class="border border-info" value="">Kies</option>
        <?php } ?>
                <?php foreach ($hobbyList as $hobby) : ?>
                  <option value="<?php echo $hobby ?>"><?php echo $hobby ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="dropdown form-group row">
            <label class="col-sm-2 col-form-label">Filter op extra:</label>
            <div class="col-sm-10">
              <select class="form-control" name="extra" id="extra">
             <?php if(!empty(Filter::getExtra($email)[0]["extra"])){ ?>
                <option class="border border-info" value="<?php echo Filter::getExtra($email)[0]["extra"]; ?>"><?php echo Filter::getExtra($email)[0]["extra"]; ?></option>
             <?php } else{ ?>
                <option class="border border-info" value="">kies</option>
               <?php } ?>
                <?php foreach ($extraList as $extra) : ?>
                  <option value="<?php echo $extra ?>"><?php echo $extra ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
<<<<<<< HEAD
=======
        <?php endif; ?>
        
>>>>>>> ebf1ae8b37dd9ea78f7a2b4caa0c16b31de90e3f
        <div class="form__field">
          <input value="Find a buddy!" type="submit" id="submit" class="btn btn-outline-secondary" style="margin-top: 2%;">
        </div>

      </form>
    </div>


    <div class="container user__list">

      <?php if (empty($_GET)) { ?>

        <?php foreach ($users as $key => $user) {
          if ($rowCount % $numOfCols == 0) { ?> <div class="row">
            <?php }
          $rowCount++; ?>

            <div class="col">
              <div class="user" style="margin-top:50px; margin-left:20px;">
                <a href="UserFriendProfile.php?id=<?php echo $user["id"]; ?>" style="background-image: url(<?php echo $user["image"] ?>)"></a>
                <a href="UserFriendProfile.php?id=<?php echo $user["id"]; ?>">
                  <p><?php echo ucfirst($user["Firstname"]) . " " . $user["LastName"] ?></p>
                </a>
                <p>woont in: <?php echo $user["locatie"] ?></p>
                <p>zit in klas: <?php echo $user["class"] ?></p>
                <a href="UserFriendProfile.php?id=<?php echo $user["id"] ?>">Request buddy</a>
              </div>
            </div>

            <?php if (++$i == 10) break; ?>

          <?php }
      } else if (!empty($_GET)) { ?>
          <?php foreach ($searchResult as $key => $result) {
            if ($rowCount % $numOfCols == 0) { ?> <div class="row"> <?php }
                                                                  $rowCount++; ?>
              <div class="col">
                <div class="user" style="margin-top:50px; margin-left:20px;">
                  <a href="UserFriendProfile.php?id=<?php echo $result["id"]; ?>" style="background-image: url(<?php echo $result["image"] ?>)"></a>
                  <a href="UserFriendProfile.php?id=<?php echo $result["id"]; ?>">
                    <p><?php echo ucfirst($result["firstname"]) . " " . $result["lastname"] ?></p>
                  </a>
                  <p>woont in: <?php echo $result["locatie"] ?></p>
                  <p>zit in klas: <?php echo $result["class"] ?></p>
                  <a href="UserFriendProfile.php?id=<?php echo $result["id"] ?>">Request buddy</a>
                </div>
              </div>
          <?php }
        } ?>
              </div>

            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>