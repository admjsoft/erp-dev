<article class="content-body">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card-body">

        <div class="row">
                    
                    <div class="col-12 text-right">
                        <!-- Small Button -->
                        <a href="<?php echo base_url('productcategory'); ?>"> <button type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('List'); ?> </button></a>
                    </div>
                </div>
    
            <form method="post" id="data_form" class="form-horizontal">

                <h5><?php echo $this->lang->line('Add new') . '   ' . $this->lang->line('Sub') . ' ' . $this->lang->line('Category') ?></h5>
                <hr>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_catname"><?php echo $this->lang->line('Sub') . ' ' . $this->lang->line('Category Name') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="<?php echo $this->lang->line('Product Category Name'); ?>"
                               class="form-control margin-bottom  required" name="product_catname">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_catname"><?php echo $this->lang->line('Description') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="<?php echo $this->lang->line('Product Category Short Description'); ?>"
                               class="form-control margin-bottom required" name="product_catdesc">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="product_cat"><?php echo $this->lang->line('Category') ?></label>

                    <div class="col-sm-6">
                        <select name="cat_rel" class="form-control">
                            <?php
                            foreach ($cat as $row) {
                                $cid = $row['id'];
                                $title = $row['title'];
                                echo "<option value='$cid'>$title</option>";
                            }
                            ?>
                        </select>


                    </div>
                </div>
                <input type="hidden" value="1" name="cat_type">
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Add Category') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="productcategory/addcat" id="action-url">
                    </div>
                </div>


            </form>
        </div>
    </div>
</article>

