<?php
/*
 * ----------------------------------------------------------
 * Filename: PartnersDelete.php
 * Created by: CreativePath
 * Creation date: May 26, 2012
 * Copyright(c) 2012 Creative Path Group Pty Ltd (Australia)
 * silva.gerry@creativepath.com.au
 * ----------------------------------------------------------
 */
$id = $_REQUEST['id'];

//SQL 
/*$db = mysql_connect('lidev.db.8927940.hostedresource.com', 'lidev', 'Letsintern12') or
        die("Connection Error: " . mysql_error());
mysql_select_db('lidev');
*/
include("../MySQLConnection.php");
//DELETE
$query = "UPDATE";
$query = $query . " course "."SET";
$query = $query. "Deleted=1";
$query = $query . " WHERE ID=" . $id;

$result = mysql_query($query);
if (!$result) {
    die('MySQL failed: ' . mysql_error());
} else {
    echo $result;
}
//mysql_close($db);
?>