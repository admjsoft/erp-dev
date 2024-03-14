<div class="form-group">
    <label for="globalLock">Global Lock:</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="globalunLock" id="globalunLockYes" value="yes" <?php if($file_details[0]['global_lock'] == 1){ echo "checked"; } ?>>
        <label class="form-check-label" for="globalLockYes">Yes</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="globalunLock" id="globalunLockNo" value="no" <?php if($file_details[0]['global_lock'] == 0){ echo "checked"; } ?>>
        <label class="form-check-label" for="globalLockNo">No</label>
    </div>
</div>

<!-- Multi-select Dropdown for Customers -->
<div class="form-group">
    <label for="customers">Select Employees:</label>
    <select id="share_unlock_employees" class="form-control" name="share_unlock_employees[]" multiple>
        <?php $lock_employees = $file_details[0]['employee_ids'];
              if(!empty($lock_employees)){ $lock_employees = explode(',',$lock_employees); }else{ $lock_employees = array(); }
        if(!empty($employees)) { foreach($employees as $emp_l){ ?>
        <option value="<?php echo $emp_l['id']; ?>" <?php if (in_array($emp_l['id'], $lock_employees)) { echo "selected"; } ?>><?php echo $emp_l['name']; ?></option>
        <?php }} ?>
    </select>
</div>

<!-- Multi-select Dropdown for Employees -->
<div class="form-group">
    <label for="employees">Select Customers:</label>
    <select id="share_unlock_customers" class="form-control" name="share_unlock_customers[]" multiple>
    <?php $lock_customers = $file_details[0]['customer_ids'];
              if(!empty($lock_customers)){ $lock_customers = explode(',',$lock_customers); }else{ $lock_customers = array(); }
        if(!empty($customers)) { foreach($customers as $cust_l){ ?>
        <option value="<?php echo $cust_l->id; ?>" <?php if (in_array($cust_l->id, $lock_customers)) { echo "selected"; } ?>><?php echo $cust_l->name; ?></option>
        <?php }} ?>
    </select>
</div>
<input type="hidden" name="unlock_file_id" id="unlock_file_id" value="<?php echo $file_details[0]['entity_id']; ?>">