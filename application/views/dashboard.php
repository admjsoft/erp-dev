<script type="text/javascript">
var dataVisits = [
    <?php $tt_inc = 0;foreach ($incomechart as $row) {
        $tt_inc += $row['total'];
        echo "{ x: '" . $row['date'] . "', y: " . intval(amountExchange_s($row['total'], 0, $this->aauth->get_user()->loc)) . "},";
    }
        ?>
];
var dataVisits2 = [
    <?php $tt_exp = 0; foreach ($expensechart as $row) {
        $tt_exp += $row['total'];
        echo "{ x: '" . $row['date'] . "', y: " . intval(amountExchange_s($row['total'], 0, $this->aauth->get_user()->loc)) . "},";
    }
        ?>
];
</script>
<style>
.bg-gradient-x-primary1 {
    background-image: linear-gradient(to right, #c2185b 0%, #4DCBCD 100%) !important;
}
</style>
<style>
.dashb_pr_wrapper {
    text-transform: uppercase;
    position: relative;
}

.dashb_pr_wrapper .dashb_pr_tooltip {
    background: #1496bb;
    bottom: 100%;
    color: #fff;
    display: block;
    left: -20px;
    margin-bottom: 15px;
    opacity: 0;
    padding: 20px;
    pointer-events: none;
    position: absolute;
    width: 100%;
    -webkit-transform: translateY(10px);
    -moz-transform: translateY(10px);
    -ms-transform: translateY(10px);
    -o-transform: translateY(10px);
    transform: translateY(10px);
    -webkit-transition: all .25s ease-out;
    -moz-transition: all .25s ease-out;
    -ms-transition: all .25s ease-out;
    -o-transition: all .25s ease-out;
    transition: all .25s ease-out;
    -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the dashb_pr_tooltip without it disappearing */
.dashb_pr_wrapper .dashb_pr_tooltip:before {
    bottom: -20px;
    content: " ";
    display: block;
    height: 20px;
    left: 0;
    position: absolute;
    width: 100%;
}

/* CSS Triangles - see Trevor's post */
.dashb_pr_wrapper .dashb_pr_tooltip:after {
    border-left: solid transparent 10px;
    border-right: solid transparent 10px;
    border-top: solid #1496bb 10px;
    bottom: -10px;
    content: " ";
    height: 0;
    left: 50%;
    margin-left: -13px;
    position: absolute;
    width: 0;
}

.dashb_pr_wrapper:hover .dashb_pr_tooltip {
    opacity: 1;
    pointer-events: auto;
    -webkit-transform: translateY(0px);
    -moz-transform: translateY(0px);
    -ms-transform: translateY(0px);
    -o-transform: translateY(0px);
    transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .dashb_pr_wrapper .dashb_pr_tooltip {
    display: none;
}

.lte8 .dashb_pr_wrapper:hover .dashb_pr_tooltip {
    display: block;
}
</style>
<?php if(ENVIRONMENT == 'development') { ?>
<div class="alert alert-primary alert-danger" style="">
    <a href="#" class="close" data-dismiss="alert">×</a>
    <div class="message"><strong>Alert</strong>: Application is running in Development/Debug mode! Set it production
        mode <a href="<?=base_url('settings/debug') ?>">here</a></div>
</div>
<?php } ?>

<?php if ($this->session->flashdata("messagePr")) { ?>
<div class="alert alert-success">
    <?php echo $this->session->flashdata("messagePr") ?>
</div>
<?php } ?>

<?php if ($this->session->flashdata("messageEr")) { ?>
<div class="alert alert-danger">
    <?php echo $this->session->flashdata("messageEr") ?>
</div>
<?php } ?>

<input type="hidden" id="dashurl" value="tickets/ticket_stats">
<input type="hidden" id="pdashurl" value="projects/projects_stats">
<input type="hidden" id="att_map_url" value="employee/employee_clock_in_locations">
<?php if ($this->aauth->premission(229) && $this->aauth->personalized_premission(229) == 0)
{
?>
<h3><?php echo $this->lang->line('Sales') ?></h3>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                        <i class="fa fa-file-text-o text-bold-200  font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-primary white media-body">
                        <a href="<?php echo base_url("invoices/invoice_today") ?>" style="color:#fff">

                            <h5><?php echo $this->lang->line('today_invoices') ?></h5>
                            <h5 class="text-bold-400 mb-0"><i class="ft-plus"></i> <?= $todayin ?></h5>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-danger bg-darken-2">
                        <i class="icon-notebook font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-danger white media-body">
                        <a href="<?php echo base_url("invoices/invoice_month") ?>" style="color:#fff">

                            <h5><?= $this->lang->line('this_month_invoices') ?></h5>
                            <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i><?= $monthin ?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-warning bg-darken-2">
                        <i class="icon-basket-loaded font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-warning white media-body">
                        <a href="<?php echo base_url("invoices/invoice_today") ?>" style="color:#fff">
                            <h5><?= $this->lang->line('today_sales') ?></h5>
                            <h5 class="text-bold-400 mb-0"><i
                                    class="ft-arrow-up"></i><?= amountExchange($todaysales, 0, $this->aauth->get_user()->loc) ?>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                        <i class="icon-wallet font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-success white media-body">
                        <a href="<?php echo base_url("invoices/invoice_month") ?>" style="color:#fff">
                            <h5><?php echo $this->lang->line('this_month_sales') ?></h5>
                            <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i>
                                <?= amountExchange($monthsales, 0, $this->aauth->get_user()->loc) ?>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
}
?>


<?php if ($this->aauth->premission(161) && $this->aauth->personalized_premission(161) == 0)
{
	?>
<h3><?php echo $this->lang->line('FWMS') ?></h3>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">

                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                        <i class="fa fa-file-text-o text-bold-200  font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-primary1 white media-body">
                        <a href="<?php echo base_url("employee/active_passport") ?>">
                            <h5 class="white"><?php echo $this->lang->line('Active Passport') ?></h5>
                            <h5 class="text-bold-400 mb-0 white"><i class="ft-plus"></i> <?= $active_passport ?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-danger bg-darken-2">
                        <i class="icon-notebook font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-primary1 white media-body">
                        <a href="<?php echo base_url("employee/activepermit") ?>">
                            <h5 class="white"><?= $this->lang->line('Active Permit') ?></h5>
                            <h5 class="text-bold-400 mb-0 white"><i class="ft-arrow-up"></i><?= $active_permit ?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-warning bg-darken-2">
                        <i class="icon-basket-loaded font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-primary1  white media-body">
                        <a href="<?php echo base_url("employee/expiredPassport") ?>">

                            <h5 class="white"><?= $this->lang->line('Expired Passport') ?></h5>
                            <h5 class="text-bold-400 mb-0 white"><i class="ft-arrow-up"></i><?=$expiry_passport ?>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                        <i class="icon-wallet font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-primary1  white media-body">
                        <a href="<?php echo base_url("employee/expiredPermit") ?>">

                            <h5 class="white"><?php echo $this->lang->line('Expired Permit') ?></h5>
                            <h5 class="text-bold-400 mb-0 white"><i class="ft-arrow-up"></i> <?= $expiry_permit; ?>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-content" style="background:white">

    <div class="table-responsive mb-2">
        <table id="recent-orders" class="table table-hover mb-1">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Passport Expired In 30 days') ?></th>
                    <th><?php echo $this->lang->line('Passport Expired In 60 days') ?></th>
                    <th><?php echo $this->lang->line('Passport Expired In 90 days') ?></th>
                    <th><?php echo $this->lang->line('Permit Expired In 30 days') ?></th>
                    <th><?php echo $this->lang->line('Permit Expired In 60 days') ?></th>
                    <th><?php echo $this->lang->line('Permit Expired In 90 days') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="<?php echo base_url("employee/passportExpiredThirty") ?>">
                            <?php echo $passport_expiry_thirthy;?></a></td>
                    <td><a
                            href="<?php echo base_url("employee/passportExpiredSixty") ?>"><?php echo $passport_expiry_sixty;?></a>
                    </td>
                    <td><a
                            href="<?php echo base_url("employee/passportExpiredNinety") ?>"><?php echo $passport_expiry_ninety;?></a>
                    </td>
                    <td><a
                            href="<?php echo base_url("employee/permitExpiredThirty") ?>"><?php echo $permit_expiry_thirthy;?></a>
                    </td>
                    <td><a
                            href="<?php echo base_url("employee/permitExpiredSixty") ?>"><?php echo $permit_expiry_sixty;?></a>
                    </td>
                    <td><a
                            href="<?php echo base_url("employee/permitExpiredNinety") ?>"><?php echo $permit_expiry_ninety;?></a>
                    </td>
                </tr>

            </tbody>
        </table>


    </div>
</div>

<?php }?>


<?php if ($this->aauth->premission(222) && $this->aauth->personalized_premission(222) == 0)
{
?>
<h3><?php echo $this->lang->line('Attendance') ?></h3>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                        <i class="fa fa-file-text-o text-bold-200  font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-primary white media-body">
                        <a href="<?php echo base_url('employee/daily_attendances'); ?>" style="color:#fff">

                            <h5><?php echo $this->lang->line('Clock In Early Employees') ?></h5>
                            <h5 class="text-bold-400 mb-0"><i class="ft-plus"></i>
                                <?= $attendance_analytics['check_in_counter'] ?> /
                                <?= $attendance_analytics['ofc_attended_employees'] ?></h5>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-danger bg-darken-2">
                        <i class="icon-notebook font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-danger white media-body">
                        <a href="<?php echo base_url('employee/daily_attendances'); ?>" style="color:#fff">

                            <h5><?= $this->lang->line("ClockIn Early, ClockOut Late") ?></h5>
                            <h5 class="text-bold-400 mb-0"><i
                                    class="ft-arrow-up"></i><?= $attendance_analytics['clock_in_and_out_emp'] ?> /
                                <?= $attendance_analytics['ofc_attended_employees'] ?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-warning bg-darken-2">
                        <i class="icon-basket-loaded font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-warning white media-body">
                        <a href="<?php echo base_url('employee/daily_attendances'); ?>" style="color:#fff">
                            <h5><?= $this->lang->line('Clock In&Out at Office') ?></h5>
                            <h5 class="text-bold-400 mb-0"><i
                                    class="ft-arrow-up"></i><?= $attendance_analytics['clock_in_and_out_within_ofc'] ?>
                                / <?= $attendance_analytics['ofc_attended_employees'] ?>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                        <i class="icon-wallet font-large-2 white"></i>
                    </div>
                    <div class="p-1 bg-gradient-x-success white media-body">
                        <a href="<?php echo base_url('employee/daily_attendances'); ?>" style="color:#fff">
                            <h5><?php echo $this->lang->line('Total Absent Employees') ?></h5>
                            <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i>
                                <?= $attendance_analytics['absent_employees'] ?>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($this->aauth->premission(223) && $this->aauth->personalized_premission(223) == 0)
{
?>

<h3><?php echo $this->lang->line('Clock In Locations in MAP') ?></h3>
<div class="row">
    <div class="col-lg-12">
        <div class="card status_block" status="Assign">
            <div class="card-body">
                <div class="card-block">
                    <!-- Bootstrap row div for responsiveness -->
                    <div id="map" style="height: 400px; width: 100%;"></div>

                </div>
            </div>
        </div>

    </div>
</div>

<?php 
}
?>
<?php if ($this->aauth->premission(163) && $this->aauth->personalized_premission(163) == 0)
{
	?>
<h3><?php echo $this->lang->line('Job Sheet') ?></h3>

<div class="row">
    <hr>

    </hr>

    <div class="col-xl-3 col-lg-6 col-xs-6">
        <div class="card status_block" status="Assign">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <a href="<?php echo base_url("dashboard/jobsheet?filter=Assign") ?>">
                                <h3 class="pink"><?php echo $assign ?></h3>
                                <span><?php echo $this->lang->line('Waiting') ?></span>
                            </a>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-clock-o pink font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-6">
        <div class="card status_block" status="Pending">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <a href="<?php echo base_url("dashboard/jobsheet?filter=Pending") ?>">
                                <h3 class="blue"><?php echo $pending ?></h3>
                                <span><?php echo $this->lang->line('Pending') ?></span>
                            </a>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-refresh blue font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-6">
        <div class="card status_block" status="Completed">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <a href="<?php echo base_url("dashboard/jobsheet?filter=Completed") ?>">

                                <h3 class="success"><?php echo $completed ?></h3>
                                <span><?php echo $this->lang->line('Completed') ?></span>
                            </a>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-check-circle success font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-6">
        <div class="card status_block" status="All">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <a href="<?php echo base_url("dashboard/jobsheet?filter=All") ?>">

                                <h3 class="cyan"><?php echo $totalt ?></h3>
                                <span><?php echo $this->lang->line('Total') ?></span>
                            </a>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-pie-chart cyan font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>

<?php if ($this->aauth->premission(218) && $this->aauth->personalized_premission(218) == 0)
{
?>
<h3><?php echo $this->lang->line('Support Tickets') ?></h3>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-xs-6">
        <a href="<?php echo base_url('tickets/?filter=waiting'); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink" id="dash_0"></h3>
                                <span><?php echo $this->lang->line('Waiting') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-clock-o pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-6 col-xs-6">
        <a href="<?php echo base_url('tickets/?filter=processing'); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="blue" id="dash_1"></h3>
                                <span><?php echo $this->lang->line('Processing') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-refresh blue font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-6 col-xs-6">
        <a href="<?php echo base_url('tickets/?filter=solved'); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="success" id="dash_2"></h3>
                                <span><?php echo $this->lang->line('Solved') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-check-circle success font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-6 col-xs-6">
        <a href="<?php echo base_url('tickets/?filter=total'); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="cyan"><?php echo $total_tickets; ?></h3>
                                <span><?php echo $this->lang->line('Total') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-pie-chart cyan font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<?php } ?>
<?php if ($this->aauth->premission(220) && $this->aauth->personalized_premission(220) == 0)
{
?>
<h3><?php echo $this->lang->line('CRM') ?></h3>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-xs-6">
        <a href="<?php echo base_url('customers'); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink" id="dash_0"><?php echo $customer_counts['existing_customers']; ?></h3>
                                <span><?php echo $this->lang->line('Existing Customers') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-clock-o pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-lg-6 col-xs-6">
        <a href="<?php echo base_url('customers'); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="blue" id=""><?php echo $customer_counts['new_customers']; ?></h3>
                                <span><?php echo $this->lang->line('New Customers') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-refresh blue font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-xl-3 col-lg-6 col-xs-6">
        <a href="<?php echo base_url('customers'); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="cyan"><?php echo $customer_counts['total_count']; ?></h3>
                                <span><?php echo $this->lang->line('Total Customers') ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-pie-chart cyan font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<?php } ?>


<div class="row match-height">
<?php if ($this->aauth->premission(230) && $this->aauth->personalized_premission(230) == 0){ ?>
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('in_last _30') ?></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="products-sales" class="height-300"></div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="primary">
                                                <?= amountExchange($todayinexp['credit'], 0, $this->aauth->get_user()->loc) ?>
                                            </h3>
                                            <span><?php echo $this->lang->line('today_income') ?></span>
                                        </div>

                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php /*<div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="danger"><?= amountExchange($todayinexp['debit'], 0, $this->aauth->get_user()->loc) ?>
                    </h3>
                    <span><?php echo $this->lang->line('today_expenses') ?></span>
                </div>

            </div>
            <div class="progress progress-sm mt-1 mb-0">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
</div> */ ?>
<div class="col-xl-3 col-lg-6 col-12">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="media">
                    <div class="media-body text-left w-100">
                        <h3 class="success"><?= amountExchange($todayprofit, 0, $this->aauth->get_user()->loc) ?></h3>
                        <span><?php echo $this->lang->line('today_profit') ?></span>
                    </div>

                </div>
                <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-lg-6 col-12">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="media">
                    <div class="media-body text-left w-100">
                        <h3 class="warning"><?= amountExchange($tt_inc - $tt_exp, 0, $this->aauth->get_user()->loc) ?>
                        </h3>
                        <span><?php echo $this->lang->line('revenue') ?></span>
                    </div>

                </div>
                <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
<?php if ($this->aauth->premission(227) && $this->aauth->personalized_premission(227) == 0){ ?>
<div class="col-xl-4 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $this->lang->line('Recent Buyers') ?></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content px-1">
            <div id="recent-buyers" class="media-list height-450  mt-1 position-relative">
                <?php
                    if (isset($recent_buy[0]['csd'])) {

                        foreach ($recent_buy as $item) {

                            echo '       <a href="' . base_url('customers/view?id=' . $item['csd']) . '" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="' . base_url() . 'userfiles/customers/thumbnail/' . $item['picture'] . '">
                            <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <h6 class="list-group-item-heading">' . $item['name'] . ' <span class="font-medium-4 float-right pt-1">' . amountExchange($item['total'], 0, $this->aauth->get_user()->loc) . '</span></h6>
                            <p class="list-group-item-text mb-0"><span class="badge  st-' . $item['status'] . '">' . $this->lang->line(ucwords($item['status'])) . '</span></p>
                        </div>
                    </a>';

                        }
                    } elseif ($recent_buy == 'sql') {
                        echo ' <div class="media-body w-100">  <h5 class="list-group-item-heading bg-danger white">Critical SQL Strict Mode Error: </h5>Please Disable Strict SQL Mode for in database  settings.</div>';
                    }

                    ?>


            </div>
            <br>
        </div>
    </div>
</div>
<?php }?>

</div>
<div class="row match-height">
    <?php if ($this->aauth->premission(226) && $this->aauth->personalized_premission(226) == 0){ ?>
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('recent_invoices') ?></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <p><span class="float-right"> <a href="<?php echo base_url() ?>invoices/create"
                                class="btn btn-primary btn-sm rounded"><?php echo $this->lang->line('Add Sale') ?></a>
                            <a href="<?php echo base_url() ?>invoices"
                                class="btn btn-success btn-sm rounded"><?php echo $this->lang->line('Manage Invoices') ?></a>
                            <?php /*   <a
                                        href="<?php echo base_url() ?>pos_invoices"
                            class="btn btn-blue btn-sm rounded"><?php echo $this->lang->line('POS') ?></a> */ ?></span>
                    </p>
                </div>
            </div>
            <div class="card-content">

                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover mb-1">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('Invoices') ?>#</th>
                                <th><?php echo $this->lang->line('Customer') ?></th>
                                <th><?php echo $this->lang->line('Status') ?></th>
                                <th><?php echo $this->lang->line('Due') ?></th>
                                <th><?php echo $this->lang->line('Amount') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                        foreach ($recent as $item) {
                            $page = 'subscriptions';
                            $t = 'Sub ';
                            if ($item['i_class'] == 0) {
                                $page = 'invoices';
                                $t = '';
                            }
                            //elseif ($item['i_class'] == 1) {
                               // $page = 'pos_invoices';
                               // $t = 'POS ';
                           // }
                            echo '    <tr>
                                <td class="text-truncate"><a href="' . base_url() . $page . '/view?id=' . $item['id'] . '">' . $t . '#' . $item['tid'] . '</a></td>
                             
                                <td class="text-truncate"> ' . $item['name'] . '</td>
                                <td class="text-truncate"><span class="badge  st-' . $item['status'] . ' st-' . $item['status'] . '">' . $this->lang->line(ucwords($item['status'])) . '</span></td><td class="text-truncate">' . dateformat($item['invoicedate']) . '</td>
                                <td class="text-truncate">' . amountExchange($item['total'], 0, $this->aauth->get_user()->loc) . '</td>
                            </tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if ($this->aauth->premission(225) && $this->aauth->personalized_premission(225) == 0){ ?>
    <div class="col-xl-4 col-lg-12">
        <div class="card">

            <div class="card-header">
                <div class="header-block">
                    <h4 class="title">
                        <?php echo $this->lang->line('income_vs_expenses') ?>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div id="salesbreakdown" class="card mt-2" data-exclude="xs,sm,lg">
                    <div class="dashboard-sales-breakdown-chart" id="dashboard-sales-breakdown-chart"></div>

                </div>
                <br>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php if ($this->aauth->premission(228) && $this->aauth->personalized_premission(228) == 0)
{
?>
<div class="row">
    <div class="col-12">
        <div class="card-group">
            <div class="card">
                <div class="card-content">

                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left w-100">
                                <h3 class="primary">
                                    <?php $ipt = sprintf("%0.0f", ($tt_inc * 100) / $goals['income']); ?><?php echo ' ' . $ipt . '%' ?>
                                </h3>
                                <?= '<span class=" font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('income') . '</span>'; ?>
                                <span
                                    class="font-medium-1"><?= amountExchange($tt_inc, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['income'], 0, $this->aauth->get_user()->loc) ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="fa fa-money primary font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $ipt ?>%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php /*     <div class="card">
                <div class="card-content">

                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left w-100">
                                <h3 class="red"><?php $ipt = sprintf("%0.0f", ($tt_exp * 100) / $goals['expense']); ?><?php echo ' ' . $ipt . '%' ?>
            </h3>
            <?= '<span class="font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('expenses') . '</span>'; ?>
            <span
                class="font-medium-1"><?= amountExchange($tt_exp, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['expense'], 0, $this->aauth->get_user()->loc) ?></span>
        </div>
        <div class="media-right media-middle">
            <i class="ft-external-link red font-large-2 float-right"></i>
        </div>
    </div>
    <div class="progress progress-sm mt-1 mb-0">
        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $ipt ?>%" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>
</div>
</div>*/ ?>
<div class="card">
    <div class="card-content">

        <div class="card-body">
            <div class="media">
                <div class="media-body text-left w-100">
                    <h3 class="blue">
                        <?php $ipt = sprintf("%0.0f", ($monthsales * 100) / $goals['sales']); ?><?php echo ' ' . $ipt . '%' ?>
                    </h3>
                    <?= '<span class="font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('sales') . '</span>'; ?>
                    <span
                        class="font-medium-1"><?= amountExchange($monthsales, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['sales'], 0, $this->aauth->get_user()->loc) ?></span>
                </div>
                <div class="media-right media-middle">
                    <i class="ft-flag blue font-large-2 float-right"></i>
                </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0">
                <div class="progress-bar bg-blue" role="progressbar" style="width: <?= $ipt ?>%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-content">

        <div class="card-body">
            <div class="media">
                <div class="media-body text-left w-100">
                    <h3 class="purple">
                        <?php $ipt = sprintf("%0.0f", (($tt_inc - $tt_exp) * 100) / $goals['sales']); ?><?php echo ' ' . $ipt . '%' ?>
                    </h3>
                    <?= '<span class="font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('net_income') . '</span>'; ?>
                    <span
                        class="font-medium-1"><?= amountExchange($tt_inc - $tt_exp, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['netincome'], 0, $this->aauth->get_user()->loc) ?></span>
                </div>
                <div class="media-right media-middle">
                    <i class="ft-inbox purple font-large-2 float-right"></i>
                </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0">
                <div class="progress-bar bg-purple" role="progressbar" style="width: <?= $ipt ?>%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div><?php }?>

<div class="row match-height">

    <?php if ($this->aauth->premission(224) && $this->aauth->personalized_premission(224) == 0)
{
?>
    <div class="col-xl-7 col-lg-12">
        <div class="card" id="transactions">

            <div class="card-body">
                <h4><?php echo $this->lang->line('cashflow') ?></h4>
                <p><?php echo $this->lang->line('graphical_presentation') ?></p>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#sales"
                            aria-expanded="true"><?php echo $this->lang->line('income') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#transactions1"
                            aria-expanded="false"><?php echo $this->lang->line('expenses') ?></a>
                    </li>


                </ul>
                <div class="tab-content pt-1">
                    <div role="tabpanel" class="tab-pane active" id="sales" aria-expanded="true" data-toggle="tab">
                        <div id="dashboard-income-chart"></div>

                    </div>
                    <div class="tab-pane" id="transactions1" data-toggle="tab" aria-expanded="false">
                        <div id="dashboard-expense-chart"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php } ?>
    <?php if ($this->aauth->premission(162) && $this->aauth->personalized_premission(162) == 0)
{
?>
    <div class="col-xl-5 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('Month Wise Expense For Payroll Data') ?>
                </h4>
            </div>

            <div class="card-content">
                <div class="col-md-3">
                    <select name="year" id="year" class="form-control" style="width:200px;">
                        <option value="">Select Year</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023" selected>2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>

                    </select>
                </div>
                <div class="panel-body">
                    <div id="chart_area" style="width:100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>


</div>
<?php if ($this->aauth->premission(160) && $this->aauth->personalized_premission(160) == 0)
{
?>
<div class="row match-height">
    <?php /*
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('recent') ?> <a
        href="<?php echo base_url() ?>transactions"
        class="btn btn-primary btn-sm rounded"><?php echo $this->lang->line('Transactions') ?></a>
    </h4>
    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
    <div class="heading-elements">
        <ul class="list-inline mb-0">
            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
        </ul>
    </div>
</div>
<div class="card-body">

    <div class="table-responsive">
        <table class="table table-hover mb-1">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Date') ?>#</th>
                    <th><?php echo $this->lang->line('Account') ?></th>
                    <th><?php echo $this->lang->line('Debit') ?></th>
                    <th><?php echo $this->lang->line('Credit') ?></th>

                    <th><?php echo $this->lang->line('Method') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php

                        foreach ($recent_payments as $item) {

                            echo '<tr>
                                <td class="text-truncate"><a href="' . base_url() . 'transactions/view?id=' . $item['id'] . '">' . dateformat($item['date']) . '</a></td>
                                <td class="text-truncate"> ' . $item['account'] . '</td>
                                <td class="text-truncate">' . amountExchange($item['debit'], 0, $this->aauth->get_user()->loc) . '</td>
                                <td class="text-truncate">' . amountExchange($item['credit'], 0, $this->aauth->get_user()->loc) . '</td>                    
                                <td class="text-truncate">' . $this->lang->line($item['method']) . '</td>
                            </tr>';

                        } ?>

            </tbody>
        </table>
    </div>
</div>
</div>
</div> */ ?>
<?php /* temprary hide
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-header ">
                <h4 class="card-title"><?php echo $this->lang->line('Stock Alert') ?></h4>

</div>
<div class="card-body">
    <ul class="list-group list-group-flush">

        <?php

                    foreach ($stock as $item) {
                        echo '<li class="list-group-item"><span class="badge badge-danger float-xs-right">' . +$item['qty'] . ' ' . $item['unit'] . '</span> <a href="' . base_url() . 'products/edit?id=' . $item['pid'] . '">' . $item['product_name'] . '  </a><small class="purple"> <i class="ft-map-pin"></i> ' . $item['title'] . '</small>
                                </li>';
                    } ?>

    </ul>

</div>
</div>
</div>
*/ ?>
</div><?php }?>
<?php if ($this->aauth->premission(217) && $this->aauth->personalized_premission(217) == 0)
{
?>
<h3><?php echo $this->lang->line('Projects') ?></h3>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?php echo base_url('projects/?filter=waiting'); ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-clock-o primary font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3 class="pink" id="pdash_0"></h3>
                                <span><?php echo $this->lang->line('Waiting') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?php echo base_url('projects/?filter=progress'); ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-exchange warning font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3 class="indigo" id="pdash_1"></h3>
                                <span><?php echo $this->lang->line('Progress') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?php echo base_url('projects/?filter=finished'); ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-flag-checkered success font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3 class="green" id="pdash_2"></h3>
                                <span><?php echo $this->lang->line('Finished') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <a href="<?php echo base_url('projects'); ?>">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-dot-circle-o danger font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3 class="deep-cyan" id="pdash_6"><?php echo $total_projects ?></h3>
                                <span><?php echo $this->lang->line('Total') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('Recent Projects') ?></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content px-1">
                <div id="recent-projects" class="media-list height-450  mt-1 mb-1 position-relative">
                    <?php
                    if (!empty($projects_list)) {

                        foreach ($projects_list as $project_l) { ?>

                    <a class="media border-0 dashb_pr_wrapper mb-1" style="border:1px solid #EDEFF5 !important;">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle"
                                    src="<?php echo base_url('userfiles/customers/thumbnail/example.png'); ?>">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <h6 class="list-group-item-heading"><?php echo $project_l['name']; ?> <span
                                    class="font-medium-4 float-right pt-1"><?php // echo $project_l['name']; ?> </span>
                            </h6>
                            <p class="list-group-item-text mb-0"><span
                                    class="badge  st-<?php echo strtolower($project_l['status']); ?>"><?php echo $this->lang->line(ucwords($project_l['status'])); ?></span>
                            </p>
                        </div>
                        <div class="dashb_pr_tooltip m-2">
                            Name : <?php echo $project_l['name']; ?> <br>
                            Start Date : <?php echo date('d-m-Y',strtotime($project_l['sdate'])); ?> <br>
                            End Date : <?php echo date('d-m-Y',strtotime($project_l['edate'])); ?> <br>
                            Priority : <?php echo $project_l['priority']; ?> <br>
                            Status : <?php echo $project_l['status']; ?> <br>
                            Worth : <?php echo $project_l['worth']; ?> <br>
                        </div>
                    </a>
                    <?php 

                        }
                    } 

                    ?>

                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php if ($this->aauth->premission(160) && $this->aauth->personalized_premission(160) == 0)
{
?>
<script type="text/javascript">
$(window).on("load", function() {
    $('#recent-buyers').perfectScrollbar({
        wheelPropagation: true
    });
    /********************************************
     *               PRODUCTS SALES              *
     ********************************************/
    var sales_data = [
        <?php foreach ($countmonthlychart as $row) {
            echo "{ y: '" . $row['date'] . "', sales: " . intval(amountExchange_s($row['total'], 0, $this->aauth->get_user()->loc)) . ", invoices: " . intval($row['ttlid']) . "},";
        } ?>
    ];
    var months = ["<?=lang('Jan') ?>", "<?=lang('Feb') ?>", "<?=lang('Mar') ?>", "<?=lang('Apr') ?>",
        "<?=lang('May') ?>", "<?=lang('Jun') ?>", "<?=lang('Jul') ?>", "<?=lang('Aug') ?>",
        "<?=lang('Sep') ?>", "<?=lang('Oct') ?>", "<?=lang('Nov') ?>", "<?=lang('Dec') ?>"
    ];
    Morris.Area({
        element: 'products-sales',
        data: sales_data,
        xkey: 'y',
        ykeys: ['sales', 'invoices'],
        labels: ['sales', 'invoices'],
        behaveLikeLine: true,
        xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
            var day = x.getDate();
            var month = months[x.getMonth()];
            return day + ' ' + month;
        },
        resize: true,
        pointSize: 0,
        pointStrokeColors: ['#00B5B8', '#FA8E57', '#F25E75'],
        smooth: true,
        gridLineColor: '#E4E7ED',
        numLines: 6,
        gridtextSize: 14,
        lineWidth: 0,
        fillOpacity: 0.9,
        hideHover: 'auto',
        lineColors: ['#00B5B8', '#F25E75']
    });


});
</script>
<script>
$(document).ready(function() {
    var passport_expiry = "passport_expiry";
    $('#jobsheet').removeAttr('width').DataTable({




        //responsive: true,
        <?php datatable_lang();?> 'order': []

        /*  "ajax": {
              "url": "<?php echo site_url('employee/getfwmsEmployeesPassportExpired')?>",
              "type": "POST",
              'data': {'passport_expiry':passport_expiry,'<?=$this->security->get_csrf_token_name()?>': crsf_hash }
          },*/


    });



});
</script>


<script type="text/javascript">
function drawIncomeChart(dataVisits) {
    $('#dashboard-income-chart').empty();
    Morris.Area({
        element: 'dashboard-income-chart',
        data: dataVisits,
        xkey: 'x',
        ykeys: ['y'],
        ymin: 'auto 40',
        labels: ['<?php echo $this->lang->line('Amount') ?>'],
        xLabels: "day",
        hideHover: 'auto',
        yLabelFormat: function(y) {
            // Only integers
            if (y === parseInt(y, 10)) {
                return y;
            } else {
                return '';
            }
        },
        resize: true,
        lineColors: [
            '#00A5A8',
        ],
        pointFillColors: [
            '#00A5A8',
        ],
        fillOpacity: 0.4,
    });
}

function drawExpenseChart(dataVisits2) {

    $('#dashboard-expense-chart').empty();
    Morris.Area({
        element: 'dashboard-expense-chart',
        data: dataVisits2,
        xkey: 'x',
        ykeys: ['y'],
        ymin: 'auto 0',
        labels: ['<?php echo $this->lang->line('Amount') ?>'],
        xLabels: "day",
        hideHover: 'auto',
        yLabelFormat: function(y) {
            // Only integers
            if (y === parseInt(y, 10)) {
                return y;
            } else {
                return '';
            }
        },
        resize: true,
        lineColors: [
            '#ff6e40',
        ],
        pointFillColors: [
            '#34cea7',
        ]
    });
}

drawIncomeChart(dataVisits);
//drawExpenseChart(dataVisits2);
$('#dashboard-sales-breakdown-chart').empty();
Morris.Donut({
    element: 'dashboard-sales-breakdown-chart',
    data: [{
            label: "<?php echo $this->lang->line('Income') ?>",
            value: <?= intval(amountExchange_s($tt_inc, 0, $this->aauth->get_user()->loc)); ?>
        },
        {
            label: "<?php echo $this->lang->line('Expenses') ?>",
            value: <?= intval(amountExchange_s($tt_exp, 0, $this->aauth->get_user()->loc)); ?>
        }
    ],
    resize: true,
    colors: ['#34cea7', '#ff6e40'],
    gridTextSize: 6,
    gridTextWeight: 400
});
$('a[data-toggle=tab').on('shown.bs.tab', function(e) {
    window.dispatchEvent(new Event('resize'));
});
</script>
<?php
}
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {
    packages: ['corechart', 'bar']
});
google.charts.setOnLoadCallback();

function load_monthwise_data(year, title) {
    var temp_title = title + ' ' + year;
    $.ajax({
        url: "<?php echo base_url(); ?>dashboard/fetch_data",
        method: "POST",
        data: {
            year: year
        },
        dataType: "JSON",
        success: function(data) {
            drawMonthwiseChart(data, temp_title);
        }
    })
}

function drawMonthwiseChart(chart_data, chart_main_title) {
    var jsonData = chart_data;

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Expense');

    $.each(jsonData, function(i, jsonData) {
        var month = jsonData.month;
        var expense = parseFloat($.trim(jsonData.expense));

        data.addRows([
            [month, expense]
        ]);
    });

    var options = {
        title: "Month Wise Expense For Payroll Data",
        hAxis: {
            title: "Months"
        },
        vAxis: {
            title: 'Expense'
        },

        chartArea: {
            width: '80%',
            height: '85%'
        }
    }

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));

    chart.draw(data, options);
}
</script>

<script>
$(document).ready(function() {
    $('#year').change(function() {
        var year = $(this).val();
        if (year != '') {
            load_monthwise_data(year, 'Month Wise Expense Data For');
        }
    });
});


$(document).ready(function() {
    var year = $("#year").val();
    if (year != '') {
        load_monthwise_data(year, 'Month Wise Expense Data For');
    }

});

$(document).ready(function() {
    var actionurl = $('#dashurl').val();
    var d_csrf = crsf_token + '=' + crsf_hash;
    $.ajax({
        url: baseurl + actionurl,
        type: 'POST',
        dataType: 'json',
        data: d_csrf,
        success: function(data) {
            var i = 0;
            //  var obj = jQuery.parseJSON(data);
            $.each(data, function(key, value) {
                for (ind in value) {
                    $('#dash_' + i).text(value[ind]);
                    i++;
                }
            });
        }
    });

});

$(document).ready(function() {
    var actionurl = $('#pdashurl').val();
    var d_csrf = crsf_token + '=' + crsf_hash;
    $.ajax({
        url: baseurl + actionurl,
        type: 'POST',
        dataType: 'json',
        data: d_csrf,
        success: function(data) {
            var i = 0;
            //  var obj = jQuery.parseJSON(data);
            $.each(data, function(key, value) {
                for (ind in value) {
                    $('#pdash_' + i).text(value[ind]);
                    i++;
                }
            });
        }
    });

});
</script>
<?php if ($this->aauth->premission(223) && $this->aauth->personalized_premission(223) == 0)
{
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMWSr2YSC6925JdAvbRyfjaiRsF8rPxA4&callback=initMap" async
    defer></script>

<script>
// Initialize and add the map
function initMap() {
    var d_csrf = true;
    var actionurl = $('#att_map_url').val();
    $.ajax({
        url: baseurl + actionurl,
        type: 'POST',
        dataType: 'json',
        data: d_csrf,
        success: function(data) {

            // alert(data.att_settings.latitude);
            // alert(data.att_settings.longitude);
            // Map center coordinates
            var mapCenter = {
                lat: parseFloat(data.att_settings.latitude),
                lng: parseFloat(data.att_settings.longitude)
            }; // Default center

            // Office location coordinates
            var officeLocation = {
                lat: parseFloat(data.att_settings.latitude),
                lng: parseFloat(data.att_settings.longitude)
            }; // Example office location

            // Array of employee locations with names
            // var employeeLocations = [
            //     {lat: 40.7128, lng: -74.0060, name: "Employee 1"}, // Example employee location 1
            //     {lat: 34.0522, lng: -118.2437, name: "Employee 2"}, // Example employee location 2
            //     // Add more employee locations with names as needed
            // ];
            // alert(data.all_employees);
            var employeeLocations = data.all_employees;
            // Create a new map centered at a location
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10, // Adjust zoom level as needed
                center: mapCenter
            });

            // Add office marker with tooltip
            // Add office marker with automatic tooltip
            var officeMarker = new google.maps.Marker({
                position: officeLocation,
                map: map,
                title: "Office Location" // Tooltip text
            });

            // Create an info window for the office marker
            var officeInfoWindow = new google.maps.InfoWindow({
                content: "Office Location" // Content of the info window
            });

            // Add a listener to open the info window when the office marker is clicked
            officeMarker.addListener('click', function() {
                officeInfoWindow.open(map, officeMarker);
            });

            // Automatically open the info window for the office marker when it's added to the map
            officeInfoWindow.open(map, officeMarker);


            // Add geofence around office marker
            var geofenceCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: officeLocation, // Geofence center
                radius: (parseInt(data.att_settings.office_login_radius) * 1000) // 5km in meters
            });

            // Add employee markers to the map with tooltips
            // for (var i = 0; i < employeeLocations.length; i++) {
            //     var marker = new google.maps.Marker({
            //         position: employeeLocations[i],
            //         map: map,
            //         title: employeeLocations[i].name // Tooltip text
            //     });
            // }
            for (var i = 0; i < employeeLocations.length; i++) {
                var marker = new google.maps.Marker({
                    position: employeeLocations[i],
                    map: map,
                    title: employeeLocations[i].name // Tooltip text
                });

                // Create an info window with the employee's name
                var infoWindow = new google.maps.InfoWindow({
                    content: employeeLocations[i].name // Content of the info window
                });

                // Add a listener to open the info window when the marker is clicked
                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });

                // Automatically open the info window when the marker is added to the map
                infoWindow.open(map, marker);
            }

        }
    });

}
</script>
<?php } ?>