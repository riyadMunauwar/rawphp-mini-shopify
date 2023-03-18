<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Brand');




    try
    {

        $brand = new Brand(STORE_DATABASE);
        $allBrand = $brand->findManyByStoreId(STORE['id']);

   
        view('store/storeBrandPage', ['brands' => $allBrand ]);
 
    }
    catch(Exception $e)
    {
        echo 'this error coming from get Brand Page action' .$e->getMessage();
    }


    view('store/storeBrandPage');

?>