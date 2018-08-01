<?php
/* DAO de la table comptes */
require_once('Connection.php');

class FactureDAO {

  private $connexion;
  private $base;
  private $resultat;
  private $requete;

  public function __construct() {
    $this->base = new PDOConnexion();
    $this->connexion = $this->base->getConnection();
  }

  public function listerLesFactures($facture1ereARecuperer,$facturesParPage) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Facture ORDER BY id_transaction DESC LIMIT ?,?');
      $this->requete->bindParam(1, $facture1ereARecuperer, PDO::PARAM_INT);
      $this->requete->bindParam(2, $facturesParPage, PDO::PARAM_INT);
      $this->requete->execute();
      $listeEnregistrementFactures = $this->requete->fetchAll();

      foreach($listeEnregistrementFactures as $numeroEnregistrement => $enregistrementFactures){
    		$facture = new Facture() ;
    		$facture->construireAvecDonneesSecurisees(
    			$enregistrementFactures['id_transaction'],
    			$enregistrementFactures['id_utilisateur'],
    			$enregistrementFactures['client_transaction'],
    			$enregistrementFactures['date'],
    			$enregistrementFactures['montant'],
    			$enregistrementFactures['devise']);
    			$listeFactures[] = $facture;
       }
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
    return $listeFactures;
  }

  public function listerLesFacturesDuClient($id) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Facture WHERE id_utilisateur = ? ORDER BY id_transaction DESC');
      $this->requete->execute(array($id));
      $this->requete->execute();
      $listeEnregistrementFactures = $this->requete->fetchAll();

      foreach($listeEnregistrementFactures as $numeroEnregistrement => $enregistrementFactures){
    		$facture = new Facture() ;
    		$facture->construireAvecDonneesSecurisees(
    			$enregistrementFactures['id_transaction'],
    			$enregistrementFactures['id_utilisateur'],
    			$enregistrementFactures['client_transaction'],
    			$enregistrementFactures['date'],
    			$enregistrementFactures['montant'],
    			$enregistrementFactures['devise']);
    			$listeFactures[] = $facture;
       }
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
    return $listeFactures;
  }

  public function compterLesFactures() {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT COUNT(*) FROM Facture');
      $this->requete->execute();
      $nombreFactures = $this->requete->fetch();
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
    return $nombreFactures[0];
  }

  public function lireUneFacture($id) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Facture WHERE id_facture = ?');
      $this->requete->execute(array($id));
      return $this->requete;
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function ajouterUneFacture($facture) {
    try
    {
      $this->requete = $this->connexion->prepare('INSERT INTO Facture (id_transaction, id_utilisateur, client_transaction, date, montant, devise) VALUES (?,?,?,now(),?,?)');
      $this->requete->execute(array($facture->getIdTransaction(),$facture->getIdUtilisateur(),$facture->getClientTransaction(),$facture->getMontant(),$facture->getDevise()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function modifierUneFacture($facture) {
    try
    {
      $this->requete = $this->connexion->prepare('UPDATE Facture SET nom = ?,email = ?, message =?, date = ? WHERE id_facture = ?');
      $this->requete->execute($facture);
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function supprimerUneFacture($id) {
    try
    {
      $this->requete = $this->connexion->prepare('DELETE FROM Facture WHERE id_facture = ?');
      $this->requete->execute(array($id));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  function __destruct() {
    $this->requete = null;
    $this->resultat = null;
    $this->base->closeConnection();
  }

}
?>
