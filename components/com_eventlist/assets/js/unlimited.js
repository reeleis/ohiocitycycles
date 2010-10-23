

function unlimited_starter() {
	document.adminForm.onsubmit = submit_unlimited;
}

function include_unlimited($unlimited_name) {
	$("recurrence_counter").value=$unlimited_name;	// write the word "unlimited" in the textbox
	return false;
}

function submit_unlimited() {
	var $value = $("recurrence_counter").value;
	var $date_array = $value.split("-");
	if ($date_array.length < 3) {
		$("recurrence_counter").value = "0000-00-00";
	}
}