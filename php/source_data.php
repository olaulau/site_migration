<?php
require_once __DIR__ . "/../config.inc.php";


// display vhffs
?>
		<h2> SOURCE </h2>
		<form>
			<label for="src_server">SERVER</label>
			<select id="src_server" name="src_server">
				<option value=""></option>
			</select> <br/>
			<br/>
			
			<label for="src_user">user</label>
			<select id="src_user" name="src_user">
				<option value=""></option>
			</select> <br/>
			
			<label for="src_project">project</label>
			<select id="src_project" name="src_project">
				<option value=""></option>
			</select> <br/>
			
			<label for="src_website">website</label>
			<select id="src_website" name="src_website">
				<option value=""></option>
			</select> <br/>
			
			<label for="src_dbname">dbname</label>
			<select id="src_dbname" name="src_dbname">
			</select> <br/>
		</form>
<script type="text/javascript" src="js/source_data.js"></script>
