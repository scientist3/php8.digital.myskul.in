<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/center") ?>"> <i class="fa fa-list"></i>  <?php echo display('list_center') ?> </a>  
                </div>
            </div> 
            <?php //echo "<pre>"; print_r($center); echo "</pre>"; ?>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('dashboard_org/center/create','class="form-inner"') ?>

                            <?php echo form_hidden('center_id',$center->center_id); ?>

                            <div class="form-group row">
                                <label for="center_name" class="col-xs-3 col-form-label"><?php echo display('center_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="center_name" type="text" class="form-control" id="center_name" placeholder="<?php echo display('center_name') ?>" value="<?php echo $center->center_name ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="center_cluster_id" class="col-xs-3 col-form-label"><?php echo display('cluster_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('center_cluster_id', $cluster_list, $center->center_cluster_id, 'class="form-control" id="center_cluster_id" '); ?>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="center_head_id" class="col-xs-3 col-form-label"><?php echo display('animator') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('center_head_id', $animator_list, $center->center_head_id, 'class="form-control" id="center_head_id" '); ?>
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