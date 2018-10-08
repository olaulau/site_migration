<?php
require_once __DIR__ . "/../config.inc.php";


// connexion ispconfig
$ispconfig_dsn = "mysql:host=$ispconfig_db_host;port=$ispconfig_db_port;dbname=$ispconfig_db_name";
try {
	$dbh_ispconfig = new PDO($ispconfig_dsn, $ispconfig_db_user, $ispconfig_db_password);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}


// query ispconfig
$sql = "
	SELECT		g.name AS group_name, do.domain AS domain_name, db.database_name AS database_name, dbu.database_user AS database_user
	FROM		web_database db
	INNER JOIN	web_domain do ON db.parent_domain_id = do.domain_id
	INNER JOIN	sys_group g ON do.sys_groupid = g.groupid
	INNER JOIN	web_database_user dbu ON db.database_user_id = dbu.database_user_id
	ORDER BY	group_name ASC, domain_name ASC, database_name ASC, database_user ASC
;";
$stmt_ispconfig = $dbh_ispconfig->query($sql);
if ($stmt_ispconfig === false) {
	echo $dbh_ispconfig->errorCode() . " : ". $dbh_ispconfig->errorInfo()[2];
	die;
}
$dbh_ispconfig = null;


// display ispconfig
?>
		<h2> DESTINATION </h2>
		<form>
			<label for="dest_server">SERVER</label>
			<select id="dest_server" name="dest_server">
				<option value=""></option>
			</select> <br/>
			<br/>
			
			<label for="dest_user">user</label>
			<select id="dest_user" name="dest_user">
				<option value=""></option>
			</select> <br/>
			
			<label for="dest_project">project</label>
			<select id="dest_project" name="dest_project">
				<option value=""></option>
			</select> <br/>
			
			<label for="dest_website">website</label>
			<select id="dest_website" name="dest_website">
				<option value=""></option>
			</select> <br/>
			
			<label for="dest_dbname">dbname</label>
			<select id="dest_dbname" name="dest_dbname">
			</select> <br/>
		</form>
<script type="text/javascript" src="js/destination_data.js"></script>
