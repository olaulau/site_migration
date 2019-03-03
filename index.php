<?php
require_once __DIR__ . "/config.inc.php";
require_once __DIR__ . "/php/form.inc.php";
require_once __DIR__ . "/php/data.inc.php";

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
		<form action="migrate.php" method="post">
	
		<div class="column">
			<div class="quarter-screen top">
				<?php
				echo_data ('src');
				?>
			</div>
			
			<div class="quarter-screen bottom">
				<?php
				echo_form ('src', $src_shell_host, $src_shell_user);
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
				<?php
				echo_data ('dest');
				?>
			</div>
			
			<div class="quarter-screen bottom">
				<?php
				echo_form ('dest', $dest_shell_host, $dest_shell_user);
				?>
			</div>
		</div>
		
		<div class="column small">
			<button class="btn btn-lg btn-success">GO</button>
		</div>
	
		</form>
		
		<script type="text/javascript" src="index.js"></script>
	</body>
</html>