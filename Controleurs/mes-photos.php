<?php

require_once(PATH_BDD.'PhotoDAO.php');

if(isset($_POST['id_photo']) && isset($_POST['nom_photo'])){
  $photoDAO = new PhotoDAO();
  $photoDAO->supprimerUnePhoto($_POST['id_photo']);
  unlink(PATH_PHOTOS_COPYRIGHT.$_POST['nom_photo']);
  unlink(PATH_PHOTOS_ORIGINALES.$_POST['nom_photo']);
}

?>
