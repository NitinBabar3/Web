<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmployerManagement
 *
 * @author letstech01
 */
include '../LI.DataAccessManagement/EmployerManagementDataAccess.php';
class EmployerManagement {
    
    function InsertNewEmployer($objEmployer){
        try{
            $objEmployerManagementDataAccess = new EmployerManagementDataAccess();
            $objEmployerManagementDataAccess->InsertNewEmployer($objEmployer);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetDetails($userId){
        try{
            $objEmployerManagementDataAccess = new EmployerManagementDataAccess();
            return $objEmployerManagementDataAccess->GetEmployerDetails($userId);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetCompleteEmployerDetails($userId){
        try{
            $objEmployerManagementDataAccess = new EmployerManagementDataAccess();
            return $objEmployerManagementDataAccess->GetCompleteEmployerDetails($userId);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
}

?>
