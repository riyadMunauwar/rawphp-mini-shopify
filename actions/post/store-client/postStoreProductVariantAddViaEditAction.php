<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Variation');


    $product_id = post('product_id');


    $photo = post('photo');
    $size = post('size');
    $color = post('color');
    $color_code = post('color_code');
    $weight = post('weight');
    $stock_quantity = post('stock_quantity');


    $data = [
        'product_id' => $product_id,
        'photo' => $photo ,
        'size' => $size,
        'color' => $color,
        'weight' => $weight,
        'stock_quanity' => $stock_quantity,
    ];

    
    if( ! ($stock_quantity && ($size || $color || $weight)) ){
        return redirect("store/edit-product?product_id=159&error=Stock quantity or any variant value not provide !");
    }


    try
    {
        $variantStmt = new Variation(STORE_DATABASE);
        $variantStmt->photo = $photo;
        $variantStmt->color = $color;
        $variantStmt->color_code = $color_code;
        $variantStmt->weight = $weight;
        $variantStmt->size = $size;
        $variantStmt->stock_quantity = $stock_quantity;
        $variantStmt->create_at = bdTime();
        $variantStmt->product_id = $product_id;
        $save = $variantStmt->addVariantBiaEdit();

        if($save){
            return redirect("store/edit-product?product_id=159&success=Added !");
        }else
        {
             return redirect("store/edit-product?product_id=159&error=Something went wrong try again !");
        }
        
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store product add variant via edit action' . $e->getMessage();
    }


?>