<?php

    // If customer already login redirect to current page
    load(MIDDLEWARE, 'isCustomerLogin');

    view('auth/customerLoginPage');

?>