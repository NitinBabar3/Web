<html>
    <head>
        <link href="css/ManageJobs.css" rel="stylesheet" type="text/css"/>
    </head>    
</html>


<?php

include '../LI.Entities/JobCard.php';
include '../LI.Entities/Job.php';
include '../Utilities/Utilities.php';
include '../LI.BusinessManagement/JobManagement.php';

    try{
        $employerId = 11; //To be passed using $_GET!
        $objJobManagement = new JobManagement();
        $objJobCardArray = $objJobManagement->GetAllJobsPostedByEmployerWithStudentApplication($employerId);
        echo "<br/>Open Jobs<br/>";
        $tempJobCard = new JobCard();
        $i=1;
        foreach($objJobCardArray as $tempJobCard){
            if($tempJobCard->Status == "open"){
                echo "<div class = JobInformation>";
                echo "<strong>".$tempJobCard->Title."</strong><br/>".$tempJobCard->Description;               
                echo "<br/>For Students Pusuing <strong>".$tempJobCard->AcademicRequirementString."</strong>";
                echo " and skilled in <strong>".$tempJobCard->SkillString."</strong>";
                echo "<br/>Internship in <strong>".$tempJobCard->FunctionString."</strong>";                
                echo "<br/>".$tempJobCard->LocationString;
                echo "<br/>Starts <strong>".$tempJobCard->StartDate."</strong> Ends <strong>".$tempJobCard->EndDate."</strong>";
                if ($tempJobCard->IsPeriodFlexible == 1) echo " <strong>Flexible</strong>";
                echo "<br/> Application Deadline <stong>".$tempJobCard->ApplicationDeadline."</strong>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creeated on ".$tempJobCard->CreatedOn;
                echo "<br/><strong>".$tempJobCard->CompensationType."</strong> INR ".$tempJobCard->Amount;
                echo " | Job Prospect ";
                if ($tempJobCard->JobProspect == 1){
                    echo "<strong>yes</strong>";
                }
                else{
                    echo "<strong>no</strong>";
                }
                echo "<br/>Total Positions : ".$tempJobCard->NoOfPositions;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Applications : ".$tempJobCard->NoOfApplications;
                echo "<br/>Applied : ".$tempJobCard->Applied." Selected : ".$tempJobCard->Selected;
                echo " Rejected : ".$tempJobCard->OnHold." Pending Screeing Test : ".$tempJobCard->Rejected." Shortlisted : ".$tempJobCard->Shortlisted;
                echo "</div><div class = Actions>";
                /*if ($tempJobCard->IsFeatured != 1)
                {
                    echo "<form name = MakeJobFeaturedForm action = 'MakeJobFeatured.php' method = 'post' <input type = 'hidden' name = 'jobId$i' value = $tempJobCard->ID/><input type = 'hidden' name = 'count' value = $i/>";
                    echo "<input type = submit value = 'Make Job Featured'/></form>";
                }
                if ($tempJobCard->IsLiRecommended != 1)
                {
                    echo "<form name = LIRecommendationForm action = 'GetLIRecommendation.php' method = 'post' <input type = 'hidden' name = 'jobId$i' value = $tempJobCard->ID/><input type = 'hidden' name = 'count' value = $i/>";
                    echo "<input type = submit value = 'Get LI Recommendation'/></form>";
                }*/
                
                                
                echo "<form name = jobCloseForm action = 'CloseJob.php' method = 'post'> <input type = 'hidden' name = 'jobId$i' value = $tempJobCard->ID /><input type = 'hidden' name = 'jobName$i' value = $tempJobCard->Title /><input type = 'hidden' name = 'count' value = $i />";
                echo "<input type = submit value = 'Close Job'/></form>";
                echo "<form name = jobEditForm action = 'EditJob.php' method = 'post'> <input type = 'hidden' name = 'jobId$i' value = $tempJobCard->ID/><input type = 'hidden' name = 'jobName$i' value = $tempJobCard->Title/><input type = 'hidden' name = 'count' value = $i />";
                echo "<input type = submit value = 'Edit Job'/></form>"; 
                echo "<form name = StartScreeningForm action = 'ScreeningTool.php' method = 'post'> <input type = 'hidden' name = jobId$i' value = $tempJobCard->ID/><input type = 'hidden' name = 'jobName$i' value = $tempJobCard->Title/><input type = 'hidden' name = 'count' value = $i />";
                echo "<input type = submit value = 'Start Screening'/></form>";
                echo "<form name = GoToManageMyIntern action = 'ManageMyIntern.php' method = 'post'> <input type = 'hidden' name = 'jobId$i' value = $tempJobCard->ID/><input type = 'hidden' name = 'jobName$i' value = $tempJobCard->Title/><input type = 'hidden' name = 'count' value = $i />";
                echo "<input type = submit value = 'Manage My Interns'/></form></div>";    
                $i++;
                
            }
        }
        echo "Closed Jobs";
        $j=1;
        foreach($objJobCardArray as $tempJobCard){    
            
            if($tempJobCard->Status == "closed"){
                echo "<div class = JobInformation>";
                echo "<strong>".$tempJobCard->Title."</strong><br/>".$tempJobCard->Description;               
                echo "<br/>For Students Pusuing <strong>".$tempJobCard->AcademicRequirementString."</strong>";
                echo " and skilled in <strong>".$tempJobCard->SkillString."</strong>";
                echo "<br/>Internship in <strong>".$tempJobCard->FunctionString."</strong>";                
                echo "<br/>".$tempJobCard->LocationString;
                echo "<br/>Starts <strong>".$tempJobCard->StartDate."</strong> Ends <strong>".$tempJobCard->EndDate."</strong>";
                if ($tempJobCard->IsPeriodFlexible == 1) echo " <strong>Flexible</strong>";
                echo "<br/> Application Deadline <stong>".$tempJobCard->ApplicationDeadline."</strong>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creeated on ".$tempJobCard->CreatedOn;
                echo "<br/><strong>".$tempJobCard->CompensationType."</strong> INR ".$tempJobCard->Amount;
                echo " | Job Prospect ";
                if ($tempJobCard->JobProspect == 1){
                    echo "<strong>yes</strong>";
                }
                else{
                    echo "<strong>no</strong>";
                }
                echo "<br/>Total Positions : ".$tempJobCard->NoOfPositions;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Applications : ".$tempJobCard->NoOfApplications;
                echo "<br/>Applied : ".$tempJobCard->Applied." Selected : ".$tempJobCard->Selected;
                echo " Rejected : ".$tempJobCard->OnHold." Pending Screeing Test : ".$tempJobCard->Rejected." Shortlisted : ".$tempJobCard->Shortlisted;
                echo "</div><div class = Actions>";
                echo "<form name = GoToManageMyIntern action = 'ManageMyIntern.php' method = 'post'> <input type = 'hidden' name = 'jobId$j' value = $tempJobCard->ID /><input type = 'hidden' name = 'jobName$i' value = $tempJobCard->Title /><input type = 'hidden' name = 'count' value = $j />";
                echo "<input type = submit value = 'Manage My Interns'/></form></div>";    
            }
        }
    }
    catch(Exception $ex){
        echo $ex->getMessage();
    }
?>
