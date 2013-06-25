<?php
            include("../Utilities/Utilities.php");
            include("../LI.Entities/Job.php");            
?>
<html>                                                                  
    <head>     
        <title> Posting Questions</title>
        <script src="scripts/jquery-1.5.1.js"></script>
        <script src="scripts/jquery.ui.core.js"></script>
        <script src="scripts/jquery.ui.widget.js"></script>
        <script src="scripts/jquery.ui.datepicker.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">
        
    </head> 
    
    <body>            
        <h1>Question</h1>
        <!-- we will add our HTML content here -->    
        <div>
            <form name="Question" method="post">
                <table>
                    <tr>
                        <td>Functions</td>
                        <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("jobfunctions", "Function");
                            $string = Utilities::GetHTMLDropdownFromList($list, "FunctionId");
                            echo $string;
                            ?>
                        </td>    
                    </tr> 
                    <tr>
                        <td>Question</td>
                        <td><textarea name ="QuestionText"></textarea></td>
                    </tr>
                    <tr><td><input type="radio" name="QuestionType" value="MCQ" />MCQ</td></tr>
                    <tr>
                    <?php  
                        for($i=0;$i<4;$i++)
                        {
                            //echo $i;
                    ?>    
                        <td><input type="checkbox" name="MCQCheckbox[<?php echo $i ?>]"><input type="text" name="MCQOption[<?php echo $i ?>]"></td>
                     <?php  
                        }
                    ?>    
                    </tr>
                    <tr><td><input type="radio" name="QuestionType" value="T/F" />True or False</td></tr>    
                    <tr> 
                        <td><input type="radio" name="T/FOption" value="True">True</td>
                        <td><input type="radio" name="T/FOption" value="False">False</td>
                    </tr>
                    <tr><td><input type="radio" name="QuestionType" value="Descriptive" />Descriptive</td></tr>        
                    <tr><td><input type="radio" name="QuestionType" value="Audio" />Audio Response</td></tr>        
                   
                    <tr><td><input type="submit" name="insert" value="Insert"></td></tr>
                </table>
           </form>        
        </div>
        <?php
        include("../LI.Entities/Question.php");
        //include("../LI.Entities/QuestionOption.php");
        include("../LI.BusinessManagement/QuestionManagement.php");
        if($_POST["insert"]=="Insert")
        {
            try {
                    $empId = 99 ; // to be taken from session             
                    $flag = 0;
                    if(strlen($_POST["QuestionText"])==0)
                    {
                        echo "<br>Invalid QuestionText";
                        $flag = 1;
                    }
                    if(isset($_POST["FunctionId"])==NULL)
                    {
                        echo $_POST["FunctionId"];
                        echo "<br>Invalid FunctionId";
                        $flag = 1;
                    }
                    if(isset($_POST["QuestionType"])==NULL)
                    {
                        echo "<br>Invalid QuestionType";
                        $flag = 1;
                    }
                    if($flag==1)
                    {
                        //echo "Invalid";
                        exit ();
                    }
                    echo $_POST["FunctionId"];
                    $objQuestion = new Question();

                    $objQuestion->QuestionText = $_POST["QuestionText"];
                    $objQuestion->FunctionId = $_POST["FunctionId"];
                    $objQuestion->QuestionType = $_POST["QuestionType"];
                    $objQuestion->CreatedByUserId = $empId;
                    $objQuestion->CreatedOn=  Utilities::GetCurrentDateTimeMySQLFormat();
                    //echo $objQuestion->QuestionType;
                    //echo $objQuestion->FunctionId;
                
                    $objQuestionManagemenet= new QuestionManagement();
                    //$objQuestionManagemenet->AddQuestion($objQuestion);
                    if($objQuestion->QuestionType=="MCQ")
                    {
                        //echo"in mcq";
                        $i=0;
                        foreach($_POST["MCQOption"] as $text[$i])
                        {    
                            //echo $text[$i];
                            $i++;
                        }
                        $i=0;
                        foreach($_POST["MCQCheckbox"] as $checkbox[$i])
                        {    
                            //echo $checkbox[$i];
                            if($checkbox[$i]=="on")
                            {
                                $check[$i]=1;
                                //echo "<br/>checked";
                            }
                            else
                            {
                                $check[$i]=0;
                                //echo "<br/>not checked";
                            }   
                            $i++;
                        }
                        $j=0;
                        $objQuestionOptionsArray=array();
                        for($i=0;$i<4;$i++)
                        {
                            $objQuestionOptions = new QuestionOption();
                            $objQuestionOptions->OptionText=$text[$i];
                            $objQuestionOptions->IsCorrect=$check[$i];
                            $objQuestionOptionsArray[$j]=$objQuestionOptions;
                            $j++;
                        }
                        $objQuestionManagemenet->AddQuestion($objQuestion,$objQuestionOptionsArray);
                        
                    }
                    else if($objQuestion->QuestionType=="T/F")
                    {
                        //echo("Its True or false");
                        $answer= $_POST["T/FOption"];
                        $objQuestionManagemenet->AddQuestion($objQuestion,$answer);
                    }
                    else
                    {
                        $answer="";
                        $objQuestionManagemenet->AddQuestion($objQuestion,$answer);
                    }
                    
                    
                }
                catch(Exception $ex){
                    echo $ex->getMessage();
                    die;        
                }
        }
        ?>
     </body>                                                                 
</html>