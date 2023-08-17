<!-- Main content -->
<!-- Timelime example  -->
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-primary float-right" href="<?php echo base_url("organisation/cmaterial") ?>"> <i class="fa fa-chevron-left"></i> <?php echo display('view_material') ?> </a>
	</div>
	<div class="col-md-12">
		<!-- The time line -->
		<div class="timeline">
			<?php if ($material->mat_type == 1) : ?>
				<div class="time-label">
					<span class="bg-red"><?php echo date('d M Y', strtotime($material->mat_date)); ?></span>
				</div>
				<div>
					<i class="fas fa-video bg-maroon"></i>

					<div class="timeline-item">
						<span class="time"><i class="fas fa-clock"></i> <?php echo time_elapsed_string($material->mat_date); ?></span>

						<h3 class="timeline-header"><a href="#"><?php echo $material->firstname; ?></a> shared a video</h3>

						<div class="timeline-body">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $material->mat_video_link; ?>	" allowfullscreen></iframe>
							</div>
						</div>
						<div class="timeline-footer d-none">
							<a href="#" class="btn btn-sm bg-maroon">See comments</a>
						</div>
					</div>
				</div>
			<?php elseif ($material->mat_type == 2) : ?>
				<div class="time-label">
					<span class="bg-red"><?php echo date('d M Y', strtotime($material->mat_date)); ?></span>
				</div>
				<div>
					<i class="fas fa-envelope bg-blue"></i>
					<div class="timeline-item">
						<span class="time"><i class="fas fa-clock"></i> <?php echo time_elapsed_string($material->mat_date); ?></span>
						<h3 class="timeline-header"><a href="#"><?php echo $material->firstname; ?></a> shared a document</h3>

						<div class="timeline-body">
							<?php echo $material->mat_desc; ?>
						</div>
						<div class="timeline-footer">
							<a class="btn btn-primary btn-sm d-none">Read more</a>
							<a class="btn btn-danger btn-sm d-none">Delete</a>
							<a class="btn btn-primary btn-sm " href="<?php echo base_url(); ?>organisation/cmaterial/download/<?php echo $material->mat_id ?>"> <i class="fa fa-download"></i></a>

						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="time-label">
				<span class="bg-red"><?php echo date('d M. Y'); ?></span>
			</div>
			<div>
				<i class="fas fa-user bg-green"></i>
				<div class="timeline-item">
					<!-- <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span> -->
					<h3 class="timeline-header no-border"><a href="#">As of <?php echo date('d M. Y'); ?> The total visits/view are : </a> <strong class="text-success"><?php echo $total_views; ?></strong></h3>
				</div>
			</div>
		</div>
		</>
	</div>
</div>
