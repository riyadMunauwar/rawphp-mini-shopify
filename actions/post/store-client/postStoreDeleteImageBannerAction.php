<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'ImageBanner');


    $banner_image_id = post('banner_image_id');

    if(!$banner_image_id) return redirect('store/caurosel?error=Something went wrong try again');


    
    try
    {
        $imageBannerStmt = new ImageBanner(STORE_DATABASE);
        $foundImageBanner = $imageBannerStmt->findByStoreAndId(STORE['id'], $banner_image_id);

        if($foundImageBanner){
            $delete = $imageBannerStmt->deleteByStoreAndId(STORE['id'], $banner_image_id);
            
            if(!$delete) return redirect('store/caurosel?error=Something went wrong try again');

            return redirect('store/caurosel?success=Deleted');
        }
        else
        {
            return redirect('store/caurosel?error=Something went wrong try again');
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store delete image banner action ' . $e->getMessage();
    }


    


?>