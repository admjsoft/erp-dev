<div class=" ">
    <div class="card card-block ">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card card-block " >


            <form method="post" id="data_form" class="card-body">

                <h5><?php echo $this->lang->line('Attendance Settings') ?></h5>
                <hr>


                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Total Working Hours') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Total Working Hours') ?>" name="total_working_hours" value="<?php if(!empty($settings['total_working_hours'])){ echo $settings['total_working_hours']; } ?>">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-4 control-label" for="todate"><?php echo $this->lang->line('Clock In Time') ?>
                        <span style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <div class="input-group bootstrap-timepicker timepicker">
                            <input type="time" class="form-control input-small timepicker1" name="clock_in_time" value="<?php if(!empty($settings['clock_in_time'])){ echo $settings['clock_in_time']; } ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-4 control-label" for="todate"><?php echo $this->lang->line('Clock Out Time') ?>
                        <span style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <div class="input-group bootstrap-timepicker timepicker">
                            <input type="time" class="form-control input-small timepicker2" name="clock_out_time" value="<?php if(!empty($settings['clock_out_time'])){ echo $settings['clock_out_time']; } ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('OT Allowance Per Hour') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control required"
                            placeholder="<?php echo $this->lang->line('OT Allowance Per Hour') ?>" name="ot_allowance_per_hour" value="<?php if(!empty($settings['ot_allowance_per_hour'])){ echo $settings['ot_allowance_per_hour']; } ?>">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Clock In Grace Period in Minutes') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Clock In Grace Period in Minutes') ?>" name="clock_in_grace_period" value="<?php echo $settings['clock_in_grace_period']; ?>">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Clock Out Grace Period in Minutes') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Clock Out Grace Period in Minutes') ?>" name="clock_out_grace_period" value="<?php  echo $settings['clock_out_grace_period'];  ?>">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Clock In Checking Hours') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Clock In Checking Hours') ?>" name="clock_in_checking_hours" value="<?php echo $settings['clock_in_checking_hours'];  ?>">
                    </div>
                </div>

                
                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Auto Logout Minutes After ClockOut') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Auto Logout Minutes After ClockOut') ?>" name="auto_clock_out_minutes" value="<?php  echo $settings['auto_clock_out_minutes']; ?>">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Office Location') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="text" id="autocomplete" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Office Location') ?>" name="address" value="<?php if(!empty($settings['address'])){ echo $settings['address']; } ?>">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Office Latitude') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Office Latitude') ?>" id="latitude" name="latitude" value="<?php if(!empty($settings['latitude'])){ echo $settings['latitude']; } ?>">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Office Longitude') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Office Longitude') ?>" id="longitude" name="longitude" value="<?php if(!empty($settings['longitude'])){ echo $settings['longitude']; } ?>">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 control-label"
                        for="from"><?php echo $this->lang->line('Office Within Radius') ?> <span
                            style="color:red">*</span></label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control required"
                            placeholder="<?php echo $this->lang->line('Office Within Radius') ?>" name="office_login_radius" value="<?php echo $settings['clock_in_checking_hours'];  ?>">
                    </div>
                </div>



                <div class="form-group row">

                    <label class="col-sm-4 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                            value="<?php if(!empty($settings['id'])){ echo $this->lang->line('Update'); }else{ echo $this->lang->line('Add'); }  ?>" data-loading-text="Adding...">
                        <input type="hidden" value="employee/attendance_settings" id="action-url">
                        <input type="hidden" value="page_reload" id="after_action">                        
                        <input type="hidden" name="att_sett_id" id="att_sett_id" value="<?php if(!empty($settings['id'])){ echo $settings['id']; } ?>"/>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMWSr2YSC6925JdAvbRyfjaiRsF8rPxA4&libraries=places"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('autocomplete');

            var autocomplete = new google.maps.places.Autocomplete(input);
            
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // Place details not found for the input.
                    return;
                }
                var location = place.geometry.location;
                var latitude = location.lat();
                var longitude = location.lng();

                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                //alert('Latitude: ' + latitude + '\nLongitude: ' + longitude);
            });
        });
    </script>