<?php 
    load(MIDDLEWARE, 'authenticateCustomer');
    load(MODELS, 'Product');
    load(MODELS, 'ShoppingCart');
    load(MODELS, 'ShippingCost');


    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    $customerID = get('cid');

    

    if(!$customerID){
        echo json_encode([
            'status' => 'error',
            'message' => 'plase provide customer id or valid customerid'
        ]);
        return;
    }




    // $request = json_decode(file_get_contents('php://input'), true) ?? null;


  

    $carts = [];
    $data = [];

    try
    {
        $shippingCostStmt = new ShippingCost(STORE_DATABASE);
        $shipping_costs = $shippingCostStmt->findManyByStoreAId(STORE_ID);

        $data['shipping_costs'] = $shipping_costs;
        

        $shopping = new ShoppingCart(STORE_DATABASE);
        $allCarts = $shopping->findManyByCustomerId($customerID);

        
        if($allCarts) {

            $product = new Product(STORE_DATABASE);

            foreach($allCarts as $cart){
                $current_product = $product->findById($cart['product_id']);
                
                if($current_product){
                    $cartDataPlusProductData = array_merge($current_product, $cart);
                    array_push($carts, $cartDataPlusProductData);
                }
            }

            
        }

       
        $data['carts'] = $carts;

 
        if($carts) {
            echo json_encode([
                'status' => 'success',
                'data' => $data,
            ]);
        }
        else 
        {
            echo json_encode([
                'status' => 'success',
                'data' => '',
            ]);
        }
        
       
        

    }
    catch(\PDOException $e)
    {

        echo 'erroris comong form api get all carts json get page action';

    }






?>