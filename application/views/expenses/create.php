<div class="content-body">
<div id="c_body"></div>
    <style>
        form .form-group {
        margin-bottom: 0rem !important;
} </style>
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
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">
                <form method="post" id="data_form" enctype="multipart/form-data" action="<?php echo base_url("expenses/save_expenses") ?>" >
                    <?php if ($this->aauth->premission(22)) { ?>
                        <div class="row mb-1 ml-1">
                            <label for="cst" class="col-md-2"><?php echo $this->lang->line('Search Employee') ?></label>
                                <div class="col-md-6"><input type="text" class="form-control" name="cst" id="expenses-box"
                                                        placeholder="Enter Person Name or Mobile Number to search (Optional)"
                                                        autocomplete="off"/>
                                <div id="expenses-box-result" class="sbox-result"></div>
                            </div>

                        </div>
                    <hr>
                    <?php } ?>
                    <div id="employeepanel" class="form-group row bg-lighten-4">
                        <?php if ($this->aauth->premission(22)) { ?>
                        <div class="col-sm-4">
                            <label for="employee_name" class="caption col-form-label"><?php echo $this->lang->line('Employee') ?>
                                <span style="color: red;">*</span></label>
                                <input type="hidden" name="emp_id" id="employee_id" value="0">
                            <input type="text" class="form-control required" name="emp_name" id="employee_name" required>
                        </div>
                        <?php } else { ?>
                        <div class="col-sm-4">
                            <label for="employee_name" class="caption col-form-label"><?php echo $this->lang->line('Employee') ?>
                                <span style="color: red;">*</span></label>
                                <input type="hidden" name="emp_id" id="employee_id" value="<?php echo $this->session->userdata('id'); ?>">
                            <input type="text" class="form-control required" required name="emp_name" id="employee_name"  value="<?php echo $this->session->userdata('login_name'); ?>">
                        </div>
                        <?php } ?>
                        <div class="col-sm-4"><label for="title"
                                                     class="caption col-form-label"><?php echo $this->lang->line('Title') ?>
                                <span
                                        style="color: red;">*</span></label>
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
                            <input type="text" class="form-control required"
                                   name="receipt_no" id="receipt_no" autocomplete="false">
                        </div>
                        <div class="col-sm-4"><label class="col-form-label"
                                                     for="receipt_date"><?php echo $this->lang->line('Receipt Date') ?></label>
                            <input type="date" class="form-control required"
                                   name="receipt_date"
                                   autocomplete="false" id="receipt_date" required>
                        </div>
                    </div>
                    <div id="employeepanel" class="form-group row bg-lighten-4">

                        <div class="col-sm-4"><label class="col-form-label"
                                                     for="receipt_amount"><?php echo $this->lang->line('Receipt Amount') ?></label>
                            <input type="text" placeholder="Receipt Amount"
                                   class="form-control margin-bottom  required" name="receipt_amount" id="receipt_amount" value="0"
                                   onkeypress="return isNumber(event)" required>
                        </div>
                        <div class="col-sm-4"><label class="col-form-label"
                                                     for="tax_amount"><?php echo $this->lang->line('Tax Amount') ?></label>
                            <input type="text" placeholder="Tax Amount"
                                   class="form-control margin-bottom  required" name="tax_amount" id="tax_amount" value="0"
                                   onkeypress="return isNumber(event)" required>
                        </div>
                    </div>
                    <div id="employeepanel" class="form-group row bg-lighten-4">

                        <div class="col-sm-8"><label
                                    class="col-form-label" for="reason"><?php echo $this->lang->line('Reason') ?></label>
                            <input type="text" placeholder="Reason"
                                   class="form-control" name="reason" id="reason" required>
                        </div>
                        <?php if ($this->aauth->premission(22)) { ?>
                            <div class="col-sm-8"><label
                                        class="col-form-label" for="remarks"><?php echo $this->lang->line('Remarks') ?></label>
                                <input type="text" placeholder="Remarks"
                                    class="form-control" name="remarks" id="remarks">
                            </div>
                        <?php } else{ ?>
                                <input type="text" placeholder="Remarks"
                                    class="form-control" name="remarks" id="remarks" hidden>
                        <?php } ?>
                        <div class="col-sm-8"><label
                                    class="col-form-label" for="doc"><?php echo $this->lang->line('Supporting Document') ?></label>
                            <input type="file" placeholder="Documents"
                                   class="form-control" name="doc" id="doc" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2" >
                        <div class="col-sm-4">
                               <input type="submit" class="btn btn-success btn-lg margin-bottom"
                                   value="<?php echo $this->lang->line('Add Expenses') ?>"
                                   data-loading-text="Adding...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <?php if ($this->aauth->premission(22)) { ?>
        <script type="text/javascript">

            $("#expenses-box").keyup(function () {
                $.ajax({
                    type: "GET",
                    url: baseurl + 'expenses/employee_search',
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function () {
                        $("#expenses-box").css("background", "#FFF url(" + baseurl + "assets/custom/load-ring.gif) no-repeat 165px");
                    },
                    success: function (data) {
                        $("#expenses-box-result").show();
                        $("#expenses-box-result").html(data);
                        $("#expenses-box").css("background", "none");

                    }
                });
            });
        </script>
        <?php } ?>
