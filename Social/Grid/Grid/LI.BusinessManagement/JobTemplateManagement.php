<?
//author letstech01
include '../LI.DataAccessManagement/JobTemplateManagementDataAccess.php';
class JobTemplateManagement {
	
	function GetJobTemplateDetailsBySubCategoryIdAndJobTypeId($subCategoryId, $jobTypeId) {
		try {
				$objJobTemplateManagementDataAccess = new JobTemplateManagementDataAccess();
				$hashJobTemplateCard = $objJobTemplateManagementDataAccess->GetJobTemplateDetailsBySubCategoryIdAndJobTypeId($subCategoryId, $jobTypeId);
				$arrayJobTemplateCard = Utilities::HashTableToArrayWithoutParamString($hashJobTemplateCard);
				$arraySkillId = array();
				foreach($arrayJobTemplateCard as $tempArrayJobTemplateCard){
					$tempArraySkillId = explode(',', $tempArrayJobTemplateCard['RequiredSkillIdString'] );
					for($i=0;$i<sizeof($tempArraySkillId);$i++){
						if(!in_array($tempArraySkillId[$i], $arraySkillId)){
							array_push($arraySkillId,$tempArraySkillId[$i]);
						}
					} 
				}
				$skillAttributeArray = Utilities::GetAttributeTypeArrayIndexedByIdFromIdString('skills', 'SkillName', $arraySkillId);
				for($i=0;$i<sizeof($arrayJobTemplateCard);$i++){
					$arrayJobTemplateCard[$i]['SkillString'] = Utilities::MapAttributesToIdReturnAttributeString($skillAttributeArray, $arrayJobTemplateCard[$i]['RequiredSkillIdString']);
				}
		
				$arrayObjTemplateCard = array();
				foreach($arrayJobTemplateCard as $tempArrayJobTemplateCard){
					$tempObjJobTemplateCard = new iJobTemplateCard();
					$arrayObjTemplateCard[] = Utilities::ArrayToObject($tempArrayJobTemplateCard, $tempObjJobTemplateCard);
				}
				return $arrayObjTemplateCard;

		}
		catch(Exception $ex) {
			throw $ex -> getMessage();
		}
	}

	function GetJobTemplateByTemplateId($templateId){
		try{
			$objJobTemplateManagementdataAccess = new JobTemplateManagementDataAccess();
			$hashJobTemplate = $objJobTemplateManagementdataAccess->GetJobTemplateByTemplateId($templateId);
			$arrayJobTemplate = Utilities::HashTableToArray($hashJobTemplate, Utilities::GetEntityClassAttributesInString('iJobTemplate'));
			return Utilities::ArrayToObject($arrayJobTemplate[0], new iJobTemplate());
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}
	
	function GetDetailsToPrefillform($templateId,$employerId){
		try{
			$objJobTemplateManagementdataAccess = new JobTemplateManagementDataAccess();
			$hashJobTemplate = $objJobTemplateManagementdataAccess->GetDetailsToPrefillform($templateId, $employerId);
			$arrayJobTemplate = Utilities::HashTableToArrayWithoutParamString($hashJobTemplate);
			return Utilities::ArrayToObject($arrayJobTemplate[0], new iJobTemplateCard);			
		}
		catch(Exception $ex){
			throw $ex->getMessage();
		}
	}

}
?>