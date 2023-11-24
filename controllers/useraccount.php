<?php
// controllers/useraccount
// if( empty($id) || !is_numeric($id) ) {
//     http_response_code(400);
//     die("Invalid reqquest");
// }

require("models/users.php");

$model = new Users();

$user = $model->getDetail($_SESSION["user_id"]);

if( empty($user) ) {
    http_response_code(404);
    die("Not found");
}

require("models/countries.php");
$modelCountries = new Countries();

$countries = $modelCountries->get();
$country_codes = [];
foreach($countries as $country){
    $country_codes[] = $country["code"];
}
$allowed_formats=[
    "png"=>"image/png",
    "jpg"=>"image/jpeg"
    ];

function phoneValidation($word){
    if(empty($word))
        {return true;}
    elseif(mb_strlen($word) >=9 && mb_strlen($word) <=30)
        {return true;}
    else
        {return false;}
}

function photoValidation($file,$format){
    if(empty($file["size"]))
            {return true;}
        elseif(   
            $file ["error"] === 0 &&
            $file ["size"] > 0 &&
            $file ["size"] <= 2 * 1024 * 1024 &&
            in_array($file ["type"], $format)
    )
            {return true;}
    else
            {return false;}
}


if( isset($_POST["change"])){
    // var_dump($_FILES);
        // var_dump($_FILES["photo"],$allowed_formats);
        //$testFoto=photoValidation($_FILES["photo"],$allowed_formats);
        //var_dump($testFoto);
        

        foreach($_POST as $key => $value){
            $_POST [$key] = htmlspecialchars(strip_tags(trim($value)));
        }
        
        if(
            !empty($_POST["name"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["address"]) &&
            !empty($_POST["city"]) &&
            !empty($_POST["postal_code"]) &&
            !empty($_POST["country"]) &&
            in_array($_POST["country"], $country_codes )&&
            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
            mb_strlen($_POST["name"])  >=3 &&
            mb_strlen($_POST["name"]) <=60 &&
            mb_strlen($_POST["address"]) >=8 &&
            mb_strlen($_POST["address"]) <=120 &&
            mb_strlen($_POST["postal_code"]) >=4 &&
            mb_strlen($_POST["postal_code"]) <=20 &&
            mb_strlen($_POST["city"]) >=3 &&
            mb_strlen($_POST["city"]) <=50 &&
            in_array($_POST["country"], $country_codes)&&
            phoneValidation($_POST["phone"])==true&&
            photoValidation($_FILES["photo"],$allowed_formats)==true
    
        ){
            // require("models/users.php");
            $modelUpdate = new Users();
            $idUpdated=$_SESSION["user_id"];
            //$idUpdated=$user(["user_id"]);
            var_dump($idUpdated);
            $file_extension = array_search($_FILES["photo"]["type"], $allowed_formats);
            $filename = date("YmdHis") . "_". mt_rand(100000, 999999) . "." .$file_extension;
            move_uploaded_file($_FILES["photo"] ["tmp_name"], "images/helpMysql/" . $filename);

            if(empty($_FILES["photo"]["size"])){
                $post=$_POST;
                $post["id"]=$idUpdated;
                
            }
            else{
                $post=$_POST;
                $post["filename"]= $filename;
                $post["id"]=$idUpdated;
            }
            
            // var_dump($filename);
            var_dump($post);
            // $id=$_SESSION(["user_id"]);

            $modelUpdate->update($post);
            
            
            header("Location:" .ROOT. "/user/" .$_SESSION["user_id"]);
            
            
        }
        else{
            // var_dump($_FILES);
            // var_dump($_POST);
            $message = "Fields incorrect or wrong image";
        }
}


if( isset($_POST["sendNpass"])){
    // var_dump($_FILES);
        // var_dump($_FILES["photo"],$allowed_formats);
        //$testFoto=photoValidation($_FILES["photo"],$allowed_formats);
        //var_dump($testFoto);
        

        foreach($_POST as $key => $value){
            $_POST [$key] = htmlspecialchars(strip_tags(trim($value)));
        }
        
        if(
            
            $_POST["newpass"] === $_POST["newpassrepeat"] &&
            mb_strlen($_POST["password"])  >=8 &&
            mb_strlen($_POST["password"]) <=1000 &&
            mb_strlen($_POST["newpass"])  >=8 &&
            mb_strlen($_POST["newpass"]) <=1000 &&
            mb_strlen($_POST["newpassrepeat"])  >=8 &&
            mb_strlen($_POST["newpassrepeat"]) <=1000


    
        ){  
            $modelUpdate = new Users();
            // require("models/users.php");
            // $user = $model->getDetail($id);
            $sessionUser=$model->getDetail($_SESSION["user_id"]);   
            var_dump($sessionUser["password"]);
            var_dump($_POST["password"]);
            
            // $modelUserPass = new Users();
            // $idUpdated=$_SESSION["user_id"];
            // $idUpdated=$user(["user_id"]);
            // var_dump($idUpdated);
                if(password_verify($_POST["password"], $sessionUser["password"])){
                    

                    $newPassData=$_POST;
                    $newPassData["user_id"]=$_SESSION["user_id"];
                    $message2="Password changed";
                    
                    $modelUpdate->newPassword($newPassData);
                    
                    

                }
                else{
                    
                    Var_dump($_POST);
                    $message1 ="Your old password is incorret";
                    
                }
        }
        else{
            // var_dump($_FILES);
            //var_dump($_POST);
            $message1 = "Input password fields incorrect";
        }
}
require("models/emails.php");
$modelEmails = new Emails();
$post=$user["user_id"];
var_dump($post);

$emailsByUser = $modelEmails->emailsByUser($post);
// var_dump($emailsByUser);



require ("views/useraccount.php");