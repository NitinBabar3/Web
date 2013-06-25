<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilities
 *
 * @author letstech01
 */
include("MySQLDataAdapter.php");

class Utilities {
    static function ObjectToArray($obj){
        //Creates an an array from object.
        try{
            $class_vars = get_class_vars(get_class($obj));
            $objtoarray = (array)$obj;
            $i=0;
            $array = array();
            foreach($class_vars as $param => $param_value){
                $array[$i][0] = $param;
                $array[$i][1] = $objtoarray[$param];
                $i++;
            }
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        
        return $array;
        
        
    }
    
    static function ArrayToString($array){
        //Converts an array to string where $array is a multi-dimenstional array 
        //$array is in this format -> $param (coloumn name) => $param_value (value to be inserted in the table in corresponding coloumn)        
        try{
            $param = $array[0][0];         
            $param_value = "'".$array[0][1]."'";       

            for($i=1;$i<sizeof($array);$i++){
                
                
                $param = $param.",".$array[$i][0];
             //   if($i!=sizeof($array))
                    $param_value = $param_value.",'".$array[$i][1]."'";                        
            }

            $return_string = $param."|".$param_value."|";
        }
        catch(Exception $ex)
        {
                throw $ex->getMessage();
        }
        
        return $return_string;
    }
    
    static function HashTableToArray($hash_table,$param_string){
        //Converts hash table into an array where $param_string contains the comma separated coloumns of the table from where the hash table was generated.
        try{
            
            $array = array();      
            $param = array();
            $param[0] = strtok($param_string,",");
            $i=0;
            while($param[$i] != false){
                $i++;
                $param[$i] = strtok(",");
            }
            $count=0;
            while($each_row = mysql_fetch_array($hash_table)){
                for($i=0;$i<sizeof($param)-1;$i++){ // here sizeof -1 because strtok returns an array of elements with one empty element in the end.
                    $array[$count][$param[$i]] = $each_row[$param[$i]];
					//echo $array[$count][$param[$i]]."-";
                }
                $count++;            
            }
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
		
        return $array;
    }
    
    static function ArrayToObject($array,$obj){
        //Converts $obj into an $array
        try{
            foreach($array as $param => $param_value){
                $obj->$param = $param_value;
            }
        
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $obj;
    }
    
    static function GetListFromTableByParameter($table,$param){
        //$table contains the name of the table from which a list has to be generated 
        //$param contains the name of the coloumns from which we want to have in our list.
        //$param can be contain either one parameter or comma separated parameters.
        try{
            $list = array();
            $list_from_db = MySQLDataAdapter::GetListFromTableByParameter($table,$param);
            while($row = mysql_fetch_array($list_from_db)){
                $list[$row["ID"]] = $row[$param];
            }                        
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $list;                
    }
    
    static function GetHTMLDropdownFromList($list,$name_of_select){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
            $string="<select name =".$name_of_select." required=\"required\" ><option></option>";
            foreach($list as $id => $param_value)
            {
                $substring = "<option value =".$id.">".$param_value."</option>";
                $string = $string.$substring;
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
    
    static function GetHTMLMultipleListFromList($list,$name_of_select){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
            $string="<select multiple = \"multiple\" name =".$name_of_select."[] required=\"required\">";
            foreach($list as $id => $param_value)
            {
                $substring = "<option value =".$id.">".$param_value."</option>";
                $string = $string.$substring;
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
    
    static function GetEntityClassAttributes($class_name){
        try{
            $class_vars = get_class_vars($class_name);
            $array = array();
            $i=0;
            foreach($class_vars as $param => $param_value)
                $array[$i++] = $param;                
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $array;
    }    
    
    static function JqueryDateFormatToMySQLDateFormat($jquery_date){
        //Jquery, from date picker returns date in the format mm/dd/yyyy whereas we need to sasve date in mysql in the format yyyy/mm/dd.
        try{
            $new_date = (string)$jquery_date;

            $new_date = $new_date."/";

            $mm = strtok($new_date,"/");
            $dd = strtok("/");
            $yyyy = strtok("/");           
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $yyyy."-".$mm."-".$dd;
    }
    
    static function GetCurrentDateTimeMySQLFormat(){
        //Whenever we need to insert/update "CreatedOn" or "UpdatedOn" fields in mysql tables call this function. 
        try{
            return idate(Y)."-".idate(m)."-".idate(d)." ".idate(H).":".idate(i).":".idate(s);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }

    static function UploadImage($temp_name,$image_name,$image_size,$user_id){
        
        try{
            $allowed_extensions = array("jpg", "jpeg", "gif", "png","bmp","tiff");
            $extension = end(explode(".", $image_name));
            $logo_name = "emp".$user_id.".".$extension;
            $image_save_location = "../LI.Web/images/";
            if (($image_size < 200000)&& in_array($extension, $allowed_extensions)){
                move_uploaded_file($temp_name, $image_save_location.$logo_name);
            }                                
            return $logo_name;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function HashPasswordWithSalt($password){
        //Returns a string with PasswordSalt combined string
        try{            
            $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            $key = Utilities::GetKey();
            $hashed_password = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB, $iv);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        
        return $hashed_password."||".$iv."||";
    }
    
    Static function HashPasswordfromDBSalt($password,$salt)
    {
        try {
                $key = Utilities::GetKey();
                $hashed_password = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB, $salt);
            
        } catch (Exception $ex) {
            throw $ex->getMessage();
        }
        return strtok($hashed_password,"|");
    }
    
    static function GetPasswordFromPasswordSalt($password_salt){
        //Get only Hash from PasswordSalt combined string
        try{
            return strtok($password_salt,"||");
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function GetSaltFromPasswordSalt($password_salt){
        //Get only Salt from PasswordSalt combined string
        try{
            strtok($password_salt,"||");
            return strtok("||");
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function GetKey(){
        //Generates key to hass password key->static
        try{
            return md5("letsintern12");
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function CreateUserObjectAsEmployer($password,$email){
        try{
            //Hash Password and get salt.
            $password_salt = Utilities::HashPasswordWithSalt($password);
            $password = Utilities::GetPasswordFromPasswordSalt($password_salt);
            $salt = Utilities::GetSaltFromPasswordSalt($password_salt);
            
            $datetime = Utilities::GetCurrentDateTimeMySQLFormat();
            
            $objUser = new UserAccount();
            $objUser->Email = $email;
            $objUser->Password = $password;
            $objUser->Salt = $salt;
            $objUser->CreatedOn = $datetime;
            $objUser->AccountStatusId = 3;
            $objUser->UserTypeId = 2;
            return $objUser;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    static function GetHTMLcheckboxFromList($list,$name_of_checkbox){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
            //var_dump($list);
			$total= count($list);
			$string = "";
            foreach($list as $id => $param_value)
			{
                $substring = "<input type='checkbox' value =".$param_value." name =".$name_of_checkbox."[] >&nbsp;".$param_value."&nbsp;&nbsp;";
                $string = $string.$substring;
            }
            $string = $string."";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
    static function GetUserIdOfNewUser($email){
        
        try{
            $hash_table_id = MySQLDataAdapter::Read("useraccount", "ID", "Email = '$email'");
            $array_id = Utilities::HashTableToArray($hash_table_id, "ID");
            return (int)$array_id[0]["ID"];
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
       

    }
    
    static function GetEntityClassAttributesInString($class_name){
        try{
            $array_attributes = Utilities::GetEntityClassAttributes($class_name);
            return implode(",", $array_attributes);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function HashTableToSingleDimensionArray($hash_table,$param_string){
        //Converts hash table into an array where $param_string contains the comma separated coloumns of the table from where the hash table was generated.
        try{
            
            $array = array();      
            $param = array();
            $param[0] = strtok($param_string,",");
            $i=0;
            while($param[$i] != false){
                $i++;
                $param[$i] = strtok(",");
            }
 
            while($each_row = mysql_fetch_array($hash_table)){
                for($i=0;$i<sizeof($param)-1;$i++){ // here sizeof -1 because strtok returns an array of elements with one empty element in the end.
                    $array[$param[$i]] = $each_row[$param[$i]];            
                }
                           
            }
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $array;
    }
    
    static function GetAttributeTypeFromId($table,$param,$id){
        try{
            $attribute_in_hash = MySQLDataAdapter::Read($table, $param, "ID=".$id);
            $attribute_in_array = Utilities::HashTableToSingleDimensionArray($attribute_in_hash,$param);
            return $attribute_in_array["$param"];
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	
	 static function CreateUserObjectAsStudent($user_id,$name,$mobile,$gender,$work){
        try{
            
                      
            $datetime = Utilities::GetCurrentDateTimeMySQLFormat();
            
            $objUser = new Student();
            $objUser->UserId = $user_id;
            $objUser->Name = $name;
            $objUser->MobileNo = $mobile;
			$objUser->Gender = $gender;
			$objUser->WorkHistory = $work;
           
            return $objUser;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function GetAttributeTypeStringFromIdString($table,$param,$id_string){
        try{
            $id_array = explode(",",$id_string);
            $condition = "ID = ".$id_array[0];
            for($i=1;$i<sizeof($id_array);$i++){
                $condition = $condition." OR ID = ".$id_array[$i];
            }                            
            $hashAttribute = MySQLDataAdapter::Read($table, $param, $condition);
            $arrayAttribute = Utilities::HashTableToArray($hashAttribute, $param);           
            $string = $arrayAttribute[0][$param];
            for($i=1;$i<sizeof($arrayAttribute);$i++){
                $string = $string.", ".$arrayAttribute[$i][$param];
            }
            return $string;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
 
    }
    
        
    static function UserExists($email){
        try{
            if(MySQLDataAdapter::Read('useraccount', 'Email', "Email = '$email'")){
                return 1;
            }
            return 0;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	
        static function HashTableToArrayWithoutParamString($hash_table){
        
        try{
            
            $array = array();   
            $count=0;
            while($each_row = mysql_fetch_array($hash_table)){
                foreach($each_row as $param => $param_value){
                    if(is_string($param))
                        $array[$count][$param] = $param_value;                                    
                }
                $count++;            
            }
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $array;
    } 
    
    static function GenerateRandomString($length){
        try{
            $characters = ’abcdefghijklmnopqrstuvwxyz1234567890’;
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(3, 37)];
            }
            return $randomString;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function SendEmailForAccountActivation($email,$activationString){
        try{
            $subject = "Your activation code for letsintern.com";            
            $text = "Please click on the following link to activate your account http://118.139.171.92/letsdev01/LI.Web/ActivateAccount?ac=$activationString";
            mail($email,$subject,$text);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	 static function GetUserDataofUser($id){
        
        try{
            $hash_table_id = MySQLDataAdapter::Read("useraccount", "UserTypeId", "ID = '$id'");
            $array_id = Utilities::HashTableToArray($hash_table_id, "UserTypeId");
            return (int)$array_id[0]["UserTypeId"];
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
       

    }
		static function GetEmployerData($id){
        
        try{
            $hash_table_id = MySQLDataAdapter::Read("employer",'ID',"UserId ='$id'");
            $array_id = Utilities::HashTableToArray($hash_table_id, "ID");
			//print_r($array_id);
            return (int)$array_id[0]["ID"];
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
       

    }
	static function GetStudentData($id){
        
        try{
            $hash_table_id = MySQLDataAdapter::Read("student",'UserId',"student_id= '$id'");
            $array_id = Utilities::HashTableToArray($hash_table_id, "UserId");
			//print_r($array_id);
            return (int)$array_id[0]["ID"];
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
       

    }
	static function RegisterSession($obj)
	{
		 
		    //Check for registered user of letsintern::returns 1 if existing 
		    $UserId=Utilities::GetUserIdOfNewUser($obj->Email);
			//echo $UserId;
			if($UserId!="")
		    {
			    $UserTypeId=Utilities::GetUserDataofUser($UserId);
				//echo $UserTypeId;
			 	if($UserTypeId=="2")                                       // this finds out EMPLOYER ID
				{
					$User_id=Utilities::GetEmployerData($UserId);
			    }
				else if($UserTypeId=="1") 								   // this finds out Student ID
				{
					$User_id=Utilities::GetStudentData($UserId);
			    }
			   //echo $User_id;
			   session_start();
			   $str=$obj->Email.",".$User_id.",".$UserTypeId.",".$UserId;
			   $session_array=explode(",",$str);
			   $_SESSION['letssession']=$session_array;
		       
		    }
	}
        
        static function GetEntityAttributesWithClassNamePreceeding($class_name){
        try{
            $entityClassAttributes = Utilities::GetEntityClassAttributes($class_name);
            $class_name = strtolower($class_name);
            for($i=0;$i<sizeof($entityClassAttributes);$i++)
                $entityClassAttributes[$i] = $class_name.".".$entityClassAttributes[$i];
            return implode(",",$entityClassAttributes);
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function ArrayToObjectWithOtherParametersInArray($array,$obj){
        //Converts $obj into an $array
        try{
            $entityClassAttributes = Utilities::GetEntityClassAttributes(get_class($obj));
            
            for($i=0;$i<sizeof($entityClassAttributes);$i++)
                $obj->$entityClassAttributes[$i] = $array[$entityClassAttributes[$i]];                                    
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $obj;
    }
    
    static function GetAttributeTypeArrayIndexedByIdFromIdString($table,$param,$id_array){
        try{
            $condition = "ID = ".$id_array[0];
            for($i=1;$i<sizeof($id_array);$i++){
                $condition = $condition." OR ID = ".$id_array[$i];
            }                            
            $hashAttribute = MySQLDataAdapter::Read($table, $param, $condition);
            $arrayAttribute = Utilities::HashTableToArray($hashAttribute, $param);            
            $attributeArrayIndexedById[$id_array[0]] = $arrayAttribute[0][$param];
            for($i=1;$i<sizeof($arrayAttribute);$i++){
                $attributeArrayIndexedById[$id_array[$i]] = $arrayAttribute[$i][$param];
            }
            return $attributeArrayIndexedById;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function MapAttributesToIdReturnAttributeString($attributeArray,$idString){
        try{
            $idArray = explode(",",$idString);
            $attributeString = $attributeArray[$idArray[0]];
            for($i=1;$i<sizeof($idArray);$i++){
                $attributeString = $attributeString.", ".$attributeArray[$idArray[$i]];
            }
            return $attributeString;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function GetEmployerBusinessCard($objEmployer){ //this object must contain AttributeStrings in IdString properties for eg. locationString in LocationIdString property
        try{
            $businessCard = "<div class = EmployerBusinessCard> <div class = EmployerLogo> <img src = 'images/$objEmployer->Logo' height = '100px' width='150px'/></div>";
            $businessCard  = $businessCard."<div class = EmployerDetails><strong>".$objEmployer->CompanyName."</strong><br/>".$objEmployer->Description."<br/>";
            $businessCard  = $businessCard."Located In : ".$objEmployer->LocationIdString."<br/>Domain : ".$objEmployer->IndustryID."<br/>Website : <a href = '".$objEmployer->Website."'>".$objEmployer->Website."</a>";
            $businessCard  = $businessCard."</div></div>";
            return $businessCard;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
    static function GetJobCard($objJobCard){
        try{
                $jobCard = "<br/><br/>";
                $jobCard = $jobCard."<div class = JobCard><div class = EmployerLogo><img src = 'images/$objJobCard->Logo' height = '75px' width='100px'/></div>";
                $jobCard = $jobCard."<br/><div class = JobDetails><strong>".$objJobCard->CompanyName."</strong><br/>";
                $jobCard = $jobCard."Internship in <strong>".$objJobCard->FunctionString."</strong><br/>";
                $jobCard = $jobCard.$objJobCard->LocationString."</div>";
                $jobCard = $jobCard."<div class = Compensation><strong>".$objJobCard->CompensationType."</strong>: INR ".$objJobCard->Amount;
                $jobCard = $jobCard." | <strong>Job Prospect : </strong> ";
                if($objJobCard->JobProspect == 1)
                    $jobCard = $jobCard."yes";
                else
                    $jobCard = $jobCard."no";
                $jobCard = $jobCard."</div><div class = ApplyButton><a href = #?jobId=$objJobCard->ID>View Details and Apply</a></div></div>"; 
                
                return $jobCard;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    
     static function HashTableToArrayOfObjects($hash_table,$param_array,$className){ 

        try{
            $objArray = array();
            $count=0;
            while($row = mysql_fetch_object($hash_table)){
				
                $obj = new $className;
                for($i=0;$i<sizeof($param_array);$i++){
                    $obj->$param_array[$i] = $row->$param_array[$i];
                }

                $objArray[$count++] = $obj;                 

                }

            return $objArray;
            
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
    function GetJobCardObjectWithIdStringsReplacedByAttributes($objJobCardArray){
        try{
                $locationIdArray = array();
                $functionIdArray=array();            
                $academicRequirementIdArray = array();            
                $skillIdArray = array();
                foreach($objJobCardArray as $tempJobCard){
                $tempLocationIdArray = explode(",",$tempJobCard->LocationIdString);
                for($i=0;$i<sizeof($tempLocationIdArray);$i++){
                    if (!in_array($tempLocationIdArray[$i], $locationIdArray)){
                        array_push($locationIdArray, $tempLocationIdArray[$i]);
                    }
                }
                
                $tempAcademicRequirementIdArray = explode(",",$tempJobCard->AcademicRequirement);
                for($i=0;$i<sizeof($tempAcademicRequirementIdArray);$i++){
                    if (!in_array($tempAcademicRequirementIdArray[$i], $academicRequirementIdArray)){
                        array_push($academicRequirementIdArray, $tempAcademicRequirementIdArray[$i]);
                    }
                }
                $tempSkillIdArray = explode(",",$tempJobCard->RequiredSkillIdString);
                for($i=0;$i<sizeof($tempSkillIdArray);$i++){
                    if (!in_array($tempSkillIdArray[$i], $skillIdArray)){
                        array_push($skillIdArray, $tempSkillIdArray[$i]);
                    }
                }

            }
                $locationAttributeArray = Utilities::GetAttributeTypeArrayIndexedByIdFromIdString('location', 'CityName', $locationIdArray);
                
                $skillAttributeArray = Utilities::GetAttributeTypeArrayIndexedByIdFromIdString('skills', 'SkillName', $skillIdArray);
                $academicRequirementAttributeArray = Utilities::GetAttributeTypeArrayIndexedByIdFromIdString('academicrequirement', 'AcademicRequirement', $academicRequirementIdArray);
                foreach($objJobCardArray as $tempJobCard){
                    $tempJobCard->LocationString = Utilities::MapAttributesToIdReturnAttributeString($locationAttributeArray, $tempJobCard->LocationIdString);
                
                    $tempJobCard->SkillString = Utilities::MapAttributesToIdReturnAttributeString($skillAttributeArray, $tempJobCard->RequiredSkillIdString);
                    $tempJobCard->AcademicRequirementString = Utilities::MapAttributesToIdReturnAttributeString($academicRequirementAttributeArray, $tempJobCard->AcademicRequirement);
                }
                return $objJobCardArray;
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
    }
	 static function GetHTMLJavascriptMultipleListFromList($list,$name_of_select){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
            $string="<select multiple = \"multiple\" onChange='disp_text()' name=".$name_of_select.">";
            foreach($list as $id => $param_value)
            {
                $substring = "<option value =".$id.">".$param_value."</option>";
                $string = $string.$substring;
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
	 static function FBUserExists($id){
        try{
				$query="SELECT Email FROM student where UserId='$id'";
				//echo $query;
                $getlist= MySQLDataAdapter::Query($query);
				$row = mysql_fetch_array($getlist);
				$count = mysql_num_rows($getlist);
				//echo $count;
				return $count;
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
    }
	
	static function GetHTMLDropdownWithSelected($list,$name_of_select,$selectedId){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
            $string="<select name =".$name_of_select." required=\"required\" >";
            foreach($list as $id => $param_value)
            {
            	if($id == $selectedId){
            		$substring = "<option selected='true' value =".$id.">".$param_value."</option>";
                	$string = $string.$substring;	
            	}
				else{
				$substring = "<option value =".$id.">".$param_value."</option>";
                $string = $string.$substring;	
				}                
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
	static function GetHTMLMultipleListWithSelected($list,$name_of_select,$selectedIdString){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
        	$selectedIdArray = explode(',', $selectedIdString); 
            $string="<select multiple = \"multiple\" name =".$name_of_select."[] required=\"required\">";
            foreach($list as $id => $param_value)
            {
            	if(in_array($id, $selectedIdArray)){
            		$substring = "<option selected='true' value =".$id.">".$param_value."</option>";
                	$string = $string.$substring;	
            	}
				else{
					$substring = "<option value =".$id.">".$param_value."</option>";
                	$string = $string.$substring;
				}
                
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
	
	/*Added By Nits on 3rd September*/
	static function GetGlobalvars(){
       try{
				$query="SELECT APIKey,SecretKey,LetsKey FROM global_vars where ID='1'";
                $getlist= MySQLDataAdapter::Query($query);
				$row = mysql_fetch_array($getlist);
				return $row;
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
        
    }
	static function GetStudentJobStatus($obj){
       try{
				$JobId=$obj->JobId;
				$StudentId=$obj->StudentId;
				$query="SELECT AppliedOn FROM application where JobId='".$JobId."' AND StudentId='".$StudentId."'";
                $getlist= MySQLDataAdapter::Query($query);
				$row = mysql_fetch_row($getlist);
				$count = mysql_num_rows($getlist);
				$searchstring=$count.":".$row[0];
				//echo $searchstring;
				return $searchstring;
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
        
    }
	static function GetAppliedStudentDetailsByStudentId($StudentId){
	
		$app_query="SELECT employer.CompanyName,job.title,application.ApplicationStatus,application.AppliedOn from application
					INNER JOIN job
					ON job.ID=application.JobId
					INNER JOIN employer
					On employer.ID=job.EmployerId
					WHERE application.StudentId='".$StudentId."'";
					//echo $app_query;
					$result=mysql_query($app_query);
					$row = mysql_fetch_array($result);
					//print_r($row);
					return $row;
    }
	static function GetHTMLDropdownStudentStatus($list,$name_of_select,$selectedId){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
            $string="<select name =".$name_of_select." id=".$name_of_select." required=\"required\" onchange='SetStatus(this.value)' >";
            foreach($list as $id => $param_value)
            {
            	if($id == $selectedId){
            		$substring = "<option selected='true' value =".$id.">".$param_value."</option>";
                	$string = $string.$substring;	
            	}
				else{
				$substring = "<option value =".$id.">".$param_value."</option>";
                $string = $string.$substring;	
				}                
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
	static function GetStudentStatus($obj){
       try{
				
				$StudentId=$obj->UserId;
				$query="SELECT status FROM student where UserId='".$StudentId."'";
				//echo $query;
                $getlist= MySQLDataAdapter::Query($query);
				$row = mysql_fetch_row($getlist);
				//echo $searchstring;
				return $row[0];
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
        
    }
	static function GetStudentCard($obj){
       try{
				
				$StudentId=$obj->UserId;
				$query="SELECT location.CityName,college.CollegeName,student.* FROM student 
						INNER JOIN college
						ON college.ID=student.CollegeId
						INNER JOIN location ON
						location.ID=student.LocationId
						where student.UserId='".$StudentId."'";
                $getlist= MySQLDataAdapter::Query($query);
				$row = mysql_fetch_array($getlist);
				
				//echo $query;
				$design= "<table>
							<tr>
							<td><img src='http://graph.facebook.com/".$StudentId."/picture?type=large'  height='130' width='140' border='0'/>
							</td>
							<td>
							<table>
							<tr>
							<td style='padding-left:10px;'>&nbsp;<h4>".$row["Name"]." | ".$row[0]."</h4></td>
							</tr>
							
							<tr>
							<td style='padding-left:10px;'><h5>".$row["MobileNo"]." | ".$row["Email"]."</h3></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td style='padding-left:10px;'><h5>".$row['ProfileTitle']."</h3></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td style='padding-left:10px;'><h5>Current  ".$row[1]."</h5></td>
							</tr>
							<tr>
							<td style='padding-left:10px;'><h5>Work  ".$row["WorkHistory"]."</h5></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
						</table>
						
						</tr>
						
				</table>";
						
				//echo $searchstring;
				return $design;
			}
			catch(Exception $ex){
				throw $ex->getMessage();
			}
        
    }
	static function GetAjaxHTMLDropdownFromList($list,$name_of_select,$function){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        
        try{
            $string="<select name =".$name_of_select." required=\"required\" onchange=".$function."><option></option>";
            foreach($list as $id => $param_value)
            {
                $substring = "<option value =".$id.">".$param_value."</option>";
                $string = $string.$substring;
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
	static function GetHTMLDropdownFromListwithCondition($name_of_select,$condition){
        //$list contains the list of elements pointed by their ID.
        //It will convert that array into an HTML DropDown List.
        $query="SELECT ID,CollegeName,CollegeType from college WHERE LocationID=$condition";
        $getlist= MySQLDataAdapter::Query($query);
		
        try{
            $string="<select name =".$name_of_select." required=\"required\" ><option></option>";
            while($row = mysql_fetch_array($getlist))
            {
                $substring = "<option value =".$row[0].">".$row[1]."</option>";
                $string = $string.$substring;
            }
            $string = $string."</select>";
        }
        catch(Exception $ex){
            throw $ex->getMessage();
        }
        return $string;
    }
}


?>
