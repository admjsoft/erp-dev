<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
.signature-component {
    text-align: left;
    display: inline-block;
    max-width: 100%;

    h1 {
        margin-bottom: 0;
    }

    h2 {
        margin: 0;
        font-size: 100%;
    }

    button {

        margin-top: .5em;

    }

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
</style>
<div>
    <div id="notify" class="alert alert-success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <div class="message"></div>
    </div>
    <div class="row">
        <div class="col-md-4 ">
            <div class="card card-block card-body">
                <h5><?php echo $this->lang->line('Update Profile Picture') ?></h5>
                <hr>
                <div class="ibox-content no-padding border-left-right">
                    <img alt="profile picture" id="dpic" class="img-responsive col"
                        src="<?php echo base_url('userfiles/employee/') . $user['picture'] ?>">
                </div>
                <hr>
                <p><label for="fileupload"><?php echo $this->lang->line('Change Your Picture') ?></label><input
                        id="fileupload" type="file" name="files[]"></p>
            </div>
            <!-- signature -->

            <div class="card card-block card-body">
                <h5><?php echo $this->lang->line('Update Your Signature') ?>
                    <span style="float: right;">
                        <button class="btn btn-primary btn-sm rounded" type="button" id="sign_changer">Draw Sign
                        </button>
                    </span>
                </h5>
                <hr>
                <div id="sign_image_block">
                    <div class="ibox-content no-padding border-left-right">
                        <img alt="sign_pic" id="sign_pic" class="img-responsive col col"
                            src="<?php echo base_url('userfiles/employee_sign/') . $user['sign'] ?>">
                    </div>
                    <hr>
                    <p>
                        <label
                            for="sign_fileupload"><?php echo $this->lang->line('Change Your Signature') ?></label><input
                            id="sign_fileupload" type="file" name="files[]">
                    </p>
                </div>

                <div id="sign_capture_block" style="max-width: 600px; margin: auto; display: none;">
                    <section class="signature-component">
                        <h1>Draw Signature</h1>
                        <h2>with mouse or touch</h2>

                        <canvas id="signature-pad" style="width: 100%;" height="200"></canvas>
                        <div>
                            <button class="btn btn-primary btn-sm rounded" type="button" id="save">Save</button>
                            <button class="btn btn-primary btn-sm rounded" type="button" id="clear">Clear</button>
                        </div>
                    </section>
                </div>
                <?php echo form_open_multipart('employee/user_signature_upload', array('id' => 'myThreadForm')); ?>
                <input type="hidden" id="signature_image" name="signature_image" value="">
                <input type="hidden" id="id" name="id" value="<?php echo $eid; ?>">
                </form>
            </div>




        </div>
        <div class="col-md-8">
            <div class="card card-block card-body">
                <form method="post" id="product_action" class="form-horizontal">
                    <div class="grid_3 grid_4">

                        <h5><?php echo $this->lang->line('Update Your Details') ?> (<?php echo $user['username'] ?>
                            )</h5>
                        <hr>


                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="name"><?php echo $this->lang->line('Name') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="Name" class="form-control margin-bottom  required"
                                    name="name" value="<?php echo $user['name'] ?>">
                            </div>
                        </div>


                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="address"><?php echo $this->lang->line('Address') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="address" class="form-control margin-bottom required"
                                    name="address" value="<?php echo $user['address'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="city"><?php echo $this->lang->line('City') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="city" class="form-control margin-bottom" name="city"
                                    value="<?php echo $user['city'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="country"><?php echo $this->lang->line('Country') ?></label>

                            <div class="col-sm-10">

                                <select name="country" class="form-control margin-bottom b_input required" id="country">
                                    <option value="">--Select Country--</option>
                                    <?php foreach($country as $cntry)
												 {
?> <option value="<?php echo $cntry->id;?>" <?php if($cntry->id==$user['country']){ echo"selected";}?>>
                                        <?php echo $cntry->country_name;?></option>
                                    <?php }
												 ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="postbox"><?php echo $this->lang->line('Postbox') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="Postbox" class="form-control margin-bottom"
                                    name="postbox" value="<?php echo $user['postbox'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="phone"><?php echo $this->lang->line('Phone') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="phone" class="form-control margin-bottom required"
                                    name="phone" value="<?php echo $user['phone'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label" for="phone"><?php echo $this->lang->line('Phone') ?>
                                (Alt)</label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="altphone" class="form-control margin-bottom"
                                    name="phonealt" value="<?php echo $user['phonealt'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="email"><?php echo $this->lang->line('Email') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="email" class="form-control margin-bottom" name="email"
                                    value="<?php echo $user['email'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Gender') ?>
                            </label>

                            <div class="col-sm-10">
                                <span class="role_error"></span>

                                <select name="gender" id="gender" class="form-control margin-bottom">
                                    <option value="">--Select Gender--</option>
                                    <option value="male" <?php if($user['gender'] == 'male'){ echo "selected"; } ?>>Male
                                    </option>
                                    <option value="female" <?php if($user['gender'] == 'female'){ echo "selected"; } ?>>
                                        FeMale</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="name"><?php echo $this->lang->line('Business Location') ?></label>

                            <div class="col-sm-10">
                                <select name="location" class="form-control margin-bottom">
                                    <option value="<?php echo $user['loc'] ?>">
                                        <?php echo $this->lang->line('Do not change') ?></option>
                                    <option value="0"><?php echo $this->lang->line('Default') ?></option>
                                    <?php $loc = locations();

                                    foreach ($loc as $row) {
                                        echo ' <option value="' . $row['id'] . '"> ' . $row['cname'] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php if ($this->aauth->get_user()->roleid >= 0) { ?>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="roleid"><?php echo $this->lang->line('UserRole') ?></label>

                            <div class="col-sm-10">
                                <select name="roleid" class="form-control margin-bottom required"
                                    <?php if ($user['roleid'] == 5) echo 'disabled' ?>>
                                    <option value="">--Select Role--</option>
                                    <?php foreach($role_list as $role)
						{
							?>
                                    <option value="<?php echo $role['id'];?>"
                                        <?php if($role['id']==$user['degis']){ echo"selected";}?> />
                                    <?php echo $role['role_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <?php } ?>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="name"><?php echo $this->lang->line('Department') ?></label>

                            <div class="col-sm-10">
                                <select name="department" class="form-control margin-bottom required">
                                    <option value="<?php echo $user['dept'] ?>">
                                        <?php echo $this->lang->line('Do not change') ?></option>
                                    <option value="0">
                                        <?php echo $this->lang->line('Default') . ' - ' . $this->lang->line('No') ?>
                                    </option>
                                    <?php

                                    foreach ($dept as $row) {
										?>
                                    <option value="<?php echo $row['id'] ;?>"
                                        <?php if($row['id']==$user['dept']){ echo"selected";}?> />
                                    <?php echo $row['val1'];?></option>

                                    <?php
									}
                                        
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="phone"><?php echo $this->lang->line('Salary') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="Salary" onkeypress="return isNumber(event)"
                                    class="form-control margin-bottom" name="salary"
                                    value="<?php echo amountFormat_general($user['salary']) ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Job Type') ?>
                            <span style="color:red">*</span></label>

                        <div class="col-sm-10">
                            <span class="role_error"></span>

                            <select name="employee_job_type" id="employee_job_type" class="form-control margin-bottom">
                                <option value="">--<?php echo $this->lang->line('Select Job Type'); ?>--</option>
                                <option value="Employee" <?php if($user['employee_job_type'] == 'Employee'){ echo "selected"; } ?>><?php echo $this->lang->line('Employee'); ?></option>
                                <option value="Intern" <?php if($user['employee_job_type'] == 'male'){ echo "Intern"; } ?>><?php echo $this->lang->line('Intern'); ?></option>
                                <option value="Freelancer" <?php if($user['employee_job_type'] == 'male'){ echo "Freelancer"; } ?>><?php echo $this->lang->line('Freelancer'); ?></option>

                            </select>
                        </div>
                    </div>
                    
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="name"><?php echo $this->lang->line('Joined Date') ?> </label>

                            <div class="col-sm-10">
                                <span class="joined_date_error"></span>

                                <input type="text" class="form-control margin-bottom b_input" placeholder="dd-mm-yy"
                                    name="joined_date" id="joined_date"
                                    value="<?php echo date('d-m-Y',strtotime($user['joindate'])); ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="phone"><?php echo $this->lang->line('Socso Number') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="Socso Number" class="form-control margin-bottom"
                                    name="socso_number" value="<?php echo $user['socso_number'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="phone"><?php echo $this->lang->line('KWSP Number') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="KWSP Number" class="form-control margin-bottom"
                                    name="kwsp_number" value="<?php echo $user['kwsp_number'] ?>">
                            </div>
                        </div>


                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="phone"><?php echo $this->lang->line('PCB Number') ?></label>

                            <div class="col-sm-10">
                                <input type="text" placeholder="PCB Number" class="form-control margin-bottom"
                                    name="pcb_number" value="<?php echo $user['pcb_number'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                for="city"><?php echo $this->lang->line('Commission') ?>%</label>

                            <div class="col-sm-10">
                                <input type="number" placeholder="Commission %" class="form-control margin-bottom"
                                    name="commission" value="<?php echo $user['c_rate'] ?>">
                                <label>It will based on each invoice amount - inclusive all
                                    taxes,shipping,discounts
                                </label>
                            </div>


                        </div>
                        <input type="hidden" name="eid" value="<?php echo $user['id'] ?>">


                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-4">
                                <input type="submit" id="profile_update" class="btn btn-success margin-bottom"
                                    value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#profile_update").click(function(e) {
    e.preventDefault();
    var actionurl = baseurl + 'employee/update';
    actionProduct(actionurl);
});
</script>
<script src="<?php echo base_url('assets/myjs/jquery.ui.widget.js') ?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url('assets/myjs/jquery.fileupload.js') ?>"></script>
<script>
$(document).ready(function() {


    $("#joined_date").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });

});
/*jslint unparam: true */
/*global window, $ */
$(function() {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo base_url() ?>employee/displaypic?id=<?php echo $user['id'] ?>';
    $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            formData: {
                '<?=$this->security->get_csrf_token_name()?>': crsf_hash
            },
            done: function(e, data) {
                //  var file=$("#fileupload").val();
                //console.log(fileupload);
                //console.log(file.name);
                //$('<p/>').text(file.name).appendTo('#files');

                $("#dpic").attr('src', '<?php echo base_url() ?>userfiles/employee/' + data.result +
                    '?' + new Date().getTime());
                location.reload();

            },
            progressall: function(e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    // Sign
    var sign_url = '<?php echo base_url() ?>employee/user_sign?id=<?php echo $user['id'] ?>';
    $('#sign_fileupload').fileupload({
            url: sign_url,
            dataType: 'json',
            formData: {
                '<?=$this->security->get_csrf_token_name()?>': crsf_hash
            },
            done: function(e, data) {

                //$('<p/>').text(file.name).appendTo('#files');
                $("#sign_pic").attr('src', '<?php echo base_url() ?>userfiles/employee_sign/' + data
                    .result + '?' + new Date().getTime());
                location.reload();


            },
            progressall: function(e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
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
var saveButton = document.getElementById('save'),
    clearButton = document.getElementById('clear'),
    showPointsToggle = document.getElementById('showPointsToggle');

saveButton.addEventListener('click', function(event) {
    var data = signaturePad.toDataURL('image/png');
    //window.open(data);
    $('#signature_image').val(data);
    $('#myThreadForm').submit();
});
clearButton.addEventListener('click', function(event) {
    signaturePad.clear();
});
showPointsToggle.addEventListener('click', function(event) {
    signaturePad.showPointsToggle();
    showPointsToggle.classList.toggle('toggle');
});
</script>

<script>
// $(document).ready(function () {
//     // By default, hide sign_capture_block
//     $('#sign_capture_block').hide();

//     // Toggle display on button click
//     $('#sign_changer').click(function () {
//         $('#sign_image_block').toggle();
//         $('#sign_capture_block').toggle();
//     });

//     var isImageBlockVisible = $('#sign_image_block').is(':visible');
//         var buttonText = isImageBlockVisible ? 'Upload Sign' : 'Draw Sign';
//         $('#sign_changer').text(buttonText);
// });
$(document).ready(function() {
    // By default, hide sign_capture_block
    $('#sign_capture_block').hide();

    // Variable to keep track of the current state
    var isImageBlockVisible = true;

    // Function to update the button text
    function updateButtonText() {
        var buttonText = isImageBlockVisible ? 'Draw Sign' : 'Upload Sign';
        $('#sign_changer').text(buttonText);
    }

    // Toggle display and update button text on button click
    $('#sign_changer').click(function() {
        $('#sign_image_block').toggle();
        $('#sign_capture_block').toggle();

        // Update the current state and button text
        isImageBlockVisible = !isImageBlockVisible;
        updateButtonText();
    });

    // Initial update of the button text
    updateButtonText();
});
</script>