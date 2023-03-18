<?php

    if ( ! array_key_exists('store', $_SESSION) ) {
        $_SESSION['store'] = [];
    }

    if ( $_SESSION['store'] ) {
        return redirect('store/dashboard');
    }

?>