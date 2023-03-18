<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(VALIDATION, 'validation');
    load(MODELS, 'Page');


    $page_name  = strtolower(validation(post('name')));
    $page_title = validation(post('title'));
    $page_content = post('content');
    $page_id = post('page-id');


    
    
    try
    {
        $pageStmt = new Page(STORE_DATABASE);
        $page = $pageStmt->findByStoreAndId(STORE['id'], $page_id);
        
        if($page){
            $pageStmt = new Page(STORE_DATABASE);
            $pageStmt->name = $page_name;
            $pageStmt->title = $page_title;
            $pageStmt->content = $page_content;
            $pageStmt->update_at = bdTime();

            $isUpdate = $pageStmt->updateByStoreIdAndId(STORE['id'], $page_id);

            if($isUpdate){
                return redirect("store/update-page?page-id=$page_id&success=Updated successfully");
            }
            else
            {
                return redirect("store/update-page?page-id=$page_id&error=Something went wrong try again .");
            }
        }
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from' . $e->getMessage();
    }







?>