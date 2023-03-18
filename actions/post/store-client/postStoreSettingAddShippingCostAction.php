<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'ShippingCost');

    $shipping_range_title = post('range_title');
    $shipping_cost_amount =(int) post('cost_amount');

 

    if( !  $shipping_range_title ){
        return redirect('store/setting?error=You do not provide shipping range or shipping cost.');
    }



    try
    {   
        $shippingCostStmt = new ShippingCost(STORE_DATABASE);
        $ifHave = $shippingCostStmt->findByShippingCostTitleAndStoreId($shipping_range_title, STORE['id']);

        if($ifHave){
            return redirect('store/setting?error=This Range Title is already have.Add another');
        }

        $shippingCostStmt->title =  $shipping_range_title;
        $shippingCostStmt->cost_amount =  $shipping_cost_amount;
        $shippingCostStmt->store_id =  STORE['id'];
        $shippingCostStmt->create_at =  bdTime();
        $save = $shippingCostStmt->insertShippingCostItem();

        if($save) {
            return redirect('store/setting?success=Added Shipping Cost successfully');
        }
        else {
            return redirect('store/setting?error=Something went wrong try again.');
        }


    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store setting add shipping cost action' . $e->getMessage();
    }




?>