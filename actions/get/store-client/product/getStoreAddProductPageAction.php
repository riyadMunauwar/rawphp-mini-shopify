<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Category');
    load(MODELS, 'Brand');


    try
    {
        $category = new Category(STORE_DATABASE);
        $categories = $category->findManyByStoreId(STORE['id']);

        $brand = new Brand(STORE_DATABASE);
        $brands = $brand->findManyByStoreId(STORE['id']);

        $data = [
            'categories' => $categories,
            'brands' => $brands
        ];

        view('store/storeAddProductPage', $data);

    }
    catch(Exception $e)
    {
        echo 'Error is coming from getStoreAddProduct Page' . $e->getMessage();
    }

 

?>