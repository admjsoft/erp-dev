<style>
.form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
}
</style>
<?php

?>
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
			<div class="options">
         <a href="<?php echo site_url('fwms/fwmsreport')?>" class="btn btn-primary btn-block"><i class=""></i>Back                                                </a>
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
 <h4 style="text-align: center;"><u><?php echo $this->lang->line('FWMS Report') ?>
</u>
	 </h4>
     <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                 <tr>
                         <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
					 <th><?php echo $this->lang->line('Client') ?></th>
                        <th><?php echo $this->lang->line('Country') ?></th>
					     <th><?php echo $this->lang->line('Passport Number') ?></th>
					   <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					    <th><?php echo $this->lang->line('Permit') ?></th>
                        <th><?php echo $this->lang->line('Permit Expiry') ?></th>
						
                    </tr>
                </thead>
                <tbody>
				
				
                </tbody>

                <tfoot>
                   <tr>
                         <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
						  <th><?php echo $this->lang->line('Client') ?></th>
                        <th><?php echo $this->lang->line('Country') ?></th>
					     <th><?php echo $this->lang->line('Passport Number') ?></th>
					   <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					    <th><?php echo $this->lang->line('Permit') ?></th>
                        <th><?php echo $this->lang->line('Permit Expiry') ?></th>
						
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


      var val = document.getElementById("selectDateType").value;
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
	  
        $('#trans_table').removeAttr('width').DataTable( {
        
            fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php echo site_url('employee/fwmsReportGenerateAjax')?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash,company:<?php  if(!empty($company)){ echo $company=$company;}else{ echo"0"; };?>,employee:<?php  if(!empty($employee)){ echo $employee=$employee;}else{ echo"0"; };?>}
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
				
            ],
           dom: 'Blfrtip'
          
        });



    });
    </script>