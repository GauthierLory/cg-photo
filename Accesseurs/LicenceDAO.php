<?php
require_once('Connection.php');

class LicenceDAO {

  private $connexion;
  private $base;
  private $resultat;
  private $requete;

  public function __construct() {
    $this->base = new PDOConnexion();
    $this->connexion = $this->base->getConnection();
  }

  public function listerLesLicences() {
    try
    {
      $this->resultat = $this->connexion->query('SELECT * FROM LicencePersonelle');
      return $this->resultat->fetchAll();
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function lireUneLicence($id) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM LicencePersonelle WHERE id = ?');
      $this->requete->execute(array($id));
      return $this->requete;
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
