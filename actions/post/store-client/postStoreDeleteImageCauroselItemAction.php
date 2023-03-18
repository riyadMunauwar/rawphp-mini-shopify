<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'ImageCaurosel');

    $image_caurosel_id = post('image_caurosel_id');

    if(!$image_caurosel_id ) {
        return redirect('store/caurosel?error=Invalid action');
    }


    try
    {
        $imageCauroselStmt = new ImageCaurosel(STORE_DATABASE);
        $isDelete = $imageCauroselStmt->deleteByStoreAndId(STORE['id'], $image_caurosel_id);

        if($isDelete){
            return redirect('store/caurosel?success=Remove');
        }
        else
        {
            return redirect('store/caurosel?error=Something went wrong try again');
        }
    }
    catch(\PDOException $e)
    {
        'This error is coming from post store delete image caurosel item action' . $e->getMessage();
    }


?>