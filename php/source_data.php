<?php
require_once __DIR__ . "/../config.inc.php";


// display vhffs
?>
		<h2> SOURCE </h2>
		<form>
			<label for="server">SERVER</label>
			<select id="server" name="server">
				<option value=""></option>
			</select> <br/>
			<br/>
			
			<label for="user">user</label>
			<select id="user" name="user">
				<option value=""></option>
			</select> <br/>
			
			<label for="project">project</label>
			<select id="project" name="project">
				<option value=""></option>
			</select> <br/>
			
			<label for="website">website</label>
			<select id="website" name="website">
				<option value=""></option>
			</select> <br/>
			
			<label for="dbname">dbname</label>
			<select id="dbname" name="dbname">
			</select> <br/>
			
		</form>
<script type="text/javascript" src="js/source_data.js"></script>
<?php
