<?php include_once VIEWS . 'store/partials/storeHeaderSection.php'; ?>



<main class="bg-gray-100 dark:bg-gray-800 md:h-screen md:overflow-hidden  relative">
    <div class="md:flex items-start justify-between">

        <!-- SideBar -->
        <div class="md:h-screen lg:block md:my-4 md:ml-4 shadow-lg relative w-full md:w-80">
            <!-- Navigation bar -->
            <?php include_once VIEWS . 'store/partials/storeSideNavigationSectionTwo.php'; ?>
        </div>

        <?php
            $images = $data['images'] ?? [];
        ?>

        <!-- Right Side Of  -->
        <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">

            <!-- Header -->
            <?php include_once VIEWS . 'store/partials/storeHeaderSectionTwo.php'; ?>

            <!-- store Dashboard Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                    <section class="bg-white">
                        <div class="container px-5 py-5">
                            <!-- ERROR MESSAGE -->
                            <?php if(has('error', QUERY)) { ?>
                                <div class="py-2 px-3 bg-red-500 text-white">
                                    <?php echo queryMessage(get('error')) ?>
                                </div>
                            <?php } ?>
                            <!-- SUCCESS MESSAGE -->
                            <?php if(has('success', QUERY)) { ?>
                                <div class="py-2 px-3 bg-green-500 text-white">
                                    <?php echo queryMessage(get('success')) ?>
                                </div>
                            <?php } ?>
                            <!-- Media Upload Form -->
                            <div class="mb-4">
                                <!-- Preview Image Before Upload -->
                                <div id="preview-container" class="grid grid-cols-5 gap-3 mb-3">
                                  
                                </div>
                                <form class="flex" action="<?php route('store/add-media') ?>" method="POST" enctype="multipart/form-data" >
                                    <input id="upload-btn" name="files[]" class="hidden" type="file" multiple>
                                    <div id="virutal-upload-btn" class="border-dashed border-4 text-red-400 w-1/5 cursor-pointer border p-4 aspect-square flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-1/2 h-1/2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                    </div>
                                    <button class="bg-indigo-600 text-white self-center py-2 px-6 ml-4">Upload</button>
                                </form>
                            </div>
                            <!-- Wrapper Media -->
                            <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
                                <!-- Single Media -->
                                <?php foreach($images as $image) { ?>
                                <div class="border bg-white relative group">
                                    <div class="overflow-hidden">
                                        <img class="group-hover:scale-125 transition-all block w-full aspect-square" src="<?php route($image['src']) ?>" alt="">
                                    </div>
                                    <div class="flex flex-col transition-all group-hover:block group-hover:flex group-hover:justify-center group-hover:items-center hidden bg-black opacity-50 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                        <span data-src="<?php echo $image['src'] ?>" id="copy-url-btn" class="border py-2 px-6 text-xs text-white cursor-pointer">Copy</span>
                                        <a class="mt-3 border py-2 px-6 text-xs text-white cursor-pointer" href="<?php route("store/delete-media?image-id=" . $image['id']) ?>">Delete</a>
                                    </div>
                                    
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                <!-- Content End -->
                            <!-- Pagination -->
                            <?php 
                            
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

                            
                            $prevPageRoute = BASE_PATH . "store/media?page={$prevPageId}";
                            $nextPageRoute = BASE_PATH . "store/media?page={$nextPageId}";
                        

                            
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
                                                        <a href="<?php route("store/media?page={$i}") ?>" class="<?php echo $i == $data['pagination']['current_page'] ? 'bg-blue-500 text-white ' : '' ?> hidden px-2 py-1 mx-1 text-black border transition-colors duration-200 transform bg-white rounded-md sm:inline text-xs dark:bg-gray-900 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200  ">
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
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>


<script defer>
    (function(){
        var allCopyUrlBtn = Array.from(document.querySelectorAll('#copy-url-btn'));

        function copyUrlHandeler(event){

            var text = this.dataset.src;
            var el = this;
            

            // on copy success
            function onCopySuccess(){
                el.innerText = 'copied';
            }

            // on copy failed
            function onCopyFailed(){
                el.innerText = 'falied';
            }

            navigator.clipboard.writeText(text).then(onCopySuccess, onCopyFailed);
        }

        allCopyUrlBtn.forEach(btn => btn.addEventListener('click', copyUrlHandeler));

    })()
</script>

<script defer>
    // Image Upload
    (function(){

        var uploadBtn = document.getElementById('upload-btn');
        var virtualUploadBtn = document.getElementById('virutal-upload-btn');
        var preveiewContainer = document.getElementById('preview-container');

        virtualUploadBtn.addEventListener('click', function(){
            uploadBtn.click();
        })


        function createImage(src){
            return `<img class="block w-full aspect-square border object-cover" src="${src}" >`;
        }

        function fileToUrl(file){
            return URL.createObjectURL(file)
        }


        function onFileSelect(event){
            var files = Array.from(event.target.files);
            var markup = '';

            files.forEach(file => {
                markup += createImage(fileToUrl(file))
            })

            preveiewContainer.innerHTML = markup;

        }

        uploadBtn.addEventListener('change', onFileSelect);


    })()
</script>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>