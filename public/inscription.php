<?php
if(isset($_SESSION['idLogin'])){
	header("Location:../");
}

//Appel des autres vues
require_once('menu.php');
require_once(PATH_CONTROLEURS.'inscription.php');
require_once('alerte.php');

?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<form id="formulaire-inscription" action="inscription" method="POST">
  <h2 class="titre-secondaire"><?php echo INSCRIPTION_TITRE ?></h2>
  <div class="onglet">
    <input placeholder="<?php echo INSCRIPTION_PRENOM ?>" name="prenom"
           value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getPrenom(); ?>" autofocus>
    <input placeholder="<?php echo INSCRIPTION_NOM ?>" name="nom"
           value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getNom(); ?>">
  </div>

  <div class="onglet">
    <input placeholder="<?php echo INSCRIPTION_EMAIL ?>" type="email" name="email" id="email"
           value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getEmail(); ?>"  required >
    <input placeholder="<?php echo INSCRIPTION_PSEUDO ?>" type="text" name="pseudo" id="pseudo"
           value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getPseudo(); ?>" required >
    <input placeholder="<?php echo INSCRIPTION_MDP ?>" type="password" name="mdp" id="mdp" required >
    <input placeholder="<?php echo INSCRIPTION_CMDP ?>" type="password" name="mdp" id="confMdp" onblur="confirmationMdp()" required >
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="precBtn" onclick="suivantPrec(-1)">Retour</button>
      <button type="button" id="nextBtn" onclick="suivantPrec(1)"></button>
    </div>
  </div>
  <div style="text-align:center;margin-top:40px;">
    <span class="etape"></span>
    <span class="etape"></span>
  </div>
</form>
<script type="text/javascript" src="<?php echo PATH_SCRIPTS.'formulaire-inscription.js' ?>"></script>
<script type="text/javascript" src="<?php echo PATH_SCRIPTS.'confirmation-mdp.js' ?>"></script>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
