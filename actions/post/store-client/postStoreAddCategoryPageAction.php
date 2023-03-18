<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(VALIDATION, 'validation');
    load(MODELS, 'Category');
    

    $category_name = validation(post('name'));
    $category_slug = validation(post('slug'));
    $category_parent_id = validation(post('parent_id'));
    $category_thumbnail = validation(post('thumbnail'));
    $category_description = validation(post('description'));



    $errors = [];

    if(!$category_name) $errors[] = 'Category name must not be empty';
    // if(!$category_slug) $errors[] = 'Category slug must not be empty';
    

    $formData = [
        'name' => $category_name,
        'slug' => $category_slug,
        'thumbnail' => $category_thumbnail,
        'description' => $category_description,
        // 'prent_id' => $category_parent_id,
        // 'store_id' =>  STORE_ID
    ];




    try
    {
        $category = new Category(STORE_DATABASE);
        
        

        if ($errors) {

            $allCategory = $category->findManyByStoreId(STORE['id']);
            view('store/storeAddCategoryPage', ['errors' => $errors, 'formData' => $formData, 'categories' => $allCategory]);
            return;
        }


        $isCategoryAlreadyHave = $category->findByStorIdAndName(STORE['id'], $category_name);

        if($isCategoryAlreadyHave) {

            $allCategory = $category->findManyByStoreId(STORE['id']);
            $errors[] = "This Category is already available";
            view('store/storeAddCategoryPage', ['errors' => $errors, 'formData' => $formData, 'categories' => $allCategory]);
            return;

        }

   


        $category->name = $category_name;
        $category->slug = $category_slug;
        $category->parent_id = $category_parent_id;
        $category->description = $category_description;
        $category->thumbnail = $category_thumbnail;
        $category->store_id = STORE_ID;

        if($category->insert()) {
            
            $allCategory = $category->findManyByStoreId(STORE['id']);
            view('store/storeAddCategoryPage', ['message' => 'Category Created Successfully', 'categories' => $allCategory]);
            return;

        }else {

            $allCategory = $category->findManyByStoreId(STORE['id']);
            view('store/storeAddCategoryPage', ['message-yellow' => 'Failed to create Category ! Please try agian.', 'categories' => $allCategory]);
            return;

        }


    }
    catch(Exception $e)
    {
        echo 'this error is coming from add category post action' . $e->getMessage();
    }
    

?>