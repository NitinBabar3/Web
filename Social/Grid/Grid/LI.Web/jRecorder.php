<?
	$filename = $_GET['filename'];
?>
<html>

<head>
<link href="css/bootstrap.css" rel="stylesheet">
  <link type="text/css" href="css/default.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  
  <link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">
  
  
	<script src="scripts/jquery.min.js"></script>
	<script src="jRecorder/jRecorder.js"></script>
	
<script>//jRecorder

		$(document).ready(function(){
			var filename = $('#filename').text();			
   			$.jRecorder({ 
        		host : 'jRecorder/acceptfile.php?filename='+filename ,  //replace with your server path please
	        
    		    callback_started_recording:     function(){callback_started(); },
        		callback_stopped_recording:     function(){callback_stopped(); },
        		callback_activityLevel:          function(level){callback_activityLevel(level); },
        		callback_activityTime:     function(time){callback_activityTime(time); },
        
		        callback_finished_sending:     function(time){ callback_finished_sending() },
	        
    	    
        		swf_path : 'jRecorder/jRecorder.swf',
     
     		});
     		
     		$('#record').click(function(){
     			$('#send').fadeIn();
     		});
		});   
       
   </script>

</head>

<body>
	<div id='filename' style="display: none;"><?echo $filename?></div>
	 <div id='container'>
 	<div id='row' style="width:'300px';height: '100px'>"
<div style="background-color: #eeeeee;border:1px solid #cccccc">
  
  Time: <span id="time">00:00</span>
  
</div>

<div id="levelbase" style="width:200px;height:20px;background-color:#ffffff">
  
  <div id="levelbar" style="height:19px; width:2px;background-color:black"></div>


<button class = 'btn'  id="record" style="color:red"><i class="icon-plus-sign"></i></button>

<button class='btn' id="stop" ><i class="icon-stop"></i>/<i class="icon-play"></i></button>
  
<button class='btn' id="send" style="display: none;">Upload<i class="icon-arrow-up"></i></button>  
  	</div>
  </div>

</body>
<script type="text/javascript"> //jRecorder

                  $('#record').click(function(){
                    
                    
                      $.jRecorder.record(60);
                      
                      
                      
                    
                    
                  })
                  
                  
                  $('#stop').click(function(){
                    
                    
                    
                     $.jRecorder.stop();
                    
                    
                  })
                  
                  
                   $('#send').click(function(){
                    
                    
                    
                     $.jRecorder.sendData();
                     filename = $('#filename').text();                     
                     //alert(filename);
                    	$.ajax({                    		
							url : '../LI.Services/postAudioFileName.php',
							type : 'POST',
							data : {							
								filename:filename					
							},
							//dataType : 'json',

							success : function(data) {
								//response=data;
								//alert(data);
								//arrayQuestionId[arrayQuestionId.length] = data;
							},
							error : function(jxhr) {
								alert(" Your audio could not be saved in the database. Please try again");
							}

						});
                    
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
                      //$('#status').html('Stop request is accepted');
                      
                  }

                  function callback_finished_recording()
                  {
                    
                      $('#status').html('Recording event is finished');
                    
                    
                  }
                  
                  function callback_finished_sending()
                  {
                    
                      //$('#status').html('File has been sent to server mentioned as host parameter');
                      alert('Your answer has been recorded')
                      
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

        </script>


</html>


