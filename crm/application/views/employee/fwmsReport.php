<?php 

	?>
<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
              <form method="post" action="<?php echo site_url('employee/fwmsreportGenerate')?>" id="data_form" class="form-horizontal" enctype="multipart/form-data"  >
            <div class="row">

                <h5><?php echo $this->lang->line('Report') ?></h5>
                <hr>
                <div class="col-md-6">


  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="phone"><?php echo $this->lang->line('Employee') ?></label>

                        <div class="col-sm-10">
                            <select name="employee" id="employee" class="form-control">
							<option value="0">All</option>
							<?php foreach($employees as $emp)
							{
								
?>
<option value="<?php echo $emp['id'];?>"><?php echo $emp['name'];?></option>
<?php

							}?>								
							</select>
                        </div>
                    </div>
                   
                </div>

                <div class="col-md-6">
                  
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Expiry') ?></label>

                        <div class="col-sm-10">
                             <select name="expiry" id="expiry" class="form-control">
							 <option value="">--Select--</option>
							<option value="1">30 days</option>
							<option value="2">60 days</option>
							<option value="3">90 days</option>

							</select>
                        </div>
                    </div>
                 

                </div>

            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"></label>

                <div class="col-sm-4">
                    <input type="submit" id="" class="btn btn-success margin-bottom"
                           value="Search" data-loading-text="Updating...">
                </div>
            </div>
        </form>
    </div>
</article>

