<style>
.signature-component {
    text-align: left;
    display: inline-block;
    max-width: 100%;

    .sign_text {
        display: flex;
        text-align: left;
    }

    h1 {
        margin-bottom: 0;
    }


    h2 {
        margin: 0;
        font-size: 100%;
    }

    /* button {
        padding: 1em;
        background: transparent;
        box-shadow: 2px 2px 4px #777;
        margin-top: .5em;
        border: 1px solid #777;
        font-size: 1rem;

        &.toggle {
            background: rgba(red, .2);
        }
    } */

    canvas {
        display: block;
        position: relative;
        border: 1px solid;
    }

    img {
        position: absolute;
        left: 0;
        top: 0;
    }

}

.image-row {
    border: 1px solid #ddd;
    /* Light border */
    padding: 10px;
    /* Add padding for spacing */
    margin-bottom: 15px;
    /* Add margin between form groups */
}

.image-container {
    display: flex;
    align-items: center;
}

.delete-icon-container {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    /* Align delete icon to the right */
}

.delete-icon {
    cursor: pointer;
    /* Add cursor pointer for interaction */
}
</style>
<article class="content-body">
    <?php if ($this->session->flashdata("messagePr")) { ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata("messagePr") ?>
    </div>
    <?php } ?>
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
                    <p><?php echo $thread_info['cname']; ?></strong></p>
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
            </div>
            <!-- <p><strong>Created on :</strong><br> <span>sdfsdfsd </span><p> -->
            <?php // echo '<strong>Created on</strong> ' .
                // dateformat_time($thread_info['created_at']);
                // echo '<br><strong>Customer</strong> ' . $thread_info['cname'];

                //  if($thread_info['cinvoice']==1){
                //     echo  '<br><span style="color:blue">';
                //     echo '<strong>'.$this->lang->line('Address').'</strong> ' . $thread_info['clocation'];
                //     echo '</span>';
                // }
                // echo '<br><strong>Status</strong> <span id="pstatus">';
                // $temp="";
                // if($thread_info['status']==1){
                //     $temp=$this->lang->line('Completed');
                // }elseif($thread_info['status']==2){
                //     $temp=$this->lang->line('Pending');
                // }
                // elseif($thread_info['status']==3){
                //     $temp=$this->lang->line('Unassigned');
                // }
                // elseif($thread_info['status']==4){
                //     //$temp=$this->lang->line('Unassigned');
                //     $temp = "WorkInProgress";
                // }
                // echo $temp; 
                // echo '</span>';
                // if(!empty($thread_info['assigned_employee_job_type'])){

                //     echo '<br><strong>Job Type</strong><br>'.$thread_info['assigned_employee_job_type'].'';
                // }
                // echo '<br><strong>Description</strong> <span id="pstatus_description">';
				
                //  echo $thread_info['job_description'];

                //  echo '<br><strong>Location</strong> <span id="clocation"></br>';
				
                //              echo $thread_info['clocation'];
							 
                            //  echo '<br><strong>Date</strong> <span id="cdate"></br>';
				
                            //  echo date('d-m-Y',strtotime($thread_info['cdate']));

							//    echo '<br><strong>Time</strong> <span id="ctime"></br>';
				
                            //  echo $thread_info['ctime'];

