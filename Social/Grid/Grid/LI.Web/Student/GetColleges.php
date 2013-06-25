<html>
<head>
	
</head>

<?php
include("../../Utilities/Utilities.php");
$applications_query="SELECT * from college WHERE CollegeName LIKE '".$_GET["q"]."%'";
//echo "--".$applications_query;
$result=mysql_query($applications_query);
?>
<table border="0" width="50px;" class="table table-striped">
<?php
while($row_applications=mysql_fetch_array($result))
{
?>
	<tr>
	<td><a onclick="SetCollege('<?php echo $row_applications["ID"];?>');"><?php echo $row_applications["CollegeName"]; ?></a></td>
	</tr>
<?php
}
?>
<table>