<?php 
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $store_tite = $storeStmt->findStorTitleByStoreId(STORE_ID)['title'];
    }
    catch(\PDOException $e){
        echo 'this eror is coming from homePage views' . $e->getMessage();
    }


?>




<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>

<title><?php echo $store_tite ?? 'Home' ?></title>

<?php include_once VIEWS . 'partials/imageCauroselSection.php'; ?>

<?php include_once VIEWS . 'partials/categoryAndRecentProductSection.php' ?>

<?php include_once VIEWS . 'partials/sellingFeatureBannerSection.php' ?>

<?php include_once VIEWS . 'partials/featuredProductCauroselSection.php'; ?>

<?php include_once VIEWS . 'partials/imageBannerSection.php'; ?>

<?php include_once VIEWS . 'partials/categoryWiseProductSection.php' ?>

<?php include_once VIEWS . 'partials/brandCauroselSection.php'; ?>

<?php include_once VIEWS . 'partials/popularProductSection.php'; ?>


<?php include_once VIEWS . 'partials/footer.php'; ?>