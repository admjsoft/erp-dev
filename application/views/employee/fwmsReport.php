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
            <h5><?php echo $this->lang->line('FWMS Report') ?></h5>
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
              <form method="post" action="<?php echo site_url('employee/fwmsreportGenerate')?>" id="data_form" class="form-horizontal" enctype="multipart/form-data"  >
            <div id="paymentSalarySection">
              <hr>
                  
      <div class="form-group row">
          <div class="col-md-6">
            <label>Company</label>
	<select name="company"  class="form-control" onchange="getEmployee(this.value)">
			<option value="">--<?php echo $this->lang->line('Select Company'); ?>--</option>
              <?php foreach($client_list as $client)
			  {
				  ?>
<option value="<?php echo $client['id']; ?>"><?php echo $client['company'];  ?></option>
			  <?php }?>

			 
                                </select>
			
			


          </div>


          <div class="col-md-6">
		  <label><?php echo $this->lang->line('Employee'); ?></label>
           <select class="form-control"  name="employee" id="employee">
		   <option value=""><?php echo $this->lang->line('Select Employee'); ?></option>
		   
		   </select>
          </div>
		  
		  
		  
		  
      </div>
	  
	      <!--  <div class="form-group row">
			          <div class="col-md-6">

		<label>Choose Logo</label>

<input type="file" name="file">
</div>
</div>
	<b>(only jpeg,png Formats)</b>-->
		    
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


    function getEmployee(val)
    {
 $.ajax({
          type: "POST",
          url: baseurl + 'employee/getcompanyEmployee',
          data : {companyid:val},
          success: function (data) {
           details= JSON.parse(data);
          
     $("#employee").html(details);
		  //alert(details);
        
       

          }
            });
            
    
    }


    </script>
	