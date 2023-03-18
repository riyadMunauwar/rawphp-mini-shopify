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
                <div class="text-sm font-semibold">
                    <h1 class="border-b py-2">Name : <?php echo CUSTOMER['name'] ?? '' ?></h1>
                    <h1 class="border-b py-2">Email : <?php echo CUSTOMER['email'] ?? '' ?></h1>
                    <h1 class="border-b py-2">Phone : <?php echo CUSTOMER['phone'] ?? '' ?></h1>
                </div>
            </div>
        </div>

    </div>
</section>


<?php include_once VIEWS . 'partials/footer.php'; ?>