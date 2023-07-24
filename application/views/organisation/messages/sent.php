<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_org/message/new_message") ?>"> <i class="fa fa-send-o"></i>  <?php echo display('new_message') ?> </a>
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/message") ?>"> <i class="fa fa-inbox"></i>  <?php echo display('inbox') ?> </a> 
                </div> 
            </div>
			<?php //echo "<pre>"; echo $group_by; print_r($messages); echo "</pre>"; ?>
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th><?php echo display('serial') ?></th> -->
                            <th><?php echo display('name') ?></th>
                            <!-- <th><?php echo display('subject') ?></th> -->
                            <?php if($group_by!=1){ ?>  
                            <th><?php echo display('message') ?></th>
                            <th><?php echo display('date') ?></th> 
							<th><?php echo display('status') ?></th> 
                            <!-- <th><?php echo display('action') ?></th>  -->
							<?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($messages)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($messages as $message) { ?>
                                <tr>
                                    <!-- <td><?php echo $sl; ?></td> -->
                                    <td><a href="<?php echo base_url("dashboard_org/message/sent/$message->receiver_id") ?>" class=""><?php echo $message->receiver_name; ?></a></td>
                                    <!-- <td><?php echo $message->subject; ?></td> -->
                                    <?php if($group_by!=1){ ?>
                                    <td><?php echo character_limiter(strip_tags($message->message),10); ?>  &nbsp;<a href="<?php echo base_url("dashboard_org/message/sent_information/$message->id/$message->receiver_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"> read more</i></a></td>
                                    <td><?php echo date('d M Y h:i:s a', strtotime($message->datetime)); ?></td> 
									<td><?php echo (($message->receiver_status == 0) ? "<i class='label label-warning'>not seen</label>" : "<i class='label label-success'>seen</label>"); ?></td> 
                                    <!-- <td class="center" width="80">
                                        <a href="<?php echo base_url("dashboard_org/message/sent_information/$message->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>  
                                        <a href="<?php echo base_url("dashboard_org/message/delete/$message->id/$message->sender_id/$message->receiver_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                    </td> -->
									<?php } ?>
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
 
 