<?php


/*8th august
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLDataAdapter
 *
 * @author letstech01
 */
include "../../Configurations/MySQLConnection.php";

class MySQLDataAdapter { //Entity class and table in database has to be exactly same!
    static function Insert($table,$param,$param_value){
		$sql="insert into $table($param) values($param_value)";
		//echo $sql;
        mysql_query($sql);
    }
    
    static function Delete($table,$condition){
        mysql_query("update $table set deleted = 1 where $condition");
    }
    
    static function Read($table,$param,$condition){
        return mysql_query("select $param from $table where $condition");        
    }
    
    static function Update($table,$param,$param_value,$condition){ //will update one parameter at one call
        mysql_query("update $table set $param = $param_value where $condition");
    }            
    
    static function GetListFromTableByParameter($table,$param){
        return mysql_query("select ID,$param from $table");
    }
    
    static function GetAppliedStudentDetailsByJobId($jobId){
        return mysql_query('SELECT student.Name,student.ID,location.CityName,student.Picture,skills.SkillName,student_skills.SelfRating,application.ApplicationStatus FROM student,application,location,skills,student_skills where application.JobId ='.$jobId.' AND student.ID = application.StudentID AND student.LocationId = location.Id AND student.ID = student_skills.StudentId AND skills.ID = student_skills.SkillId');
    }
    
    static function ActivateUser($activationCode){
        mysql_query("Update useraccount set AccountStatusId = 1 where ActivationCode = '$activationCode'");
    }
    static function Query($query){
        return mysql_query($query);        
    }
    /*Added by Nits on 4th September 2012 at 14:03 as per my laptop time.Do not panic.*/
	static function GetAppliedStudentDetailsByStudentId($StudentId){
	
		$app_query="SELECT employer.CompanyName,job.title,application.ApplicationStatus,application.AppliedOn from application
					INNER JOIN job
					ON job.ID=application.JobId
					INNER JOIN employer
					On employer.ID=job.EmployerId
					WHERE application.StudentId='".$StudentId."'";
					//echo $app_query;
		$result= mysql_query($app_query);
		$row=mysql_fetch_array($result);	
		return $row;
    }
    /*End function*/
}

?>