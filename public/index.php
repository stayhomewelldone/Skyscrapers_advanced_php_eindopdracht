<?php

//Require needed files
require_once '../vendor/autoload.php';


// Test

//Initialize bootstrap & render the application
$bootstrap = new Buildings\Bootstrap\WebBootstrap();
echo $bootstrap->render();
