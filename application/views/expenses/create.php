<div class="content-body">
    <div id="c_body"></div>
    <style>
    form .form-group {
        margin-bottom: 0rem !important;
    }
    </style>
    <div class="card">
        <div class="card-header">
            <h4><?php echo $this->lang->line('Add Claims') ?></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="card-content">
            <div class="row mr-2">

                <div class="col-12 text-right mr-">
                    <!-- Small Button -->
                    <a href="<?php echo base_url('expenses'); ?>"> <button type="button"
                            class="btn btn-sm btn-primary"><?php echo $this->lang->line('List'); ?> </button></a>
                </div>
            </div>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">
                <form method="post" id="data_form" enctype="multipart/form-data"
                    action="<?php echo base_url("expenses/save_expenses") ?>">

                    <div id="employeepanel" class="form-group row bg-lighten-4">
                        <div class="col-sm-4">
                            <label for="employee_name"
                                class="caption col-form-label"><?php echo $this->lang->line('Employee') ?>
                                <span style="color: red;">*</span></label>
                            <?php
                                      $this->db->select('*');
        $this->db->from('gtg_employees');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result= $query->result_array();
                              if(($this->aauth->get_user()->roleid==5) || ($this->aauth->get_user()->roleid==4))  
                              {
                                ?>
                            <select class="form-control required" name="emp_name" id="employee_name" required>

                                <?php 
                                foreach($result as $res)
                                {
                                    
                                ?>
                                <option value="<?php echo $res['id'];?>-<?php echo $res['name'];?>">
                                    <?php echo $res['name'];?></option>
                                <?php
                                }?>
                            </select>
                            <?php
                              }
                              else{
                      $this->db->select('*');
        $this->db->from('gtg_employees');
                $this->db->where('gtg_employees.id',$this->session->userdata('id'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result1= $query->result_array();
          foreach($result1 as $res)
                                {
                              ?> <select class="form-control required" name="emp_name" id="employee_name" required>

                                <option value="<?php echo $res['id'];?>-<?php echo $res['name'];?>">
                                    <?php echo $res['name'];?></option>
                            </select>
                            <?php
                                
                          
                                }
                          }?>
                        </div>

                        <div class="col-sm-4"><label for="title"
                                class="caption col-form-label"><?php echo $this->lang->line('Title') ?>
                                <span style="color: red;">*</span></label>
                            <input type="text" class="form-control required" name="title" id="title" required>
                        </div>
                    </div>
                    <div id="employeepanel" class="form-group row bg-lighten-4">
                        <div class="col-sm-4"><label class="col-form-label"
                                for="f_pay_cat"><?php echo $this->lang->line('From') . ' ' . $this->lang->line('Category') ?></label>
                            <select name="category" class="form-control">
                                <?php
                                foreach ($cat as $row) {
                                    $cid = $row['id'];
                                    $title = $row['name'];
                                    echo "<option value='$title'>$title</option>";
                                }
                                ?>
                            </select>


                        </div>

                    </div>
                    <div id="employeepanel" class="form-group row bg-lighten-4">
                        <div class="col-sm-4"><label class="col-form-label"
                                for="receipt_no"><?php echo $this->lang->line('Receipt No') ?></label>
                            <input type="text" class="form-control required" name="receipt_no" id="receipt_no"
                                autocomplete="false">
                        </div>
                        <div class="col-sm-4"><label class="col-form-label"
                                for="receipt_date"><?php echo $this->lang->line('Receipt Date') ?></label>
                            <input type="date" class="form-control required" name="receipt_date" autocomplete="false"
                                id="receipt_date" required>
                        </div>
                    </div>
                    <div id="employeepanel" class="form-group row bg-lighten-4">

                        <div class="col-sm-4"><label class="col-form-label"
                                for="receipt_amount"><?php echo $this->lang->line('Receipt Amount') ?></label>
                            <input type="text" placeholder="Receipt Amount" class="form-control margin-bottom  required"
                                name="receipt_amount" id="receipt_amount" value="0" onkeypress="return isNumber(event)"
                                required>
                        </div>
                        <div class="col-sm-4"><label class="col-form-label"
                                for="tax_amount"><?php echo $this->lang->line('Tax Amount') ?></label>
                            <input type="text" placeholder="Tax Amount" class="form-control margin-bottom  required"
                                name="tax_amount" id="tax_amount" value="0" onkeypress="return isNumber(event)"
                                required>
                        </div>
                    </div>
                    <div id="employeepanel" class="form-group row bg-lighten-4">

                        <div class="col-sm-8"><label class="col-form-label"
                                for="reason"><?php echo $this->lang->line('Reason') ?></label>
                            <input type="text" placeholder="Reason" class="form-control" name="reason" id="reason"
                                required>
                        </div>
                        <?php if ($this->aauth->premission(22)) { ?>
                        <div class="col-sm-8"><label class="col-form-label"
                                for="remarks"><?php echo $this->lang->line('Remarks') ?></label>
                            <input type="text" placeholder="Remarks" class="form-control" name="remarks" id="remarks">
                        </div>
                        <?php } else{ ?>
                        <input type="text" placeholder="Remarks" class="form-control" name="remarks" id="remarks"
                            hidden>
                        <?php } ?>
                        <div class="col-sm-8"><label class="col-form-label"
                                for="doc"><?php echo $this->lang->line('Supporting Document') ?></label>
                            <input type="file" placeholder="Documents" class="form-control" name="doc" id="doc"
                                required>
                            (<?php echo $this->lang->line('only pdf files'); ?>)
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-sm-4">
                            <input type="submit" class="btn btn-success btn-lg margin-bottom" value="Add Claims"
                                data-loading-text="Adding...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php if ($this->aauth->premission(22)) { ?>
        <script type="text/javascript">
        $("#expenses-box").keyup(function() {
            $.ajax({
                type: "GET",
                url: baseurl + 'expenses/employee_search',
                data: 'keyword=' + $(this).val(),
                beforeSend: function() {
                    $("#expenses-box").css("background", "#FFF url(" + baseurl +
                        "assets/custom/load-ring.gif) no-repeat 165px");
                },
                success: function(data) {
                    $("#expenses-box-result").show();
                    $("#expenses-box-result").html(data);
                    $("#expenses-box").css("background", "none");

                }
            });
        });
        </script>
        <?php } ?>