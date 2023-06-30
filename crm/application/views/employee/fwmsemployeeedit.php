<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
      <form method="post" id="data_form" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url("employee/updateInternational") ?>" >
       <input type="hidden" name="update_id" value="<?php echo $employee->id;?>">

	   <div class="row">

                <h5><?php echo $this->lang->line('Employee Details') ?></h5>
                <hr>
                <div class="col-md-6">


  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Name') ?></label>

                        <div class="col-sm-10">
                           <input type="text" placeholder="Name"
                                                   class="form-control margin-bottom b_input" value="<?php echo $employee->name;?>" name="emp_name" id="emp_name" required>
                                 
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('UserName') ?></label>

                        <div class="col-sm-10">
                              <input type="text"
                           class="form-control margin-bottom " value="<?php echo $employee->username;?>" name="user_name" id="user_name"
                           placeholder="user_name" required>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="phone"><?php echo $this->lang->line('Email') ?></label>

                        <div class="col-sm-10">
                 
                                          <input type="email" placeholder="email"
                           class="form-control margin-bottom" name="user_email" id="user_email"
                           placeholder="email" value="<?php echo $employee->email;?>" required>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label" for="email">UserRole</label>

                        <div class="col-sm-10">
            <select name="roleid" class="form-control margin-bottom">
                            <option value="4"><?= $this->lang->line('Business Manager') ?></option>
                            <option value="3"><?= $this->lang->line('Sales Manager') ?></option>
                            <option value="5"><?= $this->lang->line('Business Owner') ?></option>
                            <option value="2"><?= $this->lang->line('Sales Person') ?></option>
                            <option value="1"><?= $this->lang->line('Inventory Manager') ?></option>
                            <option value="-1"><?= $this->lang->line('Project Manager') ?></option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Passport Number') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="Passport Number"
 class="form-control margin-bottom b_input" name="passport" value="<?php echo $employee->passport;?>" id="passport" required>
                                     
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="city"><?php echo $this->lang->line('Passport Expiry') ?></label>

                        <div class="col-sm-10">
                            <input type="date" value="<?php echo $employee->passport_expiry;?>" class="form-control margin-bottom b_input" name="passport_expiry" id="passport_expiry" required>
                                
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="region"><?php echo $this->lang->line('Permit Number') ?></label>

                        <div class="col-sm-10">
                            <input type="text" placeholder="Permit Number" value="<?php echo $employee->permit;?>"
                         class="form-control margin-bottom b_input" name="permit" id="permit">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="country"><?php echo $this->lang->line('Permit Expiry') ?></label>

                        <div class="col-sm-10">
                                <input type="date"
                                                   class="form-control margin-bottom b_input"value="<?php echo $employee->permit_expiry;?> name="permit_expiry" id="permit_expiry" required>
                                        
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="postbox"><?php echo $this->lang->line('Country') ?></label>

                        <div class="col-sm-10">
       <input type="text" placeholder="country"
       class="form-control margin-bottom b_input" value="<?php echo $employee->country;?>" name="country" id="country">
                               
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="postbox"><?php echo $this->lang->line('Company') ?></label>

                        <div class="col-sm-10">
                                                                          <select name="company" id="company" class="form-control"required>
											    <option value="">--Select--</option>
										         <?php 
											 foreach($clients as $client)	
												{
                                                  
												   ?>                                              
                                <option value="<?php echo $client['id']; ?>" <?php
								if($client['id']==$employee->company){echo"selected";}?>><?php echo $client['name'];?></option>

												 <?php }?>												 
											   </select>
                        </div>
                    </div>
                            

                </div>

            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"></label>

                <div class="col-sm-4">
                    <input type="submit" id="" class="btn btn-success margin-bottom"
                           value="Update" data-loading-text="Updating...">
                </div>
            </div>
        </form>
    </div>
</article>

