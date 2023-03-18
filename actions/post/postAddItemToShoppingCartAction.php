<?php 

    load(MIDDLEWARE, 'authenticateCustomer');
    load(MODELS, 'ShoppingCart');
    load(MODELS, 'Product');
    load(MODELS, 'Variation');


    $quanity = 1;
    $size = get('size');
    $color = get('color');
    $weight = get('weight');
    $productID = get('pid');

 
    

    if(!$productID)
    {
        // Redirect To Home
        return redirect(' ');
    }

    // $testArray = [
    //     ['size' => 'M'],
    //     ['size' => 'LM'],
    //     ['size' => 'XL'],
    // ];

    function IsAreadyExist($array, $target, $key){
        foreach($array ?? [] as $item){
            if($item[$key] === $target){
                return true;
            }
        }

        return false;
    }

    // if(IsAreadyExist($testArray, $size, 'size')){
    //     console('ache');
    // }else{
    //     console('nai');
    // }


    // exit();

 
    try
    {
        // Search In Database If Has any variant of this product
        $variationStmt = new Variation(STORE_DATABASE);
        $IfHasGetAll = $variationStmt->findAllByProductId($productID);

        if($IfHasGetAll){
            // Then check if user variant select or not
            if( ! ($size || $color || $weight) ){
                return redirect("product-detail?p=$productID&error=Please select variant of product (Size, Color or Weight etc) then hit add to cart button again.");
            }
        }
        
        $shopingCart = new ShoppingCart(STORE_DATABASE);
        $isAlreadyExists = $shopingCart->findManyByCustomerAndProductId($productID, CUSTOMER['id']);

        if(!$IfHasGetAll ){
            if($isAlreadyExists){
                return redirect("product-detail?p=$productID&error=This product already exist in the cart. Go to cart page and checkout");
            }
        }



        if($isAlreadyExists){
            
            

            if($size){

               if(IsAreadyExist($isAlreadyExists, $size, 'size')){
                    return redirect("product-detail?p=$productID&error=This product already exist in the cart. Go to cart page and checkout");
               }

            }


            if($color){
                if(IsAreadyExist($isAlreadyExists, $color, 'color')){
                    return redirect("product-detail?p=$productID&error=This product already exist in the cart. Go to cart page and checkout");
               }
            }

            if($weight){
                if(IsAreadyExist($isAlreadyExists, $weight, 'weight')){
                    return redirect("product-detail?p=$productID&error=This product already exist in the cart. Go to cart page and checkout");
               }
            }

        
        }
 

        $product = new Product(STORE_DATABASE);
        $product = $product->findByStoreAndId(STORE_ID, $productID);

        $stockQuantity = $product['stock_quantity'];

        if($size){
            
            $variantStmtS = new Variation(STORE_DATABASE);
            $variantS = $variantStmtS->findByVariantIdAndProductId('size', $size, $productID);
            
            if($variantS['stock_quantity'] < 1){
                return redirect("product-detail?p=$productID&error=This product is out of stock ! Plase message us for preorder or wait unitl it stock in.");
            }
            
        }


        if($color){
            $variantStmtC = new Variation(STORE_DATABASE);
            $variantC = $variantStmtC->findByVariantIdAndProductId('color', $color, $productID);
            
            if($variantC['stock_quantity'] < 1){
                return redirect("product-detail?p=$productID&error=This product is out of stock ! Plase message us for preorder or wait unitl it stock in.");
            }
        }


        if($weight){
            $variantStmtW = new Variation(STORE_DATABASE);
            $variantW = $variantStmtW->findByVariantIdAndProductId('weight', $weight, $productID);
            
            if($variantC['stock_quantity'] < 1){
                return redirect("product-detail?p=$productID&error=This product is out of stock ! Plase message us for preorder or wait unitl it stock in.");
            }
        }

        if($stockQuantity && $stockQuantity >= 1 ){

            $shopingCart = new ShoppingCart(STORE_DATABASE);
            $shopingCart->customer_id = CUSTOMER['id'];
            $shopingCart->product_id = $productID;
            $shopingCart->quantity = $quanity;
            $shopingCart->size = $size;
            $shopingCart->color = $color;
            $shopingCart->weight = $weight;
            $shopingCart->create_at = bdTime();
            $shopingCart->insert();
            

            // If all done ridirect to cart page
            view('messagePage', ['success' => ' ', 'message' => 'Add item to cart successfully !']);
            return;

            
        }
        else
        {
            // Out of Stock Message
            view('messagePage', ['error' => '', 'message' => 'Product is out of stock ! Plase message us for preorder or wait unitl it stock in.']);
            return;
            
        }

        


    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from add item to shopping cart action' . $e->getMessage();
    }




?>