?></span></p>
            <hr style="border-top : 1px solid #4DD5E7; ">
            <?php
            if(!empty($doc) && is_array($doc)){ ?>
            <?php /* ?>
            <div class="form-group row">
                <div class="col">
                    <div class="card-bordered shadow p-1">
                        <?php
                            if ($doc['filename']) echo '<br><br><strong>Attachment: </strong><a href="' . base_url('userfiles/documents/' . $doc['filename']) . '" target="_blank">' . $doc['filename'] . '</a><br><br>';
                            ?></div>
                </div>
            </div>
            <?php */ ?>
            <div class="form-group row">
                <div class="col">
                    <div class="card-bordered shadow p-1">
                        <?php
                        if ($doc['filename']) {
                            $fileUrl = base_url('userfiles/documents/' . $doc['filename']);
                            $fileType = pathinfo($fileUrl, PATHINFO_EXTENSION);

                            echo '<br><br><strong>Attachment: </strong>';

                            if (in_array(strtolower($fileType), array('pdf', 'jpg', 'jpeg', 'png', 'gif'))) {
                                // If file type is PDF or image, open in a new tab
                                echo '<a href="' . $fileUrl . '" target="_blank">' . $doc['filename'] . '</a>';
                            } else {
                                // Other file types are downloadable
                                echo '<a href="' . $fileUrl . '" download>' . $doc['filename'] . '</a>';
                            }

                            echo '<br><br>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php } ?>

            <?php foreach ($thread_list as $row) { ?>
            <div class="form-group row">
                <div class="col">
                    <div class="card-bordered shadow p-1">
                        <?php
                            if ($row['admin']) echo 'Job manager <strong>' . $row['admin'] . '</strong> Replied<br><br>';
                           // if ($row['custo']) echo 'Customer <strong>' . $row['custo'] . '</strong> Replied<br><br>';
                            if ($row['emp']) echo 'Employee <strong>' . $row['emp'] . '</strong> Replied<br><br>';
                            if(!empty($row['message'])){ echo $row['message']; }
                            // if (!empty($row['message']) && !empty($row['attach'])){ echo "<br>"; }
                            if ($row['attach']) echo '<strong>Attachment: </strong><a target="_blank" href="' . base_url('userfiles/support/' . $row['attach']) . '">' . $row['attach'] . '</a><br>';
                            ?></div>
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
            <?php // echo form_open_multipart('jobsheets/mythread?id=' . $thread_info['id'], array('id' => 'myThreadForm')); ?>

            <?php if($thread_info['status'] != 1){ ?>
            <h5><strong><?php echo $this->lang->line('Your Response') ?></strong></h5>
            <hr style="border-top : 1px solid #4DD5E7; ">

            <div class="m-0 p-2" style="border : 1px solid #4DD5E7; ">

                <div class="form-group row">
                    <label class="col-sm-2 control-label"
                        for="edate"><Strong><?php echo $this->lang->line('Reply') ?></Strong></label>
                    <div class="col-sm-10">
                        <textarea class="summernote" placeholder=" Message" autocomplete="false" rows="5" name="content"
                            id="message_content"></textarea>
                    </div>
                </div>

                

                <div class="form-group row">

                    <label class="col-sm-2 control-label" for="todate"></label>

                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="captureAttachmentDetailsCheckbox">
                            <label class="form-check-label" for="captureImageDetailsCheckbox">Capture Attachment
                                Details</label>
                        </div>
                    </div>
                </div>




                <div class="form-group row" id="attachment_details_block" style="display:none;">
                    <label class="col-sm-2 col-form-label"
                        for="name"><Strong><?php echo $this->lang->line('Attachment') ?> </Strong></label>
                    <div class="col-sm-6">
                        <input type="file" name="userfile" size="20" id="userfile_attachment" /><br>
                        <small>(docx, docs, txt, pdf, xls, png, jpg, gif)</small>
                    </div>
                </div>
                <?php /*
                <!--Signature start-->
                <div class='form-group row onremarks' id='signatureParent'>
                    <label for='signature' class='col-sm-12 col-md-2 col-form-label col-form-label-lg'>Customer's
                        Signature</label>
                    <div class='col-sm-12 col-md-10'>
                        <div id="signature" name="signature"></div>
                    </div>
                </div>
                <!--Signature end-->

                <!-- (Start)Image Before After -->
                <div class='form-group row onremarks' id='option'>
                    <label for='taken' class='col-sm-2 col-form-label col-form-label-lg'>Required</label>
                    <div class='col-sm-10'>
                        <label for='taken' class='col-sm-6 col-form-label col-form-label-lg'>
                            <input type="radio" name="taken" value="1" checked/>&nbsp;
                            Before's Sanpshot
                        </label>&nbsp;
                        <label for='taken' class='col-sm-6 col-form-label col-form-label-lg'>
                            <input type="radio" name="taken" value="2"/>&nbsp;
                            After's Sanpshot
                        </label>
                    </div>
                </div>
                <!-- (End)Image Before After -->

                <!-- (START)picture -->
                <div class='form-group row onremarks' id='picture'>
                    <label for='pictures' class='col-sm-2 col-form-label col-form-label-lg'>Picture's</label>
                    <div class='col-sm-10'>
                        <a href="#" class="btn my-2 mx-2 btn-dark" data-toggle="modal" data-target="#imageCaptureModal">TAKE
                            SNAPSHOT</a>
                        <div class="row wrapper mt-4">
                        </div>
                    </div>
                </div>
                <!-- (END)picture -->

                <!-- Location -->
                <input id="latitude" type="text" name="latitude" hidden>
                <input id="longitude" type="text" name="longitude" hidden>
                <!-- location end -->
            */ ?>
                <!-- <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>

                <div class="col-sm-4">
                    <?php // if($thread_info['status'] != 1){ ?>
                    <input type="submit" id="document_add" class="btn btn-success margin-bottom"
                        value="<?php  // echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                    <?php  // } ?>
                </div>
            </div> -->
                <?php }?>

             

                <?php // if($thread_info['status'] == 1){ ?>

                <?php  if(!empty($thread_info['signature'])){ ?>



                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><Strong>Signature: </Strong></label>
                    <div class="col-sm-4">
                        <img id="imgTaken" style="border: 1px solid #ccc; padding: 5px;"
                            src="<?php echo $thread_info['signature']; ?>" alt="Signature Image" class="img-fluid">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><Strong>Signature Date: </Strong></label>
                    <div class="col-sm-8">
                        <label class="col-sm-12 col-form-label"><?php echo $thread_info['signature_date']; ?></label>
                    </div>
                </div>

                <?php }else{ ?>

                <div class="form-group row">

                    <label class="col-sm-2 control-label" for="todate"></label>

                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="captureSignatureDetailsCheckbox">
                            <label class="form-check-label" for="captureImageDetailsCheckbox">Capture Signature
                                Details</label>
                        </div>
                    </div>
                </div>


                <div class="form-group row" id="signature_details_block" style="display:none;">
                    <label class="col-sm-2 col-form-label" for="name"><Strong>Signature: </Strong></label>
                    <div class="col-sm-4">
                        <section class="signature-component">
                            <div class="sign_text">
                                <h5 class="mb-2 mr-1">Draw Signature</h5>
                                <span>(with mouse or touch) </span>
                            </div>
                            <canvas id="signature-pad" class="img-fluid" style="max-width: 100%;" width="400"
                                height="200"></canvas>
                            <div class="mt-2">
                                <!-- <button class="btn btn-sm btn-primary" type="button" id="save">Save</button> -->
                                <button class="btn btn-sm btn-primary" type="button" id="clear">Clear</button>
                            </div>
                        </section>
                    </div>
                </div>


                <?php } ?>



                <?php /* if(!empty($thread_info['signature'])){ ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Signature : </label>
                    <div class="col-sm-4">
                        <img id="imgTaken" src="<?php echo $thread_info['signature']; ?>" alt="Signature Image">


                    </div>
                </div>
                <?php } */ ?>

                <!-- </form> -->

                <?php  // if($thread_info['status'] == 1){ ?>
                <!-- <div class="form-group row">

                <label class="col-sm-2 control-label" for="from"><?php //echo $this->lang->line('Capture Image') ?> <span
                        style="color:red">*</span></label>

                <div class="col-sm-4">
                    <video id="video" width="400" height="320" autoplay></video>
                    <canvas id="canvas" width="400" height="320" style="display:none;"></canvas>
                    <img id="capturedImage" style="display:none;" class="mb-1">

                    <button class="btn btn-sm btn-info " id="captureButton">Capture Image</button>
                    <button class="btn btn-sm btn-info " id="cameraReverseButton" onclick="switchCamera()">Switch
                        Camera</button>
                    <button class="btn btn-sm btn-info " id="retakeButton" style="display:none;">Retake</button>

                </div>
            </div> -->

                <div class="form-group row">

                    <label class="col-sm-2 control-label" for="todate"></label>

                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="captureImageDetailsCheckbox">
                            <label class="form-check-label" for="captureImageDetailsCheckbox">Capture Image & Location
                                Details</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row" id="capture_img_details_block" style="display:none;">
                    <label class="col-sm-2 control-label"
                        for="from"><Strong><?php echo $this->lang->line('Capture Image') ?> <span
                                style="color:red">*</span></Strong></label>

                    <div class="col-sm-10">
                        <div class="row">
                            <!-- <div class="col-sm-6">
                            <div id="video_block" style="border: 1px solid #ccc; padding: 5px;">
                                <video id="video" style="width: 100%; height: auto;" autoplay></video>
                            </div>
                            <img id="capturedImage"
                                style="display:none; border: 1px solid #ccc; padding: 5px; width: 100%; height: auto;"
                                class="img-fluid">
                            <canvas id="canvas" width="400" height="320"
                                style="display:none; border: 1px solid #ccc; padding: 5px; width: 100%; height: auto;"></canvas>
                        </div> -->

                            <div class="col-sm-6" style="max-width: 400px;">
                                <div id="video_block" style="border: 1px solid #ccc; padding: 5px;">
                                    <video id="video" style="width: 100%; height: auto; display: block;"
                                        autoplay></video>
                                </div>
                                <img id="capturedImage"
                                    style="display:none; border: 1px solid #ccc; padding: 5px; width: 100%; height: auto; "
                                    class="img-fluid">
                                <canvas id="canvas" width="400" height="320"
                                    style="display:none; border: 1px solid #ccc; padding: 5px; width: 100%; height: auto;"></canvas>
                            </div>



                            <div class="col-sm-6">

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <button class="btn btn-sm btn-info" id="captureButton">Capture Image</button>
                                <button class="btn btn-sm btn-info" id="cameraReverseButton"
                                    onclick="switchCamera()">Switch
                                    Camera</button>
                                <button class="btn btn-sm btn-info" id="retakeButton"
                                    style="display:none;">Retake</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group row" id="capture_loc_details_block" style="display:none;">

                    <label class="col-sm-2 control-label"
                        for="todate"><Strong><?php echo $this->lang->line('Current Location') ?>
                            <span style="color:red">*</span></Strong></label>

                    <div class="col-sm-10">
                        <div class="input-group bootstrap-timepicker timepicker">
                            <p id="location" style="display:none;"></p>

                            <button class="btn btn-sm btn-info mt-2" id="getLocationButton" style="display:none;">Get
                                Location Details</button>
                        </div>
                    </div>
                </div>

                <div class="form-group row">

                    <!-- <label class="col-sm-2 control-label" for="todate"></label> -->

                    <div class="col-sm-12 text-center">
                        <?php if ($thread_info['status'] != 1) { ?>
                        <a href="#pop_model" data-toggle="modal" data-remote="false" class="btn  btn-cyan mb-1 "
                            title="Change Status">
                            <span class="icon-tab"></span>
                            <?php echo $this->lang->line('Change Status'); ?>
                        </a>
                        <?php } ?>
                    </div>
                    </div>

                <div class="form-group row">

                    <!-- <label class="col-sm-2 control-label" for="from"></label> -->

                    <div class="col-sm-12 text-center">
                        <button id="uploadButton" class="btn btn-primary">Update Details</button>

                    </div>
                </div>
                <?php // } ?>
            </div>
        </div>
    </div>
    </div>
</article>
<input type="hidden" id="signature_image" name="signature_image" value="">
<input type="hidden" id="c_job_id" value="<?php echo $thread_info['id']; ?>" />
<input type="hidden" id="latitudeInput" name="latitudeInput">
<input type="hidden" id="longitudeInput" name="longitudeInput">
<input type="hidden" id="locationDetailsInput" name="locationDetailsInput">
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
        } else {
            // Default action
            //$('#remarks_block').hide();
            $('#remarks_block').css('display', 'none');
        }

        // You can add more conditions and actions as needed
    });
});
</script>
<div id="pop_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color : #4DD5E7;">
                <h4 class="modal-title"><Strong><?php echo $this->lang->line('Change Status'); ?></Strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <?php // if($thread_info['status']==2 || $thread_info['status']==4){ ?>
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
                                        <?php echo  "Work In Porgress"; //$this->lang->line('Unassigned'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row"
                            style="<?php if($thread_info['status']==3){ echo 'display:block'; }else{ echo 'display:none'; } ?>"
                            id="remarks_block">
                            <div class="col-xs-12 mb-1">
                                <textarea name="remarks" id="remarks" cols="" rows="4"
                                    placeholder="Remarks"><?php echo $thread_info['remarks']; ?></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control required" name="jid" id="invoiceid"
                            value="<?php echo $thread_info['id'] ?>">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                        <input type="hidden" id="action-url" value="jobsheets/update_status">

                        <button type="button" class="btn btn-primary"
                            id="submit_model"><?php echo $this->lang->line('Change Status'); ?></button>
                    </div>
                </form>
            </div>
            <?php // } ?>
        </div>
    </div>
