<?php
session_name('dataScomID');
session_start();



// DIRECTORY_SEPARATOR <-- Global Variable;
define('BASE_PATH', '/');
define('CONFIG', __DIR__ . "/../config/");
define('CORE', __DIR__ . "/../core/");
define('MODELS', __DIR__ . "/../models/");
define('VIEWS', __DIR__ . "/../views/");
define('ACTIONS', __DIR__ . "/../actions/");
define('STORAGE', __DIR__ . "/../storage/");
define('LIB', __DIR__ . "/../lib/");
define('SERVICES', __DIR__ . "/../services/");
define('MIDDLEWARE', __DIR__ . "/../middleware/");
define('API', __DIR__ . "/../api/");
define('ROUTE', __DIR__. "/../routes/");
define('UTILS', __DIR__. "/../utils/");
define('VALIDATION', __DIR__. "/../validation/");


include_once CONFIG . "app.php";
include_once ROUTE . "web.php";
include_once CORE . 'Connection.php';
include_once CORE . 'functions.php';
include_once MIDDLEWARE . 'setStoreDatabase.php';



// find action and Method
$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$path = rtrim($path, '/');

if($path === ''){
    $path = '/';
}


define('CURRENT_URI', $path);


$method = $_SERVER['REQUEST_METHOD'];

// Match Request Method and Path and Execute Actions
if (array_key_exists($method, $Router)) {
    
    if(array_key_exists($path, $Router[$method])){
        
        include_once ACTIONS . $Router[$method][$path];

    }else {
        redirect('page-not-found');
    }

}else {
    echo "Method Not Support";
}



?>