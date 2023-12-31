<?php
// controlers/register.php
//header("Content-Type: application/json");
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
function userTypeValidation($word){
    if($word="client" or $word="user")
        {return true;}
    else
        {return false;}
}


if( isset($_POST["send"])){
        // var_dump($_FILES);
        // var_dump($_FILES["photo"],$allowed_formats);
        // var_dump($_POST["captcha"]);
        var_dump($_POST["captcha-rand"]);

        $testFoto=photoValidation($_FILES["photo"],$allowed_formats);
        // var_dump($testFoto);
        foreach($_POST as $key => $value){
            $_POST [$key] = htmlspecialchars(strip_tags(trim($value)));
        }
        
        if(
            !empty($_POST["user_type"]) &&
            userTypeValidation($_POST["user_type"])== true &&
            !empty($_POST["agrees"]) &&
            !empty($_POST["name"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["password"]) &&
            !empty($_POST["address"]) &&
            !empty($_POST["city"]) &&
            !empty($_POST["postal_code"]) &&
            !empty($_POST["country"]) &&
            in_array($_POST["country"], $country_codes )&&
            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
            $_POST["password"] === $_POST["password_confirm"] &&
            mb_strlen($_POST["name"])  >=3 &&
            mb_strlen($_POST["name"]) <=60 &&
            mb_strlen($_POST["password"])  >=8 &&
            mb_strlen($_POST["password"]) <=1000 &&
            mb_strlen($_POST["address"]) >=8 &&
            mb_strlen($_POST["address"]) <=120 &&
            mb_strlen($_POST["postal_code"]) >=4 &&
            mb_strlen($_POST["postal_code"]) <=20 &&
            mb_strlen($_POST["city"]) >=3 &&
            mb_strlen($_POST["city"]) <=50 &&
            in_array($_POST["country"], $country_codes)&&
            phoneValidation($_POST["phone"])==true&&
            photoValidation($_FILES["photo"],$allowed_formats)==true&&
            $_POST["captcha"] === $_POST["captcha-rand"]
            
            
            /*$_FILES["photo"]["error"] === 0 &&
            $_FILES["photo"]["size"] > 0 &&
            $_FILES["photo"]["size"] <= 2 * 1024 * 1024 &&
            in_array( $_FILES["photo"]["type"], $allowed_formats)*/
    
        ){
            
            require("models/users.php");
            $model = new Users();
            $user =$model->getByEmail($_POST["email"]);
            if(empty($user)){
                $file_extension = array_search($_FILES["photo"]["type"], $allowed_formats);
                $filename = date("YmdHis") . "_". mt_rand(100000, 999999) . "." .$file_extension;
                move_uploaded_file($_FILES["photo"] ["tmp_name"], "images/helpMysql/" . $filename);
                if(empty($_FILES["photo"]["size"])){
                    $post=$_POST;
                    
                }
                else{$post=$_POST;
                    $post["filename"]= $filename;}
                
                // var_dump($filename);
                // var_dump($_POST);

                $createdUser = $model->create($post);
                $_SESSION["user_id"] = $createdUser["user_id"];
                
                header("Location:" .ROOT. "/user/" .$_SESSION["user_id"]);
            }
            else{
                $message = "User already exists";
            }
        }
        else{
            $message = "Fields incorrect or wrong image ";
        }
}


$rand=bin2hex(random_bytes(4)); 

// header("Content-Type: image/png");
// $image= imagecreatefrompng("scrambled1.png");
// imagefilter($image, IMG_FILTER_BRIGHTNESS,55);
// imagefilter($image, IMG_FILTER_GRAYSCALE);
// $image = imagescale($image, 220, 75);
// $color=imagecolorallocate($image, 30,30,30);
// $font="Xtradex.otf"; 
// $text=bin2hex(random_bytes(4));
// $_SESSION["captcha"] = $text;
// imagettftext($image, 48, 0, 16, 60, $color, $font, $text);

// $displayImage=imagepng($image); erro
// var_dump($displayImage); erro
// imagepng($image); ok

// $displayCaptcha=("captcha.php");
// var_dump($displayCaptcha);

require("views/register.php");
