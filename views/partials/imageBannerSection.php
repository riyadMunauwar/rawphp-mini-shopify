<?php 
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $isShow = $storeStmt->findColumnValueByStoreId('image_banner', STORE_ID);

        
    }
    catch(\PDOException $e){
        echo 'This error is coming from brand caurosel section page' . $e->getMessage();
    }


?>

<?php if($isShow) { ?>

    <?php
        load(MODELS, 'ImageBanner');


        try
        {
            $imageBannerStmt = new ImageBanner(STORE_DATABASE);
            $imageBanner = $imageBannerStmt->findByStoreId(STORE_ID);

            
        }
        catch(\PDOExceptin $e)
        {
            echo 'this error is coming from image banner section ' . $e->getMessage();
        }

    ?>

    <section class="pt-2 sm:pt-4 md:pt-4 mx-2 md:mx-0">
        <div class="container mx-auto">
            <?php if($imageBanner) { ?>
                <a href="<?php echo $imageBanner['banner_link'] ?? '' ?>">
                    <img class="block w-full" src="<?php echo $imageBanner['image'] ?? '' ?>" alt="">                   
                </a>
            <?php } else { ?>
                <h2 class="text-md py-10 px-4 font-semibold bg-white text-center ">No Image Banner. Go To Admin Panel -> Caurosel -> Image Banner</h2>
            <?php } ?>
        </div>
    </section>

<?php } ?>