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
                    <div class="bg-white p-3 pt-4">

                            <?php if(has('error', QUERY))  { ?>
                                <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                            <?php } ?>

                            <?php if(has('success', QUERY))  { ?>
                                <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-green-500"><?php echo get('success') ?? '' ?></div>
                            <?php } ?>

                            <?php
                                $store = $data['store'] ?? NULL;
                            ?>
                        <div>
                            
                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="storename">Store Name</label>
                                       
                                       <div class="flex items-center">
                                            <input name="name" value="<?php echo $store['name'] ?? '' ?>" id="storename" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>


                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="title">Store Title</label>
                                       
                                       <div class="flex items-center">
                                            <input name="title" value="<?php echo $store['title'] ?? '' ?>" id="title" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>
                            
                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="description">Store Description</label>
                                       
                                       <div class="flex items-center">
                                            <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Store description"><?php echo $store['description'] ?? '' ?></textarea>
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="storeemail">Store Email</label>
                                       
                                       <div class="flex items-center">
                                            <input name="email" value="<?php echo $store['email'] ?? '' ?>" id="storeemail" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>


                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="storelogo">Store Logo</label>
                                        <div>
                                            <img class="block max-h-10 py-2" src="<?php echo $store['logo'] ?? '' ?>" alt="">
                                        </div>
                                       <div class="flex items-center">
                                            <input placeholder="Path" name="logo" value="<?php echo $store['logo'] ?? '' ?>" id="storelogo" class="w-4/5 md:text-base md:w-2/3 text-xs   py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="">
                                    <div class="mb-2">
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="oldPass">Change Password (Old)</label>
                                       
                                       <div class="flex items-center">
                                            <input name="old_password" placeholder="old" id="oldPass" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="password">
                                       </div> 
                                    </div>
                                    <div class="mb-2">
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="newpass">New Password</label>
                                       
                                       <div class="flex items-center">
                                            <input name="new_password" placeholder="New" id="newpass" class="w-4/5 md:w-2/3 md:text-base    text-xs  py-1 px-2 border focus:outline-0" type="password">
                                       </div> 
                                    </div>
                                    <div class="mb-8">
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="confirm_password">Re Type (Confirm)</label>
                                       
                                       <div class="flex items-center">
                                            <input name="confirm_password" placeholder="Confirm"   id="confirm_password" class="w-4/5 md:text-base md:w-2/3 text-xs py-1 px-2 border focus:outline-0" type="password">
                                            <button class="ml-3 py-1 px-3  text-xs bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="favicon">Store Favicon</label>
                                        <div>
                                            <img class="block max-h-10 py-2" src="<?php echo $store['favicon'] ?? '' ?>" alt="">
                                        </div>
                                       <div class="flex items-center">
                                            <input placeholder="Path" name="favicon" value="<?php echo $store['favicon'] ?? '' ?>" id="favicon" class="w-4/5 md:text-base md:w-2/3 text-xs py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <div class="mb-8">
                                <h2 class="text-blue-500 mb-3 text-sm font-semibold">Shipping Cost</h2>
                                <div class="mb-4">
                                    <?php foreach($data['shipping_costs'] ?? [] as $shipping_cost) { ?>
                                        <div class="border w-4/5 md:w-2/3 mb-3  border-violet-500 py-2 px-3 flex gap-3">
                                            <h2 class="text-violet-500  text-sm font-semibold"><?php echo $shipping_cost['title'] ?? '' ?></h2>
                                            <h2 class="text-violet-500  text-sm font-semibold">Tk <?php echo $shipping_cost['cost_amount'] ?? '' ?></h2>
                                            <h2 class="ml-auto text-violet-500  text-sm font-semibold">
                                                <form action="<?php route('store/setting/delete-shipping-cost') ?>" method="POST">
                                                    <input type="hidden" name="shipping_cost_id" value="<?php echo $shipping_cost['id'] ?? '' ?>">
                                                    <button class="text-red-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </h2>

                                        </div>
                                    <?php } ?>

                                    <?php if( ! ( $data['shipping_costs'] ?? NULL )) { ?>
                                        <h2 class="text-xs font-semibold">No Shipping Cost Added</h2>
                                    <?php } ?>
                                </div>
                                <form class="border flex gap-2 items-center p-4" action="<?php route('store/setting/add-shipping-cost') ?>" method="POST">
                                    <div class="w-full md:w-3/4">
                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="rangeTitle">Range Title</label>
                                            <input name="range_title" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="rangeTitle">
                                        </div>
                                        <div>
                                            <label class="block mb-1  text-sm font-semibold" for="cost">Cost</label>
                                            <input name="cost_amount" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="number" id="cost">
                                        </div>

                                        <button class="text-xs mt-4 text-white py-1 px-3 bg-violet-500 font-semibold rounded-sm">Add</button>
                                    </div>
                                </form> 
                            </div>

                            <div class="mb-8">
                                <h2 class="text-blue-500 mb-3 text-sm font-semibold">Shipper</h2>
                                <div class="mb-4">
                                    <?php foreach($data['shippers'] ?? [] as $shipper) { ?>
                                        <div class="border w-4/5 md:w-2/3 mb-3  border-indigo-500 py-2 px-3 flex items-center gap-3">
                                            <h2 class="text-violet-500  text-sm font-semibold">
                                                <img class="block" src="<?php echo $shipper['logo'] ?? '' ?>" alt="">
                                            </h2>
                                            <h2 class="text-indigo-500  text-sm font-semibold"><?php echo $shipper['name'] ?? '' ?></h2>
                                            <h2 class="ml-auto text-violet-500  text-sm font-semibold">
                                                <form action="<?php route('store/setting/delete-shipper') ?>" method="POST">
                                                    <input type="hidden" name="shipper_id" value="<?php echo $shipper['id'] ?? '' ?>">
                                                    <button class="text-red-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </h2>

                                        </div>
                                    <?php } ?>

                                    <?php if( ! ( $data['shippers'] ?? NULL )) { ?>
                                        <h2 class="text-xs font-semibold">No shipper add yet</h2>
                                    <?php } ?>
                                </div>
                                <form class="border flex gap-2 items-center p-4" action="<?php route('store/setting/add-shipper') ?>" method="POST">
                                    <div class="w-full md:w-3/4">
                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="shipper_name">name*</label>
                                            <input name="name" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="shipper_name">
                                        </div>
                                        <div>
                                            <label class="block mb-1  text-sm font-semibold" for="logo">Logo</label>
                                            <input name="logo" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="logo">
                                        </div>

                                        <button class="text-xs mt-4 text-white py-1 px-3 bg-violet-500 font-semibold rounded-sm">Add</button>
                                    </div>
                                </form> 
                            </div>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="">Image Caurosel</label>
                                       
                                       <div class="flex items-center">
                                            <input placeholder="Path" name="image_caurosel" value="1" id="" class="w-4/5 md:text-base md:w-2/3 text-xs py-1 px-2 border focus:outline-0" type="hidden">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white"><?php echo $store['image_caurosel'] ? 'Actived' : 'Deactived'  ?></button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="">Selling Feature Banner</label>
                                       
                                       <div class="flex items-center">
                                            <input placeholder="Path" name="selling_feature_banner" value="1" id="" class="w-4/5 md:text-base md:w-2/3 text-xs py-1 px-2 border focus:outline-0" type="hidden">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white"><?php echo $store['selling_feature_banner'] ? 'Actived' : 'Deactived'  ?></button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="">Image Banner</label>
                                       
                                       <div class="flex items-center">
                                            <input placeholder="Path" name="image_banner" value="1" id="" class="w-4/5 md:text-base md:w-2/3 text-xs py-1 px-2 border focus:outline-0" type="hidden">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white"><?php echo $store['image_banner'] ? 'Actived' : 'Deactived'  ?></button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="">Featured Product Caurosel</label>
                                       
                                       <div class="flex items-center">
                                            <input placeholder="Path" name="featured_product_caurosel" value="1" id="favicon" class="w-4/5 md:text-base md:w-2/3 text-xs py-1 px-2 border focus:outline-0" type="hidden">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white"><?php echo $store['featured_product_caurosel'] ? 'Actived' : 'Deactived'  ?></button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/setting/update-store-info') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-blue-500 text-sm block font-semibold mb-2" for="favicon">Brand Caurosel</label>
                                       
                                       <div class="flex items-center">
                                            <input placeholder="Path" name="brand_caurosel" value="1" id="favicon" class="w-4/5 md:text-base md:w-2/3 text-xs py-1 px-2 border focus:outline-0" type="hidden">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white"><?php echo $store['brand_caurosel'] ? 'Actived' : 'Deactived'  ?></button>
                                       </div> 
                                    </div>
                                    
                                </div>   
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