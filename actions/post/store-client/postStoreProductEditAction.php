<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Product');
    load(MODELS, 'CategoryProduct');

    

    $product_id = post('product_id');
    $product_name = post('name');
    $product_slug = post('slug');
    $product_unit_price = post('unit_price');
    $product_purchase_price = post('purchase_price');
    $product_discount = post('discount');
    $product_stock_quantity = post('stock_quantity');
    $product_short_description = post('short_description');
    $product_description = post('description');
    $product_thumbnail = post('thumbnail');
    $product_video_url = post('video_url');
    $product_brand_id = post('brand_id');
    $product_category_id = post('category_id');
    $product_old_category_id = post('old_category_id');


    $data = [
        'id' => $product_id,
        'name' => $product_name,
        'slug' => $product_slug,
        'unit_price' => $product_unit_price,
        'purchase_price' => $product_purchase_price,
        'discount' => $product_discount,
        'stock_quantity' => $product_stock_quantity,
        'thumbnail' => $product_thumbnail,
        'video_url' => $product_video_url,
        'short_description' => $product_short_description,
        'description' => $product_description,
        'brand_id' => $product_brand_id,
        'category_id' => $product_category_id,
        'old_category_id' => $product_old_category_id
    ];


 

    try
    {
        if($product_name) {

            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('name', $product_name, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
            
        }

        if($product_slug) {

            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('slug', $product_slug, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_unit_price) {
            // Do Something
            
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('unit_price', $product_unit_price, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_purchase_price) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('purchase_price', $product_purchase_price, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_discount) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('discount', $product_discount, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_stock_quantity) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('stock_quantity', $product_stock_quantity, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_short_description) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('short_description', $product_short_description, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_description) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('description', $product_description, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_thumbnail) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('thumbnail', $product_thumbnail, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_video_url) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('video_url', $product_video_url, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_brand_id) {
            // Do Something
            $productStmt = new Product(STORE_DATABASE);
            $update = $productStmt->updateColumnValueByStoreAndProductId('brand_id', $product_brand_id, STORE['id'], $product_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }

        if($product_category_id) {
            // Do Something
            $categoryProductStmt = new CategoryProduct(STORE_DATABASE);
            $update = $categoryProductStmt->updateCategoryIdByProductId($product_id, $product_old_category_id, $product_category_id);

            if($update) return redirect("store/edit-product?product_id=$product_id&success=Updated");
            else
            return redirect("store/edit-product?product_id=$product_id&error=Something went wrong try again.");
        }
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from post store product edit action ' . $e->getMessage();
    }
    

?>