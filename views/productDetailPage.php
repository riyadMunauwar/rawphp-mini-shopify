<?php include_once VIEWS . 'partials/productDetailHeader.php'; ?>
<?php

      $product = $data['product'] ?? null ;
      $isOutOfStock = $product['stock_quantity'] < 1 ;


      function ifHasDiscount($price, $discount){
        if($discount && $discount > 0 ){
          return $price - ($price * $discount / 100);
        }

        return $price;
      }
      
     
?>
  <!-- Product -->
  <section class="text-gray-600 body-font md:mt-4">

      <?php if(has('error', QUERY))  { ?>
          <div class="max-w-2xl mx-auto px-3 py-1 text-center px-4 md:text-sm text-xs text-white bg-violet-400 md:mb-4"><?php echo get('error') ?? '' ?></div>
      <?php } ?>

      <?php if(has('success', QUERY))  { ?>
          <div class="max-w-2xl mx-auto text-center px-3 py-1 px-4 md:text-sm text-xs text-white bg-violet-500 md:mb-4"><?php echo get('success') ?? '' ?></div>
      <?php } ?>


  <div class="container bg-white px-5 py-10 md:py-20 mx-auto">

    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <!-- Thumbnail -->
      <div class="lg:w-1/2 w-full lg:h-auto h-auto">
          <img id="thumbnail" alt="ecommerce" class=" w-full lg:h-auto h-64 aspect-square object-cover object-center rounded" src="<?php echo $data['product']['thumbnail'] ?? '' ?>">

          <div class="grid grid-cols-6 gap-2 mt-3">
              <?php foreach($data['product']['gallery'] ?? [] as $gallery_item) { ?>
                <img id="gallery_item" class="block border p-1 object-cover aspect-square rounded-sm active:ring ring-red-400" src="<?php echo $gallery_item['photo_url'] ?>" alt="Gallery Item">
              <?php } ?>
          </div>
      </div>
    
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <!-- Brand and Product ID-->
          <a class="" href="<?php route("brand?b=" . $data["product"]["brand_id"] ?? '') ?>"><h2 class="hover:text-blue-500 text-sm title-font text-gray-500 tracking-widest uppercase"><?php echo $data['product']['brand']['name'] ?? '' ?></h2></a>
        <!-- Product name -->
        <h1 class=" text-gray-900 text:2xl md:text-3xl title-font font-medium mb-1"><?php echo $data['product']['name'] ?? '' ?></h1>
        <!-- Product ID -->
       <h2 class="text-sm text-indigo-600 font-medium">Product ID : <?php  echo $product['id'] ?? '' ?></h2>
       <!-- Rating -->
        <div class="flex mb-4">

          <span class="flex items-center">
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <span class="text-gray-600 ml-3">4 Reviews</span>
          </span>

          <!-- Social Icons -->
          <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200 space-x-2s">
            <a class="text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
              </svg>
            </a>
            <a class="text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
              </svg>
            </a>
            <a class="text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
              </svg>
            </a>
          </span>

        </div>


        <!-- Short Description -->
        <p class="leading-relaxed"><?php echo $data['product']['short_description'] ?? '' ?></p>

        <?php if(! $isOutOfStock) { ?>
          <span class="text-sm font-semibold mt-2 text-blue-500">In Stock Only </span>
          <span class="text-sm font-semibold mt-2 text-blue-500"><?php echo $product['stock_quantity'] ?? '' ?> Left</span>
        <?php } else { ?>
          <span class="text-sm font-semibold mt-2 text-red-500">Out Of Stock</span>
        <?php } ?>

    <form action="<?php route('add-cart-item')  ?>" method="GET">
        <input type="hidden" name="pid" value="<?php echo $product['id'] ?>" >

      <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">

            <?php if(!empty($data['product']['variations'][0]['color'])) { ?>
            <div class="flex items-center gap-3">
            <span class="mr-3">Color</span>
              <?php foreach($data['product']['variations'] ?? [] as $variant) { ?>
                  <div class="flex flex-col justify-center items-center border py-2 px-4">
                      <input data-src="<?php echo $variant['photo'] ?? '' ?>" id="color" value="<?php echo $variant['color'] ?>" name="color" class=" h-3 w-3 rounded-full bg-[<?php echo $variant['color_code'] ?? '' ?>] " type="radio">
                      <span class="text-xs mt-1"><?php echo $variant['color'] ?? '' ?></span>
                  </div>
              <?php } ?>
            </div>
            <?php } ?>

            <?php if(!empty($data['product']['variations'][0]['size'])) { ?>
            <div class="flex items-center gap-3">
              <span class="mr-3">Size</span>

              <?php foreach($data['product']['variations'] ?? [] as $variant) { ?>
                  <div class="flex flex-col justify-center items-center border py-2 px-5">
                      <input data-src="<?php echo $variant['photo'] ?? '' ?>" id="color" value="<?php echo $variant['size'] ?>" name="size" class="h-3 w-3 rounded-full" type="radio">
                      <span class="text-xs mt-1"><?php echo $variant['size'] ?? '' ?></span>
                  </div>
              <?php } ?>

        
            </div>
            <?php } ?>

            <?php if(!empty($data['product']['variations'][0]['weight'])) { ?>
            <div class="flex items-center gap-3">
              <span class="mr-3">Weight</span>

              <?php foreach($data['product']['variations'] ?? [] as $variant) { ?>
                  <div class="flex flex-col justify-center items-center border py-2 px-5">
                      <input data-src="<?php echo $variant['photo'] ?? '' ?>" id="color" value="<?php echo $variant['weight'] ?>" name="weight" class="h-3 w-3 rounded-full" type="radio">
                      <span class="text-xs mt-1"><?php echo $variant['weight'] ?? '' ?></span>
                  </div>
              <?php } ?>

        
            </div>
            <?php } ?>

      </div>

        <div class="flex">
          <div>
              <span class="block title-font text-2xl font-semibold text-rose-500 tracking-widest uppercase">Tk <?php echo ifHasDiscount($product['unit_price'], $product['discount']) ?? '' ?></span>
              <?php if($product['discount'] ?? null)  { ?>
              <div class="flex mt-2">
                <span class="border py-1 px-2 block title-font text-sm font-semibold text-gray-900 tracking-widest uppercase"><del>Tk <?php echo $product['unit_price'] ?? '' ?></del></span>
                <span class="text-sm bg-black text-white py-1 px-2"><?php echo $product['discount'] ?? '' ?> % OFF</span>
              </div>
              <?php } ?>
          </div>
          <button class="flex self-start ml-auto text-white bg-indigo-500 border-0 text-sm py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
            Add To Cart
          </button>
          <!-- <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
          </button> -->
        </div>
    </form>

        <div class="flex space-x-1 mt-4">
          <?php foreach( $data['product']['categories'] ?? [] as $category) { ?>
            <a href="<?php route("category?c=" . $category['id'] ?? ''); ?>" class="text-xs bg-gray-300 text-gray-900 tracking-widest py-1 px-4 rounded-md"><?php echo $category['name']; ?></a>
          <?php } ?>
        </div>


      </div>
    </div>

  </div>
