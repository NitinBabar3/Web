<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    try{
        $con = mysql_connect("localhost","root","");
        $db = mysql_select_db("lidev",$con);
    }
    catch(Exception $ex){
        $ex->getMessage();
    }

?>
