<?php

   if(!isset($_REQUEST['filename']))
   {
     exit('No file');
   }

//   $upload_path = dirname(__FILE__). '/';
   
   $filename = $_REQUEST['filename'];
   
   $fp = fopen('../audio/'.$filename.".wav", "wb");
   
   fwrite($fp, file_get_contents('php://input'));
   
   fclose($fp);
   
   exit('done');
   


?>
