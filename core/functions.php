<?php

// Parse Query and Set To Global Query Variable as a Associative Array

function query(){

    if( $_SERVER['QUERY_STRING'] ) {

        $params = $_SERVER['QUERY_STRING'];
        $params = explode('&', $params);
        $query  = [];

        foreach( $params as $param ){

           $pair    =   explode('=', $param);

           $key     = $pair[0];
           $value   = $pair[1];

           $query[$key] = $value;

        }

        return $query;

    }

    return [];
}

define('QUERY', query());




// View Load Function
function view($viewPath, $data = []){
    include_once VIEWS . $viewPath . '.php';
}



// Load Script
function load($directory, $path){
    include_once( $directory . $path . '.php');
}


// GET POST

function get($name){

    if( isset($_GET[$name] ) ) return $_GET[$name];

    return false;
    
}

function post($name){

    if( isset($_POST[$name] ) ) return $_POST[$name];

    return false;
    
}


// Check if the vairable exists
function has($key, $list){
     if ( array_key_exists($key, $list) ) return $list[$key];
     return '';
}

function serverProtocol(){
    
    if($_SERVER['HTTPS'] == 'on' && $_SERVER['HTTPS'] != 'off' || $_SERVER['SERVER_PORT'] == 443) {
        return 'https://';
    }
    
    return 'http://';
    
}


function getDomain(){
    if(array_key_exists('SERVER_NAME', $_SERVER)){
        $domain = $_SERVER['SERVER_NAME'] ?? '';
        return $domain . ":" . $_SERVER['SERVER_PORT'] . BASE_PATH;
    }
}

function routeWithDomain($path = ''){
    return serverProtocol() . getDomain() . $path;
}



function rootUser(){
    return ROOT_USER === $_SERVER['SERVER_NAME'];
}

// redirect to
function redirect($path) {
    return header('location: ' . BASE_PATH . $path, true,  301);
}

// redirect to view with data
function redirectToView($path, $data = []){
    include_once VIEWS . $path . '.php';
}

// Store Connection object to DB_config array

function db_config($store_connection_array){

        if( $store_connection_array ) {

            $db_config = [];

            $db_config['DB'] = $store_connection_array['db'];
            $db_config['DB_HOST'] = $store_connection_array['db_host'];
            $db_config['DB_NAME'] = $store_connection_array['db_name'];
            $db_config['DB_USER'] = $store_connection_array['db_user'];
            $db_config['DB_PASSWORD'] = $store_connection_array['db_password'];

            return $db_config;

        }

}


// for error handeling;

function console($array){
   
    if( $array ) { 

        echo "<pre>";
        print_r($array);
        echo "</pre>";
        die();
        
     }
    
}


// Route function and only using in views

function route($path) {

    if( !$path ) return;

    echo BASE_PATH . $path;

}


// Load Static Files
function assets($path){

    if(!$path) return;

    echo BASE_PATH . $path;

}


// Heler time function

function bdTime(){
        $dt = new DateTime();
        $dt->setTimezone(new DateTimeZone('Asia/Dhaka'));
        $dt->setTimestamp(time());
       
       return $dt->format('Y-m-d H:i:s');
}


// queryString

function queryMessage($message){
    return implode(' ', explode('%20', $message));
}




// Check User Login or Not
function isCustomerLogin(){
    if( array_key_exists('customer', $_SESSION) ){
        if($_SESSION['customer']){
             return true;
        }

        return false;
     }

     return false;
}


function AuthCustomer(){
    if( array_key_exists('customer', $_SESSION) ){
        if($_SESSION['customer']){
             return $_SESSION['customer'];
        }

        return [];
     }

     return [];
}




function countDiscountIfHas($price, $discount){
    if($discount && $discount > 0 ){
    return $price - ($price * $discount / 100);
    }

    return $price;
}

?>