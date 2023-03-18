<?php


class StoreConnection extends Connection {

    private $table = 'store_connections';
    public $domain;
    public $db;
    public $db_name;
    public $db_host;
    public $db_user;
    public $db_password;
    public $store_id;


    public function __construct($DB_CONFIG){

        if($DB_CONFIG){
            parent::__construct($DB_CONFIG);
        }

    }



    public function create(){

        // if($this->domain && $this->db && $this->db_host && $this->db_name && $this->db_user && $this->db_password){
           
            echo 'inside create';
           
            $stmt = $this->connection->prepare("INSERT INTO $this->table VALUES(DEFAULT, :domain, :db, :db_host, :db_name, :db_user, :db_password, :store_id)");
            $stmt->bindParam(':domain', $this->domain);
            $stmt->bindParam(':db', $this->db);
            $stmt->bindParam(':db_host', $this->db_host);
            $stmt->bindParam(':db_name', $this->db_name);
            $stmt->bindParam(':db_user', $this->db_user);
            $stmt->bindParam(':db_password', $this->db_password);
            $stmt->bindParam(':store_id', $this->store_id);

            return $stmt->execute();
        // }
    }


    public function getAllStoreConnection(){
        $stmt = $this->connection->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function findById($id){
        $stmt = $this->connection->prepare('SELECT * FROM connection WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function findByDomain($domain){
        $stmt = $this->connection->prepare('SELECT * FROM store_connections WHERE domain = :domain LIMIT 1');
        $stmt->bindParam(':domain', $domain);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




}


?>