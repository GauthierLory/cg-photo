<?php
/* Connexion à une base */
class PDOConnexion {
  private $dbname = 'travelcextadmin';
  private $dbuser = 'travelcextadmin';
  private $dbpass = '4NaQbcr41pW';
  private $dbhost = 'travelcextadmin.mysql.db';

  // private $dbname = 'travelcextadmin';
  // private $dbuser = 'root';
  // private $dbpass = '';
  // private $dbhost = 'localhost';

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
