<?php
            include("../Utilities/Utilities.php");
            include("../LI.Entities/Question.php");  
            //include("../LI.Entities/QuestionOption.php");
            include("../LI.Entities/QuestionWithOptions.php");
?>
<html>                                                                  
    <head>     
        <title> Create Questions</title>
        <!link rel="stylesheet" href="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/css/bootstrap.css">
        <script src="scripts/jquery-1.5.1.js"></script>
        <script src="scripts/jquery.ui.core.js"></script>
        <script src="scripts/jquery.ui.widget.js"></script>
        <script src="scripts/jquery.ui.datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">
        
        <script type ="text/javascript">
        
        function abc(a)
        {
            alert(a);
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    //document.getElementById("show").innerHTML=xmlhttp.responseText;
                    setTimeout("location.reload(true)",1000);
                }
            }
            
            xmlhttp.open("GET","deletepage.php?qid="+a,true);
            xmlhttp.send();
            //document.location.reload();
            //window.opener.location.reload();
        }

    </script>
        
    </head> 
    
    <body>            
        <h1>Question</h1>
        <!-- we will add our HTML content here -->    
        <div>
            <form name="ViewQuestions" method="post">
                <table class="table">
                <thead>
                    <tr>
                        <th>Created By</th><td>|</td>
                        <th>Function Name</th><td>|</td>
                        <th>Question Type</th><td>|</td>
                        <th>Question Text</th><td>|</td>
                        <th>option1</th><td>|</td>
                        <th>is correct</th><td>|</td>
                        <th>option2</th><td>|</td>
                        <th>is correct</th><td>|</td>
                        <th>option3</th><td>|</td>
                        <th>is correct</th><td>|</td>
                        <th>option4</th><td>|</td>
                        <th>is correct</th><td>|</td>
                    <tr>
                </thead>        
                <tr><td colspan="26"><hr/></tr>  
                    
                    
                <?php
                include("../LI.BusinessManagement/QuestionManagement.php");
                
                $objQuestionManagement= new QuestionManagement();
                $UserId=29; // to be taken from session 29 for admin
                $objArray=$objQuestionManagement->DisplayQuestionsByUserID($UserId);
                //print_r($objArray);   
                   foreach ($objArray as $object) 
                       {

                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $object->CreatedByUserId;?></td><td>|</td>
                        <td><?php echo $object->Function;?></td><td>|</td>
                        <td><?php echo $object->QuestionType;?></td><td>|</td>
                        <td><?php echo $object->QuestionText;?></td><td>|</td>
                        <?php
                        if($object->QuestionType=="MCQ")
                        {
                            foreach($object->OptionArray as $option)
                            {
                        ?>
                        
                            <td><?php echo $option->OptionText;?></td><td>|</td>
                            <td><?php echo $option->IsCorrect;?></td><td>|</td>
                            
                        <?php    
                        
                            }
                        }
                        else if($object->QuestionType=="T/F")
                        {
                            foreach($object->OptionArray as $option)
                            {
                        ?>
                        
                            <td><?php echo $option->OptionText;?></td><td>|</td>
                            <td><?php echo $option->IsCorrect;?></td><td>|</td>
                            
                        <?php    
                        
                            }
                            
                            ?>
                             <td></td><td>|</td><td></td><td>|</td><td></td><td>|</td><td></td><td>|</td>
                            <?php
                        }
                        
                        else
                        {
                        ?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                        <?php
                        }
                        ?>
                        <td><a href="editpage.php?qid=<?php echo $object->ID; ?>&uid=<?php echo $EmployerId; ?>"><button type="button">Edit</button></a></td>
                        <td>
                            <!--a href="deletepage.php?qid=<?php echo $object->ID; ?>&uid=<?php echo $EmployerId; ?>"><button type="button">Delete</button></a-->
                            <button type="button" onclick="abc(<?php echo $object->ID; ?>)">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                    <tr></tr>
                    <?php
                    }
                    ?>
                </table>
           </form>
        </div>
     </body>                                                                 
</html>