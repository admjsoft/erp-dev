<article class="content-body">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card-body">


            <form method="post" id="data_form" class="form-horizontal">

                <h5><?php echo $this->lang->line('Add New Module') ?>
                </h5>
                <hr>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_catname"><?php echo $this->lang->line('Module Name'); ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Module Name"
                            class="form-control margin-bottom  required" name="module_name" required>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_catname"><?php echo $this->lang->line('Module Url') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Module Url"
                            class="form-control margin-bottom " name="module_url" id="module_url" >
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Activity Type') ?></label>

                    <div class="col-sm-6">
                        <select name="module_activity_type" id="module_activity_type" class="form-control required" required>
                            <option value="">Select Activity Type</option>
                            <option value="Page Display" selected>Page Display</option>
                            <option value="Authorized Action">Action Authorization</option>
                            <option value="Landing Page">Landing Page</option>
                        </select>



                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Parent') ?></label>

                    <div class="col-sm-6">
                        <select name="module_parent"  id="module_parent" class="form-control required" required>
                        <!-- <option value=''>Please Select Parent</option> -->
                        <option value='0'>No Parent Module</option>
                            <?php
                            foreach ($side_bars as $row) {
                                $cid = $row['id'];
                                $title = $row['title'];
                                echo "<option value='$cid'>$title</option>";
                            }
                            ?>
                        </select>


                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Type') ?></label>

                    <div class="col-sm-6">
                        <select name="module_type" id="module_type" class="form-control required" required>
                            <option value="">Select Module Type</option>
                            <option value="Sidebar" selected>Sidebar</option>
                            <option value="Subheading">Subheading</option>
                            <option value="Child Heading">Child Heading</option>
                        </select>



                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Status') ?></label>

                    <div class="col-sm-6">
                        <select name="module_status" id="module_status" class="form-control required" required>
                            <option value="">Select Module Status</option>
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">In Active</option>
                        </select>



                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Position') ?></label>

                    <div class="col-sm-6">
                        <select name="module_position" id="module_position" class="form-control required" required>
                        <?php
                            for($i=1;$i<=50;$i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>



                    </div>
                </div>
                <?php $iconOptions=["icon-eyeglasses","icon-doc","icon-bar-chart","icon-bulb","icon-trophy","icon-book-open","icon-wallet","icon-list","icon-calendar","ft-users","fa fa-ticket","ft-sliders","ft-wind","icon-handbag","icon-puzzle","ft-target","fa fa-barcode","ft-umbrella","ft-list","ft-file-text","fa fa-money","icon-pie-chart","icon-energy","icon-calculator","icon-briefcase","fa fa-folder-o","icon-diamond","ft-layers","icon-basket-loaded","icon-speedometer","icon-call-out","icon-basket","icon-paper-plane","ft-radio","icon-screen-tablet","icon-sales","icon-quotes","icon-new-quote","icon-note","icon-map","icon-location-pin","icon-direction","icon-video","icon-view-list","icon-user","icon-settings","icon-search","icon-share","icon-rocket","icon-refresh","icon-question","icon-printer","icon-power","icon-plus","icon-play","icon-pin","icon-pencil","icon-options-vertical","icon-options","icon-notebook","icon-music","icon-minus","icon-microphone","icon-menu","icon-map-pin","icon-map-alt","icon-layers","icon-info","icon-home","icon-heart","icon-headphones","icon-grid","icon-globe","icon-gift","icon-folder","icon-flag","icon-flash","icon-expand","icon-edit"]; ?>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                        for="product_cat"><?php echo $this->lang->line('Module Icon') ?></label>

                    <div class="col-sm-6">
                        <select name="module_icon" id="module_icon" class="form-control" >
                            <option value=""> Select Module Icon</option>
                            <?php
                            foreach ($iconOptions as $optionValue) {
                                echo '<option value="' . $optionValue . '"><i class="' . $optionValue . '"></i> ' . $optionValue . '</option>';
                            } 
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                            value="<?php echo $this->lang->line('Add Module') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="modules/add" id="action-url">
                        <input type="hidden" value="reload" id="after_action">
                    </div>
                </div>


            </form>
        </div>
    </div>
</article>