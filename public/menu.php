<?php
// Start the session
if(!isset($_SESSION))
{
  session_start();
}

require_once('../Configuration/Configuration.php');
require_once(PATH_CONTROLEURS.'menu.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>TRAVEL CENTER - Vente et achat de photo étudiant</title>
  <link rel="shortcut icon" href="decorations/images/icones/favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'menu.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'connexionPublic.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'information.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'alerte.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'contact.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'panier.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'ajoutPhoto.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'mesPhotos.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'infoPhoto.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'piedDePage.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'index.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'contrat.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'paiement.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'mesCommandes.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'404.css' ?>">
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo PATH_DECORATIONS.'bootstrap/css/bootstrap.min.css' ?>"> -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>
  <nav>
    <label for="menu-mobile" class="menu-mobile">Menu</label>
    <input type="checkbox" id="menu-mobile" role="button">
        <ul>
          <li class="menu-gallerie"><a href="/"><?php echo NAV_GALERIE; ?></a></li>
          <li class="menu-information"><a href="information"><?php echo NAV_INFO; ?></a></li>
          <li class="menu-contact"><a href="contact"><?php echo NAV_CONTACTS; ?></a></li>
          <li class="menu-wordpress"><a href="wordpress"><?php echo NAV_WORDPRESS; ?></a></li>
        <?php
          require_once('barreLangues.php');
          afficherBarreLangues($langue);
        ?>
        <li class="menu-panier"><a href="panier"><img id="panier" src="<?php echo PATH_IMAGES.PATH_ICONES.'panier.png' ?>" alt="commander une photo"></a></li>
        <?php
          require_once('barreConnexion.php');
          afficherBarreConnexion(isset($_SESSION['idLogin']));
        ?>
          <h1><a href="/">CG Photo</a></h1>
      </ul>
    </nav>
