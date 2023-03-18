<?php

    if ( ! $_SESSION['store'] ) {

        return redirect('store/login');
        
    }

    define('STORE', $_SESSION['store']);


?>