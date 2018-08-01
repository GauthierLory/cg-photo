<?php
// Start the session
if(!isset($_SESSION))
{
  session_start();
}
require_once('../Configuration/Configuration.php');


if(!isset($_SESSION['loginAdmin'])){
  header("Location:../prive/connexion");
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Travel-center</title>
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'admin.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_DECORATIONS.'bootstrap/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS.'alerte.css' ?>">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">Travel-center</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?php echo PATH_CONTROLEURS.'deconnexionPrive.php'?>">Déconnexion</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/prive/">
                  Statistiques
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="utilisateurs.php">
                    Utilisateurs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="photos.php">
                  Photos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="factures.php">
                    Factures
                </a>
            </li>
            </ul>
          </div>
        </nav>
