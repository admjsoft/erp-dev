<div class="content-body">
    <div id="c_body"></div>
    <style>
    .sla-option {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
    }

    .sla-option label {
        margin-right: 30px;
    }
    </style>

    <?php

$task =$this->session->flashdata('task');
//var_dump($task);

if(isset($_SESSION['status'])){
    echo '<div id="notify" class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
    unset($_SESSION['status']);unset($_SESSION['message']);
    } ?>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $this->lang->line('Product Details'); ?> ( POS Offline ) 
            <a
                        href="<?php echo base_url('ecommerce/publishing') ?>"
                        class="btn btn-primary btn-sm rounded ml-2">
                        <?php echo $this->lang->line('Back To Publishing'); ?>
                </a>  
            </h4>


            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <form method="post" class="form-horizontal" enctype="multipart/form-data"
                action="<?php echo base_url();?>/jobsheets/edit_task">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Product Name'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Title"
                                                class="form-control margin-bottom b_input required " name="product name"
                                                id="product_name"
                                                value="<?php echo $product_details[0]['product_name']; ?>">

                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Product price'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Title"
                                                class="form-control margin-bottom b_input required " name="title"
                                                id="regular_price"
                                                value="<?php echo $product_details[0]['ThirdPartyVendorPrice']; ?>">

                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-form-label col-sm-2"
                                            for="product_cat"><?php echo $this->lang->line('Product Category') ?>
                                            </label>

                                        <div class="col-sm-8">
                                            <select name="product_cat" class="form-control" id="product_cat">
                                                <?php
                                            echo '<option value="' . $cat_ware['cid'] . '">' . $cat_ware['catt'] . ' </option>';
                                            foreach ($cat as $row) {
                                                $cid = $row['id'];
                                                $title = $row['title'];
                                                echo "<option value='$cid'>$title</option>";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group row mt-1">
                                            <label class="col-sm-2 col-form-label"
                                                for="sub_cat"><?php echo ""; ?></label>

                                            <div class="col-sm-8">
                                                <select id="sub_cat" name="sub_cat" class="form-control select-box">
                                                    <?= '<option value="' . $cat_sub['id'] . '" selected>' . $cat_sub['title'] . '</option>';


                                    foreach ($cat_sub_list as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                    ?>
                                                </select>


                                            </div>
                                        </div>

                                        <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Description') ?></label>

                                        <div class="col-sm-8">
                                        <textarea placeholder="Description"
                                                class="form-control margin-bottom" id="description" name="product_desc"
                                        ><?php echo $product_details[0]['product_des'] ?></textarea>
                                        </div>
                                    </div>


                                    </div>
                                    <div id="mybutton">
                                        <input type="hidden" value="jobsheets/edit_task" id="action-url">
                                        <input type="hidden" name="product_id"
                                            value="<?php  echo $product_details[0]['pid']; ?>" id="product_id">
                                        <input type="hidden" name="vendor_id" value="<?php  echo $vendor_id; ?>"
                                            id="vendor_id">
                                        <input type="hidden" name="vendor_pricing_id"
                                            value="<?php  echo $vendor_pricing_id; ?>" id="vendor_pricing_id">
                                        <input type="button" id="update_product_btn"
                                            class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                            value="<?php echo $this->lang->line('Update Product'); ?>"
                                            data-loading-text="updating...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {


    $(document).on('click', "#update_product_btn", function(e) {
        e.preventDefault();
        var product_id = $('#product_id').val();
        var product_name = $('#product_name').val();
        var vendor_id = $('#vendor_id').val();
        var regular_price = $('#regular_price').val();
        var vendor_pricing_id = $('#vendor_pricing_id').val();
        var product_cat = $('#product_cat').val();
        var sub_cat = $('#sub_cat').val();
        var description = $('#description').val();

        $.ajax({

            url: "<?php echo site_url('ecommerce/update_product_to_pos') ?>",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id,
                product_name: product_name,
                vendor_id: vendor_id,
                vendor_pricing_id: vendor_pricing_id,
                product_price: regular_price,
                product_cat: product_cat,
                sub_cat: sub_cat,
                description: description
            },
            success: function(data) {
                alert(data.message);
            },
            error: function(data) {
                //console.log(data);
                alert(data.message);
            }


        });


    });

    
    $("#sub_cat").select2();
            $("#product_cat").on('change', function () {
                $("#sub_cat").val('').trigger('change');
                var tips = $('#product_cat').val();
                $("#sub_cat").select2({

                    ajax: {
                        url: baseurl + 'products/sub_cat?id=' + tips,
                        dataType: 'json',
                        type: 'POST',
                        quietMillis: 50,
                        data: function (product) {
                            return {
                                product: product,
                                '<?=$this->security->get_csrf_token_name()?>': crsf_hash
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.title,
                                        id: item.id
                                    }
                                })
                            };
                        },
                    }
                });
            });


});
</script>