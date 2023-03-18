<?php
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $store_favicon = $storeStmt->findStoreFaviconIconByStoreId(STORE_ID)['favicon'];
        $thisStore = $storeStmt->findStoreById(STORE_ID);
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from head.php file in root view partials files' . $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo $store_favicon ?? '' ?>">
   
   
    <!-- Seo Tags -->
    <title><?php echo $thisStore['title'] ?? 'DataScom E-Commerce' ?></title>
    <!-- <link rel="canonical" href="https://www.resellerbd.com"> -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="author" content="<?php echo $thisStore['name'] ?? 'DataScom' ?>" />
    <meta name="description" content="<?php echo $thisStore['description'] ?? 'DataScom' ?>">
    <meta name="keywords" content="<?php echo $thisStore['name'] ?? 'DataScom E-Commerce' ?>" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
        
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $thisStore['name'] ?? 'DataScom' ?>">
    <meta property="og:description" content="<?php echo $thisStore['description'] ?? 'DataScom' ?>">
    <meta property="og:url" content="<?php echo getDomain() ?>" />
    <meta property="og:image" content="<?php echo $thisStore['logo'] ?? 'DataScom' ?>" />
    <meta property="og:site_name" content="<?php echo $thisStore['name'] ?? 'DataScom' ?>" />
        
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="<?php echo getDomain() ?>" />
    <meta name="twitter:title" content="<?php echo $thisStore['title'] ?? 'DataScom E-Commerce' ?>" />
    <meta name="twitter:description" content="<?php echo $thisStore['description'] ?? 'DataScom E-Commerce' ?>">
    <meta name="twitter:image" content="<?php echo $thisStore['logo'] ?? 'DataScom E-Commerce' ?>" /> 

    <?php $thisStore = null ?>
    
    <!-- Load Tailwind From Config -->
    <?php include_once(CONFIG . 'tailwindCssScript.php')  ?>

</head>
<body class="bg-gray-200">
    
