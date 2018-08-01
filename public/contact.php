<?php
require_once('menu.php');
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<div class="formulaire-contact">
    <form id="contact" method="post">
        <h2><?php echo CONTACT_CONTACT ?></h2>
        <fieldset>
            <input id="saisie-formulaire-contact" placeholder="<?php echo CONTACT_NOM ?>" name="Nom" type="text" required autofocus>
        </fieldset>
        <fieldset>
            <input id="saisie-formulaire-contact" placeholder="<?php echo CONTACT_EMAIL ?>" name="Email" type="email" required >
        </fieldset>
        <fieldset>
            <textarea id="saisie-formulaire-contact" placeholder="<?php echo CONTACT_TEXT ?>" name="Message" required></textarea>
        </fieldset>
        <fieldset>
            <button id="btn-contact" name="Envoi" type="submit" data-submit="...Envoi"><?php echo CONTACT_ENVOYER ?></button>
        </fieldset>
    </form>
</div>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>
