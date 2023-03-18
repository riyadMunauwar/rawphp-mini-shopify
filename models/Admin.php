<?php

class Admin extends Connection {

    private $table = 'admins';
    public $domain;
    public $db;
    public $db_host;
    public $db_name;
    public $db_user;
    public $db_password;

    public function __construct($db_config){
        parent::__construct($db_config);
    }


    public function admin(){

        $stmt = $this->connection->prepare('SELECT * FROM admins LIMIT 1');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    public function findAdminByEmailAndPassword($email, $password){

        if ( !( $email && $password ) ) return;


        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE email = :email AND password = :password LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        return  $stmt->fetch(PDO::FETCH_ASSOC);

    }


}






?>