<link rel="stylesheet" href="<?php echo base_url('siteassets\css\style-main.css'); ?>">
<!-- <div class="content-wrapper" style="min-height: 397px;">   
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> My Profile <small></small></h1>
    </section>
    <section class="content"> -->
        <?php //echo "<pre>"; print_r($student); echo "</pre>"; ?>
        <div class="row">
            <div class="col-md-3">                
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url($student->picture); ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo ucfirst($student->firstname); ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Admission Number</b> <a class="pull-right text-aqua"><?php echo $student->user_id; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Roll Number</b> <a class="pull-right text-aqua"><?php echo $student->user_id; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo display('center_name'); ?></b> <a class="pull-right text-aqua"><?php echo $student->center_name; ?></a>
                            </li>
                            <!-- <li class="list-group-item">
                                <b>Class</b> <a class="pull-right text-aqua"><?php echo $student->class; ?></a>
                            </li> -->
                            <li class="list-group-item">
                                <b>Age Group</b> <a class="pull-right text-aqua"><?php echo $student->age; ?> yrs</a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b> <a class="pull-right text-aqua"><?php echo ucfirst($student->sex); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Profile</a></li>
                        <!-- <li class=""><a href="#fee" data-toggle="tab" aria-expanded="true">Fees</a></li>
                        <li class=""><a href="#exam" data-toggle="tab" aria-expanded="true">Exam</a></li>
                        <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true">Documents</a></li>
                        <li class=""><a href="#timelineh" data-toggle="tab" aria-expanded="true">Timeline</a></li> -->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="tshadow mb25 bozero">
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped">
                                        <tbody>  
                                            <tr>
                                                <td class="col-md-4">Admission Date</td>
                                                <td class="col-md-5"><?php echo date('d-M-Y',strtotime($student->create_date)); ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Date Of Birth</td>
                                                <td>11/01/2010</td>
                                            </tr> 
                                            <tr>
                                                <td>Category</td>
                                                <td><?php echo $student->socail_status; ?></td>
                                            </tr> -->
                                            <tr>
                                                <td>Mobile Number</td>
                                                <td><?php echo $student->mobile; ?></td>
                                            </tr>
                                             
                                            <!--<tr>
                                                <td>Religion</td>
                                                <td>Islam</td>
                                            </tr> -->
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $student->email; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div></div> 
                            <div class="tshadow mb25 bozero">   
                                <h3 class="pagetitleh2">Address </h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped"><tbody>
                                            <tr>
                                                <td>District</td>
                                                <td><?php echo $student->district; ?></td>
                                            </tr>
                                           <!--  <tr>
                                                <td>Block</td>
                                                <td><?php echo $student->block; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Village</td>
                                                <td><?php echo $student->village; ?></td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                            <div class="tshadow mb25 bozero">      
                                <h3 class="pagetitleh2">Parent / Guardian Details </h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped">
                                        <tbody><tr>
                                            <td class="col-md-4">Father Name</td>
                                            <td class="col-md-5"><?php echo $student->father_name; ?></td>
                                            <td rowspan="1"><img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('siteassets/images/no_image.png' ); ?>"></td>
                                        </tr>

                                        <!-- <tr>
                                            <td>Father Occupation</td>
                                            <td><?php echo $student->father_occup; ?></td>
                                        </tr> -->
                                        <tr>
                                            <td>Mother Name</td>
                                            <td><?php echo $student->mother_name; ?></td>
                                            <td rowspan="1"><img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('siteassets/images/no_image.png' ); ?>"></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Mother Occupation</td>
                                            <td><?php echo $student->mother_occup; ?></td>
                                        </tr> -->
                                        <!-- <tr>
                                            <td>Guardian Name</td>
                                            <td></td>
                                            <td rowspan="3"><img class="profile-user-img img-responsive img-circle" src="http://127.0.0.1/septest/uploads/student_images/no_image.png"></td>
                                        </tr>
                                        <tr>
                                            <td>Guardian Email</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Guardian Relation</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Guardian Phone</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Guardian Occupation</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Guardian Address</td>
                                            <td></td>
                                        </tr> -->
                                        </tbody>
                                    </table>
                                </div>

                            </div> 
                            <div class="tshadow mb25  bozero">    
                                <h3 class="pagetitleh2">Miscellaneous Details</h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            <!-- <tr>
                                                <td class="col-md-4">Current Educational Status</td>
                                                <td class="col-md-5"><?php echo $student->school_status; ?></td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td class="col-md-4">Type of school</td>
                                                <td class="col-md-5"><?php echo $student->school_type; ?></td>
                                            </tr> -->
                                            <tr>
                                                <td class="col-md-4">Level of School</td>
                                                <td class="col-md-5"><?php echo $student->school_level; ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td class="col-md-4">Name of school</td>
                                                <td class="col-md-5"><?php echo $student->school_name; ?></td>
                                            </tr> -->
                                            <tr>
                                                <td class="col-md-4">Others</td>
                                                <td class="col-md-5"><?php echo $student->school_status; ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td class="col-md-4">Remarks</td>
                                                <td class="col-md-5"><?php echo $student->remarks; ?></td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td class="col-md-4">National Identification Number</td>
                                                <td class="col-md-5"></td>
                                            </tr>
                                            <tr>
                                                <td>Local Identification Number</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Account Number</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Name</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>IFSC Code</td>
                                                <td></td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>
                        <div class="tab-pane" id="fee">
                            <div class="alert alert-danger">No Record Found</div>    
                        </div>   
                        <div class="tab-pane" id="timelineh">
                            <div class="timeline-header no-border">
                                <div id="timeline_list">
                                    <div class="alert alert-info">No Record Found</div>
                                </div>
                                <!-- <h2 class="page-header"> </h2> -->
                            </div>
                        </div>                      
                        <div class="tab-pane" id="documents">
                            <div class="timeline-header no-border">
                                <button type="button" data-student-session-id="24" class="btn btn-xs btn-primary pull-right myTransportFeeBtn mb10"> <i class="fa fa-upload"></i>  Upload Documents</button>

                                <div class="table-responsive" style="clear: both;">                          
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Name</th>
                                                <th class="mailbox-date text-right">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-danger text-center">No Record Found</td>
                                            </tr>
                                        </tfoot>                  
                                    </table>
                                </div> 
                            </div>
                            
                        </div>                        
                        <div class="tab-pane" id="exam">
                            <div class="tshadow mb25"> 
                                                                    <div class="alert alert-danger">
                                        No Record Found                                    </div>
                                                                    </div>  
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    <!-- </section> 
</div> -->

