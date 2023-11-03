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

// require("models/reviews.php");   REVER IVO
// $id=$user["user_id"];
// $modelReviews = new Reviews();
// $reviewsByUsers = $modelReviews->getReviewsByUserReviewed($id);  





require("views/user.php");
