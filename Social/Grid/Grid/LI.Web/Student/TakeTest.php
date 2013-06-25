<?
session_start();
print_r($_SESSION["letssession"]);
include '../../Utilities/Utilities.php';
?>
<!DOCTYPE html>
<!-- saved from url=(0050)http://wbpreview.com/previews/WB00958H8/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HTML5 Admin Simplenso Template">
  <meta name="author" content="ahoekie">

  <!-- Bootstrap -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link type="text/css" href="css/default.css" rel="stylesheet">
  <link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
   
  
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="../css/jquery.fileupload-ui.css">
  
  <!-- Bootstrap Image Gallery styles -->
  <link rel="stylesheet" href="../css/bootstrap-image-gallery.min.css">
  
  <!-- Uniform -->
  <link rel="stylesheet" type="text/css" media="screen,projection" href="css/uniform.default.css">
  
  <!-- Chosen multiselect -->
  <link type="text/css" href="../css/chosen.intenso.css" rel="stylesheet">   

  <!-- Simplenso -->
  <link href="../css/simplenso.css" rel="stylesheet">
  <!-- Validation scripts-->

	<script src="scripts/jquery.min.js"></script>
	<script src="jRecorder/jRecorder.js"></script>
	<script type="text/javascript" src="../scripts/jquery.timer.js"></script>
	
	<!--script>//jRecorder
		$(document).ready(function(){   
   			$.jRecorder({ 
        		host : 'jRecorder/acceptfile.php?filename=hello' ,  //replace with your server path please
	        
    		    callback_started_recording:     function(){callback_started(); },
        		callback_stopped_recording:     function(){callback_stopped(); },
        		callback_activityLevel:          function(level){callback_activityLevel(level); },
        		callback_activityTime:     function(time){callback_activityTime(time); },
        
		        callback_finished_sending:     function(time){ callback_finished_sending() },
	        
    	    
        		swf_path : 'jRecorder/jRecorder.swf',
     
     		});
		});   
       
   </script-->

	<script>
		$(document).ready(function(){
  			//var JobId=50;
  			//var TestId = 3;
  			var applicationId = <?php echo $_SESSION["letssession"]["ApplicationID"];?>; // change this before pposting
  			var studentId = <?php echo $_SESSION["letssession"]["UserId"];?>;
  			//var response1;
			//alert(<?php echo  $_SESSION["letssession"]["ApplicationID"]?>);
  			//applicationStatus = new Array("Applied","Rejected","Shortlisted","Selected");
  			starredQuestions = new Array();
  			answered = new Array();
  			notAnswered = new Array();
  			application = new Object();
  			application.ID = applicationId;
  			application.StudentId = studentId;
  			application.Answers = new Array();
  			
  			sec = 0;
			mins = 0;
			

  			//starredQuestions[0] = "73";  			
  			$.ajax({
						url : '../LI.Services/getTestDetailsByTestId.php',
						type : 'GET',
						data : {
							applicationId:applicationId					
						},
						dataType : 'json',

						success : function(data) {
							testQuestions = data;
							$('#testTitle').append(
								"<h3><strong>"+data['TestTitle']+"</strong></h3>"
							);
							fillModalWithTestDetails(data);
											var timer = 
														$.timer(
															function() {
																		sec++;
																		if (sec == 59){	
																				sec =0;
																				mins++;
																			for(var i=0;i<testQuestions['Questions'].length;i++){
																				$('#min-'+i).html(mins+':');
																			}
																		
																		$('#bodyMin').html(mins+':');
																		}
																for(var i=0;i<testQuestions['Questions'].length;i++){
																	$('#sec-'+i).html(sec);
																}
																
																$('#bodySec').html(sec);
															},
																1000,
																true
														);	
						},
						error : function(jxhr) {
							alert(" Test could not be loaded, please try again later");

						}

     	   });     	   
     	   function fillModalWithTestDetails(data){
     	   		for(var i=0;i<data['Questions'].length;i++){
     	   			$('#testBody').append(
	     	   			"<div class=\"modal hide\" id='question-"+i+"' >"
  						+	"<div class=\"modal-header\">"
    					+		"<h6 class='pull-right'><span>Time </span><span id='min-"+i+"'>0:</span><span id='sec-"+i+"'>0</span></h6>"
    					+		"<h4>Q: "+data['Questions'][i]['QuestionText']+"</h4>"    						
  						+	"</div>"  						
  						+	"<div class='modal-body' id='body-"+i+"' ></div>"
     	   				+"</div>"
     	   			);     	   			
     	   			$('#body-'+i).append(
     	   				"<div class='pull-right'><a href='#' title= 'Bookmark This' id='isStarred-"+data['Questions'][i]["ID"]+"' ><i id = 'star-"+data['Questions'][i]["ID"]+"' class='icon-star-empty'></i></a></div>"
     	   			);
     	   			$('#isStarred-'+data['Questions'][i]["ID"]).click(function(){
     	   				var thisIdSplit = $(this).attr('id').split("-");
     	   				var thisQuestionId = thisIdSplit[1];
     	   				//alert(thisQuestionId);
     	   				if(jQuery.inArray(thisQuestionId,starredQuestions) == 0){	//true
     	   					for(var i=0;i<starredQuestions.length;i++){
     	   						if (thisQuestionId == starredQuestions[i])
     	   							break;
     	   					}
     	   					starredQuestions.splice(i,1);     	   					
     	   				}	
     	   				else{
     	   					starredQuestions[starredQuestions.length] = thisQuestionId;
     	   				}
     	   				var starId = '#star-'+thisQuestionId;	
     	   				$(starId).toggleClass('icon-star-empty icon-star');
     	   			});
     	   			
     	   			if(data['Questions'][i]['QuestionType']=="MCQ"){
     	   				var optionTextArray = new Array();
     	   				var optionIdArray
     	   				for(var j=0;j<data['Questions'][i]['Options'].length;j++){
     	   					var qID = data['Questions'][i]['ID'];
     	   					var oID = data['Questions'][i]['Options'][j]['ID'];
     	   					$('#body-'+i).append(
     	   						"<div class='offset1'>"						
								+"<label class=\"radio\">"
  									+"<input type=\"radio\" name = 'questionOption-"+qID+"' id='questionOption-"+qID+"-"+oID+"' value="+oID+" >"
  									+data['Questions'][i]['Options'][j]['OptionText']
								+"</label>"
								+"</div>"		
							);																				
						
							$('#questionOption-'+qID+'-'+oID).change(function(){
								var thisIdSplit = $(this).attr('id').split('-');
								var qID = thisIdSplit[1];															
								var oID = $(this).val();
								var alreadyAnswered = 0;
								for(var i=0;i<application.Answers.length;i++){
									if(application.Answers[i].QuestionId == qID){
										alreadyAnswered = 1;
										break;
									}
								}
								if (alreadyAnswered == 1){
									 application.Answers[i].OptionId = oID;
								}	
								else{
									i = application.Answers.length;
									answered[answered.length] = qID;
									application.Answers[i] = new Object();
									application.Answers[i].QuestionId = qID;
									application.Answers[i].OptionId = oID;
									application.Answers[i].ResponseText = '';
								}
																
							});
						}
     	   			}
     	   			else if(data['Questions'][i]['QuestionType']=="Descriptive"){
     	   				$('#body-'+i).append(     	   						
								"<div class=\"control-group\">"									
									+"<div class=\"controls\">"
									+"<textarea id='descriptiveAnswer-"+data['Questions'][i]['ID']+"' placeholder='Your answer' rows=3 style='width:100%'></textarea>"
								+"</div>"
								+"</div>"		
						);
						$('#descriptiveAnswer-'+data['Questions'][i]['ID']).focusout(function(){
							var thisIdSplit = $(this).attr('id').split('-');
							var qID = thisIdSplit[1];
							var ResponseText = $(this).val();
							var alreadyAnswered = 0;
								for(var i=0;i<application.Answers.length;i++){
									if(application.Answers[i].QuestionId == qID){
										alreadyAnswered = 1;
										break;
									}
								}
								if (alreadyAnswered == 1){
									 application.Answers[i].ResponseText = ResponseText;
								}	
								else{
									i = application.Answers.length;
									answered[answered.length] = qID;
									application.Answers[i] = new Object();
									application.Answers[i].QuestionId = qID;
									application.Answers[i].OptionId = '';
									application.Answers[i].ResponseText = ResponseText;
								}
						});
						
     	   			}
     	   			else if(data['Questions'][i]['QuestionType']=="Audio"){
     	   				var filename = 'aud-'+applicationId+'-'+data['Questions'][i]['ID'];     	   				
     	   				$('#body-'+i).append(
     	   					"<div align='center'>"     	   						
							+"<iframe src='jRecorder.php?filename="+filename+"' height='200px' width='300px' scrolling=\"no\" ></iframe>"
							+"</div>"				
						);
			
     	   			}
     	   			$('#question-'+i).append(
     	   				"<div class=\"modal-footer\" id='footer-"+i+"' ></div>"
     	   			);
     	   			$('#footer-'+i).append(
     	   				"<a href='#' id='endTest-"+i+"' data-dismiss=\"modal\" aria-hidden=\"true\" role=\"button\" data-toggle=\"modal\" class=\"btn btn-danger\">Save and End</a>"     	   					
     	   			);
     	   			$('#endTest-'+i).click(function(){
     	   				reviewTest();	
     	   			});
     	   			if(i!=0){     	   				
     	   				var prevQ=i-1;     	   		
     	   				$('#footer-'+i).append(     	   				  							
  							"<a href='#question-"+prevQ+"' data-dismiss=\"modal\" aria-hidden=\"true\" role=\"button\" data-toggle=\"modal\" class=\"btn btn-warning\">Previous</a>"    					      						
     	   				);
     	   			}
     	   			if(i!=data['Questions'].length-1){
     	   				var nextQ=i+1;
     	   				$('#footer-'+i).append(
     	   					"<a href='#question-"+nextQ+"' data-dismiss=\"modal\" aria-hidden=\"true\" role=\"button\" data-toggle=\"modal\" class=\"btn btn-primary\">Save and Next</a>"     	   					
     	   				);
     	   			}     	   			     	   				     	   			     	   				
     	   		}
     	   }
     	   
     	   function reviewTest(){
     	   		$('#reviewTag').empty();
     	   		$('#reviewTag').hide();
     	   		notAnswered = [];
				for(var i=0;i<testQuestions['Questions'].length;i++){
     	   			if(jQuery.inArray(testQuestions['Questions'][i]['ID'],answered) == -1){
     	   				notAnswered[notAnswered.length] = testQuestions['Questions'][i]['ID'];
     	   			}
     	   		}
     	   		     	   		
     	   		$('#reviewTag').append(
     	   			"<div align='center'><strong>Review Test</strong></div><br/>"
     	   		);
     	   		if(answered.length!=0){
     	   			$('#reviewTag').append(
     	   				"<div align='center'><a href='#' id='reviewAnswered' class = 'btn btn-success'>Answered</a></div><br/>"
     	   			);
     	   			$('#reviewAnswered').click(function(){
     	   				fillReviewAnswered();
     	   			});
     	   		}
     	   		if(notAnswered.length!=0){
     	   			$('#reviewTag').append(
     	   				"<div align='center'><a href='#' id='reviewNotAnswered' class = 'btn btn-danger'>Not Answered</a></div><br/>"
     	   			);
     	   			$('#reviewNotAnswered').click(function(){
     	   				fillReviewNotAnsweredOrStarred(notAnswered);
     	   			});
     	   		}
     	   		if(starredQuestions.length!=0){
     	   			$('#reviewTag').append(
     	   				"<div align='center'><a href='#' id='reviewStarred' class = 'btn btn-warning'>Bookmarked</a></div>"
     	   			);
     	   			$('#reviewStarred').click(function(){
     	   				fillReviewNotAnsweredOrStarred(starredQuestions);
     	   			});
     	   		}
     	   		if(answered.length!=0){
     	   			$('#reviewTag').append(
     	   				"<div align='center'><a href='#' id='completeTest' class = 'btn btn-primary'>Ok, I'm done</a></div><br/>"
     	   			);
     	   			$('#completeTest').click(function(){
     	   				$.ajax({
							url : '../LI.Services/postApplication.php',
							type : 'POST',
							data : {							
								application:JSON.stringify(application),					
							},
							//dataType : 'json',

							success : function(data) {
								alert('Your answers have been saved');
								//response=data;
								//alert(data);
								//arrayQuestionId[arrayQuestionId.length] = data;
							},
							error : function(jxhr) {
								alert(" Test not posted");
							}

						});

     	   			});
     	   		}
     	   		$('#reviewTag').fadeIn();
     	   		
     	   }
     	   
     	   function fillReviewAnswered(){
     	   		$('#reviewTest').empty();
     	   		for(var i=0;i<testQuestions['Questions'].length;i++){
     	   			if(jQuery.inArray(testQuestions['Questions'][i]['ID'],answered) != -1){
     	   				qText = testQuestions['Questions'][i]['QuestionText'];
     	   				qID = testQuestions['Questions'][i]['ID'];
     	   				if(testQuestions['Questions'][i]['QuestionType'] == "MCQ"){
     	   					for(var j=0;j<application.Answers.length;j++){
	     	   					if(qID == application.Answers[j]['QuestionId']){
    	 	   						optionId = application.Answers[j]['OptionId'];
     		   						break;
     	   						}
     	   					}
	     	   				for(var j=0;j<testQuestions['Questions'][i]['Options'].length;j++){
    	 	   					if(optionId == testQuestions['Questions'][i]['Options'][j]['ID']){
     		   						answerText = testQuestions['Questions'][i]['Options'][j]['OptionText'];
     	   							break;
     	   						}
     	   					}
     	   				}
     	   				else if(testQuestions['Questions'][i]['QuestionType'] == "Descriptive"){
     	   					for(var j=0;j<application.Answers.length;j++){
	     	   					if(qID == application.Answers[j]['QuestionId']){
    	 	   						answerText = application.Answers[j]['ResponseText'];
     		   						break;
     	   						}
     	   					}
     	   				}
     	   				$('#reviewTest').append(
     	   					"<div>"
     	   					+"Q: "+qText
     	   					+"<a href='#question-"+i+"' data-dismiss=\"modal\" aria-hidden=\"true\" role=\"button\" data-toggle=\"modal\" class=\"pull-right btn btn-warning\">Change</a>"
     	   					+"<br/>A: "+answerText     	   					
     	   					+"</div>"
     	   				);
     	   				$('#reviewTest').fadeIn();
     	   			}
     	   		}
     	   						
     	   }
     	   function fillReviewNotAnsweredOrStarred(questionIdArray){
     	   		$('#reviewTest').empty();
     	   		$('#reviewTest').hide();
     	   		for(var i=0;i<testQuestions['Questions'].length;i++){
     	   			if(jQuery.inArray(testQuestions['Questions'][i]['ID'],questionIdArray) != -1){
     	   				qText = testQuestions['Questions'][i]['QuestionText'];
     	   				qID = testQuestions['Questions'][i]['ID'];
     	   				$('#reviewTest').append(
     	   					"<div>"
     	   					+"Q: "+qText
     	   					+"<a href='#question-"+i+"' data-dismiss=\"modal\" aria-hidden=\"true\" role=\"button\" data-toggle=\"modal\" class=\"pull-right btn btn-info\">View</a>"     	   					     	   					
     	   					+"</div><br/>"
     	   				);
     	   			}
     	   		}
     	   		$('#reviewTest').fadeIn();		
     	   }
     	   
        	
      });

	</script>
	
		
