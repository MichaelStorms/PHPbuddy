<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=tzbase', 'root', '');  // connection à la base de donnée

if(isset($_SESSION['id']))
{
	$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();
	
	if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
	{
		$newpseudo = htmlspecialchars($_POST['newpseudo']);
		$pseudolength = strlen($newpseudo);  // $pseudolength = la longueur du pseudo
		if($user['chgpseudo'] == 1)
		{
            if($pseudolength <= 20)  // on vérifie que le pseudo fait moins de 100 caractères
		    {
		    	$reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
		        $reqpseudo->execute(array($newpseudo));
		        $pseudoexist = $reqpseudo->rowCount();
		        if($pseudoexist == 0)  // vérifie si le pseudo n'a pas déjà été utilisé
		        {
		            $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
		            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
		            header('Location: profil.php?id='.$_SESSION['id']);
		        }
		        else
		        {
		        	$msg = "Le pseudo existe déjà !";
		        }
		    }
		    else
		    {
		    	$msg = "Le pseudo est trop long !";
		    }
		}
		else
		{
			$msg = "Vous n'êtes pas autorisé à changer votre pseudo.";
		}
		
	}
	
	if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
	{
		$newmail = htmlspecialchars($_POST['newmail']);
		
		if(filter_var($newmail, FILTER_VALIDATE_EMAIL))  // on vérifie via un script si l'adresse mail est une adresse mail valide
		{
			$maillength = strlen($newmail);  // $maillength = la longueur du mail
			if($maillength <= 35)
			{
				$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
		        $reqmail->execute(array($newmail));
		        $mailexist = $reqmail->rowCount();
		        if($mailexist == 0)  // vérifie si l'adresse mail n'a pas déjà été utilisée
		        {
		            $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
		            $insertmail->execute(array($newmail, $_SESSION['id']));
		            header('Location: profil.php?id='.$_SESSION['id']);
		        }
		        else
		        {
		        	$msg = "L'adresse mail est déjà utilisée !";
		        }
			}
			else
			{
				$msg = "L'adresse mail est trop longue.";
			}
		}
		else
		{
			$msg = "L'adresse mail n'est pas valide.";
		}
	}
	
	if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND $_POST['newmdp2'] AND !empty($_POST['newmdp2']))
	{
		$newmdp1 = sha1($_POST['newmdp1']);
		$newmdp2 = sha1($_POST['newmdp2']);
		
		if($mdp1 == $mdp2)
		{
			$insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
			$insertmdp->execute(array($newmdp1, $_SESSION['id']));
		    header('Location: profil.php?id='.$_SESSION['id']);
		}
		else
		{
			$msg = "Les mots de passe ne correspondent pas !";
		}
	}
	
	if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
	{
		$tailleMax = 2097152;  // max taille de 2 mo  (doit etre ecrite en octet)
		$extensionValides = array('jpg','jpeg','gif','png');  // liste des extensions de fichiers supportées
		if($_FILES['avatar']['size'] <= $tailleMax)  // on vérifie si la taille est inférieure au maximum que nous avons choisi
		{
			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));  // strtolower met tous les caractères en minuscules
			                                                                                    // substr permet d'ignorer un caractère
			if(in_array($extensionUpload, $extensionValides))  // if(in_array(1,a)) vérifie si 1 est dans le tableau a
			{
				$chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
				if($resultat)
				{
					$updateAvatar = $bdd->prepare("UPDATE membres SET avatar = :avatar WHERE id = :id");
					$updateAvatar->execute(array(
					    'avatar' => $_SESSION['id'].".".$extensionUpload,
						'id' => $_SESSION['id']
					    ));
					header('Location: profil.php?id='.$_SESSION['id']);
				}
				{
					$msg = "Erreur durant l'importation de la photo.";
				}
			}
			else
			{
				$msg = "Le format de l'image n'est pas accepté. Merci d'utiliser un format jpg, png ou gif.";
			}
		}
		else
		{
			$msg = "La photo de profil ne doit pas dépasser 2mo";
		}
	}
	
?>

<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108225258-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            
            gtag('config', 'UA-108225258-1');
        </script>
        <title>TEAM ZIRMA</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="icon" type="image/ico" href="img/ico32x32.ico">
    </head>
    <body class="classic">
        <div align="center">
            <table width="956" height="135">
                <td height="135" class="tdone" valign="bottom">
                    <?php
				        include("0-menu.php");
				    ?>
                </td>
                <tr/>
                <td class="tdtwo">
                    
					<div align="center">
                        <p class="title">Edition du profil</p>
                    </div>
					
                    <br/><br/>
                    
					<p class="descfaq">
					    <div align="center">
                            <form method="POST" action="" enctype="multipart/form-data">
								<table class="membre">
						    	    <tr>
						    		    <td align="right">
						    			    <label for="newpseudo"><p class="form">Pseudo :</p></label>
						    			</td>
						    		    <td>
										    <?php
											if($_SESSION['chgpseudo'] == 1)
											{
											?>
						    			    <input type="text" placeholder="Pseudo" id="newpseudo" name="newpseudo" value="<?php echo $user['pseudo']; ?>" />
											<?php
											}
											else
											{
											?>
											<input type="text" id="newpseudo" name="newpseudo" value="<?php echo $user['pseudo']; ?>" disabled />
											<?php
											}
											?>
						    			</td>
						    		</tr>
						    		<tr>
						    		    <td align="right">
						    			    <label for="newmail"><p class="form">Adresse mail :</p></label>
						    			</td>
						    		    <td>
						    			    <input type="email" placeholder="Mail" id="newmail" name="newmail" value="<?php echo $user['mail']; ?>" />
						    			</td>
						    		</tr>
						    		<tr>
						    		    <td align="right">
						    			    <label for="newmdp1"><p class="form">Nouveau mot de passe :</p></label>
						    			</td>
						    		    <td>
						    			    <input type="password" placeholder="Mot de passe" id="newmdp1" name="newmdp1" />
						    			</td>
						    		</tr>
						    		<tr>
						    		    <td align="right">
						    			    <label for="newmdp2"><p class="form">Confirmation du mot de passe :</p></label>
						    			</td>
						    		    <td>
						    			    <input type="password" placeholder="Confirmation mot de passe" id="newmdp2" name="newmdp2" />
						    			</td>
						    		</tr>
									<tr/>
						    		<tr>
						    		    <td align="right">
						    			    <label for="avatar"><p class="form">Photo de profil :</p></label>
						    			</td>
						    		    <td>
						    			    <input type="file" name="avatar" id="avatar" />
						    			</td>
						    		</tr>
						    	</table>
						    	<br/>
						    	<input type="submit" name="updateprofil" value="Confirmer" />
						    </form>
						</div>
                    </p>
					
					<br/>
					
					<p class="form_response_red">
					    <?php
				        if(isset($msg))
					    {
					    	echo $msg;
					    }
					    ?>
					</p>
					
					<br/><br/><br/><br/>
					
                </td>
            </table>
        </div>
    </body>
</html>

<?php

}
else
{
	header("Location: connexion.php");
}

?>