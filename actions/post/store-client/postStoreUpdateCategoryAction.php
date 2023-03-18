<?php
    load(MIDDLEWARE,'authenticateStore');
    load(MODELS, 'Category');


    // Params

    $category_id = post('category_id');
    $category_name = post('name');
    $category_slug = post('slug');
    $category_thumbnail = post('thumbnail');
    $category_parent_id = post('parent_id');
    $category_description = post('description');

    
    if( ! $category_id ) {
         return redirect("store/update-category?category_id=$category_id&error=Something went wrong. Try again");
    }

    if( ! ( $category_name ) ) {
        return redirect("store/update-category?category_id=$category_id&error=Category name and slug must not be empty");
    }
    

    try
    {
        $categoryStmt = new Category(STORE_DATABASE);
        $categoryStmt->name = $category_name;
        $categoryStmt->slug = $category_slug;
        $categoryStmt->thumbnail = $category_thumbnail;
        $categoryStmt->parent_id = $category_parent_id ;
        $categoryStmt->description = $category_description;
        $categoryStmt->update_at = bdTime();
        $categoryStmt->store_id = STORE['id'];
        $update = $categoryStmt->updateByStoreAndId($category_id);
        if($update){
            return redirect("store/update-category?category_id=$category_id&success=updated");
        }

    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store category update action ' . $e->getMessage();
    }

?>