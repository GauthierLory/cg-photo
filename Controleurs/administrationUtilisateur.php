<?php
require_once('../Configuration/Configuration.php');

require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');

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

  $utilisateur = new Utilisateur();

	$utilisateur->setNom($_POST['nom']);
	$utilisateur->setPrenom($_POST['prenom']);
	$utilisateur->setEmail($_POST['email']);
	$utilisateur->setPseudo($_POST['pseudo']);
	$utilisateur->setMotDePasse(password_hash($_POST['mdp'], PASSWORD_BCRYPT));
	$estAdmin = 0;

	if(isset($_POST['estAdministrateur'])){
		$estAdmin = 1;
	}

	$utilisateur->setAdministrateur($estAdmin);

	if($utilisateur->estValide()){
		$utilisateurDAO = new UtilisateurDAO();

		$utilisateurDAO->ajouterUnUtilisateur($utilisateur);

	}else{
		global $listeErreurs;
		global $utilisateurErreurAjout;
		$listeErreurs = $utilisateur->getErreursActives();
		$utilisateurErreurAjout = $utilisateur;
	}

}

function modifier(){

	$utilisateur = new Utilisateur();
	$utilisateur->setIdUtilisateur($_POST['id']);
	$utilisateur->setNom($_POST['nom']);
	$utilisateur->setPrenom($_POST['prenom']);
	$utilisateur->setEmail($_POST['email']);
	$utilisateur->setPseudo($_POST['pseudo']);

	if(isset($_POST['mdp']) && !empty($_POST['mdp'])){

		$utilisateur->setMotDePasse(password_hash($_POST['mdp'], PASSWORD_BCRYPT));
	}
	$estAdmin = 0;

	if(isset($_POST['estAdministrateur'])){
		$estAdmin = 1;
	}

	$utilisateur->setAdministrateur($estAdmin);

	if($utilisateur->estValide() && $utilisateur->getMotDePasse()==null){

		$utilisateurDAO = new UtilisateurDAO();

		$utilisateurDAO->modifierUnUtilisateur($utilisateur);

	}elseif($utilisateur->estValide() && $utilisateur->getMotDePasse()!=null){
		$utilisateurDAO = new UtilisateurDAO();

		$utilisateurDAO->modifierUnUtilisateurAvecMotDePasse($utilisateur);

	}else{
		global $listeErreurs;
		global $utilisateurErreurModif;
		$listeErreurs = $utilisateur->getErreursActives();
		$utilisateurErreurModif = $utilisateur;
	}
}

function supprimer(){

	$id = $_POST['id'];

  $utilisateurDAO = new UtilisateurDAO();
  $utilisateurDAO->supprimerUnUtilisateur($id);

}
?>
