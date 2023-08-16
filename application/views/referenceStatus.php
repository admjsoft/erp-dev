<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5>Referral Edit</h5>
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
                 <form method="post"  class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url("dashboard/UpdateReferralStatus") ?>" >


         <input type="hidden" name="statusid" value="<?php echo $status->id; ?>"">

<div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="name">Status</label>

                                <div class="col-sm-4">
                                 <select id="Category" class="form-control"  data-val="true" data-val-required="The Category field is required." name="status">
                                                <option value="">--- SELECT ---</option>
												<option value="0" <?php if($status->status==0){echo"selected";}?>>Pending</option>
	                                  			<option value="1"  <?php if($status->status==1){echo"selected";}?>>InProgress</option>
												<option value="2"  <?php if($status->status==2){echo"selected";}?>>Success</option>
                                   </select>
									 
                                </div>
                            </div>
              

                <div class="col-sm-4">
                            <input type="submit" id="submit" class="btn btn-success margin-bottom" onclick="validate()"
                           value="<?php echo $this->lang->line('Update') ?>"
                           data-loading-text="Adding...">
                </div>
            </form>
        </div>

    </div>
</div>

