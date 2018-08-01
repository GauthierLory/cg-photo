<?php

//Appel des autres vues
require_once('menu.php');
require_once('alerte.php');
require_once(PATH_CONTROLEURS.'panier.php');

if(isset($_COOKIE['panier'])){

?>

<div class="grille-images">
  <div class="images-block">
    <?php
    foreach ($listePhotos as $photo) {
    ?>
      <div class="conteneur">
        <a href="<?php echo 'info-photo?photo='.$photo->getIdPhoto() ?>"><img id='image' src="<?php echo PATH_PHOTOS_COPYRIGHT.$photo->getNom() ?>" /></a>

        <input id="bouton-ajouter" border="0" onclick="<?php echo 'suppressionPanier('.$photo->getIdPhoto().')'; ?>" src="<?php echo PATH_IMAGES.PATH_ICONES.'bouton_supprimer.png' ?>" type="image" value="submit"/>
        <input id="bouton-coeur" onclick="chargementDocument()" border="0" src="<?php echo PATH_IMAGES.PATH_ICONES.'bouton_coeur.png' ?>" type="image" value="submit"/>
      </div>
    <?php
    }
    ?>
  </div>
</div>

    <div>
        <ul id="panier-commande">
          <?php
          foreach ($listePhotos as $photo) {
          ?>
          <li id="montant-item"><span><?php echo $photo->getNom();?></span><span id="devise-recapitulatif"><?php echo PRIX_PHOTO.' €';?></span></li>
          <?php
          }
          ?>
          <li><?php echo '------------------------------' ?></li>
          <li><?php echo $total ?></li>
          <li id="montant-total"><a href="paiement"><?php echo PANIER_COMMANDE; ?></a></li>
        </ul>
    </div>


</div>
<script type="text/javascript" src="<?php echo PATH_SCRIPTS.'galerie.js'?>"></script>
<script type="text/javascript" src="<?php echo PATH_SCRIPTS.'gestionPanier.js'?>"></script>

<?php
}
//Appel de la vue footer
require_once('piedDePage.php');
?>
