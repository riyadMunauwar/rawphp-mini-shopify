<?php

    load(MIDDLEWARE, 'authenticateCustomer');
    load(MODELS, 'ShoppingCart');


    // QUERY PARAMS
    $cartID = get('cart-id');
    $quantity = get('quantity');


    if( ! ($cartID && $quantity) ){
        echo json_encode([
            'status' => 'failed',
            'message' => 'cart id or quantity query param not pass'
        ]);
        return;
    }



    try
    {
        $shoppingCart = new  ShoppingCart(STORE_DATABASE);
        $isFound = $shoppingCart->findById($cartID);
 
        if( ! $isFound ){
         echo json_encode([
             'status' => 'failed',
             'message' => 'Invalid Cart id !'
         ]);
         return;
        }
        else
        {
 
         $isUpdate = $shoppingCart->updateQuantity($cartID, $quantity);
 
         if($isUpdate){
             echo json_encode([
                 'status' => 'success',
                 'message' => 'Update Successfully'
             ]);
         }
         else
         {
             echo json_encode([
                 'status' => 'failed',
                 'message' => 'database error'
             ]);
         }
 
        }
    }
    catch(\PDOException $e)
    {
        echo $e->getMessage();
        echo json_encode([
            'status' => 'failed',
            'message' => 'database error'
        ]);

    }


?>