<?php 
    load(MODELS, 'Page');


    // Params
    $page_name = get('n');

    if(! $page_name ) return redirect(' ');


    try
    {
        $pageStmt = new Page(STORE_DATABASE);
        $page = $pageStmt->findByStoreAndName(STORE_ID, $page_name);
        
        if($page) {
            view('customPage', ['page' => $page]);
        }
        else
        {
            view('customPage', ['message' => '404 Page not found']);
        }

    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from get show store custom page' . $e->getMessage();
    }



?>