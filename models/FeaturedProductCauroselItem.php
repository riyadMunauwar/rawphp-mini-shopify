<?php

    class FeaturedProductCauroselItem extends Connection {

        public $table = 'featured_product_caurosel_items';
        public $product_id = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


 
  
        public function findManyByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function insertFeaturedProductCauroselItem(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (product_id, store_id, create_at) VALUES(:product_id, :store_id, :create_at)");
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }


        public function findAllProductCauroselItemByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteByStoreAndProductId($store_id, $product_id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND product_id = :product_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':product_id', $product_id);
            return $stmt->execute();
        }

    }

?>