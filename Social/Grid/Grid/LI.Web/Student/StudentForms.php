<?php
	
	include '../../Utilities/Utilities.php';
	$colleges=Utilities::GetHTMLDropdownFromListwithCondition("College",$_GET["LocationID"]);
	echo $colleges; ?>
	<input type="text" class="input-mini" name="txt_college_marks" id="txt_college_marks" value="" required="required" onfocusout="confirmPass()">
