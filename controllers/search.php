<?php
require("models/users.php");
$model = new Users();
$search=$_GET["search"];
$usersSearch=$model->searchUsers($search);

require("views/search.php");


?>