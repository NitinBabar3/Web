<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include("studentHeader.php"); ?>
	<title>Lets Intern</title>
	<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/EmployerPage.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo ParentPath;?>scripts/popup.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>

</head>
<body>
<?php	  include("bootstrap_lib.php");
		  $StudentWorkExperience=Utilities::GetStudentWorkExperience($_SESSION["letssession"]["FacebookId"]);
		  //print_r($StudentWorkExperience);
	 
		$query="SELECT student_workex.CompanyName,Title from student_workex
				WHERE student_workex.StudentId='".$_SESSION["letssession"]["FacebookId"]."'";
		//echo $query;
		$result= mysql_query($query);
		
?>
		<table class="table">
		<tr>
			<td>Company </td>
			<td>Title </td>
			
		</tr>
		<?php while($row=mysql_fetch_array($result)) {	?>
		<tr>
			<td><?php echo $row["CompanyName"];?> </td>
			<td><?php echo $row["Title"];?> </td>
			<td><!--<a href="EditProfile.php?UserID=<?php //echo $_GET["UserID"]; ?>">Edit</a>
			<button class="btn2">Slide down</button>-->	
			</td>
		</tr>
		<?php } ?>
		</table>			
</body>
</html>
