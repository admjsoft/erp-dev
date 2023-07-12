	<?php
		
		?>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $this->lang->line('Edit Fwms Customer') ?></h4>

            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
	
		  <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
		
                <div class="card">

                    <div class="card-content">
					

					  <form method="post" id="data_form" class="form-horizontal" action="<?php echo base_url();?>/customers/updateInternational">
                        <div class="card-body" id="card-body">
                             <input type="hidden" value="<?php echo $client->id;?>" name="update_id">
                            <div class="tab-content px-1 pt-1" id="tab_content">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                    <div class="form-group row mt-1">
                                         <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Company Name') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Company"
                                                   class="form-control margin-bottom b_input" name="company_name" 
												   value="<?php echo $client->name;?>"
												   
												   required>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                         <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Address') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="address"
                                                   class="form-control margin-bottom b_input" name="address"  value="<?php echo $client->address;?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                      <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Roc Number') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Roc Number"
                                                   class="form-control margin-bottom b_input" name="roc" value="<?php echo $client->roc;?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Email') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Email"
                                                   class="form-control margin-bottom b_input" value="<?php echo $client->email;?>" name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                         <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Contact Number') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Contact"
                                                   class="form-control margin-bottom b_input" name="contact" value="<?php echo $client->phone;?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
 <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Incharge Person') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="incharge"
                                                   class="form-control margin-bottom b_input" name="incharge"  value="<?php echo $client->incharge;?>" required>
                                        </div>
                                    </div>
                                 
                       								
                                <div id="mybutton">
                                    <input type="submit" id=""
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php echo $this->lang->line('Update') ?>"
                                           data-loading-text="Adding...">
                                </div>
                            </div>
							</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 function getpassportDetails(val)
{
	if(val=="foreign")
	{
		$("#foreign_content").show();
		//$("#card_body").hide();
$("#tab_content").hide();
$("#tab_list").hide();

	}
	else{
		$("#foreign_content").hide();
		//$("#card_body").hide();
$("#tab_content").show();
$("#tab_list").show();
	}
	//alert(val);
}

</script>