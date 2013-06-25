<?

?>
<html>
	<head>
		<title>Create New Test</title>
		<link href="css/bootstrap.css" rel="stylesheet" id="main-theme-script">
  		<link href="css/default.css" rel="stylesheet" id="theme-specific-script">
  		<link href="css/bootstrap-responsive.css" rel="stylesheet">
  		
  		
  		<!--Validation-->
  		<link href="css/bootstrap.validate.css" rel="stylesheet" id="main-theme-script">
  		<!--script src="scripts/bootstrap.validate.js"></script>
  		
  		<!--Bootstrap>
  		<script src="scripts/bootstrap.min.js"></script>
    	<script src="scripts/bootbox.min.js"></script>
  		<!--dynamic-->
  		<script src="scripts/jQuery-1.8.js"></script-->
  		
  		<!--script src="scripts/jquery-1.5.1.js"></script>
  			<script src="scripts/json2.js"></script>
  		<script>
  			$(document).ready(function(){
  				var SubCategoryId = $('#subCategoryId').text();
  				var UserId = $('#userId').text();
  				arrayQuestionId = new Array();
  				arrayAddedQuestion = new Array();
  				 
  				$.ajax({
						url : '../LI.Services/liTestTemplateSource.php',
						type : 'GET',
						data : {
							SubCategoryId:SubCategoryId,					
						},
						dataType : 'json',

						success : function(data) {
							//response=data;
							for(var i=0;i<data.length;i++){
								fillTestTemplateDetails(data[i]);
							}
						},
						error : function(jxhr) {
							alert(" No Templates available for this selection");

						}

        			});
        			
        		$.ajax({
						url : '../LI.Services/getEmployerQuestionBank.php',
						type : 'GET',
						data : {
							SubCategoryId:SubCategoryId,
							UserId:UserId,					
						},
						dataType : 'json',

						success : function(data) {
							response=data;
							fillTestTemplateDetails(data);
							
						},
						error : function(jxhr) {
							alert(" No Templates available for this selection");

						}

        			});
	
        		function fillTestTemplateDetails(data){      			
					        			        			        														
					for(var i=0;i<data['Question'].length;i++){
						var questionId = data['Question'][i]['ID'];
						var questionUseId = '#questionUse-'+questionId;
						var questionText = data['Question'][i]['QuestionText'];
						var questionDivId = '#question'+questionId;
						var showOptionsId = '#showOptions-'+questionId;
						$('#availableQuestions').append(
							"<div id=question"+ questionId + ">" + 'Q : ' + questionText 
							+ "<a id =questionUse-"+ questionId + " href='#' class = 'pull-right'>Use this</a>"
							+"</div>"
						);
						if(data['Question'][i]['QuestionType'] == "MCQ"){
							$(questionDivId).append(
							"<a id=showOptions-"+questionId +" href='#' class = 'pull-right'>Show Options|</a>"	
							);
						}
						
						$(questionUseId).click(function(){
							var thisId = $(this).attr('id');
							thisId = thisId.split("-");
							questionAddToTest(thisId[1],data); 							
						});
						
						$(showOptionsId).click(function(){
							var thisId = $(this).attr('id');
							thisId = thisId.split("-");
							showOptions(thisId[1],data);
						});
																			
					}
				}
				
				function questionAddToTest(id,data){
					arrayQuestionId[arrayQuestionId.length] = id;
					//alert(arrayQuestionId);
					
					for(var i=0;i<data['Question'].length;i++){
						if(id == data['Question'][i]['ID']){
							questionText = data['Question'][i]['QuestionText'];
							break;
						}
					}
					var questionDiv = '#question'+id;
					var questionUseId = '#questionUse-'+id;
					$(questionDiv).slideUp();
					//$(questionUseId).empty();
					$('#selectedQuestions').append(
							"<div id=questionSel"+ id + ">" + 'Q : ' + questionText 
							+ "<a id =questionRemove-"+ id + " href='#' class = 'pull-right'>Remove</a>"
							+"</div>"
					);
					var questionRemoveId = '#questionRemove-'+id;
					
					$(questionRemoveId).click(function(){
						var thisId = $(this).attr('id');
						thisId = thisId.split("-");		
						var questionIdToRemove = '#questionSel'+thisId[1];
						var questionIdToShow = '#question'+thisId[1];						
						$(questionIdToRemove).slideUp();
						$(questionIdToShow).slideDown();
						for (var j=0;j<arrayQuestionId.length;j++){
							if(thisId[1]==arrayQuestionId[j]){
								arrayQuestionId.splice(j,1);
							}
						}
					});
					
				}
				
				function showOptions(id,data){
					var showOptionsId = '#showOptions-'+id;
					$(showOptionsId).hide(); 
					for(var i=0;i<data['Question'].length;i++){
						if(id == data['Question'][i]['ID']){
							var questionIndex = i;							
							break;
						}
					}
					var questionDivId = '#question'+id;
					var optionDivId = '#options'+id;
					$(questionDivId).append(
							"<div id =options"+id+" >"+
							"</div>"
					);
					$(optionDivId).hide();
					for(var i=0;i<data['Question'][questionIndex]['Options'].length;i++){
						$(optionDivId).append(
							i+1 +"."+data['Question'][questionIndex]['Options'][i]['OptionText']+" "
							
						);
					}
					$(optionDivId).append(
						"<a href = '#' class = pull-right id =hideOptions-"+id+">Hide Options</a>"
					);
					var hideOptionsId = '#hideOptions-'+id;					
					$(optionDivId).slideDown();
					$(hideOptionsId).click(function(){
						var thisId = $(this).attr('id');
						thisId = thisId.split("-");						
						var divToHideId = '#options'+thisId[1];
						var showOptionsDivVisibleAgain = '#showOptions-'+thisId[1];											
						$(divToHideId).slideUp();
						$(divToHideId).empty();
						$(showOptionsDivVisibleAgain).show();
					});
				}
				
				//New Question Scripts
				$('#addMultipleChoice').click(function(){
					$('#addNewQuestion').hide();
					$('#addNewQuestion').empty();
					$('#addNewQuestion').slideDown();
					$('#addNewQuestion').append(
						"<h4 align='center'>New Multiple Choice Question</h4>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"QuestionText\">Question</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"QuestionText\" name=\"QuestionText\" rows=3 style='width:100%'></textarea>"
							+"</div>"
						+"</div>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"Option1\">Option1</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"Option1\" name=\"Option1\" rows=1 style='width:80%'></textarea>"
								+"<label class=\"radio pull-right\">"
  									+"<input type=\"radio\" name=\"isCorrect\" id=\"isCorrectOption-1\" value=\"option-1\">"
  									+"is Correct"
								+"</label>"								
							+"</div>"								
						+"</div>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"Option2\">Option2</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"Option2\" name=\"Option2\" rows=1 style='width:80%'></textarea>"
								+"<label class=\"radio pull-right\">"
  									+"<input type=\"radio\" name=\"isCorrect\" id=\"isCorrectOption-2\" value=\"option-2\">"
  									+"is Correct"
								+"</label>"
							+"</div>"
						+"</div>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"Option3\">Option3</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"Option3\" name=\"Option3\" rows=1 style='width:80%'></textarea>"
								+"<label class=\"radio pull-right\">"
  									+"<input type=\"radio\" name=\"isCorrect\" id=\"isCorrectOption-3\" value=\"option-3\">"
  									+"is Correct"
								+"</label>"
							+"</div>"
						+"</div>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"Option4\">Option4</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"Option4\" name=\"Option4\" rows=1 style='width:80%'></textarea>"
								+"<label class=\"radio pull-right\">"
  									+"<input type=\"radio\" name=\"isCorrect\" id=\"isCorrectOption-4\" value=\"option-4\">"
  									+"is Correct"
								+"</label>"
							+"</div>"
						+"</div>"
						+"<div class='pull-right'>"
						+"<input type='hidden' id='QuestionType' name='QuestionType' value='MCQ'>"
						 +"<a href='#' class ='btn btn-success' id='postMultipleChoice'>Add..</a>"
						+"</div>"
					);
					
					$('#postMultipleChoice').click(function(){
						var QuestionText = $('#QuestionText').val();
						var Option1 = $('#Option1').val();
						var Option2 = $('#Option2').val();
						var Option3 = $('#Option3').val();
						var Option4 = $('#Option4').val();
						for (var i =0;i<4;i++){
							isCorrectId = '#isCorrectOption-'+i;
							if($(isCorrectId).attr('checked')){
								var isCorrect = i;
								break;		
							}
						}																		
						addNewQuestionMCQ(QuestionText,Option1,Option2,Option3,Option4,isCorrect);
						$('#addNewQuestion').slideUp();						
					});
				});
				$('#addTrueFalse').click(function(){
					$('#addNewQuestion').hide();
					$('#addNewQuestion').empty();
					$('#addNewQuestion').slideDown();
					$('#addNewQuestion').append(
						"<h4 align='center'>New True/False Question</h4>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"QuestionText\">Question</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"QuestionText\" name=\"QuestionText\" rows=3 style='width:100%'></textarea>"
							+"</div>"
						+"</div>"
						+"<label class=\"radio\">"
  							+"<input type=\"radio\" name=\"isCorrect\" id=\"True\" value=\"true\">"
  							+"True"
						+"</label>"
						+"<label class=\"radio\">"
  							+"<input type=\"radio\" name=\"isCorrect\" id=\"False\" value=\"true\">"
  							+"False"
						+"</label>"
						+"<div class='pull-right'>"
						+"<input type='hidden' id='QuestionType' name='QuestionType' value='T/F'>"
						 +"<a href='#' class ='btn btn-success' id='postTrueFalse'>Add..</a>"
						+"</div>"		
					);
					$('#postTrueFalse').click(function(){
						var QuestionText = $('#QuestionText').val();
						var isTrue = $('#True').attr('checked');											
						addNewQuestionTF(QuestionText,isTrue);
						$('#addNewQuestion').slideUp();
					});
				});
				$('#addDescriptive').click(function(){
					$('#addNewQuestion').hide();
					$('#addNewQuestion').empty();
					$('#addNewQuestion').slideDown();
					$('#addNewQuestion').append(
						"<h4 align='center'>New Descriptive Question</h4>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"QuestionText\">Question</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"QuestionText\" name=\"QuestionText\" rows=3 style='width:100%'></textarea>"
							+"</div>"
						+"</div>"						
						+"<div class='pull-right'>"
						+"<input type='hidden' id='QuestionType' name='QuestionType' value='Descriptive'>"
						 +"<a href='#' class ='btn btn-success' id='postDescriptive'>Add..</a>"
						+"</div>"		
					);
					$('#postDescriptive').click(function(){
						var QuestionText = $('#QuestionText').val();																	
						addNewQuestionDescriptive(QuestionText);
						$('#addNewQuestion').slideUp();
					});
				});
				$('#addAudio').click(function(){
					$('#addNewQuestion').hide();
					$('#addNewQuestion').empty();
					$('#addNewQuestion').slideDown();
					$('#addNewQuestion').append(
						"<h4 align='center'>New Audio Question</h4>"
						+"<div class=\"control-group\">"
							+"<label class=\"control-label\" for=\"QuestionText\">Question</label>"
							+"<div class=\"controls\">"
								+"<textarea id=\"QuestionText\" name=\"QuestionText\" rows=3 style='width:100%'></textarea>"
							+"</div>"
						+"</div>"						
						+"<div class='pull-right'>"
						+"<input type='hidden' id='QuestionType' name='QuestionType' value='Audio'>"
						 +"<a href='#' class ='btn btn-success' id='postAudio'>Add..</a>"
						+"</div>"		
					);
					$('#postAudio').click(function(){
						var QuestionText = $('#QuestionText').val();																	
						addNewQuestionAudio(QuestionText);
						$('#addNewQuestion').slideUp();
					});
				});
				
				function addNewQuestionTF(QuestionText,isTrue){
					
					arrayOptionCorrect = new Array();
					arrayOptions = new Array();
					if(isTrue){
						 arrayOptionCorrect[0] = 1;
						 arrayOptionCorrect[1] = 0;
					}											
					else{
						 arrayOptionCorrect[0] = 0;
						 arrayOptionCorrect[1] = 1;
					} 
					optionTrueObj = {OptionText:"True",isCorrect:arrayOptionCorrect[0]};	
					optionFalseObj = {OptionText:"False",isCorrect:arrayOptionCorrect[1]};
					arrayOptions[arrayOptions.length] = optionTrueObj;
					arrayOptions[arrayOptions.length] = optionFalseObj;
					objQuestion = {QuestionTempId:arrayAddedQuestion.length,QuestionText:QuestionText,QuestionType:"MCQ",Options:arrayOptions,CreatedByUserId:UserId,SubCategoryId:SubCategoryId};
					arrayAddedQuestion[arrayAddedQuestion.length] = objQuestion;
					showNewQuestion(objQuestion);	
				}
				
				function addNewQuestionDescriptive(QuestionText){
					
					objQuestion = {QuestionTempId:arrayAddedQuestion.length,QuestionText:QuestionText,QuestionType:"Descriptive",Options:'',CreatedByUserId:UserId,SubCategoryId:SubCategoryId};
					arrayAddedQuestion[arrayAddedQuestion.length] = objQuestion;
					showNewQuestion(objQuestion);	
				}
				
				function addNewQuestionAudio(QuestionText){
					
					objQuestion = {QuestionTempId:arrayAddedQuestion.length,QuestionText:QuestionText,QuestionType:"Audio",Options:'',CreatedByUserId:UserId,SubCategoryId:SubCategoryId};
					arrayAddedQuestion[arrayAddedQuestion.length] = objQuestion;
					showNewQuestion(objQuestion);	
				}
				
				function addNewQuestionMCQ(QuestionText,Option1,Option2,Option3,Option4,isCorrect){
					arrayOptionCorrect = new Array();
					arrayOptions = new Array();
					
					for (var i=0;i<4;i++){
						if(i==isCorrect-1)
							arrayOptionCorrect[i] = 1;
						else
							arrayOptionCorrect[i] = 0;
					}
					objOption1 = {OptionText:Option1,isCorrect:arrayOptionCorrect[0]};
					objOption2 = {OptionText:Option2,isCorrect:arrayOptionCorrect[1]};
					objOption3 = {OptionText:Option3,isCorrect:arrayOptionCorrect[2]};
					objOption4 = {OptionText:Option4,isCorrect:arrayOptionCorrect[3]};
					arrayOptions[0] = objOption1;
					arrayOptions[1] = objOption2;
					arrayOptions[2] = objOption3;
					arrayOptions[3] = objOption4;
					objQuestion = {QuestionTempId:arrayAddedQuestion.length,QuestionText:QuestionText,QuestionType:"MCQ",Options:arrayOptions,CreatedByUserId:UserId,SubCategoryId:SubCategoryId};
					arrayAddedQuestion[arrayAddedQuestion.length] = objQuestion;
					showNewQuestion(objQuestion);	
				}
				
				function showNewQuestion(objQuestion){
					$('#selectedQuestions').append(
							"<div id=newQuestionSel"+ objQuestion.QuestionTempId + ">" + 'Q : ' + objQuestion.QuestionText  
							+ "<a id =newQuestionRemove-"+ objQuestion.QuestionTempId + " href='#' class = 'pull-right'>Remove</a>"
							+"</div>"
					);
					var questionRemoveId = '#newQuestionRemove-'+objQuestion.QuestionTempId;
					
					$(questionRemoveId).click(function(){
						var thisId = $(this).attr('id');
						thisId = thisId.split("-");		
						var questionIdToRemove = '#newQuestionSel'+thisId[1];
						$(questionIdToRemove).slideUp();
						for(var i =0; i<arrayAddedQuestion.length; i++){
							if(thisId[1]==arrayAddedQuestion[i]['QuestionTempId'])
								break;
						}			
						arrayAddedQuestion.splice(i,1);			
					});
										
					$.ajax({
						url : '../LI.Services/InsertNewQuestionGetQuestionId.php',
						type : 'POST',
						data : {							
							Question:JSON.stringify(objQuestion),					
						},
						//dataType : 'json',

						success : function(data) {
							//response=data;
							//alert(data);
							arrayQuestionId[arrayQuestionId.length] = data;
						},
						error : function(jxhr) {
							alert(" Test not posted");
						}

					});
					
				}
				
				$('#submitTest').click(function(){
					//alert(JSON.stringify(arrayQuestionId));
					var testTitle = $('#testTitle').val();					
					$.ajax({
						url : '../LI.Services/postNewTest.php',
						type : 'POST',
						data : {
							testTitle:testTitle,
							SubCategoryId:SubCategoryId,
							arrayQuestionId:JSON.stringify(arrayQuestionId),
							UserId:UserId  												
						},
						//dataType : 'json',

						success : function(data) {
							response=data;
							alert(data);
						},
						error : function(jxhr) {
							alert(" Test not posted");

						}

        			});
					
				});
								
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
  </div><br/>
  <div id = "subCategoryId" style="display: none">3</div> <!-- to be brought from php -->
  <div id = "userId" style="display: none">62</div> <!-- to be brought from php -->
  <div class="container-fluid">
  	
  	<div class="row-fluid">
  		<div class="well span6" id="aq">
  			<h4>Available Questions for this category</h4>
  			<div id="availableQuestions">
  				
  			</div>
  		</div>
  		<div class="well span6">
  			<h4>Questions selected in your test <a href='#' id='submitTest' class='btn btn-success pull-right'>Done</a><input class="pull-right" type ='text' id='testTitle' placeholder="Test Title, Duration"></h4><br/>
  			<div id = "selectedQuestions">
  				
  			</div>
  		</div>
  	</div>
  	<div class="row-fluid">
  	<div class = "well span3">
  		<h4>Add a new Question..</h4><br/>
  		  	<a href='#' id='addMultipleChoice' class = 'btn btn-success'>Multiple Choice</a><br/><br/>	
  		  	<a href='#' id='addTrueFalse' class = 'btn btn-success'>True/False</a><br/><br/>
  		  	<a href='#' id='addDescriptive' class = 'btn btn-success'>Descriptive</a><br/><br/>
  		  	<a href='#' id='addAudio' class = 'btn btn-success'>Audio</a><br/><br/>
  	</div>
  	<div class = "well span9" id='addNewQuestion' style='display: none'>
  		
  	</div>
  	</div>
  </div>
  
</body>
</html>