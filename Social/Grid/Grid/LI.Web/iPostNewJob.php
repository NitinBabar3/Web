<?php
include("../Utilities/Utilities.php");
include("../LI.Entities/Job.php");
include("../LI.BusinessManagement/JobManagement.php");
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
		<!-- Job Sub Category List-->
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
							var option = document.createElement('option');
							option.value = '';
							option.text = '';
							ddl.appendChild(option);
							for(var c=2;c<data.length;c+=2)
							{
							var option = document.createElement('option');
							option.value = data[c]['ID'];
							option.text = data[c+1]['SubCategoryName'];
							ddl.appendChild(option);
							}

						},
						error : function(jxhr) {
							alert(" Please Select an option");

						}
					});

				});
				
				$("#jobType").change(function() {
					
					$('#liTemplates').empty();
					var SubCategoryId = $('#jobSubCategory').find("option:selected").val();
					var JobTypeId = $(this).find("option:selected").val();
					
						/**/
				
					$.ajax({
						url : 'JobTemplateTitleSource.php',
						type : 'GET',
						data : {
							SubCategoryId:SubCategoryId,
							JobTypeId:JobTypeId
						},
						dataType : 'json',

						success : function(data) {
							
							$('#liTemplates').append('Templates Provided by LetsIntern');
							$('#otherTemplates').append('Templates from other such recent job posts by other employers');
							for(var i=0;i<data.length;i++){
								if (data[i]['CreatedBy']==3){
									var divTagId = '#liTemplateDiv'+i;
									var anchorTagId = '#liTemplateAnchor-'+i;
									jQuery('<div/>', {
		    								id: 'liTemplateDiv'+i,
		    								    								
										}).appendTo('#liTemplates');
									jQuery('<a/>', {
    									id: 'liTemplateAnchor-'+i,
    									href: '#',
    									title: 'LI Template',
    									rel: 'external',
    									text: data[i]['Title'],    								
									}).appendTo(divTagId);
									
									$(anchorTagId).hover(function(){
										$('#liTemplatesDetails').empty();
										var thisId = $(this).attr('id');
										thisId = thisId.split("-");															
										fillJobTemplateDetails(data[thisId[1]]);
									});
									
								}
								else{
									var divTagId = '#otherTemplateDiv'+i;
									var anchorTagId = '#otherTemplateAnchor-'+i;
									jQuery('<div/>', {
	    								id: 'otherTemplateDiv'+i,   					    												    							
										}).appendTo('#otherTemplates');
									jQuery('<a/>', {
	    								id: 'otherTemplateAnchor-'+i,
    									href: '#',
    									title: 'LI Template',
    									rel: 'external',
    									text: data[i]['Title'],    								
										}).appendTo(divTagId);
										
									$(anchorTagId).hover(function(){
										$('#otherTemplatesDetails').empty();
										var thisId = $(this).attr('id');
										thisId = thisId.split("-");															
										fillJobTemplateDetails(data[thisId[1]]);
									});
								}
							}
				
							//alert(response);																											
						},
						error : function(jxhr) {
							alert(" No Templates available for this selection");

						}
					});

				});
				
				function fillJobTemplateDetails(data){
					
					if(data['CreatedBy']==3){
						jQuery('<div/>', {
    						text: 'Title: '+data['Title'],    								
						}).appendTo('#liTemplatesDetails');
						jQuery('<div/>', {
    						text: 'Description: '+data['Description'],    								
						}).appendTo('#liTemplatesDetails');
						jQuery('<div/>', {
    						text: 'Required Skills: '+data['SkillString'],    								
						}).appendTo('#liTemplatesDetails');
						jQuery('<div/>', {
    						text: 'Compensation Type: '+data['CompensationType'],    								
						}).appendTo('#liTemplatesDetails');
						jQuery('<a/>', {		
							href: 'iPostNewJobPrefilledTemplate.php?templateId='+data["ID"],				
    						text: 'Use this >>',    								
						}).appendTo('#liTemplatesDetails');	
					}			
					if(data['CreatedBy']==2){
						jQuery('<div/>', {
    						text: 'Title: '+data['Title'],    								
						}).appendTo('#otherTemplatesDetails');
						jQuery('<div/>', {
    						text: 'Description: '+data['Description'],    								
						}).appendTo('#otherTemplatesDetails');
						jQuery('<div/>', {
    						text: 'Required Skills: '+data['SkillString'],    								
						}).appendTo('#otherTemplatesDetails');
						jQuery('<div/>', {
    						text: 'Compensation Type: '+data['CompensationType'],    								
						}).appendTo('#otherTemplatesDetails');
						jQuery('<a/>', {		
							href: 'iPostNewJobPrefilledTemplate.php?templateId='+data["ID"],				
    						text: 'Use this >>',    								
						}).appendTo('#otherTemplatesDetails');	
					}		
				}
								
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
      <h1 class="offset6">Post Job</h1><br/><br/>
  
				<div class="container-fluid">
					<div class = "row-fluid">
	
					<div class="span4">
						<form class="form-horizontal" id="jobPostingForm" method="post">
						<div class="control-group">
							<label class="control-label" >Job Category</label>
							<div class="controls">
								<?php
            	                  	$objJobManagement = new JobManagement();
            						$list=$objJobManagement->GetListFromTableByParameter('jobcategory','CategoryName');									
									$string="<select id='jobCategory' name ='CategoryId' required=\"required\" ><option></option>";
            						foreach($list as $id => $param_value)
						            {
						            		$substring = "<option value =".$id.">".$param_value."</option>";
                							$string = $string.$substring;										
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
								<option></option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" >Job Type</label>
							<div class="controls">
							<?php
            	                  	$objJobManagement = new JobManagement();
									$list=array();$string='';$substring='';
            						$list=$objJobManagement->GetListFromTableByParameter('jobtype','Type');									
									$string="<select id='jobType' name ='JobTypeId' required=\"required\" ><option></option>";
            						foreach($list as $id => $param_value)
						            {						            										
											$substring = "<option value =".$id.">".$param_value."</option>";
                							$string = $string.$substring;										
            						}
            						$string = $string."</select>";
									echo $string;

								?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputTitle">Job Title</label>
							<div class="controls">
								<input type="text" name="Title" required="required" id="inputTitle" placeholder="Title"  data-minlength="5" maxlength="100" required="required"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="description">Job Description</label>
							<div class="controls">
								<textarea rows="5" id="description" required="required" name="Description" placeholder="Eg. Talented programmers who can think out of the box to come up with new algorithms" required="required"></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" >Location</label>
							<div class="controls">
								<?php
									$list = Utilities::GetListFromTableByParameter("location", "CityName");
									echo Utilities::GetHTMLMultipleListFromList($list,"LocationName");
								?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" >Starts
								<br/>
							</label>
							<div class="controls">
								<input type="text" id="datepicker1" name="StartDate" placeholder="MM/DD/YYYY" required="required">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" >Ends
								<br/>
							</label>
							<div class="controls">
								<input type="text" id="datepicker2" name="EndDate" placeholder="MM/DD/YYYY" required="required">
							</div>
						</div>
						<div class="control-group">
							<label class="checkbox inline">
								<div class="controls">
									<input type ="checkbox" name="IsPeriodFlexible">
									Period is flexible(<i class="icon-ok"></i>)
								</div> </label>
						</div>

						<div class="control-group">
							<label class="control-label" >Required Skill Set</label>
							<div class="controls">
								<?php
									$list = Utilities::GetListFromTableByParameter("skills", "SkillName");
									echo Utilities::GetHTMLMultipleListFromList($list,"Skill");
								?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" >Academic Requirement</label>
							<div class="controls">
								<?php
									$list = Utilities::GetListFromTableByParameter("academicrequirement", "AcademicRequirement");
									echo Utilities::GetHTMLMultipleListFromList($list,"AcademicRequirement");
								?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" >Compensation Type</label>
							<div class="controls">
								<?php
									$list = Utilities::GetListFromTableByParameter("compensation", "CompensationType");
									echo Utilities::GetHTMLDropdownFromList($list,"Compensation");
								?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputAmount">Renumeration</label>
							<div class="controls">
								<input type="text" name="Amount" required="required" pattern="^[0-9]+" id="inputAmount" placeholder="5000" required="required" />
							</div>
						</div>
						<div class="control-group">
							<label class="checkbox inline">
								<div class="controls">
									<input type ="checkbox" name="JobProspect">
									Converts to full time Job(<i class="icon-ok"></i>)
								</div> </label>
						</div>
						<div class="control-group">
							<label class="control-label" for="NoOfPositions">Number of openings</label>
							<div class="controls">
								<input type="text" required="required" pattern="^[0-9]+"  name="NoOfPositions" id="NoOfPositions" placeholder="11" required="required" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" >Application Deadline
								<br/>
							</label>
							<div class="controls">
								<input type="text" id="datepicker3" name="ApplicationDeadline" placeholder="MM/DD/YYYY" required="required">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input type="hidden" name="EmployerId" value=<? echo "'".$_SESSION['letssession'][1]."'";?>>

								<button type="submit" class="btn btn-success">
									Post
								</button>
							</div>
						</div>
				</form>
				</div>
       
       <div class = "row span8">
       <div class="span4" id="liTemplates">
       	To view existing Job Templates, select Job Category, Job Sub category and Job Type repectively.
       </div>
          
       <div class="span4" id="liTemplatesDetails">
       	crap
       </div>
       </div>
       <br/><br/><br/<br/<br/>
       <div class="row span8">
       	<div class = "span4" id="otherTemplates">
       		
       	</div>
       	<div class = "span4" id="otherTemplatesDetails">
       		
       	</div>
       </div>
      
       
                                                
  

</body>
</html>