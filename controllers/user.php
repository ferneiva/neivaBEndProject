<?php
//controllers/users

if( empty($id) || !is_numeric($id) ) {
    http_response_code(400);
    die("Invalid reqquest");
}

require("models/users.php");

$model = new Users();

$user = $model->getDetail($id);
$sessionUser=$model->getDetail($_SESSION["user_id"]);
// tem de levar if acima
if( empty($user) ) {
    http_response_code(404);
    die("Not found");
}

require("models/reviews.php");  
$id=$user["user_id"];
$modelReviews = new Reviews();
 


if(isset($_POST["send"])){
    $review=$_POST;
    $review["user_session_id"]= $_SESSION["user_id"];
    
    

    $createReview = $modelReviews->postReviewByReviewer($review);
    $reviewedId=$_POST;
    $reviewedId["user_reviewed_id"]=$user["user_id"];

    $reviewedId["review_id"]=$createReview;
    
    $createReviewLink = $modelReviews->reviewLink($reviewedId);

    
}
$reviewsByUsers = $modelReviews->getReviewsByUserReviewed($id); 

$userAvgReview=$modelReviews->getAvgRatingsByUser($id);


// envio de email ****************
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require("mail.config.468.php");
require 'vendor/autoload.php';

$msg = '';
if (array_key_exists('email', $_POST)) {

// criar função
//  function sendEmail($datamail){}
//Criar nova instância do PHPMailer
$mail = new PHPMailer();
// Indicar que pretende utilizar SMTP e definir servidor
$mail->isSMTP();
$mail->Host = 'smtp.sapo.pt';
$mail->SMTPAuth = true;
$mail->Username = $mailUsername;
$mail->Password = $mailPassword;
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->CharSet = 'UTF-8';


$mail->setFrom('fernandofalmeida@sapo.pt', 'Help site contact');
//Endereço de e-mail para onde a mensagem será enviada.
//$mail->addAddress('fernandojnfalmeida@gmail.com', ''); // pôr variável???
//$mail->addAddress($mailReceiver, ''); //// coming from post not yet defined ???????????
$mail->addAddress($_POST['receiver_email'], '');
//(Reply-to)
if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
    //e-mail subject
    $mail->Subject = 'Contact from Help Website';
    // $mail->Subject = $subjectMail;
    // HTML to be used
    $mail->isHTML(true);

    //Definir versão HTML do e-mail
    $mail->Body = "<p>E-mail: ". $_POST['email'] ."<br>Name: ". $_POST['name'] ."<br>Message:<br<br>". $_POST['message']." </p><p>Message sent by help.com</p>";

    //Definir versão alternativa do e-mail apenas em plain text
    $mail->AltBody = <<<EOT
    E-mail: {$_POST['email']}
    Nome: {$_POST['name']}
    Message:
    {$_POST['message']}
    EOT;
        //Enviar a mensagem e verificar se ocorreram erros
        if (!$mail->send()) {
            //O motivo pelo qual um envio falha é mostrado em $mail->ErrorInfo
            //no entanto não deverá mostrar estes erros ao utilizador, pelo que deverá apenas activar em situações de debug
            $msg = 'Desculpe, ocorreu um problema a enviar o e-mail. Por favor tente novamente mais tarde.';
        } else {
            $msg = 'Message sent to User!';
        }
    } else {
        $msg = 'Endereço de e-mail inválido. Mensagem ignorada.';
    }
    //iNSERT email into table emails:
    require("models/emails.php"); 
    $modelEmails = new Emails();
    //user_id=$sessionUser["user_id"];
    //to_id=$user["user_id"];
    //subject=$subjectEmail;
    //message=$_POST['message']; ***
    //sender_email = $sessionUser ["email"];
    //receiver_email= $_POST['email'];

    $postMail=$_POST;
    $postMail["user_id"]=$sessionUser["user_id"];
    $postMail["to_id"]=$user["user_id"];
    $postMail["subject"]='Help site contact';
    $postMail["sender_email"]=$sessionUser["email"];
    $postMail["receiver_email"]=$_POST['email'];
    var_dump($postMail);

    $createEmailRegister = $modelEmails->create($postMail);

}



require("views/user.php");
    