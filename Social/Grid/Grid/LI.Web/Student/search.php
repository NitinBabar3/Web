<?php 
	include('studentHeader.php');
	include Entity_Path.'Job.php';
	include Entity_Path.'Application.php';
	include Business_Path.'JobManagement.php';
	include("bootstrap_lib.php");
	$obj=new Job();
	//echo $_POST["location"];
	//$job_type_id=implode(",",$_POST["Type"]);
	$job_type=(array)$_POST["Type"];
	//print_r($job_type);die;
	$obj->JobTypeId="marketing,Finance,Writing";
	$obj->LocationId=$_POST["location"];
	
	
	$objjob= new Job();					        //Entity class instance
	$objjob->JobTypeId=$job_type;	
	$objjob->LocationIdString=$_POST["location"];	
	
	
	//print_r($objStudent);die;
	$objjobcall= new JobManagement();				  //Object of business layer
	$test=$objjobcall->GetJobBySearch($objjob);  //method of business layer with object data passed
	//print_r($test);
	//echo sizeof($test);die;
	//echo json_encode($test);
	
	
	
    ?>
				
                    <table align="center" class="table table-striped" style="padding-left:125px;"> 
					
					<tr>
						<td style="padding-left:35px;">
						<blockquote>
						  <p>Make your fortune!! You have search results of the top jobs..</p>
						  <small>Letsintern</small>
						</blockquote>
						 </td>
						<td>&nbsp;</td>
							<td>&nbsp;</td>	
							<td>&nbsp;</td>	
							<td>&nbsp;</td>
							<td>&nbsp;</td>	
							<td>&nbsp;</td>	
							<td>&nbsp;</td>
							<td>&nbsp;</td>	
							<td>&nbsp;</td>	
							<td>&nbsp;</td>	
							<td>&nbsp;</td>
							<td>&nbsp;</td>	
							
					</tr>
					
					<tr>
							<td align="left" style="padding-left:25px;"><h3>Title</h3></td>
							
							<td align="left" style="padding-left:5px;"><h3>Description</h3></td>
							<td>&nbsp;</td>
							<td align="center" style="padding-left:1px;"><h3>Start Date</h3></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>	
							<td>&nbsp;</td>	
							<td align="center" style="padding-left:1px;"><h3>End Date</h3></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td align="center" style="padding-left:1px;"><h3># of positions</h3></td>
							<td align="center" style="padding-left:100px;"><h3>Action</h3></td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>	
						<td>&nbsp;</td>	
						<td>&nbsp;</td>
						<td>&nbsp;</td>	
						<td>&nbsp;</td>	
						<td>&nbsp;</td>	
						<td>&nbsp;</td>
						<td>&nbsp;</td>	
						<td>&nbsp;</td>	
						<td>&nbsp;</td>	
						<td>&nbsp;</td>
							
						</tr>
					<?php 
					for($i=0;$i<sizeof($test);$i++)
					{
						
					?>
						
						<tr>
							<td align="left" style="padding-left:25px;"><?php echo $test[$i]["Title"];?></td>
							
							<td align="left" style="padding-left:5px;"><?php echo wordwrap($test[$i]["Description"],45,"\n<br>");?></td>
							<td>&nbsp;</td>
							<td align="center" style="padding-left:1px;"><?php echo $test[$i]["StartDate"];?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>	
							<td align="center" style="padding-left:1px;"><?php echo $test[$i]["EndDate"];?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td align="center" style="padding-left:35px;"><?php echo $test[$i]["NoOfPositions"];?></td>
							<td align="center" style="padding-left:100px;">
							
							<?php 
							$objapplication=new Application();
							$objapplication->JobId=$test[$i]["ID"];
							$objapplication->StudentId='12';
							$count=Utilities::GetStudentJobStatus($objapplication);
							//echo $count;
							$status=explode(":",$count);
							
							if($status[0]=="1")
							{
							?>
							<button type="button" class="btn btn-info" disabled>Already applied on <?php echo $status[1]; ?></button>
							<?php 
							} 
								else
								{
								?>
									<a href="test.php?JobID=<?php echo $test[$i]["ID"];?>">View job</a>
									
								<?php
								} 
								?>
							</td>
						</tr>
						<tr>
							
						</tr>
				
						
					<?php 
					
					}
					?>
                    </table>
	
		