</section>

<!-- More Details Description-->
<section>
  <div class="container mx-auto bg-white md:mt-4 py-5 px-6">
      <h1 class="text-lg font-semibold text-gray-700 mb-5">Details</h1>
      <div class="md:w-4/5">
            <?php echo $product['description'] ?? '' ?>
      </div>
  </div>
</section>
 <!-- Product Details  End-->

 <!-- Selling Feature -->
<?php include_once VIEWS . 'partials/sellingFeatureBannerSection.php' ?>


 

 <!-- Related Product -->
<?php include_once VIEWS . 'partials/relatedProductSection.php'; ?>

<!-- Related Brand Product -->
<?php include_once VIEWS . 'partials/relatedBrandProductSection.php'; ?>





<script defer> 


(function(){

  window.onload = function(){

    var thumbnail = document.getElementById('thumbnail');
    var colorsInput = Array.from(document.querySelectorAll('#color'));
    var gallery_items = Array.from(document.querySelectorAll('#gallery_item'));

    
    // Add Event and Handeler to gallery item image
    gallery_items.forEach(item => {
      item.addEventListener('click',function(event) {
        thumbnail.src = event.target.src;
      })
    });


    // Add Event and hander to Color Input Feild
    colorsInput.forEach(item => {
      item.addEventListener('click', function(event){
        
          thumbnail.src = event.target.dataset.src;
      })
    })

  }

})()

</script>


<?php include_once VIEWS . 'partials/footer.php'; ?>