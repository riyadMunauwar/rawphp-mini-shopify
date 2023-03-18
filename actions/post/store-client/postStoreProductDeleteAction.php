<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(CORE, 'Connection');
    load(MODELS, 'Product');
    load(MODELS, 'OrderItem');


    $product_id = post('product_id');


    if(!$product_id) {
        return redirect('store/product?error=Somethin went wrong try again !');
    }


    try
    {
        $productStmt = new Product(STORE_DATABASE);
        $IsHaveProduct = $productStmt->findByStoreAndId(STORE['id'], $product_id);

        if(!$IsHaveProduct) return redirect('store/product?error=Somethin went wrong try again !');

        $orderItemStmt = new OrderItem(STORE_DATABASE);
        $isHaveOrderOfThisProduct = $orderItemStmt->findOrderByStoreAndProductId(STORE['id'], $product_id);

        if($isHaveOrderOfThisProduct) return redirect('store/product?error=Can not delete this product. This product has order !');
       

        $conn = new Connection(STORE_DATABASE);

        $conn->connection->beginTransaction();
        
        $delteCategoryProductStmt = $conn->connection->prepare("DELETE FROM category_product WHERE product_id = :product_id");
        $delteCategoryProductStmt->bindParam('product_id', $product_id);
        $delteCategoryProductStmt->execute();

        $deleteVariationStmt = $conn->connection->prepare("DELETE FROM variations WHERE product_id = :product_id");
        $deleteVariationStmt->bindParam(':product_id', $product_id);
        $deleteVariationStmt->execute();
        
        $deleteProductGalleryStmt = $conn->connection->prepare("DELETE FROM product_photo_galleries where product_id = :product_id");
        $deleteProductGalleryStmt->bindParam(':product_id', $product_id);
        $deleteProductGalleryStmt->execute();

        $deleteProductStmt = $conn->connection->prepare("DELETE FROM products WHERE id = :product_id");
        $deleteProductStmt->bindParam(':product_id', $product_id);
        $deleteProductStmt->execute();

        $conn->connection->commit();

        return redirect('store/product?success=Deleted');
    }
    catch(\PDOException $e)
    {
        $conn->connection->rollback();
        echo 'This error is coming from post store product delete action' . $e->getMessage();
    }

    






?>