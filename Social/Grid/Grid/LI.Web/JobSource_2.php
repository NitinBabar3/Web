<?
include '../LI.BusinessManagement/JobManagement.php';
include '../LI.Entities/JobCard.php';
include '../LI.Entities/Job.php';
include '../Utilities/Utilities.php';



//ordering
if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
            }
        }
         
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }

$sWhere = "";
    if ( $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }


$employerId=11;
$query = "select job.* ,employer.CompanyName,employer.Logo,jobfunctions.Function,jobtype.Type,compensation.CompensationType,
            (select count(*) from application where application.JobId = job.ID) as NoOfApplications,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Applied\") as Applied,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Rejected\") as Rejected,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Pending Screening Test\") as PendingScreeningTest,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Shortlisted\") as Shortlisted,
            (select count(*) from application where application.JobId = job.ID AND application.ApplicationStatus = \"Selected\") as Selected 
            from job,jobfunctions,employer,jobtype,compensation
            where employer.ID = job.EmployerId 
            AND job.JobTypeId = jobfunctions.ID
            AND job.EmployerID =".$employerId."
            AND jobtype.ID = job.JobTypeId
			AND compensation.ID = job.CompensationTypeId
            AND job.Deleted = 0 AND employer.Deleted = 0
            $sorder
            $sWhere";
            
            $hashTableJobDetails = MySQLDataAdapter::Query($query);
			$param_array = Utilities::GetEntityClassAttributes('JobCard');
            $objTempArray = Utilities::HashTableToArrayOfObjects($hashTableJobDetails,$param_array,"JobCard");            
            $objJobCardArray = Utilities::GetJobCardObjectWithIdStringsReplacedByAttributes($objTempArray);

$output = array(	
    "iTotalRecords" => sizeof($objJobCardArray),
    "iTotalDisplayRecords" => sizeof($objJobCardArray),
    "aaData" => array()
);

foreach ($objJobCardArray as $tempJobCard) {
	$row = array();
	$row[] = $tempJobCard->Title;
	$row[] = $tempJobCard->Type;
	$row[] = $tempJobCard->ApplicationDeadline;
	$row[] = $tempJobCard->FunctionString;
	$row[] = $tempJobCard->Status;
	$row[] = $tempJobCard->NoOfApplications;
	$row[] = "<a class = 'btn btn-success' href='#'><i class=\"icon-zoom-in icon-white\"></i>View</a><a class = 'btn btn-primary' href='#'><i class=\"icon-zoom-in icon-white\"></i>Edit</a><a class = 'btn btn-danger' href='#'><i class=\"icon-zoom-in icon-white\"></i>Delete</a>";
	$output["aaData"][] = $row;
}
echo json_encode($output);
          
?>