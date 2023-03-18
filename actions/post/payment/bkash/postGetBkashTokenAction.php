<?php
    load(MIDDLEWARE, 'authenticateCustomer');
    load(MODELS, 'PaymentMethod');
    load(SERVICES, "Http");
    
    $bkashDatabaseaPaymentID = post('payment_id');
    
    try
    {
        $paymentMethodStmt = new PaymentMethod(STORE_DATABASE);
        $bkashPayment = $paymentMethodStmt->findByStoreAndId(STORE_ID, $bkashDatabaseaPaymentID);
    }
    catch(\PDOException $e){
        
        echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ])
    }
    
    $url = $bkashPayment['base_url'] . '/checkout/token/grant';
    
    $headers = [
        "Accept" => 'application/json',
        "Content-Type" => "application/json",
        'username' => $bkashPayment['user_name'],
        'password' => $bkashPayment['password']
    ];
    
    $body = [
        'app_key' => $bkashPayment['app_key'];
        'x-app-secrete' => $bkashPayment['app_screte'];
    ];
    
    
    $http = new Http();
    $response = $http->post($url, ['headers' => $headers, 'body' => $body]);


?>