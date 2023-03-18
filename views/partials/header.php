
    <!-- Custom Script Dynamically Coming from Indicudual Store -->
        <?php
            load(MODELS, 'Script');
            load(MODELS, 'ShoppingCart');
            load(MODELS, 'Store');

            try
            {
                $scriptStmt = new Script(STORE_DATABASE);
                $script = $scriptStmt->findByStoreId(STORE_ID);

                $storeStmt = new Store(STORE_DATABASE);
                $store_name = $storeStmt->findStoreNameByStoreId(STORE_ID)['name'];
                $store_logo = $storeStmt->findStoreLogoByStoreId(STORE_ID)['logo'];
                
                if($script){
                    echo $script['script'] ?? '';
                }
                
                
                if(isCustomerLogin()){
                    $shoppingCartStmt = new ShoppingCart(STORE_DATABASE);
                    $countCartItem = $shoppingCartStmt->countCartItemByCustomerId(AuthCustomer()['id']);
                }

                
            }
            catch(\PDOException $e)
            {
                echo 'Error is coming from head.php ' . $e->getMessage();
            }

          

        ?>

        
    <!-- Header -->
    <header id="findUrlForSearching" data-domain="<?php echo routeWithDomain(); ?>" class="hidden md:block py-3 sm:py-4 border-b dark:border-gray-700 dark:text-gray-100 sticky top-0 left-0 bg-white dark:bg-gray-900 z-50 px-3">
        <div class="container mx-auto">
            <nav class="flex items-center justify-between">
              
              <!-- Logo -->
              <div class="w-1/4">
                <a class="w-3/4" href="<?php route(' ') ?>">
                    <?php if($store_logo) { ?>
                        <img class="block aspect-[5:1]" src="<?php echo $store_logo ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtzScA5CS9Xv2YjCKbQVcMSVv31KYqu3L_13k2ib1-Dw5cTExaujuDT3sGH15xXgWBTh4&usqp=CAU' ?>" alt="">
                    <?php } else { ?>
                        <h1 class="text-2xl font-semibold"><?php echo $store_name ?? 'Logo'  ?></h1>
                    <?php } ?>
                </a>
  
                <!-- <h1>Ecommerce</h1> -->
              </div>
  
              <!-- Search Box -->
              <div id="search-vue"  class="w-1/2 hidden md:block relative">
  
                    <div class="flex border dark:border-themePrimaryLight">
                        <input  v-model="searchQuery" class="w-4/5 focus:outline-none py-2 px-8 dark:bg-gray-800" type="text" placeholder="What are your looking for...">
                        <button @click="searchProduct" class="w-1/4 block  py-2 font-semibold px-3 bg-themePrimaryLight text-white">Search</button>
                    </div>
                    
                    <!-- Search Result -->
                    <div id="result"  class="hidden absolute overflow-y-scroll w-full bg-gray-200 top-full left-0">
                        
                         <!-- Loading Spinner -->
                         <div v-if="isLoading" class="flex justify-center py-4">
                            <svg class="w-6 h-6 text-white animate-ping text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>


                         <!-- Cross -->
                        <div v-if="crossIcon" class="flex justify-end">
                            <button @click="resetSearching" class="text-red-400 pr-2 pt-1 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Loading Spinner -->
                         <div v-if="message" class="flex justify-center py-4">
                            <h1 class="font-semibold text-red-400" >No Result Found !</h1>
                        </div>


                        <!-- Item -->
                        <a v-for="item in items" class="m-2 flex gap-2 border bg-white mb-3">
                            <img class="aspect-square block w-1/5" v-bind:src="item.thumbnail" alt="">
                            <div class="w-4/5 p-1">
               
                                <h2 @click="productDetail(item.id)" class="text-blue-600 font-semibold cursor-pointer">{{item.name}}</h2>
                              
                                <span class="text-sm text-red-400 font-bold">TK {{item.unit_price}}</span>
                                <span class="block text-xs">Details</span>
                            </div>
                        </a>

                    </div>
              </div>
  
              <!-- Right Menu -->
              <div class="w-1/4 hidden md:block">
                 <div class="flex space-x-4 items-center justify-end">


                  <a class="cursor-pointer" id="darkMoodButton">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                  </a>

                  <a href="<?php route('cart') ?>" class="cursor-pointer relative" id="darkMoodButton">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>

                    <?php if($countCartItem ?? null)  { ?>
                        <span class="absolute top-0 right-0 bg-red-400 text-[9px] font-thin text-white flex items-center justify-center rounded-full w-2/3 h-2/3 block"><?php echo $countCartItem ?? '0' ?></span>
                    <?php } ?>
                  </a>
                

                  <?php if(isCustomerLogin()) { ?>
                        <a href="<?php route('customer/logout'); ?>">Logout</a>
                  <?php }else { ?>
                        <a href="<?php route('customer/login'); ?>">Login</a>
                        <a href="<?php route('customer/register'); ?>">Register</a>
                  <?php } ?>

                  <?php if(isCustomerLogin()) { ?>
                        <a href="<?php route('customer/dashboard') ?>">
                            <div>
                            <span class="w-6 h-6 cursor-pointer bg-gray-300 rounded-full aspect-square block font-xs text-white flex items-center justify-center font-semibold"><?php echo strtoupper(AuthCustomer()['name'][0] ?? '')  ?></span>
                            </div>
                        </a>
                    <?php } ?>


                 </div>
              </div>
  
              <!-- Toggle -->
              <div class="md:hidden">
                <button><img class="h-5 w-5" src="./assets/icons/svg/menu.svg" alt=""></button>
              </div>
  
            </nav>
        </div>
      </header>



      <!-- Mobile Header -->
    <header class="md:hidden py-2 sm:py-4 border-b sticky top-0 left-0 bg-white z-50 px-3">
        <div class="container mx-auto">
            <nav class="flex items-center justify-between">
              
              <!-- Logo -->
              <div class="w-1/4">
                    <a class="w-3/4" href="<?php route(' ') ?>">
                        <?php if($store_logo) { ?>
                            <img class="block w-full" src="<?php echo $store_logo ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtzScA5CS9Xv2YjCKbQVcMSVv31KYqu3L_13k2ib1-Dw5cTExaujuDT3sGH15xXgWBTh4&usqp=CAU' ?>" alt="">
                        <?php } else { ?>
                            <h1 class="text-xl font-semibold"><?php echo $store_name ?? 'Logo'  ?></h1>
                        <?php } ?>
                    </a>
              </div>
  
              <!-- Right Side -->
              <div class="flex items-center">
                    <div id="mobile-search-open-btn" class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <?php if(isCustomerLogin()) { ?>
                        <div id="mobile-login-nav-open-btn">
                           <span class="w-5 h-5 bg-gray-300 rounded-full aspect-square block font-xs text-white flex items-center justify-center font-semibold"><?php echo strtoupper(AuthCustomer()['name'][0] ?? '')  ?></span>
                        </div>
                    <?php }else { ?>
                        <div id="mobile-login-nav-open-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                    <?php } ?>

              </div>
            </nav>
            
            <!-- Search Bar -->
            <div id="mobile-search-bar"  class="hidden pt-4">
                        <!-- <form class="" action=""> -->
                            <div id="search-vue-mobile" class="flex justify-between items-center gap-2 relative">
                                <input id="searchQuery" class="py-1 px-3 bg-violet-100 text-md rounded-md w-4/5 focus:outline-none" type="text" placeholder="I m looking for...">
                                <button id="searchBtn"  class="w-1/5 flex justify-center bg-red-300 h-full block py-2 rounded-md" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                             <!-- Search Result -->
                            <!--<div class="mt-2 overflow-auto z-50 absolute w-full bg-gray-200 top-full left-0">-->
                            <div class="mt-2 overflow-auto w-full bg-gray-200">
                                <!-- Loading Spinner -->
                                <div id="loadingSpinner" class="hidden flex justify-center py-2">
                                    <svg class="w-6 h-6 text-white animate-ping text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>


                                <!-- Cross -->
                                <div id="crossIcon" class="hidden flex justify-end">
                                    <button @click="resetSearching" class="text-red-400 pr-2 pt-1 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Message -->
                                <div id="message" class="hidden flex justify-center py-2">
                                    <h1 class="font-semibold text-red-400" >No Result Found !</h1>
                                </div>


                                <div id="mobileSearchResult">
                                    <!-- Item -->
                                </div>
                            </div>
                <!-- </form> -->
            </div>


            <!-- Login Registration Button -->
            <div id="mobile-login-nav" class="hidden mt-4 p-2 flex gap-1">
                <?php if(isCustomerLogin()) { ?>
                    <a class="grow text-center py-1 px-3 text-xs bg-gray-400 text-white rounded-sm" href="<?php route('customer/logout') ?>">Logut</a>
                <?php }else { ?>
                    <a class="grow text-center py-1 px-3 text-xs bg-gray-400 text-white rounded-sm" href="<?php route('customer/login') ?>">Login</a>
                    <a class="grow text-center py-1 px-3 text-xs bg-gray-400 text-white rounded-sm" href="<?php route('customer/register') ?>">Register</a>
                <?php } ?>
            </div>

            <!-- Navigation Tabs -->
            <nav class="flex justify-around border-t bg-white fixed w-full block left-0 bottom-0">
                <?php 
                                  
                        function activeWhen($path){
                            if(CURRENT_URI === BASE_PATH . $path)
                            {
                                echo 'bg-violet-400 text-white';
                            }
                        }
                     
                ?>

                <a class="grow" href="<?php route(' ') ?>">
                    <div class="<?php activeWhen('') ?> py-2 flex items-center justify-center flex-col hover:bg-violet-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="text-xs">Home</span>
                    </div>
                </a>

                <a class="grow" href="<?php route('category-page') ?>">
                    <div class="<?php activeWhen('category-page') ?> py-2 flex items-center justify-center flex-col hover:bg-violet-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                        </svg>
                        <span class="text-xs">Category</span>
                    </div>
                </a>
                
                <a class="grow relative" href="<?php route('cart') ?>">
                    <div class="<?php activeWhen('cart') ?> py-2 flex items-center justify-center flex-col hover:bg-violet-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="text-xs">Cart</span>
                        <?php if($countCartItem ?? null) { ?>
                            <span class="absolute top-1 right-2 bg-red-400 text-[9px] font-thin text-white flex items-center justify-center rounded-full w-5 h-5 block"><?php echo $countCartItem ?? '0' ?></span>
                        <?php } ?>
                    </div>
                </a>

                <a class="grow" href="<?php route('customer/order') ?>">
                    <div class="<?php activeWhen('customer/order') ?> py-2 flex items-center justify-center flex-col hover:bg-violet-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                        <span class="text-xs">Order</span>
                    </div>
                </a>


                <a class="grow" href="<?php route('customer/dashboard') ?>">
                    <div class="<?php activeWhen('customer/dashboard') ?> py-2 flex items-center justify-center flex-col hover:bg-violet-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-xs">User</span>
                    </div>
                </a>

            </nav>
        </div>
      </header>
<!-- Vues for Search Functionality Desktop-->
<script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>



<script>
    (function(){

        const { createApp } = Vue

        const DesktopSearchComponent = {
        data() {
            return {
            searchQuery: '',
            isLodaing: false,
            isInit: true,
            crossIcon: false,
            message: '',
            items : []
            }
        },

        mounted(){
            const ref = document.getElementById('result');
            ref.classList.toggle('hidden');
        },

        methods: {
            getDomain(){
                return document.getElementById('findUrlForSearching').dataset.domain;
            },
           async searchProduct(){
                this.items = [];
                this.isLoading = true;
                const response = await fetch(`${this.getDomain()}api/search?search_query=${this.searchQuery}`);
                const data = await response.json();
   
                if(data.status === 'success'){
                   
                    if(data.data){
                        this.isLoading = false;
                        // this.searchQuery = '';
                        this.crossIcon = true;
                        this.items = data.data;
                    }
                    else{
                        this.isLoading = false;
                        this.crossIcon = true;

                        // this.searchQuery = '';
                        this.message = 'No result found !';
                    }
                }
                else
                {
                        this.isLoading = false;
                        this.crossIcon = true;

                        // this.searchQuery = '';
                        this.message = 'No result found !';
                }
                
            },

            productDetail(id){
                this.isLoading = false;
                this.crossIcon = false;
                this.items = [];
                this.message = '';
                window.location.href = `${this.getDomain()}product-detail?p=${id}`;
            },

            resetSearching(){
                this.isLoading = false;
                this.crossIcon = false;
                this.items = [];
                this.message = '';
                
            }

        }
        }


        createApp(DesktopSearchComponent).mount('#search-vue')
 
    })()
</script>

<!-- Mobile Search Functionality -->

<script>
    (function(){

        const element = {
            searchQuery : document.getElementById('searchQuery'),
            searchBtn : document.getElementById('searchBtn'),
            loadingSpinner : document.getElementById('loadingSpinner'),
            crossIcon : document.getElementById('crossIcon'),
            message : document.getElementById('message'),
            searchResult : document.getElementById('mobileSearchResult'),
        }


        const getDomain = () => {
            return document.getElementById('findUrlForSearching').dataset.domain;
        }


        
        const store = {
            searchQuery: '',
            isLodaing: false,
            crossIcon: false,
            message: '',
            items : []
            }

        function renderLoading(){
            if(store.isLodaing){
                element.loadingSpinner.classList.remove('hidden');
                element.loadingSpinner.classList.add('block');
            }
            else{
                element.loadingSpinner.classList.remove('block');
                element.loadingSpinner.classList.add('hidden');
            }
        }


        function renderCrossIcon(){
            if(store.crossIcon){
                element.crossIcon.classList.remove('hidden');
                element.crossIcon.classList.add('block');
            }
            else{
                element.crossIcon.classList.remove('block');
                element.crossIcon.classList.add('hidden');
            }
        }

        function renderMessage(){
            if(store.message){
                element.message.classList.remove('hidden');
                element.message.classList.add('block');
            }
            else{
                element.message.classList.remove('block');
                element.message.classList.add('hidden');
            }
        }



        
        function renderResult(){

            let markup =  '';

            store.items.forEach(item => {
                markup += `
                    <a href="${getDomain()}product-detail?p=${item.id}" class="m-2 flex gap-2 border bg-white mb-3">
                        <div class="w-1/3">
                            <img class="object-cover" src="${item.thumbnail}" alt="">
                        </div>
                        
                            <div class="w-4/5 p-1">           
                            <h2 class="text-sm text-blue-600 font-semibold cursor-pointer">${item.name}</h2>                                         
                            <span class="text-xs text-red-400 font-bold">TK ${item.price}</span>
                            <span class="block text-xs">Details</span>
                        </div>
                    </a>
                    `;
            })
         
            element.searchResult.innerHTML = markup;


        }


        function resetSearching(){
            store.crossIcon = false,
            renderCrossIcon();

            store.message = false;
            renderMessage();

            store.items = [];
            renderResult();
        }


        

        // Search Product Handeler
        async function searchProductHandeler(event){

            if( ! store.searchQuery ) return;
            
            // Init loading
            store.loading = true;
            renderLoading();


            const response = await fetch(`${getDomain()}api/search?search_query=${store.searchQuery}`);
            const finalResponse = await response.json();

            if(finalResponse.status === 'success'){
               
                store.loading = false;
                renderLoading();

                if(finalResponse.data){
                
                
                    store.crossIcon = true;
                    renderCrossIcon();

                    store.items = finalResponse.data;
                    renderResult();
                }
                else
                {
                    store.crossIcon = true;
                    renderCrossIcon();

                    store.message = true;
                    renderMessage();
                }
            }

            // alert(store.searchQuery);
            // renderLoading();
            // renderCrossIcon();
            // renderMessage();
            // renderResult();
        }


        // Bind Input Param
        function bindInput(event){
            store.searchQuery = event.target.value;
        }
        // Add Event

        element.searchBtn.addEventListener('click', searchProductHandeler);
        element.searchQuery.addEventListener('change', bindInput);
        element.crossIcon.addEventListener('click', resetSearching);

    })()
</script>

<script>

    // Dark Mood
    (function(){

        var  darkMoodButton = document.getElementById('darkMoodButton');
        var rootHtml = document.querySelector('html');


        darkMoodButton.addEventListener('click', function(event){
            event.preventDefault();
    
            rootHtml.classList.toggle('dark');
        })

    })()


</script>

<script defer >
        // Mobile Search Bar and Mobile Login Nav Open and Close
        (function(){

                var mobileSearchBarOpenBtn = document.getElementById('mobile-search-open-btn');
                var mobileLoginNavOpenButton = document.getElementById('mobile-login-nav-open-btn');

                var mobileSearchBar = document.getElementById('mobile-search-bar');
                var mobileLoginNav = document.getElementById('mobile-login-nav');


                mobileSearchBarOpenBtn.addEventListener('click', function(event){
                    mobileSearchBar.classList.toggle('hidden');
                })

                mobileLoginNavOpenButton.addEventListener('click', function(event){
                    mobileLoginNav.classList.toggle('hidden');
                })

        })()
</script>