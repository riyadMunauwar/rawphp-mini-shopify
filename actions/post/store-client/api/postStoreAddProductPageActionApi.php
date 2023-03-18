<?php 
                load(CORE, 'Connection');
                load(MODELS, 'Product');
                load(MODELS, 'Variation');
                load(MODELS, 'CategoryProduct');
                load(MODELS, 'ProductPhotoGallery');

                header("Access-Control-Allow-Origin: *");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
                header("Access-Control-Max-Age: 3600");
                header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


                $request = json_decode(file_get_contents('php://input'), true);

                
                
                // Product Data
                $product = [
                    'name' => $request['name'],
                    'slug' => $request['slug'],
                    'unit_price' =>(int) $request['unit_price'],
                    'purchase_price' =>(int) $request['purchase_price'],
                    'discount' =>(int) $request['discount'],
                    'thumbnail' => $request['thumbnail'],
                    'video_url' => $request['video_url'],
                    'stock_quantity' =>(int) $request['stock_quantity'],
                    'short_description' => $request['short_description'],
                    'description' => $request['description'],
                    'store_id' => STORE_ID,
                    'brand_id' =>(int) $request['brand_id'],
                    'category_id' =>(int) $request['category_id'],
                    'create_at' => bdTime()
                ];

                // Variations Data
                $variations = $request['variations'];

                // Product Photo Gallery Data
                $gallery =  $request['gallery'];


            


                $errors = [];

                if( ! $product['name'] ) $errors[] = ['property' => 'name', 'error' => 'Name must not be empty !' ];
                if( ! $product['slug'] ) $errors[] = ['property' => 'name', 'error' => 'Slug must not be empty !' ];
                if( ! $product['unit_price'] ) $errors[] = ['property' => 'unit_price', 'error' => 'Unit price must not be empty !' ];
                if( ! $product['stock_quantity'] ) $errors[] = ['property' => 'unit_price', 'error' => 'Stock quantity must not be empty !' ];
                if( ! $product['thumbnail'] ) $errors[] = ['property' => 'thumbnail', 'error' => 'Thumbnail must not be empty !' ];
                if( ! $product['brand_id'] ) $errors[] = ['property' => 'brand_id', 'error' => 'Brand must not be empty !' ];
                if( ! $product['category_id'] ) $errors[] = ['property' => 'category_id', 'error' => 'Category must not be empty !' ];



                
                
                $variant_errors = [];

                if(count($variations) >= 1)
                {
                    foreach($variations ?? [] as $variant){

                        $id = $variant['id'] ;

                        if( ! $variant['photo'] )   $variant_errors[] = ['id' => $variant['id'] , 'property' => 'photo', 'error' => "Variant $id photo feild is empty !" ]; 
                        if( ! $variant['stock_quantity'] )   $variant_errors[] = ['id' => $variant['id'] , 'property' => 'stock_quantity', 'error' => "Variant $id stock feild is empty !" ]; 
                    
                    }
                }

              
             


                $allError = [
                    'status' => 'error',
                    'product' => $errors,
                    'variations' => $variant_errors
                ];
                
                
                if( $errors || $variant_errors ) {
                    echo json_encode($allError, true);
                    return;
                }

                
                
                try
                {
                    $conn = new Connection(STORE_DATABASE);

                    $conn->connection->beginTransaction();

                    // Insert Product
                    $stmt = $conn->connection->prepare("INSERT INTO products (name, slug, unit_price, purchase_price, discount, stock_quantity, short_description, description, thumbnail, video_url, store_id, brand_id, create_at) VALUES(:name, :slug, :unit_price, :purchase_price, :discount, :stock_quantity, :short_description, :description, :thumbnail, :video_url, :store_id, :brand_id, :create_at )");

                    $stmt->bindParam(":name", $product['name']);
                    $stmt->bindParam(":slug", $product['slug']);
                    $stmt->bindParam(":unit_price", $product['unit_price']);
                    $stmt->bindParam(":purchase_price", $product['purchase_price']);
                    $stmt->bindParam(":discount", $product['discount']);
                    $stmt->bindParam(":stock_quantity", $product['stock_quantity']);
                    $stmt->bindParam(":short_description", $product['short_description']);
                    $stmt->bindParam(":description", $product['description']);
                    $stmt->bindParam(":thumbnail", $product['thumbnail']);
                    $stmt->bindParam(":video_url", $product['video_url']);
                    $stmt->bindParam(":store_id", $product['store_id']);
                    $stmt->bindParam(":brand_id", $product['brand_id']);
                    $stmt->bindParam(":create_at", $product['create_at']);

                    $stmt->execute();

                    $productId = (int) $conn->connection->lastInsertId();


                    // Insert CategoryProduct Pivot Table
                    $categoryProduct = new CategoryProduct(false, $conn->connection);
                    $categoryProduct->product_id = $productId;
                    $categoryProduct->category_id = $product['category_id'];
                    $categoryProduct->insert();


                    // Insert Product Gallery Photo
                    if(count($gallery) >= 1){
                        

                        foreach($gallery as $gallery_item){
                            $proPhoGallery = new ProductPhotoGallery(false, $conn->connection);
                            $proPhoGallery->product_id = $productId;
                            $proPhoGallery->photo_url = $gallery_item;
                            $proPhoGallery->create_at = bdTime();
                            $proPhoGallery->insert();
                        }


                    }

                    // Insert Variations if has
                    if(count($variations) >= 1) {
                        foreach($variations as $variant){

                            $v = new Variation(false, $conn->connection);
                            
                            $v->photo = $variant['photo'];
                            $v->size = $variant['size'];
                            $v->weight = $variant['weight'];
                            $v->color = $variant['color'];
                            $v->color_code = $variant['color_code'];
                            $v->stock_quantity = (int) $variant['stock_quantity']; 
                            $v->product_id = (int) $productId;
                            $v->create_at = bdTime();
    
                            $v->insert();                 
                    
    
                        }
                    }


                    echo json_encode(['status' => 'success']);

                    $conn->connection->commit();

                }
                catch(Exception $e)
                {
                    $conn->connection->rollback();
                    echo json_enncode(['error' => 'find']);

                    // echo json_encode(['error' => $e->getMessage()]);

                }
                


?>