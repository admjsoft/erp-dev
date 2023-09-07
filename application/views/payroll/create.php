<style>
.form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
}
.pl-3, .px-3 {
    padding-left: 1rem!important;
}

.pr-3, .px-3 {
    padding-right: 1rem!important;
}

.pb-0, .py-0 {
    padding-bottom: 0 !important;
}.p-1 {
    padding: 0.25rem !important;
}
</style>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Payroll') ?></h5>
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
 <form action="#" method="post">
            <div class="form-check">
              <input onchange="extraForm();showStaffInfo()" type="checkbox" class="form-check-input" id="paymentVoucherCheck">
              <label class="form-check-label" for="paymentVoucher"><?php echo $this->lang->line('Generate Payment Voucher') ?></label>
            </div>
            <div id="paymentSalarySection">
              <hr>
                   <div class="form-group row">
    <input type="hidden" name="current_month" id="current_month"  value="<?php echo date('m'); ?>">
    <input type="hidden" name="current_year" id="current_year"  value="<?php echo date('Y'); ?>">

                        <label class="col-sm-1 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Staff') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-5">
                            <select name="staff" class="form-control" onchange="showStaffInfo()" id="orgStaffId">
                            <option value=''>Select Staff</option>
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
					<span style="color:red">*</span><b>(Those Who Are Entered in the Settings will Appear On The Staff List Here)</b>
