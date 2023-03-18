




<section>
        <div class="grid text-center gap-4 grid-cols-7 bg-themePrimaryLight py-4 px-3 text-white text-md font-semibold">
            <div>Store Domain</div>
            <div>Email</div>
            <div>RDMBS</div>
            <div>Datbase name</div>
            <div>Database Host</div>
            <div>Action</div>
        </div>


    <?php foreach( $data['stores'] ?? [] as $store ) { ?>

        <div class="grid text-center gap-4 grid-cols-7 bg-white py-4 px-3 text-gray-600 transition-all hover:bg-gray-300 text-md">
            <div><?php echo $store['domain'] ?? '' ?></div>
            <div><?php echo $store['email'] ?? '' ?></div>
            <div><?php echo $store['db'] ?? '' ?></div>
            <div><?php echo $store['db_name'] ?? '' ?></div>
            <div><?php echo $store['db_host'] ?? '' ?></div>
            <div class="flex space-x-2">
                <a class="px-3 py-1 rounded-md bg-themeSecondaryLight text-white hover:cursor-pointer hover:bg-themeSecondaryDark" > Details</a>
                <a class="px-3 py-1 rounded-md bg-themeSecondaryLight text-white hover:cursor-pointer hover:bg-themeSecondaryDark" > Edit</a>
            </div>
        </div>

    <?php } ?> 
</section>



