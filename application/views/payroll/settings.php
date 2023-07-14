<style>
.error_show{
	color: red;
	margin-left: 10px;
}
</style>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Add') . ' ' . $this->lang->line('Payroll') . ' ' . $this->lang->line('Settings') ?></h5>
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
           
            <div class="card-body">
            <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>

                <form method="post" id="data_form" class="form-horizontal" onSubmit="return validate(event);" enctype="multipart/form-data" action="<?php echo base_url("payroll/save_settings") ?>" >

                    <hr>
                    
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="pay_cat"><?php echo $this->lang->line('Staff') ?><span style="color:red">*</span></label>

                        <div class="col-sm-6">
								<span class="staff_error"></span>
                            <select name="staff" class="form-control" id="staff" onchange="getSettings(this.value)">
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

                    <div class="form-group row">
                        <label for="cst"
                               class="caption col-sm-2 col-form-label"><?php echo $this->lang->line('Basic Salary') ?><span style="color:red">*</span>
                        </label>
                        <div class="col-6">
														<span class="basic_error"></span>

						<input type="number" class="form-control" name="basic" id="basic"  oninput="calculateEpf(),calculateTotalSocsoEmpPer(),calculateemployerpercent()"
                                                  placeholder="Basic Salary"
                                                  autocomplete="off"/>

                            <div id="trans-box-result" class="sbox-result"></div>
                        </div>


                    </div>
                    <div id="customerpanel" class="form-group row">
                        <label for="toBizName"
                               class="caption col-sm-2 col-form-label"><?php echo $this->lang->line('EPF Employer') ?> %  <span style="color:red">*</span></label>
                        <div class="col-sm-6">
                        <span class="epf_percent_error"></span>

                         <select onchange="calculateEpf()" name="epf"  id="epf" class="form-control">
              <option  value="" >--Select %--</option>
              <option value="9">9%</option>
                <option value="11">11%</option>
              <option value="13">13%</option>
            </select>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"
                               for="date"><?php echo $this->lang->line('EPF Employee') ?> % <span style="color:red">*</span></label>
                        <div class="col-sm-6">
				                        <span class="epfEmployee_percent_error"></span>

                 <select onchange="calculateEpf()" name="epfEmployee"  id="epfEmployee" class="form-control">
              <option  value="" >--Select %--</option>
              <option value="9">9%</option>
              <option value="11">11%</option>
            </select>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="amount"><?php echo $this->lang->line('EPF Employee') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
										                        <span class="epf_employee_error"></span>

                            <input type="text" placeholder=""
                                   class="form-control margin-bottom  required" name="epfEmp" id="epfEmp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 control-label"
                               for="product_price"><?php echo $this->lang->line('EPF Employer') ?> <span style="color:red">*</span></label>
                        <div class="col-sm-6">
	                     <span class="epfEmpyr_error"></span>

                            <div class="input-group">
							
                               <input type="text" placeholder=""
                                   class="form-control margin-bottom  required" name="epfEmpyr" id="epfEmpyr" autocomplete="off">


                            </div>
                        </div>
                    </div>
