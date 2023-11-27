<?php
require ("models/users.php");

$modelAdmin = new Users();

  $limit=500000000000000000;
    //var_dump($limit);
    
$usersList = $modelAdmin->getAll($limit);

require("models/countries.php");
$modelCountriesList = new Countries();

$countriesList = $modelCountriesList->get();
$country_codesList = [];
foreach($countriesList as $countryList){
    $country_codesList[] = $countryList["code"];
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























require ("views/adminpage.php");