</head>
<body>
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

</div>
<div id='applicationId'><?echo $_SESSION['letssession']['ApplicationID']; ?> </div>
	<!-- Button to trigger modal --> 
	<div class="container">
		<div class = "row" id="testTitle" align="center">
			<div class='pull-right'>
				<span>Time </span>
				<span id='bodyMin'>0:</span>
				<span id='bodySec'>0</span>
			</div>
		</div>
		<div class = "row" align="center">
		<a href="#question-0" id="modalBoxButton" role="button" class="btn btn-primary" data-toggle="modal">Start my test!</a>
		</div>
	</div>
	
	<div id="testBody"><br/><br/>
	</div>
	
	<div class='container-fluid'>
		<div class='row-fluid'>
			<div class = 'well span2' id = 'reviewTag' style="display:none">
				
			</div>
			<div class = 'well span10' id = 'reviewTest' style="display:none" >
				
			</div>	
		</div>
		
	</div>
	
	</div>


<!--div style="background-color: #eeeeee;border:1px solid #cccccc">
  
  Time: <span id="time">00:00</span>
  
</div>

<div id="levelbase" style="width:200px;height:20px;background-color:#ffffff">
  
  <div id="levelbar" style="height:19px; width:2px;background-color:black"></div>
  
</div>

<div>
  Status: <span id="status"></status>
