<?php
//author letstech01

include("../Utilities/Utilities.php");
include("../LI.Entities/Job.php");
include '../LI.BusinessManagement/JobTemplateManagement.php';
include '../LI.Entities/iJobTemplate.php';
include '../LI.BusinessManagement/JobManagement.php';

session_start();
	
?>
<html>
<head>    
  
  
  
  <link href="css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  <link href="css/default.css" rel="stylesheet" id="theme-specific-script">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <link href="css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
 
    <script src="scripts/jquery-1.5.1.js"></script>
        <script src="scripts/jquery.ui.core.js"></script>
        <script src="scripts/jquery.ui.widget.js"></script>
        <script src="scripts/jquery.ui.datepicker.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <!link rel="stylesheet" type="text/css" href="css/demos.css">
                
        <script type="text/javascript">                                         
          
               
                $(function() {
                $("#datepicker1").datepicker({showOn: 'both'});
                $("#datepicker2").datepicker({showOn: 'both'});
                $("#datepicker3").datepicker({showOn: 'both'});
                });
             
        </script>
        <style type="text/css">

            .test {
                font-family: cursive;
                font-size: 20px;
            }     

        </style>
        <!-- Validation scripts-->
  <script src="scripts/bootstrap.validate.js"></script>
  <!-- cascaded drop down-->
  <script>
			$(document).ready(function() {
				$("#jobCategory").change(function() {
					
					$('#jobSubCategory').find('option').remove().end();					
					var jobCategoryId = $(this).find("option:selected").val();
					
					//do the ajax call
					$.ajax({
						url : 'GetJobSubCategory.php',
						type : 'GET',
						data : {
							jobCategoryId:jobCategoryId
						},
						dataType : 'json',

						success : function(data) {
																					
							var ddl = document.getElementById('jobSubCategory');

							for(var c=2;c<data.length;c+=2)
							{
							var option = document.createElement('option');
							option.value = data[c]['ID'];
							option.text = data[c+1]['SubCategoryName'];
							ddl.appendChild(option);
							}

						},
						error : function(jxhr) {
							alert("Having Database Issues, please try again later. Sorry for the inconvinience");

						}
					});

				});

			});
		</script>  

</head>

