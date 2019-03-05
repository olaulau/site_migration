function fill_select (select_id, values, clearFirst, addEmptyValue, selectAloneValue) {
	var oldValue = $("select#"+select_id).val();
	
	if (clearFirst) {
		$("select#"+select_id).empty();
	}
	
	if (addEmptyValue) {
		$('<option value"0"> </option>').appendTo("select#"+select_id);
	}
	
	$.each(values, function(key, value) {
		value = value[0];
		$('<option value"'+value+'">'+value+'</option>').appendTo("select#"+select_id);
	});
	
	if (selectAloneValue) {
		if (values.length == 1) {
			$("select#"+select_id).val(values[0]);
		}
	}
	
	var newValue = $("select#"+select_id).val();
	if (newValue != oldValue) {
		$("select#"+select_id).change();
	}
}
