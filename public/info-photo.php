<?php
if(!isset($_GET['photo'])){
	header("Location:../404");
}
//Appel des autres vues
require_once('menu.php');
require_once(PATH_BDD.'PhotoDAO.php');
require_once(PATH_BDD.'UtilisateurDAO.php');
require_once(PATH_MODELES.'Photo.php');
require_once(PATH_CONTROLEURS.'gestionPanier.php');
require_once('alerte.php');

$photoDAO = new PhotoDAO();
$utilisateurDAO = new UtilisateurDAO();
$id_photo = $_GET['photo'];
$photo = $photoDAO->lireUnePhoto($id_photo);
if($photo->getIdPhoto()==null){
	header("Location:../404");
};
$utilisateur = $utilisateurDAO->lireUnUtilisateur($photo->getIdUtilisateur());
$auteur = $utilisateur->getPrenom().' '.$utilisateur->getNom();
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<div id="affichage-information-photo">
	<h2><?php echo INFOPHOTO_TITRE ?></h2>
	<div id="photo-selection">
		<img src="<?php echo PATH_PHOTOS_COPYRIGHT.$photo->getNom() ?>" border="2" alt="photo a vendre">
	</div>
	<div id="cadre-information-photo" >
		<table id="label-information">
			<tr>
				<td><label><?php echo INFOPHOTO_LBLNOM ?></label></td>
				<td><label><?php echo INFOPHOTO_LBLAUTEUR ?></label></td>
				<td><label><?php echo INFOPHOTO_LBLDATE ?></label></td>
				<td><label><?php echo INFOPHOTO_LBLDESCRIPTION ?></label></td>
				<td><label><?php echo INFOPHOTO_LBLPRIX ?></label></td>
                <td><label>Licence standard</label></td>
			</tr>
			<tr>
				<td><label><?php echo $photo->getNom() ?></label></td>
				<td><label><?php echo $auteur ?></label></td>
				<td><label><?php echo $photo->getDate() ?></label></td>
				<td><label><?php echo $photo->getDescription() ?></label></td>
				<td><label><?php echo INFOPHOTO_PRIX ?></label></td>
                <td><a href="contrat">Licence information</a></td>
			</tr>
		</table>
		<form id="photo-ajout-panier" method="POST" action="<?php echo 'info-photo?photo='.$photo->getIdPhoto()?>">
			<input type="hidden" name="idAjoutPhoto" value="<?php echo $photo->getIdPhoto()?>">
			<input type="submit" name="achat" value="<?php echo INFOPHOTO_BOUTON ?>">
		</form>
	</div>
</div>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
