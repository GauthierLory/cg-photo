<?php
require_once('../Configuration/Configuration.php');
require_once('Connection.php');
require_once(PATH_MODELES.'Photo.php');

class PhotoDAO {

  private $connexion;
  private $base;
  private $resultat;
  private $requete;

  public function __construct() {
    $this->base = new PDOConnexion();
    $this->connexion = $this->base->getConnection();
  }

  public function compterLesPhotos() {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT COUNT(*) FROM Photo');
      $this->requete->execute();
      $nombrePhoto = $this->requete->fetch();
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
    return $nombrePhoto[0];
  }

  public function listerLesPhotosLimite($photo1ereARecuperer,$photosParPage) {
    $listePhotos = [];
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Photo ORDER BY id_photo DESC LIMIT ?,?');
      $this->requete->bindParam(1, $photo1ereARecuperer, PDO::PARAM_INT);
      $this->requete->bindParam(2, $photosParPage, PDO::PARAM_INT);
      $this->requete->execute();
      $listeEnregistrementPhotos = $this->requete->fetchAll();

      foreach($listeEnregistrementPhotos as $numeroEnregistrement => $enregistrementPhotos){
    		$photo = new Photo() ;
    		$photo->construireAvecDonneesSecurisees(
    			$enregistrementPhotos['id_photo'],
    			$enregistrementPhotos['id_utilisateur'],
    			$enregistrementPhotos['nom'],
    			$enregistrementPhotos['date'],
    			$enregistrementPhotos['description']);
    			$listePhotos[] = $photo;
       }

    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }

    return $listePhotos;
  }

  public function listerLesPhotos() {
    $listePhotos = [];
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Photo');
      $this->requete->execute();
      $listeEnregistrementPhotos = $this->requete->fetchAll();

      foreach($listeEnregistrementPhotos as $numeroEnregistrement => $enregistrementPhotos){
    		$photo = new Photo() ;
    		$photo->construireAvecDonneesSecurisees(
    			$enregistrementPhotos['id_photo'],
    			$enregistrementPhotos['id_utilisateur'],
    			$enregistrementPhotos['nom'],
    			$enregistrementPhotos['date'],
    			$enregistrementPhotos['description']);
    			$listePhotos[] = $photo;
       }

    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }

    return $listePhotos;
  }

  public function listerLesPhotosUtilisateur($id_utilisateur) {
    $listePhotos=[];
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Photo WHERE id_utilisateur = ?');
      $this->requete->execute(array($id_utilisateur));
      $listeEnregistrementPhotos = $this->requete->fetchAll();

      foreach($listeEnregistrementPhotos as $numeroEnregistrement => $enregistrementPhotos){
    		$photo = new Photo() ;
    		$photo->construireAvecDonneesSecurisees(
    			$enregistrementPhotos['id_photo'],
    			$enregistrementPhotos['id_utilisateur'],
    			$enregistrementPhotos['nom'],
    			$enregistrementPhotos['date'],
    			$enregistrementPhotos['description']);
    			$listePhotos[] = $photo;
       }

    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }

    return $listePhotos;
  }

  public function lireUnePhoto($id) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Photo WHERE id_photo = ?');
      $this->requete->execute(array($id));
      $enregistrementPhoto = $this->requete->fetch();

      $photo = new Photo() ;
      $photo->construireAvecDonneesSecurisees(
        $enregistrementPhoto['id_photo'],
        $enregistrementPhoto['id_utilisateur'],
        $enregistrementPhoto['nom'],
        $enregistrementPhoto['date'],
        $enregistrementPhoto['description']);

      return $photo;
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function ajouterUnePhoto($photo) {
    try
    {
      $this->requete = $this->connexion->prepare('INSERT INTO Photo (id_utilisateur, nom, date, description) VALUES (?,?,now(),?)');
      $this->requete->execute(array($photo->getIdUtilisateur(),$photo->getNom(),$photo->getDescription()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function modifierUnePhoto($photo) {
    try
    {
      $this->requete = $this->connexion->prepare('UPDATE Photo SET id_utilisateur = ?, nom = ?, description = ? WHERE id_photo = ?');
      $this->requete->execute(array($photo->getIdUtilisateur(),$photo->getNom(),$photo->getDescription(),$photo->getIdPhoto()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function supprimerUnePhoto($id) {
    try
    {
      $this->requete = $this->connexion->prepare('DELETE FROM Photo WHERE id_photo = ?');
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
