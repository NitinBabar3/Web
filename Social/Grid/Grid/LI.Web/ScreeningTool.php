<?
include '../LI.Entities/Student.php';
include '../LI.Entities/Application.php';
include '../LI.Entities/Answer.php';
include '../Utilities/Utilities.php';
include '../LI.BusinessManagement/JobApplicationManagement.php';

//$jobId = 30;
//$objJobApplicationManagement = new JobApplicationManagement();
//$arrayApplication = $objJobApplicationManagement->GetAllApplicationsByJobId($jobId);

?>
<html>
	<head>
		<title>Screening Tool</title>
		<link href="css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  		<link href="css/default.css" rel="stylesheet" id="theme-specific-script">
  		<link href="css/bootstrap-responsive.css" rel="stylesheet">
  		<link type="text/css" href="jPlayer/jplayer.blue.monday.modified.css" rel="stylesheet" />
  		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>  
  		<script type="text/javascript" src="jPlayer/jPlayer.js"></script>
  		<!--script src = 'scripts/jQuery-1.8.js'></script-->
  		
  		<script>
  		$(document).ready(function(){
  			var JobId=30;
  			var TestId = 3;
  			//var response1;
  			applicationStatus = new Array("Applied","Rejected","Shortlisted","Selected");
  			//var response;
  			$('#rejectedNav').click(function(){  				
  				$('#appliedStudents').hide();
  				$('#selectedStudents').hide();
  				$('#ShortlistedStudents').hide();
  				$('#rejectedStudents').slideDown();
  				$('#appliedNav').removeClass();
  				$('#selectedNav').removeClass();
  				$('#ShortlistedNav').removeClass();  		
  				$(this).addClass("active");
  				
  			});
  			$('#appliedNav').click(function(){  				
  				$('#appliedStudents').slideDown();
  				$('#selectedStudents').hide();
  				$('#shortlistedStudents').hide();
  				$('#rejectedStudents').hide();
  				$('#rejectedNav').removeClass();
  				$('#selectedNav').removeClass();
  				$('#shortlistedNav').removeClass();  		
  				$(this).addClass("active");
  				
  			});
  			$('#selectedNav').click(function(){  				
  				$('#appliedStudents').hide();
  				$('#selectedStudents').slideDown();
  				$('#shortlistedStudents').hide();
  				$('#rejectedStudents').hide();
  				$('#appliedNav').removeClass();
  				$('#rejectedNav').removeClass();
  				$('#shortlistedNav').removeClass();  		
  				$(this).addClass("active");
  				
  			});
  			$('#shortlistedNav').click(function(){  				
  				$('#appliedStudents').hide();
  				$('#selectedStudents').hide();
  				$('#shortlistedStudents').slideDown();
  				$('#rejectedStudents').hide();
  				$('#appliedNav').removeClass();
  				$('#selectedNav').removeClass();
  				$('#rejectedNav').removeClass();  		
  				$(this).addClass("active");
  				
  			});
  			  			
  			$.ajax({
						url : '../LI.Services/getJobApplicationsByJobId.php',
						type : 'GET',
						data : {
							JobId:JobId,					
						},
						dataType : 'json',

						success : function(data) {
							applications = data;
							//alert(data);
							//var mainDivId = '#appliedStudentsDetails';
							//data[0]['ApplicationStatus'] = "Rejected";
							for (var i=0;i<data.length;i++){
								mainDivId = "#"+data[i]['ApplicationStatus']+"StudentsDetails";
								//alert(mainDivId);
								fillWithDetails(data[i],mainDivId);	
							} 
													
						},
						error : function(jxhr) {
							alert(" No students have applied for this job yet");

						}

        	});
        	
        	$.ajax({
						url : '../LI.Services/getTestDetailsByTestId.php',
						type : 'GET',
						data : {
							TestId:TestId,					
						},
						dataType : 'json',

						success : function(question) {
							testQuestions = question;
																				
						},
						error : function(jxhr) {
							alert(" Test details could not be loaded");

						}

     	   });


  			function fillWithDetails(data,mainDivId){
  				//alert(data+mainDivId);
  				$(mainDivId).append(
  					"<div class=\"row\"></div>"
  					+"<div id='applied-"+data['StudentId']+"'></div>"
  				)
  				var appliedStudentDivId = '#applied-'+data['StudentId'];
  				$(appliedStudentDivId).append(
  					"<div class = \"span2\" id=\"aStudentCard\">"
  					+"<div><img src = 'images/"+data['Student']['Picture']+"' height='40px' width='40px'></div>"
  					+"<div>"+data['Student']['College']+" | "+data['Student']['CurrentYear']+" year, "+data['Student']['CurrentCourse']+"</div>"
  					+"<div> from "+data['Student']['Location']+"</div>"
  					+"</div>"
  				);
  				$(appliedStudentDivId).append(
  							"<div class = \"span3\" id=\'aAudioDescriptive-"+data['StudentId']+"'>"
  							+"<div><h4 align='center'>Audio/Descriptive Answers</h4></div>"  							
  							+"</div>"  							
  				);
  				for(var i=0;i<data['Answers'].length;i++){
  					if(data['Answers'][i]['ResponseText']!= null){
  						var descriptiveExists = 1;  						
  						if(data['Answers'][i]['QuestionType'] == "Descriptive"){
  							$('#aAudioDescriptive-'+data['StudentId']).append(
	  							"<div align='center'>"+data['Answers'][i]['ResponseText']+"</div>"
  							);
  						}
  						if(data['Answers'][i]['QuestionType'] == "Audio"){
  							$('#aAudioDescriptive-'+data['StudentId']).append(
  								"<div id='audPlug-"+data["ID"]+'-'+data['Answers'][i]['QuestionId']+"' class=\"jp-jplayer\" align='center'></div>"
 								+ "<div id=\"jp_container_1\" class=\"jp-audio\" align='center'>"
    							+	"<div class=\"jp-type-single\" align='center'>"
      							+		"<div class=\"jp-gui jp-interface\" align='center'>"
        						+			"<ul class=\"jp-controls\">"
          						+			"<li><a align='center' href=\"javascript:;\" class=\"jp-play\" tabindex=\"1\">play</a></li>"
          						+			"<li><a align='center' href=\"javascript:;\" class=\"jp-pause\" tabindex=\"1\">pause</a></li>"
          						+			"<li><a align='center' href=\"javascript:;\" class=\"jp-stop\" tabindex=\"1\">stop</a></li>"
        						+			"</ul>"        
      							+		"</div>"
      							+		"<div class=\"jp-no-solution\">"
        						+		"<span>Update Required</span>"
        						+			"To play the media you will need to either update your browser to a recent version or update your <a href=\"http://get.adobe.com/flashplayer/\" target=\"_blank\">Flash plugin</a>."
      							+		"</div>"
    							+	"</div>"
  								+"</div>"

  							);
  							var audPlugId='#audPlug-'+data["ID"]+'-'+data['Answers'][i]['QuestionId'];
  							$(audPlugId).jPlayer({
        						ready: function () {
        							thisId = $(this).attr('id').split('-');        							
        							
        							var questionId = thisId[2];
        							var applicationId = thisId[1];
        							
        							for(var i=0;i<applications.length;i++){
        								if(applicationId == applications[i]["ID"]){
        									break;
        								}
        							}
        							
        							for(var j=0;j<applications[i]['Answers'].length;j++){
        								if(applications[i]['Answers'][j]['QuestionId'] == questionId){
        									
        									break;
        								}
        							}
        							var audResponseFile = applications[i]['Answers'][j]['ResponseText'];
        							var audResponseSplit = audResponseFile.split(".");
        							//alert(audResponseSplit[1]);
        							audResponseExt = audResponseSplit[1];
        							var audFile = "aud-"+applicationId+"-"+questionId;
        							var mp3 = "audio/"+audFile+"."+audResponseExt;
        							var ogg = "audio/"+audFile+".ogg";
          							$(this).jPlayer("setMedia", {
            						m4a: mp3,
            						oga: ogg
          							});
        						},
        						swfPath: "/jPlayer",
        						supplied: "m4a, oga"        					        						
      						});
  							/*$('#aAudioDescriptive-'+data['StudentId']).append(
	  							"<div align='center'>"
	  							+"<embed src='"+data['Answers'][i]['ResponseText']+"' autoplay='' width=1 height=1 id=\"sound1\" enablejavascript=\"true\">"
	  							+"<a href='#' id='"+data['Answers'][i]['ResponseText']+"'>Play</a>"
	  							+"</div>"
  							);
  							$('#'+data['Answers'][i]['ResponseText']).click(function(){
  								//var thisId = $(this).attr('id');
  								var thisId = "sound1";
  								var thisSound= document.getElementById(thisId);
  								thisSound.Play();
  							});*/
  						}
  						
  					}  					
  				}
  				if (descriptiveExists==0){
  						$(appliedStudentDivId).append(
  						"<div align='center'> No descriptive questions in your test</div>"
  						);
  				}
  				  				
  				if(data['NumberOfMCQ']>0){
  					$(appliedStudentDivId).append(
  						"<div class = \"span1\" id=\"aScore\">"
  						+"<div><h4 align='center'>Score</h4><h6 align='center'>"+data['Marks']+"/"+data['NumberOfMCQ']+"</h6></div>"
  						+"</div>"
  					);
  				}
  				else{
  					$(appliedStudentDivId).append(
  						"<div class = \"span2\" id=\"aScore\">"
  						+"<div> No MCQ or T/F in your test</div>"
  						+"</div>"  						
  					);
  				}
  				
  				$(appliedStudentDivId).append(  
  						"<div class = \"span2\" id=\"aRating\">"
  						+"<div><h4 align='center'>Rating</h4></div>"					
  						+"<div align = 'center'><select id='ApplicationRating-"+data['StudentId']+"' style = 'width:50px'></select>"
  						+"</div>"  						  					
  				);
  				var applicationRatingId = 'ApplicationRating-'+data['StudentId'];
  				var ddl = document.getElementById(applicationRatingId);
  				if(data['ApplicationRating'] == null){  					
					var option = document.createElement('option');
					option.value = '';
					option.text = 'NA';					
					ddl.appendChild(option);						
					$("#"+applicationRatingId).val('').attr('selected',true);
  				}
  				
				for(var c=1;c<6;c++)
				{
					var option = document.createElement('option');
					option.value = c;
					option.text = c;
					ddl.appendChild(option);
					if(c==data['ApplicationRating']){
						$("#"+applicationRatingId).val( c ).attr('selected',true);	
					}					
				}
				$(appliedStudentDivId).append(
					"<div class = \"span2\" id=\"aStatus\">"
					+"<div><h4 align='center'>Application Status</h4></div>"
					+"<div align='center'><select  id = 'ApplicationStatus-"+data['StudentId']+"' style='width:120px'></select></div>"
					+"</div>"
				);				  		
  			  		
  				var applicationStatusId = 'ApplicationStatus-'+data['StudentId'];
  				var ddl = document.getElementById(applicationStatusId);
  				for(var c=0;c<applicationStatus.length;c++){
	  					var option = document.createElement('option');
						option.value = applicationStatus[c];
						option.text = applicationStatus[c];
						ddl.appendChild(option);
  				}
  				$("#"+applicationStatusId).val( data['ApplicationStatus'] ).attr('selected',true);  				
  				var applicationStatusId = '#ApplicationStatus-'+data['StudentId'];
  				$(applicationStatusId).change(function(){
  					var newApplicationStatus = $(this).find("option:selected").val();
  					var thisId = $(this).attr('id').split('-');
  					var studentId = thisId[1];
  					var divToRemoveId = '#applied-'+studentId;
  					//alert(divToRemoveId);
  					$(divToRemoveId).hide();
  					$(divToRemoveId).empty();
  					data['ApplicationStatus'] = newApplicationStatus;
  					//alert(data['ApplicationStatus']);
  					var newMainDivId = "#"+data['ApplicationStatus']+"StudentsDetails";
  					$(divToRemoveId).attr('id','');
  					fillWithDetails(data,newMainDivId);
  					$('#quickMessage').empty();
  					$('#quickMessage').append(
  						"A student has been moved to "+newApplicationStatus+" category" 
  					);
  					$('#quickMessage').slideDown('slow');
  					setTimeout(function() {
    					$('#quickMessage').slideUp();
    					$('#quickMessage').empty();
					}, 5000);
					for(var i=0;i<applications.length;i++){
						if(studentId == applications[i]["StudentId"]){
							var applicationId = applications[i]["ID"];
						
							break;
						}
					}
					$.ajax({
						url : '../LI.Services/changeApplicationStatus.php',
						type : 'POST',
						data : {
							applicationId:applicationId,
							newApplicationStatus:newApplicationStatus,					
						},						

						success : function() {
																											
						},
						error : function(jxhr) {
							alert("This action could not be completed, please try again later");

						}

		     	   });

					
  				});
  				var applicationRatingId = '#ApplicationRating-'+data['StudentId'];
  				$(applicationRatingId).change(function(){
  					var newApplicationRating = $(this).find("option:selected").val();
  					//alert(newAplicationRating);
  					var thisId = $(this).attr('id').split('-');
  					var studentId = thisId[1];
  					
					for(var i=0;i<applications.length;i++){
						if(studentId == applications[i]["StudentId"]){
							var applicationId = applications[i]["ID"];						
							break;
						}
					}
					$.ajax({
						url : '../LI.Services/changeApplicationRating.php',
						type : 'POST',
						data : {
							applicationId:applicationId,
							newApplicationRating:newApplicationRating,					
						},						

						success : function() {
																											
						},
						error : function(jxhr) {
							alert("This action could not be completed, please try again later");

						}

		     	   });

					
  				});

  				$(appliedStudentDivId).append(
  					"<div class = \"span1\" id=\"viewDetailedApplication\">"
  					+"<a href='#' id='viewDetailedApplication-"+data['StudentId']+"'>View Detailed Application</a>"
  					+"</div>"
  				);  				
  				viewApplicationTagId = '#viewDetailedApplication-'+data['StudentId'];
  				$(viewApplicationTagId).click(function(){
  					var thisId = $(this).attr('id').split('-');
  					var studentId = thisId[1];
  					//alert(studentId);
  					showApplicationDetails(studentId);
  				});
			}
			
			function showApplicationDetails(studentId){
				$('#showApplicationDetails').empty();
				var foundStudent = 0;
				for(var i =0;i<applications.length;i++){
					if(applications[i]['StudentId'] == studentId){
						foundStudent = 1;
						break;
					}
				}
				studentIndex = i;				
				if (foundStudent==0){
					$('#showApplicationDetails').append(
						"No application found for this student. Please try again later."
					);
				}
				else{
					for(var i=0;i<testQuestions['Questions'].length;i++){
						var answered=0;
						if(testQuestions['Questions'][i]["QuestionType"] == "MCQ")
						{
							var optionTextArray = new Array();
							var optionIdArray = new Array();
							var tempQuestionId = testQuestions['Questions'][i]["ID"];
							var tempQuestionText = testQuestions['Questions'][i]["QuestionText"]
							for(var j=0;j<testQuestions['Questions'][i]["Options"].length;j++){
								optionTextArray[j] = testQuestions['Questions'][i]["Options"][j]["OptionText"];
								optionIdArray[j] = testQuestions['Questions'][i]["Options"][j]["ID"];
								if(testQuestions['Questions'][i]["Options"][j]["IsCorrect"]==1){
									var correctAnswer = testQuestions['Questions'][i]["Options"][j]["OptionText"];
								}  
							}
						
							for(var j=0;j<applications[studentIndex]["Answers"].length;j++){
								if(applications[studentIndex]["Answers"][j]["QuestionId"] == tempQuestionId){
									var givenAnswerOptionId = applications[studentIndex]["Answers"][j]["OptionId"];
									break;
								}
							}
							for(var j=0;j<optionIdArray.length;j++){
								if(givenAnswerOptionId == optionIdArray[j]){
									var givenAnswerOptionText = optionTextArray[j];
									answered=1;
									break;
								}
							}
							if (answered==0)
								givenAnswerOptionText= "Not answered";
							
							$('#showApplicationDetails').append(
								"<div>Q: "+tempQuestionText+"</div>"
								+"<p class='pull-right'>"+correctAnswer+"</p></div>"
								+"<div><p>A: "+givenAnswerOptionText+"</p>"
								
							);
						}
						else if(testQuestions['Questions'][i]["QuestionType"] == "Descriptive"){
												
							var tempQuestionText = testQuestions['Questions'][i]["QuestionText"];
							var tempQuestionId = testQuestions['Questions'][i]["ID"];
							for (var j=0;j<applications[studentIndex]["Answers"].length;j++){
								if(applications[studentIndex]["Answers"][j]["QuestionId"] == tempQuestionId){
									var givenAnswer = applications[studentIndex]["Answers"][j]["ResponseText"];
									answered=1;
									break;									
								}
							}
							if(answered == 0){
								var givenAnswer = "Not Answered";
							}
							$('#showApplicationDetails').append(
								"<div>Q: "+tempQuestionText+"</div>"								
								+"<div><p>A: "+givenAnswer+"</p>"							
							);	
						}
					}
					
				}
								
			} 								
			
  		});
  		</script>  		 		
	</head>
	<body>
