<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/message") ?>"> <i class="fa fa-inbox"></i>  <?php echo display('inbox') ?> </a>
                    <a class="btn btn-info" href="<?php echo base_url("dashboard_org/message/sent") ?>"> <i class="fa fa-share"></i>  <?php echo display('sent') ?> </a>
                </div> 
            </div>

            <div class="panel-body  panel-form">
                <div class="row">
                    <div id="output" class="hide alert"></div>
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('dashboard_org/message/new_message/','class="form-inner" id="message_form"') ?>
                            

                            <div class="form-group row">
                                <label for="user_role" class="col-xs-3 col-form-label"><?php echo display('designation') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                   <?php
                                        echo form_dropdown('user_role', $user_role_list1, $user_role, 'class="form-control" id="user_role" '); 
                                    ?>
                                    <span class="user_role_error"></span>
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label for="receiver_id" class="col-xs-3 col-form-label"><?php echo display('receiver_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('receiver_id', $user_list, 
												!empty($this->session->userdata('receiver_id')) ? 
													$this->session->userdata('receiver_id'):
													$message->receiver_id ,'class="form-control" id="receiver_id"') ?>
                                </div>
                            </div>
							<!--
                            <div class="form-group row">
                                <label for="subject" class="col-xs-3 col-form-label"><?php echo display('subject')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="subject"  type="text" class="form-control" id="subject" placeholder="<?php echo display('subject')?>" value="<?php echo $message->subject ?>">
                                </div>
                            </div>
							-->
                            <div class="form-group row">
                                <label for="message" class="col-xs-3 col-form-label"><?php echo display('message') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="message" class="form-control tinymce"  placeholder="<?php echo display('message') ?>"  rows="7"><?php echo $message->message ?></textarea>
                                </div>
                            </div>
<!-- 
                            <div class="form-group row">
                                <label for="attach_file" class="col-xs-3 col-form-label"><?php echo display('attach_file') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input type="file" name="attach_file" id="attach_file">

                                    <input type="hidden" name="hidden_attach_file" id="hidden_attach_file" value="<?php echo $message->picture ?>">

                                    <p id="upload-progress" class="hide alert"></p>
                                </div>
                            </div> -->  
                            
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
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
$(function(){
    /*
    var browseFile = $('#attach_file');
    var form       = $('#message_form');
    var progress   = $("#upload-progress");
    var hiddenFile = $("#hidden_attach_file");
    var output     = $("#output");
    
    browseFile.on('change',function(e)
    {
        e.preventDefault(); 
        uploadData = new FormData(form[0]);
        //console.log(uploadData);

        $.ajax({
            url      : '<?php echo base_url('messages/message/do_upload') ?>',
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
    */
});
</script>

<script type="text/javascript">
$(function(){
    //department_id
    $("#user_role").change(function(){
        var output = $('.user_role_error'); 
        var receiver_id = $('#receiver_id');
        
        $.ajax({
            url  : '<?= base_url('dashboard_org/message/user_by_role/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                user_role : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    receiver_id.html(data.message);
                    //available_day.html(data.available_days);
                    output.html('');
                } else if (data.status == false) {
                    receiver_id.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    receiver_id.html('');
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