<?php
    load(MIDDLEWARE, 'authenticateStore');
    load(MODELS, 'Footer');

  
    $title_a = post('title_a');
    $content_a = post('content_a');

    $title_b = post('title_b');
    $content_b = post('content_b');

    $title_c = post('title_c');
    $content_c = post('content_c');

    $title_d = post('title_d');
    $content_d = post('content_d');

    $bottom_text = post('bottom_text');
    $facebook_link = post('facebook_link');
    $youtube_link = post('youtube_link');
    $instragram_link = post('instragram_link');


    $data = [
        't_a' => $title_a,
        'c_a' => $content_a,
        't_b' => $title_b,
        'c_b' => $content_b,
        't_c' => $title_c,
        'c_c' => $content_c,
        't_d' => $title_d,
        'c_d' => $content_d,
        'b' => $bottom_text,
        'f' => $facebook_link,
        'y' => $youtube_link,
        'i' => $instragram_link,
    ];

    try
    {
        $footerStmt = new Footer(STORE_DATABASE);
        $footer = $footerStmt->findByStoreId(STORE['id']);
      
        if($footer){
            $footerStmt = new Footer(STORE_DATABASE);
            $footerStmt->title_a = $title_a;
            $footerStmt->content_a = $content_a;

            $footerStmt->title_b = $title_b;
            $footerStmt->content_b = $content_b;

            $footerStmt->title_c = $title_c;
            $footerStmt->content_c = $content_c;

            $footerStmt->title_d = $title_d;
            $footerStmt->content_d = $content_d;

            $footerStmt->bottom_text = $bottom_text;
            $footerStmt->facebook_link = $facebook_link;
            $footerStmt->youtube_link = $youtube_link;
            $footerStmt->instragram_link = $instragram_link;
            $footerStmt->update_at = bdTime();
        
            $isUpdate = $footerStmt->updateByStoreIdAndId(STORE['id'], $footer['id']);
            
            if($isUpdate){
                return redirect('store/footer?success=Update successfully');
            }
            else
            {
                return redirect('store/footer?error=Something went wrong. Please try again');
            }

        }
        else
        {
            return redirect('store/footer?error=Something went wrong. Please try again');
        }
    }
    catch(\PDOException $e)
    {
        echo 'this error is coming from post store footer update action ' . $e->getMessage();
    }



?>