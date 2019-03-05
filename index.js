$(function(){
	
	// refresh on any server change
	$("#src_server, #dest_server").change(function(){
		$("#server_form").submit();
	});
	
	// if server parameters are present, load corresponding data
	var urlParams = new URLSearchParams(window.location.search);
	src_server = urlParams.get('src_server');
	if (src_server && src_server !== "") {
		ispconfigLoadData ('src',  src_server);
	}
	dest_server = urlParams.get('dest_server');
	if (dest_server && dest_server !== "") {
		ispconfigLoadData ('dest', dest_server);
	}
	
});