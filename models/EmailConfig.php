<?php

    class EmailConfig extends Connection {

        private $table = 'email_configs';
        public $mailer = NULL;
        public $host = NULL;
        public $port = NULL;
        public $username = NULL;
        public $password = NULL;
        public $encryption = NULL;
        public $from_address = NULL;
        public $from_address_name = NULL;
        public $store_id = NULL;
        public $update_at = NULL;
        public $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


 
        public function findByStoreAndId($store_id, $id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND id = :id");
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


        public function insertByStoreId(){
            $stmt = $this->connection->prepare("INSERT INTO $this->table (mailer, host, port, username, password, encryption, from_address, from_address_name, store_id, create_at) VALUES(:mailer, :host, :port, :username, :password, :encryption, :from_address, :from_address_name, :store_id, :create_at)");
            $stmt->bindParam(':mailer', $this->mailer);
            $stmt->bindParam(':host', $this->host);
            $stmt->bindParam(':port', $this->port);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':encryption', $this->encryption);
            $stmt->bindParam(':from_address', $this->from_address);
            $stmt->bindParam(':from_address_name', $this->from_address_name);
            $stmt->bindParam(':store_id', $this->store_id);
            $stmt->bindParam(':create_at', $this->create_at);
            return $stmt->execute();
        }


        public function deleteByStoreAndId($store_id, $emain_config_id){
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE store_id = :store_id AND id = :email_config_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':email_config_id', $emain_config_id);
            return $stmt->execute();
        }


    }

?>