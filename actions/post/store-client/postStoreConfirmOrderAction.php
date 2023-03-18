<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(VALIDATION, 'validation');
    load(MODELS, 'Order');
    load(CORE, 'Connection');
    load(MODELS, 'Shipper');
    

    $shipping_date = validation(post('shipping_date'));
    $shipper_id = validation(post('shipper_id'));
    $order_id = validation(post('order_id'));
    $store_id = STORE['id'];
   

    

   if(! ( $order_id && $shipping_date && $order_id) ) {
    redirect("store/order-detail?order-id=$order_id&error=Shipping Date and Shipping Method Must Include!");
   }

   $order_status = 'processing';

   try
   {
        $orderStmt = new Order(STORE_DATABASE);
        $order = $orderStmt->findById($order_id);
        
        
        if($order['order_status'] === 'pending'){
        }
        else{
            $order_status = $order['order_status'];
        }

        $conn = new Connection(STORE_DATABASE);
        $conn->connection->beginTransaction();

        $shippingStmt = $conn->connection->prepare("SELECT * FROM shippers WHERE id = :id");
        $shippingStmt->bindParam(':id', $shipper_id);
        $shippingStmt->execute();

        $shipper = $shippingStmt->fetch(PDO::FETCH_ASSOC);


        if($order['order_status'] === 'pending'){


        // Fetch All Order Items 
        $orderItemStmt = $conn->connection->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $orderItemStmt->bindParam(':order_id', $order_id);
        $orderItemStmt->execute();

        $order_items = $orderItemStmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($order_items ?? [] as $order_item){
       

            if($order_item['size']){




                $variantStmt = $conn->connection->prepare("SELECT stock_quantity FROM variations WHERE size = :size AND product_id = :product_id");
                $variantStmt->bindParam(':size', $order_item['size']);
                $variantStmt->bindParam(':product_id', $order_item['product_id']);
                $variantStmt->execute();
                $variant = $variantStmt->fetch(PDO::FETCH_ASSOC);




                if($variant['stock_quantity']  < $order_item['quantity']){
                    // throw new Exception('Stock quanity is less then order quanity');
                    return redirect("store/order-detail?order-id=$order_id&error=Stock quanity is less then order quanity !");
                }


                $variantStmt = $conn->connection->prepare("UPDATE variations SET stock_quantity = stock_quantity - :order_quantity WHERE size = :size AND product_id = :product_id");
                $variantStmt->bindParam(':order_quantity', $order_item['quantity']);
                $variantStmt->bindParam(':size', $order_item['size']);
                $variantStmt->bindParam(':product_id', $order_item['product_id']);
                $variantStmt->execute();



            }
           

            if($order_item['color']){


                $variantStmt = $conn->connection->prepare("SELECT stock_quantity FROM variations WHERE color = :color AND product_id = :product_id");
                $variantStmt->bindParam(':color', $order_item['color']);
                $variantStmt->bindParam(':product_id', $order_item['product_id']);
                $variantStmt->execute();
                $variant = $variantStmt->fetch(PDO::FETCH_ASSOC);

                
                if($variant['stock_quantity']  < $order_item['quantity']){
                    // throw new Exception('Stock quanity is less then order quanity');
                    return redirect("store/order-detail?order-id=$order_id&error=Stock quanity is less then order quantity !");
                }


                
                $variantStmt = $conn->connection->prepare("UPDATE variations SET stock_quantity = stock_quantity - :order_quantity WHERE color = :color AND product_id = :product_id");
                $variantStmt->bindParam(':order_quantity', $order_item['quantity']);
                $variantStmt->bindParam(':color', $order_item['color']);
                $variantStmt->bindParam(':product_id', $order_item['product_id']);
                $variantStmt->execute();


            }




            if($order_item['weight']){



                $variantStmt = $conn->connection->prepare("SELECT stock_quantity FROM variations WHERE weight = :weight AND product_id = :product_id");
                $variantStmt->bindParam(':weight', $order_item['weight']);
                $variantStmt->bindParam(':product_id', $order_item['product_id']);
                $variantStmt->execute();
                $variant = $variantStmt->fetch(PDO::FETCH_ASSOC);



                if($variant['stock_quantity']  < $order_item['quantity']){
                    // throw new Exception('Stock quanity is less then order quanity');
                    return redirect("store/order-detail?order-id=$order_id&error=Stock quanity is less then order quantity !");
                }


                $variantStmt = $conn->connection->prepare("UPDATE variations SET stock_quantity = stock_quantity - :order_quantity WHERE weight = :weight AND product_id = :product_id");
                $variantStmt->bindParam(':order_quantity', $order_item['quantity']);
                $variantStmt->bindParam(':weight', $order_item['weight']);
                $variantStmt->bindParam(':product_id', $order_item['product_id']);
                $variantStmt->execute();


            }

            // Fetch product quantity
            $productStmt = $conn->connection->prepare("SELECT stock_quantity FROM products WHERE id = :product_id AND store_id = :store_id");
            $productStmt->bindParam(':product_id', $order_item['product_id']);
            $productStmt->bindParam(':store_id', $store_id);
            $productStmt->execute();
            $product = $productStmt->fetch(PDO::FETCH_ASSOC);

            if($product['stock_quantity'] < $order_item['quantity']){
                return redirect("store/order-detail?order-id=$order_id&error=Stock quanity is less then order quantity !");
            }
           

            // Change the parent product quantity
            $productStmt = $conn->connection->prepare("UPDATE products SET stock_quantity = stock_quantity - :order_quantity WHERE id = :id AND store_id = :store_id");
            $productStmt->bindParam(':id', $order_item['product_id']);
            $productStmt->bindParam(':order_quantity', $order_item['quantity']);
            $productStmt->bindParam(':store_id', $store_id);
            $productStmt->execute();


        }

    }

       

        
        
        $orderStmt = $conn->connection->prepare("UPDATE orders SET order_status = :order_status, shipper_id = :shipper_id, shipping_method = :shipping_method, shipping_date = :shipping_date WHERE id = :id AND store_id = :store_id");

        $orderStmt->bindParam(':order_status', $order_status);
        $orderStmt->bindParam(':shipper_id', $shipper_id);
        $orderStmt->bindParam(':shipping_method', $shipper['name']);
        $orderStmt->bindParam(':shipping_date', $shipping_date);
        $orderStmt->bindParam(':id', $order_id);
        $orderStmt->bindParam(':store_id', $store_id);
        $orderStmt->execute();



        $conn->connection->commit();

        if($order['order_status'] === 'pending') {
            return redirect("store/order-detail?order-id=$order_id&success=Order Confirm successfully");
        }
        else
        {
           return redirect("store/order-detail?order-id=$order_id&success=Order Update successfully");
        }


   }
   catch(\PDOException $e)
   {
        $conn->connection->rollback();
        echo 'this error is coming form confirm order action ' . $e->getMessage();
   }



?>