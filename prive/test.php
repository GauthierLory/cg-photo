
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';

envoyerPhotoParMail();

function envoyerPhotoParMail(){

  $mail = new PHPMailer(true);
  try {

      //Recipients
      $mail->setFrom('contact@travel-center.fr', 'CegePhoto');
      $mail->addAddress('marrel.lucas@gmail.com', 'Lucas Marrel');
      // $mail->addAttachment('../Photos/Originales/'.$photo->getNom(), $photo->getNom());

      $mail->isHTML(true);
      $mail->Subject = 'Achat photos CegePhoto';
      $mail->Body    = '<p>Bonjour Lucas Marrel !</p>
                        </br>
                        </br>
                        <p>Merci d\'avoir acheté sur notre site.</p>
                        </br>
                        </br>
                        <p>Facture :</p>
                        </br>
                        <p>ddd.jpg  20euros</p>
                        <p>----------------</p>
                        <p>Total :  20euros</p>
                        </br>
                        </br>
                        <p>L\'équipe CegePhoto</p>';

      $mail->send();

  } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
  }
}


?>
