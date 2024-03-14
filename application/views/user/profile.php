<style>
/* Style for the outermost ul */
#modules_block {

    #modules_block {
        list-style-type: none;
        list-style: none;
        padding: 0;
    }

    /* Style for each li element */
    #modules_block li {
        margin: 5px 0;
    }

    /* Style for labels */
    #modules_block label {
        cursor: pointer;
        padding-left: 10px;
        /* Adjust the padding as needed */
    }

    /* Style for checkboxes */
    #modules_block input[type="checkbox"] {
        display: none;
        /* Hide the default checkbox */
    }

    /* Style for the custom checkbox */
    #modules_block input[type="checkbox"]+label::before {
        content: '\25A0';
        /* Unicode character for a square or any other preferred symbol */
        display: inline-block;
        width: 1em;
        height: 1em;
        margin-right: 5px;
        border: 1px solid #ccc;
        background-color: #fff;
        text-align: center;
        vertical-align: middle;
    }

    /* Style for checked custom checkboxes */
    #modules_block input[type="checkbox"]:checked+label::before {
        content: '\2713';
        /* Unicode character for a checkmark or any other preferred symbol */
        background-color: #5bc0de;
        /* Change to your desired checked color */
        color: #fff;
        /* Change to your desired text color for checked items */
        border-color: #5bc0de;
        /* Change to your desired border color for checked items */
    }

    /* Style for nested ul elements */
    #modules_block ul {
        margin-left: 20px;
        /* Adjust the margin for nesting levels */
        padding-left: 0;
    }

    ul,
    li {
        list-style: none !important;
    }

    ul {
        margin: 0 !important;
    }

}
</style>

