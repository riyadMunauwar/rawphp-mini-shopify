<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Order');



    try
    {
        $orderStmt = new Order(STORE_DATABASE);

        $totalSales = $orderStmt->findTotalSalesByStore(STORE['id']);
        $totalSalesThisMonth = $orderStmt->findThisMonthTotalSalesByStore(STORE['id']);

        $totalOrder = $orderStmt->findTotalOrderByStore(STORE['id']);
        $totalOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStore(STORE['id']);

        $uncomplateOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'uncomplate');
        $pendingOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'pending');
        $processingOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'processing');
        $shipedOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'shiped');
        $refundedOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'refunded');
        $cancelOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'canceled');
        $complateOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'complate');


        $uncomplateOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStatusAndStoreId(STORE['id'], 'uncomplate');
        $pendingOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStatusAndStoreId(STORE['id'], 'pending');
        $processingOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStatusAndStoreId(STORE['id'], 'processing');
        $shipedOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStatusAndStoreId(STORE['id'], 'shiped');
        $refundedOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStatusAndStoreId(STORE['id'], 'refunded');
        $cancelOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStatusAndStoreId(STORE['id'], 'canceled');
        $complateOrderThisMonth = $orderStmt->findTotalThisMonthOrderByStatusAndStoreId(STORE['id'], 'complate');



        $detail = [
            'totalSales' => $totalSales['total_sales'],
            'totalSalesThisMonth' => $totalSalesThisMonth['total_sales'],
            'totalOrder' => $totalOrder['total'],
            'totalOrderThisMonth' => $totalOrderThisMonth['total'],
            'uncomplateOrder' => $uncomplateOrder['total'],
            'pendingOrder' => $pendingOrder['total'],
            'processingOrder' => $processingOrder['total'],
            'shipedOrder' => $shipedOrder['total'],
            'refundedOrder' => $refundedOrder['total'],
            'cancelOrder' => $cancelOrder['total'],
            'complateOrder' => $complateOrder['total'],
            'uncomplateOrderThisMonth' => $uncomplateOrderThisMonth['total'],
            'pendingOrderThisMonth' => $pendingOrderThisMonth['total'],
            'processingOrderThisMonth' => $processingOrderThisMonth['total'],
            'shipedOrderThisMonth' => $shipedOrderThisMonth['total'],
            'refundedOrderThisMonth' => $refundedOrderThisMonth['total'],
            'cancelOrderThisMonth' => $cancelOrderThisMonth['total'],
            'complateOrderThisMonth' => $complateOrderThisMonth['total'],
        ];

        // console($detail);

        view('store/storeDashBoardPage', ['report' => $detail]);
       
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from get store dashboard page action' . $e->getMessage(); 
    }
    
    

?>