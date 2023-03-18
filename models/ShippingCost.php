<?php

    class ShippingCost extends Connection {

        public $table = 'shipping_costs';
        public $title = NULL;
        public $cost_amount = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


        public function findManyByStoreAId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function findByShippingCostTitleAndStoreId($shipping_cost_title, $store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND title = :title");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':title', $shipping_cost_title);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insertShippingCostItem(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (title, cost_amount, store_id, create_at) VALUES(:title, :cost_amount, :store_id, :create_at)");
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':cost_amount', $this->cost_amount);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }

        public function deleteByStoreAndId($store_id, $shipping_cost_id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $shipping_cost_id );
            return  $stmt->execute();
            
        }

    }

?>