<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Page');





    try{
        $pageStmt = new Page(STORE_DATABASE);
        $pages = $pageStmt->findManyByStoreId(STORE['id']);

        view('store/storePagesPage', ['pages' => $pages]);
    }
    catch(\PODException $e)
    {
        echo 'this error is coming from get store page action' . $e->getMessage();
    } 

    

?>