<?php

    class ImageCaurosel extends Connection {

        public $table = 'image_caurosels';
        public $link = NULL;
        public $image = NULL;
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


        public function insertImageCauroselItem(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (link, image, store_id, create_at) VALUES(:link, :image, :store_id, :create_at)");
            $stmt->bindParam(':link', $this->link);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }


        public function findAllImageCauroselItemByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
        }


        public function deleteByStoreAndId($store_id, $caurosel_id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $caurosel_id);
            return $stmt->execute();
        }



    }

?>