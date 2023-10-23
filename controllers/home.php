<?php

    require ("models/providers.php");

    $model = new Providers();

    $providers = $model->getAll();

    require ("views/home.php");