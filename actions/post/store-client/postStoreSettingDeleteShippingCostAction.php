<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'ShippingCost');



    $shipping_cost_id = post('shipping_cost_id');

    if(!$shipping_cost_id) return redirect('store/setting?error=Invalid action');

    try
    {
        $shippingCostStmt = new ShippingCost(STORE_DATABASE);
        $isHave = $shippingCostStmt->findByStoreAndId(STORE['id'], $shipping_cost_id);

        if(!$isHave) return redirect('store/setting?error=Invalid action');

        $delete = $shippingCostStmt->deleteByStoreAndId(STORE['id'], $shipping_cost_id);

        if($delete){
            return redirect('store/setting?success=Deleted');
        }
        else{
            return redirect('store/setting?error=Somethine went wrong try again');
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store delete shipping cost action ' . $e->getMessage();
    }


?>