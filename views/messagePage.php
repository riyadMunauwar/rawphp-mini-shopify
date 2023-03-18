<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>

<!-- Message Section -->
<section>
    <div class="container bg-white py-5 md:my-4 mx-auto px-3">

        <div class="flex flex-col h-screen justify-center items-center">

            <h1 class="text-xl font-semibold text-blue-400 text-center mb-6"><?php echo $data['message'] ?? '' ?></h1>
            
            <?php if(has('success', $data))  { ?>
            <div class="animate-bounce h-20 w-20 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <?php } ?>
            
            <?php if(has('error', $data)) { ?>
            <div class="animate-bounce h-20 w-20 text-yellow-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                </svg>
            </div>
            <?php } ?>
            <div class="flex gap-2">
                <a class="py-2 px-4 bg-green-600 rounded-sm text-white md:font-semibold" href="<?php route(' ') ?>">Back To Shopping</a>
                <a class="py-2 px-4 bg-red-400 rounded-sm text-white md:font-semibold" href="<?php route('cart') ?>">Go to Cart page</a>
            </div>

        </div>
    </div>
</section>


<?php include_once VIEWS . 'partials/footer.php'; ?>