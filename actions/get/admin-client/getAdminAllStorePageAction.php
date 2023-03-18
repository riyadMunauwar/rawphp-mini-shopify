<?php

    load(MIDDLEWARE, 'authenticateAdmin');
    load(MODELS, 'Store');
    load(MODELS, 'StoreConnection');


    $storeConn = new StoreConnection(CORE_DATABASE);
    $allStoreConn = $storeConn->getAllStoreConnection();

    $allStore = [];

    foreach($allStoreConn as $conn){

       $store = new Store(db_config($conn));
       $singleStore = $store->findStoreById($conn['store_id']);

       if($singleStore) {
        array_push($allStore, array_merge_recursive($conn, $singleStore));
       }

    }

    
    $data = [];

    if( $allStore ) {
        $data['stores'] = $allStore;
    }else{
        $data['message'] = 'No Store available yet';
    }

    // Load the admin dashboad page
    view('admin/adminAllStorePage',$data);
    


?>



