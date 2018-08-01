<?php
// Start the session
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_POST['langue']) AND $_POST['langue'] == "fr")
{
  setcookie('langue', 'fr', time() + 10 * 365 * 24 * 3600, '/' );
  header("Location:../../".$_POST['page_langue']);
}
elseif(isset($_POST['langue']) AND $_POST['langue'] == "en")
{
  setcookie('langue', 'en', time() + 10 * 365 * 24 * 3600, '/' );
  header("Location:../../".$_POST['page_langue']);

}

?>
