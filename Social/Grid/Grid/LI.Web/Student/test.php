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
	    //include("studentHeader.php");	
		include Entity_Path.'Job.php';
		include Entity_Path.'JobCard.php';
		include Business_Path.'JobManagement.php';
		
		$objjob= new Job();					        //Entity class instance
		$objjob->ID=$_GET["JobID"];	
		//echo $_GET["JobID"];
		$objcalljob= new JobManagement();	
		
		$jobData=$objcalljob->GetJobDetailsByJobId1($_GET["JobID"]);
		//print_r($jobData);
		//echo $jobData->Title;
		
		
		
?>					<form name="apply" action="Studentapply.php" method="post">
					<table align="center" border=! class="" style="padding-left:625px;"> 
	
					<?php 
					foreach($jobData as $value) 
					
					?>
					
					<tr>
						<td style="padding-left:450px;">&nbsp;<?php echo $value["Title"];?>
						<span style="padding-left:175px;"></span>
						
						&nbsp;
						</td>
						</td>
					</tr>
					<tr>
						<td style="padding-left:450px;">&nbsp;<?php echo $value["CompanyName"]; ?></td>
					</tr>
					
					<tr>
						<td style="padding-left:450px;">&nbsp;<?php echo $value["LocationString"];?></td>
					</tr>
					
					<tr>
						<td style="padding-left:450px;">&nbsp;
						<table align="center" border="0">
						
						<tr>
						<td><?php echo $value["StartDate"]."<br>".$value["EndDate"];?></td>
						<td style="padding-left:25px;">Description :<?php echo wordwrap($value["Description"],50,"\n<br>");?></td></td>
						</tr>
						<tr>
							<td>&nbsp;Amount : <?php echo $value["Amount"];?></td>
						</tr>
						<tr>
							<td>&nbsp;# of positions : <?php echo $value["NoOfPositions"];?></td>
						</tr>
						<tr>
							<td>&nbsp;# of applications received : <?php echo $value["NoOfApplications"];?></td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
						<td>&nbsp;<input type="hidden" name="JobId" id="JobId" value="<?php echo $_GET["JobID"];?>">
						
						</td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
						<td>
						Get ready for a <?php 
						$test_details=Utilities::CheckTestDetails($_GET["JobID"]);
						echo $test_details[0]; ?> ! &nbsp;&nbsp;<br>
						<?php 
						
						
						//echo $test_details[2];
						
						$test_questions=Utilities::TestQuestions($test_details[2]);
						//print_r($test_questions);
						if($test_questions=="1")
						{
							echo "<br>The test conists of audio questions.A Mic/headphone is recommended<br>";
						}
						?>
						
						<br><br><input class="btn btn-large btn-primary" type="submit" name="apply" id="apply" value="Apply">
						</td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
					    <tr>
						<td>
						&nbsp;&nbsp;<a>Practice Tests</a>					
						&nbsp;&nbsp;| &nbsp;&nbsp;Social&nbsp;&nbsp; <div class="fb-send" data-href="http://dev.letsintern.com/LI.Web/test.php?JobID='<?php echo $value["ID"];?>"></div></td>
						
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
						<td>
						</td>
						</tr>
						
						</table>
						</form>
					</tr>
					
					
					

				<script> 
				  FB.init({appId: "265042800264814", status: true, cookie: true});

				  function postToFeed() {

					
					var obj = {
					  method: 'feed',
					  link: 'http://dev.letsintern.com/LI.Web/test.php?JobID='+<?php echo $value["ID"];?>,
					  picture: 'http://fbrell.com/f8.jpg',
					  name: '<?php echo "<b>".$value["Title"]."</b>";?>',
					  caption: '<?php echo "<br>".$value["LocationString"];?>',
					  description: '<?php echo "<br>".$value["Description"];?>'
					};

					function callback(response) {
					  document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
					}

					FB.ui(obj, callback);
				  }
				
				</script>
				
					
					
</body>
</html>
