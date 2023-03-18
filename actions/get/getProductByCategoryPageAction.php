<?php 

            load(MODELS, 'Product');
            load(MODELS, 'CategoryProduct');
            load(MODELS, 'Category');
            load(MODELS, 'Brand');



            $categoryID = (int) get('c');
            $pageNo = get('page');


            try
            {
                $categoryStmt = new Category(STORE_DATABASE);
                $checkIsCategoryOfThisStore = $categoryStmt->findByStoreAndId(STORE_ID, $categoryID);

                if(!$checkIsCategoryOfThisStore){
                    return redirect(' ');
                }
            }
            catch(\PDOException $e)
            {
                echo 'This error is coming from get product by category' . $e->getMessage();
            }



            if(! $pageNo ){
                $pageNo = 1;
            }
            




            if(! $categoryID ) return redirect('');


            try
            {
                $categoryStmt = new Category(STORE_DATABASE);
                $currentChild = $categoryStmt->findByStoreAndId(STORE_ID, $categoryID );

                $childCategoreis = $categoryStmt->findChildCategoryByStoreAndCategoryId(STORE_ID, $categoryID);


                if($childCategoreis){
                    return view('categoryListPage', ['currentChild' => $currentChild,'childCategories' => $childCategoreis]);
                }
            }
            catch(\PDOException $e)
            {
                'this error is coming from ' . $e->getMessage();
            }




            $totalProduct = 0;
            $productPerPage = 20;





            try
            {
                $catPro = new CategoryProduct(STORE_DATABASE);
                $count =  $catPro->countProductByCategoryId($categoryID);

                if($count) {
                    $totalProduct = $count;
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
                view('productByCategoryPage', []);
            }


            $pagination = [
                'total_page' => $totalPage,
                'current_page' => $pageNo,
                'category_id' => $categoryID 
            ];


            try
            {

                $catPro = new CategoryProduct(STORE_DATABASE);
                $catProList = $catPro->findProductByCategoryId($categoryID);

                // Slice it for paginate
                $catProList = array_slice($catProList, $offset, $productPerPage);


                // Retreiv these product which product_id inside slice $catProList array
                $product = new Product(STORE_DATABASE);
                $productList = [];

                // Retreive all the products from database
                foreach($catProList as $singCatPro ){
                    $foundProduct = $product->findByStoreAndId(STORE_ID, $singCatPro['product_id']);
                    if($foundProduct) {
                        array_push($productList, $foundProduct);
                    }
                }

                

                
                // Update product List with category
                $productWithCategory = [];
                $category = new Category(STORE_DATABASE);
                
                // find category id then find category by category id then attouch it to product and push to category With product array
                foreach($productList as $product){
                    $catIDS = $catPro->findCategoryByProductId($product['id']);
                    foreach($catIDS as $catId){
                        $cat = $category->findManyByStoreId(STORE_ID, $catId['category_id']);
                        $product['categories'] = $cat;

                        array_push($productWithCategory, $product);
                    }
                }



                if($productWithCategory) {
                    view('productByCategoryPage', ['products' => $productWithCategory, 'pagination' => $pagination]);
                }

            }
            catch(Exception $e)
            {
                echo 'This error is coming from findProductByCategoryAction' . $e->getMessage();
            }



?>