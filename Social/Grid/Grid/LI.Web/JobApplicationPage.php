<?php
include_once'../Utilities/Utilities.php';
include("../LI.Entities/Job.php");
include("../LI.BusinessManagement/JobManagement.php")
?>
<html>                                                                  
    <head>     
        <title>Job Application</title>
        
        <script src="scripts/jquery-1.5.1.js"></script>
        <script src="scripts/jquery.ui.core.js"></script>
        <script src="scripts/jquery.ui.widget.js"></script>
        <script src="scripts/jquery.ui.datepicker.js"></script>

        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">    
    </head>                                                                 
    <body>            
        <h1>Job Application</h1>
        <!-- we will add our HTML content here -->    
        <div>
            <form name="JobApplicationPage" method="post">
                <table>
                    <tr>
                        <td></td>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Location</td>
                        <td>Description</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Function</td>
                    <tr>
                    <tr><td colspan="9"><hr/></tr>
                <?php

                $objJobManagement= new JobManagement();

                $objArray=$objJobManagement->DisplayJob();
                //print_r($objArray); 
                //var_dump($objArray);
                   foreach ($objArray as $object) {

                    ?>
                    <tr>
                        <td><input type="checkbox" name="jobcheck[]" value="<?php echo $object->ID;?>"></td>
                        <td><?php echo $object->ID;?></td>
                        <td><?php echo $object->Title;?></td>
                        <td><?php echo $object->LocationIdString;?></td>
                        <td><?php echo $object->Description;?></td>
                        <td><?php echo $object->StartDate;?></td>
                        <td><?php echo $object->EndDate;?></td>
                        <td><?php echo $object->FunctionIdString;?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr><td><input type="hidden" name="StudentId" value="1"></td></tr>
                    <tr><td><input type="hidden" name="ApplicationRating" value="4"></td></tr>
                    <tr><td><input type="submit" name="Apply" value="Apply"></td></tr>
                </table>
           </form>
        </div>
        <?php
        include("../LI.BusinessManagement/JobApplicationManagement.php");
        include("../LI.Entities/Application.php");
        
        if ($_POST["Apply"] == "Apply") {
            
            try {
                if (isset($_POST["jobcheck"])) {
                        
                    $jobs = $_POST["jobcheck"];
                    $total = count($jobs);
                    //echo $total;
                    for ($i = 0; $i < $total; $i++) {
                        
                        $objApplication = new Application();
                        $objApplication->StudentId = $_POST["StudentId"];
                        $objApplication->ApplicationRating = $_POST["ApplicationRating"];
                        $objApplication->ApplicationStatus = "Applied";
                        $objApplication->AppliedOn = Utilities::GetCurrentDateTimeMySQLFormat();
                        $objApplication->StatusUpdatedOn = Utilities::GetCurrentDateTimeMySQLFormat();

                        $objJobApplicationManagement = new JobApplicationManagement();

                        $objApplication->JobId = $jobs[$i];
                        $objJobApplicationManagement->NewApplication($objApplication);
                    }
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
                die;
            }
        }
        ?>
    </body>                                                                 
</html>   



