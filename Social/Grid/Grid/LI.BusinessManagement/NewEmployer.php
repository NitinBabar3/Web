
<?php
include '../Utilities/Utilities.php';
include '../LI.Entities/Employer.php';
include '../LI.Entities/UserAccount.php';
include '../LI.BusinessManagement/UserManagement.php';
include '../LI.BusinessManagement/EmployerManagement.php';


    try{
        
            $objUser = Utilities::CreateUserObjectAsEmployer($_POST["Password"], $_POST["Email"]);
            $objUserDataAccess = new UserDataAccess();
            $objUser->ID = $objUserDataAccess->InsertNewUser($objUser);
            //$objUser->ID = Utilities::GetUserIdOfNewUser($objUser->Email);

            $location_string_id = implode(",",$_POST["location"]);

            $class_attributes = Utilities::GetEntityClassAttributes("Employer");
               $objEmployer = new Employer();
            for($i=0;$i<sizeof($class_attributes);$i++){
                if(isset($_POST[$class_attributes[$i]]))
                    $objEmployer->$class_attributes[$i] = $_POST[$class_attributes[$i]];          
            }
            $objEmployer->UserId = $objUser->ID;
            if ($_FILES["logo"]["error"] > 0){
                //Handle this error.
                echo "no";
            }
            else{
                $logo_name = Utilities::UploadImage($_FILES["logo"]["tmp_name"], $_FILES["logo"]["name"], $_FILES["logo"]["size"],$objEmployer->UserId);
                $objEmployer->Logo = $logo_name;
            }
            $datetime = Utilities::GetCurrentDateTimeMySQLFormat();
            $objEmployer->updatedOn = $datetime;
            $objEmployer->SubscriptionTypeId=1;
            $objEmployer->LocationIdString = $location_string_id;
            $objEmployerDataAccess = new EmployerDataAccess();        
            $objEmployerDataAccess->InsertNewEmployer($objEmployer);
        
    }
    
    catch(Exception $ex){
        echo $ex->getMessage();
        die;        
    }
?>