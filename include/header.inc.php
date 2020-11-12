<?php session_start(); ?>
<!doctype html>
<html lang="fr">

<head>

  <meta charset="utf-8">

<?php
		$title = "Bienvenue sur le site de covoiturage de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>

    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    <script src="https://kit.fontawesome.com/e5e7c64170.js" crossorigin="anonymous"></script>
</head>
	<body>
	<div id="header">	
		<div id="entete">
			<div class="colonne">
				<a href="index.php?page=home">
					<img src="image/logo.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" />
				</a>
			</div>
			<div class="colonne">
				Covoiturage de l'IUT,<br />Partagez plus que votre véhicule !!!
			</div>
			</div>
			<div id="connect">
                <?php
                if (empty($_SESSION['username'])) {
                ?>
				    <a href="index.php?page=connexion">Connexion</a>
                <?php
                }
                else {
                ?>
                    <p>Utilisateur : <b><?php echo $_SESSION['username']; ?> <a href="index.php?page=deconnexion">Déconnexion</a></b></p>
                <?php
                }
                ?>
			</div>
	</div>
	

