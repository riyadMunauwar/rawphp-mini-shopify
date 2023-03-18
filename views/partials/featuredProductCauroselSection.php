<?php 
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $isShow = $storeStmt->findColumnValueByStoreId('featured_product_caurosel', STORE_ID);

        
    }
    catch(\PDOException $e){
        echo 'This error is coming from brand caurosel section page' . $e->getMessage();
    }


?>





<?php if($isShow) { ?>

    <?php include_once VIEWS . 'partials/cauroselAssetsSection.php'; ?>

    <?php 

        load(MODELS, 'FeaturedProductCauroselItem');
        load(MODELS, 'Product');

        try
        {

            $featuredProductCauroselStmt = new FeaturedProductCauroselItem(STORE_DATABASE);
            $featuredProductCaurosel = $featuredProductCauroselStmt->findAllProductCauroselItemByStoreId(STORE_ID);


            if($featuredProductCaurosel){
                $featuredProductCauroselProduct = [];

                foreach($featuredProductCaurosel ?? [] as $item){
                    $productStmt = new Product(STORE_DATABASE);
                    $product = $productStmt->findByStoreAndId(STORE_ID, $item['product_id']);

                    if($product){
                        array_push($featuredProductCauroselProduct, $product);
                    }
                }

            }

        }
        catch(\PDOException $e)
        {
            echo 'This error is coming from featured product caurosel section' . $e->getMessage();
        }

    ?>

    <style>
    .slick-prev:before {
    color: red;
    }
    .slick-next:before {
    color: red;
    }
    </style>

    <section class="md:mt-4 bg-white py-5">
        <div class="container mx-auto">
            <!-- Silder -->
            <h1 class="text-md text-center md:text-left text-gray-600 font-body mb-4" >Featured</h1>
            <div class="featuredProductCaurosel">
                <!-- Slide -->
            <?php foreach($featuredProductCauroselProduct ?? [] as $product) { ?> 
                    <a href="<?php route("product-detail?p=" . $product['id']) ?>">
                        <div class="p-2">
                            <div class="mb-3">
                                <img class="rounded-lg object-cover aspect-square" src="<?php echo $product['thumbnail'] ?? '' ?>" alt="">
                            </div>
                            <div>
                                <h2 class="mb-1 text-sm md:text-md font-semibold text-gray-800">New Arrivals</h2>
                                <div class="flex items-center mt-3">
                                    <p class="text-xs md:text-xs text-themePrimaryLight md:font-bold mb-2">TK <?php echo countDiscountIfHas($product['unit_price'], $product['discount']) ?? '' ?> </p>
                                    <?php if($product['discount'] ?? null) { ?>
                                        <p class="ml-3 text-xs md:text-xs md:font-bold mb-2"><del>TK <?php echo $product['unit_price'] ?? '' ?> </del></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php } ?>

            <?php if(! ( $featuredProductCauroselProduct ?? []) ) { ?>
                <h1 class="text-md text-center md:text-left text-gray-600 font-body mb-4" >Empty</h1>
            <?php } ?>


            </div>
        </div>
    </section>


    <script>
        (function(){
            $('.featuredProductCaurosel').slick({
                    dots: true,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    responsive: [
                        {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true,
                            arrows: false,

                        }
                        },
                        {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            arrows: false,

                        }
                        },
                        {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            arrows: false,

                        }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                    });
        })()
    </script>

<?php } ?>