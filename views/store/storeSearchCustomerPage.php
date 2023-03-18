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
                        
                            <?php if(has('error', QUERY))  { ?>
                                <div class="py-1  mb-4 px-4 text-sm text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                            <?php } ?>

                            <?php if(has('success', QUERY))  { ?>
                                <div class="py-1  mb-4 px-4 text-sm text-white bg-green-400"><?php echo get('success') ?? '' ?></div>
                            <?php } ?>
                            
                        <!-- Order Page Navigation Menu Start-->
                        <div>
                            <h1 class="text-sm font-semibold mt-3">Search customer</h1>
                            <form action="<?php route('store/search-customer') ?>" method="GET">
                            <div class="flex border w-full md:w-2/4 mt-2">
                                <input name="search_query" placeholder="Search by email, phone, name, customerId" class="w-4/5 px-2 py-1 text-sm focus:outline-0" type="text">
                                <button class="py-1 ml-auto px-4 bg-indigo-500 text-white text-xs rounded-sm">Search</button>
                            </div>
                            </form>
                        </div>
                        
                        <?php
                            $customer = $data['customer'] ?? [];
                        ?>
                        
                        <?php if($customer) { ?>
                            <div>
                                <h1 class="text-xl font-semibold mt-4">Details</h1>
                                
                                <h1 class="text-md font-semibold mt-3">Name : <?php echo $customer['name'] ?? '' ?></h1>
                                <h1 class="text-md font-semibold mt-2">Email : <?php echo $customer['email'] ?? '' ?></h1>
                                <h1 class="text-md font-semibold mt-2">Phone : <?php echo $customer['phone'] ?? '' ?></h1>
                                <h1 class="text-md font-semibold mt-2">Password : <?php echo $customer['password'] ?? '' ?></h1>
                                <h1 class="text-md font-semibold mt-2">Account Create Date : <?php echo $customer['create_at'] ?? '' ?></h1>
                            </div>
                        <?php } else { ?>
                        
                        <?php } ?>

                        <!-- Order Pagination End -->
                    </section>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>