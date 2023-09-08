$(document).ready(function() {
	const base_url = $('#base_url').val();
	const clusterId = $('#cluster_id');
	const centerId = $('#center_id');
	const dummy_image = base_url+ 'assets/images/no_image.png'

	// Function to handle the "Select All" checkbox
	$('#selectAllCheckbox').on('change', function () {
		var isChecked = $(this).prop('checked'); // Check if the "Select All" checkbox is checked
		
		// Find all the checkboxes in the DataTable's body and set their checked status
		$('#yourDataTable tbody input[type="checkbox"]').prop('checked', isChecked);
		
		// Your custom logic here when the "Select All" checkbox is clicked
		if (isChecked) {
			// Handle the case when "Select All" is checked
			console.log('All checkboxes are selected.');
		} else {
			// Handle the case when "Select All" is unchecked
			console.log('All checkboxes are deselected.');
		}
	});
	
	// Event handler for clicking a checkbox in the DataTable's body
	$(document).on('change', '#userTable tbody input[type="checkbox"]', function () {
		// Your custom logic here when a checkbox in the DataTable's body is clicked
		var isChecked = $(this).prop('checked');
		var userId = $(this).val();
		if (isChecked) {
			console.log('Checkbox with value ' + userId + ' is selected.');
		} else {
			console.log('Checkbox with value ' + userId + ' is deselected.');
		}
	});
});
