<?php

    load(MODELS, 'Product');
    load(MODELS, 'Variation');
    load(MODELS, 'Brand');
    load(MODELS, 'CategoryProduct');
    load(MODELS, 'Category');
    load(MODELS, 'ProductPhotoGallery');

    $productID = (int) get('p');


    try
    {
        $product = new Product(STORE_DATABASE);
        $singleProduct = $product->findByStoreAndId(STORE_ID, $productID);



        if($singleProduct) {

            // Fetch All variation from database
            $variation = new Variation(STORE_DATABASE);
            $all = $variation->findAllByProductId($productID);
            $singleProduct['variations'] = $all;
            
            // fetch Brand from database
            $brand = new Brand(STORE_DATABASE);
            $brand = $brand->findByStoreAndId(STORE_ID, (int) $singleProduct['brand_id']);
            $singleProduct['brand'] = $brand;

            // fetch all Category By Product Usingt Pivot table Category Product
            $catPro = new CategoryProduct(STORE_DATABASE);
            $catsid = $catPro->findCategoryByProductId($productID);

            
            $categories = [];
            // Fetch All category and push to categoreis table
            foreach($catsid as $item){
                $category = new Category(STORE_DATABASE);
                $cat = $category->findByStoreAndId(STORE_ID, (int)$item['category_id']);
                
                if($cat){
                    array_push($categories,$cat);
                }

            }

            $singleProduct['categories'] = $categories;


            // Fetch All Product Gallery Photo
            $proPhoGallery = new ProductPhotoGallery(STORE_DATABASE);
            $gallery = $proPhoGallery->findAllByProductId($productID);

            $singleProduct['gallery'] = $gallery;

            
            
            view('productDetailPage', ['product' => $singleProduct]);

        }
        else
        {
            return redirect(' ');
        }
        


        
        
    }
    catch(Exception $e)
    {
        echo 'this error is coming from product detail page' . $e->getMessage();
    }


    

?>