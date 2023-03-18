<!-- Table Start -->
<div class="md:w-full  w-full mx-auto overflow-auto mt-6">
    <table class="table-auto w-full text-left whitespace-no-wrap">

        <?php if(has('orders', $data)) { ?>

            <thead class="" >
                <tr class="bg-red-400">
                    <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs  rounded-tl rounded-bl">ID</th>
                    <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Date</th>
                    <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Total</th>
                    <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Order Status</th>
                    <th class="py-1 px-2 title-font tracking-wider font-medium text-gray-100 text-xs ">Mobile</th>
                    <th class="py-1 px-2 w-10 title-font tracking-wider font-medium text-gray-100 text-xs  rounded-tr rounded-br">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach( $data['orders'] ?? [] as $order ) { ?>

                        <tr class="hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-gray-100 hover:cursor-pointer">
                            <td class="py-1 px-2 text-xs">#<?php echo $order['id'] ?? '' ?></td>
                            <td class="py-1 px-2 text-xs"><?php echo $order['order_date'] ?? '' ?></td>
                            <td class="py-1 px-2 text-xs">Tk <?php echo $order['grand_total_price'] ?? '' ?></td>
                            <td class="py-1 px-2 text-xs text-xs "><?php echo $order['order_status'] ?? '' ?></td>
                            <td class="py-1 px-2 text-xs "><?php echo $order['mobile_no'] ?? '' ?></td>
                            <td class="py-1 px-2 w-10 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="<?php route("store/order-detail?order-id=" . $order['id']) ?>" class="px-2 py-1 rounded-sm bg-themeSecondaryLight text-xs text-white hover:cursor-pointer hover:bg-themeSecondaryDark" > View</a>
                                    <form action="<?php route('store/order/delete')  ?>" method="POST">
                                        <input name="order_id" type="hidden" value="<?php echo $order['id'] ?? '' ?>">
                                        <input name="redirect_route" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                        <button class="px-2 py-1 rounded-sm bg-themeSecondaryLight text-xs text-white hover:cursor-pointer hover:bg-themeSecondaryDark">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                                                         
                <?php  } ?> 
            </tbody> 

        <?php }else { ?>

            <h2 class="text-lg font-semibold ">No Order Available</h2>

        <?php } ?>

    </table>
</div>
<!-- Table end -->







