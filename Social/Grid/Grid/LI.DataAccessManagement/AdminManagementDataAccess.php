
<?php
class AdminManagementDataAccess
{
    function ChangeSubscription($objEmployer) {
        try {
            $array = Utilities::ObjectToArray($objEmployer);
            $param_value = (int) $array[3][1];
            $table = "employer";
            $param = "SubscriptionTypeID";
            $condition = "ID = " . $objEmployer->ID;
            MySQLDataAdapter::Update($table, $param, $param_value, $condition);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
    }
    
    function UpdateApplicationStatusById($objApplication)
    {
        try {
            $array = Utilities::ObjectToArray($objApplication);
            $param_value = "'".(string)$array[4][1]."'";
            $table = "application";
            $param = "ApplicationStatus";
            $condition = "ID = ". $objApplication->ID;
            MySQLDataAdapter::Update($table, $param, $param_value, $condition);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
    }
    
    function UpdateApplicationRatingById($objApplication)
    {
        try {
            $array = Utilities::ObjectToArray($objApplication);
            $param_value = (int) $array[5][1];
            $table = "application";
            $param = "ApplicationRating";
            $condition = "ID = ". $objApplication->ID;
            MySQLDataAdapter::Update($table, $param, $param_value, $condition);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
    }    
}

?>