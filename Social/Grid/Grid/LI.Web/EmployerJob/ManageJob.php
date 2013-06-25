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
            @import "http://118.139.171.92/letsdev01/LI.Admin/media/css/demo_table_jui.css";
            @import "http://118.139.171.92/letsdev01/LI.Admin//media/themes/smoothness/jquery-ui-1.8.4.custom.css";
            
        </style>
        <style>
            *{
                font-family: arial;
            }
        </style>

        <script src="http://118.139.171.92/letsdev01/LI.Admin//media/js/jquery.js" type="text/javascript"></script>
        <script src="http://118.139.171.92/letsdev01/LI.Admin//media/js/jquery.dataTables.js" type="text/javascript"></script>  
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
                jqTds[1].innerHTML = '<a class="cancel" href="">Cancel</a>';
                
                var selectJobTypeId='<select id=JobTypeid><option value="1">Job</option><option value="2">Internship</option><option value="3">Virtual Internship</option><option value="4">Tasks</option></select>';
                var selectCompensationTypeId='<select id=CompensationTypeid><option value="1">Salary</option><option value="2">Paid Internship</option><option value="3">Unpaid internship</option></select>';
                var selectTestId='<select id=Testid><option value="1">Technical Test</option><option value="2">Aptitute Test</option></select>';
                var selectProspect='<select id=Prospect><option value="0">No</option><option value="1">Yes</option></select>';
                var selectisPeriodFlexible='<select id=isPeriodFlexible><option value="0">No</option><option value="1">Yes</option></select>';
                var selectisFeatured='<select id=isFeatured><option value="0">No</option><option value="1">Yes</option></select>';
                var selectisLIRecommended='<select id=isLIRecommended><option value="0">No</option><option value="1">Yes</option></select>';
                
                
                /*'Title','Description','Type','CompanyName','Status','LocationIdString','JobProspect',
                    'FunctionIdString','StartDate','EndDate','isPeriodFlexible','CompensationType','Amount',
                    'ApplicationDeadline','NoOfPositions','RequiredSkillIdString','AcademicRequirement',
                    'isFeatured','isLIRecommended','TestTitle','CreatedBy','CreatedOn'*/
                var ifJobId=aData[4];
                
                if ( aData == null ) {
                    //'j.Title','j.Description','t.Type',
                    jqTds[2].innerHTML = '<input value=" " type="text">';
                    jqTds[3].innerHTML = '<input value=" " type="text">';
                    jqTds[4].innerHTML = selectJobTypeId;
                    
                    //'e.CompanyName','j.Status','j.LocationIdString',
                    //jqTds[5].innerHTML = '<input value=" " type="text">';
                    jqTds[6].innerHTML = '<input value=" " type="text">';
                    jqTds[7].innerHTML = '<input value=" " type="text">';
                    
                    //'j.JobProspect','j.Functionidstring','startdate'
                    jqTds[8].innerHtml=selectProspect;
                    jqTds[9].innerHtml='<input value=" " type="text">';
                    jqTds[10].innerHtml='<input value=" " type="text">';
                    
                    //'j.EndDate','j.isPeriodFlexible','c.CompensationType',
                    jqTds[11].innerHTML = '<input value=" " type="text">';
                    jqTds[12].innerHTML = selectisPeriodFlexible;
                    jqTds[13].innerHTML = selectCompensationTypeId;
                    
                    
                    //'j.Amount','j.ApplicationDeadline','j.NoOfPositions',
                    jqTds[14].innerHTML = '<input value=" " type="text">';
                    jqTds[15].innerHTML = '<input value=" " type="text">';
                    jqTds[16].innerHTML = '<input value=" " type="text">';
                    
                    //'j.RequiredSkillIdString','j.AcademicRequirement','j.isFeatured',
                    jqTds[17].innerHTML = '<input value=" " type="text">';
                    jqTds[18].innerHTML = '<input value=" " type="text">';
                    jqTds[19].innerHTML = selectisFeatured;
                    
                    //'j.isLIRecommended','st.TestTitle','j.CreatedBy','j.CreatedOn'
                    jqTds[20].innerHTML = selectisLIRecommended;
                    jqTds[21].innerHTML = selectTestId;
                    jqTds[22].innerHTML = '<input value=" " type="text">';
                    jqTds[23].innerHTML = '<input value=" " type="text">';
                
                    }
                    else {
                    
                    //'j.Title','j.Description','t.Type',
                    jqTds[2].innerHTML = '<input value="'+aData[2]+'" type="text">';
                    jqTds[3].innerHTML = '<input value="'+aData[3]+'" type="text">';
                    jqTds[4].innerHTML = selectJobTypeId;
                    
                    //'e.CompanyName','j.Status','j.LocationIdString',
                    //jqTds[5].innerHTML = '<input value=" " type="text">';
                    jqTds[6].innerHTML = '<input value="'+aData[6]+'" type="text">';
                    jqTds[7].innerHTML = '<input value="'+aData[7]+'" type="text">';
                    
                    //'j.JobProspect','j.Functionidstring','startdate'
                    jqTds[8].innerHTML = selectProspect;;
                    jqTds[9].innerHTML = '<input value="'+aData[9]+'" type="text">';
                    jqTds[10].innerHTML= '<input value="'+aData[10]+'" type="text">';
                    
                    //'j.EndDate','j.isPeriodFlexible','c.CompensationType',
                    jqTds[11].innerHTML = '<input value="'+aData[11]+'" type="text">';
                    jqTds[12].innerHTML = selectisPeriodFlexible;
                    jqTds[13].innerHTML = selectCompensationTypeId;
                    
                    
                    //'j.Amount','j.ApplicationDeadline','j.NoOfPositions',
                    jqTds[14].innerHTML = '<input value="'+aData[14]+'" type="text">';
                    jqTds[15].innerHTML = '<input value="'+aData[15]+'" type="text">';
                    jqTds[16].innerHTML = '<input value="'+aData[16]+'" type="text">';
                    
                    //'j.RequiredSkillIdString','j.AcademicRequirement','j.isFeatured',
                    jqTds[17].innerHTML = '<input value="'+aData[17]+'" type="text">';
                    jqTds[18].innerHTML = '<input value="'+aData[18]+'" type="text">';
                    jqTds[19].innerHTML = selectisFeatured;
                    
                    //'j.isLIRecommended','st.TestTitle','j.CreatedBy','j.CreatedOn'
                    jqTds[20].innerHTML = selectisLIRecommended;
                    jqTds[21].innerHTML = selectTestId;
                    jqTds[22].innerHTML = '<input value="'+aData[22]+'" type="text">';
                    jqTds[23].innerHTML = '<input value="'+aData[23]+'" type="text">';
                    
                }
                
            }
            //saveRow
            function saveRow ( oTable, nRow )
            {   //alert(nRow);
                //alert("insaverow");
                var jqInputs = $('input', nRow);
                
                oTable.fnUpdate( '<a class="edit" href="">Edit</a>', nRow, 0, false );
                oTable.fnUpdate( '<a class="delete" href="">Delete</a>', nRow, 1, false );
                 
                //alert( $('#isPeriodFlexible').val()); 
                //alert( $('#isFeatured').val()); 
                //alert( $('#isLIRecommended').val()); 
                
                var JobTypeId= $('#JobTypeid').val();
                var CompensationTypeId = $('#CompensationTypeid').val();
                var TestId = $('#Testid').val();
                var Prospect = $('#Prospect').val();
                var isPeriodFlexible = $('#isPeriodFlexible').val();
                var isFeatured = $('#isFeatured').val();
                var isLIRecommended = $('#isLIRecommended').val();
                
                
                oTable.fnUpdate( jqInputs[0].value, nRow, 2, false );
                oTable.fnUpdate( jqInputs[1].value, nRow, 3, false );
                oTable.fnUpdate( $('#JobTypeid').val(), nRow, 4, false );
                //oTable.fnUpdate( jqInputs[3].value, nRow, 5, false );
                oTable.fnUpdate( jqInputs[2].value, nRow, 6, false );
                oTable.fnUpdate( jqInputs[3].value, nRow, 7, false );
                oTable.fnUpdate( $('#Prospect').val(), nRow, 8, false );
                oTable.fnUpdate( jqInputs[4].value, nRow, 9, false );
                oTable.fnUpdate( jqInputs[5].value, nRow, 10, false );
                oTable.fnUpdate( jqInputs[6].value, nRow, 11, false );
                oTable.fnUpdate( $('#isPeriodFlexible').val(),nRow, 12, false );
                oTable.fnUpdate( $('#CompensationTypeid').val(), nRow, 13, false );
                oTable.fnUpdate( jqInputs[7].value, nRow, 14, false );
                oTable.fnUpdate( jqInputs[8].value, nRow, 15, false );
                oTable.fnUpdate( jqInputs[9].value, nRow, 16, false );
                oTable.fnUpdate( jqInputs[10].value, nRow, 17, false );
                oTable.fnUpdate( jqInputs[11].value, nRow, 18, false );
                oTable.fnUpdate( $('#isFeatured').val(), nRow, 19, false );
                oTable.fnUpdate( $('#isLIRecommended').val(), nRow, 20, false );
                oTable.fnUpdate( $('#Testid').val(), nRow, 21, false );
                oTable.fnUpdate( jqInputs[12].value, nRow, 22, false );
                oTable.fnUpdate( jqInputs[13].value, nRow, 23, false );
                
               /*'Title','Description','Type','CompanyName','Status','LocationIdString','JobProspect',
                    'FunctionIdString','StartDate','EndDate','isPeriodFlexible','CompensationType','Amount',
                    'ApplicationDeadline','NoOfPositions','RequiredSkillIdString','AcademicRequirement',
                    'isFeatured','isLIRecommended','TestTitle','CreatedBy','CreatedOn'*/
                
                var row_id = nRow.id;
                //alert(JobTypeId);
                var mydata = 'ID=' + row_id +
                    '&Title=' + jqInputs[0].value +
                    '&Description=' +jqInputs[1].value +
                    '&JobTypeId=' + JobTypeId +
                    '&Status='+jqInputs[2].value +
                    '&LocationIdString='+jqInputs[3].value +
                    '&JobProspect='+Prospect+
                    '&FunctionIdString='+jqInputs[4].value +
                    '&StartDate='+jqInputs[5].value +
                    '&EndDate='+jqInputs[6].value +
                    '&isPeriodFlexible='+isPeriodFlexible+
                    '&CompensationTypeId='+CompensationTypeId+
                    '&Amount='+jqInputs[7].value +
                    '&ApplicationDeadline='+jqInputs[8].value +
                    '&NoOfPositions='+jqInputs[9].value +
                    '&RequiredSkillIdString='+jqInputs[10].value +
                    '&AcademicRequirement='+jqInputs[11].value +
                    '&isFeatured='+isFeatured+
                    '&isLIRecommended='+isLIRecommended+
                    '&TestId='+TestId+
                    '&CreatedBy='+jqInputs[12].value +
                    '&CreatedOn='+jqInputs[13].value ;
            $.ajax( {
                    dataType: 'html',
                    type: "POST",
                    url: "ManageJobUpdate.php",
                    cache: false,
                    data: mydata,
                    success: function () { 
                        alert('Record saved successfully.'); 
                        alert(mydata);
                                                
               },
                    error: function() {alert('Save failed.');},
                    complete: function() {}
                } );
                
            }
            //copyRow
            function copyRow ( oTable, nRow )
            {     
                var aData = oTable.fnGetData(nRow);
                
                if ( aData != null ) {
                    var mydata =  
                        'id=' +  aData[0] +
                        '&partnernumber=' +  aData[1] +
                        '&partnername=' +  aData[2];
                }
                
                $.ajax( {
                    dataType: 'html',
                    type: "POST",
                    url: "PartnersAddCopy.php",
                    cache: false,
                    data: mydata,
                    success: function () { 
                        //alert('Record copied successfully.'); 
                    },
                    error: function() {alert('Copy failed.');},
                    complete: function() {
                        oTable.fnDraw();
                    }
                } );
                
            }
            
            //copyRow
            function addEmptyRow ( oTable, nRow )
            {                                     
                var mydata = 'id=Null';

                $.ajax( {
                    dataType: 'html',
                    type: "POST",
                    url: "PartnersAddCopy.php",
                    cache: false,
                    data: mydata,
                    success: function () { 
                        //alert('Record created successfully.'); 
                    },
                    error: function() {alert('Create failed.');},
                    complete: function() {
                        oTable.fnDraw();
                    }
                } );
   
            }
            //deleteRow
            function deleteRow ( oTable, nRow)
            {
                if (confirm("Confirm deletion?")) {

                    var row_id = nRow.id;
                    var mydata = 'id=' + row_id;
                        
                    $.ajax( {
                        dataType: 'html',
                        type: "POST",
                        url: "ManageJobDelete.php",
                        cache: false,
                        data: mydata,
                        success: function () {
                            oTable.fnDeleteRow( nRow );
                            oTable.fnDraw();
                            alert("Row deleted");
                        },
                        error: function() {},
                        complete: function() {}
                    } );
                
                    
                }
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
                    "sAjaxSource": "ManageJobDataSource.php", //PHP Source
                    "sServerMethod": "POST",                 //Override default GET           
                    "sPaginationType":"full_numbers",        //Paginations 
                    "aaSorting":[[0, "asc"]],
                    "aoColumns": [                  //Row control
                        { "bSortable": false },     //edit
                        { "bSortable": false },     //last delete
                        { "bSortable": true  },     //title
                        { "bSortable": false },     //description
                        { "bSortable": true  },     //type
                        { "bSortable": true  },     //company name
                        { "bSortable": true  },     //status
                        { "bSortable": false },     //location
                        { "bSortable": true  },     //job prospect
                        { "bSortable": true  },     //function
                        { "bSortable": true  },     //startdate
                        { "bSortable": true  },     //enddate
                        { "bSortable": true  },     //is period flexible
                        { "bSortable": true  },     //compensation type
                        { "bSortable": false },     //amount
                        { "bSortable": true  },     //application deadline
                        { "bSortable": true  },     //no of position
                        { "bSortable": true  },     //required skills
                        { "bSortable": true  },     //academic requiremets
                        { "bSortable": true  },     //featured
                        { "bSortable": false },     //li recommended
                        { "bSortable": true  },     //testtitle
                        { "bSortable": true  },     //createdby
                        { "bSortable": false },     //createdon
                        { "bSortable": false }      
                    ],/* 'Title','Description','Type','CompanyName','Status','LocationIdString','JobProspect',
                    'FunctionIdString','StartDate','EndDate','isPeriodFlexible','CompensationType','Amount',
                    'ApplicationDeadline','NoOfPositions','RequiredSkillIdString','AcademicRequirement',
                    'isFeatured','isLIRecommended','TestTitle','CreatedBy','CreatedOn'*/
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
                <!--a id="new" href="">Add new row</a-->
            </p>
            
            <table class="display" " id="datatables" cellpadding="0" cellspacing="0" border="0">
                <thead>
                        <th width ="20"></th>
                        <th width ="20"></th>
                        <th width ="30">Title</th>
                        <th width ="30">Description</th>
                        <th width ="30">Type</th>
                        <th width ="30">Company Name</th>
                        <th width ="30">Status</th>
                        <th width ="30">Location</th>
                        <th width ="30">JobProspect</th>
                        <th width ="30">Function</th>
                        <th width ="30">StartDate</th>
                        <th width ="30">EndDate</th>
                        <th width ="30">isPeriodFlexible</th>
                        <th width ="30">Compensation Type</th>
                        <th width ="30">Amount</th>
                        <th width ="30">ApplicationDeadline</th>
                        <th width ="30">NoOfPositions</th>
                        <th width ="30">required skills</th>
                        <th width ="30">Academic Requirement</th>
                        <th width ="30">Featured</th>
                        <th width ="30">LI recommended</th>
                        <th width ="30">TestTitle</th>
                        <th width ="30">CreatedBy</th>
                        <th width ="30">CreatedOn</th>
                        <th></th>
                        
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
