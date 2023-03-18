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
                    <section class="bg-white p-5">

                        <?php if(has('error', QUERY))  { ?>
                            <div class="py-4 py-2 mb-2 px-4 text-white bg-red-400"><?php echo get('error') ?? '' ?></div>
                        <?php } ?>

                        <?php if(has('success', QUERY))  { ?>
                            <div class="py-4 py-2 mb-2 px-4 text-white bg-green-400"><?php echo get('success') ?? '' ?></div>
                        <?php } ?>


                        <div>
                            <h1 class="text-lg font-semibold mb-8">Create Page</h1>
                            <form action="<?php route('store/add-page') ?>" method="POST" >
                                <div>
                                    <label class="block" for="name">Name</label>
                                    <input name="name" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="name" type="text">
                                </div>
                                <div class="mt-5">
                                    <label class="block" for="title">Title</label>
                                    <input name="title" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="title" type="text">
                                </div>
                                <div class="mt-8">
                                    <textarea name="content" id="editor" cols="30" rows="10"></textarea>                                 
                                </div>

                                <div class="mt-8 flex justify-end">
                                    <button class="py-1 px-4 bg-indigo-500 text-white text-sm font-semibold">Create</button>
                                </div>
                            </form>
                        </div>
                        
                    </section>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>
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