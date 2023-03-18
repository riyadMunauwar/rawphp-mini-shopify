<?php 
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $isShow = $storeStmt->findColumnValueByStoreId('selling_feature_banner', STORE_ID);

        
    }
    catch(\PDOException $e){
        echo 'This error is coming from brand caurosel section page' . $e->getMessage();
    }


?>


<?php if($isShow) { ?>

    <section class="md:pt-4">
        <div class="container bg-white mx-auto px-2 md:px-0">
            <div class="grid grid-cols-2 gap-1 md:gap-0 md:grid-cols-5">

                <!-- Single Selling Feature -->
                <div class="border flex gap-2 pl-6 py-6 items-center">
                    <img class="block w-1/3" src="https://cdn-icons-png.flaticon.com/512/3231/3231977.png" alt="">
                    <div>
                        <h2 class="text-semibold text-md text-gray-600">Fast Delivery</h2>
                    </div>
                </div>

                <!-- Single Selling Feature -->
                <div class="border flex gap-2 pl-6 py-6 items-center">
                    <img class="block w-1/3" src="https://cdn-icons-png.flaticon.com/512/4280/4280117.png" alt="">
                    <div>
                        <h2 class="text-semibold text-md text-gray-600">99% Positive</h2>
                        <h2 class="font-semibold text-xs text-gray-600">Feedback</h2>
                    </div>
                </div>

                <!-- Single Selling Feature -->
                <div class="border flex gap-2 pl-6 py-6 items-center">
                    <img class="block w-1/3" src="https://cdn-icons-png.flaticon.com/512/7491/7491730.png" alt="">
                    <div>
                        <h2 class="text-semibold text-md text-gray-600">Easy</h2>
                        <h2 class="font-semibold text-xs text-gray-600">Return</h2>

                    </div>
                </div>

                <!-- Single Selling Feature -->
                <div class="border flex gap-2 pl-6 py-6 items-center">
                    <img class="block w-1/3" src="https://cdn-icons-png.flaticon.com/512/3080/3080697.png" alt="">
                    <div>
                        <h2 class="text-semibold text-md text-gray-600">Secure</h2>
                        <h2 class="font-semibold text-xs text-gray-600">Payment</h2>

                    </div>
                </div>

                <!-- Single Selling Feature -->
                <div class="border flex gap-2 pl-6 py-6 items-center">
                    <img class="block w-1/3" src="https://cdn-icons-png.flaticon.com/512/6641/6641711.png" alt="">
                    <div>
                        <h2 class="text-semibold text-md text-gray-600">Best</h2>
                        <h2 class="font-semibold text-xs text-gray-600">Brands</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php } ?>