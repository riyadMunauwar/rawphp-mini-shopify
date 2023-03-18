<?php

  include_once CONFIG . "app.php";


  class Connection {

    // DB Params
    private $database;
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $connection;


    // Constructor
    public function __construct($DB_CONFIG){

        if($DB_CONFIG) {
            $this->database = $DB_CONFIG['DB'];
            $this->host = $DB_CONFIG['DB_HOST'];
            $this->db_name = $DB_CONFIG['DB_NAME'];
            $this->username = $DB_CONFIG['DB_USER'];
            $this->password = $DB_CONFIG['DB_PASSWORD'];
        }

      $this->connect();
    }

    
    // DB Connect
    public function connect() {
      $this->connection = null;

      try { 
        $this->connection = new PDO( $this->database . ':host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->connection;
    }
    
  }


?>