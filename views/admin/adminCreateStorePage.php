



 <?php  include_once VIEWS . 'partials/head.php'; ?>


<main class="bg-gray-100 dark:bg-gray-800 h-screen overflow-hidden relative">
    <div class="flex items-start justify-between">

        <!-- SideBar -->
        <div class="h-screen hidden lg:block my-4 ml-4 shadow-lg relative w-80">
            <!-- Navigation bar -->
            <?php  include_once VIEWS . 'admin/partials/adminSideNavigationSection.php'; ?>
        </div>



        <!-- Right Side Of  -->
        <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">

            <!-- Header -->
            <?php  include_once VIEWS . 'admin/partials/adminHeaderSection.php'; ?>

            <!-- store Dashboard Page Content  Start -->
            <div class="overflow-auto h-screen pb-24 pt-2 pr-2 pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                <section class="max-w-full p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-700">

                    <?php 

                        if(array_key_exists('errors', $data)) { 
                            foreach( $data['errors'] as $error){ ?>
                                
                                <div class="bg-red-400 px-4 py-2 rounded text-white mb-2"> <?php echo $error ?></div>

                        <?php  }
                        }

                    ?>

                    <?php 

                            if(array_key_exists('message', $data)) { 
                            ?>
                                    
                                    <div class="bg-blue-400 px-4 py-2 rounded text-white mb-2"> <?php echo $data['message'] ?? '' ?></div>

                            <?php  }


                        ?>

                        <h2 class="mt-4 text-lg font-semibold text-gray-700 capitalize dark:text-white">Store Account settings</h2>
                        
                        <form action="<?php route("admin/create-store"); ?>" method="POST">
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="domain-name">Domain Name</label>
                                    <input name="domain" value="<?php echo $data['formData']['domain'] ?? '' ?>" id="domain-name" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="emailAddress">Email Address</label>
                                    <input name="email" value="<?php echo $data['formData']['email'] ?? '' ?>" id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="password">Password</label>
                                    <input name="password" value="<?php echo $data['formData']['password'] ?? '' ?>" id="password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="passwordConfirmation">Password Confirmation</label>
                                    <input name="confirm" value="<?php echo $data['formData']['confirm'] ?? '' ?>" id="passwordConfirmation" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>
                            </div>


                            <h2 class="mt-10 text-lg font-semibold text-gray-700 capitalize dark:text-white">Database Settings</h2>


                            <!-- Database Settings -->
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="rdbms">RDBMS Name</label>
                                    <input name="db" value="<?php echo $data['formData']['db'] ?? '' ?>" placeholder="mysql/oracle/etc" id="rdbms" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="databaseName">Database Name</label>
                                    <input name="db_name" value="<?php echo $data['formData']['db_name'] ?? '' ?>" placeholder="" id="databaseName" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="databasehost">Database Host</label>
                                    <input name="db_host" value="<?php echo $data['formData']['db_host'] ?? '' ?>" placeholder="170.02.03.05" id="databasehost" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="dbuser">Database User</label>
                                    <input name="db_user" value="<?php echo $data['formData']['db_user'] ?? '' ?>" id="dbuser" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="dbpassword">Database Password</label>
                                    <input name="db_password" value="<?php echo $data['formData']['db_password'] ?? '' ?>" id="dbpassword" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200" for="dbpassconfirm">Retype database user password</label>
                                    <input name="db_password_confirm" value="<?php echo $data['formData']['db_password_confirm'] ?? '' ?>" id="dbpassconfirm" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>

                            </div>

                            <div class="flex justify-end mt-6">
                                <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-themePrimaryLight rounded-md hover:themePrimaryDark focus:outline-none focus:bg-gray-600">Create</button>
                            </div>
                        </form>
                    </section>
                <!-- Content End -->
            </div>
            <!-- store Dashboard Page Content  End -->
        </div>
    </div>
</main>

<?php  include_once VIEWS . 'partials/foot.php'; ?>