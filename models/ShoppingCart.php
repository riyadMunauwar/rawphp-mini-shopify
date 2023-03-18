<?php 

class ShoppingCart extends Connection {

                private $table = "shopping_carts";
                public $customer_id = NULL;
                public $product_id = NULL;
                public $quantity = NULL;
                public $size = NULL;
                public $color = NULL;
                public $weight = NULL;
                public $update_at;
                public $create_at;



                public function __construct($db_config){
                    parent::__construct($db_config);
                }



                public function insert(){

                    $stmt = $this->connection->prepare("INSERT INTO $this->table VALUES(DEFAULT, :customer_id, :product_id, :quantity, :size, :color, :weight, :create_at, DEFAULT)");
                    $stmt->bindParam(":customer_id", $this->customer_id);
                    $stmt->bindParam(":product_id", $this->product_id);
                    $stmt->bindParam(":quantity", $this->quantity);
                    $stmt->bindParam(":size", $this->size);
                    $stmt->bindParam(":color", $this->color);
                    $stmt->bindParam(":weight", $this->weight);
                    $stmt->bindParam(":create_at", $this->create_at);
                    return $stmt->execute();

                }




                public function findManyByCustomerId($customer_id){
                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE customer_id = :customer_id");
                    $stmt->bindParam(":customer_id", $customer_id);
                    $isExecute = $stmt->execute();

                    if($isExecute) return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }


                public function countCartItemByCustomerId($customer_id){
                    $stmt = $this->connection->prepare("SELECT COUNT(customer_id) AS total FROM $this->table  WHERE customer_id = :customer_id");
                    $stmt->bindParam(':customer_id', $customer_id);
                    $stmt->execute();
                    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                }


                public function deleteById($id){
                    $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id = :id");
                    $stmt->bindParam(':id', $id);

                    return $stmt->execute();
                }

                public function findById($id){
                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
                    $stmt->bindParam(':id', $id);

                    $stmt->execute();

                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }

                public function findByCustomerAndProductId($product_id, $customer_id){
                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE customer_id = :customer_id AND product_id = :product_id");
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':customer_id', $customer_id);

                    $stmt->execute();
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }

                public function findManyByCustomerAndProductId($product_id, $customer_id){
                    $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE customer_id = :customer_id AND product_id = :product_id");
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':customer_id', $customer_id);

                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                // Params -> cart-id, and quantity
                // return true if update either false
                public function updateQuantity($cart_id, $quantity){
                    $stmt = $this->connection->prepare("UPDATE $this->table SET quantity = :quantity WHERE id = :id");
                    $stmt->bindParam(':quantity', $quantity);
                    $stmt->bindParam(':id', $cart_id);
                    return $stmt->execute();
                }



    }


?>