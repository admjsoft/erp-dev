<div class="form-group">
    <label for="nationality"><?php echo $this->lang->line('Nationality'); ?> : <?php echo $employee_details['country_name']; ?></label>
</div>

<div class="form-group">
    <label for="gender"><?php echo $this->lang->line('Gender'); ?> : <?php if(!empty($employee_details['gender'])) { echo $employee_details['gender']; }else{ echo "---"; }?> </label>
</div>

<div class="form-group">
    <label for="passportIC"><?php echo $this->lang->line('Passport'); ?> / <?php echo $this->lang->line('IC Number'); ?> : <?php if(!empty($employee_details['passport'])) { echo $employee_details['passport']; }else{ echo "---"; }?> / <?php if(!empty($employee_details['ic_number'])) { echo $employee_details['ic_number']; }else{ echo "---"; }?></label>
</div>

<div class="form-group">
    <label for="socsoNumber"><?php echo $this->lang->line('Socso Number'); ?> : <?php if(!empty($employee_details['socso_number'])) { echo $employee_details['socso_number']; }else{ echo "---"; }?> </label>
</div>

<div class="form-group">
    <label for="kwspNumber"><?php echo $this->lang->line('KWSP Number'); ?> : <?php if(!empty($employee_details['kwsp_number'])) { echo $employee_details['kwsp_number']; }else{ echo "---"; }?> </label>
</div>

<div class="form-group">
    <label for="pcbNumber"><?php echo $this->lang->line('PCB Number'); ?> : <?php if(!empty($employee_details['pcb_number'])) { echo $employee_details['pcb_number']; }else{ echo "---"; }?> </label>
</div>