<div class="form-group row">

                             <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('SOSCO Employer') ?> % <span style="color:red">*</span></label>

                        <div class="col-sm-6">
							                     <span class="soscoempyr_percent_error"></span>

                            <div class="input-group">
                     
                 <select onchange="calculateTotalSocsoEmpPer()" name="socsoEmployerPer"  id="socsoEmployerPer" class="form-control">
              <option  value="" >--Select %--</option>
              <option value="1.25">1.25%</option>
              <option value="1.75">1.75%</option>
            </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">

                          <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('SOCSO Employee') ?> % <span style="color:red">*</span></label>


                        <div class="col-sm-6">
										                     <span class="soscoemployee_percent_error"></span>
			
                            <div class="input-group">
					<select onchange="calculateTotalSocsoEmpPer()" name="socsoEmpPer"  id="socsoEmpPer" class="form-control">
              <option  value="" >--Select %--</option>
              <option value="0.5">0.5%</option>
            </select>		
                            </div>
                        </div>
                    </div>
             <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('SOSCO Employer') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
						<span class="soscoemployee_error"></span>

                            <input type="text" placeholder=""
                                   class="form-control"  autocomplete="off" name="socso" id="socso" >
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('SOCSO Employee') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
			               						<span class="socsoEmp_error"></span>
			
                            <input type="text" placeholder=""  class="form-control" name="socsoEmp"  id="socsoEmp" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('PCB') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
									               						<span class="pcb_error"></span>

                            <input type="text" placeholder=""
                                   class="form-control" name="pcb" id="pcb" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('EIS Employee') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
			                <span class="eis_error"></span>			
                            <input type="text" placeholder=""
                                   class="form-control" name="eis" id="eis" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Bank Name') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
									                <span class="bankName_error"></span>			

                            <input type="text" placeholder=""
                                   class="form-control" name="bankName" id="bankName">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Bank Account No') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
						  <span class="bankAcc_error"></span>			

                            <input type="text" placeholder=""
                                   class="form-control" name="bankAcc" id="bankAcc">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Nationality') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
						<span class="nationality_error"></span>			
                            <select name="nationality" class="form-control" id="nationality" required>
                               <option value='1' selected>Malaysian</option>
                               <option value='2'>Foreigner</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Tax Number') ?> <span style="color:red">*</span></label>

                        <div class="col-sm-6">
						<span class="tax_error"></span>	
                            <input type="text" placeholder=""
                                   class="form-control" name="taxId"  id="taxId">
                        </div>
                    </div
              
                       

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"></label>
                       
                        <div class="col-sm-4">
                            <input type="submit" id="submit" class="btn btn-success margin-bottom" 
                                   value="<?php echo $this->lang->line('Save') ?>"
                                   data-loading-text="Adding...">
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   function calculateemployerpercent()
   {
var amnt=$('#basic').val();

if(amnt>5000)
{
var options='<option value="" selected="" disabled="">--Select %--</option><option value="12">12%</option>';
$("#epf").html(options);
}
else{
var options='<option value="" selected="" disabled="">--Select %--</option><option value="13">13%</option>';
$("#epf").html(options);

}	

          var Eis = (amnt*0.2)/100;
$("#eis").val(Eis);


   }
function validate(e)
{
	var nationality=$("#nationality").val();
   if(nationality==1)
   {
	$("#staff").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".staff_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
	$("#basic").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".basic_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	

$("#epf").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".epf_percent_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	

		
$("#epfEmployee").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".epfEmployee_percent_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
			
$("#epfEmp").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".epf_employee_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
				
		$("#epfEmpyr").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".epfEmpyr_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
			
		$("#socsoEmployerPer").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".soscoempyr_percent_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");				
	
		$("#socsoEmpPer").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".soscoemployee_percent_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
		$("#socso").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".soscoemployee_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
				$("#socsoEmp").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".socsoEmp_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			
			$("#pcb").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".pcb_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			
			$("#eis").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".eis_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			
			
			$("#bankName").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".bankName_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			
			$("#bankAcc").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".bankAcc_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			$("#nationality").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".nationality_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			$("#taxId").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".tax_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
   }
   else{
	   $("#staff").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".staff_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
	$("#basic").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".basic_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	

	   $("#bankName").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".bankName_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			
			$("#bankAcc").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".bankAcc_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
	   $("#nationality").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".nationality_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
	   $("#taxId").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".tax_error").text("this field is required");
					        e.preventDefault();
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
	   
   }
   
   
   
}

    
  function calculateEpf(){
      var basicVal = document.getElementById("basic").value;
      var epfVal = document.getElementById("epf").value;
      var epfEmpVal = document.getElementById("epfEmployee").value;
      if(basicVal != "" && epfVal != ""){
          var totalEpf = (basicVal*epfVal)/100;
          var totalEpfEmp = (basicVal*epfEmpVal)/100;
	      document.getElementById("epfEmpyr").value = totalEpf.toFixed(2);
	      document.getElementById("epfEmp").value = totalEpfEmp.toFixed(2);
      }
  }


  function calculateTotalSocsoEmpPer(){
      var basicVal = document.getElementById("basic").value;
      var socsoVal = document.getElementById("socsoEmployerPer").value;
      var socsoEmpVal = document.getElementById("socsoEmpPer").value;

      if(basicVal != "" && socsoVal != ""){
          var totalsocso = (basicVal*socsoVal)/100;
          var totalsocsoEmp = (basicVal*socsoEmpVal)/100;
          document.getElementById("socso").value = totalsocso.toFixed(2);
          document.getElementById("socsoEmp").value = totalsocsoEmp.toFixed(2);
      }
  }

  function changeContainer(i){
      if(i == 0){
          document.getElementById("formContainer").style.display = "none";
          document.getElementById("listContainer").style.display = "block";
      }else if(i==1){
          document.getElementById("formContainer").style.display = "block";
          document.getElementById("listContainer").style.display = "none";
      }
  }
  </script>


