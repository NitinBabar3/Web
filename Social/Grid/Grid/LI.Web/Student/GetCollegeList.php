	<script type="text/javascript">
	function showCollege(str)
	{
	if (str.length==0)
  { 
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
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
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
	//alert(xmlhttp.responseText);
    //document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  //alert("GetCollegeList.php?q="+str);
xmlhttp.open("GET","GetColleges.php?q="+str,true);
xmlhttp.send();
	}
	</script>
	<script>
	function SetCollege(college)
	{
		  //alert(college);
		  document.getElementById("college").value=college;
	}
	</script>



<form>
	<div id="MatchedCollege"><input type="text" name="college" id="college" size="50" onkeyup="showCollege(this.value)" /></div>
	<div id="livesearch"></div>
</form>