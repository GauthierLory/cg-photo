<?php
if(!isset($_SESSION))
{
  session_start();
}

//Appel des autres vues
require_once('menu.php');
require_once('alerte.php');

if(isset($_SESSION['idLogin'])){
	header("Location:../");
}

?>

<div id="formulaire-identification">
	<div class="cadre-formulaire">
		<h2 class="titre-connexion"><?php echo CONNEXION_CONNEXION ?></h2>
		<form action="<?php echo PATH_CONTROLEURS.'connexionPublic.php' ?>" method="POST">
		  	<input type="text" name="login" placeholder="<?php echo CONNEXION_PSEUDO ?>" autofocus>
		  	<input type="password" name="mdp" placeholder="<?php echo CONNEXION_MDP ?>">
		  	<input type="submit" value="<?php echo CONNEXION_CONTINUER ?>">
		</form>
	</div>
</div>

<div class="mot-de-passe-oublie">
  <a href="#" id="oubli"><?php echo CONNEXION_MDP_OUBLIE ?></a>
</div>



<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
