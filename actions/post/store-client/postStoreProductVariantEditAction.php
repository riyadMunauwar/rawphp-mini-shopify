<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS,'Variation');


    $product_id = post('product_id');
    $variant_id = post('variant_id');
    $variant_photo = post('photo');
    $variant_size = post('size');
    $variant_color = post('color');
    $variant_color_code = post('color_code');
    $variant_weight = post('weight');
    $variant_stock_quantity = post('stock_quantity');
    



    if(!($product_id && $variant_id) ) return redirect("store/edit-product?product_id=$product_id&error=Invalid action");

    $data = [
        'product_id' => $product_id,
        'variant_id' => $variant_id,
        'photo' => $variant_photo,
        'size' => $variant_size,
        'color' => $variant_color,
        'color_code' => $variant_color_code,
        'weight' => $variant_weight,
        'stock_quantity' =>  $variant_stock_quantity,
    ]; 

    
    try
    {
        
        $updated = false;

        if($product_id && $variant_id){
            $variantStmt = new Variation(STORE_DATABASE);
            $isChange = $variantStmt->updateComunByProductAndVariantId('photo', $variant_photo, $product_id, $variant_id); 

            if($isChange){
                $updated = true;
            }
        }

        

        if($product_id && $variant_id){
            $variantStmt = new Variation(STORE_DATABASE);
            $isChange = $variantStmt->updateComunByProductAndVariantId('size', $variant_size, $product_id, $variant_id); 

            if($isChange){
                $updated = true;
            }
        }

        if($product_id && $variant_id){
            $variantStmt = new Variation(STORE_DATABASE);
            $isChange = $variantStmt->updateComunByProductAndVariantId('color', $variant_color, $product_id, $variant_id); 

            if($isChange){
                $updated = true;
            }
        }

        if($product_id && $variant_id){
            $variantStmt = new Variation(STORE_DATABASE);
            $isChange = $variantStmt->updateComunByProductAndVariantId('color_code', $variant_color_code, $product_id, $variant_id); 

            if($isChange){
                $updated = true;
            }
        }

        if($product_id && $variant_id){
            $variantStmt = new Variation(STORE_DATABASE);
            $isChange = $variantStmt->updateComunByProductAndVariantId('weight', $variant_weight, $product_id, $variant_id); 

            if($isChange){
                $updated = true;
            }
        }

        if($product_id && $variant_id){
            $variantStmt = new Variation(STORE_DATABASE);
            $isChange = $variantStmt->updateComunByProductAndVariantId('stock_quantity', $variant_stock_quantity, $product_id, $variant_id); 

            if($isChange){
                $updated = true;
            }
        }

        
        if($updated) return redirect("store/edit-product?product_id=$product_id&success=Updated");
        else return redirect("store/edit-product?product_id=$product_id&error=Invalid action");
        

    }
    catch(\PDOException $e)
    {
        "This error is coming from post store product variant edit action" . $e->getMessage();
    }


?>