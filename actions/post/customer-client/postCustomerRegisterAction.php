<?php

    load(VALIDATION, 'validation');
    load(MODELS, 'Customer');


    $name = validation(post('name'));
    $email = validation(post('email'));
    $phone = validation(post('phone'));
    $password = validation(post('password'));
    $confirm = validation(post('confirm'));


    
    if( !($name && $email && $phone && $password && $confirm ) ) {
        redirectToView('auth/customerRegistrationPage', ['error' => 'Please fill all the information !']);
        return;
    }

    if( ! isEmail($email) ){
        redirectToView('auth/customerRegistrationPage', ['error' => 'Plase Enter a valid email !']);
        return;
    }

    if( ! isBdPhoneNumber($phone) ) {
        redirectToView('auth/customerRegistrationPage', ['error' => 'Plase Enter a valid phone number !']);
        return;
    }


    $customer = new Customer(STORE_DATABASE);
    $isEmailFound = $customer->findCustomerByEmailAndStoreId($email, STORE_ID);

    if(  $isEmailFound ) {

        $info = [
            'error' => 'This email is already exist. Please use another',
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'confirm' => $confirm,
        ];

        redirectToView('auth/customerRegistrationPage', $info);
        return;
    }


    if(  $password != $confirm ) {
        $info = [
            'error' => 'Password and Confirm Password not match !',
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'confirm' => $confirm,
            'redBorder' => 'border border-red-600 ',
        ];

        redirectToView('auth/customerRegistrationPage', $info);
        return;
    }


    if( strlen($password) < 8 ){

            $info = [
                'error' => 'Password must be greater than 8 charecter !',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'confirm' => $confirm,
                // 'redBorder' => 'border border-red-600 ',
            ];
    
            redirectToView('auth/customerRegistrationPage', $info);
            return;
  
    }


       $isCreate =  $customer->createCustomer($name, $email, $phone, $password, STORE_ID);

       if( $isCreate ) {

            view('auth/customerLoginPage', ['message' => 'Your account create Successfy. Please Login']);
            return;

       }else {

            $info = [
                'error' => 'Failed to create account ! try again',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'confirm' => $confirm,
                // 'redBorder' => 'border border-red-600 ',
            ];

            redirectToView('auth/customerRegistrationPage', $info);

        }


?>

