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
                                                class="ft-arrow-up"><?php echo $analytics[0]['total_sales']; ?></i> </h5>

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
                                                class="ft-arrow-up"></i><?php echo $analytics[0]['total_orders']; ?></h5>
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
                                                class="ft-arrow-up"></i><?php  echo $analytics[0]['total_items']; ?>
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
                                                class="ft-arrow-up"></i><?php echo $analytics[0]['total_tax']; ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>



                <div class="card-content" >
                    <div class="card-body">
                    <!-- <?php if($type == 'POS'){ ?>
                    <?php }else{ ?>
                    <?php } ?> -->
                    <table id="online_invoices" class="table table-striped table-bordered zero-configuration ">
                        <thead>
                            <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th><?php echo $vendor_details[0]['VendorName']." ".$vendor_details[0]['Type']; ?> Sales Price</th>
                            <th>Orders</th>
                            <th>Items</th>
                            <th>Tax</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($analytics[0]["totals"] as $date => $details) { 
                            if($details["orders"] >= 1)
                            {

                            
                            if(isset($details["invoice_ids"]))
                            {
                                $invoice_ids = $details["invoice_ids"];
                                $invoice_date = '';
                            }else{
                                $invoice_ids = '';
                                $invoice_date = $date;
                            }
                            echo '<tr>
                                    <td>' . $i . '</td>
                                    <td>' . $date . '</td>
                                    <td>' . $details["sales"] . '</td>
                                    <td>' . $details["orders"] . ' <a href="javascript:void(0);" class="view_analytics_order" invoice_date="'.$invoice_date.'"  invoice_ids="'.$invoice_ids.'">(View Orders)</a></td>
                                    <td>' . $details["items"] . '</td>
                                    <td>' . $details["tax"] . '</td>
                                </tr>';
                        $i++; }  } ?>
                        </tbody>
                        
                    </table>
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