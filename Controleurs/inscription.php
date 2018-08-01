<?php
if(!isset($_SESSION))
{
  session_start();
}
require_once('../Configuration/Configuration.php');
require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');
require_once('mail.php');

if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['email'])  && isset($_POST['pseudo'])  && isset($_POST['mdp'])){

  try{

    $utilisateur = new Utilisateur();

  	$utilisateur->setNom($_POST['nom']);
  	$utilisateur->setPrenom($_POST['prenom']);
  	$utilisateur->setEmail($_POST['email']);
  	$utilisateur->setPseudo($_POST['pseudo']);
  	$utilisateur->setMotDePasse(password_hash($_POST['mdp'], PASSWORD_BCRYPT));
  	$utilisateur->setAdministrateur(0);

  	if($utilisateur->estValide()){
  		$utilisateurDAO = new UtilisateurDAO();

  		$utilisateurDAO->ajouterUnUtilisateur($utilisateur);
      envoyerUnMail($utilisateur);
      $_SESSION['inscription']="reussie";
      header("Location:../connexion");

  	}else{
  		global $listeErreurs;
  		global $utilisateurErreurAjout;
  		$listeErreurs = $utilisateur->getErreursActives();
  		$utilisateurErreurAjout = $utilisateur;
  	}

  }catch (Exception $e) {
      $_SESSION['inscriptionErreur']=$e->getMessage();
      header("Location:../inscription");
  }


}

?>
