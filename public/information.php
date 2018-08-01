<?php

//Appel des autres vues
require_once('menu.php');
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<div id="page-information">
	<div class='page'>
	<h2 class="titre-a-propos"><?php echo APROPOS_TITRE?></h2>
        <div id="contenu">
			<?php echo APROPOS_TEXTE?>
		</div>
	</div>
</div>
<div id="map"></div>
        <script>
          function initMap() {
          var matane = {lat: 48.841032, lng: -67.496641};
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: matane
          });
          var marker = new google.maps.Marker({
            position: matane,
            map: map
          });
          }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUG2QyHKjCkg4iqTB4n0IFsyUI9Htzyuk&callback=initMap">
        </script> 
<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
