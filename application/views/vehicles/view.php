<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.234/pdf.js"></script>

<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h3><?php echo $vehicle['make']." - ".$vehicle['model']; ?></h3>
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
            <div class="row mr-2">

                <div class="col-12 text-right ">
                    <!-- Small Button -->
                    <a href="<?php echo base_url('vehicles'); ?>"> <button type="button"
                            class="btn btn-sm btn-primary"><?php echo $this->lang->line('List'); ?> </button></a>
                </div>
            </div>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata("SuccessMsg")) {?>
                <div class="alert alert-success notify-alert">
                    <?php echo $this->session->flashdata("SuccessMsg") ?>
                </div>
                <?php }?>
                <?php if ($this->session->flashdata("ErrorMsg")) {?>
                <div class="alert alert-danger notify-alert">
                    <?php echo $this->session->flashdata("ErrorMsg") ?>
                </div>
                <?php }?>

                <div class="row">
                    <div class="col-sm-6">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Registration No') ?></div>
                            <div class="value"><?php echo $vehicle['registration_number']; ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Vehicle No') ?></div>
                            <div class="value"><?php echo $vehicle['vin']; ?></div>
                        </div>
                        <hr>
                    </div>

                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Fuel Type') ?></div>
                            <div class="value"><?php echo $vehicle['fuel_type'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Manufacure Year') ?></div>
                            <div class="value"><?php echo $vehicle['year_of_manufacture'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Make') ?></div>
                            <div class="value"><?php echo $vehicle['make'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Model') ?></div>
                            <div class="value"><?php echo $vehicle['model'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Color') ?></div>
                            <div class="value"><?php echo $vehicle['color'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Employee Name') ?></div>
                            <div class="value"><?php echo $vehicle['employee_name'] ?></div>
                        </div>
                        <hr>
                    </div>
                    
                    <!-- Display associated upload files -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
