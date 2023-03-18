<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Brand');

    $brandID = post('brand_id');
    $brand_name = post('name');
    $brand_slug = post('slug');
    $brand_thumbnail = post('thumbnail');
    $brand_description = post('description');

    if( ! $brandID  ) return redirect("store/update-brand?brand-id=$brandID&error=Something went wrong tray again");

    if( ! ($brand_name)) return redirect("store/update-brand?brand-id=$brandID&error=Brand name and Brand slug must not be empty !");

    try
    {
        $brandStmt = new Brand(STORE_DATABASE);
        $brand = $brandStmt->findById($brandID);

        if($brand){
            $brandStmt->name = $brand_name ;
            $brandStmt->slug = $brand_slug ;
            $brandStmt->thumbnail = $brand_thumbnail ;
            $brandStmt->description = $brand_description ;
            $brandStmt->update_at = bdTime();
            $isUpdate = $brandStmt->updateByStoreIdAndId(STORE['id'], $brandID);

            if($isUpdate) {
                return redirect("store/update-brand?brand-id=$brandID&success=Updated");
            }
        }
        else
        {
            return redirect("store/update-brand?brand-id=$brandID&error=Something went wrong tray again");
        }
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from get store update brand page ' . $e->getMessage();
    }


?>