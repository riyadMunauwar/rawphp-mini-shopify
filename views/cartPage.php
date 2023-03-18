<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>

<!-- Cart Page -->
<section  data-customer="<?php echo CUSTOMER['id']; ?>" data-domain="<?php echo routeWithDomain(); ?>"  class="md:py-4" id="cartPage">

</section>

<script defer crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
<script defer crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
<script defer crossorigin src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>


<?php include_once VIEWS . 'partials/footer.php'; ?>



<script defer type="text/babel">

    window.onload = function(){

      const sectionDiv = document.getElementById('cartPage');
      const customerID = sectionDiv.dataset.customer;

  
     

      const CartPageSection = () => {

    
          // State
          const [carts, setCarts] = React.useState([]);
          const [shippingCosts, setShippingCosts] = React.useState([]);
          const [subTotalPrice, setSubTotalPrice] = React.useState(0);
          const [totalDiscount, setTotalDiscount] = React.useState(0);
          const [subTotalWithDiscount, setSubTotalWIthDiscount] = React.useState(0);
          const [shippingCost, setShippingCost ] = React.useState(0);
          const [shippingSelect, setShippingSelect ] = React.useState(false);

          const [totalPrice, setTotalPrice] = React.useState(0);

            

        const getDomain = () => {
          return document.getElementById('cartPage').dataset.domain;
        }


          React.useEffect(async () => {
            
            const response = await fetch(`${getDomain()}api/cart?cid=${customerID}`);
            const cartsData = await response.json();

            if(cartsData.data){
              setCarts([...cartsData.data.carts]);
              setShippingCosts([...cartsData.data.shipping_costs]);
            } 

            
          }, [])


          React.useEffect(() => {

            setSubTotalPrice(countSubTotalPriceWithoutDiscount());
            setSubTotalWIthDiscount(countSubTotalPriceWithDiscount());
            setTotalDiscount(countSubTotalPriceWithoutDiscount() - countSubTotalPriceWithDiscount());
            
            
          },[carts])


          React.useEffect(() => {
            setTotalPrice(countTotalPrice());
          },[subTotalWithDiscount, shippingCost] )






          // Increase Quantity Handeler
          const increasQuantityHandeler = async (id) => {

            // prev state
            const prevState = [...carts];

            const all = [...carts];
            const index = carts.findIndex(item => item.id === id);
            const cart = carts.find(item => item.id === id);

            all.splice(index, 1);

            let quantity = cart.quantity;
            quantity++;

            if(quantity > cart.stock_quantity){
              quantity--;
            }

            const updateCart = {...cart, quantity};
            
      
            all.push(updateCart);

            all.sort((a, b) => a.id - b.id);

            setCarts([...all]);

            const response = await fetch(`${getDomain()}api/cart-quantity?cart-id=${id}&quantity=${quantity}`);
            const data = await response.json();

            if(data.status === 'success'){
              // Do Something
            }
            else{
              setCarts(...prevState);
            }

          }



          

          // Decrease Quantity handeler
          const decreaseQuantityHandeler = async (id) => {

            // prev state
            const prevState = [...carts];


            const all = [...carts];
            const index = carts.findIndex(item => item.id === id);
            const cart = carts.find(item => item.id === id);

            all.splice(index, 1);

            let quantity = cart.quantity;
            quantity--;

            if(quantity < 1){
              quantity++;
            }

            const updateCart = {...cart, quantity};
            all.push(updateCart);

            all.sort((a, b) => a.id - b.id);

            setCarts([...all]);

            // Also update to server
            const response = await fetch(`${getDomain()}api/cart-quantity?cart-id=${id}&quantity=${quantity}`);
            const data = await response.json();

            if(data.status === 'success'){
              // Do Something
            }
            else{
              setCarts(...prevState);
            }
            
          }


          // Price With Discount
          const priceWithDiscount = (originialPrice, discount) => {
              let discountAmount = ( originialPrice * discount) / 100;
              return originialPrice - discountAmount;
          }



          // Calculate Total Price
          const countTotalPrice = () => {
            return subTotalWithDiscount + parseInt(shippingCost);
          }


          // Calculate Subtotal Price With Discount
          const countSubTotalPriceWithDiscount = () => {
            let total = 0;

            carts.forEach(item => {
              let price = 0;

              if(item.discount){
                price = priceWithDiscount(item.unit_price, item.discount)
              }
              else{
                price = item.unit_price;
              }
              

              total += item.quantity * price;
            })

            return total;

          }



          // Calculate Subtotal Without Discount
          const countSubTotalPriceWithoutDiscount = () => {
              let total = 0;

              carts.forEach(item => {    
                total += item.quantity * item.unit_price;
              })

              return total;
          }


       


          const removeItemFromCart = async (id) => {
              const index = carts.findIndex(item => item.id === id);
              const cart = carts.find(item => item.id === id);
              const allCarts = [...carts];
              allCarts.splice(index, 1);

              setCarts([...allCarts]);

              const response = await fetch(`${getDomain()}api/cart-remove?cart-id=${id}`);
              const res = await response.json();

              if(res.status === 'success'){
                // Do Something
              }else{
                setCarts(prev => ([...prev, cart]))
              }
              
          }


          const buttonDisabledCSS = () => {
            if(!shippingSelect){
              return 'cursor-not-allowed bg-gray-400 text-gray-500';
            }
          }


          const activeShippingAreaCSS = (amount) => {
            if(shippingCost === amount){
              return 'border-blue-500 text-blue-500';
            }
          }


          const handleShippingCost = (amount) => {
            setShippingSelect(true);
            setShippingCost(amount);
          }

          const toFixed = (num) => {
            return parseFloat(num).toFixed(2);
          }


            return(
              <div className="container bg-white mx-auto px-3 md:px-6">
                <div className="grid grid-cols-1 md:grid-cols-3">

                    <div className="col-span-2 border-r">
                        <h3  className="mt-20 mb-5 text-2xl">Shopping cart</h3>

                      
                        <div>
                                <div className="grid grid-cols-5 md:grid-cols-6 py-5 border-y text-xs md:text-sm">
                                    <div className="font-semibold"></div>
                                    <div></div>                  
                                    <div className="hidden md:block font-semibold">Product</div>
                                    <div className="font-semibold">Price</div>
                                    <div className="font-semibold">Quantity</div>
                                    <div className="font-semibold">Subtotal</div>
                                </div>

                          { carts.map(item => <CartItem removeItemFromCart={removeItemFromCart}  increasQuantityHandeler={increasQuantityHandeler} decreaseQuantityHandeler={decreaseQuantityHandeler}  key={item.id} cart={item} />) }


                        </div>
                          
                    </div>
                  


                  <div className="p-5">

                        <h2 className="text-xl text-bold mb-8">Cart Total</h2>


                        <div className="flex justify-between border-y py-5">
                            <h2>Subtotal</h2>
                            <h2>Tk {toFixed(subTotalPrice)}</h2>
                        </div>

                        <div className="flex justify-between border-b py-5">
                            <h2>Total Discount</h2>
                            <h2>Tk {toFixed(totalDiscount)}</h2>
                        </div>

                        <div className="flex justify-between border-b py-5">
                            <h2>Discount Price</h2>
                            <h2>Tk {toFixed(subTotalWithDiscount)}</h2>
                        </div>

                        <div className="flex justify-between border-b py-5">
                            <h2>Shipping cost</h2>
                            <h2>Tk {toFixed(shippingCost)}</h2>
                        </div>

                        <div className="flex flex-col justify-between py-5 mb-10">
                            <h2 class="mb-4">Select Shipping Area</h2>

                            <div>
                              {
                                shippingCosts.map(item => {
                                  return (
                                    <div onClick={() => handleShippingCost(item.cost_amount) }  key={item.id} class={`${activeShippingAreaCSS(item.cost_amount)} border mb-2 flex items-center cursor-pointer hover:border-blue-500 hover:text-blue-400`}>
                                        <span class="block py-2 px-5 text-sm font-semibold ">{item.title}</span>
                                        <span class="text-sm font-semibold">TK {item.cost_amount}</span>
                                    </div>
                                  )
                                })
                              }
                            </div>

                        </div>


                        <div className="flex justify-between border-y py-3 mb-10">
                            <h2 className="text-xl font-semibold">Total</h2>
                            <h2 className="text-xl">Tk {toFixed(totalPrice)}</h2>
                        </div>

                        <form action={`${getDomain()}create-order`} method="POST">
                          <input name="gdp" type="hidden" value={totalDiscount} />
                          <input name="gtp" type="hidden" value={totalPrice} />
                          <input name="sc" type="hidden" value={shippingCost} />
                          { ! shippingSelect ? <h2 class="text-xs font-semibold border py-2 px-4 mb-4 text-red-400 border-red-400">You don't select shipping area. Select it please.</h2> : ''}
                          <button disabled={!shippingSelect} class={` py-3 px-4 bg-black text-white cursor-pointer ${buttonDisabledCSS()}`} >Proceed Order</button>
                        </form>

                    </div>
                </div>
            </div>
            )
      }


      const CartItem = ({cart, removeItemFromCart, increasQuantityHandeler, decreaseQuantityHandeler}) => {



       const   debounce = (func, wait, immediate) => {
              var timeout;

              return function executedFunction() {
                var context = this;
                var args = arguments;
                  
                var later = function() {
                  timeout = null;
                  if (!immediate) func.apply(context, args);
                };

                var callNow = immediate && !timeout;
              
                clearTimeout(timeout);

                timeout = setTimeout(later, wait);
              
                if (callNow) func.apply(context, args);
              };
            };

      // calculate Sub Total
      const subTotal = (unitPrice, qty) => {
        return unitPrice * qty;
      }




      // Price With Discount
      const priceWithDiscount = (originialPrice, discount) => {
            let discountAmount = ( originialPrice * discount) / 100;
            return originialPrice - discountAmount;
      }
    

    
      const toFixed = (num) => {
            return parseFloat(num).toFixed(2);
        }

      // SubTotal
      const subTotalPrice = (cart) => {
        if(cart.discount){
          return (
            <div>
              <del class="text-red-400 text-xs font-semibold">Tk {subTotal(cart.unit_price, cart.quantity)}</del>
              <span class="block text-xs">Tk {toFixed(priceWithDiscount(subTotal(cart.unit_price, cart.quantity), cart.discount))}</span>
            </div>
          )
        }

        return <span>Tk {toFixed(subTotal(cart.unit_price, cart.quantity))}</span>
      } 

      // Single Price
      const singlePrice = (cart) => {
        if(cart.discount){
          return (
            <div>
              <del class="text-red-400 font-semibold">Tk {cart.unit_price}</del>
              <span class="block">Tk {toFixed(priceWithDiscount(cart.unit_price, cart.discount))}</span>
            </div>
          )
        }

        return <span>Tk {cart.unit_price}</span>
      }

     

  


      const ProductVariant = cart.size || cart.color || cart.weight;

        return(
          <div className="grid grid-cols-5 gap-1 md:grid-cols-6 py-3 md:py-5 border-y text-xs md:text-sm items-center">
                                  
                     <div class="flex justify-between items-center">
                      {/*Cross Icon*/}
                      <div onClick={() => debounce(removeItemFromCart(cart.id),1)} className="font-semibold cursor-pointer">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-4 w-5 md:w-5 md:h-5">
                             <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </div>

                      {ProductVariant ?  <span class="leading-tight text-[8px] md:text-xs block py-1 px-2 border ">{ProductVariant}</span> : '' }
                     </div>


                        {/*Image*/}          
                      <div class="">
                         <img className="block w-10 h-10 md:w-20 md:h-20 object-cover" src={cart.thumbnail} alt="" />         
                      </div>

                         {/*Product name*/}         
                      <div className="hidden md:block pr-2 text-xs">{cart.name}</div>
                                    

                                
                        {/*Price*/}        
                      <div className="text-xs">
                          {singlePrice(cart)}
                      </div>

                                  
                        {/*Quantity*/}            
                      <div className="flex items-center space-x-1 md:space-x-3">
                         <span className="cursor-pointer" onClick={() => debounce(decreaseQuantityHandeler(cart.id),1)}>
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="h-4 w-4 md:w-6 md:h-6">
                                   <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 12h-15" />
                                </svg>
                          </span>

                         <span>{cart.quantity}</span>

                         <span className="cursor-pointer" onClick={() => debounce(increasQuantityHandeler(cart.id),1)}>
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="h-4 w-4 md:w-6 md:h-6">
                                   <path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                               </svg>
                         </span>

                    </div>

                       {/*Sub Total*/}           
                  <div className="text-xs md:text-base">{subTotalPrice(cart)}</div>


              </div>
        )
      }










    // Render
    const rootDiv = document.getElementById('cartPage');
    const root = ReactDOM.createRoot(rootDiv);
    root.render(<CartPageSection/>);

    }

            



</script>
