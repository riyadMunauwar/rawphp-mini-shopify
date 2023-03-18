<?php 

class Product extends Connection {

            private $table = "products";
            public $slug = NULL;
            public $name = NULL;
            public $unit_price = NULL;
            public $purchase_price = NULL;
            public $discount = NULL;
            public $stock_quantity = NULL;
            public $short_description = NULL;
            public $description = NULL;
            public $thumbnail = NULL;
            public $video_url = NULL;
            public $store_id = NULL;
            public $brand_id = NULL;
            public $update_at;
            public $create_at;



            public function __construct($db_config){

                parent::__construct($db_config);

            }


            function insert(){
                $stmt = $this->connection->prepare("INSERT INTO $this->table VALUES(DEFAULT, :slug, :name, :unit_price, :thumbnail, :purchase_price, :discount, :stock_quantity, :short_description, :description, :thumbnail, :video_url,  :store_id, :brand_id, :create_a, NULL)");
                $stmt->bindParam(":slug", $this->slug);
                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":unit_price", $this->unit_price);
                $stmt->bindParam(":purchase_price", $this->purchase_price);
                $stmt->bindParam(":discount", $this->discount);
                $stmt->bindParam(":stock_quantity", $this->stock_quantity);
                $stmt->bindParam(":short_description", $this->short_description);
                $stmt->bindParam(":description", $this->description);
                $stmt->bindParam(":thumbnail", $this->thumbnail);
                $stmt->bindParam(":video_url", $this->video_url);
                $stmt->bindParam(":store_id", $this->store_id);
                $stmt->bindParam(":brand_id", $this->brand_id);
                $stmt->bindParam(":create_at", $this->create_at);

                if($stmt->execute()){
                    return $this->connection->lastInsertId();
                }
            }


            function findProductByBrandId($brand_id){
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE brand_id = :brand_id");
                $stmt->bindParam(":brand_id", $brand_id);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }

            public function deleteByStoreAndId($store_id, $id){
                $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :id");
                $stmt->bindParam(':store_id', $store_id);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            }

            function findById($id){

                if( ! $id ) return;

                $stmt = $this->connection->prepare("SELECT * FROM $this->table  WHERE id = :id LIMIT 1");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
                
            }

            function findByStoreAndId($store_id, $id){

                if( ! $id ) return;

                $stmt = $this->connection->prepare("SELECT * FROM $this->table  WHERE id = :id AND store_id = :store_id LIMIT 1");
                $stmt->bindParam(':id', $id);
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




            // Return int total number of product 
            public function countTotalProductByBrandId($brand_id){
                $stmt = $this->connection->prepare("SELECT COUNT(name) as total FROM $this->table WHERE brand_id = :brand_id");
                $stmt->bindParam(':brand_id', $brand_id);
                $stmt->execute();
                return (int) $stmt->fetch()['total'];
            }
            
             // Return int total number of product 
            public function countTotalProductByStoreId($store_id){
                $stmt = $this->connection->prepare("SELECT COUNT(name) as total FROM $this->table WHERE store_id = :store_id");
                $stmt->bindParam(':store_id', $store_id);
                $stmt->execute();
                return (int) $stmt->fetch()['total'];
            }


            // Paginate By Brand
            public function paginateByBrand($brand_id, $offset, $per_page){

                if(!($brand_id && $per_page)) return false;
                
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE brand_id = :brand_id ORDER BY id DESC LIMIT $offset, $per_page");

                $stmt->bindParam(':brand_id', $brand_id);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }
            
            // paginateByStore 
            public function paginateByStore($store_id, $offset, $per_page){
                
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id ORDER BY id DESC LIMIT $offset, $per_page");

                $stmt->bindParam(':store_id', $store_id);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }
            
            


            public function searchingProductByNameAndStoreId($name, $store_id){
                $stmt = $this->connection->prepare("SELECT id, name, unit_price, thumbnail FROM $this->table WHERE store_id = :store_id AND name REGEXP :name OR id = :product_id");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':product_id', $name);
                $stmt->bindParam(':store_id', $store_id);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }


            public function findRecentProductByStoreId($store_id, $limit = 10){
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id ORDER BY id DESC LIMIT $limit");
                $stmt->bindParam(':store_id', $store_id);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }


            public function findByStoreAndBrandIdWithLimit($store_id, $brand_id, $limit){
                $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND brand_id = :brand_id ORDER BY id DESC LIMIT $limit");
                $stmt->bindParam(':store_id', $store_id);
                $stmt->bindParam(':brand_id', $brand_id);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            public function updateColumnValueByStoreAndProductId($column, $value, $store_id, $product_id){
                $stmt = $this->connection->prepare("UPDATE $this->table SET $column = :value WHERE store_id = :store_id AND id = :product_id");
                $stmt->bindParam(':value', $value);
                $stmt->bindParam(':store_id', $store_id);
                $stmt->bindParam(':product_id', $product_id);
                return $stmt->execute();
            }

}


?>