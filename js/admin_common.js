jQuery(document).ready(function() {
	
jQuery('.responsive-data-table').DataTable({
    "PaginationType": "bootstrap",
    responsive: true,
     "sPaginationType": "full_numbers",
	"bDestroy":true,
    dom: '<"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>'
});

jQuery('.datatable-2').DataTable({
	
		"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/vendorslist',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false}
			//{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
    });

jQuery('.datatable-3').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/venueslist',
		//'sAjaxSource':  'http://localhost/toss/ajax/venueslist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            //{"bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-4').DataTable({
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/categorylist',
		//'sAjaxSource':  'http://localhost/toss/ajax/categorylist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-5').DataTable({
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        "sAjaxSource":  base_url + "users/appuserslist",
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false}
			//{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
    });
/*jQuery('.datatable-5').DataTable({
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        "sAjaxSource":  base_url + "ajax/userslist",
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false}
			//{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
    });*/
   
    /*
jQuery('.datatable-6').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/getPData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
           	{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});*/
    jQuery('.datatable-6 ').DataTable({
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        "sAjaxSource":  base_url + "users/adminuserslist",
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false}
			//{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
    });
jQuery('.datatable-7').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/subcategorylist',
		//'sAjaxSource':  'http://localhost/toss/ajax/subcategorylist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": true, "bSortable": true},
            {"sWidth": "12%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "20%", "bVisible": true, "bSearchable": true, "bSortable": false},
			{"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});




jQuery('.datatable-8').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/facilitieslist',
		//'sAjaxSource':  'http://localhost/toss/ajax/facilitieslist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": true, "bSortable": true},
            {"sWidth": "12%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "20%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
/*vendor start here*/
  jQuery('.datatable-11').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'vendors/venueslist',
		//'sAjaxSource':  'http://localhost/toss/vendors/venueslist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
           {"sWidth": "5%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"sWidth": "10%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "25%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "9%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "12%","bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "6%", "bVisible": true, "bSearchable": false, "bSortable": false},
            //{"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
            {"sWidth": "20%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-12').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
            'sAjaxSource': base_url + 'vendors/getPData',
        //'sAjaxSource': 'http://localhost/toss/vendors/getPData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            { "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
           	{ "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		aoData.push({
                name: 'venue_id',
                value: venue_id
            });
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-13').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'vendors/getMData',    
        //'sAjaxSource': 'http://localhost/toss/vendors/getMData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            { "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
           { "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { 
                    aoData.push({
                name: 'venue_id',
                value: venue_id
            });
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-14').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'vendors/slotslist',
		//'sAjaxSource':  'http://localhost/toss/vendors/slotslist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            { "bVisible": true, "bSearchable": false, "bSortable": true},
            { "bVisible": true, "bSearchable": true, "bSortable": false},
            //{ "bVisible": true, "bSearchable": false, "bSortable": false},
			{ "bVisible": true, "bSearchable": false, "bSortable": false},
			{ "bVisible": true, "bSearchable": false, "bSortable": false},
			{ "bVisible": true, "bSearchable": false, "bSortable": false},
			{ "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		 aoData.push({
                name: 'venue_id',
                value: venue_id
            });
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});	
jQuery('.datatable-15').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'vendors/getADData',
		//'sAjaxSource':  'http://localhost/toss/vendors/slotslist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            { "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            { "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            { "bVisible": true, "bSearchable": false, "bSortable": false},
             { "bVisible": true, "bSearchable": false, "bSortable": false},
	    { "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		aoData.push({
                name: 'venue_id',
                value: venue_id
            });
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});	
//venues start
//for prices
jQuery('.datatable-16').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
		// 'sAjaxSource': 'http://localhost/toss/venues/getPData',
       'sAjaxSource': base_url + 'venues/getPData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible":true, "bSearchable":  true, "bSortable": false},
           	{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		aoData.push({
                name: 'venueid',value: venueid});
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
//for staff
jQuery('.datatable-17').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
		'sAjaxSource': base_url + 'venues/getData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": false},
           	{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		aoData.push({
                name: 'venueid',value: venueid});
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-18').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
		'sAjaxSource': base_url + 'venues/getADData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
	    {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});

//for slots
jQuery('.datatable-19').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
		'sAjaxSource': base_url + 'venues/getSData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            //{"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": false},
           	{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		aoData.push({
                name: 'venueid',value: venueid});
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-22').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/slotslist',
		//'sAjaxSource':  'http://localhost/toss/ajax/slotslist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"sWidth": "12%","bVisible": true,  "bSearchable": true,  "bSortable": false},
            //{"sWidth": "13%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "15%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "11%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "5%", "bVisible": true,  "bSearchable": false, "bSortable": false},
			{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		aoData.push({
                name: 'venueid',
				value: venueid},
				{
				name: 'vendorid',
				value: vendorid

            });
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
				'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-32').DataTable({
	
	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/getADData',
		//'sAjaxSource':  'http://localhost/toss/vendors/slotslist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            { "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            { "bVisible": true, "bSearchable": false, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            { "bVisible": true, "bSearchable": false, "bSortable": false},
             { "bVisible": true, "bSearchable": false, "bSortable": false},
	    { "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
		aoData.push({
                name: 'venueid',
				value: venueid},
				{
				name: 'vendorid',
				value: vendorid
            });
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-33').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
		// 'sAjaxSource': 'http://localhost/toss/venues/getPData',
       'sAjaxSource': base_url + 'ajax/getPData',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": false},
                        {"bVisible": true, "bSearchable": true, "bSortable": false},
           	{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
		aoData.push({
                name: 'venueid',
				value: venueid
				},
				{
				name: 'vendorid',
				value: vendorid
				});
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-34').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
		'sAjaxSource': base_url + 'venues/customerslist',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": false},
           	{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		aoData.push({
                    name:'venueid',value:venueid
                });
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});

jQuery('.datatable-35').DataTable({ 
	
	    "bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
		'sAjaxSource': base_url + 'vendors/customerslist',
		"bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": true},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
            {"bVisible": true, "bSearchable": true, "bSortable": false},
			{"bVisible": true, "bSearchable": true, "bSortable": false},
           	{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],
		   
		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});
jQuery('.datatable-36').DataTable({

	"bAutoWidth": false,
        'bProcessing': true,
        'bServerSide': true	,
	    "sPaginationType": "full_numbers",
        'sAjaxSource': base_url + 'ajax/subsubcategorylist',
		//'sAjaxSource':  'http://localhost/toss/ajax/subcategorylist',
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 100,
        "aLengthMenu": [[100, 200, 500], [100, 200, 500]],
        "aaSorting": [[1, 'asc']],
	    "aoColumns": [
            {"sWidth": "10%", "bVisible": true, "bSearchable": true, "bSortable": true},
            {"sWidth": "22%","bVisible": true, "bSearchable": true, "bSortable": false},
            {"sWidth": "22%", "bVisible": true, "bSearchable": true, "bSortable": false},
			{"sWidth": "22%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false},
			{"sWidth": "10%", "bVisible": true, "bSearchable": false, "bSortable": false}
           ],

		'fnServerData': function (sSource, aoData, fnCallback) { //alert("I am in commonjs");
		//alert(aoData);
		//alert(sSource);
            jQuery.ajax
            ({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
            });

        },"bDestroy":true
});

});