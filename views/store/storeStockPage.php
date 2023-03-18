<?php include_once VIEWS . 'store/partials/storeHeaderSection.php'; ?>


<main class="bg-gray-100 dark:bg-gray-800 md:h-screen md:overflow-hidden relative">
    <div class="md:flex items-start justify-between">

        <!-- SideBar -->
        <div class="md:h-screen lg:block md:my-4 md:ml-4 shadow-lg relative w-full md:w-80">
            <!-- Navigation bar -->
            <?php include_once VIEWS . 'store/partials/storeSideNavigationSectionTwo.php'; ?>
        </div>



        <!-- Right Side Of  -->
        <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">

            <!-- Header -->
            <?php include_once VIEWS . 'store/partials/storeHeaderSectionTwo.php'; ?>
              
            <!-- Add Brand Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
            
                    <!-- Section Start -->
                    <section class="bg-white dark:bg-gray-700 shadow-lg body-font">
                        <div class="container px-5 py-10 mx-auto">

                            <!-- Alert or Success Message -->
                            <?php if(has('error', QUERY))  { ?>
                                <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                            <?php } ?>

                            <?php if(has('success', QUERY))  { ?>
                                <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-green-500"><?php echo get('success') ?? '' ?></div>
                            <?php } ?>
                            <!-- Header Start -->
                            <!-- Button -->
                            <div class="flex gap-3 mb-6">
                                <!--<a class="py-2 px-3 flex items-center bg-themeSecondaryLight rounded-sm text-sm text-white font-semibold hover:bg-themeSecondaryDark hover:cursor-pointer" href="<?php route('store/add-product?active=product'); ?>">Add Product</a>-->
                                <form>
                                    <div class="flex gap-3">
                                        
                                    <select name="category_id" class="border form-select appearance-none
                                      block
                                      w-full
                                      px-3
                                      py-1.5
                                      text-base
                                      font-normal
                                      text-gray-700
                                      bg-white bg-clip-padding bg-no-repeat
                                      border border-solid border-gray-300
                                      rounded
                                      transition
                                      ease-in-out
                                      m-0
                                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                       <?php foreach($data['categories'] ?? [] as $category) { ?>
                                            <option value=<?php echo $category['id'] ?? ''  ?>><?php echo $category['name'] ?? '' ?></option>
                                       <?php } ?>
                                    </select>
                                    <input class="border form-select appearance-none
                                      block
                                      w-full
                                      px-3
                                      py-1.5
                                      text-base
                                      font-normal
                                      text-gray-700
                                      bg-white bg-clip-padding bg-no-repeat
                                      border border-solid border-gray-300
                                      rounded
                                      transition
                                      ease-in-out
                                      m-0
                                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                                     type="text"
                                     placeholder="Product ID or Name"
                                     name="query"
                                    />
                                    
                    
                                        <button class="py-2 px-3 bg-themeSecondaryLight rounded-sm text-sm text-white font-semibold hover:bg-themeSecondaryDark hover:cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                            </svg>
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>

                            <h1 class="font-semibold mb-4">Stock Details</h1>

                            <?php 

                                $products = $data['products'] ?? null;

                            ?>


                            <?php foreach($products ?? [] as $product )  { ?>
                                
                                <?php
                                
                                    $lowStock = $product['stock_quantity'] < 5 ? true : false;
                                    $stockOut = $product['stock_quantity'] === 0 ? true : false;
                                    $cssClassText = '';
                                    $cssClassBorder = '';

                                    if($lowStock) {
                                        $cssClassText = 'text-yellow-500';
                                        $cssClassBorder = 'border-yellow-500';
                                    }

                                    if($lowStock && $stockOut){
                                        $cssClassText = 'text-red-500';
                                        $cssClassBorder = 'border-red-500';
                                    }

                                    
                                ?>

                                <div class="border flex mb-4 shadow <?php echo $cssClassBorder ?>">
                                    <div class="w-1/5 p-2">
                                        <img class="block aspect-square object-cover"  src="<?php echo $product['thumbnail'] ?? '-' ?>" />
                                    </div>
                                    <div class="w-4/5">
                                    <!-- header start -->
                                        <div class="flex justify-between  py-2 px-2 text-xs">                   
                                            <h2 class="font-semibold uppercase <?php echo $cssClassText ?> "><?php echo $product['name'] ?? '-' ?></h2>
                                            <h2 class="text-center uppercase font-semibold <?php echo $cssClassText ?>">Stock :  <?php echo $product['stock_quantity'] ?? '-' ?>/Pcs</h2>
                                            <h2 class="uppercase text-center <?php echo $cssClassText ?>">Product ID :  <?php echo $product['id'] ?? '-' ?></h2>
                                        </div>
                                    <!-- Header end -->
                                    <!-- Body Start -->
                                        <div class="p-4">
                                            <div class="md:w-full  w-full mx-auto overflow-auto">
                                                <table class="table-auto w-full text-left whitespace-no-wrap">

                                                    <?php if(has('variation', $product)) { ?>

                                                        <thead class="" >
                                                            <tr class="bg-gray-500">
                                                                <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs  rounded-tl rounded-bl">Variant ID</th>
                                                                <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Image</th>
                                                                <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Stock Quantity</th>
                                                                <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Size</th>
                                                                <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Color</th>
                                                                <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Weight</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        <?php foreach( $product['variation'] ?? [] as $variant ) { ?>

                                                                    <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                                        <td class="py-1 px-2 text-xs">#<?php echo $variant['id'] ?? '' ?></td>
                                                                        <td class="py-1 px-2 text-xs"><img class="w-5 h-5 rounded-md" src="<?php echo $variant['photo'] ?? '' ?>" alt=""></td>
                                                                        <td class="py-1 px-2 text-xs"><?php echo $variant['stock_quantity'] ?? '-' ?>/Pcs</td>
                                                                        <td class="py-1 px-2 text-xs"><?php echo $variant['size'] ?? '-' ?></td>
                                                                        <td class="py-1 px-2 text-xs"><?php echo $variant['color'] ?? '-' ?></td>
                                                                        <td class="py-1 px-2 text-xs"><?php echo $variant['weight'] ?? '-' ?></td>
                                                                    </tr>
                                                                                                    
                                                            <?php  } ?> 
                                                        </tbody> 

                                                    <?php }else { ?>

                                                        <h2 class="text-sm font-semibold ">This Product Has No Variant.</h2>

                                                    <?php } ?>

                                                </table>
                                            </div>
                                            <!-- Table end -->
                                            <!-- Order Stock Information End -->
                                        </div>
                                    <!-- Body End -->                                       
                                    </div>
                                </div>
          
 
                            <?php } ?>
                            
                            <?php  if(!$products) { ?>
                                <h1 class="mt-6 text-md font-semibold">No Result Found !</h1>
                            <?php } ?>
                            
                            
                            <!-- Pagination -->
                            <?php 
                            
                            $see =    $data['pagination']['see'] ?? '';
                            $category_id =    $data['pagination']['category_id'] ?? '';
                            $query =    $data['pagination']['query'] ?? '';

                            $prevPageId =  $data['pagination']['current_page'] ?? 1;
                            $nextPageId = $data['pagination']['current_page'] ?? 1;
                            $totalPage = $data['pagination']['total_page'] ?? 1;
                            $prevPageId--;
                            $nextPageId++;

                            if($prevPageId < 1) {
                                $prevPageId = 1;
                            }

                            if($nextPageId > $totalPage) {
                                $nextPageId--;
                            }

                            
                            $prevPageRoute = BASE_PATH . "store/stock?see={$see}&page={$prevPageId}&category_id={$category_id}&query={$query}";
                            $nextPageRoute = BASE_PATH . "store/stock?see={$see}&page={$nextPageId}&category_id={$category_id}&query={$query}";
                        

                            
                            ?>
                                            <?php if( has('pagination', $data ) ) { ?>

                                                <div class="flex justify-center mt-6">
                                                    <a href="<?php echo $prevPageRoute ?>" class="px-2 py-1 mx-1 text-xs text-gray-500 hover:text-white capitalize bg-white rounded-md dark:bg-gray-900 dark:text-gray-600 hover:bg-blue-500">
                                                        <div class="flex items-center -mx-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                                            </svg>

                                                            <span class="mx-1">
                                                                previous
                                                            </span>
                                                        </div>
                                                    </a>
                                                    <?php for($i = 1; $i <= $data['pagination']['total_page']; $i++) { ?>
                                                        <a href="<?php route("store/stock?see={$see}&page={$i}&category_id={$category_id}&query={$query}") ?>" class="<?php echo $i == $data['pagination']['current_page'] ? 'bg-blue-500 text-white ' : '' ?> hidden px-2 py-1 mx-1 text-black border transition-colors duration-200 transform bg-white rounded-md sm:inline text-xs dark:bg-gray-900 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200  ">
                                                            <?php echo $i ?>
                                                        </a>
                                                    <?php } ?>



                                                    <a href="<?php echo $nextPageRoute; ?>" class="px-2 py-1 text-xs mx-1 text-gray-700 transition-colors duration-200 transform bg-white rounded-md dark:bg-gray-900 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                                                        <div class="flex items-center -mx-1">
                                                            <span class="mx-1">
                                                                Next
                                                            </span>
                                                            
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>

                                                

                                            <?php } ?>
                                        <!-- Pagination End -->
                            


                        </div>
                    <!-- Footer end -->
                    </section>
                    <!-- Section End -->                   
                <!-- Content End -->
            </div>
            <!-- Add Category Page Content  End-->
        </div>
    </div>
</main>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>





