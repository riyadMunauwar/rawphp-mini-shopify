<?php

    class OrderStatus extends Connection {

        private $table = 'order_statuses';
        private $status = NULL;
        private $update_at = NULL;
        private $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }


        public function getAll(){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function findById($id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }




    }

?>