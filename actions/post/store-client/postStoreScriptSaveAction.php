<?php 

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Script');

    $script = post('script');
    $scriptId = post('script_id');

    if(!$scriptId) return redirect('store/script?error=Something went wrong try again');

   
    try
    {
        $scriptStmt = new Script(STORE_DATABASE);
        $foundScript = $scriptStmt->findByStoreId(STORE['id']);
     

        if($foundScript){
            $scriptStmt->script = $script;
            $scriptStmt->update_at = bdTime();
            $isSave = $scriptStmt->updateByStoreIdAndId(STORE['id'], $scriptId);
            if($isSave){
                return redirect('store/script?success=Save successfully');
            }
            else
            {
                return redirect('store/script?error=Something went wrong try again');
            }
        }
        else
        {
            return redirect('store/script?error=Something went wrong try again');
        }

    }
    catch(\PDOException $e)
    {
        'This error is comingFrom post store save action ' . $e->getMessage();
    }




?>