<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Brand');


    // Params
    $brandID = get('brand-id');

    if(!$brandID) return redirect('store/brand');


    try
    {
        $brandStmt = new Brand(STORE_DATABASE);
        $brand = $brandStmt->findById($brandID);
        
        view('store/storeUpdateBrandPage', ['brand' => $brand]);

    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from  get store update brand page action ' . $e->getMessage(); 
    }


?>