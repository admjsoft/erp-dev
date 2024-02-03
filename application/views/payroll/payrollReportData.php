<style>
.form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
}
</style>

<?php 
if(empty($dateYear))
{
$dateYear=0;
}
else{
$dateYear=$dateYear;
}
if(empty($dateMonth))
{
$dateMonth=0;
}
else{
$dateMonth=$dateMonth;
}
?>
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Payroll Report') ?></h5>
            <hr>
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
            <div class="options">
                <a href="<?php echo site_url('payroll/payrollReport')?>" class="btn btn-primary btn-block"><i
                        class=""></i><?php echo $this->lang->line('Back'); ?> </a>
            </div>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body" id="card-body">

                <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
                <h4 style="text-align: center;"><u><?php //echo $this->lang->line('Payslip Report') ?> <?php 
// if(!empty($dateYear)){
// echo " For The Year $dateYear ";}
 //else{
	 // $month=date('M Y', strtotime($dateMonth));

	 // echo " For The Month  $month "; }
 ?></u>

                </h4>

                <div class=" text-right ">
                    <!-- Small Button -->
                    <form action="<?php echo base_url('export/export_payroll_report'); ?>" method="post">
                        <input type="hidden" id="employee_payroll_data" name="employee_payroll_data" value='<?php echo $payroll_filters; ?>' />
                       
                        <button type="submit"
                            class="btn btn-sm btn-primary"><?php echo $this->lang->line('Download'); ?>
                        </button></a>
                    </form>
                </div>

                <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('No') ?></th>
                            <th><?php echo $this->lang->line('Staff Name') ?></th>
                            <th id="rp1"><?php echo $this->lang->line('Month') ?></th>
                            <th id="rp2"><?php echo $this->lang->line('Year') ?></th>
                            <th id="rp3"><?php echo $this->lang->line('Salary') ?></th>
                            <th id="rp4"><?php echo $this->lang->line('Allowance') ?></th>
                            <th id="rp5"><?php echo $this->lang->line('Commissions') ?></th>
                            <th id="rp6"><?php echo $this->lang->line('Claims') ?></th>
                            <th id="rp7"><?php echo $this->lang->line('Bonus') ?></th>
                            <th id="rp8"><?php echo $this->lang->line('OT') ?></th>
                            <th id="rp9"><?php echo $this->lang->line('EPF') ?></th>
                            <th id="rp10"><?php echo $this->lang->line('SOCSO') ?></th>
                            <th id="rp11"><?php echo $this->lang->line('PCB') ?></th>
                            <th id="rp12"><?php echo $this->lang->line('Net Salary') ?></th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>


                </table>

            </div>



        </div>




    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


</br>
</form>
</div>
</div>
</div>
</div>

<script>
function changeInputType() {
    // document.getElementsByName("dateMonth")[0].value = null;
    // document.getElementsByName("dateYear")[0].value = null;


    //var val = document.getElementById("selectDateType").value;
    if (val == 0) {
        // document.getElementById("inputMonth").style.display = "block";
        // document.getElementById("inputYear").style.display = "none";

        // document.getElementById("inputMonthForm").required = true;
        // document.getElementById("inputYearForm").required = false;

    } else {
        // document.getElementById("inputMonth").style.display = "none";
        // document.getElementById("inputYear").style.display = "block";

        // document.getElementById("inputMonthForm").required = false;
        // document.getElementById("inputYearForm").required = true;

        // var i = 10;
        // var d = new Date();
        // var year = d.getFullYear();

        // for (i = 1; i <= 10; i++) {
        //     document.getElementById("year" + i).value = year;
        //     document.getElementById("year" + i).innerHTML = year;
        //     year--;
        // }
    }
}
</script>
<script>
$(document).ready(function() {

    $('#trans_table').removeAttr('width').DataTable({

        fixedColumns: true,
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        'responsive': true,
        <?php datatable_lang();?> 'order': [],

        "ajax": {
            complete: function(data) {
                //console.log(data.responseJSON);
            },
            "url": "<?php echo site_url('payroll/payrollReportGenerateAjax')?>",
            "type": "POST",
            'data': {
                'timeCategory': <?php echo $timeCategory;?>,
                'staffid': <?php echo $staffid;?>,
                'salary': '<?php echo $salary;?>',
                'allowance': '<?php echo $allowance;?>',
                'commissions': '<?php echo $commissions;?>',
                'claims': '<?php echo $claims;?>',
                'bonus': '<?php echo $bonus;?>',
                'ot': '<?php echo $ot;?>',
                'epf': '<?php echo $claims;?>',
                'socso': '<?php echo $socso;?>',
                'pcb': '<?php echo $pcb;?>',
                'dateMonth': <?php echo $dateMonth;?>,
                'dateYear': <?php echo $dateYear;?>,
                '<?=$this->security->get_csrf_token_name()?>': crsf_hash
            },
            "drawCallback": function(data) {
                alert("inn");
                console.log(data);
                //do whatever  
            }
        },
        "columnDefs": [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                "orderable": false,
            },

        ],
        dom: 'Blfrtip'

    });



});
</script>