</br></br>

              <div class="form-group row">
                  <!-- MONTH -->
                    <label class="col-sm-1 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Month') ?></label>
                  <div class="col-sm-5"   >
                      <select class="form-control" id="monthSlip" onchange="checkmonthYear();">
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">Jun</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                      <select>
					  <input type="hidden" name="current_month" value="<?php echo date('m');?>">
                      <div class="invalid-feedback">
                          Please choose month
                      </div>
                  </div>

                  <!-- YEAR -->
                   <label class="col-sm-1 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Year') ?></label>
                  <div class="col-sm-5">
                      <select class="form-control" id="yearSlip" name="yearSlip" onchange="checkmonthYear();">
                              <option value="2021">2021</option>
                              <option value="2022" selected>2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
                              <option value="2027">2027</option>
                              <option value="2028">2028</option>
                              <option value="2029">2029</option>
                      </select>
                  <div class="invalid-feedback">
                      Please choose year
                  </div>
                  </div>

              </div>
			  <div class="form-check">
					<input  type="checkbox" class="form-check-input" id="advance" name="advance">
					<label class="form-check-label" for="paymentVoucher"><?php echo $this->lang->line('Advance') ?></label>
				</div><br/>
			 
			  <div class="form-group row advanceshow">
					<label for="allowance" class="col-sm-1 col-form-label"><?php echo $this->lang->line('Allowance') ?></label>
					<div class="col-sm-5">
						<input type="text" id="allowance" name="allowance" min="0" class="form-control" >
					</div>
					<label for="claims" class="col-sm-1 col-form-label"><?php echo $this->lang->line('Claims') ?></label>
					<div class="col-sm-5">
						<input type="text" id="claims" name="claims" min="0" class="form-control" >
					</div>
              </div>
			  <div class="form-group row advanceshow">
					<label for="commissions" class="col-sm-1 col-form-label"><?php echo $this->lang->line('Commissions') ?></label>
					<div class="col-sm-5">
						<input type="text" id="commissions" name="commissions" min="0" class="form-control" >
					</div>
					<label for="ot" class="col-sm-1 col-form-label"><?php echo $this->lang->line('OT') ?></label>
					<div class="col-sm-5">
						<input type="text" id="ot" name="ot" min="0" class="form-control" >
					</div>
              </div>
                <div class="form-group row advanceshow">
                    <label for="bonus" class="col-sm-1 col-form-label"><?php echo $this->lang->line('Bonus') ?></label>
                    <div class="col-sm-5">
                        <input type="text" id="bonus" name="bonus" min="0" class="form-control" >
                    </div>
                    <label for="deduction" class="col-sm-1 col-form-label"><?php echo $this->lang->line('Deduction') ?></label>
                    <div class="col-sm-5">
                        <input type="text" id="deduction" name="deduction" min="0" class="form-control" >
                    </div>

                </div>
			  
			  
			  
            </div>
            <div id="paymentVoucherSection" style="display:none">
              <hr>
              <div class="form-group row">
                  <!-- PAYEE -->
      <label class="col-sm-2 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Payee') ?> <span style="color:red">*</span></label>
                  <div class="col-sm-10"   >
                      <input oninput="showStaffInfo()" onclick="document.getElementById('payeeMessage').style.display = 'block'" id="payee" class="form-control" type="text" name="payee">
                      <small id="payeeMessage" style="display:none;">(person to whom money is to be paid)</small>
                      <div class="invalid-feedback">
                          Please enter payee name
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <!-- DATE PAYMENT VOUCHER -->
                  <label class="col-sm-2 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Payment Date') ?> <span style="color:red">*</span></label>
                  <div class="col-sm-10">
                      <input oninput="showStaffInfo()" id="datePaymentVoucher" class="form-control" type="date">
                      <div class="invalid-feedback">
                          Please choose payment date
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <!-- AMOUNT PAYMENT VOUCHER -->
				       <label class="col-sm-2 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Amount(RM)') ?> <span style="color:red">*</span></label>
                  <div class="col-sm-10">
                      <input oninput="showStaffInfo()" onchange="checkValue(this)" id="amountPaymentVoucher" class="form-control" type="number" min="0.01" step="0.01" >
                      <div class="invalid-feedback">
                          Please choose payment amount
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <!-- METHOD OF PAYMENT -->
				   <label class="col-sm-2 col-form-label"
                               for="methodOfPayment"><?php echo $this->lang->line('Method of Payment') ?> <span style="color:red">*</span></label>
                  <div class="col-sm-10"   >
                      <select onchange="showStaffInfo()" id="methodOfPayment" class="form-control">
                          <option value="0">Cash</option>
                          <option value="1">Cheque</option>
                          <option value="2">Fund Transfer</option>
                      <select>
                      <div class="invalid-feedback">
                          Please choose payment method
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <!-- THE SUM OF -->
			<label for="theSumOf" class="col-sm-2 col-form-label"><?php echo $this->lang->line('Payment for') ?> <span style="color:red">*</span></label>
                    <div class="col-sm-10"   >
                      <input oninput="showStaffInfo()" id="theSumOf" class="form-control" type="text" name="theSumOf">
                      <div class="invalid-feedback">
                          Please enter The Sum of
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <!-- BEING -->
				 <label for="being" class="col-sm-2 col-form-label"><?php echo $this->lang->line('Remarks') ?> <span style="color:red">*</span></label>
                  <div class="col-sm-10"   >
                      <input oninput="showStaffInfo()" id="being" class="form-control" type="text" name="being">
                      <div class="invalid-feedback">
                          Please enter remarks
                      </div>
                  </div>

              </div>
            </div>
            <div class="form-group row" style="display:none">
                <!-- DATE PAYMENT -->
			 <label for="datePayment" class="col-sm-2 col-form-label"><?php echo $this->lang->line('Date Payment') ?> <span style="color:red">*</span></label>
                <div class="col-sm-5"   >
                <input oninput="showStaffInfo()" class="form-control" type="date" id="datePayment" name="datePayment" value="<?php echo date("Y-m-d") ?>" required>
                <div class="invalid-feedback">
                    Please select date
                </div>
                </div>
            </div>
            <!-- PROCEED -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <button id="proceedPayroll" onclick="proceedTab()" name='proceedPayroll' class="btn btn-primary btn-lg btn-block" type='button' disabled><?php echo $this->lang->line('Proceed') ?></button>
                </div>
            </div>
        </form>
    </div>

   <div class="container" id="form-preview" style="display:none;" >
     <!-- EDIT BUTTON -->
     <div class="form-group row">
       <div class="col-sm-12">
         <button id="editPayroll" onclick="editTab()" name='editPayroll' class="btn btn-primary btn-lg btn-block" type='button'><?php echo $this->lang->line('Back To Edit') ?></button>
       </div>
     </div>

    <!-- PURCHASE VOUCHER -->
    <div id="form-pVoucher" style="overflow:scroll;">
        <div id="pVoucher" style="width:970px" style="display:none"></div>
    </div>

    <!-- PAYSLIP -->
    <div style="overflow:scroll;">
        <div id="payslip" style="width:970px"></div>
    </div>


     <!-- PRINT -->
      <div class="form-group row mt-2">
     <?php /*  <div class="col-sm-6"  style="display:none"><a href="../../phpfunctions/payroll.php?printPayslip=1">
         <button id="editPayroll" name='editPayroll' class="btn btn-primary btn-lg btn-block" type='button'>Print</button></a>
       </div> */ ?>
       <div class="col-sm-12">
	       <a id="href" href="<?php echo base_url();?>payroll/generatePayslip" >
		       <button id="generatePayroll" name='generatePayroll' class="btn btn-primary btn-lg btn-block" type='button'><?php echo $this->lang->line('Generate') ?></button></a>
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
            </div>
            </div>
				
				
         </br>
                                  </form>
            </div>
        </div>
    </div>
