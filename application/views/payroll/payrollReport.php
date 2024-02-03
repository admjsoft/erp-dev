<style>
.form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
}
</style>
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
                <form method="post" action="<?php echo site_url('payroll/payrollReportGenerate')?>" id="data_form"
                    class="form-horizontal" enctype="multipart/form-data">
                    <div id="paymentSalarySection">
                        <hr>
                        <div class="form-group row">

                            <label class="col-sm-1 col-form-label"
                                for="pay_cat"><?php echo $this->lang->line('Staff') ?> <span
                                    style="color:red">*</span></label>

                            <div class="col-sm-5">
                                <select name="orgStaffId" class="form-control" id="orgStaffId">
                                    <option value=''>--<?php echo $this->lang->line('Select Staff'); ?>--</option>
                                    <option value="0">All</option>

                                    <?php
                                foreach ($employee as $row) {
                                    $cid = $row['id'];
                                    $name = $row['name'];
                                    echo "<option value='$cid'>$name</option>";
                                }
                                ?>
                                </select>


                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label>Report Format <span style="color:red">*</span></label>
                                <select class="form-control" onchange="changeInputType()" name="timeCategory"
                                    id="timeCategory">
                                    <option>--<?php echo $this->lang->line('Select Report Format'); ?>--</option>
                                    <option value="0" selected><?php echo $this->lang->line('Monthly'); ?></option>
                                    <option value="1"><?php echo $this->lang->line('Yearly'); ?></option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div id="inputMonth">
                                    <label id="label"><?php echo $this->lang->line('By Month'); ?> <span style="color:red">*</span></label>
                                    <!-- <input id="inputMonthForm" class="form-control" type="month" name="dateMonth"
                                        id="dateMonth" required> -->
                                        <select  class="form-control"  name="dateMonth"
                                        id="dateMonth" required>
                                        <?php
                                        // Get the current month (numeric format)
                                        $currentMonth = date("n");

                                        // Loop through the months and generate the options
                                        for ($i = 1; $i <= 12; $i++) {
                                            $selected = ($i == $currentMonth) ? 'selected' : '';
                                            echo '<option value="' . $i . '" ' . $selected . '>' . date("F", mktime(0, 0, 0, $i, 1)) . '</option>';
                                        }
                                        ?>
                                        </select>
                                </div>
                                <div id="inputYear" style="display:none">
                                    <div class="form-group row">
                                        <label id="label"><?php echo $this->lang->line('By Year'); ?> <span style="color:red">*</span></label>
                                        <select id="inputYearForm" class="form-control" name="dateYear" id="dateYear">
                                            <!-- <option id="year1"></option>
                                            <option id="year2"></option>
                                            <option id="year3"></option>
                                            <option id="year4"></option>
                                            <option id="year5"></option>
                                            <option id="year6"></option>
                                            <option id="year7"></option>
                                            <option id="year8"></option>
                                            <option id="year9"></option>
                                            <option id="year10"></option>
                                        </select> -->
                                        <?php
                                          // Get the current year
                                          $currentYear = date("Y");

                                          // Loop through the years and generate the options
                                          for ($year = $currentYear - 5; $year <= $currentYear + 5; $year++) {
                                              $selected = ($year == $currentYear) ? 'selected' : '';
                                              echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                          }
                                          ?>
                                    </select>
                                    </div>

                                </div>
                            </div>




                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">

                                <input type="checkbox" id="salary" name="salary" checked><label
                                    for="salary">&nbsp;<?php echo $this->lang->line('Salary'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="allowance" name="allowance" checked><label
                                    for="allowance">&nbsp;<?php echo $this->lang->line('Allowance'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="commissions" name="commissions" checked><label
                                    for="commissions">&nbsp;<?php echo $this->lang->line('Commissions'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="claims" name="claims" checked><label
                                    for="claims">&nbsp;<?php echo $this->lang->line('Claims'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="ot" name="ot" checked><label
                                    for="ot">&nbsp;<?php echo $this->lang->line('OT'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="bonus" name="bonus" checked><label
                                    for="bonus">&nbsp;<?php echo $this->lang->line('Bonus'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="epf" name="epf" checked><label
                                    for="epf">&nbsp;<?php echo $this->lang->line('EPF'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="socso" name="socso" checked><label
                                    for="socso">&nbsp;<?php echo $this->lang->line('SOCSO'); ?>&nbsp;&nbsp;</label>
                                <input type="checkbox" id="pcb" name="pcb" checked><label
                                    for="pcb">&nbsp;<?php echo $this->lang->line('PCB'); ?>&nbsp;&nbsp;</label>


                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <?php /*  <div class="col-sm-6"  style="display:none"><a href="../../phpfunctions/payroll.php?printPayslip=1">
         <button id="editPayroll" name='editPayroll' class="btn btn-primary btn-lg btn-block" type='button'>Print</button></a>
       </div> */ ?>
                        <div class="col-sm-12">
                            <button id="generatePayroll" type="submit" name='generatePayroll'
                                class="btn btn-primary btn-lg btn-block"
                                type='button'><?php echo $this->lang->line('Search') ?></button>
                        </div>
                        </br>

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
    var val = document.getElementById("timeCategory").value;
    if (val == 0) {
        document.getElementById("inputMonth").style.display = "block";
        document.getElementById("inputYear").style.display = "none";

        document.getElementById("dateMonth").required = true;
        document.getElementById("dateYear").required = false;

    } else {
        document.getElementById("inputMonth").style.display = "none";
        document.getElementById("inputYear").style.display = "block";

        document.getElementById("dateMonth").required = false;
        document.getElementById("dateYear").required = true;

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
    $('#payrollreport').removeAttr('width').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [{
            width: 200,
            targets: 0
        }],
        fixedColumns: true,
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        //responsive: true,
        <?php datatable_lang();?> "columnDefs": [{
            "targets": [0],
            "orderable": true,
        }, ],
        dom: 'Blfrtip',


    });



});
</script>