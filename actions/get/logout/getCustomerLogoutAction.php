<?php

    load(MIDDLEWARE, 'authenticateCustomer');

    unset($_SESSION['customer']);
    $_SESSION['customer'] = [];

    redirect('customer/login');

?>