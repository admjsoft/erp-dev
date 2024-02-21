<link rel="stylesheet" type="text/css" href="<?php echo base_url('dual_list_assets'); ?>/multi.min.css" />
<script src="<?php echo base_url('dual_list_assets'); ?>/multi.min.js"></script>


<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header" style="background-color : #4DD5E7;">
            <h5><?php echo $this->lang->line('Bulk Payroll') ?></h5>
            <!-- <hr> -->
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">

            <div class="row mr-2">

                <div class="col-12 text-right mt-2">
                    <!-- Small Button -->
                    <a href="<?php echo base_url('payroll/viewpaySlip'); ?>"> <button type="button"
                            class="btn btn-sm btn-primary"><?php echo $this->lang->line('List'); ?> </button></a>
                </div>
            </div>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body" id="card-body">
                <?php
                if(isset($_SESSION['status'])){
                echo '<div class="alert alert-'.$_SESSION['status'].'">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>

                            <div class="message">' .$_SESSION['message']. '</div>
                        </div>';
                unset($_SESSION['status']);unset($_SESSION['message']);
                } ?>


                <div class="container">
                    <div class="form-group row">
                        <!-- MONTH -->

                        <div class="col-sm-6">
                            <label class="col-form-label" for="pay_cat"><?php echo $this->lang->line('Month') ?></label>
                            <select class="form-control" id="monthSlip">
                                <?php
                            // Get the current month (numeric format)
                            $currentMonth = date("n");

                            // Loop through the months and generate the options
                            for ($i = 1; $i <= 12; $i++) {
                                $selected = ($i == $currentMonth) ? 'selected' : '';
                                echo '<option value="' . $i . '" ' . $selected . '>' . date("F", mktime(0, 0, 0, $i, 1)) . '</option>';
                            }
                            ?>
                                <select>

                                    <div class="invalid-feedback">
                                    <?php echo $this->lang->line('Please choose month'); ?>
                                    </div>
                        </div>

                        <!-- YEAR -->

                        <div class="col-sm-6">
                            <label class="col-form-label" for="pay_cat"><?php echo $this->lang->line('Year') ?></label>
                            <select class="form-control" id="yearSlip" name="yearSlip">
                                <?php
                            // Get the current year
                            $currentYear = date("Y");

                            // Loop through the years and generate the options
                            for ($year = $currentYear - 5; $year <= $currentYear + 5; $year++) {
                                $selected = ($year == $currentYear) ? 'selected' : '';
                                echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                            }
                            ?>
                            </select>
                            <div class="invalid-feedback">
                            <?php echo $this->lang->line('Please choose year'); ?>
                            </div>
                        </div>

                    </div>

                    <p>( <?php echo $this->lang->line('List Of Employees From Payroll Settings'); ?> )</p>

                    <form>
                        <select multiple="multiple" name="favorite_fruits" id="fruit_select">
                            <?php
                                foreach ($employee as $row) {
                                    $cid = $row['id'];
                                    $name = $row['name'];
									
                                    echo "<option value='$cid'>$name</option>";
                                }
                                ?>
                        </select>
                    </form>
                    <div class="row mt-5 ">
                        <div class="col-md-6  mx-auto text-center">

                            <button class="form-control btn btn-success text-center" id="fetchButton"><?php echo $this->lang->line('Generate PaySlip'); ?></button>

                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


</br>
</form>
</div>
</div>
</div>
</div>
<script>
var select = document.getElementById("fruit_select");
multi(select, {
    non_selected_header: "Employees",
    selected_header: "Selected Employees"
});
</script>

<script>
$(document).ready(function() {
    $('#fetchButton').on('click', function() {

    // var current_month = document.getElementById("current_month").value;
    // var current_year = document.getElementById("current_year").value;
    var month = document.getElementById("monthSlip").value;
    var yearSlip = document.getElementById("yearSlip").value;
    var currentDate = new Date(); 
    var currentDay = currentDate.getDate(); 
    var current_month = currentDate.getMonth() + 1; // Get current month (Note: January is 0, so add 1)
    var current_year = currentDate.getFullYear();

    if (month >= parseInt(current_month) && yearSlip >= current_year) {
        //$("#proceedPayroll").prop('disabled', true);
            if((month - parseInt(current_month)) <= 1)
            {
                var month_checking = true;
            }else{
                var month_checking = false;
            }
        
    } else {
        var month_checking = false;
        //$("#proceedPayroll").prop('disabled', false);

    }


    if(month_checking)
    {

        if (currentDay < 20) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You wan't to create payslip for future month?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                generate_bulk_payslips();
            }
        })

    }else{
            //month_checking = false;
            generate_bulk_payslips();
        }

    }else{
        Swal.fire({
                        title: "",
                        text: "Selected Month Not Allowed, Please Select Current Month or Next Month",
                        // icon: "error",
                    });
        
    }
    


     

    });
});

function generate_bulk_payslips(){

       // Fetch all data-value attributes from <a> tags with class "item selected"
       var dataValues = $('.selected-wrapper .item.selected').map(function() {
            return $(this).data('value');
        }).get();

        // Log the fetched data-values to the console (you can perform other actions here)
        //console.log(dataValues);

        if (dataValues != '') {

            Swal.fire({
                title: "Processing",
                text: "Tour Request has been Submitted. please wait for Response",
                icon: "",
                showCancelButton: false,
                showConfirmButton: false
            });

            var month = $('#monthSlip').val();
            var year = $('#yearSlip').val();


            $.ajax({

                url: "<?php echo site_url('payroll/bulk_payslip_generation') ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    staffIds: dataValues,
                    month: month,
                    year: year
                },
                success: function(data) {
                    //alert(data.message);
                    if (data.status == '200') {
                        Swal.close();
                        Swal.fire({
                            title: "Success",
                            text: data.message,
                            icon: "success",
                        });
                        location.reload();

                    } else {

                        Swal.close();
                        Swal.fire({
                            title: "",
                            text: data.message,
                            // icon: "error",
                        });

                    }

                },
                error: function(data) {
                    //console.log(data);
                    //alert(data.message);
                }


            });

        }
}
</script>
<script>
// Add your custom function here
function customFunction(selectedId) {

    //alert(selectedId);
    return new Promise(function (resolve, reject) {
    var month = $('#monthSlip').val();
    var year = $('#yearSlip').val();
    var employee = selectedId;
    var result = false;

    $.ajax({

        url: "<?php echo site_url('payroll/verify_payslip') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            employee: employee,
            month: month,
            year: year
        },
        success: function(data) {
            //alert(data.message);
            if (data.status == '200') {
                resolve(true);

            } else {

                
                Swal.fire({
                    title: "",
                    text: data.message,
                    // icon: "error",
                });

                resolve(false);

            }

        },
        error: function(data) {
            resolve(false);
        }


    });
    });
    //return result;
}
</script>