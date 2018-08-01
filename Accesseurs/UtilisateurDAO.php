<?php
require_once('../Configuration/Configuration.php');

/* DAO de la table comptes */
require_once('Connection.php');
require_once(PATH_MODELES.'Utilisateur.php');

class UtilisateurDAO {

  private $connexion;
  private $base;
  private $resultat;
  private $requete;

  public function __construct() {
    $this->base = new PDOConnexion();
    $this->connexion = $this->base->getConnection();
  }

  public function listerLesUtilisateurs($utilisateur1erARecuperer,$utilisateursParPage) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Utilisateur ORDER BY id_utilisateur DESC LIMIT ?,?');
      $this->requete->bindParam(1, $utilisateur1erARecuperer, PDO::PARAM_INT);
      $this->requete->bindParam(2, $utilisateursParPage, PDO::PARAM_INT);
      $this->requete->execute();
      $listeEnregistrementUtilisateurs = $this->requete->fetchAll();

      foreach($listeEnregistrementUtilisateurs as $numeroEnregistrement => $enregistrementUtilisateurs){
    		$utilisateur = new Utilisateur() ;
    		$utilisateur->construireAvecDonneesSecurisees(
    			$enregistrementUtilisateurs['id_utilisateur'],
    			$enregistrementUtilisateurs['prenom'],
    			$enregistrementUtilisateurs['nom'],
    			$enregistrementUtilisateurs['pseudo'],
    			$enregistrementUtilisateurs['email'],
    			$enregistrementUtilisateurs['mot_de_passe'],
    			$enregistrementUtilisateurs['estAdministrateur']);
    			$listeUtilisateurs[] = $utilisateur;
       }
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
    return $listeUtilisateurs;
  }

  public function compterLesUtilisateurs() {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT COUNT(*) FROM Utilisateur');
      $this->requete->execute();
      $nombreUtilisateurs = $this->requete->fetch();
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
    return $nombreUtilisateurs[0];
  }

  public function listerLesNomsUtilisateurs() {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT id_utilisateur,prenom, nom FROM Utilisateur');
      $this->requete->execute();
      $listeEnregistrementUtilisateurs = $this->requete->fetchAll();

      foreach($listeEnregistrementUtilisateurs as $numeroEnregistrement => $enregistrementUtilisateurs){
    		$nomsUtilisateur = new Utilisateur() ;
    		$nomsUtilisateur->construirePourListeNoms(
          $enregistrementUtilisateurs['id_utilisateur'],
    			$enregistrementUtilisateurs['prenom'],
    			$enregistrementUtilisateurs['nom']);
    			$listeNomsUtilisateurs[] = $nomsUtilisateur;
       }
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
    return $listeNomsUtilisateurs;
  }

  public function lireUnUtilisateur($id) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur = ?');
      $this->requete->execute(array($id));
      $enregistrementUtilisateur = $this->requete->fetch();
      $nomsUtilisateur = new Utilisateur() ;
      $nomsUtilisateur->construireAvecDonneesSecurisees(
        $enregistrementUtilisateur['id_utilisateur'],
        $enregistrementUtilisateur['prenom'],
        $enregistrementUtilisateur['nom'],
        $enregistrementUtilisateur['pseudo'],
        $enregistrementUtilisateur['email'],
        $enregistrementUtilisateur['mot_de_passe'],
        $enregistrementUtilisateur['estAdministrateur']);

        return $nomsUtilisateur;
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function ajouterUnUtilisateur($utilisateur) {
    try
    {
      $this->requete = $this->connexion->prepare('INSERT INTO Utilisateur (prenom, nom, pseudo, email, mot_de_passe, estAdministrateur) VALUES (?,?,?,?,?,?)');
      $this->requete->execute(array($utilisateur->getPrenom(),$utilisateur->getNom(),$utilisateur->getPseudo(),$utilisateur->getEmail(),$utilisateur->getMotDePasse(),$utilisateur->estAdministrateur()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function modifierUnUtilisateur($utilisateur) {
    try
    {
      $this->requete = $this->connexion->prepare('UPDATE Utilisateur SET prenom = ?, nom = ?, pseudo = ?, email = ?, estAdministrateur = ? WHERE id_utilisateur = ?');
      $this->requete->execute(array($utilisateur->getPrenom(),$utilisateur->getNom(),$utilisateur->getPseudo(),$utilisateur->getEmail(),$utilisateur->estAdministrateur(),$utilisateur->getIdUtilisateur()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function modifierUnUtilisateurAvecMotDePasse($utilisateur) {
    try
    {
      $this->requete = $this->connexion->prepare('UPDATE Utilisateur SET prenom = ?, nom = ?, pseudo = ?, email = ?, mot_de_passe = ?, estAdministrateur = ? WHERE id_utilisateur = ?');
      $this->requete->execute(array($utilisateur->getPrenom(),$utilisateur->getNom(),$utilisateur->getPseudo(),$utilisateur->getEmail(),$utilisateur->getMotDePasse(),$utilisateur->estAdministrateur(),$utilisateur->getIdUtilisateur()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function modifierUnUtilisateurAdmin($utilisateur) {
    try
    {
      $this->requete = $this->connexion->prepare('UPDATE Utilisateur SET prenom = ?, nom = ?, pseudo = ?, email = ?, estAdministrateur = ? WHERE id_utilisateur = ?');
      $this->requete->execute(array($utilisateur->getPrenom(),$utilisateur->getNom(),$utilisateur->getPseudo(),$utilisateur->getEmail(),$utilisateur->estAdministrateur(),$utilisateur->getIdUtilisateur()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function modifierUnUtilisateurAvecMotDePasseAdmin($utilisateur) {
    try
    {
      $this->requete = $this->connexion->prepare('UPDATE Utilisateur SET prenom = ?, nom = ?, pseudo = ?, email = ?, mot_de_passe = ?, estAdministrateur = ? WHERE id_utilisateur = ?');
      $this->requete->execute(array($utilisateur->getPrenom(),$utilisateur->getNom(),$utilisateur->getPseudo(),$utilisateur->getEmail(),$utilisateur->getMotDePasse(),$utilisateur->estAdministrateur(),$utilisateur->getIdUtilisateur()));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function supprimerUnUtilisateur($id) {
    try
    {
      $this->requete = $this->connexion->prepare('DELETE FROM Utilisateur WHERE id_utilisateur = ?');
      $this->requete->execute(array($id));
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function verificationUtilisateur($utilisateur) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT id_utilisateur, mot_de_passe FROM Utilisateur WHERE pseudo = ?');
      $this->requete->execute(array($utilisateur->getPseudo()));
      $id = $this->requete->fetch();
      if($id == null){
        return $id=-1;
      }elseif (password_verify($utilisateur->getMotDePasse(),$id[1])) {
        return $id[0];
      }
    }
    catch(Exception $e)
    {
        echo $e;
        exit();
    }
  }

  public function estAdministrateur($utilisateur) {
    try
    {
      $this->requete = $this->connexion->prepare('SELECT id_utilisateur, mot_de_passe FROM Utilisateur WHERE pseudo = ? AND estAdministrateur = 1');
      $this->requete->execute(array($utilisateur->getPseudo()));
      $resultatRequete = $this->requete->fetch();
      if (password_verify($utilisateur->getMotDePasse(),$resultatRequete[1])) {
        return 1;
      }
	  return 0;

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
