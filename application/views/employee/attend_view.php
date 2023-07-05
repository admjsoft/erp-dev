<?php
            $emp = $this->input->get('id');

            
?>
<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Employee Attendance Details'); ?></h5>
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
    <hr>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="form-control mb-2 text-center" id="ct6"> </div>
            <small>Activity</small>
            <div class="mb-2 p-2 border-blue-grey">
                <?php
                foreach($bt as $item) {
                echo $item['name']." => ". $item['btime']."<br>";
                } ?>
            </div>
            <div>
                <?php  if ($this->aauth->auto_attend()) {
                ?>
                    <?php
                    //$_SESSION['s_role'];
                  // print_r($_SESSION);
                    if ($this->aauth->clock($emp)) {
                                           /// print_r($_SESSION);
 //$_SESSION["favanimal"] =$_SESSION['id'];
 
                       // echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">'.$this->lang->line('Attendance').' <i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $this->lang->line('On') . '</span></a>';
                       if(!$this->aauth->check_break() && !empty($break_details)) { 
                        $c_user_activity = $break_details[0]['activity'];
                        if($c_user_activity == 'Short Break' || $c_user_activity == 'Lunch Break')
                        {
                            echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">User has Taken a ' . $c_user_activity . ' <i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $c_user_activity  . '</span></a>';

                        }else if($c_user_activity == 'Away'){
                            echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">User went ' . $c_user_activity . ' <i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $c_user_activity  . '</span></a>';

                        }else{
                             //echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $c_user_activity  . '</span></a>';
                            echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">User has been ClockedIn<i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $c_user_activity  . '</span></a>';

                        }
                       
                    }else{
                        
                        echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">User has been ClockedIn <i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $this->lang->line('On')   . '</span></a>';

                    }
                    } else {
                        
                        if(isset($activeuser)) {
                            foreach($activeuser as $usr)
                            {
                                $new_date = date("Y-m-d",strtotime($usr['last_login']));
                                $currentdate=date("Y-m-d");

                                if($usr['id']==$emp && $new_date==$currentdate)
                                {
                                        echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">User has been ClockedIn  <i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $this->lang->line('On') . '</span></a>';
                                }
                            }
                        }else{
                            if(!empty($employee_details['clockout']))
                            {
                                echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"> User has been ClockedOut <i class="ficon icon-clock"></i><span class="badge badge-pill badge-default badge-warning badge-default badge-up">' . $this->lang->line('Off') . '</span></a>';

                            }else{
                                echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"> User hasn\'t been ClockedIn <i class="ficon icon-clock"></i><span class="badge badge-pill badge-default badge-warning badge-default badge-up">' . $this->lang->line('Off') . '</span></a>';

                            }
                        }

                    }

                        if (!$this->aauth->clock($emp)) {
                            if(isset($activeuser)) {
                                foreach($activeuser as $usr)
                                {
                                    if($usr['id']==$emp)
                                    {
                                        echo '<a href="' . base_url() . '/dashboard/clock_out?id='.$usr['id'].'" class="btn btn-outline-danger  btn-outline-white btn-md col-xl-5 col-md-12 m-1" ><span class="icon-toggle-off" aria-hidden="true"></span> ' . $this->lang->line('ClockOut') . ' </a>';
                                            if($this->aauth->check_break($emp)){
                                                $rw=$this->aauth->break_time_all();
                                                    foreach($rw as $item){
                                                    echo '<a href="' . base_url() . 'dashboard/break_in?bt='.$item['id'].'&id='.$usr['id'].'" class="btn btn-outline-light-blue  btn-outline-blue-grey  btn-md col-xl-5 col-md-12 col-xl-5 m-1" ><span class="icon-toggle-off" aria-hidden="true"></span> '.$item['name'].'</a>';
                                                }
                                        }else{
                                                echo '<a href="' . base_url() . 'dashboard/break_out?id='.$emp.'" class="btn btn-outline-cyan btn-md col-xl-5 col-md-12 m-1" ><span class="icon-toggle-off" aria-hidden="true"></span> ' . $this->lang->line('End Break') . 'End Break</a>';
                                        }
                                    }
                                    else{

                                    }
                                }
                            }else{
                                echo '<a href="' . base_url() . '/dashboard/clock_in?id='.$emp.'" class="btn btn-outline-success  btn-outline-white btn-md col-xl-5 col-md-12 m-1" ><span class="icon-toggle-on" aria-hidden="true"></span> ' . $this->lang->line('ClockIn') . ' <i class="ficon icon-clock spinner"></i></a>';
                            }

                        } else {

                            echo '<a href="' . base_url() . '/dashboard/clock_out?id='.$emp.'" class="btn btn-outline-danger  btn-outline-white btn-md col-xl-5 col-md-12 m-1" ><span class="icon-toggle-off" aria-hidden="true"></span> ' . $this->lang->line('ClockOut') . ' </a>';
                                if($this->aauth->check_break($emp)){
                                      $rw=$this->aauth->break_time_all();
                                        foreach($rw as $item){
                                        echo '<a href="' . base_url() . 'dashboard/break_in?bt='.$item['id'].'&id='.$emp.'" class="btn btn-outline-light-blue  btn-outline-blue-grey  btn-md col-xl-5 col-md-12 col-xl-5 m-1" ><span class="icon-toggle-off" aria-hidden="true"></span> '.$item['name'].'</a>';
                                    }
                            }else{
                                    echo '<a href="' . base_url() . 'dashboard/break_out?id='.$emp.'" class="btn btn-outline-cyan btn-md col-xl-5 col-md-12 m-1" ><span class="icon-toggle-off" aria-hidden="true"></span> ' . $this->lang->line('End Break') . 'End Break</a>';
                            }
                        }
                   } ?>
            </div>
        </div>
        <div class="col-md-8">
            <select name="activity_filter" id="activity_filter" class="form-control" onchange="getfilteredRecords();">
                    <option value=''>--Select--</option>
                                        <option value="day">Day</option>
                                        <option value="week">Weekly</option>
                                        <option value="month">Month</option>
                </select>
                <input type="hidden" name="id" value="<?php echo $emp; ?>" id="id">
                </br></br>
            <div class="mb-2">

                <table id="emptable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Date') ?></th>
						 <th><?php echo $this->lang->line('Activity') ?></th>

                        <th><?php echo $this->lang->line('Start') ?></th>
                        <th><?php echo $this->lang->line('Finish') ?></th>
                    </tr>
                    </thead>
                    <tbody id="attendance">
                    <?php
                    echo $attend;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                            <th><?php echo $this->lang->line('Date') ?></th>
					       <th><?php echo $this->lang->line('Activity') ?></th>

                        <th><?php echo $this->lang->line('Start') ?></th>
                        <th><?php echo $this->lang->line('Finish') ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function () {
            $('#emptable').DataTable({
                'responsive': true,

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
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ],
            });
        });

function getfilteredRecords()
		{
         var val=$("#activity_filter").val();
         var id=$("#id").val();
        $.ajax({
                "url": "<?php echo site_url('employee/getfilteredRecords') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
                    'val':val,'id':id
                    },
                    success: function(result){
                        if (result.length > 0){
                          $("#attendance").html(result);}
                }
        });
		}
		


    </script>
<script>function display_ct6() {
var x = new Date()
var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear();
x1 = x1 + " - " +  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
document.getElementById('ct6').innerHTML = x1;
display_c6();
 }
 function display_c6(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct6()',refresh)
}
display_c6()
</script>
