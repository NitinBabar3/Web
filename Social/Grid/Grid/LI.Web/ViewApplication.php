<?php

include '../LI.Entities/Application.php';
include '../LI.Entities/Student.php';
include '../LI.BusinessManagement/JobManagement.php';
include '../LI.BusinessManagement/StudentManagement.php';
include '../Utilities/Utilities.php';

        for($i=0;$i<$_POST["count"];$i++){
            if(isset($_POST["jobId".$i])){
                $jobId = $_POST["jobId".$i];
                $jobTitle = $_POST["jobTitle".$i];
                break;
            }    
        }
        echo $jobId;
        echo $jobTitle."<br/>";
        /*$objJobManagement = new JobManagement();
        
        $applicationInArray = $objJobManagement->GetStudentApplicationByJobId($jobId);
        if($applicationInArray){
            $appliedStudentIdString = $applicationInArray[0]["StudentId"];
            for($i=1;$i<sizeof($applicationInArray);$i++)
                $appliedStudentIdString = $appliedStudentIdString.",".$applicationInArray[$i]["StudentId"];
            $objAppliedStudentArray = $objStudentManagement->GetStudentDetailsByIdString($appliedStudentIdString);
            var_dump($objAppliedStudentArray);
            /*for($i=0;$i<sizeof($applicationInArray);$i++){
                echo "<br/><img src = 'images/".$objAppliedStudentArray[$i]["Picture"]."' height = '100px' width = '100px' >";
                echo $objAppliedStudentArray[$i]["FirstName"]." ".$objAppliedStudentArray[$i]["LastName"];
            }
        }
        else{
            echo "No Student has applied for this job yet..";
        }*/
        
        $objJobManagement = new JobManagement();
        $applicationArray = $objJobManagement->GetStudentApplicationByJobId($jobId);
        
        
        for ($i=0;$i<sizeof($applicationArray);$i++){
            echo"<br/><img src = 'images/".$applicationArray[$i]["Picture"]."' height = '100px' width = '100'/>";
            echo $applicationArray[$i]["Name"]." From ".$applicationArray[$i]["CityName"];
            $skill = explode(",",$applicationArray[$i]["SkillName"]);
            $rating = explode(",",$applicationArray[$i]["SelfRating"]);
            
            for($j=0;$j<sizeof($skill);$j++)
                echo "<br/> Skilled in ".$skill[$j]." Self Rating ".$rating[$j];
                
            echo "<br/> Application Status: ".$applicationArray[$i]["ApplicationStatus"]."<br/>";
            }
        
        
          
?>
