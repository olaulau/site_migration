<?php

function generate_select_options ($array, $value_indice=null, $label_indice=null, $selected_value=null) {
	foreach ($array as $key => $row) {
		if (!empty ($value_indice)) {
			$value = $row[$value_indice];
		}
		else {
			$value = $key;
		}
		
		if (!empty ($label_indice)) {
			$label = $row[$label_indice];
		}
		else {
			if (!is_array ($row)) {
				$label = $row;
			}
			else {
				$label = $key;
			}
		}
		
		$selected = '';
		if ($value === $selected_value) {
			$selected = 'selected="selected"';
		}
		?>
		<option value="<?= $value ?>" <?= $selected ?>> <?= $label ?> </option>
		<?php
	}
}


function search2dArray ($array, $column, $value) {
	foreach ($array as $row) {
		if ($row[$column] === $value) {
			return $row;
		}
	}
	return null;
}
