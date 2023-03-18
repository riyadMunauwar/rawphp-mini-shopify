<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>


<section class="md:mt-4 bg-white md:pb-10">
    <div class="container mx-auto  p-4">
        <h2 class="text-lg text-gray-600 font-semibold mb-4"><?php echo $data['currentChild']['name'] ?? '' ?></h2>

        <div class="grid grid-cols-3 md:grid-cols-6 gap-2 md:gap-4">
            <?php foreach($data['childCategories'] ?? [] as $childCat) { ?>
                <a href="<?php route('category?c=' . $childCat['id']) ?>">
                    <div class="border p-5 md:p-0 rounded-md aspect-square flex flex-col items-center justify-center">

                        <div class="flex items-center justify-center ">
                            <img class="block md:w-3/5 object-cover" src="<?php echo $childCat['thumbnail'] ?? ''  ?>" alt="">
                        </div>
                        <h2 class="text-xs md:text-sm md:font-semibold text-center mt-1 md:mt-3"><?php echo $childCat['name'] ?? ''  ?></h2>
                        
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</section>



<?php include_once VIEWS . 'partials/featuredProductCauroselSection.php'; ?>


<?php include_once VIEWS . 'partials/popularProductSection.php'; ?>



<?php include_once VIEWS . 'partials/footer.php'; ?>