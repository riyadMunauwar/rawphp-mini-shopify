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
              
            <!-- Add Brand Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                    <!-- Section Start -->
                    <section class="bg-white dark:bg-gray-700 body-font">
                        <div class="container px-5 py-10 mx-auto">
                            <?php if(has('error', QUERY))  { ?>
                                <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                            <?php } ?>

                            <?php if(has('success', QUERY))  { ?>
                                <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-green-500"><?php echo get('success') ?? '' ?></div>
                            <?php } ?>
                            <!-- Header Start -->
                            <!-- Button -->
                            <div class="mb-10">
                                <a class="text-sm text-white bg-themeSecondaryLight border-0 py-2 px-4 focus:outline-none hover:themeSecondaryDark rounded-sm font-semibold" href="<?php route('store/add-category'); ?>">Add Category</a>
                            </div>

                            <!-- <div class="flex flex-col text-center w-full mb-20"> -->
                                <!-- <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Brands</h1> -->
                                <!-- <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Banh mi cornhole echo park skateboard authentic crucifix neutra tilde lyft biodiesel artisan direct trade mumblecore 3 wolf moon twee</p> -->
                            <!-- </div> -->
                            <!-- Header end -->

                            <!-- Table Start -->
                            <div class="md:w-full  w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">

                                    <?php if(has('categories', $data)) { ?>

                                        <thead >
                                            <tr class="bg-themeSecondaryLight">
                                                <th class="px-3 py-1 title-font tracking-wider font-medium text-gray-100 text-sm  rounded-tl rounded-bl">Image</th>
                                                <th class="px-3 py-1 title-font tracking-wider font-medium text-gray-100 text-sm ">Cateogry Name</th>
                                                <th class="px-3 py-1 title-font tracking-wider font-medium text-gray-100 text-sm ">Slug</th>
                                                <th class="px-3 py-1 title-font tracking-wider font-medium text-gray-100 text-sm ">Description</th>
                                                <th class="w-10 title-font tracking-wider font-medium text-gray-100 text-sm  rounded-tr rounded-br">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach( $data['categories'] ?? [] as $cateogry ) { ?>

                                                    <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                        <td class="px-3 py-1 text-sm"><img class="h-6 w-6 rounded-full object-cover" src="<?php echo $cateogry['thumbnail'] ?? 'https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg' ?>" alt=""></td>
                                                        <td class="px-3 py-1 text-sm"><?php echo $cateogry['name'] ?? '' ?></td>
                                                        <td class="px-3 py-1 text-sm"><?php echo $cateogry['slug'] ?? '' ?></td>
                                                        <td class="px-3 py-1 text-sm"><?php echo  '...' ?? '---' ?></td>
                                                        <td class="w-10 text-center">
                                                            <div class="flex justify-center space-x-2">
                                                                <a href="<?php route("store/delete-category?category_id=" . $cateogry['id'] ) ?>" class="px-2 py-1 rounded-sm bg-themeSecondaryLight text-xs text-white hover:cursor-pointer hover:bg-themeSecondaryDark" > Delete</a>
                                                                <a href="<?php route("store/update-category?category_id=" . $cateogry['id'] ) ?>" class="px-2 py-1 rounded-sm bg-themeSecondaryLight text-xs text-white hover:cursor-pointer hover:bg-themeSecondaryDark" > Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                                                     
                                            <?php  } ?> 
                                        </tbody> 

                                    <?php }else { ?>

                                        <h2 class="text-lg font-semibold ">No Category Available</h2>

                                    <?php } ?>

                                </table>
                            </div>
                            <!-- Table end -->

                            <!-- Footer -->
                            <!-- <div class="flex pl-4 mt-4 lg:w-full w-full mx-auto">
                            <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0 dark:text-gray-100">Learn More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
                            </div> -->
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










