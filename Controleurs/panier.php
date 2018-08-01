<?php
require_once('../Configuration/Configuration.php');
require_once(PATH_BDD.'PhotoDAO.php');
require_once(PATH_MODELES.'Photo.php');

if(isset($_COOKIE['panier'])){

  $photosDAO = new PhotoDAO();
  $listePhotos = array();

  $panier = $_COOKIE['panier'];
  $listePanierPhoto = unserialize($panier);

  foreach ($listePanierPhoto as $idPhoto) {
    $photo = $photosDAO->lireUnePhoto($idPhoto);
    $listePhotos[] = $photo;
  }

  $montant = sizeof($listePhotos)* PRIX_PHOTO;

  $total = 'Total : '.$montant.' €';
}
?>
