<?php
require_once('menu.php');
// require_once('Controleurs/photos.php');
require_once(PATH_BDD.'PhotoDAO.php');
require_once(PATH_MODELES.'Photo.php');
require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');
require_once(PATH_CONTROLEURS.'administrationPhoto.php');

$photoDAO = new PhotoDAO();
$nombrePhotos = $photoDAO->compterLesPhotos();

$utilisateurDAO = new UtilisateurDAO();
$listeNomsUtilisateurs = $utilisateurDAO->listerLesNomsUtilisateurs();

$photosParPage = intval(7);
$nombreDePage = ceil($nombrePhotos/$photosParPage);

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

$photo1ereARecuperer = intval(($pageActuelle-1)*$photosParPage);

$listePhotos = $photoDAO->listerLesPhotosLimite($photo1ereARecuperer,$photosParPage);

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <h2>Liste des photos</h2>
  <?php if (isset($listeErreurs)){
    ?>
    <div class="alert-rouge">
      <span class="bouton-fermer" onclick="this.parentElement.style.display='none';">&times;</span>
      <?php
      foreach ($listeErreurs as $erreur) {
          echo $erreur[0].'</br>';
      }
      ?>
    </div>
    <?php
    }
    ?>

  <div class="table-responsive">
    <form class="" action="photos.php" method="POST">
      <table class="table table-striped table-sm">

        <thead>
          <tr>
            <th>Utilisateur</th>
            <th>Nom</th>
            <th>Date d'ajout</th>
            <th>Description</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              <select name="id_utilisateur" class="form-control">
                <?php foreach ($listeNomsUtilisateurs as $nomsUtilisateur) {
                ?>
                  <option value="<?php echo $nomsUtilisateur->getIdUtilisateur() ?>"><?php echo $nomsUtilisateur->getIdUtilisateur().' - '.$nomsUtilisateur->getPrenom().' '.$nomsUtilisateur->getNom(); ?></option>
                <?php
                }
                ?>
              </select>
            </td>
            <td><input type="text" class="form-control" name="nom" value="<?php if (isset($photoErreurAjout)) echo $photoErreurAjout->getNomSansExtention(); ?>"/></td>
            <td><input type="text" class="form-control" name="date" value="" placeholder="Date générée automatiquement" disabled/></td>
            <td><input type="textarea" class="form-control" name="description" value="<?php if (isset($photoErreurAjout)) echo $photoErreurAjout->getDescription(); ?>"/></td>
            <td><input type="submit" name="action" class="btn btn-success" value="Ajouter"/></td>
          </tr>
        </tbody>
      </table>
    </form>

  <?php
  foreach ($listePhotos as $photoALister) {
  ?>
    <form class="" action="photos.php" method="POST">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <td><input type="hidden" class="form-control" name="id-photo" value="<?php echo $photoALister->getIdPhoto(); ?>" readonly/></td>
            <td>
              <select name="id_utilisateur" class="form-control">
                <?php
                foreach ($listeNomsUtilisateurs as $nomsUtilisateur) {
                ?>
                  <option value="<?php echo $nomsUtilisateur->getIdUtilisateur(); ?>"<?php if($photoALister->getIdUtilisateur()==$nomsUtilisateur->getIdUtilisateur() && !isset($photoErreurModif)){echo "selected";} elseif (isset($photoErreurModif) && $photoALister->getIdPhoto()==$photoErreurModif->getIdPhoto()) {
                    echo "selected";
                  } ?>><?php echo $nomsUtilisateur->getIdUtilisateur().' - '.$nomsUtilisateur->getPrenom().' '.$nomsUtilisateur->getNom(); ?></option>
                <?php
                }
                ?>
              </select>
            </td>
            <td><input type="text" class="form-control" name="nom" value="<?php echo isset($photoErreurModif) && $photoErreurModif->getIdPhoto()==$photoALister->getIdPhoto() ? $photoErreurModif->getNomSansExtention() : $photoALister->getNomSansExtention();?>"/></td>
            <td><input type="text" class="form-control" name="date" value="<?php echo $photoALister->getDate();?>" readonly/></td>
            <td><input type="textarea" class="form-control" name="description" value="<?php echo isset($photoErreurModif) && $photoErreurModif->getIdPhoto()==$photoALister->getIdPhoto() ? $photoErreurModif->getDescription() : $photoALister->getDescription();?>"/></td>
            <td><input type="submit" name="action" class="btn btn-warning" value="Modifier"/></td>
            <td><input type="submit" name="action" class="btn btn-danger" value="Supprimer"/></td>
          </tr>
        </tbody>
      </table>
    </form>
  <?php
  }
  ?>
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
