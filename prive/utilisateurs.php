<?php
require_once('menu.php');
require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Utilisateur.php');
require_once(PATH_CONTROLEURS.'administrationUtilisateur.php');

$utilisateurDAO = new UtilisateurDAO();
$nombreUtilisateurs = $utilisateurDAO->compterLesUtilisateurs();

$utilisateursParPage = intval(7);
$nombreDePage = ceil($nombreUtilisateurs/$utilisateursParPage);

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

$utilisateur1erARecuperer = intval(($pageActuelle-1)*$utilisateursParPage);

$listeUtilisateurs = $utilisateurDAO->listerLesUtilisateurs($utilisateur1erARecuperer,$utilisateursParPage);

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <h2>Liste des utilisateurs</h2>
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
        <form class="" action="utilisateurs.php" method="POST">
            <table class="table table-striped table-sm">

                <thead>
                <tr>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Administrateur</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="prenom" value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getPrenom(); ?>"/></td>
                    <td><input type="text" class="form-control" name="nom" value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getNom(); ?>"/></td>
                    <td><input type="text" class="form-control" name="pseudo" value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getPseudo(); ?>"/></td>
                    <td><input type="text" type="email" class="form-control" name="email" value="<?php if (isset($utilisateurErreurAjout)) echo $utilisateurErreurAjout->getEmail(); ?>"/></td>
                    <td><input type="password" type="password" class="form-control" name="mdp" value=""/></td>
                    <td><input type="checkbox" name="estAdministrateur" value="1" ></td>
                    <td><input type="submit" class="btn btn-success" name="action" value="Ajouter"/></td>
                </tr>
                </tbody>
            </table>
        </form>

        <?php
        foreach ($listeUtilisateurs as $utilisateurALister) {
            ?>
            <form class="" action="utilisateurs.php" method="POST">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <td><input type="hidden" class="form-control" name="id" value="<?php echo $utilisateurALister->getIdUtilisateur();?>" readonly/></td>
                        <td><input type="text" class="form-control" name="prenom" value="<?php echo isset($utilisateurErreurModif) && $utilisateurErreurModif->getIdUtilisateur()==$utilisateurALister->getIdUtilisateur() ? $utilisateurErreurModif->getPrenom() : $utilisateurALister->getPrenom();?>"/></td>
                        <td><input type="text" class="form-control" name="nom" value="<?php echo isset($utilisateurErreurModif) && $utilisateurErreurModif->getIdUtilisateur()==$utilisateurALister->getIdUtilisateur() ? $utilisateurErreurModif->getNom() : $utilisateurALister->getNom();?>"/></td>
                        <td><input type="text" class="form-control" name="pseudo" value="<?php echo isset($utilisateurErreurModif) && $utilisateurErreurModif->getIdUtilisateur()==$utilisateurALister->getIdUtilisateur() ? $utilisateurErreurModif->getPseudo() : $utilisateurALister->getPseudo();?>"/></td>
                        <td><input type="text" class="form-control" name="email" value="<?php echo isset($utilisateurErreurModif) && $utilisateurErreurModif->getIdUtilisateur()==$utilisateurALister->getIdUtilisateur() ? $utilisateurErreurModif->getEmail() : $utilisateurALister->getEmail();?>"/></td>
                        <td><input type="password" class="form-control" name="mdp" value=""/></td>
                        <td><input type="checkbox" name="estAdministrateur" value="1" <?php if(isset($utilisateurErreurModif) && $utilisateurErreurModif->getIdUtilisateur()==$utilisateurALister->getIdUtilisateur() && $utilisateurErreurModif->estAdministrateur()){echo "checked";} elseif ($utilisateurALister->estAdministrateur()) {
                                echo "checked";
                            } ?> ></td>
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
