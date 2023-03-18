<?php

    load(MIDDLEWARE, 'authenticateCustomer');
    load(MODELS, 'Product');
    load(MODELS, 'ShoppingCart');

    

    

    try
    {


    }
    catch(\PDOException $e)
    {

        echo 'erroris comong form api get all carts json get page action';

    }


    view('cartPage');


?>