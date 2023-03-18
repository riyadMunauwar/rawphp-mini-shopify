<?php

    load(VALIDATION, 'validation');
    load(MODELS, 'Admin');

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

    $admin = new Admin(CORE_DATABASE);
    $admin =  $admin->findAdminByEmailAndPassword($email, $hashPassword);



    // If Pass word and Email not match do this
    if ( ! $admin ) {

      $_SESSION['admin'] = [];
      redirectToView('auth/adminLoginPage', ['error' => 'Invalid email and password !']);
      return;

    } 


      // If User Found do this
      $_SESSION['admin'] = $admin;
      redirect('admin/dashboard');

?>

























<?php

load(MODELS, 'Admin');

$email     = trim(post('email'));
$password = trim(post('password'));

// Validation need but skip for now


  if( $email && $password ){

    

      $admin = new Admin(CORE_DATABASE);
      $admin = $admin->admin();

      if( $email === $admin['email'] && $password === $admin['password'] ){

        $_SESSION['admin'] = $admin;
        redirect('admin/dashboard');
        return;

      }else {

        $_SESSION['admin'] = [];
        redirectToView('auth/adminLoginPage', ['error' => 'Email and Password does not match !']);
      
      }
    
  }


?>