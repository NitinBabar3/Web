<?php
include("../LI.DataAccessManagement/QuestionManagementDataAccess.php");
class QuestionManagement
{
    function AddQuestion($objQuestion,$answer)
    {
        try
        {
            $objQuestionManagementDataAccess= new QuestionManagementDataAccess();
            $objQuestionManagementDataAccess->PostQuestionAndOptions($objQuestion,$answer);
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            die;        
        }
    }
    
    function UpdateQuestion($objQuestion,$answer,$QuestionId)
    {
        try
        {
            $objQuestionManagementDataAccess= new QuestionManagementDataAccess();
            $objQuestionManagementDataAccess->UpdateQuestionAndOptions($objQuestion,$answer,$QuestionId);
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            die;        
        }
    }
    
    function DisplayQuestionsByUserID($UserId)
    {
        try {
            
            $objQuestionManagementDataAccess = new QuestionManagementDataAccess();
            $objArray = $objQuestionManagementDataAccess->GetInfoQuestionsByUserID($UserId);
            return $objArray;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
    }
    
    function DeleteQuestion($questionid)
    {
        try{
            $objQuestionManagementDataAccess = new QuestionManagementDataAccess();
            $objArray = $objQuestionManagementDataAccess->DeleteQuestionByQuestionID($questionid);
            
        }catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
    }
}

?>