<?php
if(!empty($employee))
{
	?>
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php
			echo $employee['name'] ?></h5>
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
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-md-4 border-right">


                        <div class="">
                            <img alt="image" class="card-img-top img-fluid"
                                src="<?php echo base_url('userfiles/employee/' . $employee['picture']); ?>">
                        </div>
                        <hr>
                        <div class="">
                            <h4><strong><?php echo $employee['name'] ?></strong></h4>
                            <p><i class="icon-map-marker"></i> <?php echo $employee['city'] ?></p>

                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong><?php echo $this->lang->line('Address') ?>
                                        : </strong><?php echo $employee['address'] ?>
                                </div>

                            </div>
                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong><?php echo $this->lang->line('City') ?>
                                        : </strong><?php echo $employee['city'] ?>
                                </div>

                            </div>

                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong><?php echo $this->lang->line('Country') ?>
                                        : </strong><?php echo $employee['country'] ?>
                                </div>

                            </div>
                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong><?php echo $this->lang->line('PostBox') ?>
                                        : </strong><?php echo $employee['postbox'] ?>
                                </div>

                            </div>
                            <hr>
                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong><?php echo $this->lang->line('Phone') ?></strong>
                                    <?php echo $employee['phone']; ?>
                                </div>

                            </div>
                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong>EMail</strong> <?php echo $employee['email']; ?>
                                </div>

                            </div>
                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong><?php echo $this->lang->line('Salary') ?></strong>
                                    <?php
                                    echo ' ' . amountExchange($employee['salary'], 0, $this->aauth->get_user()->loc); ?>
                                </div>

                            </div>


                        </div>


                    </div>
                    <div class="col-md-8">
                        <div class="card card-block">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="hero-widget well well-sm">
                                            <div class="icon">
                                                <i class="icon-file-text-o"></i>
                                            </div>
                                            <div class="text">


                                            </div>
                                            <div class="options">
                                                <a href="<?php echo base_url('employee/invoices?id=' . $eid) ?>"
                                                    class="btn btn-primary btn-block"><i class="icon-eye"></i>
                                                    <?php echo $this->lang->line('Invoices') ?>
                                                    <?php echo $this->lang->line('View') ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="hero-widget well well-sm">
                                            <div class="icon">
                                                <i class="icon-book"></i>
                                            </div>
                                            <div class="text">


                                            </div>
                                            <div class="options">
                                                <a href="<?php echo base_url('employee/transactions?id=' . $eid) ?>"
                                                    class="btn btn-purple btn-block"><i class="icon-eye"></i>
                                                    <?php echo $this->lang->line('Transactions') ?>
                                                    <?php echo $this->lang->line('View') ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row mb-2">

                                    <div class="col-sm-6">
                                        <div class="hero-widget well well-sm">


                                            <div class="options">
                                                <a href="<?php echo base_url('user/update?id=' . $eid) ?>"
                                                    class="btn btn-info btn-block"><i class="fa fa-user"></i>
                                                    <?php echo $this->lang->line('Edit') ?>
                                                    <?php echo $this->lang->line('Account') ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="hero-widget well well-sm">


                                            <div class="options">
                                                <a href="<?php echo base_url('user/updatepassword?id=' . $eid) ?>"
                                                    class="btn btn-primary btn-block"><i class="fa fa-key"></i>
                                                    <?php echo $this->lang->line('Change Password') ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="hero-widget well well-sm">


                                            <div class="options">
                                                <a href="<?php echo base_url('user/salary?id=' . $eid) ?>"
                                                    class="btn btn-pink btn-block"><i class="fa fa-money"></i>
                                                    <?php echo $this->lang->line('Salary') ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="hero-widget well well-sm">


                                            <p class="text-muted"><?php echo $this->lang->line('Your Signature') ?></p>

                                            <img alt="image" class="card-img-top img-fluid"
                                                src="<?php echo base_url('userfiles/employee_sign/' . $employee['sign']); ?>">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <h3>Module Personalization</h3>
                <div class="row">
                <form method="post" id="data_form" class="form-horizontal">
                    <div class="col-sm-8">


                        <ul class="sidebar mt-3" id="modules_block">
                            <?php
                            // Example list of IDs to be checked
                            //$checkedIds = []; // Replace with your list of IDs
                            $checkedIds = array_column($role_permissions,'id');
                            // Function to display the sidebar recursively
                            function displaySidebar($items, $parentId = null, $checkedIds) {
                                echo '<ul>';
                                foreach ($items as $item) {
                                    if ($item->parent_id == $parentId) {
                                        echo '<li>';
                                        $isChecked = in_array($item->id, $checkedIds) ? 'checked' : '';
                                        echo '<input type="checkbox" id="item_' . $item->id . '" ' . $isChecked . '>';
                                        echo '<label class="ml-1"  for="item_' . $item->id . '">' . $item->title . '</label>';
                                        $hasChildren = false;

                                        // Check if the item has children
                                        foreach ($items as $child) {
                                            if ($child->parent_id == $item->id) {
                                                $hasChildren = true;
                                                break;
                                            }
                                        }

                                        if ($hasChildren) {
                                            displaySidebar($items, $item->id, $checkedIds); // Recursively display children
                                        }
                                        echo '</li>';
                                    }
                                }
                                echo '</ul>';
                            }

                            // Start building and checking the sidebar hierarchy
                            displaySidebar($sidebar_hierarchy, null, $checkedIds);
                            ?>


                        </ul>
                        <!-- <button id="getSelected">Get Selected IDs</button> -->
                        <br>
                        <div class="col-sm-8">
                            <input type="submit" id="submit-data1"
                                class="btn btn-success margin-bottom btn-sm float-right"
                                value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Adding...">
                            <input type="hidden" value="user/update_user_personalized_module" id="action-url">
                            <input type="hidden" value="" name="selected_modules" id="selected_modules">

                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
 }
