<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Social Parity Form</h3>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="form-group">
						<label for="catagory_name">Category Name:</label>
						<input type="text" name="catagory_name" class="form-control" value="<?php echo isset($record) ? $record->catagory_name : ''; ?>">
					</div>

					<div class="form-group">
						<label for="description">Description:</label>
						<input type="text" name="description" class="form-control" value="<?php echo isset($record) ? $record->description : ''; ?>">
					</div>

					<div class="form-group">
						<label for="status">Status:</label>
						<input type="text" name="status" class="form-control" value="<?php echo isset($record) ? $record->status : ''; ?>">
					</div>

					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>