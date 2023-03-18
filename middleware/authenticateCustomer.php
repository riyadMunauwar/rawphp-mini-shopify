<?php

    $prevUrl = $_SERVER['REQUEST_URI'];

    if ( ! $_SESSION['customer'] ) {

        return redirect('customer/login?after_login_url=' . $prevUrl);
        
    }

    define('CUSTOMER', $_SESSION['customer']);


?>