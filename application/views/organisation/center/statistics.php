<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/center/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_center') ?> </a>
                </div>
            </div>

            <?php //echo "<pre>"; print_r($centers[0]); echo "</pre>"; ?>
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('center_name') ?></th>
                            <th><?php echo display('cluster') ?></th>
                            <th><?php echo display('animator') ?></th>
                            <!-- <th><?php echo display('date') ?></th> 
                            <th><?php echo display('status') ?></th>  -->
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($centers)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($centers as $center) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $center->center_name; ?></td>
                                    <td><?php echo $center->cluster_name; ?></td>
                                    <td><?php echo $center->firstname; ?></td>
                                    <!-- <td><?php echo character_limiter(strip_tags($org->org),50); ?></td>
                                    <td><?php echo date('d M Y h:i:s a', strtotime($org->datetime)); ?></td>   
                                    <td><?php echo (($org->receiver_status == 0) ? "<i class='label label-warning'>not seen</label>" : "<i class='label label-success'>seen</label>"); ?></td>-->
                                    <td class="center" width="80">
                                        <a href="<?php echo base_url("dashboard_org/center/edit/$center->center_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("dashboard_org/center/delete/$center->center_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
 
 