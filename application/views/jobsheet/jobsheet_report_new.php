<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><Strong><?php echo $this->lang->line('JobSheet KPI Report') ?></Strong></h5>
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

                <form action="<?php echo base_url('jobsheets/jobsheet_report_new'); ?>" method="post">
                    <div class="row mb-2">
                        <?php /* ?>
                        <div class="col-md-3">
                            <select name="employee" class="form-control employee emp-list">
                                <option value="0">-- <?php echo $this->lang->line('Select Employee ID') ?> --</option>
                            </select>
                        </div>
                        <?php */ ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="employee"><?php echo $this->lang->line('Select Employee') ?></label>
                                <input type="text" name="employee_list" id="employee_list"
                                    class="form-control employee emp-list"
                                    placeholder="<?php echo $this->lang->line('Enter Employee Name') ?>"
                                    list="datalistOptions" />
                                <datalist id="datalistOptions">
                                    <!-- <option emp_id="" value="All Employees"> -->
                                    <!-- Replace these options with your actual autocomplete options -->
                                    <?php if(!empty($emp_list)) { foreach( $emp_list as $e_list){ ?>
                                    <option emp_id="<?php echo $e_list['id']; ?>"
                                        value="<?php echo $e_list['name']; ?>">
                                        <?php }} ?>
                                        <!-- Add more options as needed -->
                                </datalist>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="employee"><?php echo $this->lang->line('Select Job Id') ?></label>
                                <input type="text" name="job_list" id="job_list" class="form-control employee emp-list"
                                    placeholder="<?php echo $this->lang->line('Enter Job Id') ?>"
                                    list="datalistOptions1" />
                                <datalist id="datalistOptions1">
                                    <!-- <option emp_id="" value="All Employees"> -->
                                    <!-- Replace these options with your actual autocomplete options -->
                                    <?php if(!empty($emp_list)) { foreach( $emp_list as $e_list){ ?>
                                    <option job_id="<?php echo $e_list['id']; ?>"
                                        value="<?php echo $e_list['name']; ?>">
                                        <?php }} ?>
                                        <!-- Add more options as needed -->
                                </datalist>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee"><?php echo $this->lang->line('Select Date Range') ?></label>

                                <div id="reportrange" class="form-control"
                                    style="background: #fff; cursor: pointer; padding: 10px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="employee_selected_id" name="employee" value="" />
                        <input type="hidden" id="job_selected_id" name="employee" value="" />
                        <input type="hidden" id="from_date" name="from_date"
                            value="<?php if(!empty($from_date)){ echo $from_date; } ?>">
                        <input type="hidden" id="to_date" name="to_date"
                            value="<?php if(!empty($to_date)){ echo $to_date; } ?>">

                        <div class="col-md-2 ">
                            <label for="submit">&nbsp;</label>
                            <button class="btn btn-success col-12"
                                type="post"><?php echo $this->lang->line('Search') ?></button>
                        </div>

                    </div>
                </form>

                <div class=" text-right ">
                    <!-- Small Button -->
                    <form action="<?php echo base_url('export/export_jobsheet_report'); ?>" method="post">
                        <input type="hidden" id="download_employee_selected_id" name="employee" value="" />
                        <input type="hidden" id="download_from_date" name="from_date"
                            value="<?php if(!empty($from_date)){ echo $from_date; } ?>">
                        <input type="hidden" id="download_to_date" name="to_date"
                            value="<?php if(!empty($to_date)){ echo $to_date; } ?>">
                        <input type="hidden" id="download_job_id" name="job_id" value="">

                        <button type="submit"
                            class="btn btn-sm btn-primary"><?php echo $this->lang->line('Download'); ?>
                        </button></a>
                    </form>
                </div>
                
                <table id="htable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Staff Id') ?></th>
                            <th><?php echo $this->lang->line('Staff Name') ?></th>
                            <th><?php echo $this->lang->line('Created Date & Time') ?></th>
                            <th><?php echo $this->lang->line('Completion Date & Time') ?></th>
                            <th><?php echo $this->lang->line('Status') ?></th>
                            <th><?php echo $this->lang->line('Assigned Hours') ?></th>
                            <th><?php echo $this->lang->line('Client Name') ?></th>
                            <th><?php echo $this->lang->line('Duration') ?></th>
                            <th><?php echo $this->lang->line('Final Remarks') ?></th>
                            <th><?php echo $this->lang->line('Total Assigned Tasks') ?></th>
                            <th><?php echo $this->lang->line('Total Pending Tasks') ?></th>
                            <th><?php echo $this->lang->line('Total Completed Tasks') ?></th>
                            <th><?php echo $this->lang->line('Total Work In Progress & Others') ?></th>
                            <th><?php echo $this->lang->line('Total Work Hours') ?></th>
                            <th><?php echo $this->lang->line('KPI Indication') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php if(!empty($jobsheet_report)){ $jr = 1; foreach($jobsheet_report as $job_data) { ?>
                                <tr>
                                    <td># <?php echo $jr; ?></td>
                                    <td><?php echo $job_data['cid']; ?></td>
                                    <td><?php echo $job_data['assigned_employee_name']; ?></td>
                                    <td><?php echo $job_data['created_date_time']; ?></td>
                                    <td><?php echo $job_data['estimated_completed_date']; ?></td>
                                    <td><?php echo $job_data['status']; ?></td>
                                    <td><?php echo $job_data['assigned_hours']; ?></td>
                                    <td><?php echo $job_data['client_name']; ?></td>
                                    <td><?php echo $job_data['duration']; ?></td>
                                    <td><?php echo $job_data['remarks']; ?></td>
                                    <td><?php echo $job_data['total_assigned_tasks']; ?></td>
                                    <td><?php echo $job_data['total_completed_tasks']; ?></td>
                                    <td><?php echo $job_data['total_pending_tasks']; ?></td>
                                    <td><?php echo $job_data['total_work_in_progress_and_reopen']; ?></td>
                                    <td><?php echo $job_data['total_working_duration']; ?></td>
                                    <td><?php echo $job_data['kpi_indication']; ?></td>

                                </tr>
                            <?php $jr++; }} ?>
                    </tbody>

                    <tfoot>
                       
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#htable').DataTable({
            'responsive': true,
            <?php datatable_lang();?> 'order': [],
            'columnDefs': [{
                'targets': [0],
                'orderable': false,
            }, ],


        });
        $.ajax({

            url: "<?php echo site_url('employee/employee_list') ?>",
            type: 'POST',
            success: function(data) {
                $('.emp-list').append(data);
            },
            error: function(data) {
                //console.log(data);
                console.log("Error not get emp list")
            }

        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var employeeInput = document.querySelector('#employee_list');

        // Add an event listener for input change
        employeeInput.addEventListener('input', function() {
            // Retrieve the selected option
            var selectedOption = document.querySelector('#datalistOptions option[value="' +
                employeeInput.value + '"]');

            // Check if an option is selected
            if (selectedOption) {
                // alert(selectedOption);
                // Get the emp_id attribute value
                var empId = selectedOption.getAttribute('emp_id');
                $('#employee_selected_id').val(empId);
                $('#download_employee_selected_id').val(empId);
                // Display emp_id using alert
                //alert('Selected Employee ID: ' + empId);

            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var jobInput = document.querySelector('#job_list');

        // Add an event listener for input change
        jobInput.addEventListener('input', function() {
            // Retrieve the selected option
            var selectedOption1 = document.querySelector('#datalistOptions1 option[value="' +
                jobInput.value + '"]');

            // Check if an option is selected
            if (selectedOption1) {
                // alert(selectedOption);
                // Get the emp_id attribute value
                var jobId = selectedOption1.getAttribute('job_id');
                $('#download_job_id').val(jobId);
                $('#job_selected_id').val(jobId);
                // Display emp_id using alert
                //alert('Selected Employee ID: ' + empId);

            }
        });
    });
    </script>
    <script type="text/javascript">
    $(function() {

        var fromDateValue = $('#from_date').val();
        var toDateValue = $('#to_date').val();

        var start = moment();
        var end = moment();

        // Check if both from_date and to_date values are available
        if (fromDateValue && toDateValue) {
            start = moment(fromDateValue);
            end = moment(toDateValue);
        }

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#from_date').val(start.format('YYYY-MM-DD'));
            $('#to_date').val(end.format('YYYY-MM-DD'));
            $('#download_from_date').val(start.format('YYYY-MM-DD'));
            $('#download_to_date').val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            $('#from_date').val(picker.startDate.format('YYYY-MM-DD'));
            $('#to_date').val(picker.endDate.format('YYYY-MM-DD'));
            $('#download_from_date').val(picker.startDate.format('YYYY-MM-DD'));
            $('#download_to_date').val(picker.endDate.format('YYYY-MM-DD'));
        });

    });
    </script>