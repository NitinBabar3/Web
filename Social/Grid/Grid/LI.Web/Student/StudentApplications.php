<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php 
	    include("bootstrap_lib.php");
		include('studentHeader.php');
?>
	<title>Lets Intern</title>
	<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/EmployerPage.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo ParentPath;?>scripts/popup.js"></script>
	<Script>
	function confirmation(JobId,StudentId) 
	{	
		
			var answer = confirm("Are you sure to withdraw your application?")
			if (answer)
			{
				if (window.XMLHttpRequest)
			{
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					location.reload()
			    
				}
			}
			//alert("withdraw_application.php?JobId="+JobId+"&StudentId="+StudentId);
			xmlhttp.open("GET","withdraw_application.php?JobId="+JobId+"&StudentId="+StudentId,true);
			xmlhttp.send();			
			}
			else
			{
				
			}
		
	}
	</script>
</head>
<body>
<?php   
        
		//echo $_SESSION["letssession"]["FacebookId"];
		$get_applied_jobs=Utilities::GetStudentAppliedJobs($_SESSION["letssession"]["FacebookId"]);
		
		
?>
		<table class="table">
		<tr>
			<td>Company </td>
			<td>Title </td>
			<td>Status </td>
			<td>Applied On</td>
			<td>Action</td>
		</tr>
		<?php 
		$applications_query="SELECT employer.CompanyName,job.Title,application.ApplicationStatus,application.AppliedOn,job.ID from application
					INNER JOIN job
					ON job.ID=application.JobId
					INNER JOIN employer
					On employer.ID=job.EmployerId
					WHERE job.Deleted='0' AND application.Deleted='0' AND application.StudentID='".$_SESSION["letssession"]["FacebookId"]."'";
		//echo $applications_query;	
		$result_application_count= mysql_query($applications_query);
		//$row_applications=mysql_fetch_array($result_application_count);
		
		while($row=mysql_fetch_array($result_application_count)) { 
		
		?>
		<tr>
			<td><?php echo $row["CompanyName"];?> </td>
			<td><?php echo $row["Title"];?> </td>
			<td><?php echo $row["ApplicationStatus"];?> </td>
			<td><?php echo $row["AppliedOn"];?></td>
			<td><a href="#" onClick="confirmation(<?php echo $row["ID"] ?>,<?php echo $_SESSION["letssession"]["FacebookId"]; ?>);">Withdraw</a> </td>
		</tr>
		<?php } ?>
		</table>			
</body>
</html>
