<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    try{
        $con = mysql_connect("localhost","root","root");
        $db = mysql_select_db("lidev",$con);
        //echo "DB connected";
    }
    catch(Exception $ex){
        $ex->getMessage();
    }

?>
