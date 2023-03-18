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

            <!-- store Dashboard Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                    <section class="bg-white p-3">
                        <!-- Order Page Navigation Menu Start-->
                            <div class="flex space-x-2">
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="">All order</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="">New order</a>
                            </div>

                        <div>
                            <h1 class="text-sm font-semibold mt-3">Serch order</h1>
                            <form action="<?php route('store/search-order') ?>" method="GET">
                            <div class="flex border w-1/4 mt-2">
                                <input name="search-query" placeholder="Search Order..." class="w-4/5 px-2 py-1 text-sm focus:outline-0" type="text">
                                <button class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm">Search</button>
                            </div>
                            </form>
                        </div>
                        <!-- Order Page Navigation Menu End-->
                        <!-- Order List Section Start -->
                        <?php include_once VIEWS . 'store/partials/orderListSection.php'; ?>
                        <!-- Order List Section End -->
                    </section>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>