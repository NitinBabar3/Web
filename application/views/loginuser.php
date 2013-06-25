	<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Share Market :: Login Form</title>
	</head>
	<body>
	<table width="439" border="0" bgcolor="#990000"  align="center">
	  <tr>
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td align="center"><font color="#FFFFFF" size="+1"><b>Share Market Application Login</b></font></td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td width="10">&nbsp;</td>
		<td width="404" align="center">&nbsp;</td>
		<td width="11">&nbsp;</td>
	  </tr>
	  
	</table>
	<?php echo form_open('user/login'); 
	$data2 = array(
				  'type'=>'password',
				  'name'        => 'password',
				  'id'          => 'password',
				  'value'       => '',
				  'maxlength'   => '12',
				  'size'        => '12',
				  
				);

	$data3 = array(
				  'type'=>'text',
				  'name'        => 'email',
				  'id'          => 'email',
				  'value'       => '',
				  'maxlength'   => '20',
				  'size'        => '20',
				  
				);


	 ?>
	<p>&nbsp;</p>
	<table width="352" border="0" align="center">
	<tr>
		<td width="82" align="left">Email :</td>
		<td>&nbsp;&nbsp;<?php echo form_input($data3); ?></td>
	  </tr>
	  <tr>
		<td width="82" align="left">Password :</td>
		<td>&nbsp;&nbsp;<?php echo form_input($data2); ?></td>
	  </tr>
	  
	  <tr>
		<td colspan='4'>&nbsp;<?php if(isset($error)) { echo $error; }?></td>
		<td>&nbsp;</td>
	  </tr>
	 
	  <tr>
		<td>&nbsp;</td>
		<td><?php echo form_submit('submit', 'Login'); ?></td>
	  </tr>
	   <tr>
		<td>&nbsp;</td>
	  </tr>
	   <tr>
	   <td colspan='2' align="center"><b>Copyright IDigitalise Limited. All rights Reserved</b></td>
		<td>&nbsp;</td>
	  </tr>
	</table>
	<?php echo form_close(); ?>
	</body>
	</html>