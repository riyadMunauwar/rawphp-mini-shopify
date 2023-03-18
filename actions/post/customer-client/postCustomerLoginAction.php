<?php

    load(VALIDATION, 'validation');
    load(MODELS, 'Customer');

    $email      =   validation(post('email'));
    $password   =   post('password');
    $after_login_url = post('after_login_url');

   


    // If user and email field empty
    if( ! ( $email && $password ) ){

       redirectToView('auth/customerLoginPage', ['error' => 'Email and Password Must not be Empty !']);
       return;
      
    }

    // If email is invalid
    if ( ! isEmail( $email )) {
      redirectToView('auth/customerLoginPage', ['error' => 'Plase Provide a valid email']);
      return;
    }


    // $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashPassword = $password;

    $customer = new Customer(STORE_DATABASE);
    $customer =  $customer->findCustomerByEmailPasswordAndStoreId($email, $hashPassword, STORE_ID);


    // If Pass word and Email not match do this
    if ( ! $customer ) {

      $_SESSION['customer'] = [];
      redirectToView('auth/customerLoginPage', ['error' => 'Invalid email and password !']);
      return;

    } 

 
      // If User Found do this
      $_SESSION['customer'] = $customer;

      if($after_login_url){
        redirect(ltrim($after_login_url, BASE_PATH));
      }else
      {
        redirect('customer/dashboard');
      }

?>