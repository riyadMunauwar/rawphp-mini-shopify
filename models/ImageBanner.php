<?php

    class ImageBanner extends Connection {

        public $table = 'image_banners';
        public $banner_link = NULL;
        public $image = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }




        public function insertBannerImage(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (banner_link, image, store_id, create_at) VALUES(:banner_link, :image, :store_id, :create_at)");
            $stmt->bindParam(':banner_link', $this->banner_link);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }


        public function findByStoreAndId($store_id, $banner_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :banner_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':banner_id', $banner_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function findByStoreId($store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }



        public function deleteByStoreAndId($store_id, $banner_id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $banner_id);
            return $stmt->execute();
        }



    }

?>