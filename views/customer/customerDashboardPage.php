<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>

<section class="md:py-4 md:py-10">
    <div class="container mx-auto">
        <!-- Layouts -->
        <div class="md:flex  gap-4">
            <!-- Left Side -->
            <div class="w-full  md:w-1/4 bg-white md:py-4">
            <?php include_once VIEWS . 'customer/customerSideNavigationSection.php'; ?>
            </div>

            <!-- Right Side -->
            <div class="w-full md:w-3/4 bg-white p-4">
                <?php include_once VIEWS . 'customer/orderItemListSection.php'; ?>
            </div>
        </div>

    </div>
</section>


<?php include_once VIEWS . 'partials/footer.php'; ?>