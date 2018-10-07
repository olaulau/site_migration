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

		<div class="quarter-screen">
			<?php
			require_once __DIR__ . '/php/source_data.php';
			?>
		</div>
		
		<div class="quarter-screen">
			<?php
			require_once __DIR__ . '/php/destination_data.php';
			?>
		</div>

<br/>

		<div class="quarter-screen">
			<?php
			require_once __DIR__ . '/php/source_form.php';
			?>
		</div>
		
		<div class="quarter-screen">
			<?php
			require_once __DIR__ . '/php/destination_form.php';
			?>
		</div>
	
	<script type="text/javascript" src="index.js"></script>
	</body>
</html>