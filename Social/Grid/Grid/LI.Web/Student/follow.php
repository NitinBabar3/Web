<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Lets Intern</title>
	<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ParentPath;?>css/EmployerPage.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo ParentPath;?>scripts/popup.js"></script>
	
</head>

<body>
<?php   include("bootstrap_lib.php");
	    include("studentHeader.php");
		include Entity_Path.'followers.php';
		include Business_Path.'StudentManagement.php';
		include Business_Path.'JobManagement.php';
		$objjob= new followers();					         				 //Entity class instance
		$objjob->student_id=$_SESSION["letsession"]["FacebookId"];      	 //userid	
		$objjob->employer_id="13";  //GET Employer ID  
		//echo $_GET["JobID"];
		$objcalljob= new NewStudent();	
		//$jobData=$objcalljob->StartFollowing($objjob);
		//print_r($jobData);
		//echo $jobData->Title;
		//find companies wom i follow
		$follower_companies=Utilities::GetFollowedCompanyInfo($objjob->student_id);
		//print_r($follower_companies);
	
	
?>
<table>

<?php 	$obj=new JobManagement();
        $query="SELECT employer.CompanyName,followers.employer_id,followers.StartDate from followers
				INNER JOIN employer ON
				employer.ID=followers.employer_id
				WHERE followers.student_id='".$objjob->student_id."' GROUP by employer_id";
		//echo  $query;
        $getlist= MySQLDataAdapter::Query($query);
	    while($row = mysql_fetch_array($getlist)) 
		{ 
		?>
			<tr>
			<td><h2><?php echo $row["CompanyName"]." being followed since ".$row["StartDate"]; ?></h2></td>
			</tr>
			<tr>
			<td>&nbsp;
			<?php 
			$query_jobs="SELECT Title,Description,Amount,NoOfPositions,CreatedOn,ID from job WHERE EmployerId='".$row["employer_id"]."'
			ORDER BY CreatedOn";
			// echo  $query_jobs;
			$getlistjobs= MySQLDataAdapter::Query($query_jobs);
			?></td>
			</tr>
			<?php 
			 
			 while($row_jobs = mysql_fetch_array($getlistjobs)) { 
			
			?>
			<tr>
			<td>&nbsp;Posted On : <?php echo $row_jobs[4];?></td>
			</tr>
			<tr>
			<td>&nbsp;Title : <?php echo $row_jobs[0];?></td>
			</tr>
			<tr>
			<td>&nbsp;Description : <?php echo $row_jobs[1];?></td>
			</tr>
			<tr>
			<td>&nbsp;Amount :<?php echo $row_jobs[2];?></td>
			</tr>
			<tr>
			<td>&nbsp;# of positions :<?php echo $row_jobs[3];?></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;<a href="test.php?JobID=<?php echo $row_jobs[5]; ?>"><input class="btn btn-large btn-primary" type="submit" name="apply" id="apply" value="Apply"></a></td>
			</tr>
			<tr>
			<td>&nbsp;<hr></td>
			</tr>
			<?php }  ?>
			<tr>
			<td>&nbsp;</td>
			</tr>
		<?php }?>
</table>
</body>
</html>
