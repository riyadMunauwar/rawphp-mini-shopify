<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Page');

    // Params
    $pageID = get('page-id');

    if( ! $pageID ) {
        return redirect('store/page');
    }

    
    try
    {
        $pageStmt = new Page(STORE_DATABASE);
        $page = $pageStmt->findByStoreAndId(STORE['id'], $pageID);
        
        if($page){
            view('store/storePageUpdatePage', ['page' => $page]);
        }

    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from get store update' . $e->getMessage();
    }

?>