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
            

            <!-- Add Category Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                <div class="rounded-lg">
                      <section class="max-w-full p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">

                       <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Create Category</h2>
          
                       <?php foreach($data['errors'] ?? [] as $error) { ?>

                          <div class="bg-red-400 py-2 rounded-md px-4 text-white rounded-mds my-2">
                            <?php echo $error;  ?>
                          </div>

                        <?php } ?>

                        <?php if( has('message', $data)) { ?>
                            
                            <div class="bg-green-400 py-2 rounded-md px-4 text-white rounded-mds my-2">
                            <?php echo $data['message'] ?? '';  ?>
                            </div>

                        <?php } ?>


                        
                        <?php if( has('message-yellow', $data)) { ?>
                            
                            <div class="bg-amber-400 py-2 rounded-md px-4 text-white rounded-mds my-2">
                            <?php echo $data['message-yellow'] ?? '';  ?>
                            </div>

                        <?php } ?>


                        <form action="<?php route('store/add-category') ?>" method="POST">
                              <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">


                                  <div>
                                      <label class="text-gray-700 dark:text-gray-200" for="categoryname">Category Name*</label>
                                      <input name="name" id="categoryname" value="<?php echo $data['formData']['name'] ?? '' ?>" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                  </div>

                                  <div>
                                      <label class="text-gray-700 dark:text-gray-200" for="slug">Slug</label>
                                      <input  name="slug" id="slug" value="<?php echo $data['formData']['slug'] ?? '' ?>" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                  </div>

                                  <div>
                                      <label class="text-gray-700 dark:text-gray-200" for="parent-category">Parent Category</label>                               
                                      <select  name="parent_id" id="parent-category" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                          <option value="">None</option>
                                      <?php foreach( $data['categories'] ?? [] as $category ) { ?>
                                         <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                      <?php  } ?> 

                                      </select>

                                   </div>

                                  <div>
                                      <label class="text-gray-700 dark:text-gray-200" for="thumbnail">Thumbnail URL</label>
                                      <input name="thumbnail" id="thumbnail" value="<?php echo $data['formData']['thumbnail'] ?? '' ?>" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                  </div>

                                  <div class="w-full mt-4">
                                      <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Description</label>
                                      <textarea id="editor" name="description"  class="block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                        <?php echo $data['formData']['description'] ?? '' ?>
                                      </textarea>
                                  </div>
                              </div>

                              <div class="flex justify-end mt-6">
                                  <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-themeSecondaryLight rounded-md hover:bg-themeSecondaryDark focus:outline-none focus:bg-gray-600">Create</button>
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










