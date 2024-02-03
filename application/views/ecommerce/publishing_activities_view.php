<p class="mb-2 fw-bold"><?php echo $this->lang->line('Changes made:'); ?></p>
<div class="table-responsive">
            <!-- Table-->
            <table class="table alert-table">
              <thead>
                <tr class="text-start">
                  <th class="w-auto"><?php echo $this->lang->line('S.No'); ?></th>
                  <th><?php echo $this->lang->line('Section'); ?></th>
                  <th><?php echo $this->lang->line('Previous Value'); ?></th>
                  <th><?php echo $this->lang->line('New Value'); ?></th>
                  <th><?php echo $this->lang->line('Status'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(!empty($user_publishing_activities)) {
                    $i=1;
                    foreach($user_publishing_activities as $p_activity) {
                ?>
                <tr class=" clickable text-center">
                  <td><?php echo $i; ?>.</td>
                  <td><?php echo $p_activity['VendorName']; ?></td>
                  <td><?php echo $p_activity['PreviousValue']; ?></td>
                  <td><?php echo $p_activity['NewValue']; ?></td>
                  <td><?php echo $p_activity['ActionType']; ?></td>
                </tr>
              <?php $i++; } } ?>
               
              </tbody>
            </table>
          </div>

           <!-- <div class="text">
            <p class="mb-1">Admin Password</p>
            <input type="password" class="form-control rounded w-50" name="password" placeholder="" required>
          </div> -->