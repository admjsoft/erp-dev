<div class="card">
    <div class="card-body">
        <!-- <h5 class="card-title">Employee Details</h5> -->
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="employee">Current Platform</label>
                    <select class="form-control" id="vendor_type">
                        <!-- <option value="">Select Vendor</option> -->
                        <?php if(!empty($vendors)){ foreach ($vendors as $vendor) { ?>
                        <option value="<?php echo $vendor['Id']; ?>" vendor_name="<?php echo $vendor['VendorName']; ?>"
                            <?php if($vendor['VendorName'] == 'POS'){ echo "selected"; } ?>>
                            <?php echo $vendor['VendorName']." (".$vendor['Type'].") "; ?></option>
                        <?php } } ?>


                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="employee">Start Date</label>
                    <input type="text" name="start_date" id="start_date" class="form-control form-control" data-toggle="datepicker"
                                                autocomplete="off" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="employee">End Date</label>
                    <input type="text" name="end_date" id="end_date" class="form-control form-control" data-toggle="datepicker"
                                                autocomplete="off" />
                </div>
            </div>

            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="submit">&nbsp;</label>
                    <button class="btn btn-primary form-control" id="search">Search</button>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php // echo $this->lang->line('Add New Customer') ?></h4>

            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body" id="analytics_block">
            <div class="card" >
                <div class="row" id="analytics_counts_block">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="media align-items-stretch">
                                    <div class="p-2 text-center bg-primary bg-darken-2">
                                        <i class="fa fa-shopping-cart text-bold-200  font-large-2 white"></i>
                                    </div>
                                    <div class="p-1 bg-gradient-x-primary white media-body">
                                        <h5>Total Sales<?php // echo $this->lang->line('today_invoices') ?></h5>
                                        <h5 class="text-bold-400 mb-0"><i
                                                class="ft-arrow-up"><?php echo $total_sales; ?></i> </h5>

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
                                        <i class="fa fa-shopping-cart font-large-2 white"></i>
                                    </div>
                                    <div class="p-1 bg-gradient-x-danger white media-body">
                                        <h5>Total Orders<?php // $this->lang->line('this_month_invoices') ?></h5>
                                        <h5 class="text-bold-400 mb-0"><i
                                                class="ft-arrow-up"></i><?php echo $total_orders; ?></h5>
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
                                        <i class="fa fa-shopping-basket font-large-2 white"></i>
                                    </div>
                                    <div class="p-1 bg-gradient-x-warning white media-body">
                                        <h5> Total Products<?php // $this->lang->line('today_sales') ?></h5>
                                        <h5 class="text-bold-400 mb-0"><i
                                                class="ft-arrow-up"></i><?php  echo (int)$total_products; ?>
                                        </h5>
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
                                        <i class="fa fa-shopping-basket font-large-2 white"></i>
                                    </div>
                                    <div class="p-1 bg-gradient-x-success white media-body">
                                        <h5>Total Tax <?php // echo $this->lang->line('this_month_sales') ?></h5>
                                        <h5 class="text-bold-400 mb-0"><i
                                                class="ft-arrow-up"></i><?php echo (int)$total_tax; ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>



                <div class="card-content">
                    <div class="card-body">
                    <?php /* ?>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                    href="#tab1" role="tab" aria-selected="true">
                                    Sales<?php // echo $this->lang->line('Billing Address') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2"
                                    role="tab" aria-selected="false">
                                    Products<?php // echo $this->lang->line('Shipping Address') ?></a>
                            </li>
                            <!-- <li class="nav-item">
                                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                       href="#tab4" role="tab"
                                       aria-selected="false">Online Products<?php // echo $this->lang->line('CustomFields') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                       href="#tab3" role="tab"
                                       aria-selected="false">Offline Products<?php // echo $this->lang->line('Other') . ' ' . $this->lang->line('Settings') ?></a>
                                </li> -->

                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-2"><?php echo $this->lang->line('Invoice Date') ?></div>
                                        <div class="col-md-2">
                                            <input type="text" name="online_start_date" id="online_start_date"
                                                class="date30 form-control form-control-sm" autocomplete="off" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="online_end_date" id="online_end_date"
                                                class="form-control form-control-sm" data-toggle="datepicker"
                                                autocomplete="off" />
                                        </div>
                                        <div class="col-md-3">
                                            <select id="online_type_filter" name="online_type_filter">
                                                <option value="">Select Type</option>
                                                <option value="1">Online</option>
                                                <option value="0">Offline</option>
                                            </select>

                                        </div>
                                        <div class="col-md-2">
                                            <input type="button" name="online_search" id="online_search" value="Search"
                                                class="btn btn-info btn-sm" />
                                        </div>


                                    </div>
                                    <hr>
                                    <table id="online_invoices"
                                        class="table table-striped table-bordered zero-configuration ">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('No') ?></th>
                                                <th> #Id</th>
                                                <th><?php echo $this->lang->line('Customer') ?></th>
                                                <!-- <th>Sent Date <?php // echo $this->lang->line('Date') ?></th> -->

                                                <th>Type<?php //  echo $this->lang->line('Status') ?></th>
                                                <th><?php echo $this->lang->line('Amount') ?></th>
                                                <th><?php echo $this->lang->line('Payment') ?></th>
                                                <th><?php echo $this->lang->line('Status') ?></th>
                                                <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><?php echo $this->lang->line('No') ?></th>
                                                <th> #Id</th>
                                                <th><?php echo $this->lang->line('Customer') ?></th>
                                                <!-- <th>Sent Date<?php // echo $this->lang->line('Date') ?></th> -->

                                                <th>Type<?php //  echo $this->lang->line('Status') ?></th>
                                                <th><?php echo $this->lang->line('Amount') ?></th>
                                                <th><?php echo $this->lang->line('Payment') ?></th>
                                                <th><?php echo $this->lang->line('Status') ?></th>
                                                <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab2">



                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-2"><?php echo $this->lang->line('Invoice Date') ?></div>
                                        <div class="col-md-2">
                                            <input type="text" name="products_start_date" id="products_start_date"
                                                class="date30 form-control form-control-sm" autocomplete="off" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="products_end_date" id="products_end_date"
                                                class="form-control form-control-sm" data-toggle="datepicker"
                                                autocomplete="off" />
                                        </div>
                                        <div class="col-md-3">
                                            <select id="products_type_filter" name="products_type_filter">
                                                <option value="">Select Type</option>
                                                <option value="1">Online</option>
                                                <option value="0">Offline</option>
                                            </select>

                                        </div>
                                        <div class="col-md-2">
                                            <input type="button" name="products_search" id="products_search"
                                                value="Search" class="btn btn-info btn-sm" />
                                        </div>

                                    </div>
                                    <hr>
                                    <table id="products_invoices"
                                        class="table table-striped table-bordered zero-configuration ">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('No') ?></th>
                                                <th> #Id</th>
                                                <th>Product Name<?php //echo $this->lang->line('Customer') ?></th>
                                                <!-- <th>Sent Date<?php // echo $this->lang->line('Date') ?></th> -->

                                                <th>Type<?php //  echo $this->lang->line('Status') ?></th>
                                                <th>Quantity<?php // echo $this->lang->line('Amount') ?></th>
                                                <th>Price <?php // echo $this->lang->line('Payment') ?></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><?php echo $this->lang->line('No') ?></th>
                                                <th> #Id</th>
                                                <th>Product Name<?php //echo $this->lang->line('Customer') ?></th>
                                                <!-- <th>Sent Date<?php // echo $this->lang->line('Date') ?></th> -->

                                                <th>Type<?php //  echo $this->lang->line('Status') ?></th>
                                                <th>Quantity<?php // echo $this->lang->line('Amount') ?></th>
                                                <th>Price <?php // echo $this->lang->line('Payment') ?></th>


                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                            </div>
                            <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="base-tab3">

                            </div>
                            <div class="tab-pane show" id="tab4" role="tabpanel" aria-labelledby="base-tab4">

                            </div>
                            
                        </div>
                        <?php */ ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>






