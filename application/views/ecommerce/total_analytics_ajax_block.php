<div class="card">
    <div class="row">
        <?php 
                        $bg_colors = ['primary','danger','warning','success'];
                        $resultCount = count($platform_sales);
                        $columnClass = '';

                        if ($resultCount === 1) {
                            $columnClass = 'col-md-12';
                        } elseif ($resultCount === 2) {
                            $columnClass = 'col-md-6';
                        } elseif ($resultCount === 3) {
                            $columnClass = 'col-md-4';
                        } elseif ($resultCount >= 4) {
                            $columnClass = 'col-md-3';
                        }
                        ?>
        <?php if(!empty($platform_sales)) $i=0; { foreach($platform_sales as $p_sale){ ?>


        <div class="<?php echo $columnClass; ?>">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center <?php echo "bg-".$bg_colors[$i]; ?> bg-darken-2">
                            <i class="fa fa-shopping-cart text-bold-200  font-large-2 white"></i>
                        </div>
                        <div class="p-1 bg-gradient-x-<?php echo $bg_colors[$i]; ?> white media-body">
                            <h5><?php echo $p_sale['title']; ?><?php // echo $this->lang->line('today_invoices') ?>
                            </h5>
                            <h5 class="text-bold-400 mb-0"><i
                                    class="ft-arrow-up"><?php echo $p_sale['total_sales']; ?></i> </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $i++; }} ?>



    </div>
    <div class="row">
        <div class="col-md-6 text-center">
            <h2>Total : POS Offline Sales <?php echo $offline_sales; ?></h2>
        </div>
        <div class="col-md-6 text-center">
            <h2>Total : Online Sales <?php echo $online_sales; ?></h2>
        </div>
    </div>
</div>