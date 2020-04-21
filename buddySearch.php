<?php
include_once(__DIR__ . "/classes/Filter.php");
include_once("filterArray.php");
  session_start();
  $i = 0;
  $email = $_SESSION["user"];
  $filter = new Filter();
  $locatie = '';
  $users = $filter->getUsers();
  if(!empty($_GET)){
    $search = htmlspecialchars($_GET["search"]);
    $course = $_GET["course"];
    if(!empty($locatie)){ $locatie = $_GET["locatie"];}
    $hobby = $_GET["hobby"];
    $extra = $_GET["extra"];
    if(!empty($search))
    {
      $searchResult = $filter->searchPerson($search);
    }else if(!empty($course)||!empty($locatie)||!empty($hobby)||!empty($extra)){
      $searchResult = $filter->filterSearch($course,$locatie,$hobby,$extra);
    }
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
<?php include_once("nav.inc.php"); ?>

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
        <div class="dropdown">
					<label>filter op richting:</label><br> 
						<select name="course" id="course" >
            <option value="">Kies</option>
              <?php foreach($coursesList as $course): ?>
							<option value="<?php echo $course ?>"><?php echo $course?> </option>
              <?php endforeach; ?>
						</select>
				</div>
      <?php endif; ?>
      <?php if(!empty(Filter::getHobby($email)[0]["hobby"])): ?>
        <div class="dropdown">
					<label>filter op hobby:</label><br> 
						<select name="hobby" id="hobby" >
            <option value="">Kies</option>
              <?php foreach($hobbyList as $hobby): ?>
							<option value="<?php echo $hobby ?>"><?php echo $hobby?> </option>
              <?php endforeach; ?>
						</select>
				</div>
      <?php endif; ?>
      <?php if(!empty(Filter::getExtra($email)[0]["extra"])): ?>
         <div class="dropdown">
					<label>filter op extra:</label><br> 
						<select name="extra" id="extra">
              <option value="">Kies</option>
              <?php foreach($extraList as $extra): ?>
							<option value="<?php echo $extra ?>"><?php echo $extra?> </option>
              <?php endforeach; ?>

						</select>
				</div>
      <?php endif; ?>
      <div class="form__field">
      <input value="Find a buddy!" type="submit" id="submit" class="btn btn--primary">
      </div>

    </form>
    </div>
    <div class="user__list"> 
    <?php if(empty($_GET)){ ?>
    <?php foreach($users as $key => $user){ ?>
    <div class="user" style="margin-top:50px; margin-left:20px;">
    <a href="UserFriendProfile.php?id=<?php  echo $user["id"]; ?>" style="background-image: url(<?php echo $user["image"] ?>)"></a>
    <a href="UserFriendProfile.php?id=<?php  echo $user["id"]; ?>"><p><?php echo ucfirst($user["Firstname"]) ." " . $user["LastName"] ?></p></a>
    <p>woont in: <?php echo $user["locatie"] ?></p>
    <p>zit in klas: <?php echo $user["class"] ?></p>
    <a href="UserFriendProfile.php?id=<?php echo $user["id"] ?>">Request buddy</a>

    </div>
    <?php if(++$i == 10) break; ?>
    <?php }}else if(!empty($_GET)){ ?>
      <?php foreach($searchResult as $key => $result){ ?>
      <div class="user" style="margin-top:50px; margin-left:20px;">
    <a href="UserFriendProfile.php?id=<?php  echo $result["id"]; ?>" style="background-image: url(<?php echo $result["image"] ?>)"></a>
    <a href="UserFriendProfile.php?id=<?php  echo $result["id"]; ?>"><p><?php echo ucfirst($result["firstname"]) ." " . $result["lastname"] ?></p></a>
    <p>woont in: <?php echo $result["locatie"] ?></p>
    <p>zit in klas: <?php echo $result["class"] ?></p>
    <a href="UserFriendProfile.php?id=<?php echo $result["id"] ?>">Request buddy</a>
    </div>
    <?php }} ?>
    </div> 



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>