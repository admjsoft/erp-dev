
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
                <h5><?php echo $this->lang->line('Add') . ' ' . $this->lang->line('Department') ?></h5>
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
            <form method="post" id="data_form" class="form-horizontal">
                    
						<div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('Name') ?> <span style="color:red">*</span></label>
                                <div class="col-md3">
								
								<input type="text" name="name" id="name" class="form-control required"  placeholder="Department Name" 
								onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                            </div>
                        </div>
                  
                <div class="form-group row">

                    <label class="col-sm-3 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="employee/adddep" id="action-url">
                    </div>
                </div>
                </form>
            </div>
        </div>
              <script type="text/javascript">
 $(document).ready(function() {
    $('#submit-data"').click(function(event){
        var data = $('#name').val();
        var length = data.length;
		alert(length);
        if(length < 1) {
			    $("#form input[type=text]").addClass("empty");

            event.preventDefault();
        }
    });
});
</script>