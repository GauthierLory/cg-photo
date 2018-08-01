<?php
//Appel de la vue footer
require_once('menu.php');
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<div id="page-contrat">
	<div class='page'>
	<h2 class="a-propros-licence"><?php echo APROPOS_LICENCE?></h2>
        <div id="contenu">
			<?php echo APROPOS_TEXTE_LICENCE?>
			<h3>
				<?php echo APROPOS_TEXTE_LICENCE_1?>
			</h3>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_1_1?>
			</p>
			<h3>
				<?php echo APROPOS_TEXTE_LICENCE_2?>
			</h3>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_2_1?>
			</p>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_2_2?>
			</p>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_2_3?>
			</p>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_2_4?>
			</p>
			<h3>
				<?php echo APROPOS_TEXTE_LICENCE_3?>
			</h3>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_3_1?>
			</p>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_3_2?>
			</p>
			<p>
				<?php echo APROPOS_TEXTE_LICENCE_3_3?>
			</p>
		</div>
	</div>
</div>

<div id="bouton-haut">
    <a href="#">
      <img src="decorations/images/icones/fleche.png" alt="Vers le haut">
    </a>
  </div>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>