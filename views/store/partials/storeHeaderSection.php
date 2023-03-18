<?php include_once VIEWS . 'partials/head.php'; ?>

<?php 
    load(MODELS, 'Order');
    
    
    try
    {
        $orderStmt = new Order(STORE_DATABASE);
        $totalPendingOrder = $orderStmt->findTotalOrderByStatusAndStoreId(STORE['id'], 'pending')['total'];
        
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from store header section' . $e->getMessage();
    }

?>