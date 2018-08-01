<?php
/* Connexion à une base */
class PDOConnexion {

  private $dbname = DB_NAME;
  private $dbuser = DB_USERNAME;
  private $dbpass = DB_MDP;
  private $dbhost = DB_HOST;

  private $connexion = null;

  function __construct() {

  }

  public function getConnection() {
    try
    {
      $this->connexion = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass);
      $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->connexion;

    }
    catch(Exception $e)
    {
        echo 'Echec de la connexion à la base de données : '.$e;
        exit();
    }
  }

  public function closeConnection() {
    $this->connexion = null;
  }

  function __destruct() {

  }

}
?>
