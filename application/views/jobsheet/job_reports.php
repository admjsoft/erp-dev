<style>
.job_sheet_details {
    text-decoration: underline !important;
}
</style>
<article class="content-body">
    <div class="row">
        <div class="col-12">
            <?php if(isset($_SESSION['status'])){
 echo '<div id="notify" class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- <h5 class="card-title">Employee Details</h5> -->
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="employee">Employee</label>
                        <select class="form-control" id="task_employee">
                            <option value="">Select Employee</option>
                            <?php if(!empty($employee)){ foreach ($employee as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } } ?>


                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="task_status">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Work In Progress">Work In Progress</option>
                            <option value="Completed">Completed</option>
                            <option value="unassigned">UnAssigned</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="start_date">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="end_date">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="submit">&nbsp;</label>
                        <button class="btn btn-primary form-control" id="search">Search</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card-body">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('View Report') ?>
            </div>
            <div class="row ">

                <div class="col-12 text-right ">
                    <!-- Small Button -->
                    <a href="<?php echo base_url('export/export_job_sheet_list'); ?>"> <button type="button"
                            class="btn btn-sm btn-primary"><?php echo $this->lang->line('Download'); ?> </button></a>
                </div>
            </div>

            <table id="doctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Subject') ?></th>                        
                        <th><?php echo $this->lang->line('Created At') ?></th>
                        <th><?php echo $this->lang->line('Priority') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
    <input type="hidden" id="dashurl" value="tickets/ticket_stats">
</article>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this job') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="jobsheets/delete_ticket">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                    id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<?php echo form_open('jobsheets/assign');
 ?>
<div id="assign_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Assign') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('Employee') ?></p>
                <select name="employee" class="form-control employee emp-list">
                    <option>-- <?php echo $this->lang->line('Select Employee') ?> --</option>
                </select>
                <br />
                <p>Job type</p>
                <input type="text" class="form-control" name="jobtype" value=""
                    placeholder="Like:Task, Urgent, Imidate or etc." />
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" class="jobid" name="jobid" value="">
                <input type="submit" class="btn btn-primary" value="<?php  echo $this->lang->line('Assign') ?>" />
                <button type="button" data-dismiss="modal"
                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
</form>

<div class="modal fade" id="job_dheet_details_modal">
    <div class="modal-dialog modal-xl">
        <!-- Add the modal-xl class -->
        <div class="modal-content" id="job_dheet_details_modal_body">
            <!-- Modal Header -->

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    draw_data();

    function draw_data(status = '', employee = '', start_date = '', end_date = '') {

        // alert(status);
        // alert(employee);
        // alert(start_date);
        // alert(end_date);

        $('#doctable').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: true,
            <?php datatable_lang();?> "ajax": {
                "url": "<?php if (isset($_GET['filter'])) {
                    $filter = $_GET['filter'];
                } else {
                    $filter = '';
                }    
                echo site_url('jobsheets/tasks_load_list_report?stat=' . $filter)?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                    status: status,
                    employee: employee,
                    start_date: start_date,
                    end_date: end_date
                }
            },
            // "columnDefs": [{
            //     "targets": [0],
            //     "orderable": false,
            // }, ],

            // dom: 'Blfrtip',
            // buttons: [{
            //     extend: 'excelHtml5',
            //     footer: true,
            //     exportOptions: {
            //         columns: [1, 2, 3, 4]
            //     }
            // }],
            // "order": [
            //     [2, "desc"]
            // ],
            "rowCallback": function(row, data) {

                var status = data[4];
                //console.log(status);

                // Add background color based on status
                switch (status) {
                    case 'Completed':
                        $(row).css('background-color', '#9dff9d'); // Light Green for Completed
                        break;
                    case 'Pending':
                        $(row).css('background-color', '#fdeca3'); // Light Yellow for Pending
                        break;
                    case 'Unassigned':
                        $(row).css('background-color', '#f3a4a4'); // Light Red for Unassigned
                        break;
                    case 'Work In Progress':
                        $(row).css('background-color',
                            '#aad9f1'); // Light Blue for Work In Progress
                        break;
                    case 'Closed':
                        $(row).css('background-color', '#a4f1a4'); // Light Green for Close
                        break;
                    case 'Re-Open':
                        $(row).css('background-color', '#f1d19f'); // Light Orange for ReOpen
                        break;
                    case 'Re-Assign':
                        $(row).css('background-color', '#e5d1e5'); // Light Purple for ReAssign
                        break;
                    default:
                        $(row).css('background-color',
                            '#dcdcdc'); // Default color for unknown status
                        break;
                        // Add more cases for other status values
                }

                // if (data[5] == '1') { // Assuming status value is at index 3
                //     //alert(data[6]);
                //     $(row).css('background-color',
                //     '#f7483b'); // Add CSS class to display row in red
                // }

                // if (data[7]) { // Assuming status value is at index 3
                //     //alert(data[6]);
                //     $(row).css('white-space', 'nowrap'); // Add CSS class to display row in red
                // }
            }

        });
    };

    // $('#task_status').click(function () {
    //     var status = $('#task_status').val();

    //     if (status != '') {
    //         $('#doctable').DataTable().destroy();
    //     // alert(status);
    //         draw_data(status);
    //     } else {
    //         //alert("Date range is Required");
    //     }
    // });

    // $('#task_employee').change(function () {
    //     var employee = $('#task_employee').val();

    //     if (employee != '') {
    //         $('#doctable').DataTable().destroy();
    //     // alert(status);
    //         draw_data(status,employee);
    //     } else {
    //         //alert("Date range is Required");
    //     }
    // });

    $('#search').click(function() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var employee = $('#task_employee').val();
        var status = $('#task_status').val();

        //if (start_date != '' && end_date != '') {
        $('#doctable').DataTable().destroy();
        draw_data(status, employee, start_date, end_date);
        // } else {
        //     alert("Date range is Required");
        // }
    });

    miniDash();


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

$(document).on('click', ".assign-object", function(e) {
    e.preventDefault();
    $('.jobid').val($(this).attr('data-object-id'));
    $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
    $('#assign_model').modal({
        backdrop: 'static',
        keyboard: false
    });
});


$(document).on('click', '.job_sheet_details', function() {

    var job_id = $(this).attr('job_id');

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo base_url('jobsheets/get_job_sheet_details') ?>',
        data: {
            job_id: job_id
        },
        success: function(response) {

            if (response.status == '200') {

                $('#job_dheet_details_modal_body').html('');
                $('#job_dheet_details_modal_body').html(response.html);
                $('#job_dheet_details_modal').modal('show');
            } else {
                //alert(response.message);
            }
            // Handle the response from the controller
            // console.log(response);
        },
        error: function(error) {
            // console.error(error);
        }
    });
});
</script>