<article class="content-body">
    <div class="card card-block">
        <?php if ($response == 1) {
            echo '<div id="notify" class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' . $responsetext . '</div>
        </div>';
        } else if ($response == 0) {
            echo '<div id="notify" class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' . $responsetext . '</div>
        </div>';
        } else {
            echo ' <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>';
        } ?>

        <div class="card-body">
            <div class="clearfix p-1" style="background-color : #4DD5E7;">
                <h4 class="float-left "><strong><?php echo $thread_info['job_name']; ?></strong></h4>
                <!-- <a href="#pop_model" data-toggle="modal" data-remote="false"
                    class="btn btn-sm btn-cyan ml-2 float-right" title="Change Status">
                    <span class="icon-tab"></span>
                    <?php // echo $this->lang->line('Change Status'); ?>
                </a> -->
            </div>

            <?php if($thread_info['cinvoice']==1){ ?>
            <h5 style="color:red">
                <?php echo $this->lang->line('Invoice').' : '.$this->lang->line('Yes'); ?>
            </h5>
            <?php } ?>
            <p class="card card-block">

            <div class="row m-0 p-2" style="border : 1px solid #4DD5E7; ">
                <?php if(!empty($thread_info['job_unique_id'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Job Id</strong></h4>
                    <p><?php echo $thread_info['job_unique_id']; ?></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['created_at'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Created Date</strong></h4>
                    <p><?php echo dateformat_time($thread_info['created_at']); ?></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['cname'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Customer Name</strong></h4>
                    <p><?php echo $thread_info['cname']; ?></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['assigned_employee_name'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Assigned To</strong></h4>
                    <p><?php echo $thread_info['assigned_employee_name']; ?></p>
                </div>
                <?php } ?>



                <?php if(!empty($thread_info['clocation']) && $thread_info['cinvoice']==1) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4 style="color:blue;"><strong><?php echo $this->lang->line('Address'); ?></strong></h4>
                    <p style="color:blue;"><?php echo $thread_info['clocation']; ?></p>
                </div>
                <?php } ?>


                <?php if(!empty($thread_info['status'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Status</strong></h4>
                    <p><span id="pstatus">
                            <?php  $temp="";
                                    if($thread_info['status']==1){
                                        $temp=$this->lang->line('Completed');
                                    }elseif($thread_info['status']==2){
                                        $temp=$this->lang->line('Pending');
                                    }
                                    elseif($thread_info['status']==3){
                                        $temp=$this->lang->line('Unassigned');
                                    }
                                    elseif($thread_info['status']==4){
                                        //$temp=$this->lang->line('Unassigned');
                                        $temp = "Work In Progress";
                                    }elseif($thread_info['status']==5){
                                        //$temp=$this->lang->line('Unassigned');
                                        $temp = "Close";
                                    }
                                    echo $temp; 
                            ?></span></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['assigned_employee_job_type'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Job Type</strong></h4>
                    <p><?php echo $thread_info['assigned_employee_job_type']; ?></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['job_priority'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Job Priority</strong></h4>
                    <p><span id="pstatus_priority"><?php echo $thread_info['job_priority']; ?></span></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['vehicle_number'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Vehicle Number</strong></h4>
                    <p><span id="pvehicle_no"><?php echo $thread_info['vehicle_number']; ?></span></p>
                </div>
                <?php } ?>



                <?php if(!empty($thread_info['job_description'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Description</strong></h4>
                    <p><span id="pstatus_description"><?php echo $thread_info['job_description']; ?></span></p>
                </div>
                <?php } ?>


                <?php if(!empty($thread_info['clocation'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Location</strong></h4>
                    <p><span id="clocation"><?php echo $thread_info['clocation']; ?></span></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['cdate'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Assigned Date</strong></h4>
                    <p><span id="clocation"><?php echo date('d-m-Y',strtotime($thread_info['cdate'])); ?></span></p>
                </div>
                <?php } ?>

                <?php if(!empty($thread_info['ctime'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Assigned Time</strong></h4>
                    <p><span id="ctime"><?php echo $thread_info['ctime']; ?></span></p>
                </div>
                <?php } ?>



                <?php if(!empty($thread_info['remarks'])) { ?>
                <div class="col-md-4">
                    <!-- Content for the first column -->
                    <h4><strong>Remarks</strong></h4>
                    <p><span><?php echo $thread_info['remarks']; ?></span></p>
                </div>
                <?php } ?>
            </div>

            <?php 
                // <p><strong>Created on</strong>sdfsdfsd<p>
                //echo '<strong>Created on</strong> ' .
                // dateformat_time($thread_info['created_at']);

                
                // echo '<br><strong>Customer</strong> ' . $thread_info['cname'];

                // if(!empty($thread_info['assigned_employee_name'])){
                //     echo '<strong>Assigned To</strong>' . $thread_info['assigned_employee_name'];
                    
                // }

                //  if($thread_info['cinvoice']==1){
                //     echo  '<br><span style="color:blue">';
                //     echo '<strong>'.$this->lang->line('Address').'</strong><br>' . $thread_info['clocation'];
                //     echo '</span>';
                // }
                // echo '<strong>Status</strong> <span id="pstatus">';
                // $temp="";
                // if($thread_info['status']==1){
                //     $temp="Completed";
                // }elseif($thread_info['status']==2){
                //     $temp="Pending";
                // }
                // elseif($thread_info['status']==3){
                //     $temp="unassigned";
                // }
                // elseif($thread_info['status']==4){

                //     $temp = "WorkInProgress";
                // }
                // echo $temp;
                // echo '</span>';
                // if(!empty($thread_info['assigned_employee_job_type'])){

                //     echo '<strong>Job Type</strong>'.$thread_info['assigned_employee_job_type'].'';
                // }
                // echo '<strong>Description</strong> <span id="pstatus_description">';
				
                //  echo $thread_info['job_description'];

                //  echo '<br><strong>Location</strong> <span id="clocation"></br>';
				
                //              echo $thread_info['clocation'];
				// 			 echo '<br><strong>Date</strong> <span id="cdate"></br>';
				
                //              echo date('d-m-Y',strtotime($thread_info['cdate']));
				// 			   echo '<br><strong>Time</strong> <span id="ctime"></br>';
				
                //              echo $thread_info['ctime'];
                ?>
            <span>


            </span></p>
            <hr style="border-top : 1px solid #4DD5E7; ">
            <?php
            if(!empty($doc)&&is_array($doc)){ ?>
            <div class="form-group row">
                <div class="col">
                    <div class="card-bordered shadow p-1">
                        <?php
                            if ($doc['filename']) echo '<br><br><strong>Attachment: </strong><a href="' . base_url('userfiles/documents/' . $doc['filename']) . '" target="_blank">' . $doc['filename'] . '</a>';
                            ?></div>
                </div>
            </div>
            <?php } ?>
            <?php 
            
                // echo "<pre>"; print_r($thread_list); echo "</pre>";
                // exit;
            foreach ($thread_list as $row) { ?>
            <div class="form-group row">
                <div class="col">
                    <div class="card-bordered shadow p-1">
                        <?php
                        //     if ($row['admin']) echo 'Job manager <strong>' . $row['admin'] . '</strong> Replied<br><br>';
                        //    // if ($row['custo']) echo 'Customer <strong>' . $row['custo'] . '</strong> Replied<br><br>';
                        //     if ($row['emp']) echo 'Employee <strong>' . $row['emp'] . '</strong> Replied<br><br>';
                        //     echo $row['message'] . '';
                        //     if ($row['attach']) echo '<br><br><strong>Attachment: </strong><a href="' . base_url('userfiles/support/' . $row['attach']) . '">' . $row['attach'] . '</a><br><br>';
                         if ($row['admin']) echo 'Job manager <strong>' . $row['admin'] . '</strong> Replied<br><br>';
                        // if ($row['custo']) echo 'Customer <strong>' . $row['custo'] . '</strong> Replied<br><br>';
                         if ($row['emp']) echo 'Employee <strong>' . $row['emp'] . '</strong> Replied<br><br>';
                         if(!empty($row['message'])){ echo $row['message']; }
                        //  if (!empty($row['message']) && !empty($row['attach'])){ echo "<br>"; }
                         if ($row['attach']) echo '<strong>Attachment: </strong><a target="_blank" href="' . base_url('userfiles/support/' . $row['attach']) . '">' . $row['attach'] . '</a><br>';

                        ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if(!empty($job_images)) { ?>
            <h2>Document Images</h2>
            <?php foreach($job_images as $j_img) { ?>
            <div class="form-group" id="<?php echo $j_img['id']; ?>">
                <div class="card-bordered shadow p-1">
                    <div class="row ">
                        <div class="col-md-4 image-container">
                            <!-- Image Block -->
                            <a href="<?php echo base_url('userfiles/job_clock_in_photos/'.$j_img['job_clock_in_photo']); ?>"
                                target="_blank">
                                <img src="<?php echo base_url('userfiles/job_clock_in_photos/'.$j_img['job_clock_in_photo']); ?>"
                                    alt="Image" class="img-fluid"
                                    style="max-width: 100%; max-height: 150px; /* Adjust the max-height as needed */">
                            </a>
                        </div>

                        <div class="col-md-7">
                            <!-- Location Details Block -->
                            <div class="location-details">
                                <h3><?php echo $j_img['job_clock_in_location']; ?></h3>
                                <!-- Add more location details as needed -->
                            </div>
                        </div>

                        <div class="col-md-1 delete-icon-container">
                            <!-- Delete Icon Block with Font Awesome -->
                            <span class="delete-icon">
                                <a href="#" data-object-id="<?php echo $j_img['id']; ?>"
                                    class="btn btn-danger btn-sm delete-object" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>

            <?php  echo form_open_multipart('jobsheets/thread?id=' . $thread_info['id']); ?>
            <?php if($thread_info['status']!=1) { ?>
            <h5><strong><?php echo $this->lang->line('Your Response') ?></strong></h5>
            <hr style="border-top : 1px solid #4DD5E7; ">
            <div class="m-0 p-2" style="border : 1px solid #4DD5E7; ">

                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="edate"><Strong><?php echo $this->lang->line('Reply') ?></Strong></label>
                    <div class="col-sm-10">
                        <textarea class="summernote" placeholder=" Message" autocomplete="false" rows="5"
                            name="content"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name"><Strong><?php echo $this->lang->line('Attachment') ?> </Strong></label>
                    <div class="col-sm-6">
                        <!-- <input type="file" name="userfile" size="20" /><br> -->
                        <input type="file" name="userfile" id="userfile"
                            accept=".docx, .docs, .txt, .pdf, .xls, .xlsx, .png, .jpg, .jpeg, .gif" />

                        <small>(docx, docs, txt, pdf, xls, png, jpg, gif)</small>
                    </div>
                </div>
                <?php } ?>

               
                <?php if($thread_info['status']==1 && !empty($thread_info['signature'])){ ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><Strong>Signature : </Strong></label>
                    <div class="col-sm-4">
                        <img id="imgTaken" src="<?php echo $thread_info['signature']; ?>" alt="Signature Image">


                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><Strong>Signature Date: </Strong></label>
                    <div class="col-sm-8">
                        <label class="col-sm-12 col-form-label"><?php echo $thread_info['signature_date']; ?></label>


                    </div>
                </div>
                <?php } ?>

                <div class="form-group row">

                <!-- <label class="col-sm-2 control-label" for="todate"></label> -->

                <div class="col-sm-12 text-center">
                    <?php // if ($thread_info['status'] != 1) { ?>
                    <a href="#pop_model" data-toggle="modal" data-remote="false" class="btn  btn-cyan mb-1 "
                        title="Change Status">
                        <span class="icon-tab"></span>
                        <?php echo $this->lang->line('Change Status'); ?>
                    </a>
                    <?php // } ?>
                </div>
                </div>

                <?php if($thread_info['status']!=1) { ?>
                <div class="form-group row ">
                    <!-- <label class="col-sm-2 col-form-label"></label> -->
                    <div class="col-sm-12 text-center">
                        <input type="submit" id="document_add" class="btn btn-primary margin-bottom"
                            value="<?php echo $this->lang->line('Update Details') ?>" data-loading-text="Updating...">
                    </div>
                </div>
                <?php } ?>
            </div>
            </form>
        </div>
    </div>
</article>


<div id="pop_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color : #4DD5E7;">
                <h4 class="modal-title"><Strong><?php echo $this->lang->line('Change Status'); ?></Strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_model">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 mb-1"><label
                                    for="pmethod"><Strong><?php echo $this->lang->line('Mark As') ?></Strong></label>
                                <select id="job_task_status" name="status" class="form-control mb-1">
                                    <option value="">Please Select Status</option>
                                    <option value="1" <?php if($thread_info['status']==1){ echo "selected"; } ?>>
                                        <?php echo $this->lang->line('Completed'); ?></option>
                                    <option value="2" <?php if($thread_info['status']==2){ echo "selected"; } ?>>
                                        <?php echo $this->lang->line('Pending'); ?></option>
                                    <option value="3" <?php if($thread_info['status']==3){ echo "selected"; } ?>>
                                        <?php echo $this->lang->line('Unassigned'); ?></option>
                                    <option value="4" <?php if($thread_info['status']==4){ echo "selected"; } ?>>
                                        <?php echo "Work In Progress"; //$this->lang->line('Unassigned'); ?></option>
                                    <option value="5" <?php if($thread_info['status']==5){ echo "selected"; } ?>>
                                        <?php echo "Closed"; //$this->lang->line('Unassigned'); ?></option>
                                    <option value="6" <?php if($thread_info['status']==6){ echo "selected"; } ?>>
                                        <?php echo "Re-Open"; //$this->lang->line('Unassigned'); ?></option>
                                    <option value="7" <?php if($thread_info['status']==7){ echo "selected"; } ?>>
                                        <?php echo "Re-Assign"; //$this->lang->line('Unassigned'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row"
                            style="<?php if($thread_info['status']==3){ echo 'display:block'; }else{ echo 'display:none'; } ?>"
                            id="remarks_block">
                            <div class="col-md-12 mb-1">
                                <textarea name="remarks" class="form-control" id="remarks" cols="" rows="4"
                                    placeholder="Remarks"><?php echo $thread_info['remarks']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control required" name="jid" id="invoiceid"
                            value="<?php echo $thread_info['id'] ?>">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                        <input type="hidden" id="action-url" value="jobsheets/job_update_status">
                        <button type="button" class="btn btn-primary"
                            id="submit_model"><?php echo $this->lang->line('Change Status'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo form_open('jobsheets/assign');
 ?>
<div id="assign_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Assign') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('Employee') ?></p>
                <select name="employee" class="form-control employee emp-list">
                    <option>-- <?php echo $this->lang->line('Select Employee') ?> --</option>
                </select>
                <br />
                <p>Job type</p>
                <input type="text" class="form-control" name="jobtype" value=""
                    placeholder="Like:Task, Urgent, Imidate or etc." />
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" class="jobid" name="jobid" value="">
                <input type="submit" class="btn btn-primary" value="<?php  echo $this->lang->line('Assign') ?>" />
                <button type="button" data-dismiss="modal"
                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
</form>
<input type="hidden" class="form-control required" name="job_id" id="job_id" value="<?php echo $thread_info['id']; ?>">

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Delete Document Image') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('Delete Document Image') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="jobsheets/delete_document_image">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                    id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $('.summernote').summernote({
        height: 250,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['fullscreen', ['fullscreen']],
            ['codeview', ['codeview']]
        ]
    });
});

$(document).ready(function() {
    $('#job_task_status').on('change', function() {
        // Get the selected value
        var selectedValue = $(this).val();
        //alert(selectedValue);
        // Perform the desired action based on the selected value
        if (selectedValue == 3) {
            // Action for value1
            //$('#remarks_block').show();
            $('#remarks_block').css('display', 'block');
        } else if (selectedValue == 7) {
            $('#pop_model').modal('hide');
            $('#assign_model').modal('show');
        } else {
            // Default action
            //$('#remarks_block').hide();
            $('#remarks_block').css('display', 'none');
        }

        // You can add more conditions and actions as needed
    });

    var job_id = "<?php echo $thread_info['id']; ?>";
    $.ajax({

        url: "<?php echo site_url('jobsheets/get_job_employee_list') ?>",
        type: 'POST',
        data: {
            job_id: job_id
        },
        success: function(data) {
            $('.emp-list').append(data);
        },
        error: function(data) {
            //console.log(data);
            console.log("Error not get emp list")
        }

    });
});
</script>