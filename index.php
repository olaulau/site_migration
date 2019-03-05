<?php
require_once __DIR__ . "/config.inc.php";
require_once __DIR__ . "/php/functions.inc.php";
require_once __DIR__ . "/php/form.inc.php";
require_once __DIR__ . "/php/data.inc.php";

if (isset ($_GET['src_server'])) {
	$src_server = $_GET['src_server'];
}
if (isset ($_GET['dest_server'])) {
	$dest_server = $_GET['dest_server'];
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>migration</title>
		<script type="text/javascript" src="vendor/components/jquery/jquery.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="index.css" type="text/css">
	</head>
	<body>
		<div class="column">
			<div class="quarter-screen top">
				<h2> SOURCE </h2>
				
				<form id="server_form" action="" method="get"></form>
				<label for="src_server">SERVER</label>
				<select form="server_form" id="src_server" name="src_server">
					<option value=""></option>
					<?php
					generate_select_options ($servers, 'name', 'name', $src_server);
					?>
				</select>
				<br/>
				<br/>
				
				<?php
				if (!empty ($src_server)) {
					echo_data ('src', 'ispconfig');
				}
				else {
					?>
					<p>please select a server if you want easy website migration</p>
					<?php
				}
				?>
			</div>
			
			<form id="migrate_form" action="migrate.php" method="post"></form>
			<div class="quarter-screen bottom">
				<?php
				echo_form ('src', $src['shell_host'], $src['shell_user']);
				?>
			</div>
		</div>
		
		<div class="column small">
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
			=> <br/>
		</div>
		
		<div class="column">
			<div class="quarter-screen top">
				<h2> DESTINATION </h2>
				<label for="dest_server">SERVER</label>
				<select form="server_form" id="dest_server" name="dest_server">
					<option value=""></option>
					<?php
					generate_select_options ($servers, 'name', 'name', $dest_server);
					?>
				</select>
				<br/>
				<br/>
				<?php
				if (!empty ($dest_server)) {
					echo_data ('dest', 'ispconfig');
				}
				else {
					?>
					<p>please select a server if you want easy website migration</p>
					<?php
				}
				?>
			</div>
			
			<div class="quarter-screen bottom">
				<?php
				echo_form ('dest', $dest['shell_host'], $dest['shell_user']);
				?>
			</div>
		</div>
		
		<div class="column small">
			<button form="migrate_form" class="btn btn-lg btn-success">GO</button>
		</div>
	
		<script type="text/javascript" src="index.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
<!-- 		<script type="text/javascript" src="js/vhffs_data.js"></script> -->
		<script type="text/javascript" src="js/ispconfig_data.js"></script>
		<script type="text/javascript">
			var urlParams = new URLSearchParams(window.location.search);
			src_server = urlParams.getAll('src_server');
			dest_server = urlParams.getAll('dest_server');
			if (src_server && src_server !== "" && dest_server && dest_server !== "") {
				ispconfigLoadData ('src',  src_server);
				ispconfigLoadData ('dest', dest_server);
			}
		</script>
	</body>
</html>
