<?php 
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Shipper');

    $name = post('name');
    $logo = post('logo');

    
    if(!$name) return redirect('store/setting?error=Shipper name must not be empty !');

 


    try
    {
        $shipperStmt = new Shipper(STORE_DATABASE);

        $isAlreadyHave = $shipperStmt->findByShipperByNameAndStoreId($name, STORE['id']);

        if($isAlreadyHave) {
            return redirect('store/setting?error=Shipper already exist');
        }

        $shipperStmt->name = $name;
        $shipperStmt->logo = $logo;
        $shipperStmt->store_id = STORE['id'];
        $shipperStmt->create_at = bdTime();
        $save = $shipperStmt->insertByStoreId();

        if($save){
            return redirect('store/setting?success=Shipper added successfully');
        }
        else
        {
            return redirect('store/setting?error=Something went wrong try again');
        }

    }
    catch(\PDOException $e)
    {
        echo 'THis error is coming from post store setting add shipper action' . $e->getMessage();
    }






?>