<?php 
    
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'FeaturedProductCauroselItem');
    load(MODELS, 'Product');




    $featured_product_caurosel_product_id = post('product_id');



    

    if(!$featured_product_caurosel_product_id){
        return redirect('store/caurosel?error=Product ID not provided !');
    }


    try
    {
        $productStmt = new Product(STORE_DATABASE);
        $product = $productStmt->findByStoreAndId(STORE['id'], $featured_product_caurosel_product_id);

        if($product){

            $imageCauroselStmt = new FeaturedProductCauroselItem(STORE_DATABASE);
            $imageCauroselStmt->product_id = $featured_product_caurosel_product_id;
            $imageCauroselStmt->store_id = STORE['id'];
            $imageCauroselStmt->create_at = bdTime();
            $isInsert = $imageCauroselStmt->insertFeaturedProductCauroselItem();
    
            if($isInsert){
                return redirect('store/caurosel?success=Added!');
            }
            else{
                return redirect('store/caurosel?error=Something went wrong try again !');
    
            }
            
        }
        else 
        {
            return redirect('store/caurosel?error=Invalid Action ! This product id not valid!');
        }


    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store add featreud product caurosel item action' . $e->getMessage();
    }








?>