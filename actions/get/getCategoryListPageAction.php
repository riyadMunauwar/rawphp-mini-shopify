<?php 
    load('MODELS', 'Category');
    
    $categoryID = get('cid');


    if($categoryID){
        return redirect(' ');
    }



    try
    {
        
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from' . $e->getMessage();
    }

?>