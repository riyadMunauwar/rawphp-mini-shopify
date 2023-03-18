<?php

class OrderItem extends Connection {

                private $table = 'order_items';
                private $price = NULL;
                private $product_id = NULL;
                private $size = NULL;
                private $color = NULL;
                private $weight = NULL;
                private $order_id = NULL;
                private $update_at = NULL;
                private $create_at = NULL;



                public function __construct($db_config){
                    if($db_config){
                        parent::__construct($db_config);
                    }else {
                        $this->conn = $connection;
                    }  
                }


                
                public function findManyByOrderId($order_id){

                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE order_id = :order_id");
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->execute();
    
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                }

                public function findOrderByStoreAndProductId($store_id, $product_id){
                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND product_id = :product_id");
                    $stmt->bindParam(':store_id', $store_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->execute();
                    return $stmt->fetch(PDO::FETCH_ASSOC);
        
                }


                public function findTopOrderPrudctByStoreId($store_id, $limit = 10){
                    $stmt = $this->connection->prepare("SELECT product_id, COUNT(product_id) as total_order FROM order_items WHERE store_id = :store_id GROUP BY product_id ORDER BY total_order DESC LIMIT $limit");
                    $stmt->bindParam(':store_id', $store_id);
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }



}


?>