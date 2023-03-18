<?php

    load(VALIDATION, 'validation');
    load(MODELS, 'Store');

    $email      =   validation(post('email'));
    $password   =   post('password');

    // If user and email field empty
    if( ! ( $email && $password ) ){

       redirectToView('auth/adminLoginPage', ['error' => 'Email and Password Must not be Empty !']);
       return;
      
    }

    // If email is invalid
    if ( ! isEmail( $email )) {
      redirectToView('auth/adminLoginPage', ['error' => 'Plase Provide a valid email']);
      return;
    }


    // $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashPassword = $password;

    $store = new Store(STORE_DATABASE);
    $store =  $store->findStoreByEmailPasswordAndStoreId($email, $hashPassword, STORE_ID);

    

    // If Pass word and Email not match do this
    if ( ! $store ) {

      $_SESSION['store'] = [];
      redirectToView('auth/storeLoginPage', ['error' => 'Invalid email and password !']);
      return;

    } 


      // If User Found do this
      $_SESSION['store'] = $store;
      redirect('store/dashboard');

?>

