<?php

    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Image');

    // FILE_UPLOAD CONFIG ARRAY COMING FROM CONFIG APP FOLDER
    $accept = FILE_UPLOAD['ACCEPT_IMAGE_TYPE'];
    $maxImageSize = FILE_UPLOAD['MAX_IMAGE_SIZE'];
    $uploadPath = FILE_UPLOAD['IMAGE_UPLOAD_PATH'];

    // accept image type in string
    $acceptImagType = implode(', ', $accept);
    

    $sizeInKb = $maxImageSize / 1024;
    

    // All Images coming from user
    $files = $_FILES['files'];

    $imageTypes = $files['type'];
    $imageSizes = $files['size'];
    $imageTmpNames = $files['tmp_name'];
    $imageNames = $files['name'];

    // Helper function get Extention
    function extention($str)
    {
        return explode('/', $str)[1];
    }

    // This function will return a random
    // string of specified length
    function random_string($length_of_string)
    {
    
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),0, $length_of_string);
    }


    // Validate Image Types
    foreach($imageTypes as $imageType){
        if(!in_array($imageType, $accept)){
            return redirect("store/media?error=Invalid Image Type. Only allow {$acceptImagType} .");
        }
    }

    // Validate Image Size
    foreach($imageSizes as $imageSize){
        if($imageSize > $maxImageSize){
            return redirect("store/media?error=Max file size allowed {$sizeInKb} KB. Please Compress your image then try again.");
        }
    }





    // New name list
    $newNameOfImages = [];
    

    for($index = 0; $index < count($imageTmpNames); $index++){
        $name = 'img' . random_string(15) . (string) time() . random_string(10) . '.' . extention($imageTypes[$index]);
        array_push($newNameOfImages, $name);
    }
    
    try
    {



        if( count($newNameOfImages) !== 0){

            for($index = 0; $index < count($imageTmpNames); $index++){
               move_uploaded_file($imageTmpNames[$index], $uploadPath . '/' . $newNameOfImages[$index]);
            }

    
            for($index = 0; $index < count($newNameOfImages); $index++){
                $imageStmt = new Image(STORE_DATABASE);
                // Insert method param store_id, name, src, create_at
                $imageStmt->insert(STORE['id'], $newNameOfImages[$index], $uploadPath . '/' . $newNameOfImages[$index], bdTime() );
            }

            redirect("store/media?success=Image Upload Successfully");

            
        }


   

    }
    catch(\PDOException $e){
        echo 's' . $e->getMessage();
        redirect("store/media?error=Something went wrong");
    }

?>