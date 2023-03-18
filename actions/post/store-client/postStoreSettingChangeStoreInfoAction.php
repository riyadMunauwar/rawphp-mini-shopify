<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(VALIDATION, 'validation');
    load(MODELS, 'Store');


    $store_name = validation(post('name'));
    $store_title = validation(post('title'));
    $store_description = validation(post('description'));
    $store_email = validation(post('email'));
    $store_logo = post('logo');
    $store_old_password = validation(post('old_password'));
    $store_new_password = validation(post('new_password'));
    $store_confirm_password = validation(post('confirm_password'));
    $store_favicon = post('favicon');
    $store_image_caurosel = post('image_caurosel');
    $store_featured_product_caurosel = post('featured_product_caurosel');
    $store_brand_caurosel = post('brand_caurosel');
    $store_selling_feature_banner = post('selling_feature_banner');
    $store_image_banner = post('image_banner');


 

    // Hande active and Deactive Part Here frist


    if($store_old_password && $store_new_password && $store_confirm_password){
        if($store_new_password !== $store_confirm_password) return redirect('store/setting?error=New password and confirm password not match !');

        if(strlen($store_new_password) < 12){
            return redirect('store/setting?error=Password length must be 12 or avobe.');
        }
    }


    if( ! ($store_description || $store_selling_feature_banner || $store_image_banner || $store_favicon || $store_brand_caurosel || $store_featured_product_caurosel || $store_image_caurosel || $store_name || $store_title || $store_email || $store_logo || $store_old_password || $store_new_password || $store_confirm_password) ){
        return redirect('store/setting?error=Value is empty !');
    }


    try
    {
        if($store_name) {
           $storeStmt = new Store(STORE_DATABASE);
           $update = $storeStmt->updateStoreNameByStoreId($store_name, STORE['id']);

           if($update) return redirect('store/setting?success=Updated !');
        }
        
    
    
        if($store_email){
            if(! isEmail($store_email) ){
                return redirect('store/setting?error=Invalid Email !');
            }
            else{
                $storeStmt = new Store(STORE_DATABASE);
                $update = $storeStmt->updateStoreEmailByStoreId($store_email, STORE['id']);
                if($update) return redirect('store/setting?success=Updated !');
            }
        }
    
    
        if($store_logo){
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->updateStoreLogoByStoreId($store_logo, STORE['id']);
 
            if($update) return redirect('store/setting?success=Updated !');
        }


        if($store_old_password && $store_old_password && $store_confirm_password){

            if(STORE['password'] === $store_old_password){
                $storeStmt = new Store(STORE_DATABASE);
                $update = $storeStmt->updateStorePasswordByStoreId($store_new_password, STORE['id']);
     
                if($update) return redirect('store/logout');
            }
            else
            {
                return redirect('store/setting?error=Old password does not match !');
            }
        }


        if($store_favicon){
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->updateStoreFaviconByStoreId($store_favicon, STORE['id']);
 
            if($update) return redirect('store/setting?success=Updated !');
        }

        if($store_title){
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->updateStoreTitleByStoreId($store_title, STORE['id']);
 
            if($update) return redirect('store/setting?success=Updated !');
        }
        
        if($store_description){
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->updateStoreDescriptionByStoreId($store_description, STORE['id']);
 
            if($update) return redirect('store/setting?success=Updated !');
        }


        if($store_image_caurosel){

            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->toggleTrueOrFalseByStoreId('image_caurosel', STORE['id']);

            if($update) return redirect('store/setting?success=Updated !');
        
        }



        if($store_featured_product_caurosel){
            
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->toggleTrueOrFalseByStoreId('featured_product_caurosel', STORE['id']);

            if($update) return redirect('store/setting?success=Updated !');
        }



        if($store_brand_caurosel){

            
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->toggleTrueOrFalseByStoreId('brand_caurosel', STORE['id']);

            if($update) return redirect('store/setting?success=Updated !');
        }

        if($store_selling_feature_banner){

            
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->toggleTrueOrFalseByStoreId('selling_feature_banner', STORE['id']);

            if($update) return redirect('store/setting?success=Updated !');
        }

        if($store_image_banner){

            
            $storeStmt = new Store(STORE_DATABASE);
            $update = $storeStmt->toggleTrueOrFalseByStoreId('image_banner', STORE['id']);

            if($update) return redirect('store/setting?success=Updated !');
        }
        
   
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store setting change store info action ' . $e->getMessage();
    }



?>