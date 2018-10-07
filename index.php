<?php
require_once __DIR__ . "/config.inc.php";
?>

<?php
// connexion vhffs
$vhffs_dsn = "pgsql:host=$vhffs_db_host;port=$vhffs_db_port;dbname=$vhffs_db_name";
try {
	$dbh_vhffs = new PDO($vhffs_dsn, $vhffs_db_user, $vhffs_db_password);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}



// connexion ispconfig
$ispconfig_dsn = "mysql:host=$ispconfig_db_host;port=$ispconfig_db_port;dbname=$ispconfig_db_name";
try {
	$dbh_ispconfig = new PDO($ispconfig_dsn, $ispconfig_db_user, $ispconfig_db_password);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}



// query vhffs
$sql = "
	SELECT g1.groupname, h.servername, m.dbname, m.dbuser
	FROM vhffs_httpd h, vhffs_mysql m, vhffs_object o1, vhffs_groups g1, vhffs_groups g2, vhffs_object o2
	WHERE	h.object_id = o1.object_id
		AND	g1.gid = o1.owner_gid
		AND	g1.gid = g2.gid
		AND	g2.gid = o2.owner_gid
		AND	m.object_id = o2.object_id
	ORDER BY g1.groupname ASC, h.servername ASC, m.dbname ASC

;";
$stmt_vhffs = $dbh_vhffs->query($sql);
if ($stmt_vhffs === false) {
	echo $dbh_vhffs->errorCode() . " : ". $dbh_vhffs->errorInfo()[2];
	die;
}
$dbh_vhffs = null;



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



?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta charset="UTF-8">
		<title>migration</title>
		<script type="text/javascript" src="vendor/components/jquery/jquery.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="index.css" type="text/css">
	</head>
	<body>


<?php
// display vhffs
?>
		<div class="quarter-screen">
		<h2> SOURCE </h2>
		<table id="src" class="decorated">
			<thead>
				<tr>
					<th>groupname</th>
					<th>servername</th>
					<th>dbname</th>
					<th>dbuser</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach($stmt_vhffs as $row) {
	?>
				<tr>
					<td id=""><?= $row['groupname'] ?></td>
					<td id="domain"><?= $row['servername'] ?></td>
					<td id="db_name"><?= $row['dbname'] ?></td>
					<td id="db_user"><?= $row['dbuser'] ?></td>
				</tr>
	<?php
}
?>
			</tbody>
		</table>
		</div>




<?php
// display ispconfig
?>
		<div class="quarter-screen">
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
		</div>

<br/>

		<div class="quarter-screen">
			<form action="" name="" method="">
				<h4>shell</h4>
				
				<label for="src_shell_host">host</label>
				<input type="text" id="src_shell_host" name="src_shell_host" value="<?= $src_shell_host ?>" placeholder="src_shell_host"> <br/>
				
				<label for="src_shell_user">user</label>
				<input type="text" id="src_shell_user" name="src_shell_user" value="<?= $src_shell_user ?>" placeholder="src_shell_user"> <br/>
				
				<label for="src_shell_password">password</label>
				<input type="password" id="src_shell_password" name="src_shell_password" value="" placeholder="src_shell_password"> <br/>
				
				<label for="src_shell_directory">directory</label>
				<input type="text" id="src_shell_directory" name="src_shell_directory" value="" placeholder="src_shell_directory"> <br/>
				
				<h4>db</h4>
				
				<label for="src_db_name">name</label>
				<input type="text" id="src_db_name" name="src_db_name" value="" placeholder="src_db_name"> <br/>
				
				<label for="src_db_user">user</label>
				<input type="text" id="src_db_user" name="src_db_user" value="" placeholder="src_db_user"> <br/>
				
				<label for="src_db_password">password</label>
				<input type="password" id="src_db_password" name="src_db_password" value="" placeholder="src_db_password"> <br/>
				
				<h4>url</h4>
				
				<label for="src_url_scheme">scheme</label>
				<input type="text" id="src_url_scheme" name="src_url_scheme" value="" placeholder="src_url_scheme"> <br/>
				
				<label for="src_url_host">host</label>
				<input type="text" id="src_url_host" name="src_url_host" value="" placeholder="src_url_host"> <br/>
				
				<label for="src_url_directory">directory</label>
				<input type="text" id="src_url_directory" name="src_url_directory" value="" placeholder="src_url_directory"> <br/>
			</form>
		</div>
		
		<div class="quarter-screen">
			<form action="" name="" method="">
				<h4>shell</h4>
				
				<label for="dest_shell_host">host</label>
				<input type="text" id="dest_shell_host" name="dest_shell_host" value="<?= $dest_shell_host ?>" placeholder="dest_shell_host"> <br/>
				
				<label for="dest_shell_user">user</label>
				<input type="text" id="dest_shell_user" name="dest_shell_user" value="" placeholder="dest_shell_user"> <br/>
				
				<label for="dest_shell_password">password</label>
				<input type="password" id="dest_shell_password" name="dest_shell_password" value="" placeholder="dest_shell_password"> <br/>
				
				<label for="dest_shell_directory">directory</label>
				<input type="text" id="dest_shell_directory" name="dest_shell_directory" value="" placeholder="dest_shell_directory"> <br/>
				
				<h4>db</h4>
				
				<label for="dest_db_name">name</label>
				<input type="text" id="dest_db_name" name="dest_db_name" value="" placeholder="dest_db_name"> <br/>
				
				<label for="dest_db_user">user</label>
				<input type="text" id="dest_db_user" name="dest_db_user" value="" placeholder="dest_db_user"> <br/>
				
				<label for="dest_db_password">password</label>
				<input type="password" id="dest_db_password" name="dest_db_password" value="" placeholder="dest_db_password"> <br/>
				
				<h4>url</h4>
				
				<label for="dest_url_scheme">scheme</label>
				<input type="text" id="dest_url_scheme" name="dest_url_scheme" value="" placeholder="dest_url_scheme"> <br/>
				
				<label for="dest_url_host">host</label>
				<input type="text" id="dest_url_host" name="dest_url_host" value="" placeholder="dest_url_host"> <br/>
				
				<label for="dest_url_directory">directory</label>
				<input type="text" id="dest_url_directory" name="dest_url_directory" value="" placeholder="dest_url_directory"> <br/>
			</form>
		</div>
	
	<script type="text/javascript" src="index.js"></script>
	</body>
</html>