<?php


class Brand extends Connection {

        private $table = "brands";
        public $name = NULL;
        public $slug = NULL;
        public $thumbnail = NULL;
        public $description = NULL;
        public $store_id = NULL;
        public $update_at;
        public $create_at;



        public function __construct($db_config){
            parent::__construct($db_config);
        }



        public function updateByStoreIdAndId($store_id, $brandId){
            $stmt = $this->connection->prepare("UPDATE $this->table SET name = :name, slug = :slug, thumbnail = :thumbnail, description = :description, update_at = :update_at WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':slug', $this->slug);
            $stmt->bindParam(':thumbnail', $this->thumbnail);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':update_at', $this->update_at);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $brandId);
            return $stmt->execute();
        }

        function findByStoreAndId($store_id, $id){

            if( ! $id ) return;

            $stmt = $this->connection->prepare("SELECT * FROM $this->table  WHERE id = :id AND store_id = :store_id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        }

        public function deleteByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }


        public function insert(){

            if(!$this->name) return;
            if(!$this->store_id) return;
        

            $stmt = $this->connection->prepare("INSERT INTO $this->table VALUES(DEFAULT, :name, :slug, :thumbnail, :description, :store_id, DEFAULT, DEFAULT)");
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":slug", $this->slug);
            $stmt->bindParam(":thumbnail", $this->thumbnail);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":store_id", $this->store_id);
            return $stmt->execute();


        }



        public function findManyByStoreId($store_id){

            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }


        public function findById($id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $isExecute = $stmt->execute();

            if($isExecute) return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findByStoreAndName($store_id, $name){

            if(!$name) return;

            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND name = :name LIMIT 1");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":store_id", $store_id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        }




}


?>