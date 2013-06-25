<html>
    <head>
        <link href="css/EmployerPage.css" rel="stylesheet" type="text/css"/>
    </head>    
</html>

<?php

include '../LI.BusinessManagement/EmployerManagement.php';
include '../LI.BusinessManagement/JobManagement.php';
include '../LI.Entities/Employer.php';
include '../LI.Entities/JobCard.php';
include '../LI.Entities/Job.php';
include '../Utilities/Utilities.php';

    try{
        $userId = 62; //Put it in $_GET[]
        $objEmployerManagement = new EmployerManagement();
        $objJobManagement = new JobManagement();
    /* @var $objEmployer Employer */
        $objEmployer = $objEmployerManagement->GetCompleteEmployerDetails($userId);
        // $objEmployer WILL COME FROM THE EMPLOYER LISTING PAGE?!

        echo Utilities::GetEmployerBusinessCard($objEmployer);

        $objJobCardArray = $objJobManagement->GetAllJobsPostedByEmployerByEmployerId($objEmployer->ID);

        foreach($objJobCardArray as $tempJobCard){
            echo Utilities::GetJobCard($tempJobCard);        
        }
    }
    catch(Exception $ex){
        echo $ex->getMessage();
    }
?>
