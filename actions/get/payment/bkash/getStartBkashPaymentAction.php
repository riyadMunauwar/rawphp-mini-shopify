<?php 
    load(MIDDLEWARE, 'authenticateCustomer');
    load(SERVICES, 'Http');
    load(SERVICES, 'Email');


    // $http = new Http();

    $email = new Email();



    // echo $http->getData();
    // echo 'payment by bkash';

    $email->sentMail();

?>