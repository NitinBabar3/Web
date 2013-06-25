<?php
include("Utilities.php");
include("../LI.Entities/Employer.php");
?>
<html>

    <head>
        <title>testing</title>
        <script src="scripts/jquery-1.5.1.js"></script>
        <script src="scripts/jquery.ui.core.js"></script>
        <script src="scripts/jquery.ui.widget.js"></script>
        <script src="scripts/jquery.ui.datepicker.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">
        
        <script type="text/javascript">                                         
          
               
               
             
        </script>
        
        
        
        
    </head>

    <body>
        <table>
                <thead>
                    <tr><td>search by</td></tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        <?php
                            $class_name="Employer";
                            $no = Utilities::GetEntityClassNoofAttributes($class_name);
                            //echo $no."<br/>";
                            $array = Utilities::GetEntityClassAttributes($class_name);
                            //echo $str;
                            //print_r($array);
                            $string = "<select id = 'employer'><option value=0></option>";
                            for ($i=1;$i<=$no;$i++) {
                                $substring = "<option value =" . $i . ">" . $array[$i-1] . "</option>";
                                $string = $string . $substring;
                            }
                            $string = $string . "</select>";
                            echo $string;
                        ?>
                    </td>
                    </tr>
                </tbody>
            </table>
    </body>
</html>