<?php

require ("models/users.php");

$model = new Users();

$users = $model->getAll();


require ("views/home.php");