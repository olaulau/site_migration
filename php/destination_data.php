<?php
require_once __DIR__ . "/../config.inc.php";


// display ispconfig
?>
		<h2> DESTINATION </h2>
		<form>
			<label for="dest_server">SERVER</label>
			<select id="dest_server" name="dest_server">
				<option value=""></option>
			</select> <br/>
			<br/>
			
			<label for="dest_user">user</label>
			<select id="dest_user" name="dest_user">
				<option value=""></option>
			</select> <br/>
			
			<label for="dest_website">website</label>
			<select id="dest_website" name="dest_website">
				<option value=""></option>
			</select> <br/>
			
			<label for="dest_dbuser">dbuser</label>
			<select id="dest_dbuser" name="dest_dbuser">
				<option value=""></option>
			</select>
			<label for="dest_dbname">dbname</label>
			<select id="dest_dbname" name="dest_dbname">
				<option value=""></option>
			</select>
		</form>
<script type="text/javascript" src="js/destination_data.js"></script>
