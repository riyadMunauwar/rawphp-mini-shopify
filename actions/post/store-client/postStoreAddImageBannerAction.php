<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'ImageBanner');

    $banner_image_link = post('banner_image_link');
    $banner_image_path = post('banner_image_path');

    

    if(!$banner_image_path) return redirect('store/caurosel?error=Banner image path is empty !');
    


    try
    {

        $imageBannerStmt = new ImageBanner(STORE_DATABASE);

        $isAlreadyExistOne = $imageBannerStmt->findByStoreId(STORE['id']);
        if($isAlreadyExistOne) return redirect('store/caurosel?error=Already exist one delete it frist !');

        
        $imageBannerStmt->banner_link = $banner_image_link;
        $imageBannerStmt->image = $banner_image_path;
        $imageBannerStmt->store_id = STORE['id'];
        $imageBannerStmt->create_at = bdTime();
        $isCreate = $imageBannerStmt->insertBannerImage();

        if($isCreate){
            return redirect('store/caurosel?success=Added !');
        }
        else
        {
            return redirect('store/caurosel?error=Something went wrong. Try Again !');
        }
        
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store add image banner action ' . $e->getMessage();
    }


?>