<?
//author letstech01

class JobTemplateManagementDataAccess {
	function GetJobTemplateDetailsBySubCategoryIdAndJobTypeId($subCategoryId, $jobTypeId) {
		try {
			
			$entityClassAttributes = Utilities::GetEntityAttributesWithClassNamePreceeding('iJobTemplate');		
			
			$query = "select $entityClassAttributes,jobsubcategory.SubCategoryName,jobtype.Type,compensation.CompensationType
						from ijobtemplate,jobsubcategory,jobtype,compensation
						where ijobtemplate.SubCategoryId = $subCategoryId
						AND ijobtemplate.JobTypeId = $jobTypeId
						AND jobsubcategory.ID = ijobtemplate.SubCategoryId
						AND jobtype.ID = ijobtemplate.JobTypeId
						AND compensation.ID = ijobtemplate.CompensationTypeId
						AND ijobtemplate.Deleted=0
						AND jobsubcategory.Deleted=0
						AND jobtype.Deleted=0
						AND compensation.Deleted=0";
			return MySQLDataAdapter::Query($query);

		} catch(Exception $ex) {
			throw $ex -> getMessage();
		}
	}
	
	function GetJobTemplateByTemplateId($templateId){
		try{
			return MySQLDataAdapter::Read('ijobtemplate', '*', 'ID='.$templateId);
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}

	function GetDetailsToPrefillform($templateId,$employerId){
		try{
			$query = "select ijobtemplate.*,jobsubcategory.CategoryId,employer.LocationIdString
						from ijobtemplate,jobsubcategory,employer
						where ijobtemplate.ID =".$templateId."
						AND ijobtemplate.SubCategoryId = jobsubcategory.ID
						AND employer.ID = ".$employerId."
						AND ijobtemplate.Deleted=0";
			return MySQLDataAdapter::Query($query);			
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
}
?>