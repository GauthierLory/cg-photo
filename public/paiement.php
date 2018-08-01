<?php
if(!isset($_SESSION))
{
  session_start();
}

if(!isset($_COOKIE['panier'])){
	header("Location:404");
}

//Appel des autres vues
require_once('menu.php');
require_once(PATH_CONTROLEURS.'transaction.php');

if(!isset($_SESSION['idLogin'])){
	header("Location:../connexion");
}
?>
<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<form id="formulaire-paiement" action="paiement" method="post" xmlns="http://www.w3.org/1999/html">
    <h2 class="titre-secondaire"><?php echo PAIEMENT_TITRE ?></h2>

        <div class="">
            <input placeholder="<?php echo PAIEMENT_NOM ?>" name="nom" value="<?php echo $utilisateur->getNom(); ?>">
            <input placeholder="<?php echo PAIEMENT_PRENOM ?>" name="prenom" value="<?php echo $utilisateur->getPrenom(); ?>" >
            <input placeholder="<?php echo PAIEMENT_EMAIL ?>"  name="email" value="<?php echo $utilisateur->getEmail(); ?>">
            <input placeholder="<?php echo PAIEMENT_CODE ?>" data-stripe="number" >
            <select data-stripe="exp_month">
                <option><?php echo PAIEMENT_MOIS; ?></option>
                <?php for($i=1;$i<=12;$i++){ ?>
                <option><?php echo $i; ?></option>
              <?php } ?>
            </select>
            <select data-stripe="exp_year">
                <option><?php echo PAIEMENT_ANNEE; ?></option>
                <?php for($i=0;$i<5;$i++){ ?>
                <option><?php echo date("Y")+$i; ?></option>
              <?php } ?>
            </select>
            <input placeholder="CVC" data-stripe="cvc">
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="submit">Payer</button>
            </div>
        </div>

</form>

<script src="https://js.stripe.com/v2/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
    Stripe.setPublishableKey("pk_test_8qlLtwOeYg4t20WlbiDwbApz")
    // selection du formulaire
    var $formulaire = $('#formulaire-paiement')
    // lorsque l'on soumet ce formulaire lance une fonction event
    $formulaire.submit(function (e) {
        //empeche la soumission du formulaire
        e.preventDefault()
        // permet de ne pas resoumettre le formulaire si plusieurs clique
        $formulaire.find('.button').attr('disabled',true)
        // contact api Stripe pour la creation de token
        // 1er parametre on lui donne le formulaire contenant les donnees
        // 2nd parametre  ,callback status (si tout est ok) et response (ce que renvoi le serveur)
        Stripe.card.createToken($formulaire, function (status, response) {
            //debugger
            // affiche les informations concernant les erreurs
            if (response.error)
            {
                $formulaire.find('.message').remove();
                $formulaire.prepend('<p>' + response.error.message + '</p>')
            }
            // si tout ce passe bien on obtient les info concernant le paiement (token)
             else{
                var token = response.id
                // injecter dans le formulaire un champ qui va permettre de récupérer le token cote serveur
                $formulaire.append($('<input type="hidden" name="stripeToken">').val(token))
                $formulaire.get(0).submit()
            }
        })

    })
</script>

<?php
//Appel de la vue footer
require_once('piedDePage.php');
?>



<!--<form id="formulaire-inscription" action="/action_page.php">-->
<!--    <h2 class="titre-secondaire">--><?php //echo PAIEMENT_TITRE ?><!--</h2>-->
<!---->
<!--    <div class="onglet">-->
<!--        <input placeholder="--><?php //echo PAIEMENT_NOM ?><!--" name="nom" value="lory">-->
<!--        <input placeholder="--><?php //echo PAIEMENT_PRENOM ?><!--" name="prenom" value="Gauthier">-->
<!--        <input placeholder="--><?php //echo PAIEMENT_EMAIL ?><!--"  name="email" value="gauthier@mail.com">-->
<!--    </div>-->
<!--    <div class="onglet">-->
<!--        <input placeholder="--><?php //echo PAIEMENT_CODE ?><!--" value="4242 4242 4242 4242">-->
<!--        <input placeholder="--><?php //echo PAIEMENT_MOIS ?><!--" value="10">-->
<!--        <input placeholder="--><?php //echo PAIEMENT_ANNEE ?><!--" value="12">-->
<!--        <input placeholder="CVC" value="123">-->
<!--    </div>-->
<!--    <div class="onglet">-->
<!--        <label>--><?php //echo PAIEMENT_LBLNOM ?><!--</label>-->
<!--        <label>--><?php //echo PAIEMENT_LBLPRENOM ?><!--</label>-->
<!--        <label>--><?php //echo PAIEMENT_LBLMAIL ?><!--</label>-->
<!--        <label>--><?php //echo PAIEMENT_LBLPHOTO ?><!--</label>-->
<!--        <label>--><?php //echo PAIEMENT_LBLPRIX ?><!--</label>-->
<!--    </div>-->
<!---->
<!--    <div style="overflow:auto;">-->
<!--        <div style="float:right;">-->
<!--            <button type="button" id="precBtn" onclick="suivantPrec(-1)">Previous</button>-->
<!--            <button type="button" id="nextBtn" onclick="suivantPrec(1)">Next</button>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div style="text-align:center;margin-top:40px;">-->
<!--        <span class="etape"></span>-->
<!--        <span class="etape"></span>-->
<!--        <span class="etape"></span>-->
<!--    </div>-->
<!--</form>-->

<!--<script type="text/javascript" src="--><?php //echo PATH_SCRIPTS.'formulaire-paiement.js'?><!--"></script>-->
