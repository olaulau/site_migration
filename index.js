/**
 * 
 */

$(function(){
	$("table tr").click(function() {
		var table = $(this).parent().parent();
		var side = table.attr("id");
		
		table.find("tr").css("background-color", "white");
		$(this).css("background-color", "yellow");
		
		var domain = $(this).find("td#domain").html();
		$("#"+side+"_url_host").val(domain);
		
		var db_name = $(this).find("td#db_name").html();
		$("#"+side+"_db_name").val(db_name);
		var db_user = $(this).find("td#db_user").html();
		$("#"+side+"_db_user").val(db_user);
	});
});