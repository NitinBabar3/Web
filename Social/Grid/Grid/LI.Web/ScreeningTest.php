<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <title>Screening Test</title>


<script language="javascript" type="text/javascript" src="scripts/jquery-1.6.min.js"></script> <!-- jQuery JavaScript library. -->
<script language="javascript" type="text/javascript" src="scripts/screeningTest.js"></script> <!-- custom ScreeningTest jquery library. -->
<!-- <link type="text/css" href="jqueryUI/css/start/jquery-ui-1.8.18.custom.css" rel="Stylesheet" />	
<script type="text/javascript" src="jqueryUI/js/jquery-ui-1.8.18.custom.min.js"></script> -->


<script type="text/javascript">

    $(document).ready(function(){
        
       startTest(1);
        
        
    });
    

</script>
    
	<link href="css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    
</head>


<body>

<div class="container" style="padding-top:50px;">

		<div class="row">
		
		<div class="span6 offset3 hero-unit"><h3 id="QuestionDisplay">What do you wanna do Today ?</h3></div>
		
		</div>

					<div class="row">
												<!-- Options Display -->
												<div id="MCQDisplay" class="span6 offset3 well">
												<label class="radio">
												<input type="radio" value="Option1" class="radio" name="MCQOptionRadios"/>Option1
												</label>
												
												<label class="radio">
												<input type="radio" value="Option2" name="MCQOptionRadios"/>Option2
												</label>
												
												<label class="radio">
												<input type="radio" value="Option3" name="MCQOptionRadios"/>Option3
												</label>
												
												<label class="radio">
												<input type="radio" value="Option4" name="MCQOptionRadios"/>Option4
												</label>
												</div>
												
												<!-- Options Display Ends -->


												<!-- True False Div Starts -->
												
												<div id="TrueFalseDisplay" class="span6 offset3 well">
												<label class="radio">
												<input type="radio" value="Option1" class="radio" name="TFOptionRadios"/>True
												</label>
												
												<br/>
												
												<label class="radio">
												<input type="radio" value="Option1" class="radio" name="TFOptionRadios"/>False
												</label>
												
												</div>
												<!-- True False Div Ends -->
												
												<!-- Descriptive Div Starts -->
												
												<div id="DescriptiveDisplay" class="span6 offset3 well">
												<label class="control-label" for="descTextArea">
												
												<textarea class="input-xxlarge" id="descTextArea" rows="4">
												</textarea>
												
												
												</label>												
												</div>

												
												<!-- Descriptive Div Ends -->
												
												<div id="TestNavigation" class="span6 offset3">
												<input type="button" class="btn btn-primary pull-right" value="Next"/>
												<input type="button" class="btn btn-primary disabled pull-right" value="Previous"/>&nbsp;
												
												
												</div>

		
		
		</div>

		



</div>
</body>
</html>

    
<?php

/*
 * To change this template, choose Tools | Templates
 * an
 *
 */





?>
