<?
//author letstech01


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
        
        <script>
        var response;
        	$(document).ready(function(){        		        	
        		$('#loadLITest').click(function(){
        			var SubCategoryId = $('#subCategoryId').text();        			
        			$.ajax({
						url : '../LI.Services/liTestTemplateSource.php',
						type : 'GET',
						data : {
							SubCategoryId:SubCategoryId,					
						},
						dataType : 'json',

						success : function(data) {
							response = data;
							$('#loadLITest').empty();
							$('#loadLITestDiv').html("Test provided by LetsIntern");							
							for(var i=0;i<data.length;i++){
									var divTagId = '#liTemplateDiv'+i;
									var anchorTagId = '#liTemplateAnchor-'+i;
									jQuery('<div/>', {
		    								id: 'liTemplateDiv'+i,
		    								    								
										}).appendTo('#loadLITestDiv');
									jQuery('<a/>', {
    									id: 'liTemplateAnchor-'+i,
    									role: 'button',
    									class: 'btn btn-success',
    									title: 'LI Template',
    									rel: 'external',
    									text: data[i]['TestTitle'],
    									    								
									}).appendTo(divTagId);
									
									$(anchorTagId).click(function(){
										$('#loadedTest').empty();
										var thisId = $(this).attr('id');
										thisId = thisId.split("-");																								
										fillTestTemplateDetails(data[thisId[1]]);
									});
							}
						},
						error : function(jxhr) {
							alert(" No Templates available for this selection");

						}

        			});
        		});
        		function fillTestTemplateDetails(data){
        			
        			jQuery('<div/>', {        	
        				id: 'testTitle',			
						text: data['TestTitle'], 									    								
					}).appendTo('#loadedTest');
					jQuery('<div/>', {        				
						text: 'Duration : ' + data['Duration'],
						class: "pull-right", 									    								
					}).appendTo('#testTitle');
										
					var i =0;
					for(var i=0;i<data['Question'].length;i++){
						jQuery('<div/>', {        	        				
							text: 'Q : ' + data['Question'][i]['QuestionText'],
							id: 'question'+i, 									    								
						}).appendTo('#loadedTest');
						var questionDivId = '#question'+i;						
						if (data['Question'][i]['QuestionType'] == "MCQ"){
							for(var j=0;j<data['Question'][i]['Options'].length;j++){
								jQuery('<div/>', { 
									id: 'option'+i+j,       	        				
									text: (j+1) + '.' + data['Question'][i]['Options'][j]['OptionText'], 									    								
								}).appendTo(questionDivId);
									
							}
							
						}
						
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
  <div id = "subCategoryId" style="display: none">3</div> <!-- to be brought from php -->
  <div class = "container" >
  	<div class="row">
  		<div class="span3">
  			<a id="loadMyTest" href="#">Load My Tests</a>
  		</div>
  		<div class = "span3" id="loadLITestDiv">
  			<a id="loadLITest" href="#">Load LetsIntern Tests</a>
  			<div id="liTestTitles">
  				
  			</div>
  		</div>
  		<div id="loadedTest" class="span6">
  			
  		</div>
  		
  	</div>
  </div>
  
</body>
</html>