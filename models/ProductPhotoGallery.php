<?php

class ProductPhotoGallery extends Connection {

            private $table = 'product_photo_galleries';
            public $product_id = NULL;
            public $photo_url = NULL;
            public $update_at = NULL;
            public $create_at = NULL;

            // By Pass Connection
            private $conn;


            public function __construct($db_config, $connection = null){
                if($db_config){
                    parent::__construct($db_config);
                }else {
                    $this->conn = $connection;
                }   
            }

            // This method is unly use when Pdo connection is pass externally into $conn varibale
            public function insert(){
                $stmt = $this->conn->prepare("INSERT INTO $this->table (photo_url, product_id, create_at) VALUES(:photo_url, :product_id, :create_at)");
                $stmt->bindParam(':photo_url', $this->photo_url);
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':create_at', $this->create_at);

                return $stmt->execute();
            }
            
            public function findAllByProductId($product_id){
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE product_id = :product_id");
                $stmt->bindParam(":product_id", $product_id);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }



        }
?>