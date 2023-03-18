<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Page');


    // PARAMS
    $pageID = get('page-id');

    if( ! $pageID ){
        return redirect('store/page');
    }

    try
    {
        $pageStmt = new Page(STORE_DATABASE);
        $isDelete =  $pageStmt->deleteByStoreAndId(STORE['id'], $pageID);

        if($isDelete) {
            return redirect('store/page?success=Delete Successfully');
        }
        else {
            return redirect('store/page?error=Something went wrong try again');
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from get store delete page action' . $e->getMessage();
    }

    


?>