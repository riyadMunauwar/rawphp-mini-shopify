<?php include_once VIEWS . 'store/partials/storeHeaderSection.php'; ?>

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
            

            <!-- Add Category Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                <div class="rounded-lg">
                      <section class="max-w-full p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">

                       <?php if(has('error', QUERY))  { ?>
                            <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                        <?php } ?>

                        <?php if(has('success', QUERY))  { ?>
                            <div class="px-3 py-1 mb-4 px-4 text-xs text-white bg-green-500"><?php echo get('success') ?? '' ?></div>
                        <?php } ?>
                        
                       <h2 class="text-md font-semibold text-gray-700 capitalize dark:text-white">Update Category</h2>

                            <?php
                            
                            $category = $data['category'] ?? [];
                            $categories = $data['categories'] ?? [];


                           function parent($id, $all){
                                    if($id){
                                        foreach($all as $single){
                                            if($single['id'] === $id){
                                                return $single;
                                            }
                                        }
                                    }
                                    else{
                                        return null;
                                    }
                            }

                            $parentCategory = parent($category['parent_id'], $categories);

                            $parentCategoryName = $parentCategory ? $parentCategory['name'] : 'None Parent';
                            $parentCategoryId = $parentCategory ? $parentCategory['id'] : '';

                            
                            ?>

                        <form action="<?php route('store/update-category') ?>" method="POST">
                              <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">

                                <input type="hidden" name="category_id" value="<?php echo $category['id'] ?? '' ?>">
                                  <div>
                                      <label class="text-gray-700 dark:text-gray-200" for="categoryname">Category Name</label>
                                      <input name="name" id="categoryname" value="<?php echo $category['name'] ?? '' ?>" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                  </div>

                                  <div>
                                      <label class="text-gray-700 dark:text-gray-200" for="slug">Slug</label>
                                      <input  name="slug" id="slug" value="<?php echo $category['slug'] ?? '' ?>" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                  </div>

                                  <div>
                                      <label class="text-gray-700 dark:text-gray-200" for="parent-category">Parent Category</label>    
                                      <span class="bg-gray-500 text-xs py-1 px-2 rounded-md font-semibold text-white"><?php echo $parentCategoryName ?></span>                           
                                      <select  name="parent_id" id="parent-category" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                          <option value="<?php echo $parentCategoryId  ?>"><?php echo $parentCategoryName ?></option>
                                      <?php foreach( $categories ?? [] as $cat ) { ?>
                                         <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                      <?php  } ?> 
                                        <option value="">None Parent</option>

                                      </select>

                                   </div>

                                  <div class="flex items-center gap-2">
                                      <div class="w-4/5">
                                        <label class="text-gray-700 dark:text-gray-200" for="thumbnail">Thumbnail URL</label>
                                        <input name="thumbnail" id="thumbnail" value="<?php echo $category['thumbnail'] ?? '' ?>" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                      </div>
                                      <div class="w-1/5">
                                        <img src="<?php echo $category['thumbnail'] ?? '' ?>" class="block width-full" alt="">
                                      </div>
                                  </div>

                                  <div class="w-full mt-4">
                                      <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Description</label>
                                      <textarea id="editor" name="description"  class="block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                        <?php echo $category['description'] ?? '' ?>
                                      </textarea>
                                  </div>
                              </div>

                              <div class="flex justify-end mt-6">
                                  <button class="px-4 py-1 leading-5 text-white text-sm transition-colors duration-200 transform bg-themeSecondaryLight rounded-md hover:bg-themeSecondaryDark focus:outline-none focus:bg-gray-600">Update</button>
                              </div>
                          </form>
                        </section>
                    </div>
                <!-- Content End -->
            </div>
            <!-- Add Category Page Content  End-->

        

        </div>
    </div>
</main>
<script src="<?php route('assets/js/ckeditor/ckeditor.js') ?>"></script>
<script >
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
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

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>










