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
		website = $(this).val();
		$("#src_url_host").val(website);
		
		user = $("select#src_user").val();
		project = $("select#src_project").val();
		$("#src_shell_directory").val("/data/home/"+user.substring(0,1)+"/"+user.substring(1,2)+"/"+user+"/"+project+"/"+website+"-web/htdocs");
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
