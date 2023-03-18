<?php

    load(MIDDLEWARE, 'authenticateAdmin');

    unset($_SESSION['admin']);
    $_SESSION['admin'] = [];

    redirect('admin/login');


?>