else
{
?>

<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php
			echo $user->username; ?></h5>
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
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-md-4 border-right">


                        <div class="">
                            <img alt="image" class="card-img-top img-fluid"
                                src="<?php echo base_url('userfiles/employee/' .$user->picture); ?>">
                        </div>
                        <hr>
                        <div class="">
                            <h4><strong><?php echo $user->username; ?></strong></h4>


                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <strong>EMail :</strong> <?php echo $user->email; ?>
                                </div>

                            </div>



                        </div>


                    </div>

                </div>
                <hr>

                <h3>Module Personalization</h3>
                <div class="row">
                <form method="post" id="data_form" class="form-horizontal">
                    <div class="col-sm-8">


                        <ul class="sidebar mt-3" id="modules_block">
                            <?php
                            // Example list of IDs to be checked
                            //$checkedIds = []; // Replace with your list of IDs
                            $checkedIds = array_column($role_permissions,'id');
                            // Function to display the sidebar recursively
                            function displaySidebarA($items, $parentId = null, $checkedIds) {
                                
                                echo '<ul>';
                                foreach ($items as $item) {
                                    if ($item->parent_id == $parentId) {
                                        
                                        echo '<li>';
                                        $isChecked = in_array($item->id, $checkedIds) ? 'checked' : '';
                                        echo '<input type="checkbox" id="item_' . $item->id . '" ' . $isChecked . '>';
                                        echo '<label class="ml-1"  for="item_' . $item->id . '">' . $item->title . '</label>';
                                        $hasChildren = false;

                                        // Check if the item has children
                                        foreach ($items as $child) {
                                            if ($child->parent_id == $item->id) {
                                                $hasChildren = true;
                                                break;
                                            }
                                        }

                                        if ($hasChildren) {
                                            displaySidebarA($items, $item->id, $checkedIds); // Recursively display children
                                        }
                                        echo '</li>';
                                    }
                                }
                                echo '</ul>';
                            }

                            // Start building and checking the sidebar hierarchy
                            displaySidebarA($sidebar_hierarchy, null, $checkedIds);
                            ?>


                        </ul>
                        <!-- <button id="getSelected">Get Selected IDs</button> -->
                        <br>
                        <div class="col-sm-8">
                            <input type="submit" id="submit-data1"
                                class="btn btn-success margin-bottom btn-sm float-right"
                                value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Adding...">
                            <input type="hidden" value="user/update_user_personalized_module" id="action-url">
                            <input type="hidden" value="" name="selected_modules" id="selected_modules">

                        </div>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
}
?>
<script>

$(document).ready(function() {
    // Event delegation for dynamically loaded checkboxes
    $(document).on('change', 'input[type="checkbox"]', function() {
        // Find the child <ul> elements directly under the clicked checkbox
        const childUl = $(this).siblings('ul');

        // Find checkboxes within the child <ul> elements
        const childCheckboxes = childUl.find('input[type="checkbox"][id^="item_"]');

        // Check or uncheck child checkboxes based on the parent checkbox
        childCheckboxes.prop('checked', this.checked);
    });

    // Event delegation for dynamically loaded labels
    $(document).on('click', 'label', function(e) {
        e.preventDefault(); // Prevent the default behavior of the label (clicking affects associated checkbox)

        // Toggle visibility of child <ul> elements (submenus)
        const childUl = $(this).prevAll('input[type="checkbox"]').siblings('ul');
        childUl.toggle();
    });
});
</script>

<script type="text/javascript">
$("#submit-data1").on("click", function(e) {
    


    e.preventDefault();

    const NewselectedIds = [];
    $('input[type="checkbox"]:checked').each(function() {
        const checkboxId = $(this).attr('id').replace('item_', '');
        NewselectedIds.push(checkboxId);
    });
    $('#selected_modules').val(NewselectedIds);

    var o_data = $("#data_form").serialize();
    var action_url = $('#action-url').val();
    addObject1(o_data, action_url);

    function addObject1(action, action_url) {

        jQuery.ajax({

            url: '<?php echo base_url() ?>' + action_url,
            type: 'POST',
            data: action +
                '&<?=$this->security->get_csrf_token_name(); ?>=<?=$this->security->get_csrf_hash(); ?>',
            dataType: 'json',
            success: function(data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " +
                        data
                        .message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success")
                        .fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    location.reload(true);

                    //  $("#data_form").hide();


                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " +
                        data
                        .message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger")
                        .fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    $("#data_form").hide();

                }

            },
            error: function(data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data
                    .message);
                $("#notify").removeClass("alert-success").addClass("alert-warning")
                    .fadeIn();
                $("html, body").scrollTop($("body").offset().top);

            }
        });


    }
});

function getValues(val) {


    $.ajax({
        type: "POST",
        url: baseurl + 'modules/get_role_module_permissions',
        data: {
            roleid: val
        },
        success: function(data) {

            $('#modules_block').html(data);

        }
    });



}

$('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('input').attr('checked', true);
    } else {
        $('input').attr('checked', false);
    }
});
</script>