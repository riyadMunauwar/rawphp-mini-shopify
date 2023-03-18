<?php 

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Brand');
    load(MODELS, 'Product');

    // Params

    $brandID = get('brand-id');

    if(! $brandID ) return redirect('store/brand');

    try
    {
        $productStmt = new Product(STORE_DATABASE);
        $product = $productStmt->findProductByBrandId($brandID);

        if($product){
            return redirect('store/brand?error=This brand has products. Delete those products first. Then try again.');
        }
        else
        {
            $brandStmt = new Brand(STORE_DATABASE);
            $isDelete =  $brandStmt->deleteByStoreAndId(STORE['id'], $brandID);

            if($isDelete){
                return redirect('store/brand?success=Deleted');
            }
            else
            {
                return redirect('store/brand?error=Something went wrong. Try again');
            }
        }


    }
    catch(\PDOException $e)
    {
        echo "This error is coming from get store delete brand action " . $e->getMessage();
    }

?>