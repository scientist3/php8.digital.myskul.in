    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-group"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text">Total Students</span>
              <span class="info-box-number"><?php echo number($tot_students); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-child"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text">Total Orphans</span>
              <span class="info-box-number"><?php echo number($tot_orphans); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-lime"><i class="fa fa-wheelchair"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text">Total disabled</span>
              <span class="info-box-number"><?php echo number($tot_disabled); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-olive"><i class="fa fa-university"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text">Total School Drop Out</span>
              <span class="info-box-number"><?php echo number($tot_drop_out); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-black"><i class="fa fa-male"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text ">Boys 6-11</span>
              <span class="info-box-number"><?php echo number($boys_6_11); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-male"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text ">Boys 12-18</span>
              <span class="info-box-number"><?php echo number($boys_12_18); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-black"><i class="fa fa-female"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text">Girls 6-11</span>
              <span class="info-box-number"><?php echo number($girls_6_11); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-female"></i></span>

            <div class="info-box-content bg-maroon">
              <span class="info-box-text">Girls 12-18</span>
              <span class="info-box-number"><?php echo number($girls_12_18); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo display('select_criteria'); ?></h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="row">
                        <form role="form" action="<?php echo site_url('dashboard_org/user/index') ?>" method="post" class="">
                            <?php //echo $this->customlib->getCSRF(); ?>
                            <!-- <div class="col-sm-3">
                                <div class="form-group"> 
                                    <label><?php echo display('designation'); ?></label> <small class="req"> *</small>
                                    <?php echo form_dropdown('user_role', $user_role_list1, $user_role/*$this->session->userdata('site_id') */,'class="form-control" id="user_role" '); ?>
                                    <span class="text-danger"><?php echo form_error('user_role'); ?></span>
                                </div>  
                            </div> -->
				
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label><?php echo display('cluster'); ?></label> <small class="req"> *</small>
                                    <?php echo form_dropdown('cluster_id', $cluster_list, $cluster_id/*$this->session->userdata('site_id') */,'class="form-control" id="cluster_id" '); ?>
                                    <span class="text-danger"><?php echo form_error('cluster_id'); ?></span>
                                </div>   
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label><?php echo display('center'); ?></label> <small class="req"> *</small>
                                    <?php echo form_dropdown('center_id', $center_list, $center_id/*$this->session->userdata('site_id') */,'class="form-control" id="center_id" '); ?>
                                    <span class="text-danger"><?php echo form_error('center_id'); ?></span>
                                </div>   
                            </div>

                            <!-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label><?php echo display('date'); ?></label> <small class="req"> *</small>
                                    <input name="date" class="form-control " type="date" placeholder="<?php echo display('date') ?>" id="date"  value="<?php echo $date ?>">
                                    <span class="text-danger"><?php echo form_error('center_id'); ?></span>
                                </div>   
                            </div> -->

                            <div class="col-sm-3 pull-right">
                                <div class="form-group">
                                    <label> &nbsp;</label> 
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle form-control"><i class="fa fa-search"></i> <?php echo display('search'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    </div>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group "> 
                            <a class="btn btn-info" href="<?php echo base_url("dashboard_org/user/create_student") ?>"> 
                                <i class="fa fa-plus"></i>  <?php echo display('add_student') ?> 
                            </a>
                            <a class="btn btn-success" href="<?php echo base_url("dashboard_org/user/create_member") ?>"> 
                                <i class="fa fa-plus"></i>  <?php echo display('add_member') ?> 
                            </a>
                            <a class="btn btn-success" href="<?php echo base_url("dashboard_org/user/members") ?>"> 
                                <i class="fa fa-list"></i>  <?php echo display('list_user') ?> 
                            </a>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <?php //echo "<pre>"; print_r($users[0]); echo "</pre>"; ?>
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- user_id firstname   mobile  email   password    user_role   picture district    block   village school_type school_level    school_name sex age class   school_status   father_name father_occup    mother_name mother_occup    socail_status   center_id   remarks created_by  create_date update_date status -->
                            <th><?php echo display('serial') ?></th>
                            <!-- <th><?php echo display('picture') ?></th>  -->
                            <th><?php echo display('first_name') ?></th>
                            <!-- <th><?php echo display('sex') ?></th> -->
                            <th><?php echo display('mobile') ?></th>
							<th><?php echo display('email') ?></th>
                            <th><?php echo display('district') ?></th>
                            <th><?php echo display('sex') ?></th>
                            <th><?php echo display('age') ?></th>
                            <th><?php echo display('center_name') ?></th>
                            <th style="width:80px !important;"><?php echo display('action') ?></th>
                            <!-- <th><?php echo display('school_type') ?></th>
                            <th><?php echo display('school_level') ?></th>
                            <th><?php echo display('school_name') ?></th>
                            <th><?php echo display('school_status') ?></th>
                            <th><?php echo display('father_name') ?></th>
                            <th><?php echo display('father_occup') ?></th>
                            <th><?php echo display('mother_name') ?></th>
                            <th><?php echo display('mother_occup') ?></th>
                            <th><?php echo display('socail_status') ?></th>
                            <th><?php echo display('remarks') ?></th>
                            <th><?php echo display('date') ?></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($users as $user) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
									<!--
									<td>
                                        <a target="_BLANK" href="<?php echo (!empty($user->picture)?base_url($user->picture):base_url("assetslte/images/no-img.png")) ?>"">
                                            <img alt="Picture" src="<?php echo (!empty($user->picture)?base_url($user->picture):base_url("assetslte/images/no-img.png")) ?>" class="img-thumbnail img-responsive" height="50px" width="50px">
                                        </a>
                                    </td> 
									-->
                                    <td><?php echo ucfirst($user->firstname); ?></td>
                                    <!-- <td><?php echo $user->sex; ?></td> -->
                                    <td><div class="contact"><div class="line"></div><a href="tel:+91<?php echo $user->mobile;?>"><?php echo $user->mobile; ?></a></div></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->district; ?></td>
                                    <!-- <td><?php echo $user->block; ?></td> -->
                                    <td><?php echo $user->sex; ?></td>
                                    <td><?php echo $user->age; ?></td>
                                    <td><?php echo $user->center_name; ?></td>
                                    <td style="width:90px !important;">
                                        <a href="<?php echo base_url("dashboard_org/user/stdprofile/$user->user_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("dashboard_org/user/stdedit/$user->user_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("dashboard_org/user/stddelete/$user->user_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
                                    </td>
                                    <!-- <td><?php echo $user->school_type; ?></td>
                                    <td><?php echo $user->school_level; ?></td>
                                    <td><?php echo $user->school_name; ?></td>
                                    <td><?php echo $user->school_status; ?></td>
                                    <td><?php echo $user->father_name; ?></td>
                                    <td><?php echo $user->father_occup; ?></td>
                                    <td><?php echo $user->mother_name; ?></td>
                                    <td><?php echo $user->mother_occup; ?></td>
                                    <td><?php echo $user->socail_status; ?></td>
                                    <td><?php echo $user->remarks; ?></td>
                                    <td><?php echo $user->create_date; ?></td> -->
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

<!-- jQuery 3 -->
<script src="<?php echo base_url('assetslte/'); ?>bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    //district
    /*$('#district').change(function(){
        alert('Hep');
    });*/
    $("#district").change(function(){
        var center_list1 = $('#center');
        var error = $('#error');
        
        $.ajax({
            url  : '<?= base_url('user/center_by_district/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                district : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    center_list1.html(data.center);
                    error.html('');
                } else {
                    center_list1.html('<option value="">Select Center</option>');
                    //error.html(data.center);
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