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
                
            <!-- Add Product Page Content  Start-->
            <div class="md:overflow-auto md:h-screen pb-24 md:pt-2 md:pr-2 md:pl-2 md:pt-0 md:pr-0 md:pl-0">
                <!-- Content Start -->
                    <div id="addProductPage" data-domain="<?php echo routeWithDomain() ?>"></div>
                <!-- Content End -->
            </div>
            <!-- Add Product Page Content  End-->

            
            
        </div>
    </div>
</main>





<script defer crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
<script defer crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
<script defer crossorigin src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>


<script defer type="text/babel">

    window.onload = function(){
        

                const AddProductPage = () => {


                    // Ref
                    const refShortDesc = React.createRef();
                    const refDesc = React.createRef();


                    const [url, setUrl] = React.useState('');
                    const [photoUrl, setPhotoUrl] = React.useState('');
                    const [thumbnail, setThumbnail] = React.useState('');
                    const [videoUrl, setVideoUrl] = React.useState('');

                    const [errors, setErrors] = React.useState(null);

                    const [product, setProduct] = React.useState({
                        name: '',
                        slug: '',
                        unit_price: '',
                        purchase_price: '',
                        discount: '',
                        stock_quantity: '',
                        short_description: '',
                        description: '',
                        thumbnail: '',
                        video_url: '',
                        store_id: '',
                        brand_id: '',
                        category_id: '',
                        gallery: [],
                        variations: [
                            // {
                            //     id: 1,
                            //     name: '',
                            //     unit_price: '',
                            //     photo: '',
                            //     discount: '',
                            //     size: '',
                            //     weight: '',
                            //     color: '',
                            //     color_code: '',
                            //     stock_quantity: '',
                            //     purchase_price: '',
                            //     short_description: '',
                            //     description: ''

                            // }
                        ]
                    })


                    const schema = {
                        name: '',
                        slug: '',
                        unit_price: '',
                        purchase_price: '',
                        discount: '',
                        stock_quantity: '',
                        short_description: '',
                        description: '',
                        thumbnail: '',
                        video_url: '',
                        store_id: '',
                        brand_id: '',
                        category_id: '',
                        gallery: [],
                        variations: [
                            // {
                                // id: 1,
                                // name: '',
                                // unit_price: '',
                                // photo: '',
                                // discount: '',
                                // size: '',
                                // weight: '',
                                // color: '',
                                // color_code: '',
                                // stock_quantity: '',
                                // purchase_price: '',
                                // short_description: '',
                                // description: ''

                            // }
                        ]
                    }


                


                    // binding to url input
                    const onUrlChange = (event) => {
                        
                        let path = event.target.value;
                        
                        if(path.startsWith('uploads/')){
                            let domain = document.getElementById('addProductPage').dataset.domain;
                            path = domain + path;
                        }
                        
                        setUrl(path);
                    }

                    // Binding to thumbnail input
                    const onThumbnailChange = (event) => {
                        let path = event.target.value;
                        
                        if(path.startsWith('uploads/')){
                            let domain = document.getElementById('addProductPage').dataset.domain;
                            path = domain + path;
                        }
                        
                        setThumbnail(path);
                    }

                    // Binding to Video Url
                    const onVideoUrlChange = (event) => {
                        setVideoUrl(event.target.value);
                    }

                    // Binding Input to Photo input url
                    const onPhotoChange = (event) => {
                        setPhotoUrl(event.target.value);
                    }


                    // Add Youtube Video Url to Product
                    const addVideoUrl = () => {
                        
                        if(!videoUrl) return;

                        setProduct(prevState => {
                            return {
                                ...prevState,
                                video_url: videoUrl ,
                                gallery: [...prevState.gallery],
                                variations: [
                                    ...prevState.variations
                                ]
                            }
                        })
                        
                        setVideoUrl('');
                    }

                    // Add Thumbnail To Product
                    const addProductThumbnail  = () => {

                        if(!thumbnail) return;

                        setProduct(prevState => {
                            return {
                                ...prevState,
                                thumbnail: thumbnail,
                                gallery: [...prevState.gallery],
                                variations: [
                                    ...prevState.variations
                                ]
                            }
                        })
                        
                        setThumbnail('');
                    }


                    // Remove Thumbnail
                    const removeThumbnail = () => {
                        setProduct(prevState => {
                            return {
                                ...prevState,
                                thumbnail: '',
                                gallery: [...prevState.gallery],
                                variations: [
                                    ...prevState.variations
                                ]
                            }
                        })
                    }

                    // Remove Varinat Photo
                    const removeVariantPhoto = (varinatId) => {
                        const all  = [...product.variations];
                        const target = all.find(item => item.id === varinatId);

                        const targetIndex = all.findIndex(item => item.id === varinatId);
                        // remove target from the varint
                        all.splice(targetIndex,1);

                        const updateTarget = {...target, photo: ''};
                        // push modifie varint to variations
                        all.push(updateTarget);

                        all.sort((a, b) => a.id - b.id);


                        setProduct(prevState => {
                            return {
                                ...prevState,
                                gallery: [...prevState.gallery],
                                variations: [
                                    ...all,
                                ]
                            }
                        })
                    }

                    // Add variant photo
                   const addPhotoToVarinat = (variant_id) => {

                    if(!photoUrl) return;


                    const allVariant = [...product.variations];
                    const targetVariant = allVariant.find(item => item.id === variant_id);
                    const index = allVariant.findIndex(item => item.id === variant_id);
                    allVariant.splice(index, 1);

                    const updateVarinat = {...targetVariant, photo: photoUrl};
                    allVariant.push(updateVarinat);

                    allVariant.sort((a, b) => a.id - b.id);


                    
                    setProduct(prevState => {
                            return {
                                ...prevState,
                                gallery: [...prevState.gallery],
                                variations: [
                                    ...allVariant,
                                ]
                            }
                        })


                        setPhotoUrl('');

                   } 


                    // Add item to image gallery
                    const addImageToGallery = () => {

                        if(!url) return;

                        const newGallery = [...product.gallery];
                        newGallery.push(url);

                        setProduct(prevState => {
                            return {
                                ...prevState,
                                gallery: [...newGallery],
                                variations: [
                                    ...prevState.variations
                                ]
                            }
                        })

                        setUrl('');
                    }

                    // Remove Item to Image gallery 
                    const removeItemToImageGallery = (galleryItem, index) => {

                        const gallery = [...product.gallery];

                        gallery.splice(index, 1);


                        setProduct(prevState => {
                            return {
                                ...prevState,
                                gallery: [...gallery],
                                variations: [
                                    ...prevState.variations
                                ]
                            }
                        })
                     

                    }



                    // Bind Product Input feild 
                    const bindInputToState = event => {
                        
                        setProduct(prevState => {
                            return {
                                ...prevState,
                                [event.target.id]: event.target.value,
                                gallery: [...prevState.gallery],
                                variations: [
                                    ...prevState.variations
                                ]
                            }
                        })

                    }



            // Bind Variant input field
            const bindVariantInputToState = (event, id) => {

                 let targetVariant = product.variations.find(item => item.id === id);


                 let foundIndex = product.variations.findIndex(item => item.id === id);

    
                 let variations = [...product.variations];
                 variations.splice(foundIndex, 1);

                 variations.push(                            {
                                ...targetVariant,
                                [event.target.id]: event.target.value
                            })

                variations.sort((a, b) => a.id - b.id);


                 setProduct(prevState => {
                    return {
                        ...prevState,
                        gallery: [...prevState.gallery],
                        variations: [
                            ...variations,
                        ]
                    }
                 })


            }





            // Helper find maxId from varaint list
            const maxId = (arr) => {

                let max = 0;

                arr.forEach(item => {
                    if(item.id > max) max = item.id
                })

                return max;
            }



            // Generate Slug

            const generateSlug = () => {
                
                let slug = product.name.toLowerCase().trim().split(' ').join('-');


                setProduct(prevState => {
                    return {
                        ...prevState,
                        slug: slug,
                        gallery: [...prevState.gallery],
                        variations: [
                            ...prevState.variations
                        ]
                    }
                })
            }

            // Bind description



            // Add Variant to variant list
            const addVariant = () => {

                let max = maxId(product.variations);
               

                setProduct(prevState => {
                    return {
                        ...prevState,
                        gallery: [...prevState.gallery],
                        variations: [
                            ...prevState.variations,
                            {
                                id: max + 1,
                                photo: '',
                                size: '',
                                weight: '',
                                color: '',
                                color_code: '',
                                stock_quantity: '',
                            }
                        ]
                    }
                })


            }




            // Revomve Variant from variant list
            const removeVariant = (id) =>  {

                let foundIndex = product.variations.findIndex(item => item.id === id);

                let variations = [ ...product.variations ];

                variations.splice(foundIndex, 1);

     

                setProduct(prevState => {
                    return {
                        ...prevState,
                        gallery: [...prevState.gallery],
                        variations: [
                            ...variations
                        ]
                    }
                })

            }



            const createProduct = async () => {
                
                let domain = document.getElementById('addProductPage').dataset.domain;
             
                const res = await fetch(`${domain}api/store/add-product`,
                    {
                        headers: {
                        // 'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        method: "POST",
                        body: JSON.stringify(product)
                    })

                const response = await res.json();

                
                  

                if(response.status === 'error'){
                    setErrors(response);
                }

                

                if(response.status === 'success'){
                    setErrors(null);
                    setProduct(schema);
                    refShortDesc.current.value = '';
                    refDesc.current.value = '';
                    
                }
               


            }



            





            return (<section id="#top" className="max-w-full p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">

                    
                                <div class="flex justify-between mb-3">
                                     <h2 className="text-lg font-semibold text-gray-700 capitalize dark:text-white">Product Details</h2>
                                    <button onClick={createProduct}  className="px-4 py-1 leading-5 text-white transition-colors duration-200 transform bg-themePrimaryLight rounded-sm hover:bg-themePrimaryDark focus:outline-none focus:bg-gray-600">Save</button>
                                </div>

                               {errors && errors.product.map( (error, index) => <Error key={index} message={error.error} />)} 
                               {errors && errors.variations.map( (error, index) => <Error key={index} message={error.error} />)} 

                            <div className="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">

                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="name">Name*</label>
                                    <input   id="name" onChange={bindInputToState} value={product.name} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
                                </div>

                                <div class="flex justify-between pr-10 gap-4">
                                    <div class="flex-1">
                                        <label className="text-gray-700 dark:text-gray-200" for="slug">Slug*</label>
                                        <input   id="slug" onChange={bindInputToState} value={product.slug} type="text" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                    </div>
                                    <button onClick={generateSlug} class="self-end text-white block py-2 px-4 bg-red-400 rounded-sm">Generate</button>
                                </div>

                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="unit_price">Unit Price*</label>
                                    <input   id="unit_price" onChange={bindInputToState} value={product.unit_price} type="number" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>

                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="purchase_price">Purchase Price</label>
                                    <input   id="purchase_price" onChange={bindInputToState} value={product.purchase_price} type="number" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>

                                
                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="discount">Discount (If has)</label>
                                    <input   id="discount" onChange={bindInputToState} value={product.discount} type="number" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>

                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="stock_quantity">Stock Quantity*</label>
                                    <input   id="stock_quantity" onChange={bindInputToState} value={product.stock_quantity} type="number" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>

                                <div class="border p-2">
                                    <span class="text-sm block text-center">Youtube Video</span>

                                    <div class="grid grid-cols-1 gap-2 mt-2">
                                        { product.video_url ? <div class="border py-2 px-4 rounded-md relative">{product.video_url} </div> : '' } 
                                    </div>

                                    <div>
                                        <div class="mt-3 flex justify-between pr-10 gap-4">
                                            <div class="flex-1">
                                                <label className="text-gray-700 text-sm dark:text-gray-200" for="video_url">Youtube Video Url</label>
                                                <input   id="video_url" onChange={onVideoUrlChange} value={videoUrl}  type="text" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                            </div>
                                            <button onClick={addVideoUrl} class="self-end text-white block py-2 px-4 bg-red-400 rounded-sm">Add Video</button>
                                        </div>
                                    </div>
                                </div>

                                                           
                                
                                <div class="border p-2">
                                    <span class="text-sm block text-center">Thumbnail</span>

                                    <div class="grid grid-cols-5 gap-2 mt-2">
                                        { product.thumbnail ? <Thumbnail thumbnail={product.thumbnail} handeler={removeThumbnail} /> : ''}
                                    </div>

                                    <div>
                                        <div class="mt-3 flex justify-between pr-10 gap-4">
                                            <div class="flex-1">
                                                <label className="text-gray-700 text-sm dark:text-gray-200" for="thumbnail">Thumbnail Url</label>
                                                <input   id="thumbnail" onChange={onThumbnailChange} value={thumbnail}  type="text" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                            </div>
                                            <button onClick={addProductThumbnail} class="self-end text-white block py-2 px-4 bg-red-400 rounded-sm">Add Thumbnail</button>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="border p-2">
                                    <span class="text-sm block text-center">Image Gallery</span>
                                    <div class="grid grid-cols-5 gap-2 mt-2">
                                        {product.gallery.map((item, index) => {

                                            return  ( <div key={index} class="p-3 border relative">
                                                        <img  class="aspect-square object-cover  block" src={item}  alt="galleryitem" />
                                                        <div onClick={() => removeItemToImageGallery(item, index)} class="absolute w-5 h-5 top-1 right-2 cursor-pointer text-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>)
                                            
                                        })}
                                        </div>
                                        <div>
                                        <div class="mt-3 flex justify-between pr-10 gap-4">
                                            <div class="flex-1">
                                                <label className="text-gray-700 text-sm dark:text-gray-200" for="add-image">Image Url</label>
                                                <input   id="add-image" onChange={onUrlChange} value={url} type="text" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                            </div>
                                            <button onClick={addImageToGallery} class="self-end text-white block py-2 px-4 bg-red-400 rounded-sm">Add Image</button>
                                        </div>
                                    </div>
                                </div>

                                <div className="w-full mt-4">
                                    <label className="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Product Short Description</label>
                                    <textarea ref={refShortDesc} id="short_description" onChange={bindInputToState}  className="block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">{product.short_description }</textarea>
                                </div>
                            
                                <div className="w-full mt-4">
                                    <label className="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Product Description</label>
                                    <textarea ref={refDesc} id="description" onChange={bindInputToState}  className="block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">{product.description }</textarea>
                                </div>

                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="brand_id">Brand*</label>
                                    <select id="brand_id" value={product.brand} onChange={bindInputToState} class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                        <option value="">Choosen brand...</option>
                                   
                                    <?php foreach($data['brands'] ?? [] as $brand )  { ?>
                                        <option value="<?php echo $brand['id'] ?? '' ?>" ><?php echo $brand['name'] ?? '' ?></option>
                                    <?php } ?>

                                    </select>
                                </div>

                                <div>
                                    <label   className="text-gray-700 dark:text-gray-200" for="category_id">Category*</label>
                                    <select id="category_id" value={product.brand} onChange={bindInputToState} class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                        <option value="">Choosen category...</option>

                                    <?php foreach($data['categories'] ?? [] as $category )  { ?>
                                        <option value="<?php echo $category['id'] ?? '' ?>"><?php echo $category['name'] ?? '' ?></option>
                                    <?php } ?>

                                    </select>
                                </div>

                            </div>

                            
                            {product.variations.map((variant,  index) => <Variant key={index} onPhotoChange={onPhotoChange} addPhotoToVarinat={addPhotoToVarinat} removeVariantPhoto={removeVariantPhoto} removePhotoHandeler={removeVariantPhoto} photoUrl={photoUrl} handeler={removeVariant} binding={bindVariantInputToState} variant={variant} />)}
                            

                            <div className="flex justify-end mt-6">
                                <button onClick={addVariant} className="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-themeSecondaryLight rounded-md hover:bg-themeSecondaryDark focus:outline-none focus:bg-gray-600 mr-3">Add Variant</button>
                            </div>

                    </section>);

                }



                


                const Variant = ({binding, handeler, variant, addPhotoToVarinat, removeVariantPhoto, removePhotoHandeler, onPhotoChange, photoUrl}) => {

                        return (<section className="max-w-full mt-6 p-6 mx-auto border rounded-md shadow-md dark:bg-gray-800">

                            <div class="flex justify-between">
                                <h2 className="text-lg font-semibold text-gray-700 capitalize dark:text-white">Product Variant {variant.id}</h2>
                                <button onClick={() => handeler(variant.id)} className="px-2 py-2 leading-5 text-white transition-colors duration-200 transform bg-themeSecondaryLight rounded-md hover:bg-themeSecondaryDark focus:outline-none focus:bg-gray-600 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                                    </svg>
                                </button>
                            </div>

                            <div className="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">

                               {/* <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="name">Variant Name</label>
                                    <input placeholder="Optional"  id="name" onChange={(event) => binding(event, variant.id)} type="text" value={variant.name} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
                                </div>
                               */}
                 

                                <div class="border p-2">
                                    <span class="text-sm block text-center">Photo *</span>

                                    <div class="grid grid-cols-5 gap-2 mt-2">
                                        { variant.photo ? <Photo thumbnail={variant.photo} variantId={variant.id} handeler={removeVariantPhoto} /> : ''}
                                    </div>

                                    <div>
                                        <div class="mt-3 flex justify-between pr-10 gap-4">
                                            <div class="flex-1">
                                                <label className="text-gray-700 text-sm dark:text-gray-200" for="photo">Varinat Photo Url</label>
                                                <input   id="photo" onChange={onPhotoChange} value={photoUrl}  type="text" className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                            </div>
                                            <button onClick={() => addPhotoToVarinat(variant.id)} class="self-end text-white block py-2 px-4 bg-red-400 rounded-sm">Add Photo</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <div class="flex-1">
                                        <label className="text-gray-700 dark:text-gray-200" for="color">Color</label>
                                        <input  id="color" onChange={(event) => binding(event, variant.id)} type="text" value={variant.color} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                    </div>
                                    <div class="flex-1">
                                        <label className="text-gray-700 dark:text-gray-200" for="color_code">Color Code (Optional)</label>
                                        <input  id="color_code" onChange={(event) => binding(event, variant.id)} type="text" value={variant.color_code} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                    </div>
                                </div>

                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="size">Size</label>
                                    <input  id="size" onChange={(event) => binding(event, variant.id)} type="text" value={variant.size} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>

                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="weight">Weight</label>
                                    <input  id="weight" onChange={(event) => binding(event, variant.id)} type="text" value={variant.weight} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>
                               {/*
                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="unit_price">Price</label>
                                    <input  id="unit_price" onChange={(event) => binding(event, variant.id)} type="number" value={variant.unit_price} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>
                               
                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="purchase_price">Purchase Price</label>
                                    <input  id="purchase_price" onChange={(event) => binding(event, variant.id)} type="number" value={variant.purchase_price} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>
                                */}
                                <div>
                                    <label className="text-gray-700 dark:text-gray-200" for="stock_quantity">Stock*</label>
                                    <input  id="stock_quantity" onChange={(event) => binding(event, variant.id)} type="number" value={variant.stock_quantity} className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"/>
                                </div>
                                {/* 
                                <div className="w-full mt-4">
                                    <label className="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Short Description</label>
                                    <textarea id="short_description" onChange={(event) => binding(event, variant.id)}  className="block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">{variant.short_description }</textarea>
                                </div>
                            
                                <div className="w-full mt-4">
                                    <label className="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">Description</label>
                                    <textarea id="description" onChange={(event) => binding(event, variant.id)}  className="block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">{variant.description }</textarea>
                                </div>
                                */}
                            </div>
                        </section>);

                }




                const Error = ({message}) => {
                    return (
                        <div class="bg-red-400 py-1 px-2 text-white text-xs mb-1">{message}</div>
                    )
                }

                const Thumbnail = ({thumbnail, handeler}) => {
                    return (
                        <div class="p-3 border relative">
                            <img  class="aspect-square object-cover  block" src={thumbnail}   alt="Thumbnail" />
                            <div onClick={handeler} class="absolute w-5 h-5 top-1 right-2 cursor-pointer text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    )
                }

                const Photo = ({thumbnail, handeler, variantId}) => {
                    return (
                        <div class="p-3 border relative">
                            <img  class="aspect-square object-cover  block" src={thumbnail}   alt="Thumbnail" />
                            <div onClick={() => handeler(variantId)} class="absolute w-5 h-5 top-1 right-2 cursor-pointer text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    )
                }




                // const YoutubeVideo = ({id = "bHQTio6zVtQ", handeler}) => {
                //     return (
                //         <div class="aspect-video">
                //         <iframe width="560" height="315" src={`https://www.youtube.com/embed/${id}`} title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                //         </div>
                //     )
                // }


















    
        // Render

        const rootDiv = document.getElementById('addProductPage');
        const root = ReactDOM.createRoot(rootDiv);
        root.render(<AddProductPage/>);
    
    }

</script>






<?php include_once VIEWS . 'store/partials/storeFooterSection.php'; ?>