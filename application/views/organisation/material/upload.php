<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/material") ?>"> <i class="fa fa-list"></i>  <?php echo display('view_material') ?> </a>  
                </div>
            </div>
			<?php //echo "<pre>"; print_r($material); echo "</pre>"; ?>
            <div class="panel-body panel-form">
                <div class="row">
					<div id="output" class="hide alert"></div>
					<div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('dashboard_org/material/create','class="form-inner" id="mailForm"') ?>
							
                            <?php echo form_hidden('mat_id',$material->mat_id); ?>
                            
							<div class="form-group row"> <!--pateint_name-->
                                <label for="mat_title" class="col-xs-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="mat_title" type="text" class="form-control" id="mat_title" placeholder="<?php echo display('title') ?>" value="<?php echo $material->mat_title ?>" >
                                </div>
                                    <?php
                                        //echo form_dropdown('r_patient_id', $patients_list, $material->r_patient_id, 'class="form-control" id="r_patient_id" ');

                                    ?>
                            </div>

                            <div class="form-group row">
                                <label for="mat_desc" class="col-xs-3 col-form-label"><?php echo display('description') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="mat_desc" class="form-control"  placeholder="<?php echo display('description') ?>" maxlength="140" rows="2"><?php echo $material->mat_desc ?></textarea>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-3"><?php echo display('type') ?><i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="mat_type" value="1" <?php echo  set_radio('mat_type', '1'); ?> ><?php echo display('video_link') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="mat_type" value="2" <?php echo  set_radio('mat_type', '2'); ?> ><?php echo display('attach_file') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group row" id="video_link" style="display: <?php echo ($material->mat_type==1)?'block':'none'; ?>;"> <!--pateint_name-->
                                <label for="mat_video_link" class="col-xs-3 col-form-label"><?php echo display('video_link') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="mat_video_link" type="text" class="form-control" id="mat_video_link" placeholder="<?php echo display('video_link') ?>" value="<?php echo $material->mat_video_link ?>" >

                                    <!-- <textarea name="mat_video_link" class="form-control"  placeholder="<?php echo display('description') ?>" maxlength="240" rows="3"><?php echo $material->mat_video_link ?></textarea> -->
                                </div>
                            </div>
                            <div class="form-group row" id="filetype" style="display: <?php echo ($material->mat_type==2)?'block':'none'; ?>;">
                                <label for="attach_file" class="col-xs-3 col-form-label"><?php echo display('attach_file') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input type="file" name="attach_file" id="attach_file" class="form-control">

                                    <input type="hidden" name="hidden_attach_file" id="hidden_attach_file" value="<?php echo $material->mat_doc_link ?>">

                                    <p id="upload-progress" class="hide alert"></p>
                                </div>
                            </div>
							
							<div class="form-group row">
                                <label for="cluster_idd" class="col-xs-3 col-form-label"><?php echo display('cluster_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                   <?php
                                        echo form_dropdown('cluster_idd', $cluster_list, $material->cluster_idd, 'class="form-control" id="cluster_idd" '); 
                                    ?>
                                    <span class="cluster_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="center_idd" class="col-xs-3 col-form-label"><?php echo display('center_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('center_idd','','','class="form-control" id="center_idd"') ?>
                                    <!-- <div id="available_days"></div> -->
                                </div>
                            </div>
							<!-- <div class="form-group row" id="video_link"> 
                                <label for="mat_date" class="col-xs-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="mat_date" type="text" class="form-control datetimepicker" id="mat_date" placeholder="<?php echo display('date') ?>" value="<?php echo empty($material->mat_date)?date('m/d/Y'):$material->mat_date; ?>" >
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="mat_status" value="1" <?php echo  set_radio('mat_status', '1', TRUE); ?> ><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="mat_status" value="0" <?php echo  set_radio('mat_status', '0'); ?> ><?php echo display('inactive') ?>
                                        </label>
                                    </div>
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

<script type="text/javascript">
$(function(){
    var browseFile = $('#attach_file');
    var form       = $('#mailForm');
    var progress   = $("#upload-progress");
    var hiddenFile = $("#hidden_attach_file");
    var output     = $("#output");

    browseFile.on('change',function(e)
    {
        e.preventDefault(); 
        uploadData = new FormData(form[0]);

        $.ajax({
            url      : '<?php echo base_url('dashboard_org/material/do_upload') ?>',
            type     : form.attr('method'),
            dataType : 'json',
            cache    : false,
            contentType : false,
            processData : false,
            data     : uploadData, 
            beforeSend  : function() 
            {
                hiddenFile.val('');
                progress.removeClass('hide').html('<i class="fa fa-cog fa-spin"></i> Loading..');
            },
            success  : function(data) 
            { 
                progress.addClass('hide');
                if (data.status == false) {
                    output.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+data.exception).addClass('alert-danger').removeClass('hide').removeClass('alert-info');
                } else if (data.status == true ) {
                    output.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+data.message).addClass('alert-info').removeClass('hide').removeClass('alert-danger');
                    hiddenFile.val(data.filepath);
                }  
            }, 
            error    : function() 
            {
                progress.addClass('hide');
                output.addClass('hide');
                alert('failed!');
            }   
        });
    });

    $("input[name=mat_type]").on('change',function(){
        var type =$(this).val();
        if(type==1){
            $('#video_link').show();
            $('#filetype').hide();
        }else{
            $('#video_link').hide();
            $('#filetype').show();
        }
        
    });

    $('.datetimepicker').datepicker({
        dateFormat: "dd-mm-yy HH:mm:ss"
    });
    //department_id
    $("#cluster_idd").change(function(){
        var output = $('.cluster_error'); 
        var center_list = $('#center_idd');
        //var available_day = $('#available_day');

        $.ajax({
            url  : '<?= base_url('dashboard_org/material/center_by_cluster/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                cluster_idd : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    center_list.html(data.message);
                    //available_day.html(data.available_days);
                    output.html('');
                } else if (data.status == false) {
                    center_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    center_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    }); 
});
</script>