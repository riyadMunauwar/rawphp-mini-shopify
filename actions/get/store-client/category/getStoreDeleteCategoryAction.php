<?php 

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Category');
    load(MODELS, 'CategoryProduct');

    // Params 
    $categoryID = get('category_id');

    if( ! $categoryID ){
        return redirect('store/category?error=Invlaid');
    }

    try
    {
        $categoryStmt = new Category(STORE_DATABASE);
        $find = $categoryStmt->findByStoreAndId(STORE['id'], $categoryID);

        if( $find ){
            
            $children = $categoryStmt->findChildCategoryByCategoryId($find['id']);
            
            $catProductStmt = new CategoryProduct(STORE_DATABASE);
            $found  = $catProductStmt->findProductByCategoryId($categoryID);



            if($found){
                return redirect('store/category?error=Category has product. Delete those product first then try again');
            }
            elseif($children){
                $categoryName = '';

                foreach($children as $child){
                    $categoryName .=   $child['name'] . ', ' ;
                }

                return redirect("store/category?error=Category has < $categoryName >  children. Delete children category first");
            }
            else
            {
                $categoryStmt = new Category(STORE_DATABASE);
                $delete = $categoryStmt->deleteByStoreAndCategoryid(STORE['id'], $categoryID );

                if($delete) {
                    return redirect('store/category?success=Deleted');
                }
            }
        }
        else
        {
            return redirect('store/category?error=Invlaid');
        }
    }
    catch(\PDOExcetpion $e){
        echo 'this error is coming from get store delete category action ' . $e->getMessage();
    }
    
?>