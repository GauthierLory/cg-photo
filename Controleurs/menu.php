<?php

//Séléction de la langue en fonction du cookie langue
if(isset($_COOKIE['langue'])){
	$langue = $_COOKIE['langue'];
}
else {
  $langue = 'fr';
}

if(isset($langue) && $langue=='fr'){
	require_once(PATH_TEXTES.PATH_FR.'texte.php');
}
elseif (isset($langue) && $langue=='en') {
	require_once(PATH_TEXTES.PATH_EN.'texte.php');
}
else{
	require_once(PATH_TEXTES.PATH_FR.'texte.php');
}

?>
