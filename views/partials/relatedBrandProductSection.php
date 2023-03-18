<?php
    load(MODELS, 'Product');
    load(MODELS, 'CategoryProduct');


    try
    {
        // $data is coming from action/controller
        $product = $data['product'] ?? NULL;
        $productID = $product['id'] ?? NULL;
        $brandID = $product['brand_id'] ?? '';
        

        $productStmt = new Product(STORE_DATABASE);
        $realtedBrandProducts = $productStmt->findByStoreAndBrandIdWithLimit(STORE_ID, $brandID, 10);
        

        $seeMoreProductRoute = 'brand?b=' . $brandID;

           

    
        
    }
    catch(\PDOException $e)
    {
        echo 'This error is coming from related product section' . $e->getMessage();
    }




?>




<section class="text-gray-600 md:mt-4 body-font">
  <div class="container bg-white px-5 py-5 mx-auto">

        <div class="flex justify-between items-center md:mb-4">
            <h2 class="text-md mb-6">Related Brand</h2>
            <a class="hidden md:block text-sm text-blue-500 uppercase border border-blue-500 py-2 px-3" href="<?php echo route($seeMoreProductRoute ?? ''); ?>">See More</a>
        </div>

        <div class="flex flex-wrap -m-4">

                <?php if($realtedBrandProducts) { ?>
                <?php foreach($realtedBrandProducts ?? [] as $product) { ?>
                
                    <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                        <a class="block relative h-48 rounded overflow-hidden">
                        <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="<?php echo $product['thumbnail'] ?? '' ?>">
                        </a>
                        <div class="mt-4">
                        <a class="coursor-pointer" href="<?php route("product-detail?p=" . $product['id'] ?? '') ?>">
                            <h2 class="hover:text-red-400 text-gray-900 title-font text-sm font-medium"><?php echo $product['name'] ?? '' ?></h2>
                        </a>
                        <div class="flex items-center mt-4">
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
                <?php }} else { ?>
                    <span class="text-sm text-semibold">No Product Availble</span>
                <?php } ?>

        </div>
        
        <a class="block md:hidden w-1/3  mt-4 text-xs border border-blue-500 text-center text-blue-500 uppercase py-2 px-3" href="<?php echo route($seeMoreProductRoute ?? ''); ?>">See More</a>
      
  </div>
</section>
