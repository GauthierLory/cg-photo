
<?php

if(!isset($_SESSION))
{
    session_start();
}

require_once('../Configuration/Configuration.php');

require_once(PATH_BDD.'PhotoDAO.php');
require_once(PATH_MODELES.'Photo.php');

if (isset($_POST['nom']) && isset($_POST['description']))
{
	$photo = new Photo();

	$photo->setIdUtilisateur($_SESSION['idLogin']);
	$photo->setNom($_POST['nom']);
	$photo->setDescription($_POST['description']);

	if($photo->estValide()){

		envoiPhotoOriginale($photo);

	}else{
    affichageErreursModele($photo);
	}

}

else if (isset($_POST['nom']) && !isset($_POST['description'] ))
{

	$photo = new Photo();

	$photo->setIdUtilisateur($_SESSION['idLogin']);
	$photo->setNom($_POST['nom']);

	if($photo->estValide()){

		envoiPhotoOriginale($photo);

	}else{
    affichageErreursModele($photo);
	}

}

function envoiPhotoOriginale($photo)
{

 	$fichierNom = $_FILES['fichier']['name'];
 	$fichierTaille = $_FILES['fichier']['size'];
 	$fichierErreur = $_FILES['fichier']['error'];
 	$fichierExtension = strrchr($fichierNom, ".");
 	$extention_authorise = array('.jpeg','.jpg','.png' );
 	$fichierTmpNom = $_FILES['fichier']['tmp_name'];
 	$fichierCopyrightDestination = PATH_PHOTOS_COPYRIGHT.$photo->getNom().$fichierExtension;
  $fichierOriginalDestination = PATH_PHOTOS_ORIGINALES.$photo->getNom().$fichierExtension;


  if(!in_array($fichierExtension, $extention_authorise))
  {
    affichageErreursModele($photo);
    $_SESSION['erreurImportationPhoto'] = 'Seules les photos de type JPG, JPEG et PNG sont autorisées';
    return;
  }

  $tailles = getimagesize($fichierTmpNom);
  $ratio = $tailles[0]/$tailles[1];

  if(($ratio >= 1 && $tailles[1]<500) || ($ratio <= 1 && $tailles[0]<500)){
    affichageErreursModele($photo);
    $_SESSION['erreurImportationPhoto'] = "La photo est trop petite. La photo doit faire au minimum 500px en hauteur et en largeur.";
    return;
  }elseif ($ratio > 6.5 || $ratio < 0.3) {
    affichageErreursModele($photo);
    $_SESSION['erreurImportationPhoto'] = "Le format de la photo n'est pas correct. Le ratio ne doit pas être supérieur à 6.5 ou inférieur à 0.3";
    return;
  }elseif(file_exists($fichierCopyrightDestination) || file_exists($fichierOriginalDestination))
 	{
    affichageErreursModele($photo);
 		$_SESSION['erreurImportationPhoto'] = "Ce nom est déjà pris. Choisissez en un autre";
    return;
 	}
 	elseif($_FILES['fichier']['size'] > 20000000)
 	{
    affichageErreursModele($photo);
 		$_SESSION['erreurImportationPhoto'] = " La photo est trop volumineuse. Veuillez en insérer une de  moins de 15Mo";
    return;
 	}
 	else
 	{

 		if(move_uploaded_file($fichierTmpNom, $fichierOriginalDestination))
 		{
      $photo->setExtentionNom($fichierExtension);
      creationPhotoCopyright($fichierCopyrightDestination,$fichierOriginalDestination,$photo,$tailles,$fichierExtension);
 		}
 		else
 		{
      affichageErreursModele($photo);
 			$_SESSION['erreurImportationPhoto'] = "Une erreur est survenue lors de l'envoi du fichier";
      return;
 		}

 	}

}

function creationPhotoCopyright($fichierCopyrightDestination,$fichierOriginalDestination,$photo,$tailles,$fichierExtension){

  switch ($fichierExtension) {
    case '.png':
      $ouverture = @imagecreatefrompng($fichierOriginalDestination);
      $nouveauFichier = imagecreatefrompng($fichierOriginalDestination);
      break;
    case '.jpg':
      $ouverture = @imagecreatefromjpeg($fichierOriginalDestination);
      $nouveauFichier = imagecreatefromjpeg($fichierOriginalDestination);
      break;
      case '.jpeg':
      $ouverture = @imagecreatefromjpeg($fichierOriginalDestination);
      $nouveauFichier = imagecreatefromjpeg($fichierOriginalDestination);
      break;
    default:
      $ouverture = @imagecreatefromjpeg($fichierOriginalDestination);
      $nouveauFichier = imagecreatefromjpeg($fichierOriginalDestination);
      break;
  }

  $ratio = $tailles[0]/$tailles[1];

  if($ouverture){

    if($tailles[0]>700 && $ratio >= 1){
      $reduction = $tailles[0]/700;
      $nouvelleLargeur = $tailles[0]/$reduction;
      $nouvelleHauteur = $tailles[1]/$reduction;

    }elseif($tailles[1]>700 && $ratio <= 1){
      $reduction = $tailles[1]/700;
      $nouvelleLargeur = $tailles[0]/$reduction;
      $nouvelleHauteur = $tailles[1]/$reduction;

    }elseif ($tailles[0]<700 || $tailles[1]<700) {
      $nouvelleLargeur = $tailles[0];
      $nouvelleHauteur = $tailles[1];
    }

    $imageTemp = imagecreatetruecolor($nouvelleLargeur ,$nouvelleHauteur);
    imagecopyresampled($imageTemp,$nouveauFichier,0,0,0,0,$nouvelleLargeur,$nouvelleHauteur,$tailles[0],$tailles[1]);
    // imagejpeg($truecolor,$thumb,100);



    // On charge d'abord les images
    $source = imagecreatefromjpeg(PATH_IMAGES.PATH_PHOTOS."Copyright.jpg"); // Le logo est la source

    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);

    // On met le logo (source) dans l'image de destination (la photo)
    imagecopymerge($imageTemp, $source, 0, 0, 0, 0, $largeur_source, $hauteur_source, 10);
    // imagejpeg($truecolor,$thumb,100);

    // Begin capturing the byte stream
    // ob_start();

    // generate the byte stream
    imagejpeg($imageTemp, $fichierCopyrightDestination, 100);

    // and finally retrieve the byte stream
    // $rawImageBytes = ob_get_clean();

    if(file_exists($fichierCopyrightDestination)){

      $photoDAO = new PhotoDAO();
      $photoDAO->ajouterUnePhoto($photo);
      $_SESSION['ImportationPhotoReussie'] = "Photo envoyée avec succès";
      
    }elseif(file_exists($fichierOriginalDestination)){
      unlink($fichierOriginalDestination);
    }

  // }else{
  //   unlink($fichierOriginalDestination);
  //   echo "erreur ouverture photo";
  }

}

function affichageErreursModele($photo){

  global $listeErreurs;
  global $photoErreurAjout;
  $listeErreurs = $photo->getErreursActives();
  $photoErreurAjout = $photo;

}


//
?>