<script type="text/javascript">
	$(document).ready(function() {
		jQuery('.socso').keypress(function(event) {

			if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
				((event.which < 48 || event.which > 57) &&
				(event.which != 0 && event.which != 8))) {
				event.preventDefault();
			}

			var text = $(this).val();

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
			    event.preventDefault();
			}
		});
		jQuery('.socsoEmp').keypress(function(event) {

			if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
				((event.which < 48 || event.which > 57) &&
				(event.which != 0 && event.which != 8))) {
				event.preventDefault();
			}

			var text = $(this).val();

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
			    event.preventDefault();
			}
		});
		jQuery('.pcb').keypress(function(event) {

			if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
				((event.which < 48 || event.which > 57) &&
				(event.which != 0 && event.which != 8))) {
				event.preventDefault();
			}

			var text = $(this).val();

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
				event.preventDefault();
			}
		});
		jQuery('.eis').keypress(function(event) {

			if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
				((event.which < 48 || event.which > 57) &&
				(event.which != 0 && event.which != 8))) {
				event.preventDefault();
			}

			var text = $(this).val();

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
				event.preventDefault();
			}
		});
		jQuery('.epfEmp').keypress(function(event) {

			if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
				((event.which < 48 || event.which > 57) &&
				(event.which != 0 && event.which != 8))) {
				event.preventDefault();
			}

			var text = $(this).val();

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
				event.preventDefault();
			}
		});
		jQuery('.epfEmpyr').keypress(function(event) {

			if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
				((event.which < 48 || event.which > 57) &&
				(event.which != 0 && event.which != 8))) {
				event.preventDefault();
			}

			var text = $(this).val();

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
				event.preventDefault();
			}
		});

	});


    function getSettings (val)
    {

 $.ajax({
          type: "GET",
          url: baseurl + 'payroll/getSettings',
          data : {staffId:val},
          success: function (data) {
           details= JSON.parse(data);
           //alert(details);
           if(details!=null)
           {
           $('#basic').val(details.basic_salary);
           $('#epf').val(details.epf_percent);
           $('#epfEmployee').val(details.epf_employee_percent);
           $('#epfEmp').val(details.epf_employee);
           $('#epfEmpyr').val(details.epf_employer);
           $('#socsoEmployerPer').val(details.sosco_employer_percent);
           $('#socsoEmpPer').val(details.sosco_employee_percent);
           $('#socso').val(details.sosco_employer);
           $('#socsoEmp').val(details.sosco_employee);
           $('#pcb').val(details.pcb);
           $('#eis').val(details.eis);
           $('#bankName').val(details.bank);
           $('#bankAcc').val(details.accountno);
           $('#nationality').val(details.nationality);
           $('#taxId').val(details.tax_no);
           }
           else
           {
$('#basic').val('');
           $('#epf').val('');
           $('#epfEmployee').val('');
           $('#epfEmp').val('');
           $('#epfEmpyr').val('');
           $('#socsoEmployerPer').val('');
           $('#socsoEmpPer').val('');
           $('#socso').val('');
           $('#socsoEmp').val('');
           $('#pcb').val('');
           $('#eis').val('');
           $('#bankName').val('');
           $('#bankAcc').val('');
           $('#nationality').val(1);
           $('#taxId').val('');


           }

          }
            });
            
    
    }


</script>