</div>
<!-- modal span shot start-->
<?php /*
<!-- (START)CAPTURE IMAGE FORM -->

<div class="modal fade" id="imageCaptureModal" tabindex="-1" role="dialog"
     aria-labelledby="imageCaptureModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Snapshot Screen <a href="#" class="button btn my-2 mx-2"
                                                           id="btnChangeCamera">
                        <span class="icon"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        <span>Switch camera</span>
                    </a></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small><i>NOTE: You can take multiple snapshot</i></small>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div id="screenshot" style="width:100%; ">
                            <video id="videoDiv" autoplay style="width:100%; "></video>
                            <img id="imgTaken" src="" hidden>
                            <input id="base64img" type="text" name="base64img" hidden>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg btn-block" type="button" name="button"
                                id="screenshot-button">Take Snapshot
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal span shot end-->

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
     //   document.getElementById("latitude").value = position.coords.latitude;
     //   document.getElementById("longitude").value = position.coords.longitude;
        console.log(position.coords.latitude + "/" + position.coords.longitude);
    }

    (function () {
        getLocation();
    })();
</script>

<script type="text/javascript">
    $(document).ready(function () {
        // get page elements
        const video = document.querySelector('#screenshot video');
        const screenshotButton = document.querySelector('#screenshot-button');
        const btnChangeCamera = document.querySelector("#btnChangeCamera");
        const img = document.querySelector('#screenshot img');
        const canvas = document.createElement('canvas');
        const devicesSelect = document.querySelector("#devicesSelect");

        // video constraints
        const constraints = {

            video: {width: {min: 100}, height: {min: 144}}
        };

        // use front face camera
        let useFrontCamera = true;

        // current video stream
        let stream = null;
        // switch camera

        screenshotButton.onclick = video.onclick = function () {
            //   document.getElementById("shutterEffect").play();
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            // Other browsers will fall back to image/png
            img.src = canvas.toDataURL('image/webp');
            console.log(canvas.toDataURL('image/webp'));
            document.getElementById("base64img").value = img.src;
            // allowed maximum input fields
            var max_input = 10;

            // initialize the counter for textbox
            var x = 1;
            if (x < max_input) { // validate the condition
                x++; // increment the counter
                $('.wrapper').append(`
				<div class="col-md-3">
					<div class="input-box col-sm-11">
					<img id="imgTaken" src="` + img.src + `" width="100%">
					<input type="hidden" name="image[]" class="form-control " value="` + img.src + `"/>
					</div>
					<a href="#" class="remove-lnk text-danger"><i class="fa fa-minus-circle"></i>Delete</a></div>
          `);
                // add input field
                //     $('#count').html("Quantity: "+x);
            }
        };


        function handleSuccess(stream) {
            screenshotButton.disabled = false;
            video.srcObject = stream;
        }

        btnChangeCamera.addEventListener("click", function () {
            useFrontCamera = !useFrontCamera;
            initializeCamera();
        });

        // stop video stream
        function stopVideoStream() {
            if (stream) {
                stream.getTracks().forEach((track) => {
                    track.stop();
                });
            }
        }

        // initialize
        async function initializeCamera() {
            stopVideoStream();
            constraints.video.facingMode = useFrontCamera ? "user" : "environment";

            try {
                stream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = stream;
            } catch (err) {
                alert("Could not access the camera");
            }
        }

        initializeCamera();

        // allowed maximum input fields

        var max_input = 20;

        // initialize the counter for textbox
        var x = 1;

        // handle click event of the remove link
        $('.wrapper').on("click", ".remove-lnk", function (e) {
            e.preventDefault();
            $(this).parent('.col-md-3').remove();  // remove input field
            x--; // decrement the counter
        });


    });
// signature pad start
    function updateTabClass(id) {
        if (id == 'update') {
            $('#signatureParent').resize();
        }
    }
    $(document).ready(function () {
        // Initialize jSignature
        var $sigdiv = $("#signature").jSignature({
            'UndoButton': true
        });

        $('#signature').change(function () {
            var data = $sigdiv.jSignature('getData', 'image');
            // Storing in textarea
            //$('#output').val(data);
            // Alter image source
            //  alert(data);
            $('#imageBase64').attr('value', "data:" + data);
            //   $('#sign_prev').show();
        });
    });
    // signature pad end
</script>
<script src="<?php echo assets_url('assets/myjs/jSignature.min.js') . APPVER; ?>"></script>
*/
?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script>
/*!
 * Modified
 * Signature Pad v1.5.3
 * https://github.com/szimek/signature_pad
 *
 * Copyright 2016 Szymon Nowak
 * Released under the MIT license
 */
