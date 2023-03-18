<?php

   if ( ! array_key_exists('admin', $_SESSION) ) {
      $_SESSION['admin'] = [];
   }

   if ( $_SESSION['admin'] ) {
      return redirect('admin/dashboard');
   }

?>