<?php
//Appel des autres vues
require_once('menu.php');

if(!isset($_SESSION['idLogin'])){
	header("Location:../connexion");
}

require_once(PATH_CONTROLEURS.'ajoutPhoto.php');
require_once('alerte.php');
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<div id="placement-valeur">
	<h2><?php echo AJOUTPHOTO_TITRE ?></h2>
	<div id="photo-selection">
		<img src="" style="display:none" border="2" id="image-input-file">
	</div>
		<div id="formulaire-envoie">
			<form method="post" action="ajout-photo" enctype="multipart/form-data" autocomplete="on">
				<table id="table-formulaire">
					<tr>
						<input class="saisie-formulaire" placeholder="<?php echo AJOUTPHOTO_NOM ?>" type="text"
                               name="nom" value="<?php if (isset($photoErreurAjout)) echo $photoErreurAjout->getNom(); ?>">
					</tr>
					<tr>
						<input class="saisie-formulaire" placeholder="<?php echo AJOUTPHOTO_DESCRIPTION ?>" type="textarea"
                               name="description" value="<?php if (isset($photoErreurAjout)) echo $photoErreurAjout->getDescription(); ?>">
					</tr>
					<tr>
						<input class="saisie-formulaire" type="file" name="fichier" onchange="affichageImage.call(this)">
						<script>
							function affichageImage()
							{
								if(this.files && this.files[0])
								{
									var obj = new FileReader();
									obj.onload = function(data)
									{
										var image = document.getElementById("image-input-file");
										image.src = data.target.result;
										image.style.display = "inline-block";
									}
									obj.readAsDataURL(this.files[0]);
								}
							}
						</script>
					</tr>
					<tr>
						<label><input class="bouton-envoie-formulaire" type="submit" value="<?php echo AJOUTPHOTO_BOUTON ?>" ></label>
					</tr>
				</table>
			</form>
		</div>
</div>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
