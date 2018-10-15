function fill_select (select_id, values, clearFirst, addEmptyValue, selectAloneValue) {
	var oldValue = $("select#"+select_id).val();
	
	if (clearFirst) {
		$("select#"+select_id).empty();
	}
	
	if (addEmptyValue) {
		$('<option value"0"> </option>').appendTo("select#"+select_id);
	}
	
	$.each(values, function(key, value) {
		$('<option value"'+value+'">'+value+'</option>').appendTo("select#"+select_id);
	});
	
	if (selectAloneValue) {
		if (values.length == 1) {
			$("select#"+select_id).val(values[0]);
		}
	}
	
	var newValue = $("select#"+select_id).val();
	if (newValue != oldValue) {
		$("select#"+select_id).change();
	}
}


function loadIspconfigUsers () {
	$.ajax('php/ispconfig.ajax.php?action=users',
		{success: function(result){
				fill_select("dest_user", result, true, true, true);
			}
		}
	);
}


function loadIspconfigWebsites () {
	var url = 'php/ispconfig.ajax.php?action=websites';
	var user = $("select#dest_user").val();
	if (! $.isEmptyObject(user)) {
		url = url + "&user=" + user;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("dest_website", result, true, true, true);
			}
		}
	);
}


function loadIspconfigShellusers () {
	var url = 'php/ispconfig.ajax.php?action=shellusers';
	var website = $("select#dest_website").val();
	if (! $.isEmptyObject(website)) {
		url = url + "&website=" + website;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("dest_shelluser", result, true, true, true);
			}
		}
	);
}


function loadIspconfigDbusers () {
	var url = 'php/ispconfig.ajax.php?action=dbusers';
	var website = $("select#dest_website").val();
	if (! $.isEmptyObject(website)) {
		url = url + "&website=" + website;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("dest_dbuser", result, true, true, true);
			}
		}
	);
}


function loadIspconfigDbnames () {
	var url = 'php/ispconfig.ajax.php?action=dbnames';
	var dbuser = $("select#dest_dbuser").val();
	if (! $.isEmptyObject(dbuser)) {
		url = url + "&dbuser=" + dbuser;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("dest_dbname", result, true, true, true);
			}
		}
	);
}


$(function() {
	
	// users
	$("select#dest_user").change(function(value){
		loadIspconfigWebsites ();
	});
	loadIspconfigUsers ();
	
	// website
	$("select#dest_website").change(function(value){
		website = $(this).val();
		$("#dest_url_host").val(website);
		loadIspconfigDbusers ();
		loadIspconfigShellusers ();
		
		$("#dest_shell_directory").val("/var/www/web/"+website+"/web");
	});
	loadIspconfigWebsites ();
	
	// shelluser
	$("select#dest_shelluser").change(function(value){
		$("#dest_shell_user").val($(this).val());
	});
	loadIspconfigShellusers ();
	
	// dbusers
	$("select#dest_dbuser").change(function(value){
		$("#dest_db_user").val($(this).val());
		loadIspconfigDbnames ();
	});
	loadIspconfigDbusers ();
	
	// dbnames
	$("select#dest_dbname").change(function(value){
		$("#dest_db_name").val($(this).val());
	});
	loadIspconfigDbnames ();
	
});
