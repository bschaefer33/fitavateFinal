<?php
//sets application path
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));
//defines /
const DS = DIRECTORY_SEPARATOR;
//require config file
require APPLICATION_PATH . DS . 'config' . DS . 'config.php';

//I think put in a condition if a session has started, home = home, else home = login form
$page = get('page', 'home');

//determines what template to use
$template = $config['VIEW_PATH'] . 'templates/hometemplate.php';
if($page == 'login/loginHome' || $page == 'login/signup' || $page == 'login/fitavatorPassReset') {
    $template = $config['VIEW_PATH'] . 'templates/loginTemplate.php';
}
//Routing of urls
$model =  $config['MODEL_PATH'] . $page . '.php';
$view =  $config['VIEW_PATH'] . $page . '.php';
$_404 = $config['VIEW_PATH'] . '404.php';
//makes sure there is a model and viewer
if (file_exists($model)) {
    require $model;
}
$main_content = $_404;
if (file_exists($view)) {
    $main_content=$view;
}

include $template;
