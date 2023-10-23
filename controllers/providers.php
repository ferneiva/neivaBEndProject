<?php


if( empty($id) || !is_numeric($id) ) {
    http_response_code(400);
    die("Invalid reqquest");
}

require("models/providers.php");

$model = new Provider();

$provider = $model->getDetail($id);

if( empty($provider) ) {
    http_response_code(404);
    die("Not found");
}

require("views/provider.php");
