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
$Title = $_REQUEST['Title'];
$Description = $_REQUEST['Description'];
$JobTypeId = $_REQUEST['JobTypeId'];
$Status = $_REQUEST['Status'];
$LocationIdString = $_REQUEST['LocationIdString'];
$JobProspect = $_REQUEST['JobProspect'];
$FunctionIdString = $_REQUEST['FunctionIdString'];
$StartDate = $_REQUEST['StartDate'];
$EndDate = $_REQUEST['EndDate'];
$isPeriodFlexible = $_REQUEST['isPeriodFlexible'];
$CompensationTypeId = $_REQUEST['CompensationTypeId'];
$Amount = $_REQUEST['Amount'];
$ApplicationDeadline = $_REQUEST['ApplicationDeadline'];
$NoOfPositions = $_REQUEST['NoOfPositions'];
$RequiredSkillIdString = $_REQUEST['RequiredSkillIdString'];
$AcademicRequirement = $_REQUEST['AcademicRequirement'];
$isFeatured = $_REQUEST['isFeatured'];
$isLIRecommended = $_REQUEST['isLIRecommended'];
$TestId = $_REQUEST['TestId'];
$CreatedBy = $_REQUEST['CreatedBy'];
$CreatedOn = $_REQUEST['CreatedOn'];
//echo $id;

//SQL 
$db = mysql_connect('lidev.db.8927940.hostedresource.com', 'lidev', 'Letsintern12') or
        die("Connection Error: " . mysql_error());
mysql_select_db('lidev');
//UPDATE
$query = "UPDATE ";
$query = $query . " job " . " SET ";
$query = $query . " Title= '" . $Title ."',";
$query = $query . " Description= '" . $Description ."',";
$query = $query . " JobTypeId= " . $JobTypeId .",";
$query = $query . " Status= '" . $Status ."',";
$query = $query . " LocationIdString= '" . $LocationIdString ."',";

$query = $query . " JobProspect= " . $JobProspect .",";
$query = $query . " FunctionIdString= '" . $FunctionIdString ."',";
$query = $query . " StartDate= '" . $StartDate ."',";
$query = $query . " EndDate= '" . $EndDate ."',";
$query = $query . " isPeriodFlexible= " . $isPeriodFlexible .",";
$query = $query . " CompensationTypeId= " . $CompensationTypeId .",";
$query = $query . " Amount= " . $Amount .",";

$query = $query . " ApplicationDeadline= '" . $ApplicationDeadline ."',";
$query = $query . " NoOfPositions= " . $NoOfPositions .",";
$query = $query . " RequiredSkillIdString= '" . $RequiredSkillIdString ."',";
$query = $query . " AcademicRequirement= '" . $AcademicRequirement ."',";
$query = $query . " isFeatured= " . $isFeatured .",";
$query = $query . " isLIRecommended= " . $isLIRecommended .",";
$query = $query . " ScreeningTestId= " . $TestId .",";
$query = $query . " CreatedBy= '" . $CreatedBy ."',";
$query = $query . " CreatedOn= '" . $CreatedOn ."'";

$query = $query . " WHERE ID=" . $id;

//echo $query;

$result = mysql_query($query);

if (!$result) {
    die('MySQL failed: ' . mysql_error());
} else {
    echo $result;
}
mysql_close($db);
?>
