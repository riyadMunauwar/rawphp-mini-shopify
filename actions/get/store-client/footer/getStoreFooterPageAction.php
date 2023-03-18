<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Footer');


    try
    {
        $footerStmt = new Footer(STORE_DATABASE);
        $footer = $footerStmt->findByStoreId(STORE['id']);
        if($footer){
           view('store/storeFooterPage', ['footer' => $footer, 'init' => false]);
        }
        else
        {
           view('store/storeFooterPage', ['init' => true]);
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from get store footer init action ' . $e->getMessage();
    }

?>