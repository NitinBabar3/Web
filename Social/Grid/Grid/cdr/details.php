<html>
<head>
<script>
function showBill(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","get_details.php?bill_number="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
<?php 
	$con=mysqli_connect("localhost","root","root","telecom");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$result = mysqli_query($con,"SELECT * FROM cdr GROUP BY bill_number");





?>
<b>Detailed Report</b><br><br>
<form>
<select class="dropdown-menu" name="users" onchange="showBill(this.value)">
<option value="">Select Bill Number:</option>
<?php 
while($row = mysqli_fetch_array($result))
  {
?>
	<option value="<?php echo $row['ID']; ?>"><?php echo $row['bill_number']; ?></option>
<?php 
}
?>
</select>
</form>
<?php mysqli_close($con); ?>
<br>
<div id="txtHint"><b></b></div>

</body>
</html>