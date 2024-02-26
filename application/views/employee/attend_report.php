<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Attendance Report') ?></h5>
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
                <form action="<?php echo base_url('employee/attendreport'); ?>" method="get">
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
                                <input type="text" class="form-control" name="cst" id="employee-box-kpi"
                                        placeholder="Enter Employee Name"
                                        autocomplete="off" value="<?php if(!empty($employee_name)){ echo $employee_name; } ?>"/>

                                <div id="employee-box-kpi-result"></div>
                                <?php /* ?>
                                <input type="text" name="employee_list" id="employee_list"
                                    class="form-control employee emp-list"
                                    placeholder="<?php echo $this->lang->line('Enter Employee Name') ?>"
                                    list="datalistOptions" />
                                <datalist id="datalistOptions">
                                    <!-- Replace these options with your actual autocomplete options -->
                                    <?php if(!empty($emp_list)) { foreach( $emp_list as $e_list){ ?>
                                    <option emp_id="<?php echo $e_list['id']; ?>"
                                        value="<?php echo $e_list['name']; ?>">
                                        <?php }} ?>
                                        <!-- Add more options as needed -->
                                </datalist>
                                <?php */ ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?php /* ?>
                            <?php date('Y'); ?>
                            <select name="year" class="form-control">
                                <option value="0"> -- <?php echo $this->lang->line('Year') ?> -- </option>
                                <?php for($i=0;$i<=5;$i++){

                                    $year=date('Y')-$i;
                                    ?>
                                <option value="<?php echo $year; ?>"><?= $year; ?></option>
                                <?php } ?>
                            </select>
                            <?php */ ?>
                            <label for="employee"><?php echo $this->lang->line('Date From') ?></label>
                            <input type="date" name="from_date" id="from_date" class="form-control"
                                placeholder="Date From" />

                        </div>
                        <div class="col-md-3">
                            <?php /* ?>
                            <select name="month" class="form-control">
                                <option value="0"> -- <?php echo $this->lang->line('Month') ?> -- </option>
                                <?php  for($i=12;$i>0;$i--){
                              $name =  date("F", strtotime(date('Y-m-d')." -".$i." months"));
                              $month =  date("m", strtotime(date('Y-m-d')." -".$i." months"));
                                    ?>
                                <option value="<?php echo $month; ?>"><?= $name; ?></option>
                                <?php  } ?>
                            </select>
                            <?php */ ?>
                            <label for="employee"><?php echo $this->lang->line('Date To') ?></label>
                            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="Date To" />
                        </div>
                        <input type="hidden" id="employee_selected_id" name="employee" value="" />
                        <div class="col-md-3 ">
                            <label for="submit">&nbsp;</label>
                            <button class="btn btn-success col-12"
                                type="post"><?php echo $this->lang->line('Search') ?></button>
                        </div>

                    </div>
                </form>
                <?php if(!empty($emp_details) || !empty($from_date) || !empty($from_date)) { ?>
                <div class="container mb-3">
                    <div class="row mb-2">
                        <?php if(!empty($from_date)) { ?>
                        <div class="col-md-4">
                            <h3>From : <?php  echo date('d-m-Y',strtotime($from_date)); ?></h3>
                        </div>
                        <?php } ?>
                        <?php if(!empty($to_date)) { ?>
                        <div class="col-md-4">
                            <h3>To : <?php echo date('d-m-Y',strtotime($to_date)); ?></h3>
                        </div>
                        <?php } ?>
                    </div>
                    <?php if(!empty($emp_details)) { ?>
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Employee ID : <?php echo $emp_details['id']; ?></h3>
                        </div>
                        <div class="col-md-4">
                            <h3>Employee Name : <?php echo $emp_details['username']; ?></h3>
                        </div>
                        <div class="col-md-4">
                            <h3>Position : <?php echo $emp_details['department_name']; ?></h3>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <table id="htable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Employee Name') ?></th>
                            <th><?php echo $this->lang->line('Date') ?></th>
                            <th><?php echo $this->lang->line('ClockIn') ?></th>
                            <th><?php echo $this->lang->line('Clock In photo') ?></th>
                            <th><?php echo $this->lang->line('Clock In Location') ?></th>
                            <th><?php echo $this->lang->line('ClockOut') ?></th>
                            <th><?php echo $this->lang->line('Clock Out photo') ?></th>
                            <th><?php echo $this->lang->line('Clock Out Location') ?></th>
                            <th><?php echo $this->lang->line('Total Hours') ?></th>
                            <th><?php echo $this->lang->line('OT') ?></th>
                            <th><?php echo $this->lang->line('Allowance') ?></th>
                            <th><?php echo $this->lang->line('Action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $report ?>
                    </tbody>

                    <tfoot>
                        <?php /* ?>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Employee') ?></th>
                            <th><?php echo $this->lang->line('Date') ?></th>
                            <th>Activity</th>
                            <th><?php echo "Start Time"; //$this->lang->line('ClockIn') ?></th>
                            <th><?php echo  "End Time" //$this->lang->line('ClockOut') ?></th>
                            <th>Duration</th>
                        </tr>
                        <?php */ ?>
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
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5,6, 7, 8, 9, 10, 11, 12]
                    }
                },
                {
                    extend: 'print',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5,6, 7, 8, 9, 10, 11, 12]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    footer: true,
                    customize: function (doc) {
                        doc.defaultStyle.orientation = 'landscape'; // Set the orientation to landscape
                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                    }
                },
            ],
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
                // Get the emp_id attribute value
                var empId = selectedOption.getAttribute('emp_id');
                $('#employee_selected_id').val(empId);
                // Display emp_id using alert
                //alert('Selected Employee ID: ' + empId);

            }
        });
    });
    </script>