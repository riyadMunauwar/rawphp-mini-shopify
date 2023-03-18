<?php


    if ( ! $_SESSION['admin'] ) {

        return redirect('admin/login');
        
    }

    define('ADMIN', $_SESSION['admin']);

?>