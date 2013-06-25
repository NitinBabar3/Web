	<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Share Market :: Home Page</title>
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
		<td align="center"><font color="#FFFFFF" size="+1"><b>Welcome <?php $session_username = $this->session->userdata('name'); echo $session_username;?></b></font></td>
		<td>&nbsp;<?php echo anchor('user/logout', 'Logout', 'title="Logout"');?></td>
	  </tr>
	  <tr>
		<td width="10">&nbsp;</td>
		<td width="404" align="center">&nbsp;</td>
		<td width="11">&nbsp;</td>
	  </tr>
	</table>
	</body>
	</html>