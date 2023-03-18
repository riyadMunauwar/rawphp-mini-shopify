<?php 
    
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'ImageCaurosel');


    $image_caurosel_link = post('link');
    $image_caurosel_image = post('image');


    

    if(!$image_caurosel_image){
        return redirect('store/caurosel?error=Image path not provided !');
    }


    try
    {
        $imageCauroselStmt = new ImageCaurosel(STORE_DATABASE);
        $imageCauroselStmt->link = $image_caurosel_link;
        $imageCauroselStmt->image = $image_caurosel_image;
        $imageCauroselStmt->store_id = STORE_ID;
        $imageCauroselStmt->create_at = bdTime();
        $isInert  = $imageCauroselStmt->insertImageCauroselItem();

        if($isInert){
            return redirect('store/caurosel?success=Added!');
        }
        else{
            return redirect('store/caurosel?error=Something went wrong try again !');

        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store add image caurosel item' . $e->getMessage();
    }








?>