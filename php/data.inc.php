<?php

function echo_data ($side) {
	if ($side === 'src') {
		?>
		<h2> SOURCE </h2>
		
		<label for="src_server">SERVER</label>
		<select id="src_server">
			<option value=""></option>
		</select>
		<br/>
		<br/>
		
		<label for="src_user">user</label>
		<select id="src_user">
			<option value=""></option>
		</select>
		<label for="src_project">project</label>
		<select id="src_project">
			<option value=""></option>
		</select>
		<br/>
		
		<label for="src_website">website</label>
		<select id="src_website">
			<option value=""></option>
		</select>
		<br/>
		
		<label for="src_dbname">dbname</label>
		<select id="src_dbname">
		</select>
		
		<script type="text/javascript" src="js/source_data.js"></script>
		<?php
	}
	elseif ($side === 'dest') {
		?>
		<h2> DESTINATION </h2>
		
		<label for="dest_server">SERVER</label>
		<select id="dest_server">
		<option value=""></option>
		</select>
		<br/>
		<br/>
		
		<label for="dest_user">user</label>
		<select id="dest_user">
		<option value=""></option>
		</select>
		<br/>
		
		<label for="dest_website">website</label>
		<select id="dest_website">
		<option value=""></option>
		</select>
		<label for="dest_shelluser">shelluser</label>
		<select id="dest_shelluser">
		<option value=""></option>
		</select>
		<br/>
		
		<label for="dest_dbuser">dbuser</label>
		<select id="dest_dbuser">
		<option value=""></option>
		</select>
		<label for="dest_dbname">dbname</label>
		<select id="dest_dbname">
		<option value=""></option>
		</select>
		
		<script type="text/javascript" src="js/destination_data.js"></script>
		<?php
	}
	else {
		die ("wrong side");
	}
}
