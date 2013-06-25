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

class EmployerDataAccess {
    function InsertNewEmployer($objEmployer){
        $arrayEmployer = Utilities::ObjectToArray($objEmployer);
        $stringEmployer = Utilities::ArrayToString($arrayEmployer);
        $param = strtok($stringEmployer, "|");
        $param_value = strtok("|");           
        MySQLDataAdapter::Insert('employer', $param, $param_value);        
    }
}

?>
