<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Footer');

    // query params
    $store_id = get('store-id');

    // Redirect To Home
    if(!$store_id) return redirect(' ');

    try
    {
        $footerStmt = new Footer(STORE_DATABASE);
        $footer = $footerStmt->findByStoreId(STORE['id']);
        if(!$footer){
            $footerStmt = new Footer(STORE_DATABASE);
            $footerStmt->store_id = STORE['id'];
            $footerStmt->create_at = bdTime();
            $isCreate = $footerStmt->insert();
            if($isCreate) {
                return redirect('store/footer?success=Init Successfully');
            }
            else
            {
                return redirect('store/footer?error=Something went wrong ! Try Again');
            }
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from get store footer init action ' . $e->getMessage();
    }

?>