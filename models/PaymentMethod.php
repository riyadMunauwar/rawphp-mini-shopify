<?php

    class PaymentMethod extends Connection {

        private $table = 'payment_methods';
        private $name = NULL;
        private $update_at = NULL;
        private $create_at = NULL;



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
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
  
        public function findById($id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }



    }

?>