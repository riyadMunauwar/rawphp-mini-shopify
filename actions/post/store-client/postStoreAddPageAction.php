<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(VALIDATION, 'validation');
    load(MODELS, 'Page');

    $page_name      = strtolower(validation(post('name')));
    $page_title     = validation(post('title'));
    $page_content   = post('content');


    $data = [
        'name' => $page_name ,
        'title' => $page_title,
        'content' => $page_content,
    ];


    if( !$page_name ) return redirect('store/add-page?error=Page name must not be empty !');

    try
    {
        $pageStmt = new Page(STORE_DATABASE);
        $isAlreadyExist = $pageStmt->findByStoreAndId(STORE['id'], $page_name);

        if($isAlreadyExist) {
           return redirect('store/add-page?error=This page name already used. Please use another !');
        }
        else
        {
            $pageStmt = new Page(STORE_DATABASE);
            $pageStmt->name = $page_name;
            $pageStmt->title = $page_title;
            $pageStmt->content = $page_content;
            $pageStmt->store_id = STORE['id'];
            $pageStmt->create_at = bdTime();
            $pageStmt->insert();

            return redirect('store/add-page?success=Page create successfully !');
        }


    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store add page action' . $e->getMessage();
    }

?>