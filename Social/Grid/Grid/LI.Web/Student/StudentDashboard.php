<!-- saved from url=(0050)http://wbpreview.com/previews/WB00958H8/index.html -->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">  	
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Lets Intern - Student Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HTML5 Admin Simplenso Template">
  <meta name="author" content="ahoekie">

<?php 
	 
	  include("bootstrap_lib.php");
      
?>
  <!-- Bootstrap -->
  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
 <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Rating', 80]
        ]);

        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>

<body>
	<?php include("bootstrap_lib.php");
		  include("studentHeader.php");
		 
		  include Business_Path.'StudentManagement.php';
		   //$get_data=array('uid, last_name, first_name','contact_email','education_history','relationship_status','sex','work_history');
	$user_details = $facebook->api_client->users_getInfo($user_id, 'uid, last_name, first_name,contact_email,sex,birthday');
	
	
	
	//$user_details = $facebook->api_client->users_getInfo($user_id, 'uid', 'last_name', 'first_name','email');
	$user_location = $facebook->api_client->users_getInfo($user_id, 'current_location');
	$user_education = $facebook->api_client->users_getInfo($user_id, 'education_history');
	$user_work_history = $facebook->api_client->users_getInfo($user_id, 'work_history');
	
	$fb_user_id = $user_details[0]["uid"];
	$fb_first_name = $user_details[0]["first_name"];
	$fb_last_name =  $user_details[0]["last_name"];
	$user_email=$user_details[0]["contact_email"];
	$fb_sex =  $user_details[0]["sex"];
	$fb_bday =  $user_details[0]["birthday"];
	//echo $user_email."-".$fb_bday;
	$user_email =  $user_details[0]["contact_email"];
	$user_city=$user_location[0]["current_location"]["city"];
    $studentdata=Utilities::GetStudentInfo($fb_user_id);
	$studentcollegedata=Utilities::GetStudentCollegeInfo($studentdata[0]);
	//print_r($studentcollegedata);
  
	?>
<!-- BodyContent starting from here which should start after the next(or in this case after the code it will become the last) div-->
	<div class="container-fluid" >
    <div class="member-box round-all"> 
        <a>
		<?php if($studentdata[7]!="") {
		?>
		<img src="<?php echo ParentPath;?>images/students/<?php echo $studentdata[7];?>"  height="90" width="90" border="0"/>
		<?php
		}
		else
		{
		?>
		<img src="http://graph.facebook.com/<?php echo $fb_user_id;?>/picture?type=large" width="200px" height="225px" class="member-box-avatar"></a>
        <?php 
		}
		?>
        <span class="well pull-right" style="background-color: yellow">
                                <h4 style="color: black"><i class="icon-bell"></i> Reminders</h4>
                                <h5 style="color: #444">Your internship with Viacom18 starts in two days</h5>                                    
                                    
                                </span>
                                <?php 
								if($studentdata["CurrentYear"]=="1")
								{
									$year="First year";
								}
								else if($studentdata["CurrentYear"]=="2")
								{
									$year="Second year";
								}
								else if($studentdata["CurrentYear"]=="3")
								{
									$year="Third year";
								}
								else if($studentdata["CurrentYear"]=="4")
								{
									$year="Final year";
								}
								?>
                                <span class="pull-right" style="padding-right:220px;"><i class="icon-home"></i> <?php echo $year." at ".$studentcollegedata[0]; ?>
                                <span  style="padding-right:40px;"><i class="icon-edit"></i></span>
                                </span>
                                
        <span>
            <strong><?php echo $fb_first_name." ".$fb_last_name; ?></strong><br>
            Commerce Undergraduate<br> Skills : Marketing , Advertising, Communication<br><?php echo $fb_sex; ?>, 19<br><?php echo $user_city; ?><br>
            <span class="member-box-links"><a><i class="icon-edit"></i><A href="EditProfile.php">Edit Profile</a></span> <br>
            <br>
            <span style="padding-left:200px;">
            Trainings Attended: 12 | Internships : 12 | Tasks : 44 | Virtual Internships : 8
			| Current Status :
			<?php 
			
			 $objapplication=new Student();
			 $objapplication->FacebookId=$fb_user_id;
			 
			 $status=Utilities::GetStudentStatus($objapplication);
			 //print_r($status);
			 //echo  $status["Status"];	
			 if($status["Status"]=="1")
			 {
				echo "Available";
			 }
			 else if ($status["Status"]=="2")
			 {
				echo "Only for jobs";
			 }
			 else if($status["Status"]=="3")
			 {
				echo "Only for tasks";
			 }
			 else if($status["Status"]=="4")
			 {
				echo "Only for internships";
			 }
			
			?> </span>
			<br><br></span></div> 
            </div>
						

