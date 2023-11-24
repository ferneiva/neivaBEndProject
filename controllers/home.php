<?php

require ("models/users.php");

$model = new Users();

  $limit=50;
    //var_dump($limit);
    
$users = $model->getAll($limit);

if( isset($_POST["contact"])){

        foreach($_POST as $key => $value){
            $_POST [$key] = htmlspecialchars(strip_tags(trim($value)));
        }
        
            require ("models/messages.php");
            $modelMessage = new Messages();
            
            $post=$_POST["contactText"];

            $modelMessage->createMessage($post);
            $message="Contact request sent";

            

}


require ("views/home.php");