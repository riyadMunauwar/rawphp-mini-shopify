<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Order');
    load(CORE, 'Connection');

    $order_id = post('order_id');
    $next_route = ltrim(post('redirect_route'), BASE_PATH);
    $store_id = STORE['id'];
    

    if(!$order_id) return redirect('store/order');

    try
    {
        $orderStmt = new Order(STORE_DATABASE);
        $found = $orderStmt->findByStoreAndId($store_id, $order_id);

        if($found){
            $conn = new Connection(STORE_DATABASE);

            $conn->connection->beginTransaction();

            $deleteOrderItemStmt = $conn->connection->prepare("DELETE FROM order_items WHERE store_id = :store_id AND order_id = :order_id");
            $deleteOrderItemStmt->bindParam(':store_id', $store_id);
            $deleteOrderItemStmt->bindParam(':order_id', $order_id);
            $deleteOrderItemStmt->execute();
            
            $deleteOrderStmt = $conn->connection->prepare("DELETE FROM orders WHERE store_id = :store_id AND id = :order_id");
            $deleteOrderStmt->bindParam(':store_id', $store_id);
            $deleteOrderStmt->bindParam(':order_id', $order_id);
            $deleteOrderStmt->execute();

            $conn->connection->commit();

            return redirect($next_route);

        }
    }
    catch(\PDOException $e)
    {
        $conn->connection->rollback();
        echo 'This error is coming from post store delete order action' . $e->getMessage();
    }





?>