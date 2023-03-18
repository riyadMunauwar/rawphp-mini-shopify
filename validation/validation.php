<?php

    // Basic Validate
    function validation($data){

        if( $data ) return htmlspecialchars(stripslashes(trim($data)));

    }


    // Validate Email
    function isEmail($email){

        if( $email ) return filter_var($email, FILTER_VALIDATE_EMAIL);

    }



    function isBdPhoneNumber($phone_number){

        if ( ! $phone_number ) return false;

        return preg_match("/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/", $phone_number);

    }


?>