<!-- Navigation-->		
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
    <div class = "span4 offset5" align="center" id="quickMessage" style="background-color: red;display:none">
  		
  	</div>
  </div><br/>
  
  
  <div class="navbar">
  	<div class="navbar-inner">
    
    <ul class="nav">
      <li class="active" id="appliedNav"><a href="#">Applied</a></li>
      <li id="rejectedNav"><a href="#" >Rejected</a></li>
      <li id="selectedNav"><a href="#" >Selected</a></li>
      <li id="shortlistedNav"><a href="#" >Shortlisted</a></li>
    </ul>
  	</div>
  </div>
  
  <div class="container well" id="appliedStudents" >
  	<div class = "row">
  		<div id="AppliedStudentsDetails">
  		
  		</div>
  	</div>
  </div>
  <div class="container well" id="rejectedStudents" style="display: none">
  	<div class = "row">
  		<div id="RejectedStudentsDetails">
  		
  		</div>
  	</div>
  </div>
  <div class="container well" id="selectedStudents" style="display: none">
  	<div id="SelectedStudentsDetails">
  		
  		</div>
  </div>
  <div class="container well" id="shortlistedStudents" style="display: none">
  	<div id="ShortlistedStudentsDetails">
  		
  		</div>
  </div>
  <div id = "showApplicationDetails" class="container well span6 offset3" >
  	
  </div>
	</body>
	
    	
</html>