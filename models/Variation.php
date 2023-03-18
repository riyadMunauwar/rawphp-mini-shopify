<?php

class Variation extends Connection {

            private $table = "variations";
            public $photo = NULL;
            public $size = NULL;
            public $weight = NULL;
            public $color = NULL;
            public $color_code = NULL;
            public $stock_quantity = NULL;
            public $product_id = NULL;
            public $update_at;
            public $create_at;

            // By Pass Connection
            private $conn;



            public function __construct($db_config, $connection = null){
                if($db_config){
                    parent::__construct($db_config);
                }else {
                    $this->conn = $connection;
                }   
            }



            public function findAllByProductId($productID){
                
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE product_id = :product_id");
                $stmt->bindParam(":product_id", $productID);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }



            // public function getAll(){

            //     $stmt = $this->connection->prepare("SELECT * FROM $this->table");
            //     $stmt->execute();

            //     return $stmt->fetchAll(PDO::FETCH_ASSOC);

            // }



            // This method is only use when database connection is pass when constructing the this object
            public function insert(){

                $stmt = $this->conn->prepare("INSERT INTO $this->table (photo,  size, weight, color, color_code, stock_quantity, product_id, create_at) VALUES( :photo,  :size, :weight, :color, :color_code, :stock_quantity, :product_id, :create_at )");

                $stmt->bindParam(':photo', $this->photo);
                $stmt->bindParam(':size', $this->size);
                $stmt->bindParam(':weight', $this->weight);
                $stmt->bindParam(':color', $this->color);
                $stmt->bindParam(':color_code', $this->color_code);
                $stmt->bindParam(':stock_quantity', $this->stock_quantity);
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':create_at', $this->create_at);

                return $stmt->execute();
            }

            public function addVariantBiaEdit(){

                $stmt = $this->connection->prepare("INSERT INTO $this->table (photo,  size, weight, color, color_code, stock_quantity, product_id, create_at) VALUES( :photo,  :size, :weight, :color, :color_code, :stock_quantity, :product_id, :create_at )");

                $stmt->bindParam(':photo', $this->photo);
                $stmt->bindParam(':size', $this->size);
                $stmt->bindParam(':weight', $this->weight);
                $stmt->bindParam(':color', $this->color);
                $stmt->bindParam(':color_code', $this->color_code);
                $stmt->bindParam(':stock_quantity', $this->stock_quantity);
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':create_at', $this->create_at);

                return $stmt->execute();
            }



            public function updateComunByProductAndVariantId($column, $value, $product_id, $variant_id){
                $stmt = $this->connection->prepare("UPDATE $this->table SET $column = :value WHERE $product_id = :product_id AND id = :variant_id");
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':variant_id', $variant_id);
                $stmt->bindParam(':value', $value);
                return $stmt->execute();
            }


            public function findByVariantIdAndProductId($variant_name, $value, $product_id){
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE product_id = :product_id AND $variant_name = :variant_value");
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':variant_value', $value);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }


}


?>