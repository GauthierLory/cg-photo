<?php
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_POST['idAjoutPhoto'])){

  $idPhoto = $_POST['idAjoutPhoto'];

  if(isset($_COOKIE['panier'])){
  	$panier = $_COOKIE['panier'];
    $listePanierPhoto = unserialize($panier);
    if (!in_array($idPhoto,$listePanierPhoto)){
      $listePanierPhoto[]=$idPhoto;
      setcookie('panier',serialize($listePanierPhoto), time() + 365 * 24 * 3600, '/' );
      $_SESSION['ajoutPanier'] = "reussi";
    }
    $_SESSION['ajoutPanier'] = "existante";
  }else{
    $listePanierPhoto = array();
    $listePanierPhoto[] = $idPhoto;
    setcookie('panier',serialize($listePanierPhoto), time() + 365 * 24 * 3600, '/' );
    $_SESSION['ajoutPanier'] = "reussi";
  }
}elseif (isset($_POST['idSuppressionPhoto']) && isset($_COOKIE['panier'])) {

  $idPhoto = $_POST['idSuppressionPhoto'];

  $panier = $_POST['panier'];
  $listePanierPhoto = unserialize($panier);

  if(sizeof($listePanierPhoto)>1){
    foreach ($listePanierPhoto as $key => $value) {
      if($value == $idPhoto){
        unset($listePanierPhoto[$key]);
        setcookie('panier',serialize($listePanierPhoto), time() + 365 * 24 * 3600, '/' );
        break;
      }
    }
  }else {
    setcookie('panier',"", 0, '/' );
  }

}

?>
