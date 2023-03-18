<?php 

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Order');
    load(MODELS, 'OrderStatus');

    // Query Params

    $status = get('status');
    $page_no = get('page');

    // Default Parmas Value
    if(!$status) {
        $status = 'pending';
    }

    if(!$page_no){
        $page_no = 1;
    }
   

    $total_order = 0;
    $order_per_page = 20;


    try
    {
        $orderStmt = new Order(STORE_DATABASE);
        $totalOrder = null;
        if($status === 'all'){
            $totalOrder = $orderStmt->countTotalByAllOrderOfStore(STORE['id']);
        }else if($status === 'new'){
            $totalOrder = $orderStmt->countTotalProductByStoreIdAndOrderStatus(STORE['id'], 'pending');
        }else{
            $totalOrder = $orderStmt->countTotalProductByStoreIdAndOrderStatus(STORE['id'], $status);
        }

        if($totalOrder) $total_order = $totalOrder;
    }
    catch(\PDOException $e)
    {
        // Error Handeling
        echo 'this error is coming from order page action' . $e->getMessage();
    }


    $total_page = ceil($total_order / $order_per_page);
    $offset = ( $page_no - 1 ) * $order_per_page;

    

    // if($page_no < 0 || $page_no > $total_page) {
    //     redirect('');
    // }

    $pagination = [
        'total_page' => $total_page,
        'current_page' => $page_no,
        'status' => $status 
    ];




    if($status === 'all'){
        // fetch All Order of the store
        try 
        {
            $order = new Order(STORE_DATABASE);
            $allOrder = $order->paginateAllOrderOfStore(STORE['id'], $offset, $order_per_page);
            
            $totalOrder = $orderStmt->findTotalOrderByStore(STORE['id'])['total'];
            $newOrder =  $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'pending')['total'];
        
            $countOrder = [
              'totalOrder' => $totalOrder,
              'newOrder' => $newOrder
            ];
    
            // Fetch Order Status
            $orderStatusStmt = new OrderStatus(STORE_DATABASE);
            $orderStatuses = $orderStatusStmt->getAll();
    
            if($allOrder || $orderStatuses) {
                view('store/storeOrderPage', ['orders' => $allOrder, 'order_statuses' => $orderStatuses, 'pagination' => $pagination, 'countOrder' => $countOrder]);
                return;
            }
    
        }
        catch(\PDOException $e)
        {
            echo "this error is coming from order page action" . $e->getMessage();
        }

    }


    if($status === 'new'){
        // fetch All Order of the store
        try 
        {
            $order = new Order(STORE_DATABASE);
            $allOrder = $order->paginateAllNewOrderOfStore(STORE_ID, $offset, $order_per_page);
            
            $totalOrder = $orderStmt->findTotalOrderByStore(STORE['id'])['total'];
            $newOrder =  $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'pending')['total'];
        
            $countOrder = [
              'totalOrder' => $totalOrder,
              'newOrder' => $newOrder
            ];

    
            // Fetch Order Status
            $orderStatusStmt = new OrderStatus(STORE_DATABASE);
            $orderStatuses = $orderStatusStmt->getAll();
    
            if($allOrder || $orderStatuses) {
                view('store/storeOrderPage', ['orders' => $allOrder, 'order_statuses' => $orderStatuses, 'pagination' => $pagination, 'orderCount' => $countOrder]);
                return;
            }
        }
        catch(\PDOException $e)
        {
            echo "this error is coming from order page action" . $e->getMessage();
        }
    }


    try
    {
        $order = new Order(STORE_DATABASE);
        $allOrder = $order->paginateByOrderStatusAndStoreId(STORE_ID, $status, $offset, $order_per_page);
        
        $totalOrder = $orderStmt->findTotalOrderByStore(STORE['id'])['total'];
        $newOrder =  $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'pending')['total'];
        
        $countOrder = [
          'totalOrder' => $totalOrder,
          'newOrder' => $newOrder
        ];

        // Fetch Order Status
        $orderStatusStmt = new OrderStatus(STORE_DATABASE);
        $orderStatuses = $orderStatusStmt->getAll();
    
        if($allOrder || $orderStatuses) {
            view('store/storeOrderPage', ['orders' => $allOrder, 'order_statuses' => $orderStatuses, 'pagination' => $pagination, 'countOrder' => $countOrder]);
        }

    }
    catch(\PDOException $e)
    {
        echo 'This Error is coming from order page action page ' . $e->getMessage();
    }

    view('store/storeOrderPage');



?>