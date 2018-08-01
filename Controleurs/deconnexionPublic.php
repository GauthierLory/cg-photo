<?php
// Start the session
if(!isset($_SESSION))
    {
        session_start();
    }

unset($_SESSION['idLogin']);
$_SESSION['deconnexion']='reussie';
header("Location:../../connexion");
?>
