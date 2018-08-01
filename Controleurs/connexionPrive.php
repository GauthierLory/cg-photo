<?php

// Start the session
if(!isset($_SESSION))
{
    session_start();
}

require_once('../Configuration/Configuration.php');

require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');

if(!isset($_SESSION['loginAdmin'])){
  if(isset($_POST['login']) && isset($_POST['mdp'])){

    $utilisateur = new Utilisateur();
    $utilisateur->construirePourConnexion($_POST['login'],$_POST['mdp']);
    $utilisateurDAO = new UtilisateurDAO();
    echo $utilisateurDAO->estAdministrateur($utilisateur);
    if ($utilisateurDAO->estAdministrateur($utilisateur)){
      $_SESSION['loginAdmin']=1;
      header("Location:../../prive/");

    }else{
      header("Location:../../prive/connexion");

    }
  }

}else{
  echo "Vous êtes déjà connecté !";
}
?>
