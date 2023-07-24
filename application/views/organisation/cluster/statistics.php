<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <div class="btn-group">
                    <h3>Cluster Statistics</h3>
                </div>
            </div>

            <?php //echo "<pre>"; print_r($clusters[0]); echo "</pre>"; ?>
            <?php //echo "<pre>"; print_r($center_array); echo "</pre>"; ?>
            <?php //echo "<pre>"; print_r($std_by_cl_array); echo "</pre>"; ?>
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('cluster') ?></th>
                            <th><?php echo display('total_center') ?></th>
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
                                    <td><?php 
										echo (array_key_exists($cluster->cluster_id,$center_array))?
											'<a href="'.base_url("dashboard_org/cluster/statistics/$cluster->cluster_id").'">'.$center_array[$cluster->cluster_id].'</a>':0;
										?>
									</td>
                                    <td><?php echo (array_key_exists($cluster->cluster_id,$std_by_cl_array))?
													$std_by_cl_array[$cluster->cluster_id]:0;
										?>
									</td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

 <div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <div class="btn-group">
                    <h3><?php echo display('center');?> Statistics</h3>
                </div>
            </div>

            <?php //echo "<pre>"; print_r($center_list[0]); echo "</pre>"; ?>
            <?php //echo "<pre>"; print_r($center_array); echo "</pre>"; ?>
            <?php //echo "<pre>"; print_r($std_by_cl_array); echo "</pre>"; ?>
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('center') ?></th>
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
                                    <?php /*<td><?php 
										echo (array_key_exists($center->cluster_id,$center_array))?
											'<a href="'.base_url("dashboard_org/cluster/statistics/$center->cluster_id").'">'.$center_array[$center->cluster_id].'</a>':0;
										?>
									</td> */ ?>
                                    <td><?php echo (array_key_exists($center->center_id,$std_by_cen_array))?
													$std_by_cen_array[$center->center_id]:0;
										?>
									</td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
 
 