<?php
require_once('menu.php');
require_once(PATH_BDD.'FactureDAO.php');
require_once(PATH_MODELES.'Facture.php');
require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');

$utilisateurDAO = new UtilisateurDAO();

$factureDAO = new FactureDAO();
$nombreFactures = $factureDAO->compterLesFactures();

$facturesParPage = intval(18);
$nombreDePage = ceil($nombreFactures/$facturesParPage);

if(isset($_GET['page']) && $_GET['page'] > 0 && !empty($_GET['page'])){

  $pageActuelle = intval($_GET['page']);

  if($pageActuelle > $nombreDePage){
    $pageActuelle = $nombreDePage;
  }

}else {
  $pageActuelle = 1;
}

$pageSuivante = $pageActuelle+1;
$pagePrecedente = $pageActuelle-1;

$facture1ereARecuperer = intval(($pageActuelle-1)*$facturesParPage);
$listeFactures = $factureDAO->listerLesFactures($facture1ereARecuperer,$facturesParPage);


?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

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

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?php if($pageActuelle == 1) echo 'disabled' ?>">
      <a class="page-link" href="<?php echo '?page=1'?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item <?php if($pageActuelle == 1) echo 'disabled' ?>">
      <a class="page-link" href="<?php echo '?page='.$pagePrecedente; ?>" aria-label="Previous">
        <span aria-hidden="true">&lsaquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php for ($i=max($pageActuelle-2, 1); $i<=max(1, min($nombreDePage,$pageActuelle+2)); $i++) {
    ?>
      <li class="page-item"><a class="page-link" href="<?php echo '?page='.$i; ?>"><?php echo $i;?></a></li>
    <?php
    }
    ?>
    <li class="page-item <?php if($pageActuelle == $nombreDePage) echo 'disabled' ?>">
      <a class="page-link" href="<?php echo '?page='.$pageSuivante; ?>" aria-label="Next">
        <span aria-hidden="true">&rsaquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
    <li class="page-item <?php if($pageActuelle == $nombreDePage) echo 'disabled' ?>">
      <a class="page-link" href="<?php echo '?page='.$nombreDePage; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">DERNIERE</span>
      </a>
    </li>
  </ul>
</nav>
</main>

<?php
require_once('footer.php');

?>
