<?php 
    
    load(MODELS, 'Product');
    load(MODELS, 'Category');


    try{

        $product = new Product(STORE_DATABASE);
        $products = $product->findRecentProductByStoreId(STORE_ID, 8);
   
            
        $category = new Category(STORE_DATABASE);
        $categories = $category->findAllParentCategoryByStoreId(STORE_ID);

       }
       catch(Exception $e)
       {
            echo "This error is coming from category and recent product section " . $e->getMessage();
       }

?>

    <!-- Banner Section -->
    <section class="banner md:mt-4">
        <div class="container mx-auto">
    
            <div class="grid grid-cols-1 md:grid-cols-7 md:gap-3">
    
                <!-- Left Column -->
                <div class="col-span-2 bg-white">

                  <h2 class="text-md font-semibold text-gray-700 py-3 px-4">Categories</h2>

                  <!--Category Container   -->
                  <div class="grid  grid-cols-3 md:grid-cols-1 mx-2 gap-1 pb-4">
                    <!-- Single Category -->
                    <?php if($categories) { ?>
                    <?php foreach( $categories ?? [] as $category) { ?> 
                    <a class="group text-gray-600" href="<?php route("category?c=" . $category['id'] ?? '') ?>">
                        <div class="hover:text-white flex flex-col rounded-md md:rounded-none aspect-square md:aspect-auto justify-center border md:border-none md:flex-row items-center transition-all px-1 md:py-2 md:pl-4 md:pr-6 hover:bg-themePrimaryLight">
                            <div class="h-8 w-8 md:h-5 md:w-5">
                               <img src="<?php echo $category['thumbnail'] ?? '' ?>" alt="">
                            </div>

                            <span class="group-hover:text-white mt-1 text-center md:text-left text-xs md:text-sm md:font-semibold block md:ml-2 text-gray-800">
                                <?php echo $category['name'] ?? '' ?>
                            </span>

                            <div class="hidden md:block ml-auto h-5 h-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <?php } } else { ?>
                        <span class="text-xs font-semibold text-center">No Category Availabe</span>
                    <?php } ?>
                    <!-- Single Category End -->
                  </div>
                  <!--Category Container  End -->
                </div>
                <!-- Left Column End-->

    
                <!-- Right Column -->
                <div class="col-span-5 bg-white p-3">
           
                    <!-- Recent Search Container -->
                    <h2 class="text-md font-semibold text-gray-700  px-2">Recent Product</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4">
                                <!-- Single Product -->
                                <?php if( $products ) { ?>
                                <?php foreach($products ?? [] as $product) { ?> 
                                    <a href="<?php route("product-detail?p=" . $product['id']) ?>">
                                        <div class="p-2">
                                            <div class="mb-3">
                                                <img class="rounded-lg aspect-square object-cover" src="<?php echo $product['thumbnail'] ?? '' ?>" alt="">
                                            </div>
                                            <div>
                                                <h2 class="mb-1 text-sm md:text-md font-semibold text-gray-800">New Arrivals</h2>

                                                <div class="flex items-center">
                                                    <p class="text-xs md:text-xs text-themePrimaryLight md:font-bold mb-2">TK <?php echo countDiscountIfHas($product['unit_price'], $product['discount']) ?? '' ?> </p>
                                                    <?php if($product['discount'] ?? null) { ?>
                                                        <p class="ml-3 text-xs md:text-xs md:font-bold mb-2"><del>TK <?php echo $product['unit_price'] ?? '' ?> </del></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php }} else { ?>
                                    <span class="text-sm font-semibold text-center">No Product Available !</span>
                                <?php  } ?>

                        </div>
                    <!-- Recent Search Container End -->
    
                </div>
                <!--  Right Column End -->
    
            </div>
        </div>
    </section>