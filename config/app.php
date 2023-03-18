<?php

    // SYSTEM CORE DATABASE CONFIG
    define('CORE_DATABASE', [
        'DB' => 'mysql',
        'DB_HOST' => '51.79.228.201',
        'DB_NAME' => 'webnshop_ebnshop',
        'DB_USER' => 'webnshop_ebnshop_root',
        'DB_PASSWORD' => 'ebnshop_2065532_3255206_boss_root_user'
    ]);



    // MAX IMAGE FILE SIZE -> BYTES
    define('FILE_UPLOAD', [
        'IMAGE_UPLOAD_PATH' => 'uploads',
        'MAX_IMAGE_SIZE' => 256000,
        'ACCEPT_IMAGE_TYPE' => ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/bmp', 'image/tif', 'image/tiff']
    ]);

    // EMAIL CONFIG
    define('EMAIL', [
        'SMTP_HOST' => '',
        'SMTP_PORT' => '',
        'SMTP_USER' => '',
        'SMTP_PASSWORD' => '' 
    ]);




    define('ROOT_USER', 'localhost');

    define('CURRENT_DOMAIN', ltrim($_SERVER['SERVER_NAME'], 'www.'));


    

?>