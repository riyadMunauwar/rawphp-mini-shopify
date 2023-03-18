<?php 

    
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Store');
    load(MODELS, 'ShippingCost');
    load(MODELS, 'Shipper');

    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $store = $storeStmt->findStoreById(STORE['id']);


        $shippingCostStmt = new ShippingCost(STORE_DATABASE);
        $shipping_costs = $shippingCostStmt->findManyByStoreAId(STORE['id']);


        $shipperStmt = new Shipper(STORE_DATABASE);
        $shippers = $shipperStmt->findManyByStoreId(STORE['id']);

         
        
        if($store){
            view('store/storeSettingPage', ['store' => $store, 'shipping_costs' => $shipping_costs, 'shippers' => $shippers]);
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from get store setting page action ' . $e->getMessage();
    }

?>