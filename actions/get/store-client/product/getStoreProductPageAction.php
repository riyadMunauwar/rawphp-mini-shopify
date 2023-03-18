<?php
            load(MIDDLEWARE, 'authenticateStore');
            load(MODELS, 'Product');
            load(MODELS, 'Category');
            load(MODELS, 'CategoryProduct');
            
            // Query Params
            $categoryID = (int) get('category_id');
            $query = get('query');
            $pageNo = get('page');
            $see = get('see');


         

            if(! $pageNo ){
                $pageNo = 1;
            }
            




            $totalProduct = 0;
            $productPerPage = 10;





            try
            {
                if($query){
                    $count = 1;
                }
                else if($see == 'all'){
                    $productStmt = new Product(STORE_DATABASE);
                    $count = $productStmt->countTotalProductByStoreId(STORE['id']);

                    if($count) {
                        $totalProduct = $count;
                    }
                }
                else
                {
                    $catPro = new CategoryProduct(STORE_DATABASE);
                    $count =  $catPro->countProductByCategoryId($categoryID);
    
                    if($count) {
                        $totalProduct = $count;
                    }
                }
    
            }
            catch(\PDOException $e)
            {
                // Error Handeling Here
            }







            $totalPage = ceil($totalProduct / $productPerPage);
            $offset = ( $pageNo - 1 ) * $productPerPage;


            // Invalid Page No Error Handeling
            // if page no is invalid ridirect o home page;
            if($pageNo < 0 || $pageNo > $totalPage ) {
                // view('productByCategoryPage', []);
            }


            $pagination = [
                'total_page' => $totalPage,
                'current_page' => $pageNo,
                'category_id' => $categoryID,
                'see' => $see,
            ];
            
            

            try
            {
                $productList = [];
                
                if($query){
                    $productStmt = new Product(STORE_DATABASE);
                    $productList = $productStmt->searchingProductByNameAndStoreId($query, STORE['id']);
                }
                else if($see === 'all') {
                    $productStmt = new Product(STORE_DATABASE);
                    $productList = $productStmt->paginateByStore(STORE['id'], $offset, $productPerPage);
                }
                else
                {

                    
                    $categoryStmt = new Category(STORE_DATABASE);
                    $categories = $categoryStmt->findManyByStoreId(STORE['id']);
    
    
                    $catPro = new CategoryProduct(STORE_DATABASE);
                    $catProList = $catPro->findProductByCategoryId($categoryID);
    
                    // Slice it for paginate
                    $catProList = array_slice($catProList, $offset, $productPerPage);
    
    
                    // Retreiv these product which product_id inside slice $catProList array
                    $product = new Product(STORE_DATABASE);
                    
    
                    // Retreive all the products from database
                    foreach($catProList as $singCatPro ){
                        $foundProduct = $product->findByStoreAndId(STORE_ID, $singCatPro['product_id']);
                        if($foundProduct) {
                            array_push($productList, $foundProduct);
                        }
                    }
                }
                
                
                $categoryStmt = new Category(STORE_DATABASE);
                $categories = $categoryStmt->findManyByStoreId(STORE['id']);
        

            
            
                view('store/storeProductPage', ['products' => $productList, 'categories' => $categories, 'pagination' => $pagination]);
                

            }
            catch(Exception $e)
            {
                echo 'This error is coming from store product page' . $e->getMessage();
            }




?>