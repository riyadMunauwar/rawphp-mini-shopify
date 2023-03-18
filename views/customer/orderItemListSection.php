<?php 

    load(MODELS, 'Order');
    load(MODELS, 'OrderItem');
    load(MODELS, 'Product');

    try
    {
        $orderStmt = new Order(STORE_DATABASE);
        $customerOrders = $orderStmt->findAllOrderByCustomerAndStoreIdRecentFirst(CUSTOMER['id'],STORE_ID);
        
        if($customerOrders){

            $orderWithOrderItem = [];

            foreach($customerOrders ?? [] as $singleOrder){
                $orderItemStmt = new OrderItem(STORE_DATABASE);
                $orderItems = $orderItemStmt->findManyByOrderId($singleOrder['id']);

                if($orderItems){
                    $orderItemsWithProduct = [];

                    foreach($orderItems as $orderItem){
                        $productStmt = new Product(STORE_DATABASE);
                        $product = $productStmt->findById($orderItem['product_id']);
                        $orderItem['product'] = $product;

                        array_push($orderItemsWithProduct, $orderItem);
                    }

                    if($orderItemsWithProduct){
                        $singleOrder['order_items'] = $orderItemsWithProduct;
                        array_push($orderWithOrderItem,  $singleOrder);
                    }

                }
            }


        }


        
    }
    catch(\PDOException $e){
        echo 'this error is coming from orderItemListSection ' . $e->getMessage();
    }

?>

<div>
    <?php foreach($orderWithOrderItem ?? [] as $order) { ?>
    <div class="border mb-3">
        <div class="py-1 px-2 text-xs md:text-sm font-semibold flex items-center justify-between py-1 bg-gray-100 md:px-4">
            <h3>Order ID : <?php echo $order['id'] ?></h3>

            <?php if($order['order_status'] === 'uncomplate') { ?>
                <a class="py-[2px] px-2 bg-violet-400 text-white" href="<?php route('checkout') ?>">Checkout Uncomplate Order</a>
            <?php } ?>

            <h3 class="py-[2px] px-2 bg-violet-400 text-white"><?php echo $order['order_status'] ?></h3>
        </div>
        <h2 class="text-xs font-semibold mt-3 ml-4 mb-2">Grand Total : Tk <?php echo $order['grand_total_price'] ?? '---' ?></h2>
        <h2 class="text-xs font-semibold ml-4 mb-2">Shipping Method : <?php echo $order['shipping_method'] ?? '---' ?></h2>
        <h2 class="text-xs font-semibold ml-4 mb-2">Grand Total : Tk <?php echo $order['grand_total_price'] ?? '---' ?></h2>
        <h2 class="text-xs font-semibold ml-4 mb-2">Order Date :  <?php echo $order['order_date'] ?? '---' ?></h2>
        <h2 class="text-xs font-semibold ml-4 mb-2">Probably Shipping On :  <?php echo $order['shipping_date'] ?? '---' ?></h2>

        <h2 class="text-xs font-semibold ml-4 mt-2 mb-2">Order Items : <?php echo count($order['order_items']) ?? '' ?></h2>

        <?php foreach($order['order_items'] ?? [] as $order_item ) { ?>
            <div class="flex border m-2 p-2">
                <div class="w-3/4">
                    <div class="text-xs md:text-sm font-semibold flex gap-4 py-1 md:px-4">
                        <h3>Name</h3>
                        <h3>:</h3>
                        <h3><?php echo $order_item['product']['name'] ?? '' ?></h3>
                    </div>
                    <div class="text-xs md:text-sm font-semibold flex gap-4 py-1 md:px-4">
                        <h3>Price</h3>
                        <h3>:</h3>
                        <h3>Tk <?php echo $order_item['product']['unit_price'] ?? '' ?></h3>
                    </div>
                    <div class="text-xs md:text-sm font-semibold flex gap-4 py-1 md:px-4">
                        <h3>Order Qty</h3>
                        <h3>:</h3>
                        <h3><?php echo $order_item['quantity'] ?? '' ?></h3>
                    </div>
                    <div class="text-xs md:text-sm font-semibold flex gap-4 py-1 md:px-4">
                        <h3>Order Weight</h3>
                        <h3>:</h3>
                        <h3><?php echo $order_item['weight'] ?? '' ?></h3>
                    </div>
                    <div class="text-xs md:text-sm font-semibold flex gap-4 py-1 md:px-4">
                        <h3>Order Size</h3>
                        <h3>:</h3>
                        <h3><?php echo $order_item['size'] ?? '' ?></h3>
                    </div>
                    <div class="text-xs md:text-sm font-semibold flex gap-4 py-1 md:px-4">
                        <h3>Order Color</h3>
                        <h3>:</h3>
                        <h3><?php echo $order_item['color'] ?? '' ?></h3>
                    </div>
                </div>
                <div class="w-1/4">
                    <img class="aspect-square object-cover" src="<?php echo $order_item['product']['thumbnail'] ?? '' ?>" alt="">
                </div>
            </div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if(!isset($orderWithOrderItem)) { ?>
        <h1>No Order Available</h1>
    <?php } ?>
</div>