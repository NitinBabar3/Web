<?php
/*
 * ----------------------------------------------------------
 * Filename: PartnersUpdate.php
 * Created by: CreativePath
 * Creation date: May 26, 2012
 * Copyright(c) 2012 Creative Path Group Pty Ltd (Australia)
 * silva.gerry@creativepath.com.au
 * ----------------------------------------------------------
*/
$id = $_REQUEST['ID'];
$CourseName = $_REQUEST['CourseName'];
$Description=$_REQUEST['Description'];

//SQL 
/*$db = mysql_connect('lidev.db.8927940.hostedresource.com', 'lidev', 'Letsintern12') or
        die("Connection Error: " . mysql_error());
mysql_select_db('lidev');*/
include("../MySQLConnection.php");
//UPDATE
$query = "UPDATE ";
$query = $query . " course " . " SET ";
$query = $query . " CourseName= '" . $CourseName ."',";
$query = $query . " Description= '" . $Description ."'";

$query = $query . " WHERE ID=" . $id;

//echo $query;

$result = mysql_query($query);

if (!$result) {
    die('MySQL failed: ' . mysql_error());
} else {
    echo $result;
}
//mysql_close($db);
?>
