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

$params = [];

// query vhffs
if ($_GET['action'] === 'users') {
	$sql = "
		SELECT	u.username
		FROM	vhffs_users u
		ORDER BY u.username ASC
	";
}

else if ($_GET['action'] === 'projects') {
	$sql = "
		SELECT	DISTINCT g.groupname
		FROM	vhffs_user_group ug, vhffs_groups g, vhffs_users u
		WHERE	ug.gid = g.gid
		AND		ug.uid = u.uid
		" . (empty($_GET['username']) ? "" : "AND		u.username = ?") . "
		ORDER BY g.groupname ASC
	";
	if (!empty($_GET['username'])) {
		$params[] = $_GET['username'];
	}
}

else if ($_GET['action'] === 'websites') {
	$sql = "
		SELECT	DISTINCT h.servername
		FROM	vhffs_httpd h, vhffs_object o, vhffs_groups g
		WHERE	h.object_id = o.object_id
		AND		o.owner_gid = g.gid
		" . (empty($_GET['projectname']) ? "" : "AND		g.groupname = ?") . "
		ORDER BY h.servername ASC
	";
	if (!empty($_GET['projectname'])) {
		$params[] = $_GET['projectname'];
	}
}

$stmt_vhffs = $dbh_vhffs->prepare($sql);
if ($stmt_vhffs === false) {
	echo $dbh_vhffs->errorCode() . " : ". $dbh_vhffs->errorInfo()[2];
	die;
}

$stmt_vhffs->execute($params);
$array = $stmt_vhffs->fetchAll(PDO::FETCH_COLUMN);

if (is_array($array)) {
	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($array);
}
