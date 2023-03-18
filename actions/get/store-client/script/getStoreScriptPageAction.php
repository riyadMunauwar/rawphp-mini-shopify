<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Script');

    try
    {
        $scriptStmt = new Script(STORE_DATABASE);
        $script = $scriptStmt->findByStoreId(STORE['id']);

        if($script){
            view('store/storeScriptPage', ['script' => $script, $init = false]);
        }
        else
        {
            view('store/storeScriptPage', ['init' => true]);

        }
    }
    catch(\PDOException $e)
    {
        echo "This error is coming from get store script page action " . $e->getMessage();
    }
    

?>