<style>
    /* Adjust the width as needed */
    .actions-column {
        width: 83px; /* Set the desired width here */
    }
    #userTable tbody tr {
        cursor: pointer;
    }

</style>
<!--Filter-->
<div class="row d-none">
  <div class="col-sm-12">
    <form role="form" action="<?php echo site_url('animator/cstudent/index') ?>" method="post" class="">
      <div class="card card-outline card-primary">
        <div class="card-header with-border">
          <h3 class="card-title"><i class="fa fa-search"></i> <?php echo display('select_criteria'); ?></h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label><?php echo display('cluster'); ?></label> <small class="req"> * </small>
								<?php echo form_dropdown('cluster_id',  $cluster_list, $cluster_id, 'class="form-control" id="cluster_id" disabled'); ?>
                <span class="text-danger"><?php echo form_error('cluster_id'); ?></span>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label><?php echo display('center'); ?></label> <small class="req"> *</small>
								<?php echo form_dropdown('center_id', $center_list, $center_id, 'class="form-control" id="center_id" '); ?>
                <span class="text-danger"><?php echo form_error('center_id'); ?></span>
              </div>
            </div>

          </div>
        </div>
        <div class="card-footer d-none">
          <button type="submit" name="search" value="search_filter" class="btn btn-primary  float-right "><i class="fa fa-search"></i> <?php echo display('search'); ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--Table-->
<div class="row">
  <div class="col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
      <div class="card-header p-0 border-bottom-0">
        <!-- Create tabs for different student statuses -->
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-for-all-students-tab" data-toggle="pill" href="#custom-tabs-for-all-students" role="tab" aria-controls="custom-tabs-for-all-students" aria-selected="true">All Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-for-not-submitted-tab" data-toggle="pill" href="#custom-tabs-for-not-submitted" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Not Submitted</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-for-pending-tab" data-toggle="pill" href="#custom-tabs-for-pending" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Pending Approval</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-for-approved-tab" data-toggle="pill" href="#custom-tabs-for-approved" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Completed/Approved</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
          <div class="tab-pane fade active show" id="custom-tabs-for-all-students" role="tabpanel" aria-labelledby="custom-tabs-for-all-students-tab">
            <!-- Display all students here -->
            <table id="userTable" class="datatable_server table table-bordered table-striped table-hovers">
              <thead>
              <tr>
                <th><?php echo display('picture') ?></th>
                <th><?php echo display('first_name') ?></th>
                <th><?php echo display('mobile') ?></th>
                <th><?php echo display('email') ?></th>
                <th><?php echo display('district') ?></th>
                <th><?php echo display('sex') ?></th>
                <th><?php echo display('age') ?></th>
                <th><?php echo display('organisation_name') ?></th>
                <th><?php echo display('cluster_name') ?></th>
                <th><?php echo display('center_name') ?></th>
                <th><?php echo display('status') ?></th>
                <th><?php echo display('action') ?></th>
              </tr>
              </thead>
              <tbody>
              <!-- User data rows will be dynamically generated here -->
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="custom-tabs-for-not-submitted" role="tabpanel" aria-labelledby="custom-tabs-for-not-submitted-tab">
            <!-- Display not submitted students here -->
	          <?php if (valArr($not_submitted_students)):?>
		          <?php foreach ($not_submitted_students as $student): ?>
                <!-- Display student details -->
		          <?php endforeach; ?>
	          <?php endif; ?>
          </div>
          <div class="tab-pane fade" id="custom-tabs-for-pending" role="tabpanel" aria-labelledby="custom-tabs-for-pending-tab">
            <!-- Display pending students here -->
	          <?php if (valArr($pending_students)):?>
		          <?php foreach ($pending_students as $student): ?>
                <!-- Display student details -->
		          <?php endforeach; ?>
	          <?php endif; ?>
          </div>
          <div class="tab-pane fade" id="custom-tabs-for-approved" role="tabpanel" aria-labelledby="custom-tabs-for-approved-tab">
            <!-- Display approved students here -->
	          <?php if (valArr($approved_students)):?>
		          <?php foreach ($approved_students as $student): ?>
                <!-- Display student details -->
		          <?php endforeach; ?>
	          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="base_url" value="<?php echo base_url("/") ?>">
<input type="hidden" id="pdf_name" value="<?php echo $pdfFileName ?? 'Example File' ?>">
<!-- Include jQuery library -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url('assets/js/animator/studentSessionListingNew.js'); ?>"></script>
