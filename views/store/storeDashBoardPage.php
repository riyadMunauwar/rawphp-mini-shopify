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


            <?php 

            $report = $data['report'] ?? [];

            ?>

            <!-- store Dashboard Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                    <div class="bg-white p-4 pb-20">
                        <h2 class="text-md font-semibold mb-4">Summury</h2>

                        <h2 class="text-sm font-semibold mb-4">Sales</h2>

                        <div class="grid grid-cols-5 gap-3 mb-6">
                            <div class="border bg-indigo-500 border-indigo-500 text-white aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">sales total</span>
                                <span class="block uppercase font-semibold text-sm">TK <?php echo round($report['totalSales'], 2)  ?? '' ?></span>
                            </div>

                            <div class="border bg-blue-500 border-blue-500 text-white aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">sales this month</span>
                                <span class="block uppercase font-semibold text-sm">TK <?php echo round($report['totalSalesThisMonth'],2)  ?? '' ?></span>
                            </div>

                            <div class="border bg-rose-500 border-rose-500 text-white aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">total orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['totalOrder'] ?? '' ?></span>
                            </div>

                            <div class="border bg-violet-500 border-violet-500 text-white aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">orders this month</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['totalOrderThisMonth'] ?? '' ?></span>
                            </div>

                        </div>


                        <h2 class="text-sm font-semibold mb-4">Order Status From Start</h2>

                        <div class="grid grid-cols-5 gap-3">

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Uncomplate Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['uncomplateOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-amber-300 to-yellow-300 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Pending Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['pendingOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-red-300 to-rose-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Processing Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['processingOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-lime-600 to-lime-800 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Shiped Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['shipedOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-red-500 to-red-700 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Refund Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['refundedOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-indigo-400 to-indigo-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Cancel</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['cancelOrder'] ?? '' ?></span>
                            </div>

                            <div class="border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Complate Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['complateOrder'] ?? '' ?></span>
                            </div>
                        </div>

                        <h2 class="text-sm font-semibold mb-4 mt-6 ">Order Status This Month</h2>

                        <div class="grid grid-cols-5 gap-3">

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Uncomplate Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['uncomplateOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Pending Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['pendingOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Processing Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['processingOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Shiped Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['shipedOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Refund Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['refundedOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Cancel</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['cancelOrder'] ?? '' ?></span>
                            </div>

                            <div class="bg-gradient-to-r from-neutral-300 to-slate-300 border border-blue-500 text-blue-500 aspect-video flex flex-col justify-center items-center">
                                <span class="block uppercase font-semibold text-sm">Complate Orders</span>
                                <span class="block uppercase font-semibold text-sm"><?php echo $report['complateOrder'] ?? '' ?></span>
                            </div>
                        </div>


                    </div>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>