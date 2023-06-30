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
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-xs-6">
            <div class="card status_block" status="Assign">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink"><?php echo $assign ?></h3>
                                <span><?php echo $this->lang->line('Waiting') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-clock-o pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-6">
            <div class="card status_block" status="Pending">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="blue"><?php echo $pending ?></h3>
                                <span><?php echo $this->lang->line('Pending') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-refresh blue font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-6">
            <div class="card status_block" status="Completed">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="success"><?php echo $completed ?></h3>
                                <span><?php echo $this->lang->line('Completed') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-check-circle success font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-6">
            <div class="card status_block" status="All">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="cyan"><?php echo $totalt ?></h3>
                                <span><?php echo $this->lang->line('Total') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-pie-chart cyan font-large-2 float-xs-right"></i>
                            </div>
                        </div>
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
            <div class="d-flex justify-content-between align-items-start">
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>View Task</h4>
                <a id="multi_assign_button" style="display:none;" class="btn btn-danger btn-xs align-self-start" href="#" data-toggle="modal" data-target="#multiple_assign_model" >
                    <i class="fa fa-pencil-square-o"></i> Assign
                </a>
            </div>
            <h3 class="title">
                <?php //echo $this->lang->line('Support Tickets') ?>
            </h3>
        </div>


            <p>&nbsp;</p>

            <table id="doctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th><?php echo $this->lang->line('Subject') ?></th>
                    <th><?php echo $this->lang->line('Added') ?></th>
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
        <select name="employee" class="form-control employee emp-list" >
            <option>-- <?php echo $this->lang->line('Select Employee') ?> --</option>
        </select>
        <br />
        <p>Job type</p>
        <input type="text" class="form-control" name="jobtype" value="" placeholder="Like:Task, Urgent, Imidate or etc." />
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


<?php echo form_open('jobsheets/multiple_assign');
 ?>
<div id="multiple_assign_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Multiple Task <?php echo $this->lang->line('Assign') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('Employee') ?></p>
        <select name="employee" class="form-control employee emp-list" >
            <option>-- <?php echo $this->lang->line('Select Employee') ?> --</option>
        </select>
        <br />
        <p>Job type</p>
        <input type="text" class="form-control" name="jobtype" value="" placeholder="Like:Task, Urgent, Imidate or etc." />
            </div>
            <div class="modal-footer">
                <input type="hidden" id="MultipleTaskAssignIds" class="jobid" name="MultipleTaskAssignIds" value="">
                <input type="submit" class="btn btn-primary" value="<?php  echo $this->lang->line('Assign') ?>" />
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
</form>


<script type="text/javascript">
    $(document).ready(function () {
        draw_data();

        function draw_data(status = '') {

            //alert(status);
            $('#doctable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php if (isset($_GET['filter'])) {
                    $filter = $_GET['filter'];
                } else {
                    $filter = '';
                }    
                echo site_url('jobsheets/tasks_load_list?stat=' . $filter)?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                        status: status
                    }
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false,
                },
            ],
            "columns": [
                { "data": 0 }, // Assuming the first column is at index 0
                { "data": 1 },
                { "data": 2 }, // Assuming the first column is at index 0
                { "data": 3 },
                { "data": 4 },
                { "data": 5 }
                
            ],
            "order": [[2, "desc"]],
            "rowCallback": function(row, data) {
            if (data[5] == '1') { // Assuming status value is at index 3
                //alert(data[6]);
                $(row).css('background-color', '#f7483b'); // Add CSS class to display row in red
            }
            }

            });
        };

        $('.status_block').click(function () {
        var status = $(this).attr('status');

        if (status != '') {
            $('#doctable').DataTable().destroy();
           // alert(status);
            draw_data(status);
        } else {
            //alert("Date range is Required");
        }
    });

        miniDash();


        $.ajax({

        url: "<?php echo site_url('employee/employee_list') ?>",
        type: 'POST',
        success: function (data) {
            $('.emp-list').append(data);
        },
        error: function(data) {
        //console.log(data);
            console.log("Error not get emp list")
        }

        });
});

$(document).on('click', ".assign-object", function (e) {
    e.preventDefault();
    $('.jobid').val($(this).attr('data-object-id'));
    $(this).closest('tr').attr('id',$(this).attr('data-object-id'));
    $('#assign_model').modal({backdrop: 'static', keyboard: false});
});


var messaging_team_ids = new Array();

$("body").on("change", "input[type=checkbox][name=messaging_team_id_selection]", function() {
    event.preventDefault();

    var fetchId = $(this).attr("fetchId");

    if (!messaging_team_ids.includes(fetchId)) {
        messaging_team_ids.push(fetchId);
        
    } else {
        var index = messaging_team_ids.indexOf(fetchId);
        if (index >= 0) {
            messaging_team_ids.splice(index, 1);
        }
    }
    
    if(messaging_team_ids.length > 0)
    {
        $('#multi_assign_button').show();
    }else{
        $('#multi_assign_button').hide();
    }
    
    $('#MultipleTaskAssignIds').val(messaging_team_ids);
    
  //  return;
});

    
</script>
