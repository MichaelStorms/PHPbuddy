<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once(__DIR__ . '/classes/friends.php');
include_once(__DIR__ . '/classes/db.php');


$buddy = Buddy::getAll();
var_dump($buddy);

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
</head>

<body>

  <div class="container">
    <div class="top">
      <h2>Friend's List</h2>
    </div>
    <div class="row">

      <div class="shadow">
        <div class="col-sm-12">
          <div class="col-sm-2">
            <?php foreach ($buddy as $buddies): ?>

              <img src='https://avataaars.io/?avatarStyle=Transparent&topType=LongHairStraight&accessoriesType=Blank&hairColor=BlondeGolden&facialHairType=Blank&clotheType=ShirtVNeck&clotheColor=PastelBlue&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Pale' class="img-circle" width="60px">
          </div>
          <div class="col-sm-8">
            <h4><a href="#"> <?php echo $buddy[id]; ?></a></h4>
            <p><a href="#">4 mutual friends</a></p>
          </div>
          <div class="col-sm-2">
            <br>
            <a href="#">Send Request</a>
          </div>
        </div>
        <div class="clearfix"></div>
        <hr />
            <?php endforeach; ?>
      </div>
    </div>
  </div>

</body>

</html>