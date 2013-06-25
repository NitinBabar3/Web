<!DOCTYPE html>
<html>
<head>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#tabs").tabs();
  });
  </script>
</head>
<body style="font-size:62.5%;">
  
<div id="tabs">
    <ul>
        <li><a href="#fragment-1"><span>Jobs</span></a></li>
        <li><a href="#fragment-2"><span>Resources</span></a></li>
        <li><a href="#fragment-3"><span>Lets</span></a></li>
    </ul>
    <div id="fragment-1">
        <p>
		<?php
		$JobsData=Utilities::GetEmployerJobs();
		$getlist= MySQLDataAdapter::Query($JobsData);
		while($row = mysql_fetch_array($getlist))
		{
			echo $row["CompanyName"]." posted a job in ".$row["description"]." . Know more about this job <a href='test.php?JobID=".$row["ID"]."' target='_new'>here</a><br>";
		}
			
		?>
		</p>
       
    </div>
    <div id="fragment-2">
        
    </div>
    <div id="fragment-3">
    </div>
</div>
</body>
</html>