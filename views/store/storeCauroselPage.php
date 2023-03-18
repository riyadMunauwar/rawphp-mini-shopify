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
                    <div class="bg-white p-4 pb-10">

                        <?php if(has('error', QUERY))  { ?>
                            <div class="px-3 py-1 my-2 px-4 text-xs text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                        <?php } ?>

                        <?php if(has('success', QUERY))  { ?>
                            <div class="px-3 py-1 my-2 px-4 text-xs text-white bg-green-500"><?php echo get('success') ?? '' ?></div>
                        <?php } ?>


                                    
                        <h1 class="text-md font-semibold text-gray-600 mb-8">All Caurosel</h1>

                        <!-- Image Slider -->
                        <div class="mb-8">
                            <h2 class="text-sm font-semibold mb-4">Image Caurosel</h2>
                            <div id="" class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-4">

                                <?php if(has('imageCaurosel', $data)) { ?>

                                    <?php foreach($data['imageCaurosel'] ?? [] as $image) { ?>
                                        <div class="group relative">
                                            <a href="<?php echo $image['link'] ?? '' ?>">
                                                <img class="block rounded-md" src="<?php echo $image['image'] ?? '' ?>" alt="">
                                            </a>

                                            <form class="group-hover:block hidden absolute top-1 right-1" action="<?php route('store/caurosel/delete-image-caurosel') ?>" method="POST">
                                                <input name="image_caurosel_id" type="hidden" value="<?php echo $image['id'] ?? ''  ?>">
                                                <button class="text-red-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    <?php } ?>

                                <?php } else { ?>

                                    <span class="text-sm font-semibold text-center">No  Items !</span>

                                <?php } ?>


                            </div>
                            <form class="border flex gap-2 items-center p-4" action="<?php route('store/caurosel/add-image-caurosel') ?>" method="POST">
                                <div class="w-full md:w-3/4">
                                    <div class="mb-4">
                                        <label class="block mb-1  text-sm font-semibold" for="link">Link</label>
                                        <input name="link" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="link">
                                    </div>
                                    <div>
                                        <label class="block mb-1  text-sm font-semibold" for="imagePath">Image Path</label>
                                        <input name="image" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="imagePath">
                                    </div>

                                    <button class="text-xs mt-4 text-white py-1 px-3 bg-violet-500 font-semibold rounded-sm">Add</button>
                                </div>
                            </form> 
                        </div>


                        <!-- Image Slider -->
                        <div class="mb-8">
                            <h2 class="text-sm font-semibold mb-4">Image Banner</h2>
                            <div id="" class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-4">

                                <?php if(has('image_banner', $data)) { ?>

                                    
                                        <div class="col-span-3 group relative">
                                            <a href="<?php echo $data['image_banner']['banner_link'] ?? '' ?>">
                                                <img class="block rounded-md" src="<?php echo $data['image_banner']['image']  ?? '' ?>" alt="">
                                            </a>

                                            <form class="group-hover:block hidden absolute top-1 right-1" action="<?php route('store/caurosel/delete-image-banner') ?>" method="POST">
                                                <input name="banner_image_id" type="hidden" value="<?php echo $data['image_banner']['id'] ?? ''  ?>">
                                                <button class="text-red-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    

                                <?php } else { ?>

                                    <span class="text-sm font-semibold text-center">No  Items !</span>

                                <?php } ?>


                            </div>
                            <form class="border flex gap-2 items-center p-4" action="<?php route('store/caurosel/add-image-banner') ?>" method="POST">
                                <div class="w-full md:w-3/4">
                                    <div class="mb-4">
                                        <label class="block mb-1  text-sm font-semibold" for="linkBanner">Link</label>
                                        <input name="banner_image_link" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="linkBanner">
                                    </div>
                                    <div>
                                        <label class="block mb-1  text-sm font-semibold" for="bannerImagePath">Image Path</label>
                                        <input name="banner_image_path" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="bannerImagePath">
                                    </div>

                                    <button class="text-xs mt-4 text-white py-1 px-3 bg-violet-500 font-semibold rounded-sm">Add</button>
                                </div>
                            </form> 
                        </div>            


                        <!-- Featured Product Caurosel -->
                        <div>
                            <h2 class="text-sm font-semibold mb-4">Featured Product Caurosel</h2>
                            <!-- Featured Product Caurosel Items -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-6">
                                <!-- Single Product -->
                                <?php if( has('featuredProductCaurosel', $data)) { ?>
                                <?php foreach($data['featuredProductCaurosel'] ?? [] as $product) { ?> 
                                    <a href="<?php route("product-detail?p=" . $product['id']) ?>">
                                        <div class="p-2 border group">
                                            <div class="mb-3">
                                                <img class="rounded-lg object-cover aspect-square" src="<?php echo $product['thumbnail'] ?? '' ?>" alt="">
                                            </div>
                                            <div>
                                                <h2 class="mb-1 text-sm md:text-md font-semibold text-gray-800">New Arrivals</h2>
                                                <div class="flex justify-between">
                                                    <p class="text-xs md:text-xs text-themePrimaryLight md:font-bold mb-2">TK <?php echo $product['unit_price'] ?? '' ?> </p>
                                                    <form class="hidden group-hover:block" action="<?php route('store/caurosel/delete-featured-product-caurosel-item') ?>" method="POST">
                                                        <input name="product_id" type="hidden" value="<?php echo $product['id'] ?? ''  ?>">
                                                        <button class="text-red-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php }} else { ?>
                                    <span class="text-sm font-semibold text-center">No  Items !</span>
                                <?php  } ?>

                                </div>
                            
                            <form class="border p-4" action="<?php route('store/caurosel/add-featured-product-caurosel-item') ?>" method="POST">
                                <div>
                                    <label class="block mb-1  text-sm font-semibold" for="productId">ProductID</label>
                                    <input name="product_id" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="productId">
                                 </div>

                                 <button class="text-xs mt-4 text-white py-1 px-3 bg-violet-500 font-semibold rounded-sm">Add</button>
                            </form>
                        </div>
                    </div>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>


<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>