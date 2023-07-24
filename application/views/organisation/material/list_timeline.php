	 <?php //echo "<pre>"; print_r($materials); echo "</pre>"; ?>
		<!-- Main content -->
		<section class="content">
			<!-- row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default thumbnail">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-2">
									<div class="btn-group"> 
										<a class="btn btn-primary" href="<?php echo base_url("dashboard_org/material") ?>"> <i class="fa fa-list"></i>  <?php echo display('view_material') ?> </a> 
									</div>			
								</div>
								<div class="col-md-8 text-center">
									<ul class="pagination" style="margin: 0px;">
										<?php 
										foreach ($links as $link) {
											echo $link;
										} ?>
									</ul> 								
								</div>
							</div>
						</div>
						<div class="panel-body panel-form">
							<div class="row">
								<div class="col-md-12">
									<!-- The time line -->
									<ul class="timeline">
									<?php foreach ($materials as $k => $material): ?>
										<?php if($material->mat_type==1){ ?>
											<li>
												<i class="fa fa-video-camera bg-maroon"></i>

												<div class="timeline-item">
													<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M Y',strtotime($material->mat_date)); ?></span>

													<h3 class="timeline-header"><a href="#"><?php echo $material->firstname; ?></a> shared a video of <?php echo $material->mat_title;?></h3>

													<div class="timeline-body">
														<div class="embed-responsive embed-responsive-16by9">
															<iframe class="embed-responsive-item" src="<?php echo $material->mat_video_link; ?>"
																			frameborder="0" allowfullscreen></iframe>
														</div>
													</div>
													<!-- <div class="timeline-footer">
														<a href="#" class="btn btn-xs bg-maroon">See comments</a>
													</div> -->
												</div>
											</li>
										<?php }else{ ?>
											<li>
												<i class="fa fa-file-pdf-o bg-blue"></i>

												<div class="timeline-item">
													<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M Y',strtotime($material->mat_date)); ?></span>

													<h3 class="timeline-header"><a href="#"><?php echo $material->firstname; ?></a> shares a document of <?php echo $material->mat_title;?></h3>

													<div class="timeline-body"><?php echo $material->mat_desc; ?>
													</div>
													<div class="timeline-footer">
														<a href="<?php echo base_url(); ?>dashboard_org/material/download/<?php echo $material->mat_doc_link ?>"class="btn btn-default btn-xs">
															<i class="fa fa-download"></i>
														</a>
														<!-- <a class="btn btn-success btn-xs" href="<?php echo empty($material->mat_doc_link)?'#':base_url($material->mat_doc_link); ?>">Download</a> -->
													</div>
												</div>
											</li>  
										<?php } ?>
									<?php endforeach ?>	
									</ul>
								</div>
								<!-- /.col -->
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-12 text-center">
									<ul class="pagination">
										<?php 
										foreach ($links as $link) {
											echo $link;
										} ?>
									</ul> 								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
