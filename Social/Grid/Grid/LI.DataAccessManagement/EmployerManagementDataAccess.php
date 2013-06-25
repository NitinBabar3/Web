<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmployerManagementDataAccess
 *
 * @author letstech01
 */
class EmployerManagementDataAccess {
    
    function InsertNewEmployer($objEmployer){
        try{
            $arrayEmployer = Utilities::ObjectToArray($objEmployer);
            $stringEmployer = Utilities::ArrayToString($arrayEmployer);
            $param = strtok($stringEmployer, "|");
            $param_value = strtok("|");           
            MySQLDataAdapter::Insert('employer', $param, $param_value);        
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetEmployerDetails($userId){
        
        try{
            $employerClassAttributes = Utilities::GetEntityClassAttributesInString("Employer");
            $hashEmployerDetails = MySQLDataAdapter::Read('employer', $employerClassAttributes, 'UserId ='.$userId);
            $arrayEmployerDetails = Utilities::HashTableToArray($hashEmployerDetails, $employerClassAttributes);
            return Utilities::ArrayToObject($arrayEmployerDetails[0], new Employer);
        
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function GetCompleteEmployerDetails($userId){
        try{
            $employerClassAttributes = Utilities::GetEntityAttributesWithClassNamePreceeding("Employer");
            $employerClassAttributes = $employerClassAttributes.",IndustryType,CompanyType,SubscriptionType as SubscriptionTypeId";            
            $hashEmployerDetails = MySQLDataAdapter::Read('employer,industry,company_type,subscriptiontypes', $employerClassAttributes, 'employer.UserId ='.$userId.' AND employer.CompanyTypeId = company_type.ID AND employer.IndustryID = industry.ID AND subscriptiontypes.ID = employer.SubscriptionTypeID AND employer.Deleted=0');            
            
            $arrayEmployerDetails  = Utilities::HashTableToArrayWithoutParamString($hashEmployerDetails);           
            
            $objEmployer = Utilities::ArrayToObjectWithOtherParametersInArray($arrayEmployerDetails[0], new Employer());
            $objEmployer->CompanyTypeId = $arrayEmployerDetails[0]["CompanyType"];
            $objEmployer->IndustryID = $arrayEmployerDetails[0]["IndustryType"];
            $location_string = Utilities::GetAttributeTypeStringFromIdString('location', 'CityName', $objEmployer->LocationIdString);
            $objEmployer->LocationIdString = $location_string;
         
            return $objEmployer;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
}
?>
