<?php

    class Upazila extends Connection {

        private $table = 'upazilas';
        public $name = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


 
        public function findByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findManyByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findByUpazilaByNameAndStoreId($name, $store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND name = :name");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insertByStoreId(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (name, logo, store_id, create_at) VALUES(:name, :store_id, :create_at)");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }


        public function deleteByStoreAndId($store_id, $upazila_id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :upazila_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':upazila_id', $upazila_id);
            return $stmt->execute();
        }


    }

?>