<?php 

include("../LI.DataAccessManagement/AdminManagementDataAccess.php");
include("../LI.Entities/Application.php");

class AdminManagement
{
    function ChangeSubscription($objEmployer)
    {
        try{
            $objAdminManagementDataAccess = new AdminManagementDataAccess();
            $objAdminManagementDataAccess->ChangeSubscription($objEmployer);
        }
        catch(Exception $ex){
        echo $ex->getMessage();
        die;        
        }
    }
    
    function UpdateApplicationStatus($ApplicationId,$Status) {
        try{
            $objApplication = new Application();
            $objApplication->ID=$ApplicationId;
            $objApplication->ApplicationStatus=$Status;
            $objAdminManagementDataAccess = new AdminManagementDataAccess();
            $objAdminManagementDataAccess->UpdateApplicationStatusById($objApplication);
        }
        catch(Exception $ex){
        echo $ex->getMessage();
        die;        
        }
    }
    
    function UpdateApplicationRating($ApplicationId,$Rating) {
        try{
            $objApplication = new Application();
            $objApplication->ID=$ApplicationId;
            $objApplication->ApplicationRating=$Rating;
            $objAdminManagementDataAccess = new AdminManagementDataAccess();
            $objAdminManagementDataAccess->UpdateApplicationRatingById($objApplication);
        }
        catch(Exception $ex){
        echo $ex->getMessage();
        die;        
        }
    }
    
}


?>