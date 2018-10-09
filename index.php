<?php
require_once __DIR__ . "/config.inc.php";
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
	
		<div class="column">
			<div class="quarter-screen top">
				<?php
				require_once __DIR__ . '/php/source_data.php';
				?>
			</div>
			
			<div class="quarter-screen bottom">
				<?php
				require_once __DIR__ . '/php/source_form.php';
				?>
			</div>
		</div>
		
		<div class="column column-mid">
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
				require_once __DIR__ . '/php/destination_data.php';
				?>
			</div>
			
			<div class="quarter-screen bottom">
				<?php
				require_once __DIR__ . '/php/destination_form.php';
				?>
			</div>
		</div>
		
	<script type="text/javascript" src="index.js"></script>
	</body>
</html>