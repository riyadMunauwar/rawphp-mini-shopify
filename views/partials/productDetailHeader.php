<?php
    load(MODELS, 'Store');


    try
    {
        $storeStmt = new Store(STORE_DATABASE);
        $store_favicon = $storeStmt->findStoreFaviconIconByStoreId(STORE_ID)['favicon'];
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
    
    <!-- Tailwind CSS From config -->
    <?php include_once(CONFIG . 'tailwindCssScript.php')  ?>
    
    <?php $product = $data['product'] ?? [] ?>
    <!-- Seo Tags -->
    <title><?php echo $product['name'] ?? 'Product Detail Page' ?></title>
    <!-- <link rel="canonical" href="https://www.resellerbd.com"> -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="author" content="<?php echo getDomain() ?>" />
    <meta name="description" content="<?php echo $product['short_description'] ?>">
    <meta name="keywords" content="" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
        
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $product['name'] ?? 'Product Detail Page' ?>">
    <meta property="og:description" content="<?php echo $product['short_description'] ?>">
    <meta property="og:url" content="<?php echo getDomain() ?>" />
    <meta property="og:image" content="<?php echo $product['thumbnail'] ?? '' ?>" />
    <meta property="og:site_name" content="<?php echo getDomain() ?>" />
        
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="<?php echo getDomain() ?>" />
    <meta name="twitter:title" content="<?php echo $product['name'] ?? 'Product Detail Page' ?>" />
    <meta name="twitter:description" content="<?php echo $product['short_description'] ?>">
    <meta name="twitter:image" content="<?php echo $product['thumbnail'] ?? '' ?>" /> 


</head>


<body class="bg-gray-200">


<?php include_once VIEWS . 'partials/header.php'; ?>