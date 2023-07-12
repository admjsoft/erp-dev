
<div class="content-body">
    <style>
        form .form-group {
        margin-bottom: 0rem !important;
}
.empty {
border: 1.5px solid red !important; 
} </style>
    <div class="card">
        <div class="card-header">
                <h5><?php echo $this->lang->line('Add') . ' ' . $this->lang->line('Holiday') ?></h5>
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
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('From Date') ?> <span style="color:red">*</span></label>
                                <div class="col-md3">
						  <input type="text" class="form-control b_input required"
                               placeholder="Start Date" name="from"
                               data-toggle="datepicker" autocomplete="false"> </div>
                        </div>
                 <div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('To Date') ?> <span style="color:red">*</span></label>
                                <div class="col-md3">
						   <input type="text" class="form-control b_input required"
                               placeholder="End Date" name="todate"
                               data-toggle="datepicker" autocomplete="false"> </div>
                        </div>
                 <div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"><?php echo $this->lang->line('Note') ?> <span style="color:red">*</span></label>
                                <div class="col-md3">
								<textarea name="note" placeholder="Note Title" class="form-control"></textarea>
						 
                        </div>
                 

 <div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-3"></label>
                                <div class="col-md3">
<input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="employee/addhday" id="action-url">						 
                        </div>
             

                </form>
            </div>
        </div>
              <script type="text/javascript">
 $(document).ready(function() {
    $('#submit').click(function(event){
        var data = $('#name').val();
        var length = data.length;
        if(length < 1) {
			    $("#form input[type=text]").addClass("empty");

            event.preventDefault();
        }
    });
});
</script>