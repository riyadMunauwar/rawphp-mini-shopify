<?php

    load(MIDDLEWARE, 'authenticateCustomer');
    load(MODELS, 'Order');
    load(MODELS, 'PaymentMethod');


    $customerID = CUSTOMER['id'];
    

    if(!$customerID) {
        view('messagePage', ['error' => ' ', 'message' => 'Invlaid Action']);
    }


    try
    {
        $orderStmt = new Order(STORE_DATABASE);
        $exist = $orderStmt->getUncompleteOrderByCustomerId($customerID);
      
        $paymnetMethodStmt = new PaymentMethod(STORE_DATABASE);
        $paymentMethods = $paymnetMethodStmt->findManyByStoreAId(STORE_ID);
        if($paymentMethods && $exist ){
            $exist['payment_methods'] = $paymentMethods;
        }

        if( $exist ) {

            view('checkoutPage', ['order' => $exist]);
            
        }
        else {
            view('messagePage', ['error' => ' ', 'message' => 'You do not have any uncomplate order !']);
        }
    }
    catch(\PDOException $e)
    {
        // Error Handel Here
        echo 'This error is coming from check page action ' . $e->getMessage();
        view('messagePage', ['error' => ' ', 'message' => 'Database Connection failed or Internal Database Error']);
    }



?>