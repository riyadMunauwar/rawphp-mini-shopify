<?php 

    load(MIDDLEWARE, 'authenticateAdmin');
    load(VALIDATION, 'validation');
    load(MODELS, 'StoreConnection');
    load(MODELS, 'Store');




    $store_domain = validation(post('domain'));
    $store_email = validation(post('email'));
    $store_password = validation(post('password'));
    $store_pass_confirm = validation(post('confirm'));


    $db = validation(post('db'));
    $db_name = validation(post('db_name'));
    $db_host = validation(post('db_host'));
    $db_user = validation(post('db_user'));
    $db_password = validation(post('db_password'));
    $db_password_confirm = validation(post('db_password_confirm'));




    $error = [];

    if(! $store_domain ) $error[] = "Domain name must not be empty !";
    if(! $store_email ) $error[] = "Email must not be empty !";
    if(! $store_password ) $error[] = "Password  must not be empty !";
    if(! $store_pass_confirm ) $error[] = "Confirm password must not be empty !";
    if(! $db ) $error[] = "RDMBS name must not be empty !";
    // if(! $db_user ) $error[] = "Database user must not be empty !";
    if(! $db_host ) $error[] = "Database host must not be empty !";
    // if(! $db_password ) $error[] = "Database Password must not be empty !";
    // if(! $db_password_confirm ) $error[] = "Database Confirm password must not be empty !";

    if( ! isEmail($store_email) )  $error[] = "Please Provide a valid email !";
    if( $store_password != $store_pass_confirm )  $error[] = "Store password and Store Confirm password not match";
    if( $db_password != $db_password_confirm )  $error[] = "Database user password and Database user Confirm password not match";
    if( $db_password != $db_password_confirm )  $error[] = "Database user password and Database user retype password not match";
 

    if(  strlen($store_pass_confirm) < 12 ) $error[] = "Store password must be atlest greater than or equal 12 charecter";


    $formData = [
        'domain' => $store_domain,
        'email' => $store_email,
        'password' => $store_password,
        'confirm' => $store_pass_confirm,
        'db' => $db,
        'db_name' => $db_name,
        'db_host' => $db_host,
        'db_user' => $db_user,
        'db_password' => $db_password,
        'db_password_confirm' => $db_password_confirm,
    ];


    if( $error ) {
        redirectToView('admin/adminCreateStorePage', ['errors' => $error, 'formData' => $formData]);
        return;
    }


    $storeConn = new StoreConnection(CORE_DATABASE);
    $allStoreConn = $storeConn->getAllStoreConnection();

    $emailFound = false;


    if( $allStoreConn ) {

        foreach($allStoreConn as $conn){
           $store = new Store(db_config($conn));
           $singleStore = $store->findStoreById($conn['store_id']);

           if( $singleStore ) {
                if( $singleStore['email'] === $store_email ){
                    $emailFound = true;
                    break;
                }
           }

        }

    }


    if(  $emailFound ) {

        $error[] = "Email is already used in someone else store";

        redirectToView('admin/adminCreateStorePage', ['errors' => $error, 'formData' => $formData]);
        return;
    }





    // Store and StoreConnection table creation start from here
    $db_connection = [
        'DB' => $db,
        'DB_HOST' => $db_host,
        'DB_NAME' => $db_name,
        'DB_USER' => $db_user,
        'DB_PASSWORD' => $db_password
    ];


    // Create Store
    $store = new Store($db_connection);
    $store->email = $store_email;
    // $store->password = password_hash($store_password, PASSWORD_DEFAULT);
    $store->password = $store_password;

    $isNewStoreCreate = $store->create();

    if($isNewStoreCreate) {
       

        $lastStore = $store->lastInsertId();
        $storeConn = new StoreConnection(CORE_DATABASE);

        $storeConn->domain = $store_domain;
        $storeConn->db = $db;
        $storeConn->db_host = $db_host;
        $storeConn->db_name = $db_name;
        $storeConn->db_user = $db_user;
        $storeConn->db_password = $db_password;
        $storeConn->store_id = $lastStore['id'];

        if($storeConn->create()){

            redirectToView('admin/adminCreateStorePage', ['message' => 'Store Create Successfully !']);
            return;

        }

    }

  

?>