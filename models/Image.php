<?php

class Image extends Connection {

                private $table = 'images';
                private $name = NULL;
                private $src = NUll;
                private $store_id = NULL;
                private $update_at = NULL;
                private $create_at = NULL;



                public function __construct($db_config){
                    if($db_config){
                        parent::__construct($db_config);
                    }else {
                        $this->conn = $connection;
                    }  
                }

                public function findByStoreAndId($store_id, $image_id){
                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :id");
                    $stmt->bindParam(':store_id', $store_id);
                    $stmt->bindParam(':id', $image_id);
                    $stmt->execute();
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }

                public function deleteByStoreAndId($store_id, $image_id){
                    $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
                    $stmt->bindParam(':store_id', $store_id);
                    $stmt->bindParam(':id', $image_id);
                    return $stmt->execute();
                    
                }


                


                public function countTotalImageByStoreId($store_id){
                    $stmt = $this->connection->prepare("SELECT COUNT(id) as total FROM $this->table WHERE store_id = :store_id");
                    $stmt->bindParam(':store_id', $store_id);
                    $stmt->execute();

                    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                }


                
                public function paginateImagesByStoreId($store_id, $offset, $per_page){

                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id ORDER BY id DESC LIMIT $offset, $per_page");
                    $stmt->bindParam(':store_id', $store_id);
                    $stmt->execute();
    
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                }


                public function insert($store_id, $name, $src, $create){
                    $stmt = $this->connection->prepare("INSERT INTO $this->table (name, src, store_id, create_at) VALUES(:name, :src, :store_id, :create_at)");
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':src', $src);
                    $stmt->bindParam(':store_id', $store_id);
                    $stmt->bindParam(':create_at', $create);
                     return  $stmt->execute();
                }



}


?>