<script type="text/javascript">
$(document).ready(function() {


        var start_date = '';
        var end_date = '';
        var vendor_type = $('#vendor_type').val();
        var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
        // alert(start_date);
        // alert(end_date);
        // alert(vendor_type);
       
           // $('#products_invoices').DataTable().destroy();
            //draw_products_data(start_date, end_date);
            $.ajax({

                url: "<?php echo site_url('ecommerce/get_ajax_analytics') ?>",
                type: 'POST',
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    vendor_type: vendor_type,
                    vendor_name: vendor_name
                },
                success: function (resp) {
                    $('#analytics_block').html('');
                    $('#analytics_block').html(resp);
                },
                error: function(resp) {
                //console.log(data);
                    console.log("Error not get emp list")
                }


                });

       

    draw_online_data();

    function draw_online_data(start_date = '', end_date = '') {

        var sale_type = $('#online_type_filter').val();

        $('#online_invoices').DataTable({
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            <?php //datatable_lang();?> 'responsive': true,
            'order': [],
            'ajax': {
                'url': "<?php echo site_url('ecommerce/sales_invoices_ajax_list')?>",
                'type': 'POST',
                'data': {
                    '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                    start_date: start_date,
                    end_date: end_date,
                    'sale_type': sale_type
                }
            },
            'columnDefs': [{
                'targets': [0],
                'orderable': false,
            }, ],
            dom: 'Blfrtip',
            buttons: [{
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6]
                }
            }],
        });
    };

    $('#online_search').click(function() {
        var start_date = $('#online_start_date').val();
        var end_date = $('#online_end_date').val();

        if (start_date != '' && end_date != '') {
            $('#online_invoices').DataTable().destroy();
            draw_online_data(start_date, end_date);
        } else {
            alert("Date range is Required");
        }
    });

    draw_products_data(start_date = '', end_date = '')

    function draw_products_data(start_date = '', end_date = '') {

        //  alert ('ddd');
        var sale_type = $('#products_type_filter').val();

        $('#products_invoices').DataTable({
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            <?php //datatable_lang();?> 'responsive': true,
            'order': [],
            'ajax': {
                'url': "<?php echo site_url('ecommerce/sales_invoices_products_ajax_list')?>",
                'type': 'POST',
                'data': {
                    '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                    start_date: start_date,
                    end_date: end_date,
                    'sale_type': sale_type
                }
            },
            'columnDefs': [{
                'targets': [0],
                'orderable': false,
            }, ],
            dom: 'Blfrtip',
            buttons: [{
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6]
                }
            }],
        });
    };


    $('#search').click(function() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var vendor_type = $('#vendor_type').val();
        var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
        // alert(start_date);
        // alert(end_date);
        // alert(vendor_type);
        if (start_date != '' && end_date != '' && vendor_type != '') {

           // $('#products_invoices').DataTable().destroy();
            //draw_products_data(start_date, end_date);
            $.ajax({

                url: "<?php echo site_url('ecommerce/get_ajax_analytics') ?>",
                type: 'POST',
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    vendor_type: vendor_type,
                    vendor_name: vendor_name
                },
                success: function (resp) {
                    $('#analytics_block').html('');
                    $('#analytics_block').html(resp);
                },
                error: function(resp) {
                //console.log(data);
                    console.log("Error not get emp list")
                }


                });

        } else {
            alert("Date range is Required");
        }
    });

});
</script>