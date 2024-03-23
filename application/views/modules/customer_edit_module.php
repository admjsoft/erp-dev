<article class="content-body">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card-body">


            <form method="post" id="data_form" class="form-horizontal">

                <h5><?php echo $this->lang->line('Edit Module') ?>
                </h5>
                <hr>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_catname"><?php echo $this->lang->line('Module Name'); ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Module Name" class="form-control margin-bottom required"
                            value="<?php echo $module_details[0]['title']; ?>" name="module_name" required>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_catname"><?php echo $this->lang->line('Module Url') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Module Url" class="form-control margin-bottom "
                            value="<?php echo $module_details[0]['url']; ?>" name="module_url" id="module_url" required>
                    </div>
                </div>

                <?php $iconOptions=["icon-file-text","icon-cash","icon-file","icon-bar-chart","icon-bulb","icon-list","icon-briefcase","icon-diamond","icon-sales","icon-map","icon-folder"]; ?>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Icon') ?></label>

                    <div class="col-sm-6">
                        <select name="module_icon" id="module_icon" class="form-control">
                            <option value=""> <?php echo $this->lang->line('Select Module Icon'); ?></option>
                            <?php foreach ($iconOptions as $optionValue) { ?>
                            <option value="<?php echo $optionValue; ?>"
                                <?php if($module_details[0]['icon'] == $optionValue){ echo "selected"; } ?>>
                                <?php echo $optionValue; ?></option>';
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Status') ?></label>

                    <div class="col-sm-6">
                        <select name="module_status" id="module_status" class="form-control required" required>
                            <option value=""><?php echo $this->lang->line('Select Module Status'); ?></option>
                            <option value="Active"
                                <?php if($module_details[0]['status'] == 'Active'){ echo "selected"; } ?>><?php echo $this->lang->line('Active'); ?>
                            </option>
                            <option value="Inactive"
                                <?php if($module_details[0]['status'] == 'Inactive'){ echo "selected"; } ?>><?php echo $this->lang->line('In Active'); ?>
                            </option>
                        </select>



                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Position') ?></label>

                    <div class="col-sm-6">
                        <select name="module_position" id="module_position" class="form-control required" required>
                            <?php for($i=1;$i<=50;$i++) { ?>
                            <option value="<?php echo $i; ?>"
                                <?php if($module_details[0]['display_order'] == $i){ echo "selected"; } ?>>
                                <?php echo $i; ?></option>
                            <?php } ?>
                        </select>



                    </div>
                </div>
                

                <input type="hidden" value="<?php echo $module_details[0]['id'];?>" name="module_id" id="module_id">
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                            value="<?php echo $this->lang->line('Edit Module') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="modules/customer_module_update" id="action-url">
                        <input type="hidden" value="reload" id="after_action">
                    </div>
                </div>


            </form>
        </div>
    </div>
</article>