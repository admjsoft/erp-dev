</div>
</div>
</div>


<div class="modal fade" id="attendance_logout_check" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title"><?php echo "Logout"; ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 mb-2">
                    <h5>Kindly Check Your Attendance Status before Logout</h5>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <a href="<?= base_url() ?>/user/logout" class="btn btn-primary btn-lg btn-block"
                           type="submit"
                        ><i class="icon icon-arrow-circle-o-right"></i> <?php echo $this->lang->line('Yes') ?></a>
                    </div>
                    <div class="col-4">
                    <a href="#" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                        <i class="icon icon-arrow-circle-o-right"></i> <?php echo "Cancel"//$this->lang->line('Yes') ?></a>
                    </div>
                </div>

            </div>
            <!-- Modal Footer -->


        </div>
    </div>
</div>
<!-- BEGIN VENDOR JS-->
<script type="text/javascript">
    $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        format: '<?php echo $this->config->item('dformat2'); ?>'
    });
    $('[data-toggle="datepicker"]').datepicker('setDate', '<?php echo dateformat(date('Y-m-d')); ?>');

    $('#sdate').datepicker({
        autoHide: true,
        format: '<?php echo $this->config->item('dformat2'); ?>'
    });
    $('#sdate').datepicker('setDate', '<?php echo dateformat(date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))))); ?>');
    $('.date30').datepicker({
        autoHide: true,
        format: '<?php echo $this->config->item('dformat2'); ?>'
    });
    $('.date30').datepicker('setDate', '<?php echo dateformat(date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))))); ?>');

    $('.date30_plus').datepicker({
        autoHide: true,
        format: '<?php echo $this->config->item('dformat2'); ?>'
    });
    $('.date30_plus').datepicker('setDate', '<?php echo dateformat(date('Y-m-d', strtotime('+30 days', strtotime(date('Y-m-d'))))); ?>');
</script>
<script src="<?= assets_url() ?>app-assets/vendors/js/extensions/unslider-min.js"></script>
<script src="<?= assets_url() ?>app-assets/vendors/js/timeline/horizontal-timeline.js"></script>
<script src="<?= assets_url() ?>app-assets/js/core/app-menu.js"></script>
<script src="<?= assets_url() ?>app-assets/js/core/app.js"></script>
<script type="text/javascript" src="<?= assets_url() ?>app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
<script src="<?php echo assets_url(); ?>assets/myjs/jquery-ui.js"></script>
<script src="<?php echo assets_url(); ?>app-assets/vendors/js/tables/datatable/datatables.min.js"></script>

<script type="text/javascript">
    var dtformat = $('#hdata').attr('data-df');
    var currency = $('#hdata').attr('data-curr');
</script>
<script src="<?php echo assets_url('assets/myjs/custom.js') . APPVER; ?>"></script>
<script src="<?php echo assets_url('assets/myjs/basic.js') . APPVER; ?>"></script>
<script src="<?php echo assets_url('assets/myjs/control.js') . APPVER; ?>"></script>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMWSr2YSC6925JdAvbRyfjaiRsF8rPxA4&libraries=places"></script>
 -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
<script type="text/javascript">
    
    $.ajax({

        url: baseurl + 'manager/pendingtasks',
        dataType: 'json',
        success: function(data) {
            $('#tasklist').html(data.tasks);
            $('#taskcount').html(data.tcount);

        },
        error: function(data) {
            $('#response').html('Error')
        }

    });
</script>


</body>

</html>