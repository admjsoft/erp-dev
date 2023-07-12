<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo "Attendance Report";//$this->lang->line('Attendance') ?></h5>
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
                    <div class="row mb-3">

                        <div class="col-md-3">
                            <select name="employee" class="form-control employee emp-list" >
                                <option value="0">-- <?php echo $this->lang->line('Select Employee') ?> --</option>
                            </select></div>
                        <div class="col-md-3">
                            <?php date('Y'); ?>
                            <select name="year" class="form-control">
                                <option value="0"> -- Year -- </option>
                                <?php for($i=0;$i<=5;$i++){

                                    $year=date('Y')-$i;
                                    ?>
                                    <option value="<?php echo $year; ?>"><?= $year; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="month" class="form-control">
                                <option value="0"> -- Month -- </option>
                                <?php  for($i=12;$i>0;$i--){
                              $name =  date("F", strtotime(date('Y-m-d')." -".$i." months"));
                              $month =  date("m", strtotime(date('Y-m-d')." -".$i." months"));
                                    ?>
                                    <option value="<?php echo $month; ?>"><?= $name; ?></option>
                                    <?php  } ?>
                            </select>
                          </div>
                        <div class="col-md-3 "><button class="btn btn-success col-12" type="post">Search</button></div>
                    
                    </div>
                </form>
                <table id="htable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Employee') ?></th>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th>Activity</th>
                        <th><?php echo "Start Time"; //$this->lang->line('ClockIn') ?></th>
                        <th><?php echo  "End Time" //$this->lang->line('ClockOut') ?></th>
                        <th>Duration</th>
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
        $(document).ready(function () {
            $('#htable').DataTable({
                'responsive': true,
                <?php datatable_lang();?>
                'order': [],
                'columnDefs': [
                    {
                        'targets': [0],
                        'orderable': false,
                    },
                ], dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend:'print',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend:'pdf',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                ],
            });
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
    </script>
