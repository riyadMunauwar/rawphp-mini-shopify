<?php

$Router = [

    // ALL GET REQUEST 
    'GET' => [

        // General
        '/' => 'get/getHomePageAction.php',
        '/product-detail' => 'get/getProductDetailPageAction.php',
        '/cart' => 'get/getCartPageAction.php',
        '/message' => 'get/getMessagePageAction.php',
        '/checkout' => 'get/getCheckoutPageAction.php',
        '/category-page' => 'get/getCategoryPageAction.php',
        '/category' => 'get/getProductByCategoryPageAction.php',
        '/category-list' => 'get/getCategoryListPageAction.php',
        '/brand' => 'get/getProductByBrandPageAction.php',
        '/page-not-found' => 'get/404PageAction.php',



        // Page
        '/page' => 'get/getShowStoreCustomPageAction.php',

        // General Api 
        '/api/cart' => 'get/api/getAllShoppingCartJsonAction.php',

        // Store Cart
        '/add-cart-item' => 'get/getAddItemToShoppingCartAction.php',
        // Cart
        '/api/cart' => 'get/api/getAllShoppingCartJsonAction.php',
        '/api/cart-remove' => 'get/api/getRemoveCartItemAction.php',
        '/api/cart-quantity' => 'get/api/getCartQuantityChangeAction.php',
        // Search
        '/api/search' => 'get/api/getSearchProductAction.php',



        // Store Dashboard
        '/store/logout' => 'get/logout/getStoreLogoutAction.php',
        '/store/login' => 'get/store-client/getStoreLoginPageAction.php',
        '/store/dashboard' => 'get/store-client/getStoreDashboardPageAction.php',
       
        // Store->Brand
        '/store/brand' => 'get/store-client/brand/getStoreBrandPageAction.php',
        '/store/add-brand' => 'get/store-client/brand/getStoreAddBrandPageAction.php',
        '/store/update-brand' => 'get/store-client/brand/getStoreUpdateBrandPageAction.php',
        '/store/delete-brand' => 'get/store-client/brand/getStoreDeleteBrandAction.php',
        
        // Store->Category
        '/store/category' => 'get/store-client/category/getStoreCategoryPageAction.php',
        '/store/add-category' => 'get/store-client/category/getStoreAddCategoryPageAction.php',
        '/store/update-category' => 'get/store-client/category/getStoreUpdateCategoryPageAction.php',
        '/store/delete-category' => 'get/store-client/category/getStoreDeleteCategoryAction.php',
        
        // Store->Product
        '/store/product' => 'get/store-client/product/getStoreProductPageAction.php',
        '/store/add-product' => 'get/store-client/product/getStoreAddProductPageAction.php',
        '/store/edit-product' => 'get/store-client/product/getStoreUpdateProductPageAction.php',
        
        // Store->Meida
        '/store/media' => 'get/store-client/media/getStoreMediaPageAction.php',
        '/store/add-media' => 'get/store-client/media/getStoreAddMediaPageAction.php',
        '/store/delete-media' => 'get/store-client/media/getStoreDeleteMediaAction.php',

        // Store->Order
        '/store/order' => 'get/store-client/order/getStoreOrderPageAction.php',
        '/store/order-detail' => 'get/store-client/order/getStoreOrderDetailPageAction.php',
        '/store/search-order' => 'get/store-client/order/getStoreSearchOrderAction.php',
        '/store/order-status' => 'get/store-client/order/getChangeOrderStatusAction.php',
        
        // Sotre->Customer
        '/store/customer' => 'get/store-client/customer/getStoreCustmerPageAction.php',
        '/store/search-customer' => 'get/store-client/customer/getStoreSearchCustomerAction.php',

        // Store->Pages
        '/store/page' => 'get/store-client/pages/getStorePagesPageAction.php',
        '/store/add-page' => 'get/store-client/pages/getStoreAddPageAction.php',
        '/store/update-page' => 'get/store-client/pages/getStoreUpdatePageAction.php',
        '/store/delete-page' => 'get/store-client/pages/getStoreDeletePageAction.php',

        // Store->Footer
        '/store/footer' => 'get/store-client/footer/getStoreFooterPageAction.php',
        '/store/footer/init' => 'get/store-client/footer/getStoreFooterInitAction.php',

        // Store->Script
        '/store/script' => 'get/store-client/script/getStoreScriptPageAction.php',
        '/store/script/init' => 'get/store-client/script/getStoreScriptInitAction.php',

        // Store->Stock
        '/store/stock' => 'get/store-client/stock/getStoreStockPageAction.php',

        // Store->Settings
        '/store/setting' => 'get/store-client/setting/getStoreSettingPageAction.php',

        // Store->Caurosel
        '/store/caurosel' => 'get/store-client/caurosel/getStoreCauroselPageAction.php',
        
        // Store->LocalShipping
        '/store/local-shipping' => 'get/store-client/local-shipping/getStoreLocalShippingPageAction.php',











        // Customer Dashboard
        '/customer/logout' => 'get/logout/getCustomerLogoutAction.php',
        '/customer/register' => 'get/customer-client/getCustomerRegisterPageAction.php',
        '/customer/login' => 'get/customer-client/getCustomerLoginPageAction.php',
        '/customer/dashboard' => 'get/customer-client/getCustomerDashboardPageAction.php',
        '/customer/order' => 'get/customer-client/getCustomerOrderPageAction.php',
        '/customer/profile' => 'get/customer-client/getCustomerProfilePageAction.php',



        // Admin Dashboard
        '/admin/logout' => 'get/logout/getAdminLogoutAction.php',
        '/admin/login' => 'get/admin-client/getAdminLoginPageAction.php',
        '/admin/dashboard' => 'get/admin-client/getAdminDashboardPageAction.php',
        '/admin/create-store' => 'get/admin-client/getAdminCreateStorePageAction.php',
        '/admin/all-store' => 'get/admin-client/getAdminAllStorePageAction.php',


        // Payment Gateways
        // Bkash
        '/payment/bkash/delevery-charge-via-bkash/start' => 'get/payment/bkash/getStartBkashDeliveryChargePaymentAction.php',
        '/payment/bkash/start' => 'get/payment/bkash/getStartBkashPaymentAction.php',
        '/payment/bkash/success' => 'get/payment/bkash/getBkashSuccessAction.php',

    ],


    // ALL POST REQUEST
    'POST' => [

        // General

        // Store 
        '/store/login' => 'post/store-client/postStoreLoginAction.php',

        // Create Order
        '/create-order' => 'post/postCreateOrderAction.php',
        '/place-order' => 'post/postPlaceOrderAction.php',





        // Store->Category
        '/store/add-category' => 'post/store-client/postStoreAddCategoryPageAction.php',
        '/store/update-category' => 'post/store-client/postStoreUpdateCategoryAction.php',

        // Store->Brand
        '/store/add-brand' => 'post/store-client/postStoreAddBrandPageAction.php',
        '/store/update-brand' => 'post/store-client/postStoreUpdateBrandAction.php',

        // Store->Order
        '/store/confirm-order' => 'post/store-client/postStoreConfirmOrderAction.php',
        '/store/order/delete' => 'post/store-client/postStoreDeleteOrderAction.php',


        // Store->Media
        '/store/add-media' => 'post/store-client/postStoreAddMediaAction.php',

        // Store->add-page
        '/store/add-page' => 'post/store-client/postStoreAddPageAction.php',
        '/store/update-page' => 'post/store-client/postStoreUpdatePageAction.php',

        // Store->Footer
        '/store/update-footer' => 'post/store-client/postStoreFooterUpdateAction.php',

        // Store->Script
        '/store/script/save' => 'post/store-client/postStoreScriptSaveAction.php',

        // Store->setting
        '/store/setting/update-store-info' => 'post/store-client/postStoreSettingChangeStoreInfoAction.php',
        '/store/setting/delete-shipping-cost' => 'post/store-client/postStoreSettingDeleteShippingCostAction.php',
        '/store/setting/add-shipping-cost' => 'post/store-client/postStoreSettingAddShippingCostAction.php',
        '/store/setting/add-shipper' => 'post/store-client/postStoreSettingAddShipperAction.php',
        '/store/setting/delete-shipper' => 'post/store-client/postStoreSettingDeleteShipperAction.php',

        // Store->Caurosel
        '/store/caurosel/add-image-caurosel' => 'post/store-client/postStoreAddImageCauroselItemAction.php',
        '/store/caurosel/delete-image-caurosel' => 'post/store-client/postStoreDeleteImageCauroselItemAction.php',
        '/store/caurosel/add-featured-product-caurosel-item' => 'post/store-client/postStoreAddFeaturedProductCauroselItemAction.php',
        '/store/caurosel/delete-featured-product-caurosel-item' => 'post/store-client/postStoreDeleteFeaturedProductCauroselItemAction.php',
        '/store/caurosel/add-image-banner' => 'post/store-client/postStoreAddImageBannerAction.php',
        '/store/caurosel/delete-image-banner' => 'post/store-client/postStoreDeleteImageBannerAction.php',

        //  Store->Product
        '/store/product/delete' => 'post/store-client/postStoreProductDeleteAction.php',
        '/store/product/update' => 'post/store-client/postStoreProductEditAction.php',
        '/store/product/variant-update' => 'post/store-client/postStoreProductVariantEditAction.php',
        '/store/product/variant-add-via-edit' => 'post/store-client/postStoreProductVariantAddViaEditAction.php',




        // Store Api
        '/api/store/add-product' => 'post/store-client/api/postStoreAddProductPageActionApi.php',
        

        

        // Customer
        '/customer/login' => 'post/customer-client/postCustomerLoginAction.php',
        '/customer/register' => 'post/customer-client/postCustomerRegisterAction.php',


        // Admin
        '/admin/login' => 'post/admin-client/postAdminLoginAction.php',
        '/admin/create-store' => 'post/admin-client/postAdminCreateStoreAction.php',



        // Payment Gateways
        // Bkash
        '/payment/bkash/token' => 'post/payment/bkash/postGetBkashTokenAction.php',
        '/payment/bkash/create-payment' => 'post/payment/bkash/postBkashCreatePaymentAction.php',
        '/payment/bkash/execute-payment' => 'post/payment/bkash/postBkashExecutePaymentAction.php',

        
    ]
]


?>