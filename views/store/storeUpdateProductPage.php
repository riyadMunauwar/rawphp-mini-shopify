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
                
            <?php 

                $product = $data['product'] ?? [];
                $categories = $data['categories'] ?? [];
                $brands = $data['brands'] ?? [];
                $variation = $product['variation'] ?? [];
                $thisProductBrand = $data['thisProductBrand'] ?? '';
                $thisProductCategory = $data['thisProductCategory'] ?? '';

            ?>
            <!-- store Update Product Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                <div class="bg-white px-4 py-8">
                    <?php if(has('error', QUERY))  { ?>
                        <div class="px-3 py-1 my-2 px-4 text-xs text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                    <?php } ?>

                    <?php if(has('success', QUERY))  { ?>
                        <div class="px-3 py-1 my-2 px-4 text-xs text-white bg-green-500"><?php echo get('success') ?? '' ?></div>
                    <?php } ?>

                    <h2 class="text-sm font-semibold mb-4">Edit product</h2>

                    <div>
                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="pname">Product Name</label>
                                       
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="name" value="<?php echo $product['name'] ?? '' ?>" id="pname" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="slug">Product Slug</label>
                                       
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="slug" value="<?php echo $product['slug'] ?? '' ?>" id="slug" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="unitPrice">Unit Price</label>
                                       
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="unit_price" value="<?php echo $product['unit_price'] ?? '' ?>" id="unitPrice" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="number">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="purshasePrice">Purchase Price</label>
                                       
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="purchase_price" value="<?php echo $product['purchase_price'] ?? '' ?>" id="purshasePrice" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="number">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="discount">Discount (%)</label>
                                       
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="discount" value="<?php echo $product['discount'] ?? '' ?>" id="discount" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="number">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="stock_quantity">Stock Quantity</label>
                                       
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="stock_quantity" value="<?php echo $product['stock_quantity'] ?? '' ?>" id="stock_quantity" class="w-4/5 md:w-2/3  md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="number">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="thumbnail">Thumbnail</label>
                                        <div class="mb-3">
                                            <img class="aspect-square object-cover md:w-2/5 w-4/5" src="<?php echo $product['thumbnail'] ?? '' ?>" alt="">
                                        </div>
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="thumbnail" value="" id="thumbnail" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="video_url">Video Url</label>
                                        <!-- <div class="mb-3">
                                            <img class="aspect-square object-cover md:w-2/5 w-4/5" src="" alt="">
                                        </div> -->
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input name="video_url" value="<?php echo $product['video_url'] ?? '' ?>" id="video_url" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0" type="text">
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="short_description">Short Description</label>
                                       
                                       <div class="">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <textarea class="" name="short_description" id="short_description"><?php echo $product['short_description'] ?? '' ?></textarea>
                                            <button class="mt-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <label class="text-sm block font-semibold mb-2" for="description">Description</label>
                                       
                                       <div class="">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <textarea name="description" class="" id="description"><?php echo $product['description'] ?? '' ?></textarea>
                                            <button class="mt-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <div class="flex items-center gap-3 mb-2">
                                            <label class="text-sm block font-semibold" for="brand">Brand</label>
                                            <span class="bg-blue-400 text-white py-1 px-3 md:text-xs font-semibold rounded-md"><?php echo $thisProductBrand['name']; ?></span>
                                        </div>
                                       
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <select name="brand_id"  id="brand" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0">
                                                <?php foreach($brands  as $brand) { ?>
                                                    <option value="<?php echo $brand['id'] ?? '' ?>"><?php echo $brand['name'] ?? '' ?></option>
                                                <?php } ?>
                                            </select>
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>

                            <form action="<?php route('store/product/update') ?>" method="POST">
                                <div class="mb-8">
                                    <div>
                                        <div class="flex items-center gap-3 mb-2">
                                            <label class="text-sm block font-semibold" for="category">Category</label>
                                            <span class="bg-blue-400 text-white py-1 px-3 md:text-xs font-semibold rounded-md"><?php echo $thisProductCategory['name']; ?></span>
                                        </div>
                                       <div class="flex items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                            <input type="hidden" name="old_category_id" value="<?php echo $thisProductCategory['id'] ?? '' ?>">
                                            <select name="category_id" id="category" class="w-4/5 md:text-base md:w-2/3   text-xs  py-1 px-2 border focus:outline-0">
                                                <?php foreach($categories  as $category) { ?>
                                                    <option selected="<?php $thisProductBrand['id'] === $brand['id'] ? 'true' : 'false' ?>" value="<?php echo $category['id'] ?? '' ?>"><?php echo $category['name'] ?? '' ?></option>
                                                <?php } ?>
                                            </select>
                                            <button class="ml-3 py-1 px-3 bg-violet-400 text-xs text-white">Save</button>
                                       </div> 
                                    </div>
                                    
                                </div>   
                            </form>



                            <!-- Product Variation -->
                            <div>
                                <h2 class="font-semibold text-md">Product Variant</h2>
                            <?php foreach($variation as $variant) { ?>
                                <form class="border flex gap-2 items-center p-4 mt-5" action="<?php route('store/product/variant-update') ?>" method="POST">
                                    <div class="w-full md:w-3/4">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                        <input type="hidden" name="variant_id" value="<?php echo $variant['id'] ?? '' ?>">
                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="photo">Photo</label>
                                            <input name="photo" value="<?php echo $variant['photo'] ?? '' ?>" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="photo">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="size">Size</label>
                                            <input name="size" value="<?php echo $variant['size'] ?? '' ?>" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="size">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="color">Color</label>
                                            <input name="color" value="<?php echo $variant['color'] ?? '' ?>" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="color">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="color_code">Color Code</label>
                                            <input name="color_code" value="<?php echo $variant['color_code'] ?? '' ?>" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="color_code">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="weight">Weight</label>
                                            <input name="weight" value="<?php echo $variant['weight'] ?? '' ?>" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="weight">
                                        </div>

                                        <div class="mb-2">
                                            <label class="block mb-1  text-sm font-semibold" for="stock_quantity">Stock Quantity</label>
                                            <input name="stock_quantity" value="<?php echo $variant['stock_quantity'] ?? '' ?>" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="stock_quantity">
                                        </div>

                                

                                        <button class="text-xs mt-4 text-white py-1 px-3 bg-violet-500 font-semibold rounded-sm">Save</button>
                                    </div>
                                </form> 
                            <?php } ?>

                                <form class="border flex gap-2 items-center p-4 mt-5" action="<?php route('store/product/variant-add-via-edit') ?>" method="POST">
                                    <div class="w-full md:w-3/4">
                                        <h2 class="text-md font-semibold text-blue-500">Add New Variant</h2>
                                        <input type="hidden" name="product_id" value="<?php echo $product['id'] ?? '' ?>">
                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="photo">Photo</label>
                                            <input name="photo" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="photo">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="size">Size</label>
                                            <input name="size" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="size">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="color">Color</label>
                                            <input name="color" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="color">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="color_code">Color Code</label>
                                            <input name="color_code" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="color_code">
                                        </div>

                                        <div class="mb-4">
                                            <label class="block mb-1  text-sm font-semibold" for="weight">Weight</label>
                                            <input name="weight" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="weight">
                                        </div>

                                        <div class="mb-2">
                                            <label class="block mb-1  text-sm font-semibold" for="stock_quantity">Stock Quantity</label>
                                            <input name="stock_quantity" class="border py-1 px-2 w-full  focus:border focus:border-gray-900 focus:outline-0" type="text" id="stock_quantity">
                                        </div>

                                

                                        <button class="text-xs mt-4 text-white py-1 px-3 bg-violet-500 font-semibold rounded-sm">Add</button>
                                    </div>
                                </form> 
                            </div>

                          
                    </div>


                </div>
                <!-- Content End -->
            </div>
            <!-- store Update Product Category Page Content  End-->
        </div>
    </div>
    
<style>    
.ck-editor__editable[role="textbox"] {
    /* editing area */
    min-height: 300px;
}
.ck-content .image {
    /* block images */
    max-width: 80%;
    margin: 20px auto;
}

</style>
<script src="<?php route('assets/js/ckeditor/ckeditor.js') ?>"></script>
<script >
        ClassicEditor
            .create( document.querySelector( '#short_description' ), {
                toolbar: {
                    items: [
                        // 'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        // 'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    // shouldNotGroupWhenFull: true
                },
      
            } )
            .catch( error => {
                console.error( error );
            } );

            ClassicEditor
            .create( document.querySelector( '#description' ), {
                toolbar: {
                    items: [
                        // 'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        // 'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    // shouldNotGroupWhenFull: true
                },
      
            } )
            .catch( error => {
                console.error( error );
            } );
</script>
</script>
</main>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>