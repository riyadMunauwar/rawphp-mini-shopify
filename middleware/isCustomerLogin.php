<?php

    if ( ! array_key_exists('customer', $_SESSION) ) {
        $_SESSION['customer'] = [];
    }
    
    
    
    if ( $_SESSION['customer'] ) {
        return redirect('customer/dashboard');
    }

?>