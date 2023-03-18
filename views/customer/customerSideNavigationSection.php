<?php 

    function cActiveWhen($route){
        if(CURRENT_URI === BASE_PATH . $route){
            echo 'bg-gray-300';
        }
        else
        {
            echo '';
        }
    }

?>



<div class="flex flex-col text-sm font-semibold">
    <a class="<?php cActiveWhen('customer/profile') ?> border-b py-3 cursor-pointer px-4 hover:bg-gray-300" href="<?php route('customer/profile') ?>">Profile</a>
    <a class="<?php cActiveWhen('customer/order') ?> border-b py-3 cursor-pointer px-4 hover:bg-gray-300" href="<?php route('customer/order') ?>">Order</a>
    <a class="<?php cActiveWhen('cart') ?> border-b py-3 cursor-pointer px-4 hover:bg-gray-300" href="<?php route('cart') ?>">Cart</a>
    <a class="<?php cActiveWhen('customer/review') ?> border-b py-3 cursor-pointer px-4 hover:bg-gray-300" href="<?php route('customer/review') ?>">review</a>
    <a class="<?php cActiveWhen('customer/settings') ?> border-b py-3 cursor-pointer px-4 hover:bg-gray-300" href="<?php route('customer/setting') ?>">settings</a>
</div>