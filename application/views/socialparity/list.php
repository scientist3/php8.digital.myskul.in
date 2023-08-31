<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Social Parity List</h3>
			</div>
			<div class="card-body">
				<table id="social-parity-table" class="table table-bordered">
					<thead>
					<tr>
						<th>ID</th>
						<th>Category Name</th>
						<th>Description</th>
						<th>Status</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#social-parity-table').DataTable({
			"ajax": "<?php echo site_url('SocialParityController/get_all_records'); ?>",
			"columns": [
				{"data": "id"},
				{"data": "catagory_name"},
				{"data": "description"},
				{"data": "status"}
			]
		});
	});
</script>