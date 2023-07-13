
<div class="content-body">
<div id="c_body"></div>
    <style>
        form .form-group {
        margin-bottom: 0rem !important;
}
.empty {
border: 1.5px solid red !important; 
} </style>
    <div class="card">
        <div class="card-header">
            <h4><?php echo $this->lang->line('Add Role') ?></h4>
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
                <form method="post" id="form" enctype="multipart/form-data" action="<?php echo base_url("employee/createrole") ?>" >
                    <?php if ($this->aauth->premission(22)) { ?>
                        <div class="row mb-1 ml-1">
                          <!--  <label for="cst" class="col-md-4"><?php //echo $this->lang->line('Run Scheduler on expiry date') ?></label>-->
                                <div class="col-md4">
						<!--<input type="radio" value="yes" name="option" onclick="showandhide('yes')"> Yes	
					<input type="radio" value="no" name="option" onclick="showandhide('no')"> No	-->

                            </div>

                        </div>
                    <?php } ?>
						
						<div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('Role Name') ?> <span style="color:red">*</span></label>
                                <div class="col-md3">
								<input type="text" name="role_name" id="role_name" class="form-control"  
								onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                            </div>
                        </div>
                    <div class="form-group row mt-2" >
                        <div class="col-sm-4">
                               <input type="submit" id="submit" class="btn btn-success btn-lg margin-bottom"
                                   value="<?php echo $this->lang->line('Add Role') ?>"
                                   data-loading-text="Adding...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
              <script type="text/javascript">
 $(document).ready(function() {
    $('#submit').click(function(event){
        var data = $('#role_name').val();
        var length = data.length;
        if(length < 1) {
			    $("#form input[type=text]").addClass("empty");

            event.preventDefault();
        }
    });
});
</script>