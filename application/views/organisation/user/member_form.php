<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_org/user/members") ?>"> <i class="fa fa-list"></i>  <?php echo display('list_user') ?> </a>
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/user/create_student") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_student') ?> </a>
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_org/user") ?>"> <i class="fa fa-list"></i>  <?php echo display('list_student') ?> </a>

                </div>
            </div> 
            <?php //echo "<pre>"; print_r($student); echo "</pre>"; ?>
            <?php //echo "<pre>"; print_r($cluster_list); echo "</pre>"; ?>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('dashboard_org/user/create_member','class="form-inner"') ?>

                            <?php echo form_hidden('user_id',$student->user_id); ?>

                            <!-- <div class="form-group row">
                                <label for="student_id" class="col-xs-3 col-form-label"><?php echo display('student_id') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input readonly name="student_id" type="text" class="form-control" id="student_id" placeholder="<?php echo display('student_id') ?>" value="<?php echo $student->student_id ?>" >
                                </div>
                            </div> -->
                            
                            <div class="form-group row">
                                <label for="user_role" class="col-xs-3 col-form-label"><?php echo display('designation') ?> <i class="text-danger">*</i>    </label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('user_role', $user_role_list1, $student->user_role, 'class="form-control" id="user_role" '); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cluster_idd" class="col-xs-3 col-form-label"><?php echo display('cluster_name') ?>     </label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('cluster_idd', $cluster_list, $student->cluster_idd, 'class="form-control" id="cluster_idd" '); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firstname" class="col-xs-3 col-form-label"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $student->firstname ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-xs-3 col-form-label"><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile"  value="<?php echo $student->mobile ?>">
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="email" class="col-xs-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email') ?>" value="<?php echo $student->email ?>">
                                </div>
                            </div>
                            <!--<div class="form-group row">
                                <label for="password" class="col-xs-3 col-form-label"><?php echo display('password') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="password" type="password" class="form-control" id="password" placeholder="<?php echo display('password') ?>">
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <label for="district" class="col-xs-3 col-form-label"><?php echo display('district') ?>     </label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('district', $district_list, $student->district, 'class="form-control" id="district" '); ?>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('sex') ?> </label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="sex" value="male" <?php echo  set_radio('sex', 'Male', TRUE); ?> ><?php echo display('male') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="sex" value="Female" <?php echo  set_radio('sex', 'Female'); ?> ><?php echo display('female') ?>
                                        </label>
                                        <!-- <label class="radio-inline">
                                        <input type="radio" name="sex" value="Other" <?php echo  set_radio('sex', 'Other'); ?> ><?php echo display('other') ?>
                                        </label> -->
                                    </div>
                                </div>
                            </div>

                            <!-- if employee picture is already uploaded -->
                            <?php if(!empty($student->picture)) {  ?>
                            <div class="form-group row">
                                <label for="picturePreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($student->picture) ?>" alt="Picture" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="picture" class="col-xs-3 col-form-label"><?php echo display('picture') ?></label>
                                <div class="col-xs-9">
                                    <input type="file" name="picture" id="picture" value="<?php echo $student->picture ?>">
                                    <input type="hidden" name="old_picture" value="<?php echo $student->picture ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="block" class="col-xs-3 col-form-label"><?php echo display('block') ?></label>
                                <div class="col-xs-9">
                                    <input name="block" class="form-control" type="text" placeholder="<?php echo display('block') ?>" id="block"  value="<?php echo $student->block ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="village" class="col-xs-3 col-form-label"><?php echo display('village') ?></label>
                                <div class="col-xs-9">
                                    <input name="village" class="form-control" type="text" placeholder="<?php echo display('village') ?>" id="village"  value="<?php echo $student->village ?>">
                                </div>
                            </div>
                            <!--            
                            <div class="form-group row">
                                <label for="school_type" class="col-xs-3 col-form-label"><?php echo display('school_type') ?></label>
                                <div class="col-xs-9"> 
                                    <?php
                                        $school_type = array(
                                            ''   => display('select_option'),
                                            'Govt.' => 'Govt.',
                                            'Private' => 'Private'
                                        );
                                        echo form_dropdown('school_type', $school_type, $student->school_type, 'class="form-control" id="school_type" '); 
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="school_level" class="col-xs-3 col-form-label"><?php echo display('school_level') ?></label>
                                <div class="col-xs-9"> 
                                    <?php
                                        $school_level = array(
                                            ''   => display('select_option'),
                                            'Primary' => 'Primary',
                                            'Middle' => 'Middle',
                                            'High School' => 'High School'

                                        );
                                        echo form_dropdown('school_level', $school_level, $student->school_level, 'class="form-control" id="school_level" '); 
                                    ?>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="school_name" class="col-xs-3 col-form-label"><?php echo display('school_name') ?></label>
                                <div class="col-xs-9">
                                    <input name="school_name" class="form-control" type="text" placeholder="<?php echo display('school_name') ?>" id="school_name"  value="<?php echo $student->school_name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="school_status" class="col-xs-3 col-form-label"><?php echo display('school_status') ?></label>
                                <div class="col-xs-9"> 
                                    <?php
                                        $school_status = array(
                                            ''   => display('select_option'),
                                            'Never Enrolled' => 'Never Enrolled',
                                            'School Going' => 'School Going',
                                            'Drop Out' => 'Drop Out'

                                        );
                                        echo form_dropdown('school_status', $school_status, $student->school_status, 'class="form-control" id="school_status" '); 
                                    ?>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <label for="age" class="col-xs-3 col-form-label"><?php echo display('age') ?></label>
                                <div class="col-xs-9">
                                    <input name="age" class="form-control" type="text" placeholder="<?php echo display('age') ?>" id="age"  value="<?php echo $student->age ?>">
                                </div>
                            </div>
                            <!--
                            <div class="form-group row">
                                <label for="class" class="col-xs-3 col-form-label"><?php echo display('class') ?></label>
                                <div class="col-xs-9">
                                   <?php
                                        $class = array(
                                            ''   => display('select_option'),
                                            '1st' => '1st',
                                            '2nd' => '2nd',
                                            '3rd' => '3rd',
                                            '4th' => '4th',
                                            '5th' => '5th',
                                            '6th' => '6th',
                                            '7th' => '7th',
                                            '8th' => '8th',
                                            '9th' => '9th',
                                            '10th' => '10th',
                                            '11th' => '11th',
                                            '12th' => '12th'
                                        );
                                        echo form_dropdown('class', $class, $student->class, 'class="form-control" id="class" '); 
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="father_name" class="col-xs-3 col-form-label"><?php echo display('father_name') ?></label>
                                <div class="col-xs-9">
                                    <input name="father_name" class="form-control" type="text" placeholder="<?php echo display('father_name') ?>" id="father_name"  value="<?php echo $student->father_name ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="father_occup" class="col-xs-3 col-form-label"><?php echo display('father_occup') ?></label>
                                <div class="col-xs-9">
                                    <input name="father_occup" class="form-control" type="text" placeholder="<?php echo display('father_occup') ?>" id="father_occup"  value="<?php echo $student->father_occup ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mother_name" class="col-xs-3 col-form-label"><?php echo display('mother_name') ?></label>
                                <div class="col-xs-9">
                                    <input name="mother_name" class="form-control" type="text" placeholder="<?php echo display('mother_name') ?>" id="mother_name"  value="<?php echo $student->mother_name ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mother_occup" class="col-xs-3 col-form-label"><?php echo display('mother_occup') ?></label>
                                <div class="col-xs-9">
                                    <input name="mother_occup" class="form-control" type="text" placeholder="<?php echo display('mother_occup') ?>" id="mother_occup"  value="<?php echo $student->mother_occup ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="socail_status" class="col-xs-3 col-form-label"><?php echo display('socail_status') ?></label>
                                <div class="col-xs-9">
                                    <?php
                                        $socail_status = array(
                                            ''   => display('select_option'),
                                            'OM' => 'OM',
                                            'RBA' => 'RBA',
                                            'SC' => 'SC',
                                            'ST' => 'ST',
                                            'EWS' => 'EWS',
                                            'PSP' => 'PSP',
                                            'OSC' => 'OSC',
                                            'ALC/IB' => 'ALC/IB'
                                        );
                                        echo form_dropdown('socail_status', $socail_status, $student->socail_status, 'class="form-control" id="socail_status" '); 
                                    ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="create_date" class="col-xs-3 col-form-label"><?php echo display('enrol_date') ?></label>
                                <div class="col-xs-9">
                                    <input name="create_date" class="form-control " type="date" placeholder="<?php echo display('enrol_date') ?>" id="create_date"  value="<?php echo $student->create_date ?>">
                                </div>
                            </div> -->
                           <!--  // user_id firstname   mobile  email   password    user_role   picture district    block   village school_type school_level    school_name sex age class   school_status   father_name father_occup    mother_name mother_occup    socail_status   center_id Descending 1  remarks created_by  create_date update_date status
                             

                            <div class="form-group row">
                                <label for="center_id" class="col-xs-3 col-form-label"><?php echo display('center_name') ?></label>
                                <div class="col-xs-9"> 
                                    <?php echo form_dropdown('center_id', $center_list, $student->center_id, 'class="form-control" id="center_id" '); 
                                    ?>
                                </div>
                            </div>
                           -->
                            <!--<div class="form-group row">
                                <label for="report_status" class="col-xs-3 col-form-label"><?php echo display('report_status') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="report_status" class="form-control" type="text" placeholder="<?php echo display('report_status') ?>" id="report_status"  value="<?php echo $student->report_status ?>">
                                </div>
                            </div>-->
                            <?php /* <div class="form-group row">
                                <label for="blood_group" class="col-xs-3 col-form-label"><?php echo display('blood_group') ?></label>
                                <div class="col-xs-9"> 
                                    <?php
                                        $bloodList = array(
                                            ''   => display('select_option'),
                                            'A+' => 'A+',
                                            'A-' => 'A-',
                                            'B+' => 'B+',
                                            'B-' => 'B-',
                                            'O+' => 'O+',
                                            'O-' => 'O-',
                                            'AB+' => 'AB+',
                                            'AB-' => 'AB-'
                                        );
                                        echo form_dropdown('blood_group', $bloodList, $student->blood_group, 'class="form-control" id="blood_group" '); 
                                    ?>
                                </div>
                            </div> 

                            
                            
                            <div class="form-group row">
                                <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="address" class="form-control"  placeholder="<?php echo display('address') ?>" maxlength="140" rows="2"><?php echo $student->address ?></textarea>
                                </div>
                            </div>
							
							
                            <!--<div class="form-group row">
                                <label for="report" class="col-xs-3 col-form-label"><?php echo display('travel') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="travel" class="form-control"  placeholder="<?php echo display('travel') ?>" maxlength="140" rows="2"><?php echo $student->travel ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="center" class="col-xs-3 col-form-label"><?php echo display('center') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('center',$center_list, $student->center, 'class="form-control" id="center" '); ?>
                                    <!--<select  class="form-control"  name="center" id="center" placeholder="Quarantine">                               
                                    <option value="">Centre Name</option>
                                </select>-->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('sample_collected') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="sample_collected" value="1" <?php echo  set_radio('sample_collected', '1'); ?> ><?php echo display('yes') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="sample_collected" value="0" <?php echo  set_radio('sample_collected', '0', true); ?> ><?php echo display('no') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('sample_result') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="sample_result" value="-1" <?php echo  set_radio('sample_result', '-1'); ?> ><?php echo display('positive') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="sample_result" value="1" <?php echo  set_radio('sample_result', '1'); ?> ><?php echo display('negative') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="sample_result" value="0" <?php echo  set_radio('sample_result', '0', true); ?> ><?php echo display('res_awaited') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('recovered') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="recovered" value="1" <?php echo  set_radio('recovered', '1'); ?> ><?php echo display('yes') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="recovered" value="0" <?php echo  set_radio('recovered', '0',TRUE); ?> ><?php echo display('no') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('deceased') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="deceased" value="1" <?php echo  set_radio('deceased', '1'); ?> ><?php echo display('yes') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="deceased" value="0" <?php echo  set_radio('deceased', '0',TRUE); ?> ><?php echo display('no') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>*/ ?>

                            
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="1" <?php echo  set_radio('status', '1', TRUE); ?> ><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="0" <?php echo  set_radio('status', '0'); ?> ><?php echo display('inactive') ?>
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