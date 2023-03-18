<?php include_once VIEWS . 'store/partials/storeHeaderSection.php'; ?>


<?php

    $footer = $data['footer'] ?? [];

?>

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
                            <div class="flex justify-between">
                                <h1 class="text-lg font-semibold mb-8">Footer</h1>
                                <?php if($data['init'] ?? null) { ?>
                                    <a href="<?php route('store/footer/init?store-id=' . STORE_ID) ?>" class="py-1 px-4 text-white self-start font-medium text-xs bg-indigo-500" >Init Footer</a>
                                <?php } ?>
                            </div>

                            <form action="<?php route('store/update-footer') ?>" method="POST" >

                                <!-- Section A -->
                                <div>
                                    <h1 class="text-lg font-semibold mb-8">Section A</h1>

                                    <div class="mt-5">
                                        <label class="block" for="title-a">Title</label>
                                        <input value="<?php echo $footer['title_a'] ?? '' ?>" name="title_a" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="title-a" type="text">
                                    </div>
                                    <div class="mt-8">
                                        <textarea name="content_a" id="editorA" cols="30" rows="10"><?php echo $footer['content_a'] ?? '' ?></textarea>                                 
                                    </div>

                                </div>

                                <!-- Section B -->
                                <div class="mt-8">
                                    <h1 class="text-lg font-semibold mb-8">Section B</h1>

                                    <div class="mt-5">
                                        <label class="block" for="title-b">Title</label>
                                        <input value="<?php echo $footer['title_b'] ?? '' ?>" name="title_b" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="title-b" type="text">
                                    </div>
                                    <div class="mt-8">
                                        <textarea name="content_b" id="editorB" cols="30" rows="10"><?php echo $footer['content_b'] ?? '' ?></textarea>                                 
                                    </div>

                                </div>

                                <!-- Section C -->
                                <div class="mt-8">
                                    <h1 class="text-lg font-semibold mb-8">Section C</h1>

                                    <div class="mt-5">
                                        <label class="block" for="title_c">Title</label>
                                        <input value="<?php echo $footer['title_c'] ?? '' ?>" name="title_c" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="title-c" type="text">
                                    </div>
                                    <div class="mt-8">
                                        <textarea name="content_c" id="editorC" cols="30" rows="10"><?php echo $footer['content_c'] ?? '' ?></textarea>                                 
                                    </div>

                                </div>
                                
                                <!-- Section D -->
                                <div class="mt-8">
                                    <h1 class="text-lg font-semibold mb-8">Section D</h1>

                                    <div class="mt-5">
                                        <label class="block" for="title-d">Title</label>
                                        <input value="<?php echo $footer['title_d'] ?? '' ?>" name="title_d" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="title-d" type="text">
                                    </div>
                                    <div class="mt-8">
                                        <textarea name="content_d" id="editorD" cols="30" rows="10"><?php echo $footer['content_d'] ?? '' ?></textarea>                                 
                                    </div>
                                </div>
                                
                                <!-- Section D -->
                                <div class="mt-8">
                                    <h1 class="text-lg font-semibold mb-8">Footer Social Button</h1>

                                    <div class="mt-5">
                                        <label class="block" for="bottom_text">Footer Bottom Text</label>
                                        <input value="<?php echo $footer['bottom_text'] ?? '' ?>" name="bottom_text" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="bottom_text" type="text">
                                    </div>
                                    <div class="mt-5">
                                        <label class="block" for="facebook_link">Facebook page</label>
                                        <input value="<?php echo $footer['facebook_link'] ?? '' ?>" name="facebook_link" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="facebook_link" type="text">
                                    </div>
                                    <div class="mt-5">
                                        <label class="block" for="youtube_link">Youtube Channel</label>
                                        <input value="<?php echo $footer['youtube_link'] ?? '' ?>" name="youtube_link" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="youtube_link" type="text">
                                    </div>
                                    <div class="mt-5">
                                        <label class="block" for="instragram_link">Instragram</label>
                                        <input value="<?php echo $footer['instragram_link'] ?? '' ?>" name="instragram_link" class="mt-2 border w-full py-2 px-4 focus:outline-0 focus:border-gray-900" id="instragram_link" type="text">
                                    </div>

                                    <div class="mt-8 flex justify-end">
                                        <button class="py-1 px-4 bg-indigo-500 text-white text-sm font-semibold">Update</button>
                                    </div>
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

        var config = {
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
      
            }

        ClassicEditor.create( document.querySelector( '#editorA' ), config ) .catch( error => console.log(error));
        ClassicEditor.create( document.querySelector( '#editorB' ), config ) .catch( error => console.log(error));
        ClassicEditor.create( document.querySelector( '#editorC' ), config ) .catch( error => console.log(error));
        ClassicEditor.create( document.querySelector( '#editorD' ), config ) .catch( error => console.log(error));


</script>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>