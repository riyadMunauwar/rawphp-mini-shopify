<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Category');




    try
    {

        $category = new Category(STORE_DATABASE);
        $allCategories = $category->findManyByStoreId(STORE['id']);


        view('store/storeCategoryPage', ['categories' => $allCategories]);
        
 
  
    }
    catch(Exception $e)
    {
        echo 'this error coming from Category Controller' .$e->getMessage();
    }

  

    
?>