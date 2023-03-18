<?php 
            // Task Not implement yet is that before creatting any order make sure that this order is already exists or not
            load(MIDDLEWARE, 'authenticateCustomer');
            load(CORE, 'Connection');
            load(MODELS, 'Order');
            // load(MODELS, 'ShoppingCart');

            // QUERY PARAMS
            //   shipping-cost -> sc
            //   grand_discount = gd
            //   grand-total -> gp

            $shipping_cost = post('sc');
            $grand_total = post('gtp');
            $grand_discount = post('gdp');
            $customerID = CUSTOMER['id'] ?? null;
            $storeID = STORE_ID;

            

            if(!$customerID){
                view('messagePage', ['error' => '', 'message' => 'Please Login First']);
                return;
            }

            if( ! ($grand_total  && $customerID ) ){
                view('messagePage', ['error' => '', 'message' => 'Please Visit cart page first and select product then procedd order!']);
                return;
            }



            try
            {
                $orderStmt = new Order(STORE_DATABASE);
                $ifHasOrder = $orderStmt->findUncomplateOrderByStoreAndCustomerId($customerID, $storeID);

                if($ifHasOrder) {
                   
                   $conn = new Connection(STORE_DATABASE);

                   $conn->connection->beginTransaction();

                   $deleteUncomplateOrderItemStmt = $conn->connection->prepare("DELETE FROM order_items WHERE store_id = :store_id AND order_id = :order_id");
                   $deleteUncomplateOrderItemStmt->bindParam(':store_id', $storeID);
                   $deleteUncomplateOrderItemStmt->bindParam(':order_id', $ifHasOrder['id']);
                   $deleteUncomplateOrderItemStmt->execute();

                   $deleteUncomplateOrder = $conn->connection->prepare("DELETE FROM orders WHERE store_id = :store_id AND id = :order_id");
                   $deleteUncomplateOrder->bindParam(':order_id', $ifHasOrder['id']);
                   $deleteUncomplateOrder->bindParam(':store_id', $storeID);
                   $deleteUncomplateOrder->execute();

                   $conn->connection->commit();

                }

            }
            catch(\PDOException $e)
            {
                $conn->connection->rollback();
                echo 'this error is coming from create order action ' . $e->getMessage();
            }



            try
            {
                


                // Begin Transaction Here
                // First Create a Order Table
                // Create Single Or Multiple Order Items Table
                
                // Create Connection To Database
                $conn = new Connection(STORE_DATABASE);

                // Begin Transaction
                $conn->connection->beginTransaction();

                // Order Status
                $order_status = 'uncomplate';



                // Fetch Payment Method
                $paymentMethodsStmt = $conn->connection->prepare("SELECT * FROM payment_methods");
                $paymentMethodsStmt->execute();
                $payment_methods = $paymentMethodsStmt->fetchAll(PDO::FETCH_ASSOC);


                // Fetch Shoping Carts Data
                $shopingCartStmt = $conn->connection->prepare("SELECT * FROM shopping_carts WHERE customer_id = :customer_id");
                $shopingCartStmt->bindParam(':customer_id', $customerID);
                $shopingCartStmt->execute();
                $allCarts = $shopingCartStmt->fetchAll(PDO::FETCH_ASSOC);

                // Create a New Order Row For This Customer
                $currentTime = bdTime();
                $orderStmt = $conn->connection->prepare("INSERT INTO orders (customer_id, store_id, grand_total_price, grand_total_discount, shipping_cost, order_status, create_at) VALUES(:customer_id, :store_id, :grand_total_price, :grand_total_discount, :shipping_cost, :order_status, :create_at)");
                $orderStmt->bindParam(':customer_id', $customerID);
                $orderStmt->bindParam(':store_id', $storeID);
                $orderStmt->bindParam(':grand_total_price', $grand_total);
                $orderStmt->bindParam(':grand_total_discount', $grand_discount);
                $orderStmt->bindParam(':shipping_cost', $shipping_cost);
                $orderStmt->bindParam(':order_status', $order_status);
                $orderStmt->bindParam(':create_at', $currentTime);
                $isOrderRowCreate = $orderStmt->execute();

                // Order ID
                $orderID = $conn->connection->lastInsertId();

                // Create Order Items
                foreach($allCarts as $cartItem){
                    // Fetch Product
                    $productStmt = $conn->connection->prepare("SELECT * FROM products WHERE id = :id");
                    $productStmt->bindParam(':id', $cartItem['product_id']);
                    $productStmt->execute();
                    $product = $productStmt->fetch(PDO::FETCH_ASSOC);

                    $productPrice = $product['unit_price'];

                    // calculate Discount
                    if($product['discount']){
                        $productPrice = $productPrice - ( $productPrice * $product['discount']) / 100;
                    }

                

                    $orderItemStmt = $conn->connection->prepare("INSERT INTO order_items (price, quantity, size, color, weight, product_id, order_id, store_id, create_at) VALUES(:price, :quantity, :size, :color, :weight, :product_id, :order_id, :store_id, :create_at)");

                    $quantity = $cartItem['quantity'];
                    $size = $cartItem['size'];
                    $color = $cartItem['color'];
                    $wegiht = $cartItem['weight'];
                    $product_id = $cartItem['product_id'];

                    $orderItemStmt->bindParam(':price', $productPrice);
                    $orderItemStmt->bindParam(':quantity',$quantity );
                    $orderItemStmt->bindParam(':size', $size );
                    $orderItemStmt->bindParam(':color', $color);
                    $orderItemStmt->bindParam(':weight', $wegiht);
                    $orderItemStmt->bindParam(':product_id',$product_id);
                    $orderItemStmt->bindParam(':order_id', $orderID);
                    $orderItemStmt->bindParam(':store_id', $storeID);
                    $orderItemStmt->bindParam(':create_at', $currentTime);
                    $orderItemStmt->execute();

                    // After insert int order items table delete cart tiems
                    $shoppingCartStmt = $conn->connection->prepare("DELETE FROM shopping_carts WHERE id = :id");
                    $shoppingCartStmt->bindParam(':id', $cartItem['id']);
                    $shoppingCartStmt->execute();

                }

                $orderStmt = $conn->connection->prepare("SELECT * FROM orders WHERE id = :id ");
                $orderStmt->bindParam(':id', $orderID);
                $orderStmt->execute();

                $order = $orderStmt->fetch(PDO::FETCH_ASSOC);
                $order['payment_methods'] = $payment_methods;


                $conn->connection->commit();

                

                //    If Successfull then ridrect to checkout page;
                redirect('checkout');
            }
            catch(\PDOException $e)
            {
                // If transaction failed do something here
                $conn->connection->rollback();
                echo 'error is coming from checkoutpageAction ' . $e->getMessage();
            }


?>