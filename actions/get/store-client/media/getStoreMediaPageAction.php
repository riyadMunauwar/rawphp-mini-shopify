<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Image');

    // PARAMS
    $page_no = (int) get('page');

    if(!$page_no){
        $page_no = 1;
    }


    $total = 1;
    $per_page = 12;

    try
    {
        $imageStmt = new Image(STORE_DATABASE);
        $countTotal = $imageStmt->countTotalImageByStoreId(STORE['id']);
        
        if($countTotal){
            $total = $countTotal;
        } 

    }
    catch(\PDOException $e)
    {
        echo 'error is coming add media page action' . $e->getMessage();
    }

    if($page_no < 1 || $page_no > $total){
        redirect('store/dashboard');
        return;
    }

    $total_page = ceil($total / $per_page);
    $offset = ( $page_no - 1 ) * $per_page;



    $pagination = [
        'total_page' => $total_page,
        'current_page' => $page_no,
    ];


    try
    {
        $imageStmt = new Image(STORE_DATABASE);
        $images = $imageStmt->paginateImagesByStoreId(STORE['id'], $offset, $per_page);

        view('store/storeMediaPage', ['images' => $images, 'pagination' => $pagination]);


    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from ' . $e->getMessage();
    }

    




?>