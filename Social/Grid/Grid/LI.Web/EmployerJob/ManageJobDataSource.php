<?php
//include("Utilities.php");
include("../../LI.Entities/Location.php");
/*
 * ----------------------------------------------------------
 * Filename: PartnersDataSource.php
 * Created by: CreativePath
 * Creation date: May 26, 2012
 * Copyright(c) 2012 Creative Path Group Pty Ltd (Australia)
 * silva.gerry@creativepath.com.au
 * ----------------------------------------------------------
 */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
//$aColumns = array('Title','Description','Type','CompanyName','Status','LocationIdString','JobProspect','Function','StartDate','EndDate','isPeriodFlexible');
//$aColumns1 = array('j.ID','j.Title','j.Description','t.Type','e.CompanyName','j.Status','j.LocationIdString','j.JobProspect','f.Function','j.StartDate','j.EndDate','j.isPeriodFlexible');

$aColumns = array('Title','Description','Type','CompanyName','Status','LocationIdString','JobProspect','FunctionIdString','StartDate','EndDate','isPeriodFlexible','CompensationType','Amount','ApplicationDeadline','NoOfPositions','RequiredSkillIdString','AcademicRequirement','isFeatured','isLIRecommended','TestTitle','CreatedBy','CreatedOn');
$aColumns1 = array('j.ID','j.Title','j.Description','t.Type','e.CompanyName','j.Status','j.LocationIdString','j.JobProspect','j.FunctionIdString','j.StartDate','j.EndDate','j.isPeriodFlexible','c.CompensationType','j.Amount','j.ApplicationDeadline','j.NoOfPositions','j.RequiredSkillIdString','j.AcademicRequirement','j.isFeatured','j.isLIRecommended','st.TestTitle','j.CreatedBy','j.CreatedOn');



/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "ID";
//$sIndexColumn = "e.ID";

/* DB table to use */
$sTable = "job";
$sTable1="job j left join jobtype t on j.JobTypeId=t.ID left join employer e on j.EmployerId=e.ID left join compensation c on j.CompensationTypeId=c.ID left join test st on j.ScreeningTestID=st.ID";
//$sTable = "employer e inner join subscriptiontypes t on e.SubscriptionTypeID = t.Id where e.deleted=0 and t.deleted=0;";
 
/* Database connection information */
$gaSql['user'] = "lidev";
$gaSql['password'] = "Letsintern12";
$gaSql['db'] = "lidev";
$gaSql['server'] = "lidev.db.8927940.hostedresource.com";

/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
//include( $_SERVER['DOCUMENT_ROOT']."/datatables/mysql.php" );


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * MySQL connection
 */
$gaSql['link'] = mysql_pconnect($gaSql['server'], $gaSql['user'], $gaSql['password']) or
        die('Could not open connection to server');

mysql_select_db($gaSql['db'], $gaSql['link']) or
        die('Could not select database ' . $gaSql['db']);

//include("Utilities.php");
/*
 * Paging
 */
$sLimit = "";
if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . mysql_real_escape_string($_POST['iDisplayStart']) . ", " .
            mysql_real_escape_string($_POST['iDisplayLength']);
}


/*
 * Ordering
 */
$sOrder = "";
if (isset($_POST['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
        if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
            $sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
				 	" . mysql_real_escape_string($_POST['sSortDir_' . $i]) . ", ";
        }
    }

    $sOrder = substr_replace($sOrder, "", -2);
    if ($sOrder == "ORDER BY") {
        $sOrder = "";
    }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";
if ($_POST['sSearch'] != "") {
    $sWhere = "WHERE (";
    for ($i = 0; $i < count($aColumns1); $i++) {
        $sWhere .= $aColumns1[$i] . " LIKE '%" . mysql_real_escape_string($_POST['sSearch']) . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
    if ($_POST['bSearchable_' . $i] == "true" && $_POST['sSearch_' . $i] != '') {
        if ($sWhere == "") {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_POST['sSearch_' . $i]) . "%' ";
    }
}


/*
 * SQL queries
 * Get data to display
 */
//$sQuery = "Select SQL_CALC_FOUND_ROWS e.ID,e.CompanyName,e.Email,e.Description,t.SubscriptionType,e.Deleted from employer e left join subscriptiontypes t on e.SubscriptionTypeId=t.ID";
$sQuery="	SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns1)) . "
		FROM   $sTable1
		$sWhere
		$sOrder
		$sLimit
	";
$rResult = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable
	";
$rResultTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
$aResultTotal = mysql_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


$k = intval($_POST['sEcho']);
if ($k == 0) {
    $k++;
};
$output = array(
    "sEcho" => $k,
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

while ($aRow = mysql_fetch_array($rResult)) {
    $row = array();

    // Add the row ID and class to the object
    $row['DT_RowId'] =  $aRow['ID'];
    //$row['DT_RowId'] =  $aRow['ID'];
    //$row['DT_RowClass'] =  $aRow['partnernumber'];
    $row[] = '<a class="edit" href="">Edit</a>';
    $row[] = '<a class="delete" href="">Delete</a>';
    for ($i = 0; $i < count($aColumns); $i++) {
        if ($aColumns[$i] == "version") {
            /* Special output formatting for 'version' column */
            $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
        }
        else if ($aColumns[$i] == 'Deleted') {
            /* General output */
            $row[] = (int)$aRow[$aColumns[$i]];
        }
        else if($aColumns[$i]=="JobProspect")
        {
            if($aRow[$aColumns[$i]]== 1)
            {
                $row[]="Yes";
            }
            else {
                $row[]="No";
            }
        }
        else if($aColumns[$i]=="isPeriodFlexible")
        {
            if($aRow[$aColumns[$i]]== 1)
            {
                $row[]="Yes";
            }
            else {
                $row[]="No";
            }
        }
        else if($aColumns[$i]=="isFeatured")
        {
            if($aRow[$aColumns[$i]]== 1)
            {
                $row[]="Yes";
            }
            else {
                $row[]="No";
            }
        }
        else if($aColumns[$i]=="isLIRecommended")
        {
            if($aRow[$aColumns[$i]]== 1)
            {
                $row[]="Yes";
            }
            else {
                $row[]="No";
            }
        }
        /*else if ($aColumns[$i] == "LocationIDString") {
            
            
            
            $id_string = $aRow[$aColumns[$i]];
            $num=strlen($id_string);
            $j= $num/2;
            $num=$num-$j-1;
            
            $condition = "ID in ( ".$id_string.")";
                 
            $hashAttribute=mysql_query("select CityName from location where $condition"); 
            
            $LocationNameString="";
                 
            
            $result= mysql_fetch_assoc($hashAttribute);
            $LocationNameString = $resut["CityName"];
            for(;$num>0;$num--)
            {   
                    $locationNameString=$locationNameString.",".$result["CityName"];
            } 
            
            $row[]=$locationNameString;
            
        }*/
        else if ($aColumns[$i] != ' ') {
            /* General output */
            $row[] = $aRow[$aColumns[$i]];
        }
    }
    $row[]="";
    
    
    
    $output['aaData'][] = $row;
}

$out = json_encode($output);
echo $out;

?>