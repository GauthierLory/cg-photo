<?php
// if(!isset($_SESSION['idLogin'])){
// 	header("Location:../connexion");
// }
require_once('menu.php');
require_once(PATH_BDD.'FactureDAO.php');
require_once(PATH_MODELES.'Facture.php');
require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');

$factureDAO = new FactureDAO();
$listeFactures = $factureDAO->listerLesFacturesDuClient($_SESSION['idLogin']);
$utilisateurDAO = new UtilisateurDAO();

// $nb_visites = file_get_contents('../prive/pagesvues.txt');
// $nb_visites++;
// file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>

<main role="main" id="page-facture" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

<h2>Liste des factures</h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>Id Transaction</th>
        <th>Nom Utilisateur</th>
        <th>Client Transaction</th>
        <th>Date</th>
        <th>Montant</th>
        <th>Devise</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($listeFactures as &$facture) {
        $utilisateur = $utilisateurDAO->lireUnUtilisateur($facture->getIdUtilisateur());
        $nom = $utilisateur->getPrenom().' '.$utilisateur->getNom();
      ?>

        <tr>
          <td><?php echo $facture->getIdTransaction(); ?></td>
          <td><?php echo $nom ; ?></td>
          <td><?php echo $facture->getClientTransaction(); ?></td>
          <td><?php echo $facture->getDate(); ?></td>
          <td><?php echo $facture->getMontant(); ?></td>
          <td><?php echo $facture->getDevise(); ?></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<?php

require_once('piedDePage.php');
?>
