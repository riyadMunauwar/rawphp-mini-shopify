<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Category');

    // Params 
    $categoryID = get('category_id');

    if(!$categoryID) redirect('store/category');


    try
    {
        $categoryStmt = new Category(STORE_DATABASE);
        $category = $categoryStmt->findByStoreAndId(STORE['id'], $categoryID);
        $categories = $categoryStmt->findManyByStoreId(STORE['id']);

        view('store/storeUpdateCategoryPage', ['category' => $category, 'categories' => $categories]);

        
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from category update page ' . $e->getMessage();
    }



?>