<!--                   <div class ="row">
                                        <div class ="span4">
                                             Looking for oppurtunities in
                                             <em><h4> Coding, Advertising, Content Writing</h4></em>
                                        </div>
                                    </div>
                                    <div class ="row">
                                        <div class ="span6">
                                            <br><h4><small>Skills</small> <em>Communication, Marketing, PHP </em></h4>                                       
                                        </div>
                                    </div> -->

		<div class="row-fluid" >
         <div class="span4 column" id="col1">
         	 <!-- Portlet: Browser Usage Graph -->
             <div class="box" id="box-0">
              <h4 class="box-header round-top">Your Peer Activity Distribution
                <!--  <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                                                    <div id="dashboard-browser-chart" style="position: relative; "><div dir="ltr"><svg width="299" height="200" style="overflow: hidden; "><defs id="defs"></defs><g><text text-anchor="start" x="57" y="22.5" font-family="Arial" font-size="10" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Primary Activity of Peers</text></g><g><rect x="187" y="38" width="55" height="100" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><rect x="187" y="38" width="55" height="23" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="46.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Management</text><text text-anchor="start" x="201" y="59.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Social Media</text></g><rect x="187" y="38" width="10" height="10" stroke="none" stroke-width="0" fill="#3366cc"></rect></g><g><rect x="187" y="67" width="55" height="23" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="75.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Engineering - IT</text><text text-anchor="start" x="201" y="88.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Online Tasks</text></g><rect x="187" y="67" width="10" height="10" stroke="none" stroke-width="0" fill="#dc3912"></rect></g><g><rect x="187" y="96" width="55" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="104.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Online Learning</text></g><rect x="187" y="96" width="10" height="10" stroke="none" stroke-width="0" fill="#ff9900"></rect></g><g><rect x="187" y="112" width="55" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="120.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">NGO</text></g><rect x="187" y="112" width="10" height="10" stroke="none" stroke-width="0" fill="#109618"></rect></g><g><rect x="187" y="128" width="55" height="10" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect><g><text text-anchor="start" x="201" y="136.5" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#222222">Volunteering</text></g><rect x="187" y="128" width="10" height="10" stroke="none" stroke-width="0" fill="#990099"></rect></g></g><g><path d="M114,100L114,43A57,57,0,0,1,128.75268557084368,155.0577720984769L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#3366cc"></path><text text-anchor="start" x="130.11143710962384" y="99.40410160098483" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">45.8%</text></g><g><path d="M114,100L58.94222790152311,114.7526855708437A57,57,0,0,1,114,43L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#990099"></path><text text-anchor="start" x="73.79415792470047" y="84.15887712088707" font-family="Arial" font-size="10" stroke="none" stroke-width="0" fill="#ffffff">29.2%</text></g><g><path d="M114,100L73.69491347236679,140.30508652763322A57,57,0,0,1,58.94222790152311,114.7526855708437L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#109618"></path></g><g><path d="M114,100L99.24731442915632,155.0577720984769A57,57,0,0,1,73.69491347236679,140.30508652763322L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#ff9900"></path></g><g><path d="M114,100L128.75268557084368,155.0577720984769A57,57,0,0,1,99.24731442915632,155.0577720984769L114,100A0,0,0,0,0,114,100" stroke="#ffffff" stroke-width="1" fill="#dc3912"></path></g><g></g></svg></div><div></div></div>
                  </div>
              </div>
            </div><!--/span-->
         </div>
         
                <!-- Portlet Set 5 -->
        
        <!-- Portlet Set 6 -->
		<div class="span4 column ui-sortable" id="col6">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-5">
              <h4 class="box-header round-top">Suggested Learning Resources
                 <!-- <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <ul class="dashboard-member-activity">
                      <li>
                        <a href="#">
                          <img src="images/member_ph.png" class="dashboard-member-activity-avatar">
                          <span class="blue">Ehance Communication Skills by <strong>Rajesh Nambiar</strong> on 21/07/2012</span></a>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum, est at congue gravida...</p>                                
                        
                      </li>
                      <li>
                        <a href="#">
                          <img src="images/member_ph.png" class="dashboard-member-activity-avatar">
                          <span class="blue">Accounting Basics by <strong>LetsIntern</strong> on 21/07/2012</span></a>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum, est at congue gravida...</p>                                
                        
                      </li>
                    </ul>
                  </div>
              </div>
            </div><!--/span-->
         </div>
         
         
         <div class="span4 column ui-sortable" id="col6">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-5">
              <h4 class="box-header round-top">Professional Readiness Rating
                 <!-- <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                  <span id="chart_div"></span>
				  <span class="pull-right"><strong>You Profile Rating </strong></span> 
                  </div>
              </div>
            </div><!--/span-->
         </div>

         
         
      
        

           </div>
           
     <div class="row-fluid">
      	 <!-- Portlet Set 1 -->
        
 <div class="span4 column ui-sortable" id="col5">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-4">
              <h4 class="box-header round-top">Suggested Work Opportunities
