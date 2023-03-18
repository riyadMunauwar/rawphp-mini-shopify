<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(VALIDATION, 'validation');
    load(MODELS, 'Order');
    load(MODELS, 'OrderStatus');



    // QUERY PARAMS
    $query = get('search-query');

 
    if(! $query ){
        redirect('store/order');
    }


    if(isBdPhoneNumber($query) || is_numeric($query)){

        $orderStmt = new Order(STORE_DATABASE);
        $orders = $orderStmt->findManyByIdOrMobile(STORE_ID, $query, $query);
        
        $totalOrder = $orderStmt->findTotalOrderByStore(STORE['id'])['total'];
        $newOrder =  $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'pending')['total'];
        
        $countOrder = [
          'totalOrder' => $totalOrder,
          'newOrder' => $newOrder
        ];

        // Fetch Order Status
        $orderStatusStmt = new OrderStatus(STORE_DATABASE);
        $orderStatuses = $orderStatusStmt->getAll();
        
        view('store/storeOrderPage', ['orders' => $orders, 'order_statuses' => $orderStatuses, 'countOrder' => $countOrder]);
    }


    // if(is_numeric($query)){
        
    // }


?>


