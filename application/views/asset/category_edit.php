<div class="content-body">
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


                <input type="hidden" name="catid" value="<?php echo $categorie->id;?>"">


                <div class="form-group row">

                     <label class="col-sm-2 col-form-label"
                                       for="name"><?php echo $this->lang->line('Name') ?></label>

                    <div class="col-sm-6">
                     <input type="text" placeholder="Name"
                                           class="form-control margin-bottom" id="name" name="name"   value="<?php echo $categorie->name;?>" required>
                    </div>
                </div>categorie


                <div class="form-group row">

                   <label class="col-sm-2 col-form-label"
                                       for="phone"><?php echo $this->lang->line('Description') ?></label>
                    <div class="col-sm-6">

 <input type="text" placeholder="Description"
                                           class="form-control margin-bottom" name="description" id="description" value="<?php echo $categorie->description;?>">
                    </div>

                </div>


            

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                        <input type="hidden" value="asset/updateCategory" id="action-url">
                    </div>
                </div>

            </div>
            </form>
        </div>

    </div>
</div>

