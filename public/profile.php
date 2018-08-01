<?php
if(!isset($_SESSION))
{
  session_start();
}

//Appel des autres vues
require_once('menu.php');
require_once(PATH_CONTROLEURS.'profileAffichage.php');

if(!isset($_SESSION['idLogin'])){
	header("Location:../connexion");
}
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<form id="formulaire-profile" action="profile" method="POST">
  <h2><?php echo PROFILE_INFO?></h2>
  <input placeholder="<?php echo PROFILE_NOM?>" type="hidden" name="id" value="<?php echo $utilisateur->getIdUtilisateur(); ?>">
    <input placeholder="<?php echo PROFILE_NOM?>" name="nom" value="<?php echo $utilisateur->getNom(); ?>">
    <input placeholder="<?php echo PROFILE_PRENOM?>" name="prenom" value="<?php echo $utilisateur->getPrenom(); ?>">
    <input placeholder="<?php echo PROFILE_PSEUDO?>" name="pseudo" value="<?php echo $utilisateur->getPseudo(); ?>">
    <input placeholder="<?php echo PROFILE_EMAIL?>" name="email" value="<?php echo $utilisateur->getEmail(); ?>">
    <input placeholder="<?php echo PROFILE_MDP?>" type="password" name="mdp">
    <input placeholder="<?php echo PROFILE_MDP?>" type="password" name="cmdp">
    <div style="overflow:auto;">
      <div style="float:right;">
        <input type="submit" id="btnSubmit" value=<?php echo PROFILE_MODIF?>>
      </div>
    </div>
</form>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
