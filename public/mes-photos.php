<?php
// Start the session
if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION['idLogin'])){
	header("Location:../connexion");
}

//Appel des autres vues
require_once('menu.php');
require_once('alerte.php');

require_once(PATH_BDD.'PhotoDAO.php');
require_once(PATH_MODELES.'Photo.php');
require_once(PATH_CONTROLEURS.'mes-photos.php');

$photosDAO = new PhotoDAO();
$listePhotos = $photosDAO->listerLesPhotosUtilisateur($_SESSION['idLogin']);

if(sizeof($listePhotos)!=0){
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
    <form class="" action="mes-photos" method="POST">
      <div class="conteneur">
        <a href="<?php echo 'info-photo?photo='.$photo->getIdPhoto() ?>"><img id='image' src="<?php echo PATH_PHOTOS_COPYRIGHT.$photo->getNom() ?>" alt="photo" /></a>
            <a class="bouton-ajouter-panier">
              <input id="id-photo" name="id_photo" type="hidden" value="<?php echo $photo->getIdPhoto() ?>"/>
              <input id="id-photo" name="nom_photo" type="hidden" value="<?php echo $photo->getNom() ?>"/>
              <input id="bouton-ajouter" border="0" src="<?php echo PATH_IMAGES.PATH_ICONES.'bouton_supprimer.png' ?>" type="image" value="submit"/>
        </a>
      </div>
    </form>
    <?php
    }
    ?>
  </div>
</div>
<script src="<?php echo PATH_SCRIPTS.'galerie.js'?>"></script>

<?php
}
//Appel de la vue footer
require_once('piedDePage.php');
?>
