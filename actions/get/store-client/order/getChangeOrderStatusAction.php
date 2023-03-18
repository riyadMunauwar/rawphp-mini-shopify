<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(CORE, 'Connection');
    load(MODELS, 'Order');
    load(MODELS, 'Product');
    load(MODELS, 'OrderItem');
    load(MODELS, 'Variation');

    // Query Param

    $status = get('status');
    $orderID = get('order-id');

    if(! ( $status && $orderID ) ) {
        redirect(' ');
    }


    


    try
    {
        $orderStmt = new Order(STORE_DATABASE);
        $order = $orderStmt->findByStoreAndId(STORE['id'], $orderID);
        
        $orderItemStmt = new OrderItem(STORE_DATABASE);
        $orderItems = $orderItemStmt->findManyByOrderId($orderID);





        if($status === 'refunded' || $status === 'canceled'){

            $conn = new Connection(STORE_DATABASE);

            $conn->connection->beginTransaction();

            foreach($orderItems as $item){

               if($item['size']){
      
                    $variantItem = $conn->connection->prepare("SELECT * FROM variations WHERE size = :size AND product_id = :product_id");
                    $variantItem->bindParam(':size', $item['size']);
                    $variantItem->bindParam(':product_id', $item['product_id']);
                    $variantItem->execute();
                    $currentVariant = $variantItem->fetch(PDO::FETCH_ASSOC);
                    
                    if($currentVariant){
                        $updateVariantStmt = $conn->connection->prepare("UPDATE variations SET stock_quantity = stock_quantity + :item_quantity WHERE size = :size AND product_id = :product_id ");
                        $updateVariantStmt->bindParam(':item_quantity', $item['quantity']);
                        $updateVariantStmt->bindParam(':product_id', $item['product_id']);
                        $updateVariantStmt->bindParam(':size', $item['size']);
                        $updateVariantStmt->execute();
                    }

               }

               if($item['color']){

                    $variantItem = $conn->connection->prepare("SELECT * FROM variations WHERE color = :color AND product_id = :product_id");
                    $variantItem->bindParam(':color', $item['color']);
                    $variantItem->bindParam(':product_id', $item['product_id']);
                    $variantItem->execute();
                    $currentVariant = $variantItem->fetch(PDO::FETCH_ASSOC);
                    
                    if($currentVariant){
                        $updateVariantStmt = $conn->connection->prepare("UPDATE variations SET stock_quantity = stock_quantity + :item_quantity WHERE color = :color AND product_id = :product_id");
                        $updateVariantStmt->bindParam(':item_quantity', $item['quantity']);
                        $updateVariantStmt->bindParam(':product_id', $item['product_id']);
                        $updateVariantStmt->bindParam(':color', $item['color']);
                        $updateVariantStmt->execute();
                    }

                }

                if($item['weight']){

                    $variantItem = $conn->connection->prepare("SELECT * FROM variations WHERE weight = :weight AND product_id = :product_id");
                    $variantItem->bindParam(':weight', $item['weight']);
                    $variantItem->bindParam(':product_id', $item['product_id']);
                    $variantItem->execute();
                    $currentVariant = $variantItem->fetch(PDO::FETCH_ASSOC);
                    
                    if($currentVariant){
                        $updateVariantStmt = $conn->connection->prepare("UPDATE variations SET stock_quantity = stock_quantity + :item_quantity WHERE weight = :weight AND product_id = :product_id");
                        $updateVariantStmt->bindParam(':item_quantity', $item['quantity']);
                        $updateVariantStmt->bindParam(':product_id', $item['product_id']);
                        $updateVariantStmt->bindParam(':weight', $item['weight']);
                        $updateVariantStmt->execute();
                    }
                }

                $store_id = STORE['id'];
                $productStmt = $conn->connection->prepare("SELECT * FROM products WHERE store_id = :store_id AND id = :product_id");
                $productStmt->bindParam(':store_id', $store_id);
                $productStmt->bindParam(':product_id', $item['product_id']);
                $productStmt->execute();
                $thisProduct = $productStmt->fetch(PDO::FETCH_ASSOC);
                
                if($thisProduct){
                    $updateVariantStmt = $conn->connection->prepare("UPDATE products SET stock_quantity = stock_quantity + :item_quantity WHERE store_id = :store_id AND id = :product_id");
                    $updateVariantStmt->bindParam(':item_quantity', $item['quantity']);
                    $updateVariantStmt->bindParam(':product_id', $thisProduct['id']);
                    $updateVariantStmt->bindParam(':store_id', $store_id);
                    $updateVariantStmt->execute();
                }
                

            }

            $conn->connection->commit();
        }



        // return;

        $orderStmt = new Order(STORE_DATABASE);
        $ifChange = $orderStmt->updateOrderStatusById($orderID, $status);

        if($ifChange){
            return redirect("store/order-detail?order-id=$orderID&success=Status change successfully");
        }
    }
    catch(\PDOException $e)
    {
        $conn->connection->rollback();
        echo "This error is coming from change order status action" . $e->getMessage();
    }

    







?>