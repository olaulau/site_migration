<?php
require_once __DIR__ . "/../config.inc.php";


// connexion vhffs
$vhffs_dsn = "pgsql:host=$vhffs_db_host;port=$vhffs_db_port;dbname=$vhffs_db_name";
try {
	$dbh_vhffs = new PDO($vhffs_dsn, $vhffs_db_user, $vhffs_db_password);
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


// display vhffs
?>
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
<?php
