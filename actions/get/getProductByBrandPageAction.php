<?php 

    load(MODELS, 'Product');
    load(MODELS, 'CategoryProduct');
    load(MODELS, 'Category');
    load(MODELS, 'Brand');


    $brandID = (int)  get('b');
    $pageNo = get('page');


    try
    {
        $brandStmt = new Brand(STORE_DATABASE);
        $checkIsBrandOfThisStore = $brandStmt->findByStoreAndId(STORE_ID, $brandID);

        if(!$checkIsBrandOfThisStore){
            return redirect(' ');
        }
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from get product by brand' . $e->getMessage();
    }





    if(! $pageNo ){
        $pageNo = 1;
    }
    

    if(!$brandID ) redirect('/');

    $totalProduct = 0;
    $productPerPage = 20;


    try
    {
        $product = new Product(STORE_DATABASE);
        $count = $product->countTotalProductByBrandId($brandID);

        if($count){
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

    if($pageNo < 0 || $pageNo > $totalPage ) return redirect('');

    $pagination = [
        'total_page' => $totalPage,
        'current_page' => $pageNo,
        'brand_id' => $brandID 
    ];
 

    try 
    {

        $product = new Product(STORE_DATABASE);
        $products = $product->paginateByBrand($brandID, $offset,$productPerPage);

        $productWithCategory = [];


        $catPro = new CategoryProduct(STORE_DATABASE);
        $category = new Category(STORE_DATABASE);
        
        // find category id then find category by category id then attouch it to product and push to category With product array
        foreach($products as $product){
            $catIDS = $catPro->findCategoryByProductId($product['id']);
            foreach($catIDS as $catId){
                $cat = $category->findManyByStoreId(STORE_ID, $catId['category_id']);
                $product['categories'] = $cat;

                array_push($productWithCategory, $product);
            }
        }

        
        
        if($productWithCategory) {
            view('productByBrandPage', ['products' => $productWithCategory, 'pagination' => $pagination]);
        }

    }
    catch(\PDOException  $e)
    {
        echo 'this error is coming brand brand action' . $e->getMessage();

    }


    view('productByBrandPage');




?>