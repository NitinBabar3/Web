<!DOCTYPE html>
<html>
    <head>
        <title>Job Posting</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div><form name ="jobposting" method ="post">
                
                Post Job<input type ="text" name ="title"></input><br/>
                Describe your Job<textarea name ="description"></textarea><br/>
                Job Type<select name="job_type">
                    <option value="IT & Software">IT & Software</option>
                    <option value="Media">Media</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Sports">Sports</option>
                    <option value="Jamaadaar">Jamaadaar</option>
                    <option value="crap">crap</option>
                    <option value="porn">porn</option>
                </select><br/>
                Location<br/>
                <input type ="checkbox" name="delhi">Delhi</input>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type ="checkbox" name="mumbai">Mumbai</input><br/>
                <input type ="checkbox" name="bangalore">Bangalore</input>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type ="checkbox" name="pune">Pune</input><br/><br/>
                Looking for<br/>
                <input type ="checkbox" name="interns"">Interns</input><br/>
                <input type ="checkbox" name="virtual_interns">Virtual Interns</input><br/>
                <input type ="checkbox" name="volunteers">Volunteers</input><br/><br/>
                Duration<br/>
                Start Date <input type="text"></input>
                &nbsp;&nbsp;&nbsp;End Date <input type ="text"></input><br/>
                <input type ="checkbox" name="is_period_flexible">Period is flexible</input><br/><br/>
                Number of positions<input type ="text" name ="no_of_positions"></input><br/>
                Compensation<input type="text" name ="compensation"></input><br/>
                Last date to apply<input type ="text" name="last_application_date"></input><br/>
                Required Skill Set:<br/>
                <input type ="checkbox" name="skill1">Skill1</input>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type ="checkbox" name="skill2">Skill2</input>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type ="checkbox" name="skill3">Skill3</input><br/>
                <input type ="checkbox" name="skill4">Skill4</input>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type ="checkbox" name="skill5">Skill5</input>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type ="checkbox" name="skill6">Skill6</input><br/>                                         
                Academic Requirement<br/>
                <select name="academic_requirement">
                    <option value="B.E">B.E</option>
                    <option value="B.Arch">B.Arch</option>
                    <option value="B.Com">B.Com</option>
                    <option value="BSc">BSc</option>
                    <option value="BBA">BBA</option>
                    <option value="Any Graduate">Any Graduate</option>
                </select>
                <input type="submit" name="PostBack" value="test">
            </form>
        
        </div>
    </body>
</html>
<?php

include "../data_accesor/entity_classes/Jobs.php";
//include "../business/AddNewJob.php";
if($_POST["PostBack"])
{
    try
    {
                $objJobManagement = new JobManagement();
                                    $job = new Jobs();
                                    $job->title = $_POST["title"];
                                    $job->description = $_POST["description"];
                                    $job->job_type_id = 1;
                                    $job->start_date = $_POST["start_date"];
                                    $job->end_date = $_POST["end_date"];
                                    if (isset($_POST["is_period_flexible"]))
                                        $job->is_period_flexible=1;
                                    $job->number_of_positions=$_POST["no_of_positions"];
                                    $job->compensation_type_id=$_POST["compensation"];
                                    $job->application_deadline=$_POST["last_application_date"];
                                    $job->academic_requirement=$_POST["academic_requirement"];


                                    //location
                                    $location_string = "0";
                                    if (isset($_POST["delhi"]))
                                        $location_string = $location_string."1";
                                    if (isset($_POST["mumbai"]))
                                        $location_string = $location_string."2";
                                    if (isset($_POST["bangalore"]))
                                        $location_string = $location_string."3";
                                    if (isset($_POST["pune"]))
                                        $location_string = $location_string."4";

                                    $job->location_id_string = (int)$location_string;

                                    $skill_string = "0";
                                    if (isset($_POST["skill1"]))
                                        $skill_string = $skill_string."1"; 
                                    if (isset($_POST["skill2"]))
                                        $skill_string = $skill_string."2";

                                    if (isset($_POST["skill3"]))
                                        $skill_string = $skill_string."3";
                                    if (isset($_POST["skill4"]))
                                        $skill_string = $skill_string."4";
                                    if (isset($_POST["skill5"]))
                                        $skill_string = $skill_string."5";
                                    if (isset($_POST["skill6"]))
                                        $skill_string = $skill_string."6";

                                    $job->required_skill_id_string = (int)$skill_string;

                                    $function_string = "0";

                                    if(isset($_POST["interns"]))
                                        $function_string = $function_string."1";
                                    if(isset($_POST["virtual_interns"]))
                                        $function_string = $function_string."2";
                                    if(isset($_POST["volunteers"]))
                                        $function_string = $function_string."3";

                                    $job->function_id_string = (int)$function_string;

                                    $datetime = idate(Y)."-".idate(m)."-".idate(d)." ".idate(H).":".idate(i).":".idate(s);
                                    $job->created_on=$datetime;
                                    $job->updated_on=$datetime;


                $add_job->InsertJob($job);
    }
    catch(Exception $ex)
    {
        echo "this is the error".$ex->getMessage();
    }
}
?>
