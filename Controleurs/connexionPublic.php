<?php

// Start the session
if(!isset($_SESSION))
{
    session_start();
}

require_once('../Configuration/Configuration.php');
require_once(PATH_MODELES.'Utilisateur.php');
require_once(PATH_BDD.'UtilisateurDAO.php');

$identification = 1;

if(!isset($_SESSION['idLogin'])){
  if(isset($_POST['login']) && isset($_POST['mdp'])){

    $utilisateur = new Utilisateur();
    $utilisateur->setPseudo($_POST['login']);
    $utilisateur->setMotDePasse($_POST['mdp']);
    if($utilisateur->estValide()){
      $utilisateurDAO = new UtilisateurDAO();
      $id = $utilisateurDAO->verificationUtilisateur($utilisateur);
    }


    if ($id >= 1){

      $_SESSION['idLogin']=$id;
      $_SESSION['connexion']="reussie";
      header("Location:../../index");

    }else{

      $_SESSION['connexion']="echouee";
      header("Location:../../connexion");

    }
  }

}else{
  echo "Vous êtes déjà connecté !";
}
?>
