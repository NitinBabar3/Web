<?php 

include '../../LI.Entities/activity_log.php';
include '../../Utilities/Utilities.php';
include '../../Utilities/Timing.php';
$obj=new activity_log();
$obj->CodeID="300";
$obj->UserId="12";
$obj->Feature="Search Record";
$obj->CreatedOn=date("Y-m-d h:i:s");
// Create new Timing class with \n break
$timing = new Timing("\n");
$timing->start();
$data=Utilities::LogActivity($obj,"1");
// Loop ten rounds and sleep one second per round
for ($i=1;$i<=count($data);$i++) 
{ 
		//echo $i . "\t<br>"; 
	//sleep(1);
	// Print elapsed time every 2 rounds
	if ($i%2==0) 
	{
		//$timing->printElapsedTime();
	}
}
$timing->stop();
// Print only total execution time
$timing->printTotalExecutionTime();
// Print full stats
//$timing->printFullStats();
 //print_r($data);

?>
