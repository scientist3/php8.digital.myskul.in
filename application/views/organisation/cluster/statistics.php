<div class="row">
	<!--  table area -->
	<div class="col-sm-12">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-list"></i> Statistics</h3>
			</div>

			<div class="card-body">
				<table class="datatable table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th><?php echo display('serial') ?></th>
							<th><?php echo display('cluster') ?></th>
							<th><?php echo display('total_intervention_areas') ?></th>
							<th><?php echo display('total_students') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($clusters)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($clusters as $cluster) { ?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $cluster->cluster_name; ?></td>
									<td>
										<?php echo ($cluster->total_centers != 0) ? '<a href="' . base_url("organisation/ccluster/statistics/$cluster->cluster_id") . '">' . $cluster->total_centers . '</a>' : 0; ?>
									</td>
									<td>
										<?php echo ($cluster->total_students != 0) ? $cluster->total_students : 0; ?>
									</td>
								</tr>
								<?php $sl++; ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table> <!-- /.table-responsive -->
			</div>
		</div>
	</div>
</div>

<div class="row">
	<!--  table area -->
	<div class="col-sm-12">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-list"></i> <?php echo display('intervention_areas'); ?> Statistics</h3>
			</div>

			<div class="card-body">
				<table class="datatable table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th><?php echo display('serial') ?></th>
							<th><?php echo display('intervention_area') ?></th>
							<th><?php echo display('total_students') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($center_list)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($center_list as $center) { ?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $center->center_name; ?></td>
									<td>
										<?php echo ($center->total_students) ? $center->total_students : 0;
										?>
									</td>
								</tr>
								<?php $sl++; ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
