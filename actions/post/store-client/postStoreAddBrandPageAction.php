<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(VALIDATION, 'validation');
    load(MODELS, 'Brand');
    

    $brand_name = validation(post('name'));
    $brand_slug = validation(post('slug'));
    $brand_thumbnail = validation(post('thumbnail'));
    $brand_description = validation(post('description'));



    $errors = [];

    if(!$brand_name) $errors[] = 'Brand name must not be empty';
    // if(!$brand_slug) $errors[] = 'Brand slug must not be empty';
    

    $formData = [
        'name' => $brand_name,
        'slug' => $brand_slug,
        'thumbnail' => $brand_thumbnail,
        'description' => $brand_description,
    ];




    try
    {
        $brand = new Brand(STORE_DATABASE);
        
        

        if ($errors) {

            view('store/storeAddBrandPage', ['errors' => $errors, 'formData' => $formData]);
            return;
        }


        $isBrandAlreadyHave = $brand->findByStoreAndName(STORE['id'], $brand_name);

        if($isBrandAlreadyHave) {
            $errors[] = "This Brand is already available";
            view('store/storeAddBrandPage', ['errors' => $errors, 'formData' => $formData]);
            return;

        }

   


        $brand->name = $brand_name;
        $brand->slug = $brand_slug;
        $brand->description = $brand_description;
        $brand->thumbnail = $brand_thumbnail;
        $brand->store_id = STORE_ID;

        if($brand->insert()) {
            
            view('store/storeAddBrandPage', ['message' => 'Brand Created Successfully',]);
            return;

        }else {

            view('store/storeAddBrandPage', ['message-yellow' => 'Failed to create brand try again']);
            return;

        }


    }
    catch(Exception $e)
    {
        echo 'this error is coming from add brand post action' . $e->getMessage();
    }
    

?>