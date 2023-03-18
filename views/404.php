<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>

<!-- Message Section -->
<section>
    <div class="container bg-white py-5 md:my-4 mx-auto">

        <div class="flex flex-col justify-center items-center">
            <div class="w-4/5 md:w-2/5" >
                <img class="block w-full " src="https://cdn-icons-png.flaticon.com/512/1156/1156412.png" alt="">
            </div>
            <div class="flex gap-2">
                <a class="py-1 px-2 text-xs md:py-2 md:px-4 bg-blue-500 rounded-sm text-white md:font-semibold" href="<?php route('/') ?>">Back To Home</a>
                <a class="py-1 px-2 text-xs md:py-2 md:px-4 bg-red-400 rounded-sm text-white md:font-semibold" href="<?php route('cart') ?>">Go to Cart page</a>
            </div>

        </div>
    </div>
</section>

<?php include_once VIEWS . 'partials/featuredProductCauroselSection.php'; ?>

<?php include_once VIEWS . 'partials/popularProductSection.php'; ?>

<?php include_once VIEWS . 'partials/footer.php'; ?>