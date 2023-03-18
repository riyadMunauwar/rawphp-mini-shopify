<?php

    class Script extends Connection {

        public $table = 'scripts';
        public $script = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


        public function updateByStoreIdAndId($store_id, $scriptId){
       
            $stmt = $this->connection->prepare("UPDATE $this->table SET script = :script,  update_at = :update_at WHERE store_id = :store_id AND id = :id");
            
            $stmt->bindParam(':script', $this->script);
            $stmt->bindParam(':update_at', $this->update_at);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $scriptId);
            return $stmt->execute();
        }

        public function deleteByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }

        public function findByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id LIMIT 1");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }



        public function insert(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (store_id, create_at) VALUES(:store_id, :create_at)");
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }




    }

?>