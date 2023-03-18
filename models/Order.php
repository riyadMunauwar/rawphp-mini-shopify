<?php

    class Order extends Connection {

        private $table = 'orders';
        private $full_name = NULL;
        private $mobile_no = NULL;
        private $house_no = NULL;
        private $colony = NULL;
        private $region = NULL;
        private $city = NULL;
        private $area = NULL;
        private $adress = NULL;
        private $total_price = NULL;
        private $discount_price = NULL;
        private $received_amount = NULL;
        private $due_amount = NULL;
        private $shipping_cost = NULL;
        private $order_status_id = NULL;
        private $payment_method_id = NULL;
        private $customer_id = NULL;
        private $store_id = NULL;
        private $shipper_id = NULL;
        private $order_date = NULL;
        private $shipping_date = NULL;
        private $active = NULL;
        private $update_at = NULL;
        private $create_at = NULL;



        public function __construct($db_config){
            parent::__construct($db_config);
        }

        public function findUncomplateOrderByStoreAndCustomerId($customer_id, $store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE customer_id = :customer_id AND store_id = :store_id AND order_status = 'uncomplate' ");
            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function findAllOrderByCustomerAndStoreId($customer_id, $store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE customer_id = :customer_id AND store_id = :store_id");
            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findAllOrderByCustomerAndStoreIdRecentFirst($customer_id, $store_id){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE customer_id = :customer_id AND store_id = :store_id ORDER BY id DESC");
            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
      

        public function findAllByStatusNameAndStoreId($store_id, $status){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND order_status = :order_status");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':order_status', $status);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // FindById
        function findById($id){

            if( ! $id ) return;

            $stmt = $this->connection->prepare("SELECT * FROM $this->table  WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        }

        function findByStoreAndId($store_id, $order_id){

            $stmt = $this->connection->prepare("SELECT * FROM $this->table  WHERE id = :id AND store_id = :store_id");
            $stmt->bindParam(':id', $order_id);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        }

        function findManyByIdOrMobile($store_id, $mobile, $id){

            $stmt = $this->connection->prepare("SELECT * FROM $this->table  WHERE  (mobile_no = :mobile_no OR id = :id ) AND store_id = :store_id");
            $stmt->bindParam(':mobile_no', $mobile);
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }


        // 
        public function getUncompleteOrderByCustomerId($customerID){
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE customer_id = :customer_id AND order_status = 'uncomplate' ");
            $stmt->bindParam(':customer_id', $customerID);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        // Update Order Status
        public function updateOrderStatusById($order_id, $order_status){
            $stmt = $this->connection->prepare("UPDATE $this->table SET order_status = :order_status WHERE id = :id");
            $stmt->bindParam(':order_status', $order_status);
            $stmt->bindParam(':id', $order_id);
            return $stmt->execute();
        }

                // Update Order Status
        public function updateOrderDateById($order_id, $date){
            $stmt = $this->connection->prepare("UPDATE $this->table SET order_date = :order_date WHERE id = :id");
            $stmt->bindParam(':order_date', $date);
            $stmt->bindParam(':id', $order_id);
            return $stmt->execute();
        }



        // create order with active column false
        public function updateBillingAdressAndPaymentMethod($orderID, $billingAddress){

            $stmt = $this->connection->prepare("UPDATE $this->table SET full_name = :full_name, mobile_no = :mobile_no, house_no = :house_no, colony = :colony, region = :region, city = :city, area = :area, address = :address, payment_method_id = :payment_method_id WHERE id = :id");

            $stmt->bindParam(':full_name', $billingAddress['full_name']);
            $stmt->bindParam(':mobile_no', $billingAddress['mobile_no']);
            $stmt->bindParam(':house_no', $billingAddress['house_no']);
            $stmt->bindParam(':colony', $billingAddress['colony']);
            $stmt->bindParam(':region', $billingAddress['region']);
            $stmt->bindParam(':city', $billingAddress['city']);
            $stmt->bindParam(':area', $billingAddress['area']);
            $stmt->bindParam(':address', $billingAddress['address']);
            $stmt->bindParam(':payment_method_id', $billingAddress['payment_method_id']);
            $stmt->bindParam(':id', $orderID);
            $stmt->execute();

            return $stmt->execute();

        }
        

        // Count Total Orders
        public function countTotalProductByStoreIdAndOrderStatus($store_id, $status){
            $stmt = $this->connection->prepare("SELECT COUNT(id) as total FROM $this->table WHERE store_id = :store_id AND order_status = :order_status");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':order_status', $status);
            $stmt->execute();
            return (int) $stmt->fetch()['total'];
        }

        
        public function countTotalByAllOrderOfStore($store_id){
            $stmt = $this->connection->prepare("SELECT COUNT(id) as total FROM $this->table WHERE store_id = :store_id ");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return (int) $stmt->fetch()['total'];
        }



            // Paginate By Brand
        public function paginateByOrderStatusAndStoreId($store_id, $status, $offset, $per_page){
                
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND order_status = :order_status ORDER BY id ASC LIMIT $offset, $per_page");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':order_status', $status);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
        
        
        public function paginateAllOrderOfStore($store_id, $offset, $per_page){

            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id  ORDER BY id DESC LIMIT $offset, $per_page");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function paginateAllNewOrderOfStore($store_id, $offset, $per_page){
            $status = 'pending';
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE store_id = :store_id AND order_status = :order_status ORDER BY id DESC LIMIT $offset, $per_page");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':order_status', $status);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }





        // Report Related Product

        public function findTotalSalesByStore($store_id){
            $stmt = $this->connection->prepare("SELECT SUM(grand_total_price) as total_sales FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function findThisMonthTotalSalesByStore($store_id){
            $stmt = $this->connection->prepare("SELECT SUM(grand_total_price) as total_sales FROM $this->table WHERE MONTH(create_at) = MONTH(NOW()) AND store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function findTotalOrderByStore($store_id){
            $stmt = $this->connection->prepare("SELECT COUNT(id) as total FROM $this->table WHERE store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findTotalThisMonthOrderByStore($store_id){
            $stmt = $this->connection->prepare("SELECT COUNT(id) as total FROM $this->table WHERE MONTH(create_at) = MONTH(NOW()) AND  store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function findTotalOrderByStatusAndStoreId($store_id, $status){
            $stmt = $this->connection->prepare("SELECT COUNT(id) as total FROM $this->table WHERE order_status = :order_status AND store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':order_status', $status);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findTotalThisMonthOrderByStatusAndStoreId($store_id, $status){
            $stmt = $this->connection->prepare("SELECT COUNT(id) as total FROM $this->table WHERE MONTH(create_at) = MONTH(NOW()) AND order_status = :order_status AND store_id = :store_id");
            $stmt->bindParam(':store_id', $store_id);
            $stmt->bindParam(':order_status', $status);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }

?>