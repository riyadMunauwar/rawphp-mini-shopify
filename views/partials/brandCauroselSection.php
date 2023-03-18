<?php 
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $isShow = $storeStmt->findColumnValueByStoreId('brand_caurosel', STORE_ID);

        
    }
    catch(\PDOException $e){
        echo 'This error is coming from brand caurosel section page' . $e->getMessage();
    }


?>


<?php if($isShow) { ?>

    <?php include_once VIEWS . 'partials/cauroselAssetsSection.php'; ?>

    <?php 

        load(MODELS, 'Brand');
        
        try
        {
            $brand = new Brand(STORE_DATABASE);
            $brands = $brand->findManyByStoreId(STORE_ID);


            
        }
        catch(\PDOException $e){
            echo 'This error is coming from brand caurosel section page' . $e->getMessage();
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

    <section class="bg-white md:mt-4 py-10">
        <div class="container mx-auto">
            <!-- Silder -->
            <h1 class="text-center md:text-left text-md text-gray-600 font-body mb-4" >Brands</h1>
            <div class="brandCaurosel">
            
            <!-- Slide -->
            <?php if(isset($brands)) { ?> 
                 <?php foreach($brands ?? [] as $brand) { ?> 
                    <a class="px-4" href="<?php route("brand?b=" . $brand['id']) ?>">
                    <img class="block aspect-video object-cover" src="<?php echo $brand['thumbnail'] ?>" alt="">
                    </a>
                <?php } ?>
            <?php } else { ?>
                <h1 class="text-center md:text-left text-md text-gray-600 font-body mb-4" >Empty</h1>
            <?php } ?>




            </div>
        </div>
    </section>


    <script>
        (function(){
            $('.brandCaurosel').slick({
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
                            arrows: false,
                            dots: true
                        }
                        },
                        {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            arrows: false,
                            slidesToScroll: 2
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