var SignaturePad = (function(document) {
    "use strict";

    var log = console.log.bind(console);

    var SignaturePad = function(canvas, options) {
        var self = this,
            opts = options || {};

        this.velocityFilterWeight = opts.velocityFilterWeight || 0.7;
        this.minWidth = opts.minWidth || 0.5;
        this.maxWidth = opts.maxWidth || 2.5;
        this.dotSize = opts.dotSize || function() {
            return (self.minWidth + self.maxWidth) / 2;
        };
        this.penColor = opts.penColor || "black";
        this.backgroundColor = opts.backgroundColor || "rgba(0,0,0,0)";
        this.throttle = opts.throttle || 0;
        this.throttleOptions = {
            leading: true,
            trailing: true
        };
        this.minPointDistance = opts.minPointDistance || 0;
        this.onEnd = opts.onEnd;
        this.onBegin = opts.onBegin;

        this._canvas = canvas;
        this._ctx = canvas.getContext("2d");
        this._ctx.lineCap = 'round';
        this.clear();

        // we need add these inline so they are available to unbind while still having
        //  access to 'self' we could use _.bind but it's not worth adding a dependency
        this._handleMouseDown = function(event) {
            if (event.which === 1) {
                self._mouseButtonDown = true;
                self._strokeBegin(event);
            }
        };

        var _handleMouseMove = function(event) {
            event.preventDefault();
            if (self._mouseButtonDown) {
                self._strokeUpdate(event);
                if (self.arePointsDisplayed) {
                    var point = self._createPoint(event);
                    self._drawMark(point.x, point.y, 5);
                }
            }
        };

        this._handleMouseMove = _.throttle(_handleMouseMove, self.throttle, self.throttleOptions);
        //this._handleMouseMove = _handleMouseMove;

        this._handleMouseUp = function(event) {
            if (event.which === 1 && self._mouseButtonDown) {
                self._mouseButtonDown = false;
                self._strokeEnd(event);
            }
        };

        this._handleTouchStart = function(event) {
            if (event.targetTouches.length == 1) {
                var touch = event.changedTouches[0];
                self._strokeBegin(touch);
            }
        };

        var _handleTouchMove = function(event) {
            // Prevent scrolling.
            event.preventDefault();

            var touch = event.targetTouches[0];
            self._strokeUpdate(touch);
            if (self.arePointsDisplayed) {
                var point = self._createPoint(touch);
                self._drawMark(point.x, point.y, 5);
            }
        };
        this._handleTouchMove = _.throttle(_handleTouchMove, self.throttle, self.throttleOptions);
        //this._handleTouchMove = _handleTouchMove;

        this._handleTouchEnd = function(event) {
            var wasCanvasTouched = event.target === self._canvas;
            if (wasCanvasTouched) {
                event.preventDefault();
                self._strokeEnd(event);
            }
        };

        this._handleMouseEvents();
        this._handleTouchEvents();
    };

    SignaturePad.prototype.clear = function() {
        var ctx = this._ctx,
            canvas = this._canvas;

        ctx.fillStyle = this.backgroundColor;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        this._reset();
    };

    SignaturePad.prototype.showPointsToggle = function() {
        this.arePointsDisplayed = !this.arePointsDisplayed;
    };

    SignaturePad.prototype.toDataURL = function(imageType, quality) {
        var canvas = this._canvas;
        return canvas.toDataURL.apply(canvas, arguments);
    };

    SignaturePad.prototype.fromDataURL = function(dataUrl) {
        var self = this,
            image = new Image(),
            ratio = window.devicePixelRatio || 1,
            width = this._canvas.width / ratio,
            height = this._canvas.height / ratio;

        this._reset();
        image.src = dataUrl;
        image.onload = function() {
            self._ctx.drawImage(image, 0, 0, width, height);
        };
        this._isEmpty = false;
    };

    SignaturePad.prototype._strokeUpdate = function(event) {
        var point = this._createPoint(event);
        if (this._isPointToBeUsed(point)) {
            this._addPoint(point);
        }
    };

    var pointsSkippedFromBeingAdded = 0;
    SignaturePad.prototype._isPointToBeUsed = function(point) {
        // Simplifying, De-noise
        if (!this.minPointDistance)
            return true;

        var points = this.points;
        if (points && points.length) {
            var lastPoint = points[points.length - 1];
            if (point.distanceTo(lastPoint) < this.minPointDistance) {
                // log(++pointsSkippedFromBeingAdded);
                return false;
            }
        }
        return true;
    };

    SignaturePad.prototype._strokeBegin = function(event) {
        this._reset();
        this._strokeUpdate(event);
        if (typeof this.onBegin === 'function') {
            this.onBegin(event);
        }
    };

    SignaturePad.prototype._strokeDraw = function(point) {
        var ctx = this._ctx,
            dotSize = typeof(this.dotSize) === 'function' ? this.dotSize() : this.dotSize;

        ctx.beginPath();
        this._drawPoint(point.x, point.y, dotSize);
        ctx.closePath();
        ctx.fill();
    };

    SignaturePad.prototype._strokeEnd = function(event) {
        var canDrawCurve = this.points.length > 2,
            point = this.points[0];

        if (!canDrawCurve && point) {
            this._strokeDraw(point);
        }
        if (typeof this.onEnd === 'function') {
            this.onEnd(event);
        }
    };

    SignaturePad.prototype._handleMouseEvents = function() {
        this._mouseButtonDown = false;

        this._canvas.addEventListener("mousedown", this._handleMouseDown);
        this._canvas.addEventListener("mousemove", this._handleMouseMove);
        document.addEventListener("mouseup", this._handleMouseUp);
    };

    SignaturePad.prototype._handleTouchEvents = function() {
        // Pass touch events to canvas element on mobile IE11 and Edge.
        this._canvas.style.msTouchAction = 'none';
        this._canvas.style.touchAction = 'none';

        this._canvas.addEventListener("touchstart", this._handleTouchStart);
        this._canvas.addEventListener("touchmove", this._handleTouchMove);
        this._canvas.addEventListener("touchend", this._handleTouchEnd);
    };

    SignaturePad.prototype.on = function() {
        this._handleMouseEvents();
        this._handleTouchEvents();
    };

    SignaturePad.prototype.off = function() {
        this._canvas.removeEventListener("mousedown", this._handleMouseDown);
        this._canvas.removeEventListener("mousemove", this._handleMouseMove);
        document.removeEventListener("mouseup", this._handleMouseUp);

        this._canvas.removeEventListener("touchstart", this._handleTouchStart);
        this._canvas.removeEventListener("touchmove", this._handleTouchMove);
        this._canvas.removeEventListener("touchend", this._handleTouchEnd);
    };

    SignaturePad.prototype.isEmpty = function() {
        return this._isEmpty;
    };

    SignaturePad.prototype._reset = function() {
        this.points = [];
        this._lastVelocity = 0;
        this._lastWidth = (this.minWidth + this.maxWidth) / 2;
        this._isEmpty = true;
        this._ctx.fillStyle = this.penColor;
    };

    SignaturePad.prototype._createPoint = function(event) {
        var rect = this._canvas.getBoundingClientRect();
        return new Point(
            event.clientX - rect.left,
            event.clientY - rect.top
        );
    };

    SignaturePad.prototype._addPoint = function(point) {
        var points = this.points,
            c2, c3,
            curve, tmp;

        points.push(point);

        if (points.length > 2) {
            // To reduce the initial lag make it work with 3 points
            // by copying the first point to the beginning.
            if (points.length === 3) points.unshift(points[0]);

            tmp = this._calculateCurveControlPoints(points[0], points[1], points[2]);
            c2 = tmp.c2;
            tmp = this._calculateCurveControlPoints(points[1], points[2], points[3]);
            c3 = tmp.c1;
            curve = new Bezier(points[1], c2, c3, points[2]);
            this._addCurve(curve);

            // Remove the first element from the list,
            // so that we always have no more than 4 points in points array.
            points.shift();
        }
    };

    SignaturePad.prototype._calculateCurveControlPoints = function(s1, s2, s3) {
        var dx1 = s1.x - s2.x,
            dy1 = s1.y - s2.y,
            dx2 = s2.x - s3.x,
            dy2 = s2.y - s3.y,

            m1 = {
                x: (s1.x + s2.x) / 2.0,
                y: (s1.y + s2.y) / 2.0
            },
            m2 = {
                x: (s2.x + s3.x) / 2.0,
                y: (s2.y + s3.y) / 2.0
            },

            l1 = Math.sqrt(1.0 * dx1 * dx1 + dy1 * dy1),
            l2 = Math.sqrt(1.0 * dx2 * dx2 + dy2 * dy2),

            dxm = (m1.x - m2.x),
            dym = (m1.y - m2.y),

            k = l2 / (l1 + l2),
            cm = {
                x: m2.x + dxm * k,
                y: m2.y + dym * k
            },

            tx = s2.x - cm.x,
            ty = s2.y - cm.y;

        return {
            c1: new Point(m1.x + tx, m1.y + ty),
            c2: new Point(m2.x + tx, m2.y + ty)
        };
    };

    SignaturePad.prototype._addCurve = function(curve) {
        var startPoint = curve.startPoint,
            endPoint = curve.endPoint,
            velocity, newWidth;

        velocity = endPoint.velocityFrom(startPoint);
        velocity = this.velocityFilterWeight * velocity +
            (1 - this.velocityFilterWeight) * this._lastVelocity;

        newWidth = this._strokeWidth(velocity);
        this._drawCurve(curve, this._lastWidth, newWidth);

        this._lastVelocity = velocity;
        this._lastWidth = newWidth;
    };

    SignaturePad.prototype._drawPoint = function(x, y, size) {
        var ctx = this._ctx;

        ctx.moveTo(x, y);
        ctx.arc(x, y, size, 0, 2 * Math.PI, false);
        this._isEmpty = false;
    };

    SignaturePad.prototype._drawMark = function(x, y, size) {
        var ctx = this._ctx;

        ctx.save();
        ctx.moveTo(x, y);
        ctx.arc(x, y, size, 0, 2 * Math.PI, false);
        ctx.fillStyle = 'rgba(255, 0, 0, 0.2)';
        ctx.fill();
        ctx.restore();
    };

    SignaturePad.prototype._drawCurve = function(curve, startWidth, endWidth) {
        var ctx = this._ctx,
            widthDelta = endWidth - startWidth,
            drawSteps, width, i, t, tt, ttt, u, uu, uuu, x, y;

        drawSteps = Math.floor(curve.length());
        ctx.beginPath();
        for (i = 0; i < drawSteps; i++) {
            // Calculate the Bezier (x, y) coordinate for this step.
            t = i / drawSteps;
            tt = t * t;
            ttt = tt * t;
            u = 1 - t;
            uu = u * u;
            uuu = uu * u;

            x = uuu * curve.startPoint.x;
            x += 3 * uu * t * curve.control1.x;
            x += 3 * u * tt * curve.control2.x;
            x += ttt * curve.endPoint.x;

            y = uuu * curve.startPoint.y;
            y += 3 * uu * t * curve.control1.y;
            y += 3 * u * tt * curve.control2.y;
            y += ttt * curve.endPoint.y;

            width = startWidth + ttt * widthDelta;
            this._drawPoint(x, y, width);
        }
        ctx.closePath();
        ctx.fill();
    };

    SignaturePad.prototype._strokeWidth = function(velocity) {
        return Math.max(this.maxWidth / (velocity + 1), this.minWidth);
    };

    var Point = function(x, y, time) {
        this.x = x;
        this.y = y;
        this.time = time || new Date().getTime();
    };

    Point.prototype.velocityFrom = function(start) {
        return (this.time !== start.time) ? this.distanceTo(start) / (this.time - start.time) : 1;
    };

    Point.prototype.distanceTo = function(start) {
        return Math.sqrt(Math.pow(this.x - start.x, 2) + Math.pow(this.y - start.y, 2));
    };

    var Bezier = function(startPoint, control1, control2, endPoint) {
        this.startPoint = startPoint;
        this.control1 = control1;
        this.control2 = control2;
        this.endPoint = endPoint;
    };

    // Returns approximated length.
    Bezier.prototype.length = function() {
        var steps = 10,
            length = 0,
            i, t, cx, cy, px, py, xdiff, ydiff;

        for (i = 0; i <= steps; i++) {
            t = i / steps;
            cx = this._point(t, this.startPoint.x, this.control1.x, this.control2.x, this.endPoint.x);
            cy = this._point(t, this.startPoint.y, this.control1.y, this.control2.y, this.endPoint.y);
            if (i > 0) {
                xdiff = cx - px;
                ydiff = cy - py;
                length += Math.sqrt(xdiff * xdiff + ydiff * ydiff);
            }
            px = cx;
            py = cy;
        }
        return length;
    };

    Bezier.prototype._point = function(t, start, c1, c2, end) {
        return start * (1.0 - t) * (1.0 - t) * (1.0 - t) +
            3.0 * c1 * (1.0 - t) * (1.0 - t) * t +
            3.0 * c2 * (1.0 - t) * t * t +
            end * t * t * t;
    };

    return SignaturePad;
})(document);

