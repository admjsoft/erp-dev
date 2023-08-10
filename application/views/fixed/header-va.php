<link rel="stylesheet" type="text/css"
      href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/menu/menu-types/vertical-menu-modern.css">
<style>
.main-menu.menu-dark .navigation > li.hover > a, .main-menu.menu-dark .navigation > li:hover > a, .main-menu.menu-dark .navigation > li.active > a {
    color: #FFFFFF;
    background-color: #7CBCBA;
}
.navbar-semi-dark .navbar-header {
    background: #4390A4 !important;
}
.main-menu.menu-dark .navigation {
    background: #4390A4 !important;
}
.main-menu.menu-dark {
    color: #FFFFFF !important;
    background: #4390A4 !important;
}
.main-menu.menu-dark .navigation > li.open {
    border-left: 4px solid #E2F6EF;
}
.main-menu.menu-dark .navigation > li.open > a {
    color: #FFFFFF !important;
    background: #4390A4 !important;
}
.main-menu.menu-dark .navigation > li > ul {
    background: #4390A4;
}
.main-menu.menu-dark  ul li a{
color: #FFFFFF !important;
}
 .main-menu.menu-dark .navigation > li.hover > a, .main-menu.menu-dark .navigation > li.active > a {
    color: #FFFFFF !important;
    background-color: #7CBCBA !important;
}
.main-menu.menu-dark .navigation > li.open .hover > a {
    background: #1aada0;
}
.main-menu.menu-dark .navigation > li ul .open .hover > a {
    background: #1aada0;
}

@media only screen and (min-width: 768px) {
    ul.nav.navbar-nav.flex-row {
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
        padding: 0px;
    }

}
.header-navbar .navbar-header .navbar-brand {
    padding: 8px 0px;
    margin: 0px !important;
}
body.vertical-layout.vertical-menu-modern.menu-collapsed .navbar .navbar-brand {
    padding: 8px 0px;
}
.brand-logo {
    max-height: 40px;
    margin: 0px !important;
margin-left:-5px !important;
}
</style>
<script>
$(document).ready(function() {
$('.ft-menu').on('click', function(){
if($('.vertical-menu-modern').hasClass('menu-collapsed')){
$('.vertical-menu-modern').removeClass('menu-collapsed');
$('.vertical-menu-modern').addClass('menu-expanded');
$(".brand-logo").attr('src','<?php echo base_url('userfiles/theme/logo-header.png')?>');
$('.nav-menu-main').addClass('is-active');
}else{
$('.vertical-menu-modern').removeClass('menu-expanded');
$('.vertical-menu-modern').addClass('menu-collapsed');
$(".brand-logo").attr('src','<?php echo base_url('userfiles/theme/logo-header-icon.png')?>');
$('.nav-menu-main').removeClass('is-active');
}

});

});
</script>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
      data-menu="vertical-menu-modern" data-col="2-columns">
