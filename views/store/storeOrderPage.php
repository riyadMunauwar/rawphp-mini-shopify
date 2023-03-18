<?php include_once VIEWS . 'store/partials/storeHeaderSection.php'; ?>


<main class="bg-gray-100 dark:bg-gray-800 md:h-screen md:overflow-hidden  relative">
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

            <!-- store Dashboard Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                    <section class="bg-white p-3">
                        <!-- Order Page Navigation Menu Start-->
                            <div class="flex gap-3 mb-5">
                                
                                <a class="py-1 px-3 flex items-center bg-indigo-500 rounded-sm text-sm text-white font-semibold hover:bg-indigo-600 hover:cursor-pointer" href="<?php route("store/order?status=all") ?>">All Order <span class="h-7 w-7 rounded-full bg-blue-400 text-white flex items-center justify-center ml-2"><?php echo $data['countOrder']['totalOrder'] ?? '0' ?></span></a>
                                <a class="py-1 px-3 flex items-center bg-indigo-500 rounded-sm text-sm text-white font-semibold hover:bg-indigo-600 hover:cursor-pointer" href="<?php route("store/order?status=new") ?>">New Order<span class="h-7 w-7 rounded-full bg-blue-400 text-white flex items-center justify-center ml-2"><?php echo $data['countOrder']['newOrder'] ?? '0' ?></span></a>
                                
                                <form>
                                    <div class="flex gap-3">
                                        
                                    <select name="status" class="border form-select appearance-none
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
                                            <?php foreach($data['order_statuses'] ?? [] as $order_status) { ?>
                                                <option value="<?php echo  $order_status['status'] ?? '' ?>"><?php echo  $order_status['status'] ?? '' ?></option>
                                            <?php } ?>
                                    </select>

                                        <button class="py-2 px-3 bg-indigo-500 rounded-sm text-sm text-white font-semibold hover:bg-indigo-600 hover:cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                            </svg>
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>                            

                            <div>
                                <h1 class="text-sm font-semibold mb-3">Search order</h1>
                            
                                <div class="flex gap-3">
                                    <form action="<?php route('store/search-order') ?>" method="GET">
                                        <div class="flex gap-3">
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
                                             placeholder="Order ID"
                                             name="search-query"
                                            />
                                        
                        
                                            <button class="py-2 flex gap-2 items-center px-3 bg-indigo-500 rounded-sm text-sm text-white font-semibold hover:bg-indigo-600 hover:cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                                </svg>
                                                Search
                                            </button>
                                            
                                        </div>
                                    </form>
                                </div>   
                            </div>
                            
                        <!-- Order Page Navigation Menu End-->
                        <!-- Order List Section Start -->
                        <?php include_once VIEWS . 'store/partials/orderListSection.php'; ?>
                        <!-- Order List Section End -->

                        <!-- Order Pagination Start -->
                            <!-- Pagination -->
                            <?php 
                            
                            $status =    $data['pagination']['status'] ?? null;

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

                            
                            $prevPageRoute = BASE_PATH . "store/order?status={$status}&page={$prevPageId}";
                            $nextPageRoute = BASE_PATH . "store/order?status={$status}&page={$nextPageId}";
                        

                            
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
                                                        <a href="<?php route("store/order?status={$status}&page={$i}") ?>" class="<?php echo $i == $data['pagination']['current_page'] ? 'bg-blue-500 text-white ' : '' ?> hidden px-2 py-1 mx-1 text-black border transition-colors duration-200 transform bg-white rounded-md sm:inline text-xs dark:bg-gray-900 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200  ">
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
                        <!-- Order Pagination End -->
                    </section>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>