<body>
	<!--navbar-->
			<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">LetsIntern</a>
      
    </div>
  </div>
  </div><br/>
  <?
  	
		$templateId = $_GET["templateId"];
		$employerId=11;
		$objJobTemplateManagement = new JobTemplateManagement();
		$objJobTemplate = $objJobTemplateManagement->GetDetailsToPrefillform($templateId, $employerId);
		$objJobManagement = new JobManagement();
			//var_dump($objJobTemplate);
			
	//$objJobTemplate = new iJobTemplateCard();
		
  ?>
  
    <h1 class="offset6">Post New Job</h1>
  <form class="form-horizontal" id="jobPostingForm" method="post">
		<div class = "container-fluid well" >
			<div class="row-fluid">
    			<div class="span4">     
                      
                      <div class="control-group">
                          
                          <div class="controls">Job Type
                              <?php
                              $list = Utilities::GetListFromTableByParameter("jobtype", "Type");
                              echo Utilities::GetHTMLDropdownWithSelected($list,"JobTypeId",$objJobTemplate->JobTypeId);
                              ?>
                          </div>
                      </div>                      
                      <div class="control-group">
                                                    
                          <div class="controls">Job Title
                              <input type="text" name="Title" required="required" id="inputTitle" required="required" data-minlength="5" maxlength="100"  value=<? echo "'".$objJobTemplate->Title."'"; ?>  />
                          </div>
                      </div>
                      <div class="control-group">
                          
                          <div class="controls">Job Description
                              <textarea rows="5" id="description" required="required" name="Description" required="required"><? echo $objJobTemplate->Description ?></textarea>
                          </div>
                      </div>
                      <div class="control-group">
                          
                          <div class="controls">Location
                              <?php
                              $list = Utilities::GetListFromTableByParameter("location", "CityName");
                              echo Utilities::GetHTMLMultipleListWithSelected($list,"LocationName",$objJobTemplate->LocationIdString);
                              ?>
                          </div>
                      </div>                      
                      <div class="control-group">
                          
                          <div class="controls">Starts<br/>
                              <input type="text" id="datepicker1" name="StartDate" required="required">
                          </div>                          
                      </div>
                                     
                      <div class="control-group">
                          
                          <div class="controls">Ends<br/>
                              <input type="text" id="datepicker2" name="EndDate" required="required">
                          </div>                          
                      </div>
                      <div class="control-group">
                          <label class="checkbox inline">
                              <div class="controls">
                              	
                                <input type ="checkbox" name="IsPeriodFlexible" > Period is flexible(<i class="icon-ok"></i>)
                              </div>
                          </label>
                      </div>
               </div>
            
               <div class = "span8">
				<div class="row-fluid span4">   
                
                     <div class="control-group">
                          <label class="control-label" >Job Category</label>
                          <div class="controls">
                              <?php
            	                  
            						$list=$objJobManagement->GetListFromTableByParameter('jobcategory','CategoryName');									
									$string="<select id='jobCategory' name ='CategoryId' required=\"required\" ><option></option>";
            						foreach($list as $id => $param_value)
						            {
						            	if($objJobTemplate->CategoryId == $id){
						            		$substring = "<option selected='true' value =".$id.">".$param_value."</option>";
                							$string = $string.$substring;	
						            	}
										else{
											$substring = "<option value =".$id.">".$param_value."</option>";
                							$string = $string.$substring;
										}
            						}
            						$string = $string."</select>";
									echo $string;
                              ?>
                          </div>
                      </div>
                      <div class="control-group">
                          <label class="control-label" >Job Sub Category</label>
                          <div class="controls">
                              <select id="jobSubCategory" name="SubCategoryId" required="required">
                              	<?
                              		$list1 = $objJobManagement->GetJobSubCategoryListByCategoryId($objJobTemplate->CategoryId);
									$string="";
            						foreach($list1 as $id1 => $param_value1)
						            {
						            	if($objJobTemplate->SubCategoryId == $id1){
						            		$substring1 = "<option selected='true' value =".$id1.">".$param_value1."</option>";
                							$string = $string.$substring1;	
						            	}
										else{
											$substring1 = "<option value =".$id1.">".$param_value1."</option>";
                							$string = $string.$substring1;
										}
            						}
            						$string = $string."</select>";
									echo $string;
                              ?>
                              </select>
                          </div> 
                      <div class="control-group">
                          
                          <div class="controls">Required Skill Set
                              <?php
                              $list = Utilities::GetListFromTableByParameter("skills", "SkillName");
                              echo Utilities::GetHTMLMultipleListWithSelected($list,"Skill",$objJobTemplate->RequiredSkillIdString);
                              ?>
                          </div>
                      </div> 
                      <div class="control-group">
                          
                          <div class="controls">Academic Requirement
                              <?php
                              $list = Utilities::GetListFromTableByParameter("academicrequirement", "AcademicRequirement");
                              echo Utilities::GetHTMLMultipleListWithSelected($list,"AcademicRequirement",$tempJobCard['AcademicRequirement']);
                              ?>
                          </div>
                      </div> 
                 </div>
              <div class = "span8" >              
              
                      <div class="control-group">
                          
                          <div class="controls">Compensation Type<br/>
                              <?php
                              $list = Utilities::GetListFromTableByParameter("compensation", "CompensationType");
                              echo Utilities::GetHTMLDropdownWithSelected($list,"Compensation",$tempJobCard['CompensationTypeId']);
                              ?>
                          </div>
                      </div> 
                      <div class="control-group">
                          
                          <div class="controls">Renumeration<br/>
                              <input type="text" name="Amount" required="required" pattern="^[0-9]+" id="inputAmount" required="required" />
                          </div>
                      </div>
                      <div class="control-group">
                          <label class="checkbox inline">
                              <div class="controls">
                                <input type ="checkbox" name="JobProspect" > Converts to full time Job(<i class="icon-ok"></i>)
                              </div>
                          </label>
                      </div>
                      <div class="control-group">
                          
                          <div class="controls">Number of Positions<br/>
                              <input type="text" required="required" pattern="^[0-9]+"  name="NoOfPositions" id="NoOfPositions" required="required" />
                          </div>
                      </div>
                      <div class="control-group">
                          
                          <div class="controls">Application Deadline<br/>
                              <input type="text" id="datepicker3" name="ApplicationDeadline" required="required">
                          </div>                          
                      </div>
                      <div class="control-group">
                          <div class="controls">
								                                
                                <input type="hidden" name="ScreeningTestId" value="999">
                                <button type="submit" class="btn btn-success">Done</button>
                          </div>
                      </div>
               </div>
          </div>
      </div>
	</div>                                          
  </form>
    <!-- php script -->
    <?php
        
        
        if(isset($_POST["Title"]))
        {
            try 
                {   
                    $objJob= new Job();
                    
                    $objJob->EmployerId=$employerId;  //will be getting in session handling
                    $objJob->CreatedOn=Utilities::GetCurrentDateTimeMySQLFormat();
                    $objJob->UpdatedOn=Utilities::GetCurrentDateTimeMySQLFormat();
                    //get title
                    $objJob->ID = $jobId;
                    $objJob->Title=$_POST["Title"];
                    
                    //get jobid
                    $objJob->JobTypeId=$_POST["JobTypeId"];
                    
                    //get description
                    $objJob->Description=$_POST["Description"];
                    
                    //getting locationIDString

                    $LocationIdArray=array();
                    foreach ($_POST["LocationName"] as $CityName)
                        array_push($LocationIdArray,$CityName); 

                    $LocationIdString=implode(",", $LocationIdArray);
                    $objJob->LocationIdString=$LocationIdString;
                    
                    //get job prospect
                    if($_POST["JobProspect"]=="on")      
                        $objJob->JobProspect=1;
                    else
                        $objJob->JobProspect=0;
                    
                    
                    
                    $objJob->FunctionIdString=1;
                    
                    //getdate correct format for dates
                    if($tempJobCard['StartDate'] == $_POST['StartDate'])
                    	$startdate=(string)$_POST["StartDate"];
					else{
						$currentstartdate=(string)$_POST["StartDate"];
                    	$startdate=Utilities::JqueryDateFormatToMySQLDateFormat($currentstartdate);
					}
					if($tempJobCard['EndDate'] == $_POST['EndDate'])
                    	$enddate=(string)$_POST["EndDate"];
					else{
						$currentenddate=(string)$_POST["EndDate"];
                    	$enddate=Utilities::JqueryDateFormatToMySQLDateFormat($currentenddate);
					}
                    
                    
                    $objJob->StartDate=$startdate;
                    $objJob->EndDate= $enddate;
					
					if($tempJobCard['ApplicationDeadline'] == $_POST['ApplicationDeadline'])
                    	$objJob->ApplicationDeadline=(string)$_POST["ApplicationDeadline"];
					else{
						$currentdeadlinedate=(string)$_POST["ApplicationDeadline"];
                    	$deadlinedate=Utilities::JqueryDateFormatToMySQLDateFormat($currentdeadlinedate);
                    	$objJob->ApplicationDeadline= $deadlinedate;						
					}
                    
                    

                    //is period flexible
                    if($_POST["IsPeriodFlexible"])      
                        $objJob->IsPeriodFlexible=1;
                    else
                        $objJob->IsPeriodFlexible=0;

                    //no of openings
                    $objJob->NoOfPositions=$_POST["NoOfPositions"];

                    //get required skills
                    $requiredSkillIdArray=array();
                    foreach ($_POST["Skill"] as $SkillName)
                        array_push($requiredSkillIdArray,$SkillName); 

                    $RequiredSkillIdString=implode(",", $requiredSkillIdArray);
                    $objJob->RequiredSkillIdString=$RequiredSkillIdString;
                    
                    //get compensation id
                    $objJob->CompensationTypeId=$_POST["Compensation"];

                    //get amount
                    $objJob->Amount=$_POST["Amount"];

                    //AcademicRequirement
                    $AcademicRequirementIdString=implode(",", $_POST["AcademicRequirement"]);
                    $objJob->AcademicRequirement=$AcademicRequirementIdString;

                    //is featured
                    $objJob->IsFeatured=$_POST["IsFeatured"];

                    //get ScreeningTestId
                    $objJob->ScreeningTestId=$_POST["ScreeningTestId"];
					$objJob->UpdatedBy=$_SESSION['letssession'][2];
					$objJob->CreatedBy=$tempJobCard['CreatedBy'];
					$objJob->Deleted=0;
					$objJob->Status=$tempJobCard['Status'];
					$objJob->IsFeatured=0;
					$objJob->IsLiRecommended=0;
					$objJob->CategoryId = $_POST['CategoryId'];
					$objJob->SubCategoryId = $_POST['SubCategoryId'];
					$objJob->Status = "created";
                    //insert
                    $objJobManagement->InsertJob($objJob); 
                }
                catch(Exception $ex){
                    echo $ex->getMessage();
                    die;        
                }
        }
        ?>


