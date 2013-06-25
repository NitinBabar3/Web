<?php
            include("../Utilities/Utilities.php");
            include("../LI.Entities/Job.php");
            
?>
<html>                                                                  
    <head>     
        <title>Job Posting</title>
        <script src="scripts/jquery-1.5.1.js"></script>
        <script src="scripts/jquery.ui.core.js"></script>
        <script src="scripts/jquery.ui.widget.js"></script>
        <script src="scripts/jquery.ui.datepicker.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">
                
        <script type="text/javascript">                                         
          
               
                $(function() {
                $("#datepicker1").datepicker({showOn: 'both'});
                $("#datepicker2").datepicker({showOn: 'both'});
                $("#datepicker3").datepicker({showOn: 'both'});
                });
             
        </script>
        <style type="text/css">

            .test {
                font-family: cursive;
                font-size: 20px;
            }     

        </style>
    </head>                                                                 
    <body>            
        <h1>Job Posting Page</h1>
        <!-- we will add our HTML content here -->    
        <div>
            <form name="JobPostingPage" method="post" >
                <table>
                    <tr>
                        <td>Job Title</td>   
                        <td><input type ="text" name ="Title"></input></td>
                        <td>Job Type</td>
                        <td> 
                            <?php
                            $list = Utilities::GetListFromTableByParameter("jobtype", "Type");
                            $string = Utilities::GetHTMLDropdownFromList($list,"JobTypeId");
                            echo $string;
                            ?>
                        </td>        
                        <td>Job Prospect</td>
                        <td><input type ="checkbox" name="JobProspect" ></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        
                        <td>Describe your Job</td>   
                        <td><textarea name ="Description"></textarea></td>
                    </tr> 
                    <tr>
                        <td>Location</td>
                        <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("location", "CityName");
                            $string = Utilities::GetHTMLMultipleListFromList($list,"LocationName");
                            echo $string;
                            ?>
                        </td>
                    </tr>
                    <tr>
                         <td>Functions</td>
                         <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("jobfunctions", "Function");
                            $string = Utilities::GetHTMLMultipleListFromList($list,"Function");
                            echo $string;
                            ?>
                          </td>    
                    </tr> 
                    <tr>
                        <td>Start Date:</td><td><input type="text" id="datepicker1" name="StartDate"></td>
                        <td>End Date:</td><td><input type="text" id="datepicker2" name="EndDate"></td>
                    </tr>
                    <tr><td>Deadline<br/>for application:</td><td><input type="text" id="datepicker3" name="ApplicationDeadline"></td></tr>
                    <tr><td>Is period Flexible</td><td><input type ="checkbox" name="IsPeriodFlexible"></input></td></tr>
                    <tr><td>No of openings</td><td><input type ="text" name ="NoOfPositions" style="width:50px"></input></td></tr>
                    <tr>
                        <td>Skills required</td>
                        <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("skills", "SkillName");
                            $string = Utilities::GetHTMLMultipleListFromList($list,"Skill");
                            echo $string;
                            ?>
                        <td>
                    </tr>
                    <tr>
                        <td>Compensation type</td>
                        <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("compensation", "CompensationType");
                            $string = Utilities::GetHTMLDropdownFromList($list,"Compensation");
                            echo $string;
                            ?>
                        </td> 
                        <td>Compensation<br/>Amount</td>
                        <td><input type ="text" name ="Amount"></input></td> 
                    </tr>
                    <tr>
                        <td>Academic<br/>requirement</td>
                        <td>   
                            <select name="AcademicRequirement" size="1" style="width:200px;height:40px">
                            <option value="B.E">B.E</option>
                            <option value="MBA">MBA</option>
                            <option value="BCom">BCom</option>
                            <option value="CA">CA</option></select>
                        </td>                
                    </tr>
                    <tr><td>Is featured</td><td><input type ="checkbox" name="IsFeatured"></input></td></tr>
                    <tr>
                        <td>Screening<br/>tests</td>
                        <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("test", "TestTitle");
                            $string = Utilities::GetHTMLDropdownFromList($list,"ScreeningTestId");
                            echo $string;
                            ?>
                        </td>    
                    </tr>
                    <tr><td><input type="hidden" name="EmployerId" value="999"></td></tr>
                    <tr><td><input type="submit" name="insert" value="Insert"></td></tr>
                     
                </table>
            </form>
        </div>
        <?php
        include("../LI.BusinessManagement/JobManagement.php");
        
        if($_POST["insert"])
        {
            try 
                {   
                    $flag=0;

                    if(isset($_POST["EmployerId"])!=1)
                    {
                        echo "<br>Invalid Employer Id";
                        $flag=1;
                    }
                    if(strlen($_POST["Title"])==0)
                    {
                        echo "<br>Invalid Title";
                        $flag=1;
                    }
                    if(isset($_POST["JobTypeId"])!=1)
                    {
                        echo "<br>Invalid JobTypeId";
                        $flag=1;
                    }
                    if(strlen($_POST["Description"])==0)
                    {
                        echo "<br>Invalid Description";
                        $flag=1;
                    }
                    if(isset($_POST["LocationName"])!=1)
                    {
                        echo "<br>Invalid LocationName";
                        $flag=1;
                    }
                    if(isset($_POST["Function"])!=1)
                    {
                        echo "<br>Invalid Function";
                        $flag=1;
                    }
                    if($_POST["StartDate"]==NULL)
                    {
                        echo "<br>Invalid StartDate";
                        $flag=1;
                    }
                    if($_POST["EndDate"]==NULL)
                    {
                        echo "<br>Invalid EndDate";
                        $flag=1;
                    }
                    if($_POST["ApplicationDeadline"]==NULL)
                    {
                        echo "<br>Invalid ApplicationDeadline";
                        $flag=1;
                    }
                    if(strlen($_POST["NoOfPositions"])==0)
                    {
                        echo "<br>Invalid NoOfPositions";
                        $flag=1;
                    }
                    if(isset($_POST["Skill"])!=1)
                    {
                        echo "<br>Invalid skill";
                        $flag=1;
                    }
                    if(isset($_POST["Compensation"])!=1)
                    {
                        echo "<br>Invalid Compensation";
                        $flag=1;
                    }
                    if(strlen($_POST["Amount"])==0)
                    {
                        echo "<br>Invalid Amount";
                        $flag=1;
                    }
                    if(isset($_POST["AcademicRequirement"])!=1)
                    {
                        echo "<br>Invalid AcademicRequirement";
                        $flag=1;
                    }
                    if(isset($_POST["ScreeningTestId"])!=1)
                    {
                        echo "<br>Invalid ScreeningTestId";
                        $flag=1;
                    }

                    if($flag==1)
                    {
                        echo "Invalid";
                        exit ();
                    }
                    $objJob= new Job();
                    $objJobManagement = new JobManagement();

                    $objJob->EmployerId=$_POST["EmployerId"];  //will be getting in session handling
                    $objJob->CreatedOn=Utilities::GetCurrentDateTimeMySQLFormat();
                    $objJob->UpdatedOn=Utilities::GetCurrentDateTimeMySQLFormat();
                    //get title
                    $objJob->Title=$_POST["Title"];
                    
                    //get jobid
                    $objJob->JobTypeId=$_POST["JobTypeId"];
                    
                    //get description
                    $objJob->Description=$_POST["Description"];
                    
                    //getting locationIDString

                    $LocationIdArray=array();
                    foreach ($_POST["LocationName"] as $CityName)
                        array_push($LocationIdArray,$CityName); 

                    $LocationIdString=implode(",", $LocationIdArray);
                    $objJob->LocationIdString=$LocationIdString;
                    
                    //get job prospect
                    if($_POST["JobProspect"]=="on")      
                        $objJob->JobProspect=1;
                    else
                        $objJob->JobProspect=0;
                    
                    //getting FunctionIDString
                    $FunctionIdArray=array();
                    foreach ($_POST["Function"] as $FunctionName)
                        array_push($FunctionIdArray,$FunctionName); 

                    $FunctionIdString=implode(",", $FunctionIdArray);
                    $objJob->FunctionIdString=$FunctionIdString;
                    
                    //getdate correct format for dates
                    $currentstartdate=(string)$_POST["StartDate"];
                    $startdate=Utilities::JqueryDateFormatToMySQLDateFormat($currentstartdate);

                    $currentenddate=(string)$_POST["EndDate"];
                    $enddate=Utilities::JqueryDateFormatToMySQLDateFormat($currentenddate);

                    $objJob->StartDate=$startdate;
                    $objJob->EndDate= $enddate;

                    $currentdeadlinedate=(string)$_POST["ApplicationDeadline"];
                    $deadlinedate=Utilities::JqueryDateFormatToMySQLDateFormat($currentdeadlinedate);

                    $objJob->ApplicationDeadline= $deadlinedate;

                    //is period flexible
                    if($_POST["IsPeriodFlexible"]==1)      
                        $objJob->IsPeriodFlexible=1;
                    else
                        $objJob->IsPeriodFlexible=0;

                    //no of openings
                    $objJob->NoOfPositions=$_POST["NoOfPositions"];

                    //get required skills
                    $requiredSkillIdArray=array();
                    foreach ($_POST["Skill"] as $SkillName)
                        array_push($requiredSkillIdArray,$SkillName); 

                    $RequiredSkillIdString=implode(",", $requiredSkillIdArray);
                    $objJob->RequiredSkillIdString=$RequiredSkillIdString;
                    
                    //get compensation id
                    $objJob->CompensationTypeId=$_POST["Compensation"];

                    //get amount
                    $objJob->Amount=$_POST["Amount"];

                    //AcademicRequirement
                    $objJob->AcademicRequirement=$_POST["AcademicRequirement"];

                    //is featured
                    $objJob->IsFeatured=$_POST["IsFeatured"];

                    //get ScreeningTestId
                    $objJob->ScreeningTestId=$_POST["ScreeningTestId"];

                    //insert
                    $objJobManagement->InsertJob($objJob); 
                }
                catch(Exception $ex){
                    echo $ex->getMessage();
                    die;        
                }
        }
        ?>
     </body>                                                                 
</html>






