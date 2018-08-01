<?php
require_once('Connection.php');

class AchatDAO {

  private $connexion;
  private $base;
  private $resultat;
  private $requete;

  public function __construct() {
    $this->base = new PDOConnexion();
    $this->connexion = $this->base->getConnection();
  }

  public function listerLesAchat() {
    try
    {
      $this->resultat = $this->connexion->query('SELECT * FROM Achat');
      return $this->resultat->fetchAll();
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function lireUnAchat($id) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Achat WHERE id = ?');
      $this->requete->execute(array($id));
      return $this->requete;
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function ajouterUnAchat($achat) {
    try
    {
      $this->requete = $this->connexion->prepare('INSERT INTO Achat (id_facture, id_photo) VALUES (?,?)');
      $this->requete->execute(array($achat->getIdFacture(),$achat->getIdPhoto()));
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
