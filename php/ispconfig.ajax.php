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
	FROM		sys_group g
	INNER JOIN	web_domain do ON do.sys_groupid = g.groupid
	INNER JOIN	web_database_user dbu ON db.database_user_id = dbu.database_user_id
	INNER JOIN	web_database db ON db.parent_domain_id = do.domain_id
	ORDER BY	group_name ASC, domain_name ASC, database_name ASC, database_user ASC
";



$params = [];

// query ispconfig
if ($_GET['action'] === 'users') {
	$sql = "
		SELECT		DISTINCT g.name AS group_name
		FROM		sys_group g
		ORDER BY	group_name ASC
	";
}

else if ($_GET['action'] === 'websites') {
	$sql = "
		SELECT		DISTINCT do.domain AS domain_name
		FROM		web_database db
		INNER JOIN	web_domain do ON db.parent_domain_id = do.domain_id
		INNER JOIN	sys_group g ON do.sys_groupid = g.groupid
		" . (empty($_GET['user']) ? "" : "WHERE		g.name = ?") . "
		ORDER BY	domain_name ASC
	";
	if (!empty($_GET['user'])) {
		$params[] = $_GET['user'];
	}
}

else if ($_GET['action'] === 'shellusers') {
	$sql = "
		SELECT		DISTINCT su.username AS username
		FROM		shell_user su
		INNER JOIN	web_domain do ON su.parent_domain_id = do.domain_id
		" . (empty($_GET['website']) ? "" : "WHERE		do.domain = ?") . "
		ORDER BY	username ASC
	";
	if (!empty($_GET['website'])) {
		$params[] = $_GET['website'];
	}
}

else if ($_GET['action'] === 'dbusers') {
	$sql = "
		SELECT		DISTINCT dbu.database_user AS database_user
		FROM		sys_group g
		INNER JOIN	web_domain do ON do.sys_groupid = g.groupid
		INNER JOIN	web_database db ON db.parent_domain_id = do.domain_id
		INNER JOIN	web_database_user dbu ON db.database_user_id = dbu.database_user_id
		" . (empty($_GET['website']) ? "" : "WHERE		do.domain = ?") . "
		ORDER BY	database_user ASC
	";
	if (!empty($_GET['website'])) {
		$params[] = $_GET['website'];
	}
}

else if ($_GET['action'] === 'dbnames') {
	$sql = "
		SELECT		DISTINCT db.database_name AS database_name
		FROM		sys_group g
		INNER JOIN	web_domain do ON do.sys_groupid = g.groupid
		INNER JOIN	web_database db ON db.parent_domain_id = do.domain_id
		INNER JOIN	web_database_user dbu ON db.database_user_id = dbu.database_user_id
		" . (empty($_GET['dbuser']) ? "" : "WHERE		dbu.database_user = ?") . "
		ORDER BY	database_name ASC
	";
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

$array = $stmt_ispconfig->fetchAll(PDO::FETCH_COLUMN);

if (is_array($array)) {
	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($array);
}
