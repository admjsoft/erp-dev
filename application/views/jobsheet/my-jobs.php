<style>
    .disabled-link {
        color: #999;
        cursor: not-allowed;
        text-decoration: none;
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
            <div class="header-block">
                <h3 class="title">
                    <?php //echo $this->lang->line('Support Tickets') ?>
                </h3></div>
            <p>&nbsp;</p>
            <table id="doctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
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
<script type="text/javascript">
    $(document).ready(function () {
        draw_data();

function draw_data(status = '') {

    //alert(status);
    $('#doctable').DataTable({
    "processing": true,
    "serverSide": true,
    responsive: true,
    <?php datatable_lang();?>
    "ajax": {
        "url": "<?php if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        } else {
            $filter = '';
        }    
        echo site_url('jobsheets/tasks_load_my_list?stat=' . $filter)?>",
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
                { "data": 4 }
                
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
    /*
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
    */
});


</script>
