<?php
    load(MIDDLEWARE, 'authenticateCustomer');
    load(MODELS, 'Order');
    load(SERVICES, "Http");
    
    $order_id = post('order_id');
    $databaseBkashPaymentMethodId = post('database_table_id_bkash');
    $paymentID = post('payment_id');
    
    try
    {
        $paymentMethodStmt = new PaymentMethod(STORE_DATABASE);
        $bkashPayment = $paymentMethodStmt->findByStoreAndId(STORE_ID, $databaseBkashPaymentMethodId);
        
        $orderStmt = new Order(STORE_DATABASE);
        $order = $orderStmt->findByStoreAndId(STORE_ID, $order_id);
    }
    catch(\PDOException $e){
        
        echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ])
    }
    
    $url = $databaseBkashPaymentMethodId['base_url'] . '/checkout/payment/execute/' . $paymentID;
    $token = ''; // it will come via http request or  this app session
    
    $headers = [
        "Accept" => 'application/json',
        "Content-Type" => "application/json",
        "authorization" => $token,
        "x-app-key" => $bkashPayment['app_key'],
    ];
    
   
    
    
    $http = new Http();
    $response = $http->post($url, ['headers' => $headers]);


?>