<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5 class="title">
                <?php echo $this->lang->line('Dashboard Settings') ?> 
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


                <form method="post" id="data_form" class="form-horizontal" action="<?php echo site_url('dashboard/dashboardOptions')?>">
                    <table id="dashbord" class="table table-striped table-bordered zero-configuration table-responsive"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Name') ?></th>
                            <th><?php echo $this->lang->line('Enable/Disable') ?></th>
                          
                     
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

                
                            <td><input type="checkbox" name="dashboardsettings_<?php echo $i;?>"  <?php if ($row['r_5']==1) echo 'checked="checked"' ?> value="<?php echo $row['id'];?>"
                                       class="m-1" >
								  
									   
									   
									   </td>
                            
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
                              <th><?php echo $this->lang->line('Enable/Disable') ?></th>

                        </tr>
                        </tfoot>
                    </table>
                    <div class="form-group row">

                        <div class="col-sm-1"></div>

                        <div class="col-sm-6">
                            <input type="submit" id="" class="btn btn-success margin-bottom btn-lg"
                                   value="<?php echo $this->lang->line('Update') ?>"
                                   data-loading-text="Adding...">
                           <!-- <input type="hidden" value="employee/permissions_update" id="action-url">-->
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
        e.preventDefault();
        var o_data = $("#data_form").serialize();
        var action_url = $('#action-url').val();
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
</script>



  