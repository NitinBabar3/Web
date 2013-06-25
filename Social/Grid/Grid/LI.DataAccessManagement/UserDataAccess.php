<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDataAccess
 *
 * @author letstech01
 */
class UserDataAccess {
    function InsertNewUser($objUser){
        try{
            $arrayUser = Utilities::ObjectToArray($objUser);
            $stringUser = Utilities::ArrayToString($arrayUser);
            $param = strtok($stringUser, "|");
            $param_value = strtok("|");           
            MySQLDataAdapter::Insert('useraccount', $param, $param_value);
            return Utilities::GetUserIdOfNewUser($objUser->Email);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function ActivateUser($activationCode){
        try{
            return MySQLDataAdapter::ActivateUser($activationCode);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    function ValidateUser($objUserAccount){
        try{
                //echo $objUserAccount->Email."<br/>";
                //echo $objUserAccount->Password."<br/>";
                
                $query="select u.ID,u.Email,u.Password,u.Salt,t.Type,accountstatus.Status from accountstatus,useraccount u inner join usertype t on u.UserTypeId = t.Id where u.deleted=0 and t.deleted=0
                    and u.Email='$objUserAccount->Email' and u.AccountStatusId=accountstatus.ID";
                //echo $query."<br/>";
                $result=MySQLDataAdapter::Query($query);
                //print_r($result);
                $row = mysql_fetch_assoc($result);
                    //echo "hi";
                    //echo "<br/>".$row["ID"];
                    //echo "<br/>".$row["Email"];
                    //echo "<br/>".$row["Password"];
                    //echo "<br/>".$row["Salt"];
                    //echo "<br/>".$row["Status"];
                    
                    $dbpassword=Utilities::HashPasswordfromDBSalt($objUserAccount->Password,$row["Salt"]);
                    //echo "<br/>".$dbpassword;
                    
                    if($row["Password"] != $dbpassword || $row["Status"]!="active")
                    {
                        //echo "hi";
                        $str="invalid";
                        return $str;
                    }
                    else {
                        $objUserAccount->Email=$row["Email"];
                        $objUserAccount->Password=$row["Password"];
                        $objUserAccount->Type=$row["Type"];
                        $objUserAccount->ID=$row["ID"];
                        return $objUserAccount;
                    }
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
}

?>
