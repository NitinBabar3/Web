<?php 
$con=mysqli_connect("localhost","root","root","telecom");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$result = mysqli_query($con,"SELECT * FROM cdr WHERE ID='".$_GET['bill_number']."'");
	$row = mysqli_fetch_array($result);
?>
<Table>
<tr>
<td><b>Account Number </b><?php echo $row['account_name'];?>&nbsp;</td><td><b>Bill Number </b><?php  echo $row['bill_number']; ?></td>
<td style='padding-left:25px;'></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;<b>Call Log</b></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
	<td width='15%'>&nbsp;<b>Call Type</td>
	<td width='15%'>&nbsp;<b>Call FROM</td>
	<td width='15%'>&nbsp;<b>Call TO</td>
	<td width='15%'>&nbsp;<b>Call Duration (seconds)</td>
	<td>&nbsp;</td>
	<td width='15%'>&nbsp;<b>Units</td>
	<td>&nbsp;</td>
	<td width='15%'>&nbsp;<b>Call Cost</td>
	</tr>
<tr>
<td>&nbsp;</td>
</tr>
<?php 
$query="SELECT * FROM cdr WHERE account_name='".$row['account_name']."'";
//echo $query.'<br>';
$result_call = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result_call))
  {
?>
	<tr>
	<td width='15%'>&nbsp;<?php echo $row['call_typ'];?></td>
	<td width='15%'>&nbsp;<?php echo $row['a_party_loc'];?></td>
	<td width='15%'>&nbsp;<?php echo $row['b_party_loc'];?></td>
	<td >&nbsp;<?php echo $row['duration'];?></td>
	<td>&nbsp;</td>
	<td width='15%' align='left'>&nbsp;<?php echo $row['units'];?></td>
	<td>&nbsp;</td>
	<td width='15%' align='left'>&nbsp;<?php echo $row['call_cost'];?></td>
	</tr>
<?php } ?>
<tr>
<td></td>
</tr>
</table>