</div>
 <script>
 
 function checkmonthYear()
 {
	 var current_month = document.getElementById("current_month").value;
        var current_year = document.getElementById("current_year").value;
     var month = document.getElementById("monthSlip").value;
        var yearSlip = document.getElementById("yearSlip").value;
	
		if(month>parseInt(current_month) && yearSlip>=current_year)
		{
		$("#proceedPayroll").prop('disabled', true);
		}
		else{

				$("#proceedPayroll").prop('disabled', false);
	
		}
	 
	 
 }
    function showStaffInfo(){
      var check = document.getElementById("paymentVoucherCheck").checked

      if (check) {
        var datePaymentVoucher = document.getElementById("datePaymentVoucher").value;
        var amountPaymentVoucher = document.getElementById("amountPaymentVoucher").value;
        var methodOfPayment = document.getElementById("methodOfPayment").value;
        var theSumOf = document.getElementById("theSumOf").value;
        var being = document.getElementById("being").value;
        var payee = document.getElementById("payee").value;

        if (methodOfPayment == "" || theSumOf == "" || being == "" || payee == "" || datePaymentVoucher == "" || amountPaymentVoucher == "") {
          document.getElementById("proceedPayroll").disabled = true;
        }else {
          document.getElementById("proceedPayroll").disabled = false;
        }
      }else {
        var x = document.getElementById("orgStaffId").value;
        var y = document.getElementById("datePayment").value;
        if(x == "null" || y == ""){
			
           document.getElementById("proceedPayroll").disabled = true;
           console.log("button disabled");
        }else{
			$('#orgStaffId').css('border-bottom','2px solid gray');
           document.getElementById("proceedPayroll").disabled = false;
           console.log("button enabled");
        }
      }
    }

    function proceedTab(){
		
        var check = document.getElementById("paymentVoucherCheck").checked;
		var current_month = document.getElementById("current_month").value;
        var current_year = document.getElementById("current_year").value;

		if (!check)
		{
        var staffId = document.getElementById("orgStaffId").value;
		}
        var month = document.getElementById("monthSlip").value;
        var yearSlip = document.getElementById("yearSlip").value;
		
		
		
		
		if (document.getElementById("datePayment").value!='')
		{
        var datePayment = document.getElementById("datePayment").value;
		}
			if (document.getElementById("allowance").value!='')
		{
        var allowance = document.getElementById("allowance").value;
		}
		if (document.getElementById("claims").value!='')
		{
        var claims = document.getElementById("claims").value;
		}
		if (document.getElementById("commissions").value!='')
		{
        var commissions = document.getElementById("commissions").value;
		}
		if (document.getElementById("ot").value!='')
		{
        var ot = document.getElementById("ot").value;
		}
		if (document.getElementById("bonus").value!='')
		{
        var bonus = document.getElementById("bonus").value;
		}
		if (document.getElementById("deduction").value!='')
		{
        var deduction = document.getElementById("deduction").value;
		}
		       
        if (check) {
		
          document.getElementById("form-pVoucher").style.display = "block";
          document.getElementById("payslip").style.display = "none";
          var datePaymentVoucher = document.getElementById("datePaymentVoucher").value;
          var amountPaymentVoucher = document.getElementById("amountPaymentVoucher").value;
          var methodOfPayment = document.getElementById("methodOfPayment").value;
          var theSumOf = document.getElementById("theSumOf").value;
          var being = document.getElementById("being").value;
          var payee = document.getElementById("payee").value;
          $.ajax({
              type  : 'POST',
              url: baseurl + 'payroll/paymentVoucher',              
              data : {paymentVoucherPreview:true,methodOfPayment:methodOfPayment,theSumOf:theSumOf,being:being,payee:payee,datePayment:datePayment,staffId:staffId,datePaymentVoucher:datePaymentVoucher,amountPaymentVoucher:amountPaymentVoucher},
              success: function (data) {
				     details= JSON.parse(data);
              document.getElementById('pVoucher').innerHTML = details;
			  document.getElementById("card-body").style.display = "none";
			  document.getElementById("form-preview").style.display = "block";

			  
              }
          });
        }else {		

if(yearSlip > current_year || monthSlip > current_month)
{
  document.getElementById("proceedPayroll").disabled = true;
        }
else {
          document.getElementById("proceedPayroll").disabled = false;
        }

   document.getElementById("form-pVoucher").style.display = "none";
          document.getElementById("payslip").style.display = "block";
          $.ajax({
           type  : 'POST',
              url: baseurl + 'payroll/payslip',
              data : {payslip:true,staffId:staffId,month:month,yearSlip:yearSlip,datePayment:datePayment,allowance:allowance,claims:claims,commissions:commissions,ot:ot,bonus:bonus,deduction:deduction},
              success: function (data) {
              document.getElementById('payslip').innerHTML = data;
			  			  document.getElementById("card-body").style.display = "none";
			  document.getElementById("form-preview").style.display = "block";

              }
          });
        }
        document.getElementById("form-tab").style.display = "none";
        document.getElementById("form-preview").style.display = "block";
    }

    function editTab(){

        document.getElementById("card-body").style.display = "block";
        document.getElementById("form-preview").style.display = "none";
        document.getElementById("form-pVoucher").style.display = "none";
    }

    function extraForm(){
      var check = document.getElementById("paymentVoucherCheck").checked;

      if (check) {
        document.getElementById("paymentVoucherSection").style.display = "block";
        document.getElementById("paymentSalarySection").style.display = "none";
        document.getElementById("href").href = baseurl+'payroll/generatePaymentVoucher';
      }else {
        document.getElementById("paymentVoucherSection").style.display = "none";
        document.getElementById("paymentSalarySection").style.display = "block";
		document.getElementById("href").href = baseurl+'payroll/generatePayslip'
        //document.getElementById("href").href = "../../phpfunctions/payroll.php?generatePayslipPDF=1";
      }
    }
	$(function () {
        $('.advanceshow').hide();
		
		    $('#orgStaffId').css('border-bottom','2px solid #ff1010');


        //show it when the checkbox is clicked
        $('input[name="advance"]').on('click', function () {
            if ($(this).prop('checked')) {
                $('.advanceshow').fadeIn();
            } else {
                $('.advanceshow').hide();
				$('.advanceshow input').val('');
            }
        });
    });
	  function checkValue(id){
        var x = parseFloat(id.value);
        id.value=x.toFixed(2);
    }
	
    </script>
	
