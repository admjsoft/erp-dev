<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Daily Attendance List') ?>
            </h5>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">



                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <h2>Attendance Timings</h2>
                        <p>Clock In Time : <?php echo date('h:i A',strtotime($attendance_settings['clock_in_time'])); ?>
                        </p>
                        <p>Clock Out Time :
                            <?php echo date('h:i A',strtotime($attendance_settings['clock_out_time'])); ?></p>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <label for="employee"><?php echo $this->lang->line('Select Date') ?></label>
                            <input type="date" name="attendance_date" id="attendance_date" class="form-control"
                                placeholder="attendance date" value="<?php echo date('Y-m-d'); ?>" />

                        </div>
                    </div>
                </div>

                <div class=" text-right ">
                    <form id="download_form" action="#" method="post">
                        <a href="#" id="pdf_download_link" class="btn btn-sm btn-primary"><?php echo $this->lang->line('Pdf Download'); ?></a>
                        <a href="#" id="excel_download_link" class="btn btn-sm btn-primary"><?php echo $this->lang->line('Excel Download'); ?></a>
                        <input type="hidden" id="att_date" name="att_date" value="">
                    </form>



                </div>
                <h2>Today Attendance</h2>
                <table id="htable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Employee') ?></th>
                            <th><?php echo $this->lang->line('Date & ClockIn') ?></th>
                            <th><?php echo $this->lang->line('Early / Late In Minutes') ?></th>
                            <th><?php echo $this->lang->line('Date & ClockOut') ?></th>
                            <th><?php echo $this->lang->line('Early / Late In Minutes') ?></th>
                            <th><?php echo $this->lang->line('Auto LoggedOut') ?></th>
                        </tr>
                    </thead>
                    <tbody id="htable_body">
                        <?php if(!empty($attendance_list)){ $a=1; foreach($attendance_list as $attendance){ ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo $attendance['name']; ?></td>
                            <td><?php echo $attendance['lowest_clock_in_time']; ?></td>
                            <td><?php echo $attendance['clockin_difference']; ?></td>
                            <td><?php echo $attendance['highest_clock_out_time']; ?></td>
                            <td><?php echo $attendance['clockout_difference']; ?></td>
                            <td><?php echo $attendance['auto_logout']; ?></td>
                            <!-- <td></td>
                        <td></td> -->
                        </tr>
                        <?php $a++; } }?>
                    </tbody>

                </table>


                <div class="row">
                    <div class="col">
                        <h2>Absent Employee's List</h2>
                        <?php if (!empty($absent_emp_names)) : ?>
                        <table id="abs_table" class="table table-striped table-bordered zero-configuration"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody id="abs_table_body">
                                <?php foreach ($absent_emp_names as $index => $absent_emp_name) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $absent_emp_name['name']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else : ?>
                        <p>No absent employees</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#htable').DataTable({
            responsive: true
        });

        $('#abs_table').DataTable({
            responsive: true
        });
    });
    </script>
    <script>
    $('#attendance_date').on('change', function() {
            
            var att_date = $('#attendance_date').val();
            $('#att_date').val(att_date);

            $.ajax({
                "url": "<?php echo site_url('employee/ajax_daily_attendances') ?>",
                "type": "POST",
                "dataType": 'json',
                'data': {
                    'att_date': att_date
                },
                success: function(result) {
                    if (result.status) {

                        var table = $('#htable').DataTable();
                        if ($.fn.DataTable.isDataTable('#htable')) {
                            // DataTable is already initialized, so destroy it first
                            table.destroy();
                        }
                        var table = $('#abs_table').DataTable();
                        if ($.fn.DataTable.isDataTable('#abs_table')) {
                            // DataTable is already initialized, so destroy it first
                            table.destroy();
                        }
                        $("#htable_body").html('');
                        $("#htable_body").append(result.html);

                        $("#abs_table_body").html('');
                        $("#abs_table_body").append(result.ab_html);

                        
                        $('#htable').DataTable({
                            responsive: true
                        });

                        $('#abs_table').DataTable({
                            responsive: true
                        });

                    }
                }
            });
        });
    </script>
        <script>
    // Function to set the form action based on the clicked hyperlink
    function setFormAction(action) {
        document.getElementById('download_form').action = action;
        document.getElementById('download_form').submit();
    }

    // Add click event listeners to the hyperlinks
    document.getElementById('pdf_download_link').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        // var fromDate = document.getElementById('from_date').value;
        // var toDate = document.getElementById('to_date').value;
        setFormAction('<?php echo base_url('employee/export_daily_attendance_report'); ?>');
    });

    document.getElementById('excel_download_link').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        // var fromDate = document.getElementById('from_date').value;
        // var toDate = document.getElementById('to_date').value;
        setFormAction('<?php echo base_url('export/export_daily_attendance_list'); ?>');
    });
</script>