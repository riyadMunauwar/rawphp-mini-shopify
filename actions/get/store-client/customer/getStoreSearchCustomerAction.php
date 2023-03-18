<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Customer');
    
    
    $query = get('search_query');
  
 
    if(!$query) {
        return redirect('store/customer?error=Search query is empty !');
    }
    
    
    
    try
    {
        $customerStmt = new Customer(STORE_DATABASE);
        $customer = $customerStmt->searchByEmailNamePhoneIdAndStore(STORE['id'], $query);
        
        if(!$customer){
            return redirect('store/customer?error=Not found ');
        }
        
        view('store/storeSearchCustomerPage', ['customer' => $customer ]);
    }
    catch(\PDOException $e){
        echo 'this error is coming from customer search amdin panel section' . $e->getMessage();
    }

?>