</div> 


<div>
  
<input type="button" id="record" value="Record" style="color:red">  

  
<hr/>

<input type="button" id="stop" value="Stop">

 
<hr/>
  
<input type="button" id="send" value="Send Data">
  
<hr/-->
<!--iframe src='jRecorderPlugin' height='100px' width='300px' scrolling="no" ></iframe-->
  
</body>
<!--script type="text/javascript"> //jRecorder
                           
                  $('#record').click(function(){
                    
                    
                      $.jRecorder.record(60);
                      
                      
                      
                    
                    
                  })
                  
                  
                  $('#stop').click(function(){
                    
                    
                    
                     $.jRecorder.stop();
                    
                    
                  })
                  
                  
                   $('#send').click(function(){
                    
                    
                    
                     $.jRecorder.sendData();
                    
                    
                  })
                  

                  function callback_finished()
                  {
      
                      $('#status').html('Recording is finished');
                    
                  }
                  
                  function callback_started()
                  {
      
                      $('#status').html('Recording is started');
                    
                  }
                  
                  
                  
                  
                  function callback_error(code)
                  {
                      $('#status').html('Error, code:' + code);
                  }
                  
                  
                  function callback_stopped()
                  {
                      $('#status').html('Stop request is accepted');
                  }

                  function callback_finished_recording()
                  {
                    
                      $('#status').html('Recording event is finished');
                    
                    
                  }
                  
                  function callback_finished_sending()
                  {
                    
                      $('#status').html('File has been sent to server mentioned as host parameter');
                      
                      
                  }
                  
                  function callback_activityLevel(level)
                  {
                    
                    $('#level').html(level);
                    
                    if(level == -1)
                    {
                      $('#levelbar').css("width",  "2px");
                    }
                    else
                    {
                      $('#levelbar').css("width", (level * 2)+ "px");
                    }
                    
                    
                  }
                  
                  function callback_activityTime(time)
                  {
                   
                   //$('.flrecorder').css("width", "1px"); 
                   //$('.flrecorder').css("height", "1px"); 
                    $('#time').html(time);
                    
                  }                  
                  		   		   		                         
        </script-->
