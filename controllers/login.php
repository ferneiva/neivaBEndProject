<?php
if( isset($_POST["send"])){
    foreach($_POST as $key => $value){
        $_POST [$key] = htmlspecialchars(strip_tags(trim($value)));
    }
    if(
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        mb_strlen($_POST["password"]) >=8 &&
        mb_strlen($_POST["password"]) <=1000 
    )   {
        require("models/users.php");
        $model = new Users();
        $user = $model->getByEmail( $_POST["email"]);
       
     
        if($user["blocked"]==1){
            $message="Your account is blocked";
            // header("Location:" .ROOT. "/home/");
        }
        else{

            if(
                !empty($user) &&
                password_verify($_POST["password"], $user["password"])
            )   {
                    $_SESSION["user_id"] = $user["user_id"];
                    header("Location:" .ROOT. "/user/" .$_SESSION["user_id"]);      
                }
            else{
                $message="Incorrect email or password";
            }
        }
    }
    else{
        $message ="Fill the form correctly";        
    }
}
require("views/login.php");