<?php
//echo $session;
//include("../Utilities.php");
/*
$list = Utilities::GetListFromTableByParameter("subscriptiontypes", "SubscriptionType");
$string = Utilities::GetHTMLDropdownFromList($list, "SubscriptionTypeId");
echo $string;
*/
?>
<!DOCTYPE html>
<html>
<!-----
/*
 * ----------------------------------------------------------
 * Filename: Partners.php
 * Created by: CreativePath
 * Creation date: May 26, 2012
 * Copyright(c) 2012 Creative Path Group Pty Ltd (Australia)
 * silva.gerry@creativepath.com.au
 * ----------------------------------------------------------
 */
 -->
    <head>
        <title>DataTables</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <style type="text/css">
            @import "../media/css/demo_table_jui.css";
            @import "../media/themes/smoothness/jquery-ui-1.8.4.custom.css";
            
        </style>
        <style>
            *{
                font-family: arial;
				text-align: center;
            }
			
        </style>

        <script src="../media/js/jquery.js" type="text/javascript"></script>
        <script src="../media/js/jquery.dataTables.js" type="text/javascript"></script>  
        <script type="text/javascript" charset="utf-8">
            /*
             * java script function
             * 
             */
            //restoreRow
            function restoreRow ( oTable, nRow )
            {
                var aData = oTable.fnGetData(nRow);
                
                if ( aData != null ) {
          
                    var jqTds = $('>td', nRow);
	
                    for ( var i=0, iLen=jqTds.length ; i<iLen ; i++ ) {
                        oTable.fnUpdate( aData[i], nRow, i, false );
                    }
                }
            }
            //editRow
            function editRow ( oTable, nRow )
            {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);  
                
                jqTds[0].innerHTML = '<a class="save" href="">Save</a>';           
                jqTds[1].innerHTML = '<a class="cancel" href="">Candcel</a>';
                
                
                if ( aData == null ) {
                    jqTds[2].innerHTML = '<input value=" " type="text">';
                    jqTds[3].innerHTML = '<input value=" " type="text">';
                    
                } else {
                    jqTds[2].innerHTML = '<input value="'+aData[2]+'" type="text">';
                    jqTds[3].innerHTML = '<input value="'+aData[3]+'" type="text">';
                    
                }
                
            }
            //saveRow
            function saveRow ( oTable, nRow )
            {   //alert(nRow);
                //alert("insaverow");
                var jqInputs = $('input', nRow);
                
                
                oTable.fnUpdate( jqInputs[0].value, nRow, 2, false );
                oTable.fnUpdate( jqInputs[1].value, nRow, 3, false );
				oTable.fnUpdate( jqInputs[2].value, nRow, 4, false );
                oTable.fnUpdate( jqInputs[3].value, nRow, 5, false );
				oTable.fnUpdate( jqInputs[4].value, nRow, 6, false );
				
				
                var row_id = nRow.id;
                var mydata = 'ID=' + row_id +
                    '&account_name=' +  jqInputs[0].value +
                    '&bill_number=' +  jqInputs[1].value +
                    '&units=' +  jqInputs[2].value  +
                    '&duration=' +  jqInputs[3].value+
                    '&call_typ=' +  jqInputs[4].value+
                    '&call_cost=' +  jqInputs[5].value ;
                    
                    
            $.ajax( {
                    dataType: 'html',
                    type: "POST",
                    url: "ManagecourseUpdate.php",
                    cache: false,
                    data: mydata,
                    success: function () { 
                        alert('Record saved successfully.'); 
                        //alert(mydata);
                                                
               },
                    error: function() {alert('Save failed.');},
                    complete: function() {}
                } );
                
            }
            
            
            
           

            /*
             * Main javascript setup and 
             * 
             */
            $(document).ready(function(){
            
                
                var nEditing = null; //CRUD
                
                var aSelected = [];  //Row selection
                    
                var oTable = $('#datatables').dataTable({  
                    "bProcessing": true,
                    "bServerSide": true,                     //Server
                    "sAjaxSource": "ManagecourseDataSource.php", //PHP Source
                    "sServerMethod": "POST",                 //Override default GET           
                    "sPaginationType":"full_numbers",        //Paginations 
                    "aaSorting":[[0, "asc"]],
                    "aoColumns": [                  //Row control
                        { "bSortable": false },     //edit
                        { "bSortable": false },     //last delete
                        { "bSortable": true  },     //course name                       
                        { "bSortable": true },     //1
                        { "bSortable": true },     //2
                        { "bSortable": true },     //21
                        { "bSortable": true },     //22
                        { "bSortable": true }
                    ],         
                    "oColReorder": {
                        "iFixedColumns": 1
                    },
                    "bJQueryUI":true,                        //ThemeRoller
                    "sScrollX": "100%",                      //Scroller
                    "sScrollXInner": "110%",
                    "bScrollCollapse": true                   
                });
                
                
                /* Click event for Multiselect*/
                $('#datatables tbody tr').live('click', function () {
                    var id = this.id;
                    var index = jQuery.inArray(id, aSelected);
         
                    if ( index === -1 ) {
                        aSelected.push( id );
                    } else {
                        aSelected.splice( index, 1 );
                    }
         
                    $(this).toggleClass('row_selected');
                } );
                
                //Window adjust triggers table adjust
                $(window).bind('resize',function(){
                    oTable.fnAdjustColumnSizing(); 
                });
                   
                //Edit event
                $('#datatables a.edit').live('click', function (e) {    
                    e.preventDefault(); //prevent loop back
                    //alert("in edit");
                    /* Get the row as a parent of the link that was clicked on */
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        //Restore current editing to original
                        if ( nEditing != null ) {
                            restoreRow( oTable, nEditing );
                        }        
                        //Edit a different row
                        nEditing = nRow;
                        
                        editRow( oTable, nRow );
                    }
                });
                //Save event
                $('#datatables a.save').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    //alert("in save");
                    saveRow( oTable, nEditing );
                    nEditing = null;
                } );                   
                //Delete event
                $('#datatables a.delete').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        deleteRow(oTable, nRow);
                        nEditing = null;
                    }
                } );
                //Cancel event
                $('#datatables a.cancel').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        restoreRow(oTable, nRow);
                        nEditing = null;
                        oTable.fnDraw();
                    }
                } );            
                //Copy event
                $('#datatables a.copy').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        copyRow(oTable, nRow);
                        nEditing = null;
                        oTable.fnDraw();                        
                    }
                } );  
                //New event
                $('#new').live('click', function ( e) { 
                    e.preventDefault(); //prevent loop back
                    addEmptyRow(oTable);        
                    nEditing = null;
                } );
            }); 
          
            
        </script>      
    </head>

    <body>
        
        <div id=>
            <p>
               <i><b>Summary report</b></i>
            </p>
            
            <table class="display" " id="datatables" cellpadding="0" cellspacing="0" border="0">
                <thead>
						<th width ="10"></th>
						<th width ="10"></th>
						<th width ="10"><b>ID</b></th>
                        <th width ="15"><b>Account</b></th>
                        <th width ="15"><b>Billing Number</b></th>
						<th width ="10"><b>Units</b></th>
						<th width ="10"><b>Cost</b></th>
						<th width ="10"><b>Type</b></th>
                        
                        
                </thead>

                <!--- @TODO fix column search
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">
                            <input class="search_init" type="text" value="Search id" name="search_id">
                        </th>
                        <th rowspan="1" colspan="1">
                            <input class="" type="text" value="Search Partner Number" name="search_partnernumber">
                        </th>
                        <th rowspan="1" colspan="1">
                            <input class="search_init" type="text" value="Search Partner Names" name="search_partnernumber">
                        </th>
                        <th rowspan="1" colspan="1">
                        <th rowspan="1" colspan="1">
                    </tr>
                </tfoot>    
                -->

                <tbody>
                    <tr>
                        <td colspan="5" class="dataTables_empty">Data from server not found...</td>

                    </tr>
                </tbody>
            </table>
            <div id="content"></div>

        </div>
    </body>
</html>