</body>
	<!-- javascript Templates
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Google API -->
    <script type="text/javascript" src="scripts/jsapi"></script>
     
    <!-- jQuery -->
    <script src="scripts/jquery.min.js"></script>
    
    <!-- Data Tables -->
    <script src="scripts/jquery.dataTables.js"></script>
    
    <!-- jQuery UI Sortable -->
    <script src="scripts/jquery.ui.core.min.js"></script>
	<script src="scripts/jquery.ui.widget.min.js"></script>
	<script src="scripts/jquery.ui.mouse.min.js"></script>
	<script src="scripts/jquery.ui.sortable.min.js"></script>
    <script src="scripts/jquery.ui.widget.min.js"></script>
    
    <!-- jQuery UI Draggable & droppable -->
    <script src="scripts/jquery.ui.draggable.min.js"></script>
    <script src="scripts/jquery.ui.droppable.min.js"></script>

    <!-- Bootstrap -->
    <script src="scripts/bootsbox.min.js"></script>
    

	<!-- Bootstrap Date Picker -->
    <script src="scripts/bootstrap-datepicker.js"></script>
    <script src="scripts/bootstrap.min.carousel.extension.js"></script>

		
    <!-- jQuery Cookie -->    
    <script src="scripts/jquery.cookie.js"></script>
    
    <!-- Full Calender -->
    <script type="text/javascript" src="scripts/fullcalendar.min.js"></script>
    
    <!-- CK Editor -->
	<script type="text/javascript" src="scripts/ckeditor.js"></script>
	<script type="text/javascript" src="scripts/jquery.js"></script>
    
    <!-- Chosen multiselect -->
    <script type="text/javascript" language="javascript" src="scripts/chosen.jquery.min.js"></script>  
    
    <!-- Uniform -->
    <script type="text/javascript" language="javascript" src="scripts/jquery.uniform.min.js"></script>
    
    <!-- MultiFile Upload -->
    <!-- Error messages for the upload/download templates -->
	<script>
    var fileUploadErrors = {
        maxFileSize: 'File is too big',
        minFileSize: 'File is too small',
        acceptFileTypes: 'Filetype not allowed',
        maxNumberOfFiles: 'Max number of files exceeded',
        uploadedBytes: 'Uploaded bytes exceed file size',
        emptyResult: 'Empty file upload result'
    };
    </script>
    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/html">
    {% for (var i=0, files=o.files, l=files.length, file=files[0]; i<l; file=files[++i]) { %}
        <tr class="template-upload fade">
            <td class="preview"><span class="fade"></span></td>
            <td class="name">{%=file.name%}</td>
            <td class="size">{%=o.formatFileSize(file.size)%}</td>
            {% if (file.error) { %}
                <td class="error" colspan="2"><span class="label label-important">Error</span> {%=fileUploadErrors[file.error] || file.error%}</td>
            {% } else if (o.files.valid && !i) { %}
                <td>
                    <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
                </td>
                <td class="start">{% if (!o.options.autoUpload) { %}
                    <button class="btn btn-primary">
                        <i class="icon-upload icon-white"></i> Start
                    </button>
                {% } %}</td>
            {% } else { %}
                <td colspan="2"></td>
            {% } %}
            <td class="cancel">{% if (!i) { %}
                <button class="btn btn-warning">
                    <i class="icon-ban-circle icon-white"></i> Cancel
                </button>
            {% } %}</td>
        </tr>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/html">
    {% for (var i=0, files=o.files, l=files.length, file=files[0]; i<l; file=files[++i]) { %}
        <tr class="template-download fade">
            {% if (file.error) { %}
                <td></td>
                <td class="name">{%=file.name%}</td>
                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                <td class="error" colspan="2"><span class="label label-important">Error</span> {%=fileUploadErrors[file.error] || file.error%}</td>
            {% } else { %}
                <td class="preview">{% if (file.thumbnail_url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery"><img src="{%=file.thumbnail_url%}"></a>
                {% } %}</td>
                <td class="name">
                    <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}">{%=file.name%}</a>
                </td>
                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                <td colspan="2"></td>
            {% } %}
            <td class="delete">
                <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                    <i class="icon-trash icon-white"></i> Delete
                </button>
                <input type="checkbox" name="delete" value="1">
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="scripts/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="scripts/load-image.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="scripts/canvas-to-blob.min.js"></script>
    <script src="scripts/bootstrap-image-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="scripts/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
	<script src="scripts/jquery.fileupload.js"></script>
    <!-- The File Upload image processing plugin -->
    <script src="scripts/jquery.fileupload-ip.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="scripts/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="scripts/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
    <!--[if gte IE 8]><script src="scripts/blueimp-jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->
    
    <!-- Simplenso scripts -->
    <script src="scripts/simplenso.js"></script><script src="scripts/saved_resource" type="text/javascript"></script><script src="scripts/format+en,default,geochart.I.js" type="text/javascript"></script><script src="scripts/saved_resource(1)" type="text/javascript"></script><script src="scripts/corechart.js" type="text/javascript"></script><script src="scripts/saved_resource(2)" type="text/javascript"></script><script src="scripts/gauge.js" type="text/javascript"></script>
  
<div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">FireFox</div><div style="position: absolute; display: none; "><div style="background-color: infobackground; padding: 1px; border: 1px solid infotext; font-size: 10px; margin: 10px; font-family: Arial; background-position: initial initial; background-repeat: initial initial; ">Unique</div></div><div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">Un...</div></body><span id="skype_highlighting_settings" display="none" autoextractnumbers="1"></span><object id="skype_plugin_object" location.href="http://wbpreview.com/previews/WB00958H8/index.html" location.hostname="wbpreview.com" style="position: absolute; visibility: hidden; left: -100px; top: -100px; " width="0" height="0" type="application/x-vnd.skype.click2call.chrome.5.7.0"></object></html>
</html>