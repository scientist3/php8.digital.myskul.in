<div class="row">
    <!--  table area -->
    <div class="col-sm-12" id="PrintMe">
        <div class="panel panel-default thumbnail">
            <?php //echo "<pre>"; print_r($message); echo "</pre>"; ?>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_org/message/new_message") ?>"> <i class="fa fa-send-o"></i>  <?php echo display('new_message') ?> </a>
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/message") ?>"> <i class="fa fa-inbox"></i>  <?php echo display('inbox') ?> </a>
                    <a class="btn btn-info" href="<?php echo base_url("dashboard_org/message/sent") ?>"> <i class="fa fa-share"></i>  <?php echo display('sent') ?> </a>
					<a class="btn btn-info" href="<?php echo base_url("dashboard_org/message/reply/".$message->receiver_id) ?>"> <i class="fa fa-share"></i>  <?php echo 'Reply' ?> </a>

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i></button> 
                </div> 
            </div>
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt><?php echo display('sender') ?></dt>
                    <dd><?php echo $this->session->userdata('fullname') ?></dd>
                    <dt><?php echo display('receiver_name') ?></dt>
                    <dd><?php echo $message->receiver_name ?></dd>
                    <dt><?php echo display('date') ?></dt>
                    <dd><?php echo date('d M Y h:i:s a', strtotime($message->datetime)) ?></dd>
                    <!-- <dt><?php echo display('subject') ?></dt>
                    <dd><?php echo $message->subject ?></dd> -->
                    <hr>
                    <dt><?php echo display('message') ?></dt> 
                    <dd><?php echo $message->message ?></dd>
                    <!-- <dt><?php echo 'Download Attachment';//display('download') ?></dt>
                    <dd><?php 
                        if(!empty($message->picture))
                        {?>
                            <a download href="<?php echo base_url($message->picture) ?>" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a>
                        <?php
                        }else{
                            echo 'No File Attached';
                        }
                        ?></dd> -->
                </dl>
            </div> 
        </div>
    </div> 

</div>
 

  


