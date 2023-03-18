<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'FeaturedProductCauroselItem');

    $product_id = post('product_id');


    if(!$product_id ) {
        return redirect('store/caurosel?error=Invalid action');
    }


    try
    {
        $featuredProductStmt = new FeaturedProductCauroselItem(STORE_DATABASE);
        $isDelete = $featuredProductStmt->deleteByStoreAndProductId(STORE['id'], $product_id );

        if($isDelete){
            return redirect('store/caurosel?success=Remove');
        }
        else
        {
            return redirect('store/caurosel?error=Something went wrong try again');
        }
    }
    catch(\PDOException $e)
    {
        'This error is coming from post store delete featured product caurosel item action' . $e->getMessage();
    }


?>