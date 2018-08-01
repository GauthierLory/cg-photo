<?php
if(!isset($_SESSION))
{
  session_start();
}

require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');

$utilisateurDAO = new UtilisateurDAO();

if(isset($_POST['id'])&&isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['email'])&&isset($_POST['pseudo'])){

  $utilisateur = new Utilisateur();
	$utilisateur->setIdUtilisateur($_POST['id']);
	$utilisateur->setNom($_POST['nom']);
	$utilisateur->setPrenom($_POST['prenom']);
	$utilisateur->setEmail($_POST['email']);
	$utilisateur->setPseudo($_POST['pseudo']);

	if(isset($_POST['mdp']) && !empty($_POST['mdp'])){

		$utilisateur->setMotDePasse(password_hash($_POST['mdp'], PASSWORD_BCRYPT));
	}

	if($utilisateur->estValide() && $utilisateur->getMotDePasse()==null){


		$utilisateurDAO->modifierUnUtilisateur($utilisateur);

	}elseif($utilisateur->estValide() && $utilisateur->getMotDePasse()!=null){

		$utilisateurDAO->modifierUnUtilisateurAvecMotDePasse($utilisateur);

	}else{
		global $listeErreurs;
		global $utilisateurErreurModif;
		$listeErreurs = $utilisateur->getErreursActives();
		$utilisateurErreurModif = $utilisateur;
	}
}


$utilisateur = $utilisateurDAO->lireUnUtilisateur($_SESSION['idLogin']);

?>
