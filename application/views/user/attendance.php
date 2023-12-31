<link rel="stylesheet" type="text/css"
      href="<?= assets_url() ?>app-assets/vendors/css/calendars/fullcalendar.min.css?v=<?= APPVER ?>">
<link href="<?php echo assets_url(); ?>assets/c_portcss/bootstrapValidator.min.css?v=<?= APPVER ?>" rel="stylesheet"/>
<link href="<?php echo assets_url(); ?>assets/c_portcss/bootstrap-colorpicker.min.css?v=<?= APPVER ?>"
      rel="stylesheet"/>
<!-- Custom css  -->
<link href="<?php echo assets_url(); ?>assets/c_portcss/custom.css?v=<?= APPVER ?>" rel="stylesheet"/>

<script src='<?php echo assets_url(); ?>assets/c_portjs/bootstrap-colorpicker.min.js?v=<?= APPVER ?>'></script>


<div class="content-body">
<div id="c_body"></div>
    <div class="card card-block">
        <div class="card-body">
            <!-- Notification -->
            <div class="alert"></div>

<form class="col-3">
                                    <div class="form-group d-flex justify-content-between">
                                        <label class="col-form-label pr-2">Language:</label>
                                        <div class="full-calender-languages">
                                            <select id='lang-selector' class="custom-select form-control"></select>
                                        </div>
                                    </div>
                                </form>
            <div id='adate' class="calendar"></div>
        </div>
    </div>
</div>

<script src="<?= assets_url() ?>app-assets/vendors/js/extensions/moment.min.js?v=<?= APPVER ?>"></script>
<script src="<?= assets_url() ?>app-assets/vendors/js/extensions/fullcalendar.min.js?v=<?= APPVER ?>"></script>
<script src='<?php echo assets_url(); ?>assets/c_portjs/main.js?v=<?= APPVER ?>'></script>
<script src="<?= assets_url() ?>app-assets/vendors/js/extensions/locale-all.js?v=<?= APPVER ?>"></script>