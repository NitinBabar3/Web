<?php
include '../Utilities/Utilities.php';
?>
<html>
<head>
  <link href="css/jquerycss.css" rel="stylesheet" type="text/css"/>
  <script src="scripts/jquery.js"></script>
  <script src="scripts/jqueryui.js"></script>  

<script>
	$(function() {
		$( "#accordion" ).accordion();
		fillspace: true;
		autoheight:false;
	});
	</script>
        
        <script type ="text/javascript">
            function changetextboxproperty(thisId){
                document.getElementById(thisId).value = '';
                document.getElementById(thisId).style.color='#000000';
            }
            
        </script>
        
        <title>Employer Sign Up Page</title>
</head>

<body>
<div class="demo">
To sign up follow three simple steps..<br/><br>
<div id="accordion">
	<h3><a href="#">Step 1</a></h3>
	<div>
		<p>
                <form name="EmployerSignUpForm" method="post" action="NewEmployer.php" enctype="multipart/form-data">
                    Company Name<input type="text" id="input1" name="CompanyName" value="Eg. Facebook.com" onfocus="changetextboxproperty('input1')" style ="color:#cccccc"/><br/><br/>
                    Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" id="input2" name="Description" value="Eg. A social netwoking platform connecting people across the world!" onfocus="changetextboxproperty('input2')" style ="color:#cccccc;width:1000px;"/><br/><br/>
                    Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type ="text" id ="input3" name="Email" value="Eg. xyz@companydomain.com" onfocus="changetextboxproperty('input3')" style ="color:#cccccc;"/><br/><br/>
                    Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type ="password" name ="Password"/>
                    Contact Person<input type ="text"  name="ContactPerson" /><br/>
                    Contact Number<input type ="text"  name="ContactNo" /><br/>
		</p>
	</div>
	<h3><a href="#">Step 2</a></h3>
	<div>
		<p>
                    <?
                        $company_type_list = Utilities::GetListFromTableByParameter('company', 'CompanyType');
                        echo "<br/>Company Type&nbsp;".Utilities::GetHTMLDropdownFromList($company_type_list, "CompanyTypeId")."<br/><br/>";
                        $industry_type_list = Utilities::GetListFromTableByParameter('industry','IndustryType');
                        echo "<br/>Domain&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".Utilities::GetHTMLDropdownFromList($industry_type_list, "Industry");
                        $city_list = Utilities::GetListFromTableByParameter('location','CityName');
                        echo "<br/><br/>Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".Utilities::GetHTMLMultipleListFromList($city_list, "location");
                    ?>
                    
		
		</p>
	</div>
	<h3><a href="#">Step 3</a></h3>
	<div>
		<p>
                    Website <input type="text" id="input4" name="Website" value="Eg. mywebsite.com" onfocus="changetextboxproperty('input4')" style ="color:#cccccc;width:350px;"/><br/><br/>		
                    <br/><br/>
                    Logo&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type ="file" name="logo">
                    <br/><br/>
                    <button type="submit">Submit</button>
		</p>
		
        </form>
	</div>

</div>

</div><!-- End demo -->
</body>
</html>