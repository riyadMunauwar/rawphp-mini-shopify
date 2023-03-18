<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Category');


    try {

        $category = new Category(STORE_DATABASE);
        $allCategory = $category->findManyByStoreId(STORE['id']);

        view('store/storeAddCategoryPage', ['categories' => $allCategory]);

    }
    catch(Exception $e){
        echo 'this error is coming from add category action' . $e->getMessage();
    }
    
    

?>