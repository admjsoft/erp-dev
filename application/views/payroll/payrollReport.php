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
              <form method="post" action="<?php echo site_url('payroll/payrollReportGenerate')?>" id="data_form" class="form-horizontal" enctype="multipart/form-data"  >
            <div id="paymentSalarySection">
              <hr>
                   <div class="form-group row">

                        <label class="col-sm-1 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Staff') ?></label>

                        <div class="col-sm-5">
                            <select name="orgStaffId" class="form-control"  id="orgStaffId">
                            <option value=''>--Select Staff--</option>
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
            <label>Report Format</label>
            <select  class="form-control" onchange="changeInputType()" name="timeCategory" id="timeCategory">
			<option>--Select Report Format--</option>
              <option value="0">Monthly</option>
              <option value="1">Yearly</option>
            </select>
          </div>

          <div class="col-md-4">
            <div id="inputMonth">
              <label id="label">By Month</label>
              <input id="inputMonthForm" class="form-control" type="month" name="dateMonth" id="dateMonth" required>
            </div>
            <div id="inputYear" style="display:none">
              <div class="form-group row">
                <label id="label">By Year</label>
                <select id="inputYearForm" class="form-control" name="dateYear" id="dateYear">
                  <option id="year1"></option>
                  <option id="year2"></option>
                  <option id="year3"></option>
                  <option id="year4"></option>
                  <option id="year5"></option>
                  <option id="year6"></option>
                  <option id="year7"></option>
                  <option id="year8"></option>
                  <option id="year9"></option>
                  <option id="year10"></option>
                </select>
              </div>

            </div>
          </div>
		  
		  
		  
		  
      </div>
			       <div class="form-group row">
              <div class="col-md-12">
			  
                  <input type="checkbox" id="salary" name="salary" checked><label for="salary">&nbsp;Salary&nbsp;&nbsp;</label>
                  <input type="checkbox" id="allowance" name="allowance" checked><label for="allowance">&nbsp;Allowance&nbsp;&nbsp;</label>
                  <input type="checkbox" id="commissions" name="commissions" checked><label for="commissions">&nbsp;Commissions&nbsp;&nbsp;</label>
                  <input type="checkbox" id="claims" name="claims" checked><label for="claims">&nbsp;Claims&nbsp;&nbsp;</label>
                  <input type="checkbox" id="ot" name="ot" checked><label for="ot">&nbsp;OT&nbsp;&nbsp;</label>
                  <input type="checkbox" id="bonus" name="bonus" checked><label for="bonus">&nbsp;Bonus&nbsp;&nbsp;</label>
                  <input type="checkbox" id="epf" name="epf" checked><label for="epf">&nbsp;EPF&nbsp;&nbsp;</label>
                  <input type="checkbox" id="socso" name="socso" checked><label for="socso">&nbsp;SOCSO&nbsp;&nbsp;</label>
                  <input type="checkbox" id="pcb" name="pcb" checked><label for="pcb">&nbsp;PCB&nbsp;&nbsp;</label>
                  

              </div>
          </div> 
            </div>
             <div class="form-group row mt-2">
     <?php /*  <div class="col-sm-6"  style="display:none"><a href="../../phpfunctions/payroll.php?printPayslip=1">
         <button id="editPayroll" name='editPayroll' class="btn btn-primary btn-lg btn-block" type='button'>Print</button></a>
       </div> */ ?>
       <div class="col-sm-12">
		       <button id="generatePayroll" type="submit" name='generatePayroll' class="btn btn-primary btn-lg btn-block" type='button'><?php echo $this->lang->line('Search') ?></button>
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
     function changeInputType(){
      document.getElementsByName("dateMonth")[0].value = null;
      document.getElementsByName("dateYear")[0].value = null;
      var val = document.getElementById("timeCategory").value;
      if (val == 0) {
        document.getElementById("inputMonth").style.display = "block";
        document.getElementById("inputYear").style.display = "none";

        document.getElementById("inputMonthForm").required = true;
        document.getElementById("inputYearForm").required = false;

      }else {
        document.getElementById("inputMonth").style.display = "none";
        document.getElementById("inputYear").style.display = "block";

        document.getElementById("inputMonthForm").required = false;
        document.getElementById("inputYearForm").required = true;

        var i = 10;
        var d = new Date();
        var year = d.getFullYear();

        for(i=1;i<=10;i++){
          document.getElementById("year"+i).value = year;
          document.getElementById("year"+i).innerHTML = year;
          year--;
        }
      }
    }
    </script>
   <script>
       $(document).ready(function () {
        $('#payrollreport').removeAttr('width').DataTable( {
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            columnDefs: [
                { width: 200, targets: 0 }
            ],
            fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            <?php datatable_lang();?>
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
            ],
            dom: 'Blfrtip',


        });



    });



    </script>
	