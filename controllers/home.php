<?php

require ("models/users.php");

$model = new Users();


// $limit["number"]= 2;
// $limit["number"]=$limit["2"];
// {$limit["number"]=> 2 }
// var_dump($limit);
// $users = $model->getAll($limit);
$users = $model->getAll();

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