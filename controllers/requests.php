<?php
// ajax requests
header("Content-Type: application/json");

if( isset($_POST["request"]) ) {

    if(
        $_POST["request"] === "deleteReview" &&
        !empty($_POST["review_id"]) &&
        is_numeric($_POST["review_id"])&&
        isset($_SESSION["user_id"])
    

    ) {
        require("models/reviews.php");
        $model = new Reviews();

        $model->deleteReview($_POST["review_id"], $_SESSION["user_id"]);
        

        echo '{"message":"OK"}';
    }
	

	
}