<!--                  <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>-->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <ul class="dashboard-statistics">
                      <li>
                        <a href="#">
                          <i class="icon-arrow-up"></i>                               
                          <span class="green">10</span>
                          Internships in Advertising, Marketing      
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-arrow-down"></i>
                          <span class="red">12</span>
                          Tasks in Content Writing
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-minus"></i>
                          <span class="blue">34</span>
                          Open Jobs in New Delhi                                    
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-fire"></i>
                          <span class="yellow">1</span>
							Brand Ambassodor           
                        </a>
                      </li>
                   
                    </ul>
                  </div>
              </div>
            </div><!--/span-->
        </div>     
        
<div class="span4 column ui-sortable" id="col6">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-5">
              <h4 class="box-header round-top">Employers You Follow
                 <!-- <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a> -->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <ul class="dashboard-member-activity">
                      <li>
                        <a href="#">
                          <img src="images/member_ph.png" class="dashboard-member-activity-avatar">
                          <span class="blue">Internship posted by <strong>Ernst &amp; Young</strong> on 21/07/2012</span></a>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum, est at congue gravida...</p>                                
                        
                      </li>
                      <li>
                        <a href="#">
                          <img src="images/member_ph.png" class="dashboard-member-activity-avatar">
                          <span class="blue">Calling for Volunteers <strong>Channel V</strong> on 21/07/2012</span></a>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum, est at congue gravida...</p>                                
                        
                      </li>
                    </ul>
                  </div>
              </div>
            </div><!--/span-->
         </div>

 
         <!-- Portlet Set 2 -->
      

      	 <!-- Portlet Set 3 -->
         <div class="span4 column ui-sortable" id="col3">
             <!-- Portlet: Site Activity Gauges -->
             <div class="box" id="box-2">
              <h4 class="box-header round-top">Trending Job Types - August 2012
                  <!--<a class="box-btn" title="close"><i class="icon-remove"></i></a>
                  <a class="box-btn" title="toggle"><i class="icon-minus"></i></a>     
                  <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>-->
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <div id="dashboard-new-registrations-gauge-chart" style="position: relative; height: 174px; "><table style="border: 0px; padding: 0px; margin: 0px; " cellpadding="2" cellspacing="0" align="center"><tbody><tr style="border: 0px; padding: 0px; margin: 0px; "><td style="border: 0px; padding: 0px; margin: 0px; width: 95px; "><div dir="ltr"><svg width="95" height="95" style="overflow: hidden; "><defs id="defs"></defs><g><circle cx="47" cy="47" r="43" stroke="#333333" stroke-width="1" fill="#cccccc"></circle><circle cx="47" cy="47" r="38" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"></circle><path d="M78.91190410538375,34.48876329958696A34,34,0,0,1,79.83592155403522,58.00657780874821L71.75194116552642,55.37993335656115A25.5,25.5,0,0,0,71.05892807903781,37.74157247469021Z" stroke="none" stroke-width="0" fill="#ff9900"></path><path d="M79.83592155403522,58.006577808748204A34,34,0,0,1,71.54163056034261,71.54163056034261L65.53122292025698,65.53122292025694A25.5,25.5,0,0,0,71.75194116552642,55.37993335656116Z" stroke="none" stroke-width="0" fill="#dc3912"></path><text text-anchor="middle" x="47.5" y="39" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#333333">Internships</text><text text-anchor="start" x="30.034462504692275" y="66.71553749530773" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="64.96553749530774" y="66.7155374953077" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">100</text><path d="M21.40921097076478,63.48845608030804L18.510234411960866,65.26495120034227M18.3976706013683,56.9559200278734L15.164078445964783,58.00657780874822M16.994329587766284,49.90084832927206L13.604810653073649,50.16760925474673M17.276736777788784,42.71310536976894L13.918596419765315,42.181228188632154M22.744079972126602,29.513771279850324L19.99342219125178,27.515301422055916M27.626889721096365,24.231577452639062L25.41876635677374,21.64619716959896M33.607890707969865,20.235200359835943L32.0643230088554,17.205778177595494M40.356571866009304,17.74548043583109L39.56285762889922,14.439422706478993M54.64342813399069,17.74548043583109L55.43714237110076,14.439422706478993M61.39210929203013,20.23520035983594L62.93567699114459,17.20577817759549M67.37311027890362,24.231577452639055L69.58123364322626,21.646197169598953M72.25592002787339,29.513771279850314L75.0065778087482,27.515301422055906M77.72326322221122,42.713105369768925L81.08140358023468,42.18122818863214M78.00567041223371,49.90084832927204L81.39518934692636,50.16760925474671M76.6023293986317,56.95592002787338L79.83592155403522,58.006577808748204M73.59078902923524,63.48845608030802L76.48976558803915,65.26495120034224" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"></path><path d="M28.266695551725906,66.7333044482741L23.458369439657385,71.54163056034261M22.37047671569299,37.09101063966957L16.088095894616245,34.488763299586964M47.49999999999999,20.299999999999997L47.49999999999999,13.5M72.629523284307,37.09101063966956L78.91190410538375,34.48876329958696M66.73330444827411,66.73330444827407L71.54163056034264,71.54163056034258" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"></path><g><text text-anchor="middle" x="47.5" y="77" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">80</text><path d="M79.10602689904441,42.4940971187126C47.87231402679575,49.850698250616425,37.8092736074465,50.23969377571053,37.623116594048625,49.06434465040231C37.43695958065075,47.888995525094096,47.12768597320425,45.149301749383575,79.10602689904441,42.4940971187126" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"></path><circle cx="47" cy="47" r="5" stroke="#666666" stroke-width="1" fill="#4684ee"></circle></g></g></svg></div><div></div></td><td style="border: 0px; padding: 0px; margin: 0px; width: 95px; "><div dir="ltr"><svg width="95" height="95" style="overflow: hidden; "><defs id="defs"></defs><g><circle cx="47" cy="47" r="43" stroke="#333333" stroke-width="1" fill="#cccccc"></circle><circle cx="47" cy="47" r="38" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"></circle><path d="M78.91190410538375,34.48876329958696A34,34,0,0,1,79.83592155403522,58.00657780874821L71.75194116552642,55.37993335656115A25.5,25.5,0,0,0,71.05892807903781,37.74157247469021Z" stroke="none" stroke-width="0" fill="#ff9900"></path><path d="M79.83592155403522,58.006577808748204A34,34,0,0,1,71.54163056034261,71.54163056034261L65.53122292025698,65.53122292025694A25.5,25.5,0,0,0,71.75194116552642,55.37993335656116Z" stroke="none" stroke-width="0" fill="#dc3912"></path><text text-anchor="middle" x="47.5" y="39" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#333333">Tasks</text><text text-anchor="start" x="30.034462504692275" y="66.71553749530773" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="64.96553749530774" y="66.7155374953077" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">100</text><path d="M21.40921097076478,63.48845608030804L18.510234411960866,65.26495120034227M18.3976706013683,56.9559200278734L15.164078445964783,58.00657780874822M16.994329587766284,49.90084832927206L13.604810653073649,50.16760925474673M17.276736777788784,42.71310536976894L13.918596419765315,42.181228188632154M22.744079972126602,29.513771279850324L19.99342219125178,27.515301422055916M27.626889721096365,24.231577452639062L25.41876635677374,21.64619716959896M33.607890707969865,20.235200359835943L32.0643230088554,17.205778177595494M40.356571866009304,17.74548043583109L39.56285762889922,14.439422706478993M54.64342813399069,17.74548043583109L55.43714237110076,14.439422706478993M61.39210929203013,20.23520035983594L62.93567699114459,17.20577817759549M67.37311027890362,24.231577452639055L69.58123364322626,21.646197169598953M72.25592002787339,29.513771279850314L75.0065778087482,27.515301422055906M77.72326322221122,42.713105369768925L81.08140358023468,42.18122818863214M78.00567041223371,49.90084832927204L81.39518934692636,50.16760925474671M76.6023293986317,56.95592002787338L79.83592155403522,58.006577808748204M73.59078902923524,63.48845608030802L76.48976558803915,65.26495120034224" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"></path><path d="M28.266695551725906,66.7333044482741L23.458369439657385,71.54163056034261M22.37047671569299,37.09101063966957L16.088095894616245,34.488763299586964M47.49999999999999,20.299999999999997L47.49999999999999,13.5M72.629523284307,37.09101063966956L78.91190410538375,34.48876329958696M66.73330444827411,66.73330444827407L71.54163056034264,71.54163056034258" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"></path><g><text text-anchor="middle" x="47.5" y="77" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">55</text><path d="M54.970251643388956,16.384162547274343C49.81424041054647,48.05559996597705,46.32266656671419,57.50149918696529,45.16554636144095,57.223699203976764C44.008426156167715,56.94589922098824,45.18575958945353,46.94440003402295,54.970251643388956,16.384162547274343" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"></path><circle cx="47" cy="47" r="5" stroke="#666666" stroke-width="1" fill="#4684ee"></circle></g></g></svg></div><div></div></td><td style="border: 0px; padding: 0px; margin: 0px; width: 95px; "><div dir="ltr"><svg width="95" height="95" style="overflow: hidden; "><defs id="defs"></defs><g><circle cx="47" cy="47" r="43" stroke="#333333" stroke-width="1" fill="#cccccc"></circle><circle cx="47" cy="47" r="38" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"></circle><path d="M78.91190410538375,34.48876329958696A34,34,0,0,1,79.83592155403522,58.00657780874821L71.75194116552642,55.37993335656115A25.5,25.5,0,0,0,71.05892807903781,37.74157247469021Z" stroke="none" stroke-width="0" fill="#ff9900"></path><path d="M79.83592155403522,58.006577808748204A34,34,0,0,1,71.54163056034261,71.54163056034261L65.53122292025698,65.53122292025694A25.5,25.5,0,0,0,71.75194116552642,55.37993335656116Z" stroke="none" stroke-width="0" fill="#dc3912"></path><text text-anchor="middle" x="47.5" y="39" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#333333">Brand Ambassador</text><text text-anchor="start" x="30.034462504692275" y="66.71553749530773" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="64.96553749530774" y="66.7155374953077" font-family="arial" font-size="5" stroke="none" stroke-width="0" fill="#333333">100</text><path d="M21.40921097076478,63.48845608030804L18.510234411960866,65.26495120034227M18.3976706013683,56.9559200278734L15.164078445964783,58.00657780874822M16.994329587766284,49.90084832927206L13.604810653073649,50.16760925474673M17.276736777788784,42.71310536976894L13.918596419765315,42.181228188632154M22.744079972126602,29.513771279850324L19.99342219125178,27.515301422055916M27.626889721096365,24.231577452639062L25.41876635677374,21.64619716959896M33.607890707969865,20.235200359835943L32.0643230088554,17.205778177595494M40.356571866009304,17.74548043583109L39.56285762889922,14.439422706478993M54.64342813399069,17.74548043583109L55.43714237110076,14.439422706478993M61.39210929203013,20.23520035983594L62.93567699114459,17.20577817759549M67.37311027890362,24.231577452639055L69.58123364322626,21.646197169598953M72.25592002787339,29.513771279850314L75.0065778087482,27.515301422055906M77.72326322221122,42.713105369768925L81.08140358023468,42.18122818863214M78.00567041223371,49.90084832927204L81.39518934692636,50.16760925474671M76.6023293986317,56.95592002787338L79.83592155403522,58.006577808748204M73.59078902923524,63.48845608030802L76.48976558803915,65.26495120034224" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"></path><path d="M28.266695551725906,66.7333044482741L23.458369439657385,71.54163056034261M22.37047671569299,37.09101063966957L16.088095894616245,34.488763299586964M47.49999999999999,20.299999999999997L47.49999999999999,13.5M72.629523284307,37.09101063966956L78.91190410538375,34.48876329958696M66.73330444827411,66.73330444827407L71.54163056034264,71.54163056034258" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"></path><g><text text-anchor="middle" x="47.5" y="77" font-family="arial" font-size="10" stroke="none" stroke-width="0" fill="#000000">34</text><path d="M25.594492610281954,24.173003922514837C49.234945333262964,45.87077788788972,55.21294372591837,53.97507521815897,54.34547105928689,54.78968627421411C53.477998392655415,55.604297330269254,45.765054666737036,49.12922211211028,25.594492610281954,24.173003922514837" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"></path><circle cx="47" cy="47" r="5" stroke="#666666" stroke-width="1" fill="#4684ee"></circle></g></g></svg></div><div></div></td></tr></tbody></table></div>
                  </div>
              </div>
            </div><!--/span-->
         </div>
      </div>
            
       <?php include("alerts.php");?> 
			
			
