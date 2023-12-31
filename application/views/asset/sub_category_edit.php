<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Edit Category') ?></h5>
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
                <?php
$attributes = array('class' => 'form-horizontal', 'id' => 'data_form');
echo form_open('', $attributes);
?>


                <input type="hidden" name="subcatid" value="<?php echo $sub_category->id; ?>"">

<div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="name">Asset Category</label>

                                <div class="col-sm-6">
                                 <select id="Category" class="form-control" style="width:100%;" data-val="true" data-val-required="The Category field is required." name="Category">
                                                    <option disabled="" selected="">--- SELECT ---</option>
	                                  <?php foreach ($categories as $catg) {
?>
									  
									  <option value="<?php echo $catg['id']; ?>" <?php if ($catg['id'] == $sub_category->asset_category) {
        echo "selected";
    } ?>><?php echo $catg['name']; ?></option><?php
} ?>
                                                                              </select>
									 
                                </div>
                            </div>
                <div class="form-group row">

                     <label class="col-sm-2 col-form-label"
                                       for="name"><?php echo $this->lang->line('Name') ?></label>

                    <div class="col-sm-6">
                     <input type="text" placeholder="Name"
                                           class="form-control margin-bottom required" id="name" name="name"   value="<?php echo $sub_category->name; ?>" >
                    </div>
                </div>


                <div class="form-group row">

                   <label class="col-sm-2 col-form-label"
                                       for="phone"><?php echo $this->lang->line('Description') ?></label>
                    <div class="col-sm-6">

 <input type="text" placeholder="Description"
                                           class="form-control margin-bottom required" name="description" id="description" value="<?php echo $sub_category->description; ?>">
                    </div>

                </div>


            

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                        <input type="hidden" value="asset/updateSubCategory" id="action-url">
                    </div>
                </div>

            </div>
            </form>
        </div>

    </div>
</div>

