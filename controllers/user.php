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

    // header("Location:" .ROOT. "/user/" .$id);
}
$reviewsByUsers = $modelReviews->getReviewsByUserReviewed($id); 

$userAvgReview=$modelReviews->getAvgRatingsByUser($id);


// var_dump($_SESSION["user_id"]);
// require("core/mail.php");



// if(isset($_POST["emailSend"])){
//     $mail->Subject = ($_POST["subject"]);
//     $mail->msgHTML($_POST["message"]);
//     $mail->addAddress($_POST["destination _email"]);;
// }else
//     {
//     echo 'Message has been sent';
//     }
require("views/user.php");
    