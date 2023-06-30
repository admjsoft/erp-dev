<div class="content-body">
    <style>
        form .form-group {
        margin-bottom: 0rem !important;
} </style>
    <div class="card">
        <div class="card-header">
            <h4><?php echo $this->lang->line('Add Schedule') ?></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="card-content">
				  <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
		
           <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message">

		</div>
            </div>
            <div class="card-body">
                <form method="post" id="data_form" enctype="multipart/form-data" action="<?php echo base_url("scheduler/create") ?>" >
                    <?php if ($this->aauth->premission(22)) { ?>
                        <div class="row mb-1 ml-1">
                          <!--  <label for="cst" class="col-md-4"><?php //echo $this->lang->line('Run Scheduler on expiry date') ?></label>-->
                                <div class="col-md4">
						<!--<input type="radio" value="yes" name="option" onclick="showandhide('yes')"> Yes	
					<input type="radio" value="no" name="option" onclick="showandhide('no')"> No	-->

                            </div>

                        </div>
                    <?php } ?>
					<div id="scheduleyes" style="display:block;">
					 <div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('Run Scheduler Alert Before') ?></label>
                                <div class="col-md3">
								
						<select name="days" id="days" class="form-control" style="width:200px;">
						<option value="">--Select Period--</option>
						<option value="30">30 						<?php echo $this->lang->line("Days");?>
</option>
					<option value="60">60 						<?php echo $this->lang->line("Days");?>
</option>
						<option value="90">90 						<?php echo $this->lang->line("Days");?>
</option>
</select>
                            </div>

                        </div>
						<div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('Module') ?></label>
                                <div class="col-md3">
								
		<select class="form-control" name="module" id="module" style="width:200px;"> 
<option value="">Select Module</option>
<?php 
foreach($modules as $module)
{
?>
<option value="<?php echo $module['id'];?>"><?php echo $module['name'];?></option>
<?php
}?>
</select>
                            </div>

                        </div>
						
						<div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('Email To') ?></label>
                                <div class="col-md3">
								
	<select class="form-multi-select form-control" name="email_to[]" id="ms1" multiple data-coreui-search="true" style="width:200px">
  <option value="1">Admin</option>
  <option value="2">Client</option>
  <option value="3">Employee</option>
</select>
                            </div>

                        </div>
						
						<div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('Email To') ?></label>
                                <div class="col-md3">
<select class="form-multi-select form-control" name="schedule_on[]" id="ms1" multiple data-coreui-search="true" style="width:200px">
  <option value="1">passport</option>
  <option value="2">permit</option>
</select>
                            </div>

                        </div>
						
						
						
						
						</div>
						   
	


						
						               
                    <div class="form-group row mt-2" >
                        <div class="col-sm-4">
                               <input type="submit" class="btn btn-success btn-lg margin-bottom"
                                   value="<?php echo $this->lang->line('Add Schdeule') ?>"
                                   data-loading-text="Adding...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <?php if ($this->aauth->premission(22)) { ?>
        <script type="text/javascript">

            $("#expenses-box").keyup(function () {
                $.ajax({
                    type: "GET",
                    url: baseurl + 'expenses/employee_search',
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function () {
                        $("#expenses-box").css("background", "#FFF url(" + baseurl + "assets/custom/load-ring.gif) no-repeat 165px");
                    },
                    success: function (data) {
                        $("#expenses-box-result").show();
                        $("#expenses-box-result").html(data);
                        $("#expenses-box").css("background", "none");

                    }
                });
            });
			
			function showandhide(val)
			{
				if(val=="yes")
				{
					$("#scheduleyes").show();
					$("#scheduleno").hide();

				}
				else{
				$("#scheduleno").show();
				$("#scheduleyes").hide();

					
				}
				
				
			}
			
			
			
        </script>
        <?php } ?>
