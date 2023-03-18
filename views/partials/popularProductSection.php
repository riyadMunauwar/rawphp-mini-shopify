<?php
    load(MODELS, 'Product');
    load(MODELS, 'OrderItem');

    try
    {
        $orderItemStmt = new OrderItem(STORE_DATABASE);
        $popularProductIds = $orderItemStmt->findTopOrderPrudctByStoreId(STORE_ID, 28);

        
        $popularProducts = [];

        if($popularProductIds){
            
            $productStmt = new Product(STORE_DATABASE);

            foreach($popularProductIds as $item){
                    $product = $productStmt->findByStoreAndId(STORE_ID, $item['product_id']);
                    if($product){
                        array_push($popularProducts, $product);
                    }
            }

        }
        
        


        $seeMoreProductRoute = '';

    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from related product section' . $e->getMessage();
    }


?>




<section class="text-gray-600 md:mt-4 body-font">
  <div class="container bg-white px-5 py-5 mx-auto">

        <div class="flex justify-between items-center md:mb-4">
            <h2 class="text-md mb-6">Popular</h2>
            <a class="hidden md:block text-sm text-blue-500 uppercase border border-blue-500 py-2 px-3" href="<?php echo route($seeMoreProductRoute ?? ''); ?>">See More</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4">
            <!-- Single Product -->
            <?php if( $popularProducts ) { ?>
            <?php foreach($popularProducts ?? [] as $product) { ?> 
                <a href="<?php route("product-detail?p=" . $product['id']) ?>">
                    <div class="p-2">
                        <div class="mb-3">
                            <img class="rounded-lg object-cover aspect-square" src="<?php echo $product['thumbnail'] ?? '' ?>" alt="">
                        </div>
                        <div>
                            <h2 class="mb-1 text-sm md:text-md font-semibold text-gray-800">New Arrivals</h2>
                            <div class="flex items-center">
                                <p class="text-xs md:text-xs text-themePrimaryLight md:font-bold mb-2">TK <?php echo countDiscountIfHas($product['unit_price'], $product['discount']) ?? '' ?> </p>
                                <?php if($product['discount'] ?? null) { ?>
                                    <p class="ml-3 text-xs md:text-xs md:font-bold mb-2"><del>TK <?php echo $product['unit_price'] ?? '' ?> </del></p>
                                <?php } ?>

                                <?php if($product['discount'] ?? null) { ?>
                                    <span class="bg-black ml-3 text-white text-xs py-1 px-2 font-semibold"><?php echo $product['discount'] ?? '' ?>% OFF</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php }} else { ?>
                <span class="text-sm font-semibold text-center">No Product Available !</span>
            <?php  } ?>

        </div>
        
        <a class="block md:hidden w-1/3  mt-4 text-xs border border-blue-500 text-center text-blue-500 uppercase py-2 px-3" href="<?php echo route($seeMoreProductRoute ?? ''); ?>">See More</a>
      
  </div>
</section>
