<?php 
        load(MIDDLEWARE, 'authenticateCustomer');
        load(MODELS, 'ShoppingCart');


        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $cartID = get('cart-id');

            
        if(!$cartID ) {
            echo json_encode([
                'status'=> 'failed',
                'message' => 'Param cart id not provide'
            ]);
        }



        try
        {
            $shoppingCart = new ShoppingCart(STORE_DATABASE);

            $isFound = $shoppingCart->findById($cartID);

            if(!$isFound){
                echo json_encode([
                    'status' => 'failed',
                    'message' => 'invalid cart id'
                ]);
            }
            else
            {
                $isDelete = $shoppingCart->deleteById($cartID);

                if($isDelete){
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'delete successfully'
                    ]);
                }
            }

        }
        catch(\PDOException $e)
        {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Database error'
            ]);
        }







?>