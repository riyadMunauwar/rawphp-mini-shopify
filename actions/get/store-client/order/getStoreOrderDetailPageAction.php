<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Order');
    load(MODELS, 'OrderItem');
    load(MODELS, 'PaymentMethod');
    load(MODELS, 'Customer');
    load(MODELS, 'Product');
    load(MODELS, 'Variation');
    load(MODELS, 'Shipper');

    // Query Param
    $orderID = get('order-id');
    

    if( ! $orderID ) {
        redirect('store/order');
    }


    try
    {
        // Fetch Order Row
        $orderStmt = new Order(STORE_DATABASE);
        $order = $orderStmt->findById($orderID);

        // Fetch Payment Method Row
        $paymentMethodStmt = new PaymentMethod(STORE_DATABASE);
        $paymentMethod =  $paymentMethodStmt->findById($order['payment_method_id']);

        // Push payment method name to order row
        if($paymentMethod) $order['payment_method'] = $paymentMethod['name'];

        // Fetch Order Items all row
        $orderItemStmt = new OrderItem(STORE_DATABASE);
        $order_items = $orderItemStmt->findManyByOrderId($order['id']);

        $order_items_with_product_detail = [];

        // Fetch Order Items Product Details
        foreach($order_items ?? [] as $order_item){
            $productStmt = new Product(STORE_DATABASE);
            $product = $productStmt->findById($order_item['product_id']);

            if($product) {
                // Fetch All Variant on this product
                $variationStmt = new Variation(STORE_DATABASE);
                $variation = $variationStmt->findAllByProductId($product['id']);

                // Push all variant to product
                if($product) $product['variation'] = $variation;
                
                // Push this product order items
                $order_item['product'] = $product;
                array_push($order_items_with_product_detail, $order_item );
            }
        }

        // Push all order items to order row
        if($order_items) $order['order_items'] = $order_items_with_product_detail;

        // Fetch Customer Data
        $customerStmt = new Customer(STORE_DATABASE);
        $customer = $customerStmt->findCustomerById($order['customer_id']);

        // Push costomer row to order row
        if($customer) $order['customer'] = $customer;

        // fetch Shipper
        $shipperStmt = new Shipper(STORE_DATABASE);
        $shippers = $shipperStmt->findManyByStoreId(STORE_ID);

        if($shippers) $order['shippers'] =  $shippers;
        

        // If all the data fetch successfully then pass tada to order detail view page
        view('store/storeOrderDetailPage', ['order' => $order]);

    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from get store order deail page action' . $e->getMessage();
    }


?>