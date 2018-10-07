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
	INNER JOIN	web_database_user dbu ON db.database_id = dbu.database_user_id
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
		<table id="dest" class="decorated">
			<thead>
				<tr>
					<th>group_name</th>
					<th>domain_name</th>
					<th>database_name</th>
					<th>database_user</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach($stmt_ispconfig as $row) {
	?>
				<tr>
					<td id=""><?= $row['group_name'] ?></td>
					<td id="domain"><?= $row['domain_name'] ?></td>
					<td id="db_name"><?= $row['database_name'] ?></td>
					<td id="db_user"><?= $row['database_user'] ?></td>
				</tr>
	<?php
}
?>
			</tbody>
		</table>
<?php
