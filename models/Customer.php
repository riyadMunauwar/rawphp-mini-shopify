<?php


class Customer extends Connection {

    private $table = 'customers';
    public $name = NULL;
    public $email = NULL;
    public $phone = NULL;
    public $password = NULL;
    public $store_id = NULL;


    public function __construct($db_config){
        parent::__construct($db_config);
    }


    public function findCustomerById($id) {

        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id  LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    public function findCustomerByEmailandStoreId($email, $store_id){

        if( ! $email ) return;

        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE email = :email AND store_id = :store_id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    public function findCustomerByEmailPasswordAndStoreId($email, $password, $store_id){

        if ( !( $email && $password && $store_id ) ) return;


        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE email = :email AND password = :password AND store_id = :store_id LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();

        return  $stmt->fetch(PDO::FETCH_ASSOC);

    }


    public function createCustomer($name, $email, $phone, $password, $store_id){

        $stmt = $this->connection->prepare("INSERT INTO $this->table VALUES(DEFAULT, :name, :email, :phone, :password, :store_id, DEFAULT, DEFAULT )");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':store_id', $store_id);
       return $stmt->execute();

    }
    
    
    public function searchByEmailNamePhoneIdAndStore($store_id, $query){
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND  name = :name OR email = :email OR phone = :phone");
        $stmt->bindParam(':store_id', $store_id);
        $stmt->bindParam(':name', $query);
        $stmt->bindParam(':phone', $query);
        $stmt->bindParam(':email', $query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}


?>