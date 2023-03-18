<?php

    load(MODELS, 'StoreConnection');

    $storeConn      =   new StoreConnection(CORE_DATABASE);
    $findByDomain   =   $storeConn->findByDomain(CURRENT_DOMAIN);
    
    if( $findByDomain ) {

        define('STORE_DATABASE', db_config($findByDomain));
        define('STORE_DOMAIN', $findByDomain['domain']);
        define('STORE_ID', $findByDomain['store_id']);

    }
    else
    {
        echo "Invalid Store";
        exit();
    }
    
?>