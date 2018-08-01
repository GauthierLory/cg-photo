<?php
require_once('../Configuration/Configuration.php');

require_once(PATH_BDD.'PhotoDAO.php');
require_once(PATH_MODELES.'Photo.php');

$actionFormulaire = null;

if(isset($_POST['action'])){
	$actionFormulaire = $_POST['action'];

	switch ($actionFormulaire){
		case 'Ajouter':
			ajouter();
		break;
		case 'Modifier':
			modifier();
		break;
		case 'Supprimer':
			supprimer();
		break;
	}
}else{
	// afficherAdministrationUtilisateur();
}


function ajouter(){

  $photo = new Photo();

	$photo->setIdUtilisateur($_POST['id_utilisateur']);
	$photo->setNom($_POST['nom']);
	$photo->setDescription($_POST['description']);


	if($photo->estValide()){
		$photoDAO = new PhotoDAO();

		$photoDAO->ajouterUnePhoto($photo);

	}else{
		global $listeErreurs;
		global $photoErreurAjout;
		$listeErreurs = $photo->getErreursActives();
		$photoErreurAjout = $photo;
	}

}

function modifier(){

	$photo = new Photo();
	$photoDAO = new PhotoDAO();

	$photo = $photoDAO->lireUnePhoto($_POST['id-photo']);
	$extention = $photo->getExtention();
	$ancienNom = $photo->getNom();

	$photo->setIdUtilisateur($_POST['id_utilisateur']);
	$photo->setNom($_POST['nom']);
	$photo->setExtentionNom($extention);
	$photo->setDescription($_POST['description']);


	if($photo->estValide()){

		$photoDAO->modifierUnephoto($photo);
		rename(PATH_PHOTOS_ORIGINALES.$ancienNom, PATH_PHOTOS_ORIGINALES.$photo->getNom());
		rename(PATH_PHOTOS_COPYRIGHT.$ancienNom, PATH_PHOTOS_COPYRIGHT.$photo->getNom());

	}else{
		global $listeErreurs;
		global $photoErreurModif;
		$listeErreurs = $photo->getErreursActives();
		$photoErreurModif = $photo;
	}
}

function supprimer(){

	$id = $_POST['id-photo'];

  $photoDAO = new PhotoDAO();
  $photoDAO->supprimerUnePhoto($id);
	unlink(PATH_PHOTOS_COPYRIGHT.$_POST['nom']);
  unlink(PATH_PHOTOS_ORIGINALES.$_POST['nom']);

}
?>
