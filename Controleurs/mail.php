
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';

function envoyerPhotoParMail($utilisateur,$listePhotos){

  $mail = new PHPMailer(true);
  try {

      //Recipients
      $mail->setFrom('contact@travel-center.fr', 'CegePhoto');
      $mail->addAddress($utilisateur->getEmail(), $utilisateur->getPrenom().' '.$utilisateur->getNom());

      foreach ($listePhotos as $photo) {
          $mail->addAttachment('../Photos/Originales/'.$photo->getNom(), $photo->getNom());
      }


      $mail->isHTML(true);
      $mail->Subject = 'Achat photos CegePhoto';
      $mail->Body    = '<p>Bonjour '.$utilisateur->getPrenom().' !</p>
                        </br>
                        </br>
                        <p>Merci d\'avoir acheté sur notre site.</p>';

      $mail->send();

  } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
  }
}

function envoyerUnMail($utilisateur){

  $mail = new PHPMailer(true);
  try {

      //Recipients
      $mail->setFrom('contact@travel-center.fr', 'CegePhoto');
      $mail->addAddress($utilisateur->getEmail(), $utilisateur->getPrenom().' '.$utilisateur->getNom());

      $mail->isHTML(true);
      $mail->Subject = 'Inscription CegePhoto';
      $mail->Body    = "<p>Bienvenue ".$utilisateur->getPrenom()." sur <a href='travel-center.fr'>CegePhoto !</a></p>
                        </br>
                        <p>Rendez-vous sans plus attendre sur notre site pour voir l'ensemble de nos photos : <a href='travel-center.fr'>travel-center.fr</a>.</p>
                        </br>
                        </br>
                        <p>L'&eacute;quipe CegePhoto</p>";

      $mail->send();

  } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
  }
}


?>
