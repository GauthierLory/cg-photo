<?php
function afficherBarreLangues($langueCourante){
  $imageDrapeau = null;
  $autreLangue = null;
  $imageDrapeauAutreLangue = null;
  $actionFormulaire = PATH_PUBLIC.PATH_CONTROLEURS.'langue.php';
  $nomPageCourante = basename($_SERVER['REQUEST_URI'],'.php');

  switch ($langueCourante) {
    case 'fr':
        $imageDrapeau = PATH_IMAGES.PATH_ICONES.'drapeau_fr.png';
        $imageDrapeauAutreLangue = PATH_PUBLIC.PATH_IMAGES.PATH_ICONES.'drapeau_en.png';
        $autreLangue = 'en';
        break;
    case 'en':
        $imageDrapeau = PATH_IMAGES.PATH_ICONES.'drapeau_en.png';
        $imageDrapeauAutreLangue = PATH_IMAGES.PATH_ICONES.'drapeau_fr.png';
        $autreLangue = 'fr';
        break;
    default :
        $imageDrapeau = PATH_IMAGES.PATH_ICONES.'drapeau_fr.png';
        $imageDrapeauAutreLangue = PATH_IMAGES.PATH_ICONES.'drapeau_en.png';
        $autreLangue = 'en';
}

?>
  <li class="menu-langue"><a href="#"><img id="langue-actuelle" src="<?php echo $imageDrapeau ?>" alt="traduction"></a>
      <ul class="submenu">
        <li>
            <form action="<?php echo $actionFormulaire ?>" method="POST">
              <input type="hidden" name="page_langue" value="<?php echo $nomPageCourante ?>"/>
              <input name="langue" type="hidden"  value="<?php echo $autreLangue ?>"/>
              <input id="langue-proposee" src="<?php echo $imageDrapeauAutreLangue ?>" type="image" alt="English" value="submit"/>
            </form>
        </li>
      </ul>
  </li>
<?php
}
 ?>
