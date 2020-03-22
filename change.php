<?php
    include(__DIR__ . "/settings/setting.php");
    include("/classe/db.php");
    session_start();
    $conn = new mysqli(SETTINGS['db']['host'], SETTINGS['db']['user'],SETTINGS['db']['password'],SETTINGS['db']['db']);
       
    // if (!empty($_POST)) {
    //     $image = $_POST['image'];
    //     $conn = new mysqli(SETTINGS['db']['host'], SETTINGS['db']['user'],SETTINGS['db']['password'],SETTINGS['db']['db']);
    
    //     if ($conn->connect_error) {
    //         die("Connection failed: " . $conn->connect_error);
    //      }else{
    //         echo "Connected successfully";
    //      }
    //      $sql = "SELECT * FROM users id";
    //      $result= mysqli_query($conn, $sql);
         

    //      $query = "INSERT INTO users(image) VALUES('$image')";


    // }


    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
	{
		$size = 2097152;  // max taille de 2 mo  (doit etre ecrite en octet)
		$filetypes = array('jpg','jpeg','gif','png');  // liste des extensions de fichiers supportées
		if($_FILES['avatar']['size'] <= $size)  // on vérifie si la taille est inférieure au maximum que nous avons choisi
		{
			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));  // strtolower met tous les caractères en minuscules
			                                                                                    // substr permet d'ignorer un caractère
			if(in_array($extensionUpload, $filetypes))  // if(in_array(1,a)) vérifie si 1 est dans le tableau a
			{
				$route = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $route);
				if($resultat)
				{
					$updateAvatar = $conn->prepare("UPDATE users SET image = :image WHERE id = :id");
					$updateAvatar->execute(array(
					    'avatar' => $_SESSION['id'].".".$extensionUpload,
						'id' => $_SESSION['id']
					    ));
					
				}
				{
					$error = "Kon de file niet uploden";
				}
			}
			else
			{
				$error = "Het formaat van de file is niet tiegestaan. Het moet een formaat jpg, png of gif zijn.";
			}
		}
		else
		{
			$msg = "La photo de profil ne doit pas dépasser 2mo";
		}
	}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change profile</title>
</head>

<body>
    <form action="" method="post">
        <input type="file" name="avatar">
        <input type="submit" value="change">
        <label for="avatar"></label>
    </form>
</body>

</html>