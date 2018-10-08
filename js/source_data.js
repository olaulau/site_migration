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


function loadGroups () {
	var url = 'php/vhffs.ajax.php?action=projects';
	var user = $("select#user").val();
	if (! $.isEmptyObject(user)) {
		url = url + "&username=" + user;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("project", result, true, true, true);
			}
		}
	);
}


function loadWebsites () {
	var url = 'php/vhffs.ajax.php?action=websites';
	var project = $("select#project").val();
	if (! $.isEmptyObject(project)) {
		url = url + "&projectname=" + project;
	}
	$.ajax(url,
		{success: function(result){
				fill_select("website", result, true, true, true);
			}
		}
	);
}


$(function() {
	
	// users
	$("select#user").change(function(value){
		loadGroups ();
	});
	$.ajax('php/vhffs.ajax.php?action=users',
		{success: function(result){
				fill_select("user", result, true, true, true);
			}
		}
	);
	
	
	// projects
	$("select#project").change(function(value){
		loadWebsites ();
	});
	loadGroups();
	
	
	// website
	$("select#website").change(function(value){
//		alert("website change");
	});
	loadWebsites();
	
});
