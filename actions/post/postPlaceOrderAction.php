<?php

    load(MIDDLEWARE, 'authenticateCustomer');
    load(VALIDATION, 'validation');
    load(MODELS, 'Order');
    load(MODELS, 'PaymentMethod');


    $full_name = validation(post('full_name'));
    $mobile_no = validation(post('mobile_no'));
    $house_no = validation(post('house_no'));
    $colony = validation(post('colony'));
    $region = validation(post('region'));
    $city = validation(post('city'));
    $area = validation(post('area'));
    $address = validation(post('adress'));
    $payment_method_id = (int) post('payment_method');
    $orderID = post('order-id');

    // Check If order is realy exists in database or fake
    $order = null;


    try
    {
        if($orderID) {
            // Fetch Order If exist
            $orderStmt = new Order(STORE_DATABASE);
            $exist = $orderStmt->findByStoreAndId(STORE_ID, $orderID);
            $order = $exist;


            // Fetch Payment Method
            $paymentMethodStmt = new PaymentMethod(STORE_DATABASE);
            $payment_methods = $paymentMethodStmt->findManyByStoreAId(STORE_ID);

            if($payment_methods && $order) {
                $order['payment_methods'] = $payment_methods;
            }

        
            if(!$exist) {
                return view('messagePage', ['error' => ' ', 'message' => 'Invlaid Order']);
            }
    
        }
        else
        {
            return view('messagePage', ['error' => ' ', 'message' => 'Invlaid Order']);
        }
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from getPlace Order Page '. $e->getMessage();
        view('messagePage', ['error' => ' ', 'message' => 'Database Connection failed or Internal Database Error']);
        return;
    }




    $data = [
        'full_name' => $full_name,
        'mobile_no' => $mobile_no,
        'house_no' => $house_no,
        'colony' => $colony,
        'region' => $region,
        'city' => $city ,
        'area' => $area,
        'address' => $address,
        'payment_method_id' => (int) $payment_method_id,
    ];




    $errors = [];

    // Validation
    if( ! isBdPhoneNumber($mobile_no) ) $errors[] = "Please enter a valid phone number !";
        
    if( ! $payment_method_id ) $errors[] = "Please select a payment method !";

    if( ! $full_name ) $errors[] = "Full name field is empty !";

    if( ! $region ) $errors[] = "Region name field is empty !";

    if( ! $city ) $errors[] = "City name field is empty !";

    if( ! $address ) $errors[] = "Address field is empty !";


    // Resend to Checkout Page With Error and Old Form Data
    if($errors) { 
        view('checkoutPage', ['order' => $order, 'errors' => $errors, 'formData'=> $data ]);
        return;
    }
        
 

    try
    {
        // update Billing Adress
        $orderStmt = new Order(STORE_DATABASE);
        $orderStmt = $orderStmt->updateBillingAdressAndPaymentMethod($orderID, $data);

        // Fetch Payment method
        $paymentMethodStmt = new PaymentMethod(STORE_DATABASE);
        $paymentMethod = $paymentMethodStmt->findByStoreAndId(STORE_ID, $payment_method_id);
        
        $payment_method_name = strtolower($paymentMethod['name']);

        switch($payment_method_name){

            case 'cash on': {
                // Set order status to pending and show success message
                $order = new Order(STORE_DATABASE);
                $isStatusUpdate =  $order->updateOrderStatusById($orderID, 'pending');
                $isDateUpdate = $order->updateOrderDateById($orderID, bdTime());

               if($isStatusUpdate && $isDateUpdate) {
                //   view('messagePage', ['success' => ' ', 'message' => 'Order Success !']);
                // return redirect('payment/bkash/delevery-charge-via-bkash/start?order_id=' . $orderID);
                return view('orderConfirmPage');
               }
               else{
                    return redirect('checkout');
               }
               
                break;
            }

            case 'bkash': {
                return redirect('payment/bkash/start?order_id=' . $orderID);
                break;
            }

            default: {
                echo $payment_method_name;
                break;
            }

        }
        
        // Before success order
        // Accept Payment Here
        // If payment success
        // set order status and active order
        
        
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from getPlace Order Page '. $e->getMessage();
        return view('messagePage', ['error' => '', 'message' => 'Database Connection failed or Internal Database Error']);
    }



    

    
 









?>