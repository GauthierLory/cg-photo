<?php
require_once('../Configuration/Configuration.php');

require_once(PATH_BDD.'FactureDAO.php');
require_once(PATH_MODELES.'Facture.php');

if(isset($_POST)){

  if (isset($_POST['id']) && isset($_POST['nom'])  && isset($_POST['email'])  && isset($_POST['date'])){

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    $facture = new Facture(0,$id,$nom,$email,$date);

    $factureDAO = new FactureDAO();
    $id = $factureDAO->ajouterUneFacture($facture);

    header("Location:../../prive/factures");

  }

}

if(isset($_POST)){

    if($_POST['action'] == 'Modifier'){

      if (isset($_POST['id']) && isset($_POST['nom'])  && isset($_POST['email'])  && isset($_POST['date'])){

        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $date = $_POST['date'];

        $facture = new Facture(0,$id,$nom,$email,$date);

        $factureDAO = new FactureDAO();
        $id = $factureDAO->ajouterUneFacture($facture);

        header("Location:../../prive/factures");

      }

    }elseif ($_POST['action'] == 'Supprimer') {

        if (isset($_POST['id'])) {

            $id = $_POST['id'];
            $factureDAO = new FactureDAO();
            $id = $factureDAO->supprimerUneFacture($facture);

            header("Location:../../prive/factures");
        }
        # code...
    }

}
?>
