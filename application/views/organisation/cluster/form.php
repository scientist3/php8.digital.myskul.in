<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/cluster") ?>"> <i class="fa fa-list"></i>  <?php echo display('list_cluster') ?> </a>  
                </div>
            </div> 
            <?php //echo "<pre>"; print_r($cluster); echo "</pre>"; ?>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('dashboard_org/cluster/create','class="form-inner"') ?>

                            <?php echo form_hidden('cluster_id',$cluster->cluster_id); ?>

                            <div class="form-group row">
                                <label for="cluster_name" class="col-xs-3 col-form-label"><?php echo display('cluster') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="cluster_name" type="text" class="form-control" id="cluster_name" placeholder="<?php echo display('cluster') ?>" value="<?php echo $cluster->cluster_name ?>" >
                                </div>
                            </div>
                            
                            <!-- <div class="form-group row">
                                <label for="cluster_org_id" class="col-xs-3 col-form-label"><?php echo display('org') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('cluster_org_id', $org_list, $cluster->cluster_org_id, 'class="form-control" id="cluster_org_id" readonly'); ?>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <label for="cluster_head_id" class="col-xs-3 col-form-label"><?php echo display('coodinator') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('cluster_head_id', $coodinator_list, $cluster->cluster_head_id, 'class="form-control" id="cluster_head_id" '); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>