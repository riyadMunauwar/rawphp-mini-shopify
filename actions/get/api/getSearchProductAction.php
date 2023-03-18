<?php 
    load(MODELS, 'Product');



    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    $search_query = get('search_query');

    

    if(!$search_query){
        echo json_encode([
            'status' => 'error',
            'message' => 'Search query not provide'
        ]);
        return;
    }




    // $request = json_decode(file_get_contents('php://input'), true) ?? null;


  


    try
    {

        $productStmt = new Product(STORE_DATABASE);
        $products = $productStmt->searchingProductByNameAndStoreId($search_query, STORE_ID);

        
      
        if($products) {
            echo json_encode([
                'status' => 'success',
                'data' => $products,
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