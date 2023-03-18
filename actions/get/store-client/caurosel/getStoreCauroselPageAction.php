<?php
    
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'ImageCaurosel');
    load(MODELS, 'FeaturedProductCauroselItem');
    load(MODELS, 'ImageBanner');
    load(MODELS, 'Product');


    try
    {
        $imageCauroselStmt = new ImageCaurosel(STORE_DATABASE);
        $imageCaurosel = $imageCauroselStmt->findAllImageCauroselItemByStoreId(STORE['id']);

        

        $featuredProductCauroselStmt = new FeaturedProductCauroselItem(STORE_DATABASE);
        $featuredProductCaurosel = $featuredProductCauroselStmt->findAllProductCauroselItemByStoreId(STORE['id']);

        $imageBannerStmt = new ImageBanner(STORE_DATABASE);
        $image_banner = $imageBannerStmt->findByStoreId(STORE['id']);
        


        if(isset($featuredProductCaurosel)){
            $featuredProductCauroselProduct = [];

            foreach($featuredProductCaurosel ?? [] as $item){
                $productStmt = new Product(STORE_DATABASE);
                $product = $productStmt->findByStoreAndId(STORE['id'], $item['product_id']);

                if($product){
                    array_push($featuredProductCauroselProduct, $product);
                }
            }

        }


        view('store/storeCauroselPage', ['image_banner' => $image_banner,'imageCaurosel' => $imageCaurosel, 'featuredProductCaurosel' => $featuredProductCauroselProduct]);


    }
    catch(\PDOException $e)
    {
        echo 'Error is coming from get store caurosel page action ' . $e->getMessage();
    }



    view('store/storeCauroselPage');

?>