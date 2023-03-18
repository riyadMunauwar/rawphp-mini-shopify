<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Shipper');


    $shipper_id = post('shipper_id');
 
    if(!$shipper_id) return redirect('store/setting?error=Invalid action');

    try
    {
        $shipperStmt = new Shipper(STORE_DATABASE);
        $foundShipper = $shipperStmt->findByStoreAndId(STORE['id'], $shipper_id );

        if($foundShipper){
            $delete = $shipperStmt->deleteByStoreAndId(STORE['id'], $shipper_id);

            if($delete) {
                return redirect('store/setting?success=Shipper deleted successfully');
            }
            else {
                return redirect('store/setting?error=Something went wrong try again');
            }
        }
        else {
            return redirect('store/setting?error=Invalid action');
        }

    }
    catch(\PDOException $e)
    {
        echo 'THis error is coming from post store setting delete shipper action' . $e->getMessage();
    }






?>