var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)',
    velocityFilterWeight: .7,
    minWidth: 0.5,
    maxWidth: 2.5,
    throttle: 16, // max x milli seconds on event update, OBS! this introduces lag for event update
    minPointDistance: 3,
});
//var saveButton = document.getElementById('save');
var clearButton = document.getElementById('clear');
//var showPointsToggle = document.getElementById('showPointsToggle');

// saveButton.addEventListener('click', function(event) {
//     var data = signaturePad.toDataURL('image/png');
//     //window.open(data);
//     $('#signature_image').val(data);
//     //$('#myThreadForm').submit();
// });
clearButton.addEventListener('click', function(event) {
    signaturePad.clear();
});
// showPointsToggle.addEventListener('click', function(event) {
//     signaturePad.showPointsToggle();
//     showPointsToggle.classList.toggle('toggle');
// });
</script>
<!-- <script>
document.addEventListener('DOMContentLoaded', () => {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const capturedImage = document.getElementById('capturedImage');
    const captureButton = document.getElementById('captureButton');
    //const getLocationButton = document.getElementById('getLocationButton');
    const retakeButton = document.getElementById('retakeButton');
    const uploadButton = document.getElementById('uploadButton');
    const locationElement = document.getElementById('location');
    const cameraReverseButton = document.getElementById('cameraReverseButton');

    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((error) => {
            console.error('Error accessing camera:', error);
        });

    captureButton.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        capturedImage.src = canvas.toDataURL('image/png');

        // Hide the camera and capture button
        video.style.display = 'none';
        captureButton.style.display = 'none';

        // Show the captured image and buttons
        capturedImage.style.display = 'block';
        retakeButton.style.display = 'inline-block';
        //getLocationButton.style.display = 'inline-block';
        uploadButton.style.display = 'inline-block';
    });
    // Function to get and display the user's location details
    const getLocation = () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Use the Google Maps Geocoding API to get address details
                const apiKey =
                'AIzaSyAMWSr2YSC6925JdAvbRyfjaiRsF8rPxA4'; // Replace with your API key
                const geocodingUrl =
                    `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

                fetch(geocodingUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'OK' && data.results.length > 0) {
                            const address = data.results[0].formatted_address;
                            locationElement.textContent = `${address}`;
                            locationElement.style.display = 'block';

                            // Set the values of hidden input fields
                            latitudeInput.value = latitude;
                            longitudeInput.value = longitude;
                            locationDetailsInput.value = address;
                        } else {
                            console.error('Error fetching location details:', data.status);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching location details:', error);
                    });
            }, (error) => {
                console.error('Error getting location:', error);
            });
        } else {
            locationElement.textContent = 'Geolocation is not supported by your browser.';
        }
    };

    // Call getLocation when the page loads
    getLocation();


    retakeButton.addEventListener('click', () => {
        // Show the camera and capture button
        video.style.display = 'block';
        captureButton.style.display = 'inline-block';

        // Hide the captured image, buttons, and location
        capturedImage.style.display = 'none';
        retakeButton.style.display = 'none';
        //getLocationButton.style.display = 'none';
        uploadButton.style.display = 'none';
        locationElement.style.display = 'none';
    });

    uploadButton.addEventListener('click', () => {
        const imageData = capturedImage.src;
        var latitude_details = $('#latitudeInput').val();
        var longitude_details = $('#longitudeInput').val();
        var Location_details = $('#locationDetailsInput').val();
        var job_id = $('#c_job_id').val();
        const formData = new FormData();
        formData.append('image', imageData);
        formData.append('latitude_details', latitude_details);
        formData.append('longitude_details', longitude_details);
        formData.append('Location_details', Location_details);
        formData.append('job_id', job_id);

        var from_url = "<?php echo base_url('jobsheets/job_clock_in_details'); ?>";
        //alert(from_url);
        fetch(from_url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to the success page
                    // window.location.href = data.redirect_url;
                    location.reload();
                } else {
                    // Display validation errors
                    $('#validation_errors').html(data.validation_errors).show();
                }
            })
            .catch(error => {
                console.error('Error uploading image:', error);
            });
    });

});
</script> -->

<script>
let currentStream;
let currentCamera = 'environment';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const capturedImage = document.getElementById('capturedImage');
const captureButton = document.getElementById('captureButton');
const retakeButton = document.getElementById('retakeButton');
const uploadButton = document.getElementById('uploadButton');
const locationElement = document.getElementById('location');
const cameraReverseButton = document.getElementById('cameraReverseButton');

navigator.mediaDevices.getUserMedia({
        video: {
            facingMode: currentCamera
        }
    })
    .then((stream) => {
        currentStream = stream;
        video.srcObject = stream;
    })
    .catch((error) => {
        console.error('Error accessing camera:', error);
    });

captureButton.addEventListener('click', () => {
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    capturedImage.src = canvas.toDataURL('image/png');

    // Hide the camera and capture button
    video.style.display = 'none';
    captureButton.style.display = 'none';
    $('#video_block').hide();
    // Show the captured image and buttons
    capturedImage.style.display = 'block';
    retakeButton.style.display = 'inline-block';
    uploadButton.style.display = 'inline-block';
});

function switchCamera() {
    currentCamera = currentCamera === 'environment' ? 'user' : 'environment';
    stopCamera();
    startCamera();
}

function startCamera() {
    const constraints = {
        video: {
            facingMode: currentCamera
        }
    };

    navigator.mediaDevices.getUserMedia(constraints)
        .then((stream) => {
            currentStream = stream;
            video.srcObject = stream;
        })
        .catch((error) => {
            console.error('Error accessing camera:', error);
        });
}

function stopCamera() {
    if (currentStream) {
        const tracks = currentStream.getTracks();
        tracks.forEach(track => track.stop());
    }
}

retakeButton.addEventListener('click', () => {
    // Show the camera and capture button
    video.style.display = 'block';
    $('#video_block').show();
    captureButton.style.display = 'inline-block';

    // Hide the captured image, buttons, and location
    capturedImage.style.display = 'none';
    retakeButton.style.display = 'none';
    uploadButton.style.display = 'none';
    locationElement.style.display = 'none';
});

uploadButton.addEventListener('click', () => {

    if ($("#captureImageDetailsCheckbox").is(":checked")) {

        const imageData = capturedImage.src;
        var latitude_details = $('#latitudeInput').val();
        var longitude_details = $('#longitudeInput').val();
        var Location_details = $('#locationDetailsInput').val();
        var job_id = $('#c_job_id').val();

        if (latitude_details != '' && longitude_details != '' && Location_details != '') {

            if (imageData != '') {
                const formData = new FormData();
                formData.append('image', imageData);
                formData.append('latitude_details', latitude_details);
                formData.append('longitude_details', longitude_details);
                formData.append('Location_details', Location_details);
                formData.append('job_id', job_id);

                var from_url = "<?php echo base_url('jobsheets/job_clock_in_details'); ?>";
                //alert(from_url);
                fetch(from_url, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect to the success page
                            // window.location.href = data.redirect_url;
                            // location.reload();
                            var im_status = 1;
                            //alert('DO Captured Details Updated Successfully');
                            location.reload();
                            
                        } else {
                            // Display validation errors
                            // $('#validation_errors').html(data.validation_errors).show();
                            var im_status = 0;
                        }
                    })
                    .catch(error => {
                        console.error('Error uploading image:', error);
                    });
            } else {

                alert('Please Capture Photo');
                // getLocation();
            }

        } else {

            alert('Please allow location Details');
            $('#getLocationButton').show();
            // getLocation();
        }


    }else{
        var im_status = 1;
    }

    if ($("#captureAttachmentDetailsCheckbox").is(":checked")) {

        const attachmentInput = document.getElementById('userfile_attachment');
        const contentTextarea = document.getElementById('message_content');
        var job_id = $('#c_job_id').val();
        const formData = new FormData();
        formData.append('userfile', attachmentInput.files[0]);
        formData.append('content', contentTextarea.value);
        formData.append('job_id', job_id);
        
        // Add any additional data you need

        if (attachmentInput.files.length > 0 || contentTextarea.value.trim() !== '') {
            const from_url = "<?php echo base_url('jobsheets/conversation_attachment_upload'); ?>";

            fetch(from_url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to the success page
                        // window.location.href = data.redirect_url;
                        // location.reload();
                        var a_status = 1;
                        
                        alert('Attachment Details has been Updated');
                        location.reload();
                    } else {
                        // Display validation errors
                        var a_status = 0;
                        // $('#validation_errors').html(data.validation_errors).show();
                    }
                })
                .catch(error => {
                    console.error('Error uploading data:', error);
                });
        } else {
            alert('Please Select Attachment');
            // Handle validation or prompt the user
        }

    }else{
        var a_status = 1;
    }

    if ($("#captureSignatureDetailsCheckbox").is(":checked")) {

        // alert('dddddd');
        var data = signaturePad.toDataURL('image/png');
        // //window.open(data);
        $('#signature_image').val(data);

        var job_id = $('#c_job_id').val();
        var signature = $('#signature_image').val();
        // alert(signature_image);
        if (signature != '') {
            const formData = new FormData();
            formData.append('signature_image', signature);
            formData.append('job_id', job_id);

            var from_url = "<?php echo base_url('jobsheets/signature_upload'); ?>";
            //alert(from_url);
            fetch(from_url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to the success page
                        // window.location.href = data.redirect_url;
                        // location.reload();
                        var s_status = 1;
                        
                        alert('Signature Details has been Updated');
                        //location.reload();
                    } else {
                        // Display validation errors
                        var s_status = 0;
                        // $('#validation_errors').html(data.validation_errors).show();
                    }
                })
                .catch(error => {
                    console.error('Error uploading Signature:', error);
                });
        } else {

            alert('Please Draw Signature');
            // getLocation();
        }




    }else{
        var s_status = 1;
    }
 
        var mm_status = 1;
        //const attachmentInput = document.getElementById('userfile_attachment');
        const contentTextarea = document.getElementById('message_content');
        var job_id = $('#c_job_id').val();
        const formData = new FormData();
        //formData.append('userfile', attachmentInput.files[0]);
        formData.append('content', contentTextarea.value);
        formData.append('job_id', job_id);
                
        // Add any additional data you need

        if (contentTextarea.value.trim() != '') {
            // alert('holy');
            const from_url = "<?php echo base_url('jobsheets/conversation_attachment_upload'); ?>";

            fetch(from_url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to the success page
                        // window.location.href = data.redirect_url;
                        // location.reload();
                        var mm_status = 1;
                        alert('Conversation Details has been Updated');
                        //location.reload();
                    } else {
                        var mm_status = 0;
                        // Display validation errors
                        // $('#validation_errors').html(data.validation_errors).show();
                    }
                })
                .catch(error => {
                    console.error('Error uploading data:', error);
                });
        } else {
           // alert('Please Capture Photo, Select Attachment, or Enter Message');
            // Handle validation or prompt the user
            var mm_status = 1;
            // alert('fuck');
        }

        // alert(mm_status);

        // console.log(mm_status);
        // console.log(s_status);
        // console.log(a_status);
        // console.log(im_status);
        if(mm_status == 1 && s_status == 1 && a_status == 1 && im_status == 1)
        {
            location.reload();
        }
        

});

const getLocation = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Use the Google Maps Geocoding API to get address details
            const apiKey =
                'AIzaSyAMWSr2YSC6925JdAvbRyfjaiRsF8rPxA4'; // Replace with your API key
            const geocodingUrl =
                `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

            fetch(geocodingUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK' && data.results.length > 0) {

                        //console.log(data);
                        const address = data.results[1].formatted_address;
                        if (address == '') {
                            const address = data.results[0].formatted_address;
                        }
                        locationElement.textContent = `${address}`;
                        locationElement.style.display = 'block';

                        // Set the values of hidden input fields
                        latitudeInput.value = latitude;
                        longitudeInput.value = longitude;
                        locationDetailsInput.value = address;
                        $('#getLocationButton').hide();
                    } else {
                        console.error('Error fetching location details:', data.status);
                    }
                })
                .catch(error => {
                    console.error('Error fetching location details:', error);
                });
        }, (error) => {
            console.error('Error getting location:', error);
        });
    } else {
        locationElement.textContent = 'Geolocation is not supported by your browser.';
    }
};

// Call getLocation when the page loads
getLocation();

$('#getLocationButton').click(function() {
    getLocation();
});
</script>
<script>
$(document).ready(function() {
    $("#captureImageDetailsCheckbox").change(function() {
        if ($(this).is(":checked")) {
            $("#capture_img_details_block").show();
            $("#capture_loc_details_block").show();
        } else {
            $("#capture_img_details_block").hide();
            $("#capture_loc_details_block").hide();
        }
    });

    $("#captureAttachmentDetailsCheckbox").change(function() {
        if ($(this).is(":checked")) {
            $("#attachment_details_block").show();
        } else {
            $("#attachment_details_block").hide();
        }
    });

    $("#captureSignatureDetailsCheckbox").change(function() {
        if ($(this).is(":checked")) {
            $("#signature_details_block").show();
        } else {
            $("#signature_details_block").hide();
        }
    });


});
</script>