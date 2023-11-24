<?php
// controllers/admin468.php 

//unset($_SESSION["admin_id"]);

if(isset($_POST["send"])) {
    
    require("models/admins.php");
    $model = new Admins();

    $admin = $model->login( $_POST );
    
    if(!empty($admin)) {
        $_SESSION["admin_id"] = $admin["admin_id"];
    }
}

if( !isset($_SESSION["admin_id"]) ) {
    
    require("views/admin.php");
    exit;
}

header("Location:" .ROOT. "/adminpage/");
?>
