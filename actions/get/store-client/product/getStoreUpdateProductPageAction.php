<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Category');
    load(MODELS, 'Brand');
    load(MODELS, 'CategoryProduct');
    load(MODELS, 'Product');
    load(MODELS, 'Variation');

    $product_id = get('product_id');

    
    if(!$product_id) {
        return redirect('store/product');
    }


    try
    {
        $productStmt = new Product(STORE_DATABASE);
        $product = $productStmt->findByStoreAndId(STORE['id'], $product_id);

        if(!$product) return redirect('store/product?error=Invalid action');


       
        $categoryStmt = new CategoryProduct(STORE_DATABASE);
        $categoryId = $categoryStmt->findCategoryByProductId($product_id);

        $categoryStmt = new Category(STORE_DATABASE);
        $categories = $categoryStmt->findManyByStoreId(STORE['id']);
        
        $thisProductCategory = $categoryStmt->findByStoreAndId(STORE['id'], $categoryId[0]['category_id']);
        
        $brandStmt = new Brand(STORE_DATABASE);
        $brands = $brandStmt->findManyByStoreId(STORE['id']);

        $thisProductBrand = $brandStmt->findByStoreAndId(STORE['id'], $product['brand_id']);
        
        $variationStmt = new Variation(STORE_DATABASE);
        $variation = $variationStmt->findAllByProductId($product_id);

        
        $product['variation'] = $variation ?? [];

        $data = [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product,
            'productID' => $product_id,
            'thisProductBrand' => $thisProductBrand,
            'thisProductCategory' => $thisProductCategory,
        ];
       
        view('store/storeUpdateProductPage', $data);

    }
    catch(Exception $e)
    {
        echo 'Error is coming from getStoreAddProduct Page' . $e->getMessage();
    }

?>