<!--/.fluid-container-->
	<!-- javascript Templates
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Google API -->
    <script type="text/javascript" src="scripts/jsapi"></script>
     
    <!-- jQuery -->
    
    
    <!-- Data Tables -->
    <!--script src="scripts/jquery.dataTables.js"></script-->
    
    <!-- jQuery UI Sortable -->
    <!--script src="scripts/jquery.ui.core.min.js"></script>
	<script src="scripts/jquery.ui.widget.min.js"></script>
	<script src="scripts/jquery.ui.mouse.min.js"></script>
	<script src="scripts/jquery.ui.sortable.min.js"></script>
    <script src="scripts/jquery.ui.widget.min.js"></script>
    
    <!-- jQuery UI Draggable & droppable -->
    <!--script src="scripts/jquery.ui.draggable.min.js"></script>
    <script src="scripts/jquery.ui.droppable.min.js"></script>

    <!-- Bootstrap -->
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/bootbox.min.js"></script>



  
<div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">FireFox</div><div style="position: absolute; display: none; "><div style="background-color: infobackground; padding: 1px; border: 1px solid infotext; font-size: 10px; margin: 10px; font-family: Arial; background-position: initial initial; background-repeat: initial initial; ">Unique</div></div><div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">Un...</div></body><span id="skype_highlighting_settings" display="none" autoextractnumbers="1"></span><object id="skype_plugin_object" location.href="http://wbpreview.com/previews/WB00958H8/index.html" location.hostname="wbpreview.com" style="position: absolute; visibility: hidden; left: -100px; top: -100px; " width="0" height="0" type="application/x-vnd.skype.click2call.chrome.5.7.0"></object></html>
</html>
