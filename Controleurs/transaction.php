<?php
if(!isset($_SESSION))
{
  session_start();
}

require_once(PATH_CONTROLEURS.'panier.php');
require_once(PATH_CONTROLEURS.'mail.php');
require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_BDD.'FactureDAO.php');
require_once(PATH_MODELES.'Facture.php');
require_once(PATH_BDD.'AchatDAO.php');
require_once(PATH_MODELES.'Achat.php');
require('Stripe.php');

$utilisateurDAO = new UtilisateurDAO();
$utilisateur = $utilisateurDAO->lireUnUtilisateur($_SESSION['idLogin']);

// recupreation des informations


// check si les champs sont vides
if (isset($_POST['stripeToken']) && isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom'])){

    $token = $_POST['stripeToken'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    // on charge la page Stripe.php
    $utilisateur->setNom($nom);
    $utilisateur->setPrenom($prenom);
    $utilisateur->setEmail($email);

    if($utilisateur->estValide()){

      $stripe = new Stripe('sk_test_HyBQwXzjtS8itNlSojSiJpat');
      // on donne en parametre l'appelle de l'url et les donnees
      $client = $stripe->api('customers', [
          'source' => $token,
          'description' => $nom,
          'email' => $email
      ]);
      // on cree le paiement
      $chargementPaiement = $stripe->api('charges',[
          'amount' => $montant*100,
          'currency' => 'eur',
          'customer' => $client->id
      ]);

      // var_dump($chargementPaiement);
      // echo $chargementPaiement->id;
      $facture = new Facture();
      $facture->construire($chargementPaiement->id, $_SESSION['idLogin'], $chargementPaiement->customer, $montant, $chargementPaiement->currency);

      $factureDAO = new FactureDAO();
      $factureDAO->ajouterUneFacture($facture);

      foreach ($listePanierPhoto as $photo) {
        $achat = new Achat();
        $achat->construireAvecDonneesSecurisees($photo, $chargementPaiement->id);
        $achatDAO = new AchatDAO();
        $achatDAO->ajouterUnAchat($achat);
      }

      // die('Votre paiement a bien été enregistré');

      envoyerPhotoParMail($utilisateur,$listePhotos);

      setcookie('panier',"", 0, '/' );

  	}else{
  		global $listeErreurs;
  		global $utilisateurErreurAjout;
  		$listeErreurs = $utilisateur->getErreursActives();
  		$utilisateurErreurAjout = $utilisateur;
  	}


}
