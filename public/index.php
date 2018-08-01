<?php

//Appel des autres vues
require_once('menu.php');
require_once('alerte.php');
require_once(PATH_BDD.'PhotoDAO.php');
require_once(PATH_MODELES.'Photo.php');

$photosDAO = new PhotoDAO();
$listePhotos = $photosDAO->listerLesPhotos();
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>

<div class="grille-images">
  <div class="images-block">
    <?php
    foreach ($listePhotos as $photo) {
    ?>
      <div class="conteneur">
        <a href="<?php echo 'info-photo?photo='.$photo->getIdPhoto() ?>"><img id='image' src="<?php echo PATH_PHOTOS_COPYRIGHT.$photo->getNom() ?>" /></a>

        <input id="bouton-ajouter" onclick="<?php echo 'ajoutPanier('.$photo->getIdPhoto().')'; ?>" border="0" src="<?php echo PATH_IMAGES.PATH_ICONES.'bouton_ajouter.png' ?>" type="image" value="submit"/>
        <input id="bouton-coeur" onclick="chargementDocument()" border="0" src="<?php echo PATH_IMAGES.PATH_ICONES.'bouton_coeur.png' ?>" type="image" value="submit"/>

      </div>
    <?php
    }
    ?>
  </div>
  <a target="_blank" href="https://travelblogcenter.wordpress.com//"><i class="wordpress"></i></a>

  <div id="bouton-vers-le-haut">
    <a href="#">
      <img src="Decorations/Images/icones/fleche.png" alt="Vers le haut">
    </a>
  </div>
<script src="<?php echo PATH_SCRIPTS.'galerie.js'?>"></script>
<script src="<?php echo PATH_SCRIPTS.'gestionPanier.js'?>"></script>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
