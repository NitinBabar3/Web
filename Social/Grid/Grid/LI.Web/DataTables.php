
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico" />
		
		<title>DataTables example</title>
		<!--link rel="stylesheet" type="text/css" href="DataTables/media/css/dataTable-TwitterBootstrap.css"-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-image-gallery.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="DataTables/media/css/DT-Bootstrap.css">
		
		<style type ="text/css">
			@import "DataTables/media/css/demo_table_jui.css";
			@import "DataTables/media/css/demo_table.css";
            @import "DataTables/media/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
		
		<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.dataTables.js"></script>

		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "JobSource.php",
					"fnServerData": function ( sSource, aoData, fnCallback ) {
						/* Add some extra data to the sender */
			//			aoData.push( { "name": "more_data", "value": "my_value" } );
						$.getJSON( sSource, aoData, function (json) { 
							/* Do whatever additional processing you want on the callback, then tell DataTables */
							fnCallback(json);
						} );
					}
				} );
			} );
		</script>
	</head>
	<body id="dt_example">
		<div id="container">
			
			<div id="dynamic">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th width="15%">Title</th>
			<th width="15%">Type</th>
			<th width="15%">Application Deadline</th>
			<th width="15%">Role</th>
			<th width="10%">Status</th>
			<th width="10%">Applications</th>
			<th width="20">Actions</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th>Title</th>
			<th>Type</th>
			<th>Application Deadline</th>
			<th>Role</th>
			<th>Status</th>
			<th>Number Of Applications</th>
			<th>Actions</th>
		</tr>
	</tfoot>
</table>
	</div>
	</body>
</html>