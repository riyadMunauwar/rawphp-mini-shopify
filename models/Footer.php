<?php

    class Footer extends Connection {

        public $table = 'footers';
        public $title_a = NULL;
        public $content_a = NULL;
        public $title_b = NULL;
        public $content_b = NULL;
        public $title_c = NULL;
        public $content_c = NULL;
        public $title_d = NULL;
        public $content_d = NULL;
        public $bottom_text = NULL;
        public $facebook_link = NULL;
        public $youtube_link = NULL;
        public $instragram_link = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


        public function updateByStoreIdAndId($store_id, $footerId){
       
            $stmt = $this->connection->prepare("UPDATE $this->table SET title_a = :title_a, content_a = :content_a, title_b = :title_b, content_b = :content_b, title_c = :title_c, content_c = :content_c, title_d = :title_d, content_d = :content_d, bottom_text = :bottom_text, facebook_link = :facebook_link, youtube_link = :youtube_link, instragram_link = :instragram_link,  update_at = :update_at WHERE store_id = :store_id AND id = :id");
            
            $stmt->bindParam(':title_a', $this->title_a);
            $stmt->bindParam(':content_a', $this->content_a);
            $stmt->bindParam(':title_b', $this->title_b);
            $stmt->bindParam(':content_b', $this->content_b);
            $stmt->bindParam(':title_c', $this->title_c);
            $stmt->bindParam(':content_c', $this->content_c);
            $stmt->bindParam(':title_d', $this->title_d);
            $stmt->bindParam(':content_d', $this->content_d);
            $stmt->bindParam(':bottom_text', $this->bottom_text);
            $stmt->bindParam(':facebook_link', $this->facebook_link);
            $stmt->bindParam(':youtube_link', $this->youtube_link);
            $stmt->bindParam(':instragram_link', $this->instragram_link);
            $stmt->bindParam(':update_at', $this->update_at);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $footerId);
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