<?php  include_once VIEWS . 'partials/head.php'; ?>


<main class="bg-gray-100 dark:bg-gray-800 h-screen overflow-hidden relative">
    <div class="flex items-start justify-between">

        <!-- SideBar -->
        <div class="h-screen hidden lg:block my-4 ml-4 shadow-lg relative w-80">
            <!-- Navigation bar -->
            <?php  include_once VIEWS . 'admin/partials/adminSideNavigationSection.php'; ?>
        </div>



        <!-- Right Side Of  -->
        <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">

            <!-- Header -->
            <?php  include_once VIEWS . 'admin/partials/adminHeaderSection.php'; ?>

            <!-- store Dashboard Page Content  Start -->
            <div class="overflow-auto h-screen pb-24 pt-2 pr-2 pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                    <?php  include_once VIEWS . 'admin/partials/adminStoreListSection.php'; ?>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End -->
        </div>
    </div>
</main>

<?php  include_once VIEWS . 'partials/foot.php'; ?>
