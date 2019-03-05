function loadIspconfigUsers (side, server_name) {
	$.ajax('php/ispconfig.ajax.php?server_name='+server_name+'&action=users',
		{success: function(result){
				fill_select(side+"_user", result, true, true, true);
			}
		}
	);
}


function loadIspconfigWebsites (side, server_name) {
	var url = 'php/ispconfig.ajax.php?server_name='+server_name+'&action=websites';
	var user = $("select#"+side+"_user").val();
	if (! $.isEmptyObject(user)) {
		url = url + "&user=" + user;
	}
	$.ajax(url,
		{success: function(result){
				window[side+'_websites'] = result; // store websites associated with webroot for later use
				fill_select(side+"_website", result, true, true, true);
			}
		}
	);
}


function loadIspconfigShellusers (side, server_name) {
	var url = 'php/ispconfig.ajax.php?server_name='+server_name+'&action=shellusers';
	var website = $("select#"+side+"_website").val();
	if (! $.isEmptyObject(website)) {
		url = url + "&website=" + website;
	}
	$.ajax(url,
		{success: function(result) {
				fill_select (side+"_shelluser", result, true, true, true);
			}
		}
	);
}


function loadIspconfigDbusers (side, server_name) {
	var url = 'php/ispconfig.ajax.php?server_name='+server_name+'&action=dbusers';
	var website = $("select#"+side+"_website").val();
	if (! $.isEmptyObject(website)) {
		url = url + "&website=" + website;
	}
	$.ajax(url,
		{success: function(result){
				fill_select(side+"_dbuser", result, true, true, true);
			}
		}
	);
}


function loadIspconfigDbnames (side, server_name) {
	var url = 'php/ispconfig.ajax.php?server_name='+server_name+'&action=dbnames';
	var dbuser = $("select#"+side+"_dbuser").val();
	if (! $.isEmptyObject(dbuser)) {
		url = url + "&dbuser=" + dbuser;
	}
	$.ajax(url,
		{success: function(result){
				fill_select(side+"_dbname", result, true, true, true);
			}
		}
	);
}


function ispconfigLoadData (side, server_name) {
	// users
	$("select#"+side+"_user").change(function(value){
		loadIspconfigWebsites (side, server_name);
	});
	loadIspconfigUsers (side, server_name);
	
	// website
	$("select#"+side+"_website").change(function(value){
		website = $(this).val();
		$("#"+side+"_url_host").val(website);
		loadIspconfigDbusers (side, server_name);
		loadIspconfigShellusers (side, server_name);
		if (! $.isEmptyObject(website)) {
			websites = window[side+'_websites'];
			var webroot;
			for (var i = 0; i < websites.length; i++) {
				var current_website = websites[i];
				if (current_website[0] == website) {
					webroot = current_website[1];
				}
			}
			$("#"+side+"_shell_directory").val(webroot+"/web");
		}
		else {
			$("#"+side+"_shell_directory").val("");
		}
		
	});
	loadIspconfigWebsites (side, server_name);
	
	// shelluser
	$("select#"+side+"_shelluser").change(function(value){
		$("#"+side+"_shell_user").val($(this).val());
	});
	loadIspconfigShellusers (side, server_name);
	
	// dbusers
	$("select#"+side+"_dbuser").change(function(value){
		$("#"+side+"_db_user").val($(this).val());
		loadIspconfigDbnames (side, server_name);
	});
	loadIspconfigDbusers (side, server_name);
	
	// dbnames
	$("select#"+side+"_dbname").change(function(value){
		$("#"+side+"_db_name").val($(this).val());
	});
	loadIspconfigDbnames (side, server_name);
}
