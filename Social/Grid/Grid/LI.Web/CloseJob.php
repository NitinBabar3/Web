<?php
include '../LI.BusinessManagement/JobManagement.php';
include '../LI.DataAccessManagement/MySqlDataAdapter/MySQLDataAdapter.php';
try{
    
        for($i=1;$i<=$_POST["count"];$i++){
        
            if (isset($_POST["jobId".$i])){
                $jobId = $_POST["jobId".$i];
                $jobName = $_POST["jobName".$i];
            }
        }
        
        $objJobManagement = new JobManagement();
        $objJobManagement->CloseJobbyJobId($jobId);
        echo "$jobName is now closed!";
    
}

catch(Exception $ex){
    echo $ex->getMessage();
}
?>
