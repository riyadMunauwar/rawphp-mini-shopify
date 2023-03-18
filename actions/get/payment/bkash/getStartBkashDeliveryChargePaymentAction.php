<?php
    load(MIDDLEWARE,'authenticateCustomer');

    $order_id = get('order_id');

    echo $order_id;


?>