<span id="hdata"
      data-df="<?php echo $this->config->item('dformat2'); ?>"
      data-curr="<?php echo currency($this->aauth->get_user()->loc); ?>"></span>
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="<?= base_url() ?>dashboard/">
             <img class="brand-logo ml-1" alt="logo"
                                src="<?php echo base_url(); ?>userfiles/theme/logo-header.png">
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                                                  data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>


                    <li class="dropdown  nav-item"><a class="nav-link nav-link-label" href="#"
                                                      data-toggle="dropdown"><i
                                    class="ficon ft-map-pin success"></i></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-left">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span
                                            class="grey darken-2"><i
                                                class="ficon ft-map-pin success"></i><?php echo $this->lang->line('business_location') ?></span>
                                </h6>
                            </li>

                            <li class="dropdown-menu-footer"><span class="dropdown-item text-muted text-center blue"
                                > <?php $loc = location($this->aauth->get_user()->loc);
                                    echo $loc['cname']; ?></span>
                            </li>

                        </ul>
                    </li>
                    <?php    if ($this->aauth->premission(12)) { ?>   <li class="nav-item d-none d-md-block nav-link "><a href="<?= base_url() ?>pos_invoices/create"
                                                                        class="btn btn-info btn-md t_tooltip"
                                                                        title="Access POS"><i
                                    class="icon-handbag"></i><?php echo $this->lang->line('POS') ?> </a>
                    </li>  <?php    } ?>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#" aria-haspopup="true"
                                                       aria-expanded="false" id="search-input"><i
                                    class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text"
                                   placeholder="<?php echo $this->lang->line('Search Customer') ?>"
                                   id="head-customerbox">
                        </div>
                        <div id="head-customerbox-result" class="dropdown-menu ml-5"
                             aria-labelledby="search-input"></div>
                    </li>
                </ul>

                <ul class="nav navbar-nav float-right"><?php if ($this->aauth->get_user()->roleid == 5) { ?>
                        <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link " href="#"
                                                                       data-toggle="dropdown"><?php echo $this->lang->line('business_settings') ?></a>
                            <ul class="mega-dropdown-menu dropdown-menu row">
                                <li class="col-md-3">

                                    <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading1" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap" href="#accordion1"
                                                   aria-controls="accordion1"><i
                                                            class="fa fa-leaf"></i> <?php echo $this->lang->line('business_settings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion1" role="tabpanel"
                                                 aria-labelledby="heading1" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/company"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('company_settings') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>locations"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Business Locations') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>tools/setgoals"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Set Goals') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading2" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap" href="#accordion2"
                                                   aria-controls="accordion2"> <i
                                                            class="fa fa-calendar"></i><?php echo $this->lang->line('Localisation') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion2" role="tabpanel"
                                                 aria-labelledby="heading2" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/currency"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Currency') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/language"><i
                                                                        class="ft-chevron-right"></i>Languages</a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/dtformat"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Date & Time Format') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/theme"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Theme') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading3" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap" href="#accordion3"
                                                   aria-controls="accordion3"> <i
                                                            class="fa fa-lightbulb-o"></i><?php echo $this->lang->line('miscellaneous_settings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion3" role="tabpanel"
                                                 aria-labelledby="heading3" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>

                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/email"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Email Config') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>transactions/categories"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Transaction Categories') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/misc_automail"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('EmailAlert') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/about"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('About') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-3">

                                    <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading4" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap1" href="#accordion4"
                                                   aria-controls="accordion4"><i
                                                            class="fa fa-fire"></i><?php echo $this->lang->line('AdvancedSettings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion4" role="tabpanel"
                                                 aria-labelledby="heading4" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>

                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>cronjob"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Automatic Corn Job') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/custom_fields"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('CustomFields') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/dual_entry"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('DualEntryAccounting') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/logdata"><i
                                                                        class="ft-chevron-right"></i> Application
                                                                Activity Log</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/debug"><i
                                                                        class="ft-chevron-right"></i> Debug Mode </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading2" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap1" href="#accordion5"
                                                   aria-controls="accordion5"> <i
                                                            class="fa fa-shopping-cart"></i><?php echo $this->lang->line('BillingSettings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion5" role="tabpanel"
                                                 aria-labelledby="heading5" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                               <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/billing_settings"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('billing_settings') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/discship"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('DiscountShipping') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/prefix"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Prefix') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/billing_terms"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Billing Terms') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/automail"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Auto Email SMS') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/warehouse"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('DefaultWarehouse') ?>
                                                            </a></li>

                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/pos_style"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('POSStyle') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading6" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap1" href="#accordion6"
                                                   aria-controls="accordion6"><i
                                                            class="fa fa-scissors"></i><?php echo $this->lang->line('TaxSettings')  ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion6" role="tabpanel"
                                                 aria-labelledby="heading6" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/tax"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Tax') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/taxslabs"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('OtherTaxSettings') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-3">

                                    <div id="accordionWrap2" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading7" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap2" href="#accordion7"
                                                   aria-controls="accordion7"><i
                                                            class="fa fa-flask"></i><?php echo $this->lang->line('ProductsSettings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion7" role="tabpanel"
                                                 aria-labelledby="heading7" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>units"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Measurement Unit') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>units/variations"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('ProductsVariations') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>units/variables"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('VariationsVariables') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading8" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap2" href="#accordion8"
                                                   aria-controls="accordion8"> <i
                                                            class="fa fa-money"></i><?php echo $this->lang->line('Payment Settings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion8" role="tabpanel"
                                                 aria-labelledby="heading8" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>paymentgateways/settings"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Payment Settings') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>paymentgateways"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Payment Gateways') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>paymentgateways/currencies"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Payment Currencies') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>paymentgateways/exchange"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Currency Exchange') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>paymentgateways/bank_accounts"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Bank Accounts') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading9" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap2" href="#accordion9"
                                                   aria-controls="accordion9"><i
                                                            class="fa fa-umbrella"></i><?php echo $this->lang->line('CRMHRMSettings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion9" role="tabpanel"
                                                 aria-labelledby="heading9" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>employee/auto_attendance"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('SelfAttendance') ?>
                                                            </a></li>

                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/registration"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('CRMSettings') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>plugins/recaptcha"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Security') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/tickets"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Support Tickets') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </li>


                                <li class="col-md-3">

                                    <div id="accordionWrap3" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading10" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap3" href="#accordion10"
                                                   aria-controls="accordion10"><i
                                                            class="fa fa-magic"></i><?php echo $this->lang->line('PluginsSettings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion10" role="tabpanel"
                                                 aria-labelledby="heading10" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>plugins/recaptcha"><i
                                                                        class="ft-chevron-right"></i>reCaptcha Security</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>plugins/shortner"><i
                                                                        class="ft-chevron-right"></i> URL Shortener</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>plugins/twilio"><i
                                                                        class="ft-chevron-right"></i> SMS Configuration</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>paymentgateways/exchange"><i
                                                                        class="ft-chevron-right"></i>Currency Exchange
                                                                API</a></li>
                                                        <?php plugins_checker(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading11" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap3" href="#accordion11"
                                                   aria-controls="accordion11"> <i
                                                            class="fa fa-eye"></i><?php echo $this->lang->line('TemplatesSettings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion11" role="tabpanel"
                                                 aria-labelledby="heading8" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>templates/email"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Email') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>templates/sms"><i
                                                                        class="ft-chevron-right"></i> SMS</a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/print_invoice"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Print Invoice') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/theme"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Theme') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading12" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap3" href="#accordion12"
                                                   aria-controls="accordion12"><i
                                                            class="fa fa-print"></i>POS Printers</a>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion12" role="tabpanel"
                                                 aria-labelledby="heading12" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>printer/add"><i
                                                                        class="ft-chevron-right"></i>Add Printer</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>printer"><i
                                                                        class="ft-chevron-right"></i> List Printers</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </li>


                            </ul>
                        </li>       <?php } ?>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                                                           data-toggle="dropdown"><i
                                    class="ficon ft-bell"></i><span
                                    class="badge badge-pill badge-default badge-danger badge-default badge-up"
                                    id="taskcount">0</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span
                                            class="grey darken-2"><?php echo $this->lang->line('Pending Tasks') ?></span><span
                                            class="notification-tag badge badge-default badge-danger float-right m-0"><?=$this->lang->line('New') ?></span>
                                </h6>
                            </li>
                            <li class="scrollable-container media-list" id="tasklist"></li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                                                href="<?php echo base_url('manager/todo') ?>"><?php echo $this->lang->line('Manage tasks') ?></a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                                                           data-toggle="dropdown"><i
                                    class="ficon ft-mail"></i><span
                                    class="badge badge-pill badge-default badge-info badge-default badge-up"><?php echo $this->aauth->count_unread_pms() ?></span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span
                                            class="grey darken-2"><?php echo $this->lang->line('Messages') ?></span><span
                                            class="notification-tag badge badge-default badge-warning float-right m-0"><?php echo $this->aauth->count_unread_pms() ?><?php echo $this->lang->line('new') ?></span>
                                </h6>
                            </li>
                            <li class="scrollable-container media-list">
                                <?php $list_pm = $this->aauth->list_pms(6, 0, $this->aauth->get_user()->id, false);

                                foreach ($list_pm as $row) {

                                    echo '<a href="' . base_url('messages/view?id=' . $row->pid) . '">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm  rounded-circle"><img src="' . base_url('userfiles/employee/' . $row->picture) . '" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">' . $row->name . '</h6>
                          <p class="notification-text font-small-3 text-muted">' . $row->{'title'} . '</p><small>
                            <time class="media-meta text-muted" datetime="' . $row->{'date_sent'} . '">' . $row->{'date_sent'} . '</time></small>
                        </div>
                      </div></a>';
                                } ?>    </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                                                href="<?php echo base_url('messages') ?>"><?php echo $this->lang->line('Read all messages') ?></a>
                            </li>
                        </ul>
                    </li>
                    <?php  $user_attendance = 0;
                        if ($this->aauth->auto_attend()) { ?>
                        <li class="dropdown dropdown-d nav-item">
                            <?php if ($this->aauth->clock()) {
                                echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $this->lang->line('On') . '</span></a>';
                            } else {
                                echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon icon-clock"></i><span class="badge badge-pill badge-default badge-warning badge-default badge-up">' . $this->lang->line('Off') . '</span></a>';
                            }
                            ?>

                            <ul class="dropdown-menu dropdown-menu-right border-primary border-lighten-3 text-xs-center">
                                <br><br>
                                <?php echo '<li class="p-1 pd-0"><span class="text-bold-300">' . $this->lang->line('Attendance') . ':</span></li>';
                                if (!$this->aauth->clock()) {
                                    echo '<li class="p-1"><a href="' . base_url() . '/dashboard/clock_in" class="btn btn-outline-success  btn-outline-white btn-md" ><span class="icon-toggle-on" aria-hidden="true"></span> ' . $this->lang->line('ClockIn') . ' <i
                                    class="ficon icon-clock spinner"></i></a></li>';
                                } else {
                                    $user_attendance = 1;
                                    echo '<li class="p-1"><a href="' . base_url() . '/dashboard/clock_out" class="btn btn-outline-danger  btn-outline-white btn-md" ><span class="icon-toggle-off" aria-hidden="true"></span> ' . $this->lang->line('ClockOut') . ' </a></li>';
                                     if($this->aauth->check_break()){
                                         $rw=$this->aauth->break_time_all();
                                        foreach($rw as $item){
                                        echo '<li class="p-1"><a href="' . base_url() . 'dashboard/break_in?bt='.$item['id'].'" class="btn btn-outline-light-blue  btn-outline-blue-grey btn-md" ><span class="icon-toggle-off" aria-hidden="true"></span> '.$item['name'].'</a></li>';
                                    }
                                    }else{
                                         echo '<li class="p-1"><a href="' . base_url() . 'dashboard/break_out" class="btn btn-outline-cyan btn-md" ><span class="icon-toggle-off" aria-hidden="true"></span> ' . $this->lang->line('End Break') . 'End Break</a></li>';
                                    }
                                }


                                    ?>

                                <br><br>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown"><span
                                    class="avatar avatar-online"><img
                                        src="<?php echo base_url('userfiles/employee/thumbnail/' . $this->aauth->get_user()->picture) ?>"
                                        alt="avatar"><i></i></span><span
                                    class="user-name"><?php echo $this->session->userdata('login_name'); ?></span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                                                          href="<?php echo base_url(); ?>user/profile"><i
                                        class="ft-user"></i> <?php echo $this->lang->line('Profile') ?></a>
                            <?php if ($this->aauth->premission(25)){ ?>
                            <a href="<?php echo base_url(); ?>user/attendance"
                               class="dropdown-item"><i
                                        class="fa fa-list-ol"></i><?php echo $this->lang->line('Attendance') ?></a>
                            <a href="<?php echo base_url(); ?>employee/attendview?id=<?php echo $this->aauth->get_user()->id; ?>" class="dropdown-item"><i class="fa fa-list-ol"></i><?php echo $this->lang->line('Break Details') ?></a>
                            <?php } ?>
                            <a href="<?php echo base_url(); ?>user/holidays"
                               class="dropdown-item"><i
                                        class="fa fa-hotel"></i><?php echo $this->lang->line('Holidays') ?></a>


                            <div class="dropdown-divider"></div>
                           
                            <?php if($user_attendance){ ?>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#attendance_logout_check"><i
                            class="ft-power"></i> <?php echo $this->lang->line('Logout') ?></a>     
                            <?php }else{ ?>
                                 <a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>"><i
                                        class="ft-power"></i> <?php echo $this->lang->line('Logout') ?></a>
                            <?php } ?>
                                      
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<!-- Horizontal navigation-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <!-- Horizontal menu content-->
    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <?php //if ($this->aauth->get_user()->roleid == 5) { ?>
            <?php if ($this->aauth->get_user()->roleid == 99) { ?>
                <li class="p-1"><select class="form-control"
                                        onchange="javascript:location.href = baseurl+'settings/switch_location?id='+this.value;"> <?php
                        $loc = location($this->aauth->get_user()->loc);
                        echo ' <option value="' . $loc['id'] . '"> *' . $loc['cname'] . '*</option>';

                        $loc = locations();
                        foreach ($loc as $row) {
                            echo ' <option value="' . $row['id'] . '"> ' . $row['cname'] . '</option>';
                        }
                        /* temprary hide
                        echo ' <option value="0">Master/Default</option>';
                        */
                         ?></select>
                 </li> <?php } ?>
                 <li class="nav-item "><a href="<?= base_url(); ?>dashboard/"><i
                                 class="icon-speedometer"></i><span><?= $this->lang->line('Dashboard') ?></span></a>

                 </li>
             <?php
			if($this->aauth->subscribe(1))
				{
             if ($this->aauth->premission(1)) { ?>
                 <li class="nav-item has-sub <?php if ($this->li_a == "sales") {
                     echo ' open';
                 } ?>"><a href="#"><i
                                 class="icon-basket-loaded"></i><span><?php echo $this->lang->line('sales') ?></span></a>
                     <ul class="menu-content">
                         <?php    if ($this->aauth->premission(12)) { ?>  
                            
                            <li class="menu-item"><a href="#"><i
                                         class="icon-call-out"></i><?php echo $this->lang->line('Quotes') ?></a>
                             <ul class="menu-content">
                                 <li class="menu-item"><a
                                             href="<?= base_url(); ?>quote/create"><?php echo $this->lang->line('New Quote'); ?></a>
                                 </li>

                                 <li class="menu-item"><a class="dropdown-item" href="<?php echo base_url(); ?>quote"
                                                          data-toggle="dropdown"><?php echo $this->lang->line('Manage Quotes'); ?></a>
                             </ul>
                         </li>
                         <li class="menu-item"><a href="#"><i
                                         class="icon-basket"></i><?php echo $this->lang->line('invoices') ?></a>
                             <ul class="menu-content">
                                 <li class="menu-item"><a href="<?= base_url(); ?>invoices/create"
                                                          data-toggle="dropdown"><?php echo $this->lang->line('New Invoice'); ?></a>
                                 </li>

                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>invoices"><?php echo $this->lang->line('Manage Invoices'); ?></a>
                                 </li>
                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>invoices/peppol_invoices">Peppol Invoices<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                                 </li>            
                             </ul>
                         </li>
                            <li class="menu-item"><a
                                     href="#"><i
                                         class="icon-paper-plane"></i><?php echo $this->lang->line('pos invoices') ?></a>
                             <ul class="menu-content">
                                 <li class="menu-item"><a href="<?= base_url(); ?>pos_invoices/create"
                                     ><?php echo $this->lang->line('New Pos Invoice'); ?></a>
                                 </li>
                                 <?php /* ?>
                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>pos_invoices/create?v2=true"><?= $this->lang->line('New Invoice'); ?>
                                         V2 - Mobile</a>
                                 </li>
                                 <?php */ ?>
                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>pos_invoices"><?php echo $this->lang->line('Manage Pos Invoices'); ?></a>
                                 </li>
                             </ul>
                         </li>  <?php    } ?>
                        

                         
                         <li class="menu-item"><a href="#"><i
                                         class="ft-radio"></i><?php echo $this->lang->line('Subscriptions') ?></a>
                             <ul class="menu-content">
                                 <li class="menu-item"><a
                                             href="<?= base_url(); ?>subscriptions/create"><?php echo $this->lang->line('New Subscription'); ?></a>
                                 </li>

                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>subscriptions"><?php echo $this->lang->line('Subscriptions'); ?></a>
                             </ul>
                         </li>
                         <li class="menu-item">
                             <a href="<?php echo base_url(); ?>stockreturn/creditnotes"><i
                                         class="icon-screen-tablet"></i><?php echo $this->lang->line('Credit Notes'); ?>
                             </a>
                         </li> 
                    </ul>
                </li>
            <?php }
			
			}
			else{
				
		?>
		
					<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-diamond"></i> <span><?php echo $this->lang->line('sales') ?></span> &nbsp;
		   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Sales Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
			<?php	
			}
				if($this->aauth->subscribe(2))
				{
            if ($this->aauth->premission(2)) { ?>
                <li class="nav-item has-sub <?php if ($this->li_a == "stock") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="ft-layers"></i><span><?php echo $this->lang->line('Stock') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item"><a
                                    href="#"><i
                                        class="ft-list"></i> <?php echo $this->lang->line('Items Manager') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?= base_url(); ?>products/add"> <?php echo $this->lang->line('New Product'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>products"><?= $this->lang->line('Manage Products'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="<?php echo base_url(); ?>productcategory"><i
                                        class="ft-umbrella"></i><?php echo $this->lang->line('Product Categories'); ?>
                            </a>
                        </li>
                        <li class="menu-item"><a href="<?php echo base_url(); ?>productcategory/warehouse"><i
                                        class="ft-sliders"></i><?php echo $this->lang->line('Warehouses'); ?></a>
                        </li>
                        <li class="menu-item"><a class="dropdown-item"
                                                 href="<?php echo base_url(); ?>products/stock_transfer"><i
                                        class="ft-wind"></i><?php echo $this->lang->line('Stock Transfer'); ?></a>
                        </li>
                        </li>

                        <li class="menu-item"><a href="#"><i
                                        class="icon-handbag"></i> <?php echo $this->lang->line('Purchase Order') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a class="dropdown-item" href="<?= base_url(); ?>purchase/create"
                                                         data-toggle="dropdown"> <?php echo $this->lang->line('New Order'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>purchase"><?= $this->lang->line('Manage Orders'); ?></a>
                                </li>


                            </ul>
                        </li>

                        <li class="menu-item"><a href="#"><i
                                        class="icon-puzzle"></i> <?php echo $this->lang->line('Stock Return') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?= base_url(); ?>stockreturn"> <?php echo $this->lang->line('SuppliersRecords'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>stockreturn/customer"><?php echo $this->lang->line('CustomersRecords'); ?></a>
                                </li>


                            </ul>
                        </li>
                        <li class="menu-item"><a href="#"><i
                                        class="ft-target"></i><?php echo $this->lang->line('Suppliers') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?= base_url(); ?>supplier/create"><?php echo $this->lang->line('New Supplier'); ?></a>
                                </li>

                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>supplier"><?php echo $this->lang->line('Manage Suppliers'); ?></a>
                            </ul>
                        </li>
                           <li class="menu-item" ><a
                                  href="#"><i
                                        class="fa fa-barcode"></i><?php echo $this->lang->line('ProductsLabel'); ?></a>
                            <ul class="menu-content">


                                <li  class="menu-item"><a href="<?php echo base_url(); ?>products/custom_label"
                                                   ><?php echo $this->lang->line('custom_label'); ?></a></li>
                                  <li  class="menu-item"><a href="<?php echo base_url(); ?>products/standard_label"
                                                ><?php echo $this->lang->line('standard_label'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php }
			}
			else{
				?>
				<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-diamond"></i> <span><?php echo $this->lang->line('Stock') ?></span> &nbsp;
		   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Stock Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
				
<?php			
			}
			            if ($this->aauth->subscribe(15)||$this->aauth->subscribe(16)||$this->aauth->subscribe(17)) {

			
            if ($this->aauth->premission(15)||$this->aauth->premission(16)||$this->aauth->premission(17)) {
                ?>
                <li class="nav-item has-sub <?php if ($this->li_a == "Jobsheet") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-diamond"></i> <span><?php echo $this->lang->line('Jobsheet') ?></span></span></a>
                    <ul class="menu-content">
                        <?php if($this->aauth->premission(15)){ ?>
                        <li class="menu-item"><a href="#"><i
                                        class="fa fa-ticket"></i> <?php echo $this->lang->line('Task Manager') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>jobsheets/create"><?php echo $this->lang->line('Create Task') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>jobsheets"><?php echo $this->lang->line('View Task'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>jobsheets/reports"
                                                    data-toggle="dropdown"><?php echo "Reports"; //echo $this->lang->line('View Task'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($this->aauth->premission(16)){ ?>
                        <li class="menu-item"><a href="#"><i
                                        class="fa fa-ticket"></i> <?php echo $this->lang->line('My Task') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>jobsheets/myjobs"><?php echo $this->lang->line('Task List') ?></a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
<!--
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>clientgroup"><i
                                        class="icon-grid"></i> <?php echo $this->lang->line('Client Groups'); ?></a>
                        </li>
                        <li class="menu-item"><a href="#"><i
                                        class="fa fa-ticket"></i> <?php echo $this->lang->line('Support Tickets') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>tickets/?filter=unsolved"><?php echo $this->lang->line('UnSolved') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>tickets"><?= $this->lang->line('Manage Tickets'); ?></a>
                                </li>
                            </ul>
                        </li>-->

                    </ul>
                </li>

            <?php }
						}
						
						else{
							?>
							<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-diamond"></i> <span><?php echo $this->lang->line('Jobsheet') ?></span> &nbsp;
		   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Jobsheet Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
			
			
						<?php
						}
			if($this->aauth->subscribe(3))
				{
            if ($this->aauth->premission(3)) {
                ?>
                <li class="nav-item has-sub <?php if ($this->li_a == "crm") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-diamond"></i> <span><?php echo $this->lang->line('CRM') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item"><a href="#"><i
                                        class="ft-users"></i> <?php echo $this->lang->line('Clients') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>customers/create"><?php echo $this->lang->line('New Client') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>customers"><?= $this->lang->line('Manage Clients'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>clientgroup"><i
                                        class="icon-grid"></i> <?php echo $this->lang->line('Client Groups'); ?></a>
                        </li>
                        <li class="menu-item"><a href="#"><i
                                        class="fa fa-ticket"></i> <?php echo $this->lang->line('Support Tickets') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>tickets/?filter=unsolved"><?php echo $this->lang->line('UnSolved') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>tickets"><?= $this->lang->line('Manage Tickets'); ?></a>
                                </li>
                            </ul>
                        </li> 

                    </ul>
                </li>
				<?php }}
				else{
				?>	
					
					<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-diamond"></i> <span><?php echo $this->lang->line('CRM') ?></span> &nbsp;
		   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Custom Relationship Management Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
				<?php }
					if($this->aauth->subscribe(29))
				{
			
             if ($this->aauth->premission(29)) {
                ?>
                <li class="nav-item has-sub <?php if ($this->li_a == "filemanager") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="fa fa-folder-o"></i> <span><?php echo $this->lang->line('File Manager') ?></span></a>
                    <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>filemanager"><?php echo $this->lang->line('My Drive') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>filemanager/sharedfolders"><?= $this->lang->line('Shared Folders'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>filemanager/sharedfiles"><?= $this->lang->line('Shared Files'); ?></a>
                                </li>
                        <?php /* temprary hide
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>clientgroup"><i
                                        class="icon-grid"></i> <?php echo $this->lang->line('Client Groups'); ?></a>
                        </li>
                        <li class="menu-item"><a href="#"><i
                                        class="fa fa-ticket"></i> <?php echo $this->lang->line('Support Tickets') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>tickets/?filter=unsolved"><?php echo $this->lang->line('UnSolved') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>tickets"><?= $this->lang->line('Manage Tickets'); ?></a>
                                </li>
                            </ul>
                        </li> */ ?>

                    </ul>
                </li>
				<?php }}
				else{
					?>
					<li class="nav-item"><a href="#"  title="subscripe"><i
                                class="fa fa-folder-o"></i <span><?php echo $this->lang->line('File Manager') ?></span> &nbsp;
 <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('File Manager Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
					
					<?php
			
				}
				if($this->aauth->subscribe(4))
				{
            if ($this->aauth->premission(4)) {
                ?>
                <li class="menu-item  has-sub <?php if ($this->li_a == "project") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-briefcase"></i><span><?= $this->lang->line('Project') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item"><a href="#"><i
                                        class="icon-calendar"></i> <?php echo $this->lang->line('Project Management') ?>
                            </a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>projects/addproject"><?php echo $this->lang->line('New Project') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>projects"><?= $this->lang->line('Manage Projects'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>tools/todo"><i
                                        class="icon-list"></i> <?php echo $this->lang->line('To Do List'); ?></a>
                        </li>

                    </ul>
                </li>
				<?php }}
				else{
				?>
<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-briefcase"></i <span><?php echo $this->lang->line('Project') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Project Module');"  viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		 
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
<?php				
					
					
				}
            if (!$this->aauth->premission(4) && $this->aauth->premission(7)) {
                ?>
                <li class="menu-item has-sub <?php if ($this->li_a == "manager") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-briefcase"></i> <span><?php echo $this->lang->line('Project') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>manager/projects"><i
                                        class="icon-calendar"></i> <?php echo $this->lang->line('Manage Projects'); ?>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>manager/todo"><i
                                        class="icon-list"></i> <?php echo $this->lang->line('To Do List'); ?></a>
                        </li>

                    </ul>
                </li>
            <?php }

			?>

			
			<?php
					if($this->aauth->subscribe(5))
				{
            if ($this->aauth->premission(5)) {
                ?>
                <li class="menu-item  has-sub <?php if ($this->li_a == "accounts") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-calculator"></i><span><?= $this->lang->line('Accounts') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item"><a href="#" data-toggle="dropdown"><i
                                        class="icon-book-open"></i> <?php echo $this->lang->line('Accounts') ?></a>
                            <ul class="menu-content">
                                <li data-menu=""><a href="<?php echo base_url(); ?>accounts"
                                    ><?php echo $this->lang->line('Manage Accounts') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>accounts/balancesheet"><?= $this->lang->line('BalanceSheet'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/accountstatement"><?= $this->lang->line('Account Statements'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="#"><i
                                        class="icon-wallet"></i> <?php echo $this->lang->line('Transactions') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>transactions"><?php echo $this->lang->line('View Transactions') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>transactions/add"><?= $this->lang->line('New Transaction'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>transactions/transfer"><?= $this->lang->line('New Transfer'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>transactions/income"><?= $this->lang->line('Income'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>transactions/expense"><?= $this->lang->line('Expense'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>customers"><?= $this->lang->line('Clients Transactions'); ?></a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="menu-item  has-sub <?php if ($this->li_a == "promo") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-energy"></i> <span><?php echo $this->lang->line('Promo Codes') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item"><a href="#"><i
                                        class="icon-trophy"></i> <?php echo $this->lang->line('Coupons') ?></a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>promo/create"><?php echo $this->lang->line('New Promo') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>promo"><?= $this->lang->line('Manage Promo'); ?></a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </li>

            <?php }
			}
			
			else{
				?>
				<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-calculator"></i <span><?php echo $this->lang->line('Accounts') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Accounts Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
				
				<?php
			}
			if($this->aauth->subscribe(10))
				{
            if ($this->aauth->premission(10)) {
                ?>
                <li class="menu-item  has-sub <?php if ($this->li_a == "data") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-pie-chart"></i>
                        <span><?php echo $this->lang->line('Data & Reports') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>register"><i
                                        class="icon-eyeglasses"></i> <?php echo $this->lang->line('Business Registers'); ?>
                            </a>
                        </li>

                        <li class="menu-item"><a href="#"><i
                                        class="icon-doc"></i> <?php echo $this->lang->line('Statements') ?></a>
                            <ul class="menu-content">

                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/accountstatement"><?= $this->lang->line('Account Statements'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/customerstatement"><?php echo $this->lang->line('Customer_Account_Statements') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/supplierstatement"><?php echo $this->lang->line('Supplier_Account_Statements') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/taxstatement"><?php echo $this->lang->line('TAX_Statements'); ?></a>
                                </li>
                                   <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>pos_invoices/extended"
                                                          data-toggle="dropdown"><?php echo $this->lang->line('ProductSales'); ?></a></li>
                            </ul>
                        </li>

                        <li class="menu-item"><a href="#"><i
                                        class="icon-bar-chart"></i> <?php echo $this->lang->line('Graphical Reports') ?>
                            </a>
                            <ul class="menu-content">

                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>chart/product_cat"><?= $this->lang->line('Product Categories'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>chart/trending_products"><?= $this->lang->line('Trending Products'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>chart/profit"><?= $this->lang->line('Profit'); ?></a>
                                </li>

                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>chart/topcustomers"><?php echo $this->lang->line('Top_Customers') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>chart/incvsexp"><?php echo $this->lang->line('income_vs_expenses') ?></a>
                                </li>

                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>chart/income"><?= $this->lang->line('Income'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>chart/expenses"><?= $this->lang->line('Expenses'); ?></a>


                            </ul>
                        </li>
                        <li class="menu-item"><a href="#"><i
                                        class="icon-bulb"></i> <?php echo $this->lang->line('Summary_Report') ?>
                            </a>
                            <ul class="menu-content">
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/statistics"><?php echo $this->lang->line('Statistics') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/profitstatement"><?= $this->lang->line('Profit'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/incomestatement"><?php echo $this->lang->line('Calculate Income'); ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/expensestatement"><?php echo $this->lang->line('Calculate Expenses') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/sales"><?php echo $this->lang->line('Sales') ?></a>
                                </li>
                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/products"><?php echo $this->lang->line('Products') ?></a>
                                </li>

                                <li class="menu-item"><a
                                            href="<?php echo base_url(); ?>reports/commission"><?= $this->lang->line('Employee'); ?> <?= $this->lang->line('Commission'); ?></a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>
            <?php }
				}
				else
			    {		
			?>
<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-pie-chart"></i <span><?php echo $this->lang->line('Data & Reports') ?></span> &nbsp;
 <svg xmlns="http://www.w3.org/2000/svg" onclick="subscribemessage('Data & Reports Module');" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>

			<?php
				}
					if($this->aauth->subscribe(6))
				{
            if ($this->aauth->premission(6)) {
                ?>
                <li class="menu-item  has-sub <?php if ($this->li_a == "misc") {
                    echo ' open';
                } ?>"><a href="#"><i
                                class="icon-note"></i><span><?php echo $this->lang->line('Miscellaneous') ?></span></a>
                    <ul class="menu-content">
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>tools/notes"><i
                                        class="icon-note"></i> <?php echo $this->lang->line('Notes'); ?></a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>events"><i
                                        class="icon-calendar"></i> <?php echo $this->lang->line('Calendar'); ?></a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo base_url(); ?>tools/documents"><i
                                        class="icon-doc"></i> <?php echo $this->lang->line('Documents'); ?></a>
                        </li>


                    </ul>
                </li>
				<?php }}
				
				else
				{?>
			
			<li class="nav-item"><a href="#" title="subscribe"><i
                                class="icon-note"></i <span><?php echo $this->lang->line('Miscellaneous') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" onclick="subscribemessage('Miscellaneous Module');" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
			
				<?php }
				
					if($this->aauth->subscribe(30))
				{
			            if ($this->aauth->premission(30)) {
                            /*

			?>
			<li class="menu-item"><a href="#"><i
                                         class="icon-basket"></i><?php echo $this->lang->line('invoices') ?></a>
                             <ul class="menu-content">
                                 <li class="menu-item"><a href="<?= base_url(); ?>invoices/create"
                                                          data-toggle="dropdown"><?php echo $this->lang->line('New Invoice'); ?></a>
                                 </li>

                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>invoices"><?php echo $this->lang->line('Manage Invoices'); ?></a>
                                 </li>
                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>invoices/peppol_invoices">Peppol Invoices<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                                 </li>
                             </ul>
                         </li>
				<?php  */ } } 
				else{
					?>
					<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-basket"></i <span><?php echo $this->lang->line('invoices') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Invoices Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
					
					<?php
					
				}
					   
					   ?>
<?php 
					if($this->aauth->subscribe(37))
					{
 if ($this->aauth->premission(37)) 
			{
				?>
                       <li class="menu-item  has-sub <?php if ($this->li_a == "ecommerce") {
                    echo ' open';
                } ?>"><a href="#"><i
                                         class="icon-basket"></i><?php echo $this->lang->line('E-Commerce') ?><?php //echo $this->lang->line('invoices') ?></a>
                             <ul class="menu-content">

                                 
                             <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>ecommerce/analytics"> Analytics<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                                 </li>  
                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>ecommerce/vendors"> Vendors<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                                 </li> 
                                 <li class="menu-item"><a
                                             href="<?php echo base_url(); ?>ecommerce/publishing"> Publishing<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                                 </li>          
                                 
                             </ul>
                         </li>
			<?php }
					}
					else{
			?>
			<li class="nav-item"><a href="#" title="subscripe"><i
                                class="icon-diamond"></i> <span><?php echo $this->lang->line('E-Commerce') ?></span> &nbsp;
		   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('E-Commerce Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
                

				<?php
					}
					if($this->aauth->subscribe(9))
				{


            if ($this->aauth->premission(9)) 
			{
                ?>
                <li class="menu-item  has-sub <?php if ($this->li_a == "emp") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-file-text"></i><span><?php echo $this->lang->line('HRM') ?></span></a>
                <ul class="menu-content">
                    <li class="menu-item"><a href="#"><i
                                    class="ft-users"></i> <?php echo $this->lang->line('Employees') ?></a>
                        <ul class="menu-content">
                            <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee"><?php echo $this->lang->line('Employees') ?></a>
                            </li>
                           <?php /* <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee/permissions"><?= $this->lang->line('Permissions'); ?></a>
                            </li> */ ?>

                            <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee/salaries"><?= $this->lang->line('Salaries'); ?></a>
                            </li>
                            <?php if ($this->aauth->premission(26)) { ?>
                            <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee/attendances"><?= $this->lang->line('Attendance'); ?></a>
                            </li>
                            <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee/attendreport"><?= $this->lang->line('Attendance Report'); ?></a>
                            </li>
                            <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee/attendbreaksetting"><?= $this->lang->line('Break Setting'); ?></a>
                            </li>
                            <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee/attendview"><?= $this->lang->line('Break Status'); ?></a>
                            </li>
                            <?php   }   ?>
                            <li class="menu-item"><a
                                        href="<?php echo base_url(); ?>employee/holidays"><?= $this->lang->line('Holidays'); ?></a>
                            </li>

                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>employee/departments"><i
                                    class="icon-folder"></i> <?php echo $this->lang->line('Departments'); ?></a>
                    </li>
  <li class="menu-item">
                        <a href="<?php echo base_url(); ?>employee/roles"><i
                                    class="icon-folder"></i> <?php echo $this->lang->line('Roles'); ?></a>
                    </li>



                </ul>
			</li>                <?php
			} 
			} 
			else{
				?>
			
			<!-- <li class="nav-item"><a href="#" title="subscripe"><i
                                class="ft-file-text"></i <span><?php // echo $this->lang->line('HRM') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512" onclick="subscribemessage('HRM Module');" > -->
    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>

			<?php }?>
				           <?php 
						   if($this->aauth->subscribe(32))
				{
						   if ($this->aauth->premission(32)) 
						   {
						if ($this->aauth->get_user()->roleid == 2) {
							   ?>

				 <li class="menu-item  has-sub <?php if ($this->li_a == "fwms") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-file-text"></i><span><?php echo "FWMS"; ?></span></a>
							
                <ul class="menu-content">

                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>fwms/fwmsemployees"><i
                                    class=""></i> <?php echo $this->lang->line('Employees'); ?></a>
                    </li>
                     
                </ul>
			</li><?php
						}
						else{
						?>	
						<li class="menu-item  has-sub <?php if ($this->li_a == "fwms") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-file-text"></i><span><?php echo "FWMS"; ?></span></a>
							
                <ul class="menu-content">
                    <li class="menu-item"><a href="<?php echo base_url(); ?>fwms/fwmsclients"><i
                                    class=""></i> <?php echo $this->lang->line('Clients') ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>fwms/fwmsemployees"><i
                                    class=""></i> <?php echo $this->lang->line('Employees'); ?></a>
                    </li>
                        <li class="menu-item">
                        <a href="<?php echo base_url(); ?>fwms/fwmsreport"><i
                                    class=""></i> <?php echo $this->lang->line('Report'); ?></a>
                    </li>


                </ul>
			</li>	
					<?php		
							
							
						}
						
			}
				}
				else{
					?>
					<li class="nav-item"><a href="#" title="subscripe"><i
                                class="ft-file-text"></i <span><?php echo $this->lang->line('FWMS') ?></span> &nbsp;
   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('FWMS Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
				
					<?php
					
				}
					if($this->aauth->subscribe(33))
				{
			 if ($this->aauth->premission(33)) 
			 {
			?>
			
				<li class="menu-item  has-sub <?php if ($this->li_a == "scheduler") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-file-text"></i><span><?php echo "Scheduler"; ?></span></a>
                <ul class="menu-content">
                    <li class="menu-item"><a href="<?php echo base_url(); ?>scheduler/schedule"><i
                                    class=""></i> <?php echo $this->lang->line('Schedule') ?></a>
                    </li>
					<li class="menu-item"><a href="<?php echo base_url(); ?>scheduler/scheduleList"><i
                                    class=""></i> <?php echo $this->lang->line('Schedule List') ?></a>
                    </li>
                   

                </ul>
                </li>
				<?php }}
				else{
					
					?>
							<li class="nav-item"><a href="#" title="subscripe"><i
                                class="ft-file-text"></i <span><?php echo $this->lang->line('Scheduler') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"  onclick="subscribemessage('Scheduler Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
					<?php
				}
			 if($this->aauth->subscribe(34))
				{
			 if ($this->aauth->premission(34)) 
			 {
			 ?>



				   <li class="menu-item  has-sub <?php if ($this->li_a == "asset") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-file-text"></i><span><?php echo $this->lang->line('Asset Management'); ?></span></a>
                <ul class="menu-content">
                    <li class="menu-item"><a href="<?php echo base_url(); ?>asset/assetlist"><i
                                    class=""></i> <?php echo $this->lang->line('View Assets') ?></a>
                    </li>
					   <li class="menu-item">
                        <a href="<?php echo base_url(); ?>asset/asset_history"><i
                                    class=""></i> <?php echo $this->lang->line('Asset History'); ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>asset/assetcategory"><i
                                    class=""></i> <?php echo $this->lang->line('Asset Category'); ?></a>
                    </li>
                      <li class="menu-item">
                        <a href="<?php echo base_url(); ?>asset/assetsubcategory"><i
                                    class=""></i> <?php echo $this->lang->line('Asset Sub Category'); ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>asset/assetStatus"><i
                                    class=""></i> <?php echo $this->lang->line('Asset Status'); ?></a>
                    </li>
                     <li class="menu-item">
                        <a href="<?php echo base_url(); ?>asset/comments"><i
                                    class=""></i> <?php echo $this->lang->line('Comments'); ?></a>
                    </li>

                    </li>  <li class="menu-item">
                        <a href="<?php echo base_url(); ?>asset/printBarcode"><i
                                    class=""></i> <?php echo $this->lang->line('Print Barcode'); ?></a>
                    </li>
                </ul>
			 </li><?php }
				}
				else{
			 ?>
<li class="nav-item"><a href="#" title="subscripe"><i
                                class="ft-file-text"></i <span><?php echo $this->lang->line('Asset') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Asset Management Module');" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
					           <?php
				}
								        	if($this->aauth->subscribe(28))
											{
						   if ($this->aauth->premission(28)) {
							   ?>
							   	<li class="menu-item  has-sub <?php if ($this->li_a == "payroll") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-file-text"></i><span><?php echo "PayRoll"; ?></span></a>
                <ul class="menu-content">
                    <li class="menu-item"><a href="<?php echo base_url(); ?>payroll/settings"><i
                                    class=""></i> <?php echo $this->lang->line('Settings') ?></a>
                    </li>
					  <li class="menu-item">
                        <a href="<?php echo base_url(); ?>payroll/payroll"><i
                                    class=""></i> <?php echo $this->lang->line('Payroll'); ?></a>
                    </li>
                      <li class="menu-item">
                        <a href="<?php echo base_url(); ?>payroll/viewpaySlip"><i
                                    class=""></i> <?php echo $this->lang->line('View Payslips'); ?></a>
                    </li>
<li class="menu-item">
                        <a href="<?php echo base_url(); ?>payroll/payrollReport"><i
                                    class=""></i> <?php echo $this->lang->line('Payroll Report'); ?></a>
                    </li>
                   

                </ul>
                </li>

				<?php
						   }
						   else{
						   if ($this->aauth->premission(27)) {

						   ?>
				    	<li class="menu-item  has-sub <?php if ($this->li_a == "payroll") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-file-text"></i><span><?php echo "PayRoll"; ?></span></a>
                <ul class="menu-content">

                      <li class="menu-item">
                        <a href="<?php echo base_url(); ?>payroll/viewpaySlip"><i
                                    class=""></i> <?php echo $this->lang->line('View Payslips'); ?></a>
                    </li>

                   

                </ul>
                </li>
<?php }
	}
	}
	else{
	?>
	<li class="nav-item"><a href="#" title="subscripe"><i
                                class="ft-file-text"></i <span><?php echo $this->lang->line('Payroll') ?></span> &nbsp;
  <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" onclick="subscribemessage('Payroll Module');"  viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
		  
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
	
	<?php 
}
  ?>

			<?php
			if($this->aauth->subscribe(21))
				{
			if ($this->aauth->premission(21)) {  ?>
            <li class="menu-item  has-sub <?php if ($this->li_a == "expenses") {
                echo ' open';
            } ?>""><a href="#"><i class="fa fa-money"></i><span><?php echo $this->lang->line('Claims') ?></span></a>
            <ul class="menu-content">
                <?php if ($this->aauth->premission(21)) {  ?>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>expenses/add"><?= $this->lang->line('Add Claims'); ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>expenses"><?= $this->lang->line('Claims'); ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>expenses/reports"><?php echo "Reports"; // $this->lang->line('Expenses'); ?></a>
                    </li>
                    
                <?php 
				} 
			}
				
			
				
				if ($this->aauth->premission(22)) {  ?>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>expenses/createcat"><?= $this->lang->line('Add Category'); ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>expenses/categories"><?= $this->lang->line('Category List'); ?></a>
                    </li>
                <?php } 
				
				
				?>
            </ul>
            </li>
                <?php 
				}
				
					else{
				?>
				<li class="nav-item"><a href="#" title="subscripe"><i
                                class="ft-file-text"></i <span><?php echo $this->lang->line('Expenses') ?></span> &nbsp;
   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512" onclick="subscribemessage('Expense Module');" ><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>
                <?php }
				if ($this->aauth->premission(19)) {  ?>
                <li class="menu-item  has-sub <?php if ($this->li_a == "settings") {
                    echo ' open';
                } ?>""><a href="#"><i class="ft-file-text"></i><span><?php echo $this->lang->line('Settings') ?></span></a>
                <ul class="menu-content">
                    <?php if ($this->aauth->premission(20) && ($this->aauth->get_user()->roleid==5)) {  ?>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>employee/permissions"><?= $this->lang->line('Permissions'); ?></a>
                    </li>
                    <?php } ?>
					 <?php if ($this->aauth->premission(20) && ($this->aauth->get_user()->roleid==5)) {  ?>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>dashboard/settings"><?= $this->lang->line('Dashboard Settings'); ?></a>
                    </li>
                    <?php } ?>
						<?php if ($this->aauth->premission(21) && ($this->aauth->get_user()->roleid==5)) {  ?>
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>dashboard/subscribe"><?= $this->lang->line('Subscribe Settings'); ?></a>
                    </li>
                    <?php } ?>
                </ul>
                </li>
            <?php }
            if ($this->aauth->get_user()->roleid > 4) {
                ?>
                     <?php /* temprary hide
                <li class="menu-item   has-sub <?php if ($this->li_a == "export") {
                    echo ' open';
                } ?>""><a href="#"><i
                            class="ft-bar-chart-2"></i>
                    <span><?php echo $this->lang->line('Export_Import'); ?></span></a>
                <ul class="menu-content">
                    <li class="menu-item"><a href="<?php echo base_url(); ?>export/crm"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('Export People Data'); ?>
                        </a>
                    </li>
                    <li class="menu-item"><a href="<?php echo base_url(); ?>export/transactions"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('Export Transactions'); ?>
                        </a></li>
                    <li class="menu-item"><a href="<?php echo base_url(); ?>export/products"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('Export Products'); ?>
                        </a></li>
                    <li><a href="<?php echo base_url(); ?>export/account"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('Account Statements'); ?>
                        </a></li>
                    <li><a href="<?php echo base_url(); ?>export/people_products"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('ProductsAccount Statements'); ?>
                        </a></li>
                    <li><a
                                href="<?php echo base_url(); ?>export/taxstatement"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('Tax_Export'); ?>
                        </a></li>
                    <li><a href="<?php echo base_url(); ?>export/dbexport"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('Database Backup'); ?>
                        </a></li>
                    <li><a href="<?php echo base_url(); ?>import/products"><i
                                    class="fa fa-caret-right"></i></i> <?php echo $this->lang->line('Import Products'); ?>
                        </a></li>
                    <li><a href="<?php echo base_url(); ?>import/customers"><i
                                    class="fa fa-caret-right"></i> <?php echo $this->lang->line('Import Customers'); ?>
                        </a></li>
                    <li class="mt-1"></li>
                </ul>
                </li> */ ?>
            <?php }
            ?>

        <?php 
					if($this->aauth->subscribe(38))
					{
		
		if ($this->aauth->premission(42)) {
?>			
<li class="menu-item  has-sub <?php if ($this->li_a == "digitalmarketing") {
    echo ' open';
} ?>"><a href="#"><i
                            class="icon-basket"></i><?php echo  "Digital Marketing"; // $this->lang->line('E-Commerce') ?><?php //echo $this->lang->line('invoices') ?></a>
                <ul class="menu-content">

                    
                <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/customers_list"> Customers List<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                    </li>  
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/transactional"> Transactional<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                                
                    <ul class="menu-content">
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/transactions/email"><?php echo "Emails"; // $this->lang->line('Attendance'); ?></a>
                    </li>
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/transactions/sms"><?php echo "Sms"; // $this->lang->line('Attendance Report'); ?></a>
                    </li>
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/transactions/whatsapp"><?php echo "Whatsapp"; // $this->lang->line('Break Setting'); ?></a>
                    </li>
                    </ul>
                   
                    
                    </li> 
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/SmsMarketing"> Sms Marketing<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                    <ul class="menu-content">
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/sms_marketing_campaigns"><?php echo "Campaigns"; // $this->lang->line('Attendance'); ?></a>
                    </li>
                    
                    </ul>
                    </li> 
                    
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/EmailMarketing"> Email Marketing<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                    <ul class="menu-content">
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/email_marketing_campaigns"><?php echo "Campaigns"; // $this->lang->line('Attendance'); ?></a>
                    </li>
                    
                    </ul>
                    </li> 

                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/whatsappMarketing"> Whatsapp Marketing<?php //echo $this->lang->line('Peppol Invoices'); ?></a>
                    <ul class="menu-content">
                    <li class="menu-item"><a
                                href="<?php echo base_url(); ?>digitalmarketing/whatsapp_marketing_campaigns"><?php echo "Campaigns"; // $this->lang->line('Attendance'); ?></a>
                    </li>
                    
                    </ul>
                    </li> 
                    
                </ul>
            </li>
		<?php }
					}
					
					else{
		?>

<li class="nav-item"><a href="#" title="subscripe"><i
                                class="ft-file-text"></i <span><?php echo "Digital Marketing"; ?></span> &nbsp;
   <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512" onclick="subscribemessage('Digital Marketing Module');" ><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#dc1853}</style><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg>
	  
		 </a>
			<ul class="menu-content">
</ul>
					</li>

<?php  
					}

?>
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- Horizontal navigation-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Subscription Alert</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="color:red;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="c_body_old"></div>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
<div id="c_body"></div>
<script>
function subscribemessage(val)
{
	var msg="You Are Not Subscribed "+val;
$('#exampleModal').modal('show');
	$(".modal-body").html(msg);
	
}	
	

</script>