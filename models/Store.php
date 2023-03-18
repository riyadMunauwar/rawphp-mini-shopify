<?php


class Store extends Connection {

    private $table = 'stores';
    public $name;
    public $email;
    public $password;
    public $description;
    public $logo;
    public $settings_id;










    public function __construct($db_config){
        parent::__construct($db_config);
    }



    public function create(){
        
        if( $this->email && $this->password ){
            $stmt = $this->connection->prepare("INSERT INTO  $this->table (email, password) VALUES(:email, :password); SELECT LAST_INSERT_ID()");
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
           
           return $stmt->execute();
     
        }

    }



    function lastInsertId(){
        $stmt = $this->connection->prepare("SELECT MAX(id) as id FROM $this->table");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }








    public function getAllStore(){
        $stmt = $this->connection->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }










    function findStoreById($id){
        
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }










    public function findStoreByEmailPasswordAndStoreId($email, $password, $store_id){

        if ( !( $email && $password && $store_id ) ) return;


        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE email = :email AND password = :password AND id = :store_id LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();

        return  $stmt->fetch(PDO::FETCH_ASSOC);

    }



    public function findByEmail($email){

        if( ! $email ) return;

        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    public function findStoreFaviconIconByStoreId($store_id){
        $stmt = $this->connection->prepare("SELECT favicon FROM $this->table WHERE id = :store_id");
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function findStoreLogoByStoreId($store_id){
        $stmt = $this->connection->prepare("SELECT logo FROM $this->table WHERE id = :store_id");
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findStoreNameByStoreId($store_id){
        $stmt = $this->connection->prepare("SELECT name FROM $this->table WHERE id = :store_id");
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findStorTitleByStoreId($store_id){
        $stmt = $this->connection->prepare("SELECT title FROM $this->table WHERE id = :store_id");
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }





    public function updateStoreNameByStoreId($value, $store_id){
        $stmt = $this->connection->prepare("UPDATE $this->table SET name = :name WHERE id = :store_id");
        $stmt->bindParam(':name', $value);
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();
    }


    public function updateStoreEmailByStoreId($value, $store_id){
        $stmt = $this->connection->prepare("UPDATE $this->table SET email = :email WHERE id = :store_id");
        $stmt->bindParam(':email', $value);
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();
    }

    public function updateStoreLogoByStoreId($value, $store_id){
        $stmt = $this->connection->prepare("UPDATE $this->table SET logo = :logo WHERE id = :store_id");
        $stmt->bindParam(':logo', $value);
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();
    }

    public function updateStorePasswordByStoreId($value, $store_id){
        $stmt = $this->connection->prepare("UPDATE $this->table SET password = :password WHERE id = :store_id");
        $stmt->bindParam(':password', $value);
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();
    }

    public function updateStoreFaviconByStoreId($value, $store_id){
        $stmt = $this->connection->prepare("UPDATE $this->table SET favicon = :favicon WHERE id = :store_id");
        $stmt->bindParam(':favicon', $value);
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();
    }

    public function updateStoreTitleByStoreId($value, $store_id){
        $stmt = $this->connection->prepare("UPDATE $this->table SET title = :title WHERE id = :store_id");
        $stmt->bindParam(':title', $value);
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();
    }
    
    public function updateStoreDescriptionByStoreId($value, $store_id){
        $stmt = $this->connection->prepare("UPDATE $this->table SET description = :description WHERE id = :store_id");
        $stmt->bindParam(':description', $value);
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();
    }


    public function toggleTrueOrFalseByStoreId($column_name, $store_id){
        
        $stmt = $this->connection->prepare("UPDATE $this->table SET $column_name = NOT $column_name WHERE id = :store_id");
        $stmt->bindParam(':store_id', $store_id);
        return $stmt->execute();


    }


    public function findColumnValueByStoreId($column_name, $store_id){
        $stmt = $this->connection->prepare("SELECT $column_name FROM $this->table WHERE id = :store_id");
        $stmt->bindParam(':store_id', $store_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)[$column_name];
    }



}

?>