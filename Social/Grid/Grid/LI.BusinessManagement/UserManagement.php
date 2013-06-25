<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserManagement
 *
 * @author letstech01
 */

include '../LI.DataAccessManagement/UserDataAccess.php';
class UserManagement {
    
    function InsertNewUser($objUser){
        try{
            $objUserDataAccess = new UserDataAccess();
            return $objUserDataAccess->InsertNewUser($objUser);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function ActivateUser($activationCode){
        try{
            $objUserDataAccess = new UserDataAccess();
            return $objUserDataAccess->ActivateUser($activationCode);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function ValidateUser($objUserAccount){
        try{
            $objUserDataAccess = new UserDataAccess();
            $result=$objUserDataAccess->ValidateUser($objUserAccount);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $result;
    }
    
    
    
}

?>
