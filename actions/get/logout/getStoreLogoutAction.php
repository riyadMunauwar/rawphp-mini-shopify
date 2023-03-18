<?php

    load(MIDDLEWARE, 'authenticateStore');

    unset($_SESSION['store']);
    $_SESSION['store'] = [];

    redirect('store/login');

?>