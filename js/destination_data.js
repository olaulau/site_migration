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


function loadIspconfigGroups () {
	var url = 'php/vhffs.ajax.php?action=projects';
	var user = $("select#dest_user").val();
	if (! $.isEmptyObject(user)) {
		url = url + "&username=" + user;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("dest_project", result, true, true, true);
			}
		}
	);
}


function loadIspconfigWebsites () {
	var url = 'php/vhffs.ajax.php?action=websites';
	var project = $("select#dest_project").val();
	if (! $.isEmptyObject(project)) {
		url = url + "&projectname=" + project;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("dest_website", result, true, true, true);
			}
		}
	);
}


function loadIspconfigDbnames () {
	var url = 'php/vhffs.ajax.php?action=dbnames';
	var project = $("select#dest_project").val();
	if (! $.isEmptyObject(project)) {
		url = url + "&projectname=" + project;
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
		loadIspconfigGroups ();
	});
	$.ajax('php/vhffs.ajax.php?action=users',
		{success: function(result){
				fill_select("dest_user", result, true, true, true);
			}
		}
	);
	
	// projects
	$("select#dest_project").change(function(value){
		loadIspconfigWebsites ();
		loadIspconfigDbnames();
	});
	loadIspconfigGroups();
	
	// website
	$("select#dest_website").change(function(value){
		val = $(this).val();
		$("#dest_url_host").val(val);
	});
	loadIspconfigWebsites();
	
	// dbnames
	$("select#dest_dbname").change(function(value){
		val = $(this).val();
		$("#dest_db_name").val(val);
		$("#dest_db_user").val(val);
	});
	loadIspconfigDbnames();
	
});
