<?php
/* DAO de la table comptes */
require_once('Connection.php');

class ContactDAO {

  private $connexion;
  private $base;
  private $resultat;
  private $requete;

  public function __construct() {
    $this->base = new PDOConnexion();
    $this->connexion = $this->base->getConnection();
  }

  public function listerLesContacts() {
    try
    {
      $this->resultat = $this->connexion->query('SELECT * FROM Contact');
      return $this->resultat->fetchAll();
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function lireUeContact($id) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Contact WHERE id_contact = ?');
      $this->requete->execute(array($id));
      return $this->requete;
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function ajouterUnContact($contact) {
    try
    {
      $this->requete = $this->connexion->prepare('INSERT INTO Contact (nom, email, message, date) VALUES (?,?,?,?)');
      $this->requete->execute($contact);
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function modifierUnContact($contact) {
    try
    {
      $this->requete = $this->connexion->prepare('UPDATE Contact SET nom = ?, email = ?, message = ?, date = ? WHERE id_contact = ?');
      $this->requete->execute($contact);
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function supprimerUnContact($id) {
    try
    {
      $this->requete = $this->connexion->prepare('DELETE FROM Contact WHERE id_contact = ?');
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
