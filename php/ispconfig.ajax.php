<?php
require_once __DIR__ . "/../config.inc.php";


// connexion ispconfig

$ispconfig_dsn = "mysql:host={$src['db_host']};port={$src['db_port']};dbname={$src['db_name']}";
try {
	$dbh_ispconfig = new PDO($ispconfig_dsn, $src['db_user'], $src['db_password']);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}

// param check
if (empty($_GET['server_name'])) {
	die("no server_name provided");
}
$server_name = $_GET['server_name'];


$params = [];

// query ispconfig
if ($_GET['action'] === 'users') {
	$sql = "
		SELECT		DISTINCT g.name AS group_name
		FROM		web_domain do
		INNER JOIN	sys_group g ON do.sys_groupid = g.groupid
		INNER JOIN	server ON do.server_id = server.server_id
			AND		server.server_name = ?
		ORDER BY	group_name ASC
	";
	$params[] = $server_name;
}

else if ($_GET['action'] === 'websites') {
	$sql = "
		SELECT		DISTINCT do.domain AS domain_name, do.document_root as document_root
		FROM		web_domain do
		INNER JOIN	sys_group g ON do.sys_groupid = g.groupid
		INNER JOIN	server ON do.server_id = server.server_id
			AND		server.server_name = ?
		" . (empty($_GET['user']) ? "" : "WHERE		g.name = ?") . "
		ORDER BY	domain_name ASC
	";
	$params[] = $server_name;
	if (!empty($_GET['user'])) {
		$params[] = $_GET['user'];
	}
}

else if ($_GET['action'] === 'shellusers') {
	$sql = "
		SELECT		DISTINCT su.username AS username
		FROM		web_domain do
		INNER JOIN	shell_user su ON do.domain_id = su.parent_domain_id
		INNER JOIN	server ON do.server_id = server.server_id
			AND		server.server_name = ?
		" . (empty($_GET['website']) ? "" : "WHERE		do.domain = ?") . "
		ORDER BY	username ASC
	";
	$params[] = $server_name;
	if (!empty($_GET['website'])) {
		$params[] = $_GET['website'];
	}
}

else if ($_GET['action'] === 'dbusers') {
	$sql = "
		SELECT		DISTINCT dbu.database_user AS database_user
		FROM		web_domain do
		INNER JOIN	web_database db ON do.domain_id = db.parent_domain_id
		INNER JOIN	web_database_user dbu ON db.database_user_id = dbu.database_user_id
		INNER JOIN	server ON do.server_id = server.server_id
			AND		server.server_name = ?
		" . (empty($_GET['website']) ? "" : "WHERE		do.domain = ?") . "
		ORDER BY	database_user ASC
	";
	$params[] = $server_name;
	if (!empty($_GET['website'])) {
		$params[] = $_GET['website'];
	}
}

else if ($_GET['action'] === 'dbnames') {
	$sql = "
		SELECT		DISTINCT db.database_name AS database_name
		FROM		web_domain do
		INNER JOIN	web_database db ON db.parent_domain_id = do.domain_id
		INNER JOIN	web_database_user dbu ON db.database_user_id = dbu.database_user_id
		INNER JOIN	server ON do.server_id = server.server_id
			AND		server.server_name = ?
		" . (empty($_GET['dbuser']) ? "" : "WHERE		dbu.database_user = ?") . "
		ORDER BY	database_name ASC
	";
	$params[] = $server_name;
	if (!empty($_GET['dbuser'])) {
		$params[] = $_GET['dbuser'];
	}
}

$stmt_ispconfig = $dbh_ispconfig->prepare($sql);
$res = $stmt_ispconfig->execute($params);
if ($res === false) {
	echo $stmt_ispconfig->errorCode() . " : ". $stmt_ispconfig->errorInfo()[2];
	die;
}

$array = $stmt_ispconfig->fetchAll(PDO::FETCH_NUM);
if (is_array($array)) {
	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($array);
}
