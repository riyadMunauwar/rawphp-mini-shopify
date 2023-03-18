<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>


<?php $order = $data['order'] ?? null ?>

<!-- CheckOut Page -->
<form action="<?php route('place-order') ?>" method="POST" >

<?php  
    $old = [];
    if(array_key_exists('formData', $data)){
        $old = $data['formData'];
    }
     


    $full_name = $order['full_name'] ?? $old['full_name'] ?? '';
    $mobile_no = $order['mobile_no'] ?? $old['mobile_no'] ?? '';
    $house_no = $order['house_no'] ?? $old['house_no'] ?? '';
    $colony = $order['colony'] ?? $old['colony'] ?? '';
    $region = $order['region'] ?? $old['region'] ?? '';
    $city = $order['city'] ?? $old['city'] ?? '';
    $area = $order['area'] ?? $old['area'] ?? '';
    $address = $order['address'] ?? $old['address'] ?? '';

    

?>

<!-- Order ID -->
<input name="order-id" type="hidden" value="<?php echo $order['id'] ?? ''  ?>">


<section class="bg-white py-10">
  <div class="container mx-auto px-3">
      <div class="grid grid-cols-1 md:grid-cols-3">
          <div class="col-span-2">

            <?php if(has('errors', $data)) { ?>
                <?php  foreach($data['errors'] ?? [] as $error ) { ?>
                <div class="bg-yellow-500 py-2 px-4 text-white text-sm mb-2">
                    <?php echo $error ?? '' ?>
                </div>
                <?php } ?>
            <?php } ?>
              
              <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
                  <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Billing Adress</h2>
                  
                      <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">

                          <div>
                              <label class="text-gray-700 dark:text-gray-200" for="username">Full Name*</label>
                              <input placeholder="Mr Jone Doe" name="full_name" value="<?php echo $full_name ?? '' ?>" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                          </div>

                          <div>
                              <label class="text-gray-700 dark:text-gray-200" for="mobile">Mobile No*</label>
                              <input placeholder="0176..." name="mobile_no" value="<?php echo $mobile_no ?? '' ?>" id="mobile" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                          </div>
                            
                          <!--<div>-->
                          <!--    <label class="text-gray-700 dark:text-gray-200" for="house_no">Building / Hourse No / Floor / Street (optional)</label>-->
                          <!--    <input name="house_no" value="<?php // echo $house_no ?? '' ?>" id="house_no" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">-->
                          <!--</div>-->

                          <!--<div>-->
                          <!--    <label class="text-gray-700 dark:text-gray-200" for="colony">Colony / Suburb / Locality / Landmark (Optional)</label>-->
                          <!--    <input name="colony" value="<?php // echo $colony ?? '' ?>" id="colony" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">-->
                          <!--</div>-->

                          <div>
                              <label class="text-gray-700 dark:text-gray-200" for="region">Region*</label>
                              <input placeholder="Your district..." name="region" value="<?php echo $region ?? '' ?>" id="region" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                          </div>

                          <div>
                              <label class="text-gray-700 dark:text-gray-200" for="city">City*</label>
                              <input placeholder="Your Upozila..." name="city" value="<?php echo $city ?? '' ?>" id="city" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                          </div>

                          <div>
                              <label class="text-gray-700 dark:text-gray-200" for="area">Area*</label>
                              <input placeholder="Your word/area/village..." name="area" value="<?php echo $area ?? '' ?>" id="area" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                          </div>

                          <!-- <div>
                              <label class="text-gray-700 dark:text-gray-200" for="adress">Adress</label>
                              <input name="adress" id="adress" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                          </div> -->
                      </div>

                      <div class="mt-2">
                            <label class="text-gray-700 dark:text-gray-200" for="adress">Adress*</label>
                            <textarea placeholder="Example - Paratongi, Muktagacha, Mymensingh..." name="adress" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"><?php echo $address ?? '' ?></textarea>  
                      </div>

                      <!-- <div class="flex justify-end mt-6">
                          <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                      </div> -->
                  
              </section>
          </div>

          <div class="p-10">
              <h2 class="text-xl font-semibold mb-8">Order Summery</h2>
              
              <!-- <div class="flex justify-between mb-8">
                  <h3 class="text-md">Total Items 2</h3>
                  <h3></h3>
              </div> -->

              <div class="flex justify-between mb-8">
                  <h3 class="text-md">Shiping fee</h3>
                  <h3>Tk <?php echo $order['shipping_cost'] ?? 0 ?></h3>
              </div>

              <div class="flex justify-between mb-8">
                  <h3 class="text-md">Total</h3>
                  <h3>Tk <?php echo $order['grand_total_price'] ?? 0 ?></h3>
              </div>

              <div class="flex flex-col justify-between mb-10">
                  <h3 class="text-md mb-4">Payment Method</h3>
                  <div>
                    <?php foreach($order['payment_methods'] ?? [] as $payment_method)  { ?>
                      <div class="flex border p-4 rounded-md mb-2">
                          <input class="mr-4" type="radio" name="payment_method" value="<?php echo $payment_method['id'] ?>">
                          <img class="block w-full h-20" src="<?php echo $payment_method['logo'] ?>" alt="">
                      </div>
                    <?php } ?>
                  </div>
              </div>

              <input class="text-center py-3 px-6 bg-black text-white block w-full cursor-pointer" type="submit" value="Place Order" />
          </div>
      </div>
  </div>
</section>
</form>


<?php include_once VIEWS . 'partials/footer.php'; ?>