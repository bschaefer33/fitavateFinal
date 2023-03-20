<?php

$config = [
    'MODEL_PATH' => APPLICATION_PATH . DS . 'model' . DS,
    'VIEW_PATH' => APPLICATION_PATH . DS . 'view' . DS,
    'LIB_PATH' => APPLICATION_PATH . DS . 'lib' . DS,
];

require $config['LIB_PATH'] . 'functions.php';

define("SERVER_NAME", "localhost");
define("DBF_USER_NAME", "root");
define("DBF_PASSWORD", "mysql");
define("DATABASE_NAME", "prjProcess");