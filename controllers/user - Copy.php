<?php


if( empty($id) || !is_numeric($id) ) {
    http_response_code(400);
    die("Invalid reqquest");
}

require("models/users.php");

$model = new Users();

$user = $model->getDetail($id);

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
    $review["review_id"]=$createReview;
    $createReviewLink = $modelReviews->reviewLink($review);

    // header("Location:" .ROOT. "/user/" .$id);
}
$reviewsByUsers = $modelReviews->getReviewsByUserReviewed($id); 






require("views/user.php");
