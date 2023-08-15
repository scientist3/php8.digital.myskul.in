<div class="row">
  <div class="col-md-3">
    <a href="<?php echo base_url("organisation/message/sent") ?>" class="btn btn-primary btn-block mb-3"><?php echo display('back_to_sent') ?></a>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Folders</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item ">
            <a href="<?php echo base_url("organisation/message/index") ?>" class="nav-link <?php echo $inbox_option ?? null; ?>">
              <i class="fas fa-inbox"></i> Inbox
              <span class="badge bg-primary float-right"><?php //echo count($messages);?></span>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url("organisation/message/sent") ?>" class="nav-link <?php echo $sent_option ?? null; ?>">
              <i class="far fa-envelope"></i> Sent
            </a>
          </li>

        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card d-none">
      <div class="card-header">
        <h3 class="card-title">Labels</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle text-danger"></i>
              Important
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle text-warning"></i> Promotions
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle text-primary"></i>
              Social
            </a>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Read Mail</h3>

        <div class="card-tools">
          <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
          <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="mailbox-read-info">
          <h5><?php echo $message->subject ?></h5>
          <h6>To: <?php echo $message->receiver_name ?>
            <span class="mailbox-read-time float-right"><?php echo date('d M. Y h:i A', strtotime($message->datetime)) ?></span></h6>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center d-none">
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
              <i class="far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
              <i class="fas fa-reply"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
              <i class="fas fa-share"></i>
            </button>
          </div>
          <!-- /.btn-group -->
          <button type="button" class="btn btn-default btn-sm" title="Print">
            <i class="fas fa-print"></i>
          </button>
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
					<?php echo $message->message ?>
        </div>
        <!-- /.mailbox-read-message -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer bg-white d-none">
        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
					<?php if (!empty($message->picture)) { ?>
            <li>
              <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

              <div class="mailbox-attachment-info">
                <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                <span class="mailbox-attachment-size clearfix mt-1">
                            <span>1,245 KB</span>
                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                          </span>
              </div>
            </li>
					<?php } else { ?>
            <li>
              <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
              <div class="mailbox-attachment-info">
                <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> No attachment found</a>
                <span class="mailbox-attachment-size clearfix mt-1 d-none">
                <span>1,245 KB</span>
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                </span>
              </div>
            </li>
					<?php } ?>
          <li>
            <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
              <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
            </div>
          </li>
          <li>
            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
              <span class="mailbox-attachment-size clearfix mt-1">
                          <span>2.67 MB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
            </div>
          </li>
          <li>
            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>
              <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1.9 MB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
            </div>
          </li>
        </ul>
      </div>
      <!-- /.card-footer -->
      <div class="card-footer">
        <div class="float-right">
          <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
          <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
        </div>
        <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
        <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>