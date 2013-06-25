<?php
include("../Utilities/Utilities.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Change Subscription</title>
    </head>
    <body>
        <h1>Change Subscription</h1>
        <div>    
            <form name="ChangeEmployerSubscription" method="post" >
                <table>
                    <tr>
                        <td>Employer's Company Name:<td>
                        <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("employer", "CompanyName");
                            $string = Utilities::GetHTMLMultipleListFromList($list, "ID");
                            echo $string;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Subscription Type:<td>
                        <td>
                            <?php
                            $list = Utilities::GetListFromTableByParameter("subscriptiontypes", "SubscriptionType");
                            $string = Utilities::GetHTMLDropdownFromList($list, "SubscriptionTypeId");
                            echo $string;
                            ?>
                        </td>
                    </tr>
                    <tr><td><tr><td><input type="submit" name="change" value="Change"></td></tr></td></tr>
                </table>
            </form>
        </div>
        <?php
        include("../LI.BusinessManagement/AdminManagement.php");
        include("../LI.Entities/Employer.php");
        if($_POST["change"]=="Change")
        {
            try {

                $objEmployer = new Employer();
                $objAdminManagement = new AdminManagement();
                
                    
                foreach ($_POST["ID"] as $ID) {
                    
                    $objEmployer->ID = $ID;
                    $objEmployer->SubscriptionTypeId = $_POST["SubscriptionTypeId"];

                    $objAdminManagement->ChangeSubscription($objEmployer);
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
                die;
            }
            /*try
            {
                $ApplicationId=1;
                $Status="Rejected"; //applied,shortlisted,rejected,selected
                $objAdminManagement = new AdminManagement();
                $objAdminManagement->UpdateApplicationStatus($ApplicationId,$Status);
            }
            catch (Exception $ex) {
                echo $ex->getMessage();
                die;
            }
            try
            {
                $ApplicationId=1;
                $Rating=4; 
                $objAdminManagement = new AdminManagement();
                $objAdminManagement->UpdateApplicationRating($ApplicationId,$Rating);
            }
            catch (Exception $ex) {
                echo $ex->getMessage();
                die;
            }*/
        }
        ?>
    </body>
</html>