</body>

    <script type="text/javascript" src="../StudentDashboard/scripts/jsapi"></script>
     
    <!-- jQuery -->
    <script src="../StudentDashboard/scripts/jquery.min.js"></script>
    
    <!-- Data Tables -->
    <script src="../StudentDashboard/scripts/jquery.dataTables.js"></script>
    
    <!-- jQuery UI Sortable -->
    <script src="../StudentDashboard/scripts/jquery.ui.core.min.js"></script>
	<script src="../StudentDashboard/scripts/jquery.ui.widget.min.js"></script>
	<script src="../StudentDashboard/scripts/jquery.ui.mouse.min.js"></script>
	<script src="../StudentDashboard/scripts/jquery.ui.sortable.min.js"></script>
    <script src="../StudentDashboard/scripts/jquery.ui.widget.min.js"></script>
    
    <!-- jQuery UI Draggable & droppable -->
    <script src="../StudentDashboard/scripts/jquery.ui.draggable.min.js"></script>
    <script src="../StudentDashboard/scripts/jquery.ui.droppable.min.js"></script>

    <!-- Bootstrap -->
    <script src="../StudentDashboard/scripts/bootstrap.min.js"></script>
    <script src="../StudentDashboard/scripts/bootbox.min.js"></script>

	<!-- Bootstrap Date Picker -->
    <script src="../StudentDashboard/scripts/bootstrap-datepicker.js"></script>

		
    <!-- jQuery Cookie -->    
    <script src="../StudentDashboard/scripts/jquery.cookie.js"></script>
    
    <!-- Full Calender -->
    <script type="text/javascript" src="../StudentDashboard/scripts/fullcalendar.min.js"></script>
    
    <!-- CK Editor -->
	<script type="text/javascript" src="../StudentDashboard/scripts/ckeditor.js"></script>
	<script type="text/javascript" src="../StudentDashboard/scripts/jquery.js"></script>
    
    <!-- Chosen multiselect -->
    <script type="text/javascript" language="javascript" src="../StudentDashboard/scripts/chosen.jquery.min.js"></script>  
    
    <!-- Uniform -->
    <script type="text/javascript" language="javascript" src="../StudentDashboard/scripts/jquery.uniform.min.js"></script>
    
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
    <script src="../StudentDashboard/scripts/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="../StudentDashboard/scripts/load-image.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="../StudentDashboard/scripts/canvas-to-blob.min.js"></script>
    <script src="../StudentDashboard/scripts/bootstrap-image-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="../StudentDashboard/scripts/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
	<script src="../StudentDashboard/scripts/jquery.fileupload.js"></script>
    <!-- The File Upload image processing plugin -->
    <script src="../StudentDashboard/scripts/jquery.fileupload-ip.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="../StudentDashboard/scripts/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="../StudentDashboard/scripts/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
    <!--[if gte IE 8]><script src="scripts/blueimp-jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->
    
    <!-- Simplenso scripts -->
    <script src="../StudentDashboard/scripts/simplenso.js"></script><script src="scripts/saved_resource" type="text/javascript"></script><script src="scripts/format+en,default,geochart.I.js" type="text/javascript"></script><script src="scripts/saved_resource(1)" type="text/javascript"></script><script src="scripts/corechart.js" type="text/javascript"></script><script src="scripts/saved_resource(2)" type="text/javascript"></script><script src="scripts/gauge.js" type="text/javascript"></script>
  
<div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">FireFox</div><div style="position: absolute; display: none; "><div style="background-color: infobackground; padding: 1px; border: 1px solid infotext; font-size: 10px; margin: 10px; font-family: Arial; background-position: initial initial; background-repeat: initial initial; ">Unique</div></div><div style="display: none; position: absolute; top: 10px; left: 10px; white-space: nowrap; font-family: Arial; font-size: 10px; ">Un...</div></body><span id="skype_highlighting_settings" display="none" autoextractnumbers="1"></span><object id="skype_plugin_object" location.href="http://wbpreview.com/previews/WB00958H8/index.html" location.hostname="wbpreview.com" style="position: absolute; visibility: hidden; left: -100px; top: -100px; " width="0" height="0" type="application/x-vnd.skype.click2call.chrome.5.7.0"></object></html>