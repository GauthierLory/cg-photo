<?php

//Appel des autres vues
require_once('menu.php');

require_once(PATH_BDD.'ContactAO.php');
require_once(PATH_MODELES. 'contact.php');

if(isset($_POST['Envoi']) && isset($_POST['Nom']) && isset($_POST['Email']) && isset($_POST['Message']))
{
    $nom = $_POST['Nom'];
    $email = $_POST['Email'];
    $email_reponse = $_POST['Email'];
    $message= $_POST['Message'];

    $headers .= 'MIME-Version: 1.0'."\n";
    $headers = 'From:<'.$email.'>'."\n" .
        'Reply-To: <'.$email.'>' . "\r\n";
    $headers .='Content-Type:text/html; charset="uft-8"'."\n";
    $headers .='Content-Transfer-Encoding: 8bit';
    $headers .= 'Content-Type: multipart/alternative; boundary="'.$frontiere.'"';
    //GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET HTML
    $frontiere = '-----=' . md5(uniqid(mt_rand()));

    mail("chotarddaniel@yahoo.fr", "Assistance utilisateur !", $headers, $message);
}

    
?>