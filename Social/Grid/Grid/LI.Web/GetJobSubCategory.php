<?
include '../Utilities/Utilities.php';
	if(isset($_GET['jobCategoryId'])){
		$query = "SELECT ID,SubCategoryName FROM `jobsubcategory` WHERE CategoryID =".$_GET['jobCategoryId']; 
		$hashTableJobSubCategory = MySQLDataAdapter::Query($query);
		
		$temp = array("ID","SubCategoryName");
		while($row=mysql_fetch_array($hashTableJobSubCategory)){
			$temp[]["ID"]=$row['ID'];
			$temp[]['SubCategoryName'] = $row['SubCategoryName'];
		}
		echo (json_encode($temp));
	}
?>