const StudentFormModule = (function () {
	const browseFile = $('#picture');
	const form = $('#student_form');
	const progress = $('#upload-progress');
	const hiddenFile = $('#old_picture');
	const output = $('#output');
	const preview = $('#picture-preview');
	
	function init() {
		const clusterId = $('#cluster_id');
		const centerId = $('#center_id');
		const error = $('#error');
		browseFile.on('change', function (e) {
			e.preventDefault();
			const uploadData = new FormData();
			uploadData.append('picture', browseFile[0].files[0]);
			uploadData.append('is_student_form', 1);
			uploadFile(uploadData);
		});
		
		$('#cluster_idd').change(function () {
			fetchCentersByCluster($(this).val());
		});
		fetchCentersByCluster(clusterId.val());
	}
	
	function uploadFile(uploadData) {
		$.ajax({
			url: StudentFormModule.uploadFileUrl,
			type: form.attr('method'),
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			data: uploadData,
			beforeSend: function () {
				hiddenFile.val('');
				progress.removeClass('d-none').html('<i class="fa fa-cog fa-spin"></i> Loading..');
			},
			success: function (data) {
				progress.addClass('d-none');
				if (data.status === false) {
					showMessage(data.exception, 'danger');
				} else if (data.status === true) {
					showMessage(data.message, 'info');
					hiddenFile.val(data.filepath);
					preview.attr('src', data.preview);
				}
			},
			error: function () {
				progress.addClass('d-none');
				showMessage('Failed to upload file.', 'danger');
			}
		});
	}
	
	function fetchCentersByCluster(clusterId) {
		const output = $('.cluster_error');
		const centerList = $('#center_id');
		$.ajax({
			url: StudentFormModule.centerUrl,
			type: 'post',
			dataType: 'json',
			data: {
				cluster_id: clusterId,
				center_idd: $('#hidden_center_id').val()
			},
			success: function (data) {
				if (data.status === true) {
					centerList.html(data.message);
					output.html('');
				} else {
					centerList.html('');
					output.html(data.message).addClass('text-danger').removeClass('text-success');
				}
			},
			error: function () {
				alert('Failed to fetch centers.');
			}
		});
	}
	
	function showMessage(message, type) {
		output.removeClass('d-none')
		.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + message)
		.removeClass('alert-info')
		.removeClass('alert-danger')
		.addClass('alert-' + type)
		.removeClass('hide');
	}
	
	// Update center select options
	function updateCenterOptions(selectElement, optionsHtml) {
		selectElement.html(optionsHtml);
	}
	return {
		init: init
	};
})();