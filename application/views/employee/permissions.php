
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5 class="title">
                <?php echo $this->lang->line('Employee') ?> <a href="<?php echo base_url('employee/add') ?>"
                                                               class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?>
                </a>
				
            </h5></br></br>
			  <h5 class="title">
                <?php echo $this->lang->line('Role') ?> <a href="<?php echo base_url('employee/role') ?>"
                                                                  class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?>
                </a>
				
            </h5>
			
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
            <div class="card-body">
			
			                        <span style="color:red;font-weight:500px;" id="err_msg"></span>

			                <form method="post" id="data_form" class="form-horizontal">

                                        <div class="form-group row mt-1">
										
                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Roles') ?> <span style="color:red">*</span></label>
                                        <div class="col-sm-8">
                                           <select name="role" id="role" class="form-control" onchange="getValues(this.value);"  style="width:50%" required >
										   <option value="">--Select Role--</option>
										   <?php 										
										   foreach ($roles as $role) {

											   ?>
											   <option value="<?php echo $role['id'];?>"><?php echo $role['role_name'];?></option>
											  <?php 
										   }?>
										   </select>
                                        </div>
                                    </div>
                              
						
									
									
					 <label><input type="checkbox" name="sample" class="selectall"/> Select all</label>

                    <table id="" class="table table-striped table-bordered zero-configuration table-responsive"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Modules') ?></th>
                            <th><?php echo $this->lang->line('Access') ?></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;

                        foreach ($permission as $row) {
                            $i = $row['id'];
                            $module = $row['module'];

                            echo "<tr>
                    <td>$i</td>
                    <td>$module</td>"; ?>

                            <td><input type="checkbox" name="r_<?= $i ?>_1"
                                       class="m-1"  id="r_<?= $i ?>_1"></td>
                            <?php
                            echo "
                    </tr>";
                            //  $i++;
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Name') ?></th>
                           
                        </tr>
                        </tfoot>
                    </table>
                    <div class="form-group row">

                        <div class="col-sm-1"></div>

                        <div class="col-sm-6">
                            <input type="submit" id="submit-data1" class="btn btn-success margin-bottom btn-lg"
                                   value="<?php echo $this->lang->line('Update') ?>"
                                   data-loading-text="Adding...">
                            <input type="hidden" value="employee/permissions_update" id="action-url">
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        //datatables
        $('#emptable').DataTable({responsive: true});


    });
  $("#submit-data1").on("click", function (e) {
	var role=$("#role").val();
	   if (role=="") {
		   $('#err_msg').html("Role Field Is Required");
		   return false;
   
  } 
	  
	  
        e.preventDefault();
        var o_data = $("#data_form").serialize();
        var action_url = $('#action-url').val();
		var role_id=$('#role').val();
        addObject1(o_data, action_url);
		function addObject1(action, action_url) {

        jQuery.ajax({

            url: '<?php echo base_url() ?>' + action_url,
            type: 'POST',
            data: action + '&<?=$this->security->get_csrf_token_name(); ?>=<?=$this->security->get_csrf_hash(); ?>',
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
					location.reload(true);

                  //  $("#data_form").hide();


                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    $("#data_form").hide();

                }

            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);

            }
        });


    }
    });
	
function getValues(val)
{

 
 $.ajax({
          type: "GET",
          url: baseurl + 'employee/getSelectedPermission',
          data : {roleid:val},
          success: function (data) {
          // details= JSON.parse(data);
           //alert(details);
             ///console.log(data);
			 const myArray = data.split(",");
            //  console.log(myArray.length);
			  for(i=0;i<myArray.length;i++)
			  {
				  var x=myArray[i];
				//  console.log(x);
				  var id="#r_"+x+"_1";
				///  console.log(id);
				  $(id).prop("checked", true);

			  }

          }
            });
            
    
	
}
	
	$('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('div input').attr('checked', true);
    } else {
        $('div input').attr('checked', false);
    }
});
</script>



