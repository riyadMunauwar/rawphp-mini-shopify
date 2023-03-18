<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>

<!-- Message Section -->
<section>
    <div class="container bg-white py-10 md:my-4 mx-auto px-3">

        <div class="flex flex-col items-center">

            <h1 class="text-6xl font-bold  text-black text-center mb-6">Thank You !</h1>
            <h1 class="text-4xl font-bold  text-red-400 text-center mb-6"><?php echo CUSTOMER['name'] ?? '' ?></h1>
            <h1 class="text-2xl font-bold  text-black text-center mb-6 uppercase">We have recieved your order</h1>
            <p>We have recieved your order and will contact you as soon as your package is shiped. You can find your purchase information <a href="<?php route('customer/order') ?>" class="cursor-pointer text-sm font-semibold underline text-blue-400">Here</a> </p>
            <div class="animate-bounce h-20 w-20 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
      
 
            <div class="flex gap-2">
                <a class="py-2 px-4 bg-green-600 rounded-sm text-white md:font-semibold" href="<?php route('customer/order') ?>">See Order Details</a>
            </div>

        </div>
    </div>
</section>


<?php include_once VIEWS . 'partials/footer.php'; ?>