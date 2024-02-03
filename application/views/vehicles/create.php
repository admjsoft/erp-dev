    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card card-block">
            <!-- Display uploaded files -->
         

            <!-- Display validation errors here -->
            <div id="validation_errors" class="alert alert-danger" style="display:none;"></div>

            <?php
        $attributes = array('class' => 'card-body', 'id' => 'vehicle_form', 'name' => 'vehicle_form');
        echo form_open_multipart('vehicles/create', $attributes);
        ?>

            <div class="row mr-2">
                <div class="col-6 text-left mr-">
                    <h5><?php echo $this->lang->line('Add New Vehicle') ?></h5>
                </div>
                <div class="col-6 text-right mr-">
                    <!-- Small Button -->
                    <a href="<?php echo base_url('vehicles'); ?>"> <button type="button"
                            class="btn btn-sm btn-primary"><?php echo $this->lang->line('List'); ?> </button></a>
                </div>
            </div>
            <hr>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Registration No'); ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control margin-bottom" name="registrationNo"
                        placeholder="<?php echo $this->lang->line('Registration No'); ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Vehicle No'); ?></label>
                <div class="col-sm-6"><input type="text" class="form-control margin-bottom" name="vinNo"
                        placeholder="<?php echo $this->lang->line('Vehicle No'); ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Fuel Type'); ?></label>
                <div class="col-sm-6">
                <select class="form-control margin-bottom" id="fuelType" name="fuelType"
                        placeholder="<?php echo $this->lang->line('Fuel Type'); ?>">
                        <option value="" selected><?php echo $this->lang->line('Select Fuel Type'); ?></option>
                        <option value="Petrol" ><?php echo $this->lang->line('Petrol'); ?></option>
                        <option value="Diesel"><?php echo $this->lang->line('Diesel'); ?></option>
                        <option value="Gas"><?php echo $this->lang->line('Gas'); ?></option>
                        <option value="EV"><?php echo $this->lang->line('EV'); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Manufacure Year'); ?></label>
                <div class="col-sm-6">
                <select class="form-control margin-bottom" id="manufactureYear" name="manufactureYear">
                <option value="" selected><?php echo $this->lang->line('Select Manufacure Year'); ?></option>
                    <?php
                    // Get the current year
                    $currentYear = date('Y');

                    // Generate options for the last 20 years
                    for ($year = $currentYear; $year >= $currentYear - 20; $year--) {
                        echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Make'); ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control margin-bottom" name="make"
                        placeholder="<?php echo $this->lang->line('Make'); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Model'); ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control margin-bottom" name="model"
                        placeholder="<?php echo $this->lang->line('Model'); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Color'); ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control margin-bottom" name="color"
                        placeholder="<?php echo $this->lang->line('Color'); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Assign Driver'); ?></label>
                <div class="col-sm-6">
                <select class="form-control margin-bottom" id="emp_id" name="emp_id"
                        placeholder="<?php echo $this->lang->line('Assign Driver'); ?>">
                        <option value="" selected><?php echo $this->lang->line('Select Driver'); ?></option>
                        <?php if(!empty($drivers)){ foreach ($drivers as $row) { ?>
                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['name']; ?></option>
                        <?php } }?>
                    </select>
                </div>
            </div>

            <div class="form-group row">

                <label class="col-sm-2 col-form-label"></label>

                <div class="col-sm-4">
                    <input type="submit" class="btn btn-success margin-bottom" name="submit"
                        value="<?php echo $this->lang->line('Add Vehicle') ?>" data-loading-text="Adding...">
                </div>
            </div>

            <?php echo form_close(); ?>
        </div>
       
        <script>
        $(document).ready(function() {
            $('#vehicle_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

               
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Important for file uploads
                    processData: false, // Important for file uploads
                    success: function(response) {
                        if (response.success) {
                            // Redirect to the success page
                            window.location.href = response.redirect_url;
                        } else {
                            // Display validation errors
                            $('#validation_errors').html(response.validation_errors).show();
                        }
                    }
                });
                // // const page = document.getElementById('file-preview');
                // // var annotateMeta = page.getAnnotations().then(function (data) {
                // // console.log(data);
                // });
            });
        });
        </script>

        <!-- JavaScript to display file preview, check file size, and remove files -->
      

    </div>