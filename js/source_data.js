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


function loadVhffsUsers () {
	$.ajax('php/vhffs.ajax.php?action=users',
		{success: function(result){
				fill_select("src_user", result, true, true, true);
			}
		}
	);
}


function loadVhffsGroups () {
	var url = 'php/vhffs.ajax.php?action=projects';
	var user = $("select#src_user").val();
	if (! $.isEmptyObject(user)) {
		url = url + "&user=" + user;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("src_project", result, true, true, true);
			}
		}
	);
}


function loadVhffsWebsites () {
	var url = 'php/vhffs.ajax.php?action=websites';
	var project = $("select#src_project").val();
	if (! $.isEmptyObject(project)) {
		url = url + "&project=" + project;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("src_website", result, true, true, true);
			}
		}
	);
}


function loadVhffsDbnames () {
	var url = 'php/vhffs.ajax.php?action=dbnames';
	var project = $("select#src_project").val();
	if (! $.isEmptyObject(project)) {
		url = url + "&project=" + project;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("src_dbname", result, true, true, true);
			}
		}
	);
}


$(function() {
	
	// users
	$("select#src_user").change(function(value){
		loadVhffsGroups ();
	});
	loadVhffsUsers ();
	
	// projects
	$("select#src_project").change(function(value){
		loadVhffsWebsites ();
		loadVhffsDbnames();
	});
	loadVhffsGroups();
	
	// website
	$("select#src_website").change(function(value){
		val = $(this).val();
		$("#src_url_host").val(val);
	});
	loadVhffsWebsites();
	
	// dbnames
	$("select#src_dbname").change(function(value){
		val = $(this).val();
		$("#src_db_name").val(val);
		$("#src_db_user").val(val);
	});
	loadVhffsDbnames();
	
});
