<?php


class Category extends Connection {

        private $table = "categories";
        public $name = NULL;
        public $slug = NULL;
        public $thumbnail = NULL;
        public $description = NULL;
        public $parent_id = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at;



        public function __construct($db_config){
            parent::__construct($db_config);
        }

        public function updateByStoreAndId($id){
            $stmt = $this->connection->prepare("UPDATE $this->table SET name = :name, slug = :slug, parent_id = :parent_id, thumbnail = :thumbnail, description = :description, update_at = :update_at WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':slug', $this->slug);
            $stmt->bindParam(':thumbnail', $this->thumbnail);
            $stmt->bindParam(':parent_id', $this->parent_id);
            $stmt->bindParam(':update_at', $this->update_at);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }

        public function deleteByStoreAndCategoryid($store_id, $category_id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $category_id);
            return $stmt->execute();
        }

        public function findChildCategoryByCategoryId($id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE parent_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findChildCategoryByStoreAndCategoryId($store_id, $id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND parent_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":store_id", $store_id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findById( $id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }




        public function findManyByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(":store_id", $store_id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        
        public function findAllParentCategoryByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND ( parent_id IS NULL OR parent_id = 0 )");
            $stmt->bindParam(":store_id", $store_id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }




        public function insert(){

            if(!$this->name) return;
            if(!$this->store_id) return;
        

            $stmt = $this->connection->prepare("INSERT INTO $this->table VALUES(DEFAULT, :name, :slug, :thumbnail, :description, :parent_id, :store_id, DEFAULT, DEFAULT)");
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":slug", $this->slug);
            $stmt->bindParam(":thumbnail", $this->thumbnail);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":parent_id", $this->parent_id);
            $stmt->bindParam(":store_id", $this->store_id);
            return $stmt->execute();


        }


        public function findByStorIdAndName($store_id, $name){

    

            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND name = :name LIMIT 1");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":store_id", $store_id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        }




}


?>