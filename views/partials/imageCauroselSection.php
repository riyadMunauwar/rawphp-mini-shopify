<?php 
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $isShow = $storeStmt->findColumnValueByStoreId('image_caurosel', STORE_ID);

        
    }
    catch(\PDOException $e){
        echo 'This error is coming from brand caurosel section page' . $e->getMessage();
    }


?>



<?php if($isShow) { ?>


    <?php 
        load(MODELS, 'ImageCaurosel');

        try
        {
            $imageCauroselStmt = new ImageCaurosel(STORE_DATABASE);
            $imageCaurosel = $imageCauroselStmt->findAllImageCauroselItemByStoreId(STORE_ID);
       
    
        }
        catch(\PDOException $e)
        {
            echo 'Error is coming from image caurosel section ' . $e->getMessage();
        }
    
    ?>

    <?php if(isset($imageCaurosel)) { ?>

        <?php include_once VIEWS . 'partials/cauroselAssetsSection.php'; ?>

        <section class="md:mt-4">
            <div class="container mx-auto">
                <!-- Silder -->
                <div class="imageCaurosel">
                <!-- Slide -->
                    <?php foreach($imageCaurosel ?? [] as $slide) { ?>
                        <div>
                            <a href="<?php echo $slide['link'] ?? '' ?>">
                                <img class="w-full block object-cover" src="<?php echo $slide['image'] ?? '' ?>" alt="">
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        


        <script>
            (function(){
                $('.imageCaurosel').slick({
                    dots: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    arrows: false,
                });
            })()
        </script>

    <?php } ?>

<?php } ?>