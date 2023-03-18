<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Image');


    // Params
    $imageID = get('image-id');

    if(!$imageID ){
        redirect('store/media?error=Invalid action');
    }


    try
    {
        $imageStmt = new Image(STORE_DATABASE);
        $image = $imageStmt->findByStoreAndId(STORE['id'], $imageID);
        
        if($image){
            $isSuccessFullyDelete = unlink($image['src']);
            if($isSuccessFullyDelete){
                $imageStmt= new Image(STORE_DATABASE);
                $isDeleteFromDatabase = $imageStmt->deleteByStoreAndId(STORE['id'], $imageID);

                if($isDeleteFromDatabase){
                    redirect('store/media?success=Successfully deleted !');
                }
                else
                {
                    redirect('store/media?error=Something went wrong ! failed to delete tray again.');
                }
            }
            else
            {
                redirect('store/media?error=Something went wrong ! failed to delete tray again.');
            }
        }
        else
        {
            redirect('store/media?error=Something went wrong ! failed to delete tray again.');
        }

    }
    catch(\PDOException $e)
    {
        echo "THIS error is coming from delete media action page" . $e->getMessage();
    }





?>