<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
									<?php echo $PageTitle; ?>
                </h3>
                <div class="card-tools">
                    <a class="btn btn-primary"
                       href="<?php echo base_url("animator/cstakeholder/processStakeholderForm") ?>">
                        <i class="fa fa-plus"></i> <?php echo display('add_stakeholder') ?>
                    </a>

                </div>
            </div>
            <div class="card-body">
                <table class="stakeholder_datatable table table-bordered table-striped table-hovers">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo display('stakeholder_type') ?></th>
                        <th><?php echo display('first_name') ?></th>
                        <th><?php echo display('village') ?></th>
                        <th><?php echo display('age') ?></th>
                        <th><?php echo display('sex') ?></th>
                        <th><?php echo display('district') ?></th>
                        <th><?php echo display('social_parity') ?></th>
                        <th><?php echo display('father_name') ?></th>
                        <th><?php echo display('class') ?></th>
                        <th><?php echo display('date_of_joining') ?></th>
                        <th><?php echo display('group_name') ?></th>
                        <th><?php echo display('designation') ?></th>
                        <th><?php echo display('action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- User data rows will be dynamically generated here -->
                    <?php if (!empty($stakeholders)) { ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($stakeholders as $stakeholder) { ?>
                            <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $stakeholder->stakeholder_name; ?></td>
                                <td><?php echo $stakeholder->firstname; ?></td>
                                <td><?php echo $stakeholder->village ?></td>
                                <td><?php echo $stakeholder->age; ?></td>
                                <td><?php echo !empty($stakeholder->sex) ? $stakeholder->sex : '-'; ?></td>
                                <td><?php echo !empty($stakeholder->district) ? $stakeholder->district : '-'; ?></td>
                                <td><?php echo !empty($stakeholder->social_status) ? $stakeholder->social_status : '-'; ?></td>
                                <td><?php echo !empty($stakeholder->father_name) ? $stakeholder->father_name : '-'; ?></td>
                                <td><?php echo !empty($stakeholder->class) ? $stakeholder->class : '-'; ?></td>
                                <td><?php echo !empty($stakeholder->date_of_joining) ? $stakeholder->date_of_joining : '-'; ?></td>
                                <td><?php echo !empty($stakeholder->group_name) ? $stakeholder->group_name : '-'; ?></td>
                                <td><?php echo !empty($stakeholder->designation) ? $stakeholder->designation : '-'; ?></td>
                                <td class="center">
                                    <a href="<?php echo base_url("animator/cstakeholder/edit/$stakeholder->user_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo base_url("animator/cstakeholder/delete/$stakeholder->user_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php $sl++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery library -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.stakeholder_datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>tp",
            buttons: [{
                extend: 'copy',
                title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
                className: 'btn-sm',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                },
            },
                {
                    extend: 'csv',
                    title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
                    className: 'btn-sm',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile',
                    className: 'btn-sm',
                    title: 'exportTitle'
                },
                {
                    extend: 'pdfHtml5',
                    title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
                    className: 'btn-sm',
                    pageSize: 'A4',
                    orientation: 'portrait', // Set the PDF orientation to landscape
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    customize: function (doc) {
                        // Adjust font size
                        doc.defaultStyle.fontSize = 10;

                        // Use autoTable to adjust column widths
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        // Align header and body rows to center
                        doc.content[1].table.body.forEach(function (row) {
                            row.forEach(function (cell) {
                                cell.alignment = 'left';
                            });
                        });
                    }
                },
                {
                    extend: "print",
                    title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
                    className: 'btn-sm',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: "colvis",
                    className: 'btn-sm',
                }
            ]
        }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');

    });
</script>
