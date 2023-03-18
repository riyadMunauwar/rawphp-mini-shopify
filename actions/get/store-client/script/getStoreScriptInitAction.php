<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Script');
    
    // PARMS
    $storeID = get('store-id');

    if(!$storeID) return redirect('store/dashboard');


    try
    {
        $scriptStmt = new Script(STORE_DATABASE);
        $script = $scriptStmt->findByStoreId(STORE['id']);

        if(!$script){
            $scriptStmt->store_id = STORE['id'];
            $scriptStmt->create_at = bdTime();
          
            if($scriptStmt->insert()){
                return redirect('store/script?success=Init successfully');
            }
            else
            {
                return redirect('store/script?error=Something went wrong try again');
            }
        }
        else
        {
            return redirect('store/script?error=Already Inited');
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from get Store script init action' . $e->getMessage();
    }


?>