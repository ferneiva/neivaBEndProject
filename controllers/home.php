<?php

require ("models/users.php");

$model = new Users();


// $limit["number"]= 2;
// $limit["number"]=$limit["2"];
// {$limit["number"]=> 2 }
// var_dump($limit);
// $users = $model->getAll($limit);
$users = $model->getAll();


require ("views/home.php");