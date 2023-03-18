<?php

class CategoryProduct extends Connection {

            private $table = "category_product";
            public $product_id = NULL;
            public $category_id = NULL;
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




            function findCategoryByProductId($productID){

                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE product_id = :product_id");
                $stmt->bindParam(":product_id", $productID);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }


            function findProductByCategoryId($categoryID){

                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE category_id = :category_id");
                $stmt->bindParam(":category_id", $categoryID);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }


            // return integer how many product have on these category
            public function countProductByCategoryId($category_id){

                $stmt = $this->connection->prepare("SELECT COUNT(product_id) as total FROM $this->table WHERE category_id = :category_id");
                $stmt->bindParam(':category_id',$category_id);
                $stmt->execute();

                return  (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            }


            // This method is only use when database connection is pass when constructing the this object
            public function insert(){

                $stmt = $this->conn->prepare("INSERT INTO $this->table (product_id, category_id) VALUES(:product_id, :category_id)");

                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':category_id', $this->category_id);
      
                return $stmt->execute();
            }


            public function updateCategoryIdByProductId($product_id, $old_category_id, $new_category_id){
                $stmt = $this->connection->prepare("UPDATE $this->table SET category_id = :new_category_id WHERE product_id = :product_id AND category_id = :old_category_id");
                $stmt->bindParam(':new_category_id', $new_category_id);
                $stmt->bindParam(':old_category_id', $old_category_id);
                $stmt->bindParam(':product_id', $product_id);
                return $stmt->execute();
            }





}


?>