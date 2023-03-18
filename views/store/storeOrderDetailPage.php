<?php include_once VIEWS . 'store/partials/storeHeaderSection.php'; ?>


<main class="bg-gray-100 dark:bg-gray-800 md:h-screen md:overflow-hidden  relative">
    <div class="md:flex items-start justify-between">

        <!-- SideBar -->
        <div class="md:h-screen lg:block md:my-4 md:ml-4 shadow-lg relative w-full md:w-80">
            <!-- Navigation bar -->
            <?php include_once VIEWS . 'store/partials/storeSideNavigationSectionTwo.php'; ?>
        </div>



        <!-- Right Side Of  -->
        <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">

            <!-- Header -->
            <?php include_once VIEWS . 'store/partials/storeHeaderSectionTwo.php'; ?>

            <!-- store Dashboard Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
             
        <?php
            $order = $data['order'] ?? [];
            $orderId = $data['order']['id'] ?? null;
        ?>      
            <!-- Content Start -->

                    <!--order functionality section -->
                    <div class="bg-white p-3 md:p-7">

                        <?php if(has('error', QUERY)) { ?>
                            <div class="bg-red-500 text-white py-1 px-2 my-2">
                                <?php echo queryMessage(QUERY['error']) ?>
                            </div>
                        <?php } ?>

                        <?php if(has('success', QUERY)) { ?>
                            <div class="bg-green-600 text-white py-1 px-2 my-2">
                                <?php echo queryMessage(QUERY['success']) ?>
                            </div>
                        <?php } ?>

                        <div class="flex justify-between ">
                            <h1 class="text-md mb-3 font-bold">Order Product Stock Details</h1>
                            <h1 class="text-md mb-3 font-bold">Order ID : <?php echo $order['id'] ?? '' ?></h1>
                        </div>

                        <!-- Order Stock Information -->
                        <!-- Single Product Stock Start -->
                        <?php foreach($order['order_items'] ?? [] as $order_item) { ?>
                        <div class="border mb-4 shadow">
                            <!-- header start -->
                                <div class="flex justify-between  py-2 px-2 text-xs">                   
                                    <h2 class="flex-1 font-semibold"><?php echo $order_item['product']['name'] ?? '-' ?></h2>
                                    <h2 class="flex-1">Order Quantity :  <?php echo $order_item['quantity'] ?? '-' ?>/Pcs</h2>
                                    <h2 class="flex-1">Order Size :  <?php echo $order_item['size'] ?? '-' ?></h2>
                                    <h2 class="flex-1">Order Color :  <?php echo $order_item['color'] ?? '-' ?></h2>
                                    <h2 class="flex-1">Order Weight :  <?php echo $order_item['weight'] ?? '-' ?></h2>
                                    <h2 class="flex-1">Stock :  <?php echo $order_item['product']['stock_quantity'] ?? '' ?>/Pcs</h2>
                                </div>
                            <!-- Header end -->
                            <!-- Body Start -->
                                <div class="p-4">
                                    <div class="md:w-full  w-full mx-auto overflow-auto">
                                        <table class="table-auto w-full text-left whitespace-no-wrap">

                                            <?php if(has('variation', $order_item['product'])) { ?>

                                                <thead class="" >
                                                    <tr class="bg-gray-500">
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs  rounded-tl rounded-bl">Variant ID</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Image</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Stock Quantity</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Size</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Color</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Weight</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach( $order_item['product']['variation'] ?? [] as $variant ) { ?>

                                                            <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                                <td class="py-1 px-2 text-xs">#<?php echo $variant['id'] ?? '' ?></td>
                                                                <td class="py-1 px-2 text-xs"><img class="w-5 h-5 rounded-md" src="<?php echo $variant['photo'] ?? '' ?>" alt=""></td>
                                                                <td class="py-1 px-2 text-xs"><?php echo $variant['stock_quantity'] ?? '-' ?>/Pcs</td>
                                                                <td class="py-1 px-2 text-xs"><?php echo $variant['size'] ?? '-' ?></td>
                                                                <td class="py-1 px-2 text-xs"><?php echo $variant['color'] ?? '-' ?></td>
                                                                <td class="py-1 px-2 text-xs"><?php echo $variant['weight'] ?? '-' ?></td>
                                                            </tr>
                                                                                            
                                                    <?php  } ?> 
                                                </tbody> 

                                            <?php }else { ?>

                                                <h2 class="text-sm font-semibold ">This Product Has No Variant.</h2>

                                            <?php } ?>

                                        </table>
                                    </div>
                                    <!-- Table end -->
                                    <!-- Order Stock Information End -->
                                </div>
                            <!-- Body End -->
                        </div>
                        <!-- Single Product Stock Start -->
                        <?php } ?>


                        <!-- Status Order -->
                                <div>
                                     <h1 class="text-md mb-3 font-bold">Order Status</h1>

                                    <div class="md:w-full  w-full mx-auto overflow-auto">
                                        <table class="table-auto w-full text-left whitespace-no-wrap">
                                                <thead class="" >
                                                    <tr class="bg-yellow-500">
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Total</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Recieved Amount</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Due Amount</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Payment Method</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Shipping Method</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Order Status</th>
                                                        <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Payment Status</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                        <tr class="bg-gray-200 hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                            <td class="py-1 px-2 text-xs">Tk <?php echo $order['grand_total_price'] ?? 0 ?></td>
                                                            <td class="py-1 px-2 text-xs">Tk <?php echo $order['recieved_amount'] ?? 0 ?></td>
                                                            <td class="py-1 px-2 text-xs">Tk <?php echo $order['due_amount'] ?? 0  ?></td>
                                                            <td class="py-1 px-2 text-xs"><?php echo $order['payment_method'] ?? '-' ?></td>
                                                            <td class="py-1 px-2 text-xs"><?php echo $order['shipping_method'] ?? '-' ?></td>
                                                            <td class="py-1 px-2 text-xs"><?php echo $order['order_status'] ?? '-' ?></td>
                                                            <td class="py-1 px-2 text-xs"><?php echo $order['payment_status'] ?? '-' ?></td>
                                                        </tr>
                                                </tbody> 
                                        </table>
                                    </div>
                                    <!-- Table end -->
                                </div>
                            <!-- Status Order End -->
                        <!-- Date and Shipping Method -->
                        <form action="<?php route('store/confirm-order') ?>" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $order['id'] ?>">
                       <div>
                            <div class="flex flex-col mt-3">
                                <label class="text-sm font-semibold" for="date">Shipping Date</label>
                                <input name="shipping_date" class="focus:outline-0 border w-full md:w-1/3 text-sm py-1 px-2 mt-2" id="date" type="date" value="">
                            </div>
                            <div class="flex flex-col mt-3">
                                <label class="text-sm font-semibold" for="shipper_id">Shipping Method</label>
                                <select name="shipper_id" id="shipper_id" class="focus:outline-0 border w-full md:w-1/3 text-sm py-1 px-2 mt-2" name="shipping_method_id" id="">
                                    <?php foreach($order['shippers'] ?? [] as $shipper) { ?>
                                        <option value="<?php echo $shipper['id'] ?>"><?php echo $shipper['name'] ?? '' ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                       </div>
                        <!-- Navigation Order -->
                        <div class="flex justify-end space-x-2 mt-3">
                            <!-- Conditionally Show Button -->
                            <?php if($order['order_status'] === 'pending' ) { ?>
                                
                                <button class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm">Confirm Order</button>
                          
                            <?php } ?>

                            <?php if($order['order_status'] === 'processing' ) { ?>

                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=paid&order-id=$orderId") ?>">Mark as Paid</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=shiped&order-id=$orderId") ?>">Mark as Shiped</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=canceled&order-id=$orderId") ?>">Cancel Order</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=refunded&order-id=$orderId") ?>">Mark as Refunded</a>

                                <a id="print-btn" class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm cursor-pointer">Print Invoice</a>
                                <button class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm">Update</button>

                        
                            <?php } ?>

                            <?php if($order['order_status'] === 'shiped' ) { ?>

                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=paid&order-id=$orderId") ?>">Mark as Paid</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=canceled&order-id=$orderId") ?>">Cancel Order</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=refunded&order-id=$orderId") ?>">Mark as Refunded</a>
                                
                                <a id="print-btn" class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm cursor-pointer">Print Invoice</a>
                                <button class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm">Update</button>

                            <?php } ?>

                            <?php if($order['order_status'] === 'paid' ) { ?>
                                
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=processing&order-id=$orderId") ?>">Mark as Processing</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=canceled&order-id=$orderId") ?>">Cancel Order</a>
                                <a class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm" href="<?php route("store/order-status?status=refunded&order-id=$orderId") ?>">Mark as Refunded</a>
                                
                                <a id="print-btn" class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm cursor-pointer">Print Invoice</a>
                                <button class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm">Update</button>

                            <?php } ?>

                            <?php if($order['order_status'] === 'canceled' ) { ?>

                                <button class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm">Confirm Again</button>
    
                            <?php } ?>


                            <?php if($order['order_status'] === 'refunded' ) { ?>

                                <button class="py-1 px-4 bg-indigo-500 text-white text-xs rounded-sm">Confirm Again</button>      
                        
                            <?php } ?>


                        </div>
                        </form>
                    </div>
                    <!-- Below section for printing Order Invoice -->
                    <section id="invoice-printing" class="bg-white p-3 md:p-7 border mt-4">
                        
                            
                        <div class="flex justify-between ">
                            <h1 class="text-md mb-3 font-bold">Order Details</h1>
                            <h1 class="text-md mb-3 font-bold">Order ID : <?php echo $order['id'] ?? '' ?></h1>
                        </div>
                       

                        <!-- Address Information Start -->
                        <div class="flex">
                            <!-- Customer Info -->
                            <div class="w-full md:w-1/3 text-xs font-bold text-gray-600 mr-10">
                                <h2 class="text-sm mb-3">Customer Information</h2>
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <tbody>
                                        <tr>
                                            <td>Customer name</td>
                                            <td>:</td>
                                            <td><?php echo $order['customer']['name'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Customer email</td>
                                            <td>:</td>
                                            <td><?php echo $order['customer']['email'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Customer phone</td>
                                            <td>:</td>
                                            <td><?php echo $order['customer']['phone'] ?? '' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Billing Adress Info -->
                            <div class="w-full md:w-1/3 text-xs font-bold text-gray-600">
                                <h2 class="text-sm mb-3">Billing Information</h2>
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td><?php echo $order['full_name'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>:</td>
                                            <td><?php echo $order['mobile_no'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>House No</td>
                                            <td>:</td>
                                            <td><?php echo $order['house_no'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Colony</td>
                                            <td>:</td>
                                            <td><?php echo $order['colony'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Region</td>
                                            <td>:</td>
                                            <td><?php echo $order['region'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>:</td>
                                            <td><?php echo $order['city'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Area</td>
                                            <td>:</td>
                                            <td><?php echo $order['area'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>:</td>
                                            <td><?php echo $order['address'] ?? '' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="w-full md:w-1/3 text-xs font-bold text-gray-600">
                                <h2 class="text-sm mb-3">Date</h2>
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <tbody>
                                        <tr>
                                            <td>Order Date</td>
                                            <td>:</td>
                                            <td><?php echo $order['order_date'] ?? '' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Date</td>
                                            <td>:</td>
                                            <td><?php echo $order['shipping_date'] ?? '' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Address Information End -->


                        <!-- Order Items Detail Start -->
                        <!-- Table Start -->
                        <div class="md:w-full  w-full mx-auto overflow-auto mt-6">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <?php if(has('order_items', $order)) { ?>

                                    <thead class="" >
                                        <tr class="bg-red-400">
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs  rounded-tl rounded-bl">ID</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Product name</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Image</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Color</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Size</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Weight</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Quanity</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Unit Price</th>
                                            <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Sub Total</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                             $grand_total = 0;
                                        ?>

                                    <?php foreach( $order['order_items'] ?? [] as $order_item ) { ?>

                                                <?php 
                                                    $subtotal = ($order_item['quantity'] * $order_item['price']);
                                                    $grand_total += $subtotal;
                                                    
                                                ?>

                                                <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                    <td class="py-1 px-2 text-xs">#<?php echo $order_item['id'] ?? '' ?></td>
                                                    <td class="py-1 px-2 text-xs w-1/5"><?php echo $order_item['product']['name'] ?? '' ?></td>
                                                    <td class="py-1 px-2 text-xs"><img class="w-10 w-10 rounded-md" src="<?php echo $order_item['product']['thumbnail'] ?? '' ?>" alt=""></td>
                                                    <td class="py-1 px-2 text-xs text-xs "><?php echo $order_item['color'] ?? '-' ?></td>
                                                    <td class="py-1 px-2 text-xs text-xs "><?php echo $order_item['size'] ?? '-' ?></td>
                                                    <td class="py-1 px-2 text-xs text-xs "><?php echo $order_item['weight'] ?? '-' ?></td>
                                                    <td class="py-1 px-2 text-xs text-xs "><?php echo $order_item['quantity'] ?? '-' ?></td>
                                                    <td class="py-1 px-2 text-xs ">Tk <?php echo $order_item['price'] ?? '-' ?></td>
                                                    <td class="py-1 px-2  text-xs text-center">Tk <?php echo  $subtotal ?? '-' ?></td>
                                                </tr>
                                                                                
                                        <?php  } ?> 

                                                <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs text-xs "></td>
                                                    <td class="py-1 px-2 text-xs text-xs "></td>
                                                    <td class="py-1 px-2 text-xs text-xs "></td>
                                                    <td class="py-1 px-2 text-xs text-xs font-bold">Grand Total</td>
                                                    <td class="py-1 px-2 text-sm font-bold"> :</td>
                                                    <td class="py-1 px-2  text-xs font-semibold text-left">Tk <?php echo $grand_total ?? '-' ?></td>;
                                                </tr>
                                                <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs text-xs "></td>
                                                    <td class="py-1 px-2 text-xs text-xs "></td>
                                                    <td class="py-1 px-2 text-xs text-xs "></td>
                                                    <td class="py-1 px-2 text-xs text-xs font-bold">Shipping Cost</td>
                                                    <td class="py-1 px-2 text-sm font-bold"> :</td>
                                                    <td class="py-1 px-2  text-xs font-semibold text-left">Tk <?php echo $order['shipping_cost'] ?? '-' ?></td>;
                                                </tr>
                                                <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-sm font-bold">Payment Method</td>
                                                    <td class="py-1 px-2 text-xs">:</td>
                                                    <td class="py-1 px-2 text-xs text-sm font-bold "><?php echo $order['payment_method'] ?? '-' ?></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs text-xs font-bold">Grand Total Discount</td>
                                                    <td class="py-1 px-2 text-sm font-bold"> :</td>
                                                    <td class="py-1 px-2  text-xs font-semibold text-left">Tk <?php echo $order['grand_total_discount'] ?? '-' ?></td>;
                                                </tr>
                                                <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs font-bold">Total</td>
                                                    <td class="py-1 px-2 text-sm font-bold"> :</td>
                                                    <td class="py-1 px-2  text-xs font-semibold text-left">Tk <?php echo $order['grand_total_price'] ?? '-' ?></td>;
                                                </tr>
                                                <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs text-xs font-bold">Payment Recieved</td>
                                                    <td class="py-1 px-2 text-sm font-bold"> :</td>
                                                    <td class="py-1 px-2  text-xs font-semibold text-left">Tk <?php echo $order['recieved_amount'] ?? '-' ?></td>;
                                                </tr>
                                                <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs"></td>
                                                    <td class="py-1 px-2 text-xs text-xs font-bold">Payment Due</td>
                                                    <td class="py-1 px-2 text-sm font-bold"> :</td>
                                                    <td class="py-1 px-2  text-xs font-semibold text-left">Tk <?php echo $order['due_amount'] ?? '-' ?></td>;
                                                </tr>
                                    </tbody> 

                                <?php }else { ?>

                                    <h2 class="text-lg font-semibold ">No Order Available</h2>

                                <?php } ?>

                            </table>
                        </div>
                        <!-- Table end -->
                        <!-- Order Items Detail End -->
                    </section>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End-->
        </div>
    </div>
</main>

<script defer>
    (function(){
        var  body = document.querySelector('body');
        var  printBtn = document.getElementById('print-btn');
        var  invoice = document.getElementById('invoice-printing').innerHTML;
        var prevBody = body.innerHTML;


        printBtn.addEventListener('click', function(event){
                    body.innerHTML = invoice;
                    window.print();
                    body.innerHTML = prevBody;
        });


    })()
</script>

<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>