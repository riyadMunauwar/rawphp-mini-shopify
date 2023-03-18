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
                    <section class="pb-10 bg-white p-4 text-lg font-semibold">

                    <?php if(has('error', QUERY))  { ?>
                        <div class="px-3 py-1 mb-2 px-4 text-xs text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                    <?php } ?>

                    <?php if(has('success', QUERY))  { ?>
                        <div class="px-3 py-1 mb-2 px-4 text-xs text-white bg-green-500"><?php echo get('success') ?? '' ?></div>
                    <?php } ?>

                        <div class="flex justify-between">
                            <h1>Add Script</h1>
                            <?php if($data['init'] ?? null) { ?>
                                <a class="self-start py-1 px-3 bg-indigo-400 text-white text-xs rounded-sm" href="<?php route('store/script/init?store-id=' . STORE_ID) ?>">Init Script</a>
                            <?php } ?>
                        </div>

                        <form action="<?php route('store/script/save') ?>" method="POST">
                            <input type="hidden" name="script_id" value="<?php echo $data['script']['id'] ?? '' ?>">
                            <div class="mt-8">
                                <label class="block text-sm" for="script">Script</label>
                                <textarea placeholder="<script></script>" class="text-sm border focus:outline-0 focus:border border-indigo-400 p-2 w-full mt-4" name="script" id="script" cols="30" rows="20"><?php echo $data['script']['script'] ?? '' ?></textarea>
                            </div>

                            <div class="flex justify-end mt-2">
                                <button class="py-1 px-3 text-sm font-semibold bg-indigo-400 text-white rounded-sm">Save</button>
                            </div>
                        </form>
                    </section>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>