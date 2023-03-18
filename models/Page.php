<?php

    class Page extends Connection {

        public $table = 'pages';
        public $name = NULL;
        public $title = NULL;
        public $content = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


        public function updateByStoreIdAndId($store_id, $pageId){
            $stmt = $this->connection->prepare("UPDATE $this->table SET name = :name, title = :title, content = :content, update_at = :update_at WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':update_at', $this->update_at);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $pageId);
            return $stmt->execute();
        }

        public function deleteByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }

        public function findByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findByStoreAndName($store_id, $name){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND name = :name LIMIT 1");
            $stmt->bindParam(':name', $name);
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

        public function insert(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (name, title, content, store_id, create_at) VALUES(:name, :title, :content, :store_id, :create_at)");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }






    }

?>