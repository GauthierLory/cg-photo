<?php
require_once('menu.php');
?>

<?php
$nb_visites = file_get_contents('../prive/pagesvues.txt');
$nb_visites++;
file_put_contents('../prive/pagesvues.txt', $nb_visites);
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <h2>Statistiques</h2>
    <?php
    echo "<img src='./statistique-connexion-pays.php' />";
    ?>

    <?php
    echo "<img src='./statistique-photo.php' />";
    ?>

    <?php
    echo "<img src='./statistiques-utilisateurs.php' />";
    ?>

    <?php
    $connexion = mysqli_connect('travelcextadmin.mysql.db', 'travelcextadmin', '');
    $db = mysqli_select_db($connexion, 'visites_jour');
    ?>

<!--    page vues aujourd'hui-->
    <?php
    $retour_count = mysqli_query($connexion, 'SELECT COUNT(*) AS nbre_entrees FROM visites_jour WHERE date=CURRENT_DATE()');//On compte le nombre d'entrées pour aujourd'hui
    $donnees_count = mysqli_fetch_assoc($retour_count); //Fetch-array

    if ($donnees_count['nbre_entrees'] == 0) //Si la date d'aujourd'hui n'a pas encore été enregistrée (première visite de la journée)
    {
        $retour = mysqli_query($connexion, 'SELECT visites FROM visites_jour WHERE date=CURRENT_DATE()'); //On sélectionne l'entrée qui correspond à notre date
        $donnees = mysqli_fetch_assoc($retour);
        $visites = $donnees['visites'] + 1; //Incrémentation du nombre de visites
        mysqli_query($connexion, 'UPDATE visites_jour SET visites = visites + 1 WHERE date=CURRENT_DATE()'); //Update dans la base de données
    }
    ?>

<!-- Record des connectés par jour-->
    <?php
    $retour_max = mysqli_query($connexion, 'SELECT visites, date FROM visites_jour ORDER BY visites DESC LIMIT 0, 1'); //On sélectionne l'entrée qui a le nombre visite le plus important
    $donnees_max = mysqli_fetch_assoc($retour_max);
    ?>

<!--    moyenne du nombre de visiteurs-->
    <?php
    $total_visites = 0; //Nombre de visites
    /*(pour éviter les bugs on ne prendra pas le nombre du premier exercice,
    mais celui-ci reste utile pour être affiché sur toutes les pages car il est plus rapide,
    contrairement à $total_visites dont on ne se servira que pour la page de stats)*/

    $total_jours = 0;//Nombre de jours enregistrés dans la base
    $total_visites = mysqli_fetch_assoc(mysqli_query($connexion, 'SELECT SUM(visites) FROM visites_jour AS total_visites'));
    $total_visites = $total_visites['total visites'];

    $total_jours = mysqli_fetch_assoc(mysqli_query($connexion, 'SELECT COUNT(*) FROM visites_jour AS total_jours'));
        $total_jours = $total_jours['total_jours'];

    $moyenne = $total_visites/$total_jours; //on fait la moyenne

    ?>

    <div class="table-responsive">
        <form class="" action="utilisateurs.php" method="POST">
            <table class="table table-striped table-sm">

                <thead>
                <tr>
                    <th>Nombres de page vues</th>
                    <th>Pages vues aujourd'hui</th>
                    <th>Record</th>
                    <th>Etabli le </th>
                    <th>Moyenne</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><?php echo $nb_visites ?></td>
                    <td><?php echo $visites ?></td>
                    <td><?php echo $donnees_max['visites'] ?></td>
                    <td><?php echo $donnees_max['date'] ?></td>
                    <td><?php echo $moyenne ?></td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>


</main>
