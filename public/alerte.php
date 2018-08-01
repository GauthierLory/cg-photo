<?php if (isset($_SESSION['connexion']) && $_SESSION['connexion']=='reussie'){
  ?>
  <div class="alert-verte">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo ALERTE_CONNEXION; ?>
  </div>
<?php
unset($_SESSION['connexion']);

}elseif (isset($_SESSION['deconnexion']) && $_SESSION['deconnexion']=='reussie') {
?>
  <div class="alert-rouge">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo ALERTE_DECONNEXION; ?>
  </div>
<?php
unset($_SESSION['deconnexion']);

}elseif (isset($_SESSION['connexion']) && $_SESSION['connexion']=='echouee') {
?>
  <div class="alert-rouge">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo ALERTE_MDP; ?>
  </div>
<?php
unset($_SESSION['connexion']);

}elseif (isset($_SESSION['inscription']) && $_SESSION['inscription']=='reussie') {
?>
  <div class="alert-verte">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo ALERTE_INSCRIPTION; ?>
  </div>
<?php
unset($_SESSION['inscription']);
}elseif (isset($_SESSION['envoiPhoto']) && $_SESSION['envoiPhoto']=='reussi') {
?>
  <div class="alert-verte">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo ALERTE_PHOTO; ?>
  </div>
<?php
unset($_SESSION['envoiPhoto']);
}elseif (isset($_SESSION['ajoutPanier']) && $_SESSION['ajoutPanier']=='reussi') {
?>
  <div class="alert-verte">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo 'La photo a été ajoutée au panier'; ?>
  </div>
<?php
unset($_SESSION['ajoutPanier']);
}elseif (isset($_SESSION['ajoutPanier']) && $_SESSION['ajoutPanier']=='existante') {
?>
  <div class="alert-rouge">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo 'La photo est déjà présente dans votre panier'; ?>
  </div>
<?php
unset($_SESSION['ajoutPanier']);
}elseif (isset($_SESSION['inscriptionErreur'])) {
?>
  <div class="alert-rouge">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo $_SESSION['inscriptionErreur']; ?>
  </div>
<?php
unset($_SESSION['inscriptionErreur']);
}elseif (isset($_SESSION['erreurImportationPhoto'])) {
?>
  <div class="alert-rouge">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo $_SESSION['erreurImportationPhoto']; ?>
  </div>
<?php
unset($_SESSION['erreurImportationPhoto']);
}elseif (isset($_SESSION['ImportationPhotoReussie'])) {
?>
  <div class="alert-verte">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo $_SESSION['ImportationPhotoReussie']; ?>
  </div>
<?php
unset($_SESSION['ImportationPhotoReussie']);
}elseif (isset($listeErreurs)){
  ?>
  <div class="alert-rouge">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
    <?php
    foreach ($listeErreurs as $erreur) {
        echo $erreur[0].'</br>';
    }
    ?>
  </div>
<?php
}elseif (isset($listeErreurs)){
  ?>
  <div class="alert-rouge">
    <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
    <?php
    foreach ($listeErreurs as $erreur) {
        echo $erreur[0].'</br>';
    }
    ?>
  </div>
<?php
}
?>
