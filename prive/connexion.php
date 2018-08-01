<?php

// Start the session
if(!isset($_SESSION))
{
  session_start();
}
require_once('../Configuration/Configuration.php');

if(isset($_SESSION['loginAdmin'])){
  header("Location:../prive/");
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'connexionPrive.css' ?>">
</head>
<body>
	<div class="connexion">
	  <h2 class="connexion-titre">Log in</h2>

	  <form class="formulaire-connexion" action="../Controleurs/connexionPrive.php" method="POST">
	    <p><input type="text" name="login" placeholder="Login"></p>
	    <p><input type="password" name="mdp" placeholder="Mot de passe"></p>
	    <p><input type="submit" value="connexion"></p>
	  </form>
	</div>
</body>
</html>
