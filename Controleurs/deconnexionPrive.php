<?php
// Start the session
if(!isset($_SESSION))
    {
        session_start();
    }

unset($_SESSION['loginAdmin']);
header("Location:../admin");
?>
