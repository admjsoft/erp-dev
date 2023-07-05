$(function() {

      // var base_url = window.location.origin;
      var base_url = window.location.origin+'/BazaarPortalNew';
    
    function DoAfterSaveAction(form_id, after_save_action, data,table_reload='') {
        //alert(table_reload);
        if (after_save_action == 'redirect_to') {
            swal(data.Message, {
                icon: "success",
              }).then(function(){ 
                document.location = data.redirect_to;
                });
            
        } else if (after_save_action == 'reload') {
            
            swal(data.Message, {
                icon: "success",
              }).then(function(){ 
                location.reload();
                });
        } else if (after_save_action == 'modal_close') {
           // alert(data.Message);

            swal(data.Message, {
                icon: "success",
              });

             //alert(form_id);
            //alert($("#" + form_id).closest(".modal"));

             if(form_id == 'add_employee_bonus_details_form')
            {
                $('#bonus').modal('hide');
            }
           
            $("#" + form_id).closest(".modal").find(".btn-close").click();

            

            if(form_id == 'add_employee_details_form' || form_id =='edit_employee_details_form')
            {
                $('#runnerprofile').modal('hide');
            }

        } else {
            //alert(data.Message);
            swal(data.Message, {
                icon: "success",
              });
        }
        //$('#'+form_id)[0].reset();
    //  /   $("#"+form_id)[0].reset();
        //setTimeout(function() { 
        //alert(table_reload);
        if(table_reload != '')
        {
            if(table_reload == 'transports_table' || table_reload == 'fleet_ajax_table' || table_reload == 'customers_ajax_table' || table_reload == 'customers_non_ajax_table' || table_reload == 'employees_active_ajax_table' || table_reload == 'employees_in_active_ajax_table')
            {
                DataTableBind1($("#"+table_reload), true, true);
            }else{
                DataTableBind1($("#"+table_reload), true);
            }
        }
        


        //alert(form_id);
        if(form_id == 'update_transport_pricing_form')
        {
             // reloading tier values
             var fetchUrl = $("#fee_engine_tier_dd").attr("fetchUrl");
             var appendDivId = $("#fee_engine_tier_dd").attr("appendDivId");
             var fetchId = $("#fee_engine_tier_dd").val();
             CallDetailedView1(fetchUrl, fetchId, appendDivId);

        }else if(form_id == 'driver_payengine_details_form'){

            var fetchId = $("#pay_engine_transport_service_dd").val();
            var fetchId2 = $("#pay_engine_job_role_dd").val();            
            var fetchUrl = $("#pay_engine_transport_service_dd").attr("fetchurl");
            var appendDivId = $("#pay_engine_transport_service_dd").attr("appendDivId");            
            CallDetailedView1(fetchUrl, fetchId, appendDivId, fetchId2);
              
        }else if(form_id == 'cart_item_update_form')
        {

            if(form_id == 'cart_item_update_form')
            {
                $('.transport_view_more').click();
            }

            //var selected_row = $('#selected_row_index').val();
           // alert(selected_row);
            //$("#transports_table tr").eq(selected_row).addClass('active');

            var fetchurl = $("#transports_table tbody tr.active td:last span.fetchDetails").attr('fetchurl');
            var fetchId = $("#transports_table tbody tr.active td:last span.fetchDetails").attr('fetchid');
            var appendDivId = $("#transports_table tbody tr.active td:last span.fetchDetails").attr('appenddivid');
            //$("#transports_table tbody tr:first").addClass('active');
            // alert(fetchurl);
            // alert(fetchId);
            // alert(appendDivId);
            CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '');
           
        }else if(form_id == 'add_emp_role_details_form2'){
            DataTableBind1($("#employees_active_ajax_table"), true, true);
            DataTableBind1($("#employees_in_active_ajax_table"), true, true);

        }else if(form_id == 'edit_employee_details_form'){

            var selected_row = $('#selected_row_index').val();
            // alert(selected_row);

           //  alert(table_reload);

            //$("#fleet_ajax_table tr").eq(selected_row).
            if(table_reload == 'employees_active_ajax_table')
            {   
                $("#employees_active_ajax_table tbody").find("tr").eq(selected_row-1).click();

            }else{

                $("#employees_in_active_ajax_table tbody").find("tr").eq(selected_row-1).click();
            }
            
           
        }else if(form_id == 'driver_payengine_attendace_details_form')
        {
                 var fetchId = $("#pay_engine_job_role_dd").val();    
                // if(fetchId != '')
                // {
                var fetchurl = $("#pay_engine_job_role_dd").attr("fetchurl");
                var appendDivId = $("#pay_engine_job_role_dd").attr("appendDivId");
                var fetchId2 = $("#pay_engine_time_slot_dd").val();
            
                // CallDetailedView(fetchUrl, fetchId, appendDivId);
                // return;
                // }

                var formData = { "fetchId": fetchId, "fetchId2": fetchId2 };
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    // async: false,
                    cache: false,
                    success: function(data) {
                        $("#" + appendDivId).html(data.html);
                    }
                });
        }else if(form_id == 'schedule_form'){
            
            var selected_row = $('#selected_row_index').val();
            if(selected_row)    
            {
                var fetchId = selected_row;
                var fetchurl = base_url+'/employees/schedule/get_ajax_schedule_details_by_id';
                var appendDivId = "schedule_item_"+selected_row;
    
                CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '');
            }else{
                
                var schedule_date = $('#calendars').val();
                var fetchurl = base_url+'/employees/schedule/get_ajax_schedule_clone';
                var appendDivId = "accordionExample1";
                
               // CallDetailedView(fetchUrl, fetchId, appendDivId);
               // return;
               // }
        
               var formData = { "fetchId": fetchId, "schedule_date": schedule_date };
               $.ajax({
                   type: "POST",
                   dataType: "json",
                   url: fetchurl,
                   data: formData,
                   // async: false,
                   cache: false,
                   success: function(data) {
                       $("#" + appendDivId).html(data.html);
                   }
               });


               var schedule_date1 = $('#calendars1').val();
               var fetchurl1 = base_url+'/employees/schedule/get_ajax_schedule';
               var appendDivId1 = "accordionExample";
               
              // CallDetailedView(fetchUrl, fetchId, appendDivId);
              // return;
              // }
       
              var formData = { "fetchId": fetchId, "schedule_date": schedule_date1 };
              $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: fetchurl1,
                  data: formData,
                  // async: false,
                  cache: false,
                  success: function(data) {
                      $("#" + appendDivId1).html(data.html);
                  }
              });


               
            }
        

        }else if(form_id == 'door_delivery_form' || form_id == 'curb_slide_pickup_form' || form_id == 'store_pickup_form' ){
            var billing_tab = $('#billing_tab').val();     
            //alert(billing_tab);
            //if(billing_tab)
            var trigger = $('#'+form_id).find('#form_trigger').val();
            $("#delivery_type_block"+billing_tab).find('.pospickup').removeClass('active');
            $("#delivery_type_block"+billing_tab).find('.'+trigger).addClass('active');
            $('#DeliveryType').val('1');
        
        }else if(form_id == 'door_delivery_phone_orders_form' || form_id == 'phone_orders_curb_slide_pickup_form' || form_id == 'phone_orders_store_pickup_form'){
            
            var trigger = $('#'+form_id).find('#form_trigger').val();
            $('.pospickup').removeClass('active');
            $('#'+trigger).addClass('active');
            $('#DeliveryType').val('1');
            

        }else if(form_id == 'segment_form' || form_id == 'sub_segment_form' || form_id == 'add_merchant_location_form1'  ){

            load_profile_score();
        }else if(form_id == 'edit_inventory_item_form1' || form_id == 'edit_inventory_item_form2' || form_id == 'remove_product_history_form'  ){
           if(form_id == 'remove_product_history_form'){
            var item_id = $('#'+form_id).find('#InventoryItemId').val();
           }else{
            var item_id = $('#'+form_id).find('#inventory_item_id').val();
           }
            load_item_quantity(item_id);
        }
        

              
        

        // },1000);

        // var admin_forms = ['add_time_slot_details_form','add_zone_details_form','add_transport_service_details_form','add_transport_add_on_details_form','save_employee_role_details']

        // //var is_admin_form = admin_forms.includes(form_id);
        // if(admin_forms.includes(form_id))
        // { 
        //     $("#" + form_id).find("#admin_approval").val('0');
        // }
        
    }

    $("body").on("submit", ".ajax_form", function(event) {
       // alert('ssss');
        event.preventDefault();
        $(this).find(':input[type=submit]').prop('disabled', true);
        var formData = new FormData($(this)[0]);
        var form_id = $(this).attr("id");
        //alert(form_id);
        var ajax_url = $(this).attr("action");
        var after_save_action = $("#" + form_id).find("#after_save_action").val();
        var table_reload = $("#" + form_id).find("#table_reload").val();
        var approval = $("#" + form_id).find("#admin_approval").val();
        // alert(form_id);
        // alert(table_reload);

        var admin_forms = ['add_time_slot_details_form','edit_time_slot_details_form','add_emp_role_details_form3','cart_item_update_form','add_emp_holiday_shift_details_form','add_emp_holiday_shift_details_form1','add_emp_role_details_form1']


        //var is_admin_form = admin_forms.includes(form_id);
        if(admin_forms.includes(form_id))
        {   
            if(approval != '1')
            {
                $('#admin_approval_form_id').val(form_id);
                $('#admin_approval_modal').modal('show');

            }else{
               
            }
           
            //alert('admin form');

        }else{

            
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false, 
            error: function(jqXHR, textStatus, errorMessage) {},
            success: function(data) {
                if (data.Status == 200) {
                    //alert(after_save_action);
                   
                    $("#"+form_id).find(':input[type=submit]').prop('disabled', false);
                    DoAfterSaveAction(form_id, after_save_action, data, table_reload);
                    
                } else if (data.Status == 500) {
                    //alert(data.Message);
                    $("#"+form_id).find(':input[type=submit]').prop('disabled', false);
                    swal(data.Message, {
                        icon: "error",
                      });
                }
            }
        });
        }

        //DataTableBind1($("#" + table_reload), true);
    });


    
    function DataTableBind1(table_ele, destroy = false,state_save = false,selected_row = false) {
        //table_ele.dataTable().fnClearTable();
        if (destroy) {
            table_ele.dataTable().fnDestroy();
        }
        var table_id = table_ele.attr("id");
        var ajax_url = table_ele.attr("ajax_url");
        var fetchId = '';
        var formData = {};
        var post_parameters = table_ele.attr('post_parameters');
        if (post_parameters !== undefined && post_parameters != '') {
            post_parameters = post_parameters.split(',');
            $(post_parameters).each(function(index, post_parameter) {
                var post_parameter_val = table_ele.attr(post_parameter);
                formData[post_parameter] = post_parameter_val;
            });
        }
        table_ele.DataTable({
            'processing': true,
            'serverSide': true,            
            'stateSave' : state_save,
            'serverMethod': 'post',
            //"aoColumns": [{ "bSortable": false },null,null,null,null,null,null,null],
            'ajax': { 'url': ajax_url, 'data': formData },
            initComplete: function(settings, json) {
                if (table_ele.attr("id") == 'transports_table') {
                    var orders_stats_arr = {
                        orders_count_all: "all_count",
                        orders_count_new: "new_count",
                        orders_count_inprogress: "inprogress_count",
                        orders_count_completed: "completed_count",
                        orders_count_cancelled: "cancelled_count",
                        orders_count_abandoned: "abandoned_count",
                        orders_count_hold: "hod_count",
                        orders_count_assigned : "assigned_count"
                    };
                    jQuery.each(orders_stats_arr, function(ele_id, stat_key) {
                        var stat_val = json.order_stats[stat_key] !== undefined ? json.order_stats[stat_key] : 0;
                        $("#" + ele_id).html(stat_val);
                    });
                } else if (table_ele.attr("id") == 'asset_management_ajax_table') {
                    var sm_stats_arr = { total_sku: "total_sku", active_sku: "active_sku", idle_sku: "idle_sku", out_of_stock_sku: "out_of_stock_sku" };
                    jQuery.each(sm_stats_arr, function(ele_id, stat_key) {
                        var stat_val = json.sm_stats[stat_key] !== undefined ? json.sm_stats[stat_key] : 0;
                        $("#" + ele_id).html(stat_val);
                    });
                } else if (table_ele.attr("id") == 'account_transports_table') {

                    var acc_orders_stats_arr = {
                        acc_orders_count: "acc_orders_count",
                        acc_orders_total_amount: "acc_orders_total_amount",
                        acc_orders_driver_fee: "acc_orders_driver_fee",
                        acc_orders_tax: "acc_orders_tax",
                        acc_orders_fleet_amount: "acc_orders_fleet_amount"
                    };
                    jQuery.each(acc_orders_stats_arr, function(ele_id, stat_key) {
                        var stat_val = json.accounting_stats[stat_key] !== undefined ? json.accounting_stats[stat_key] : 0;
                        if (ele_id != 'acc_orders_count') {
                            $("#" + ele_id).html("$ " + stat_val);
                        } else {
                            $("#" + ele_id).html(stat_val);
                        }

                        //alert(ele_id);
                    });

                } else if (table_ele.attr("id") == 'account_customers_table') {
                    var orders_stats_arr = {
                        orders_count_all: "all_count",
                        orders_count_inprogress: "inprogress_count",
                        orders_count_completed: "completed_count",
                        orders_count_cancelled: "cancelled_count"
                    };
                    jQuery.each(orders_stats_arr, function(ele_id, stat_key) {
                        var stat_val = json.order_stats[stat_key] !== undefined ? json.order_stats[stat_key] : 0;
                        $("#" + ele_id).html(stat_val);
                    });
                }
            }
        });



    //alert('sssss');

    setTimeout(function() {

        if (table_id == 'fleet_ajax_table') {



            if(!state_save)
            {
                var fetchurl = $("#fleet_ajax_table tbody tr:first td:first input.fleet_view").attr('fetchurl');
                var fetchId = $("#fleet_ajax_table tbody tr:first td:first input.fleet_view").attr('fetchid');
                var appendDivId = $("#fleet_ajax_table tbody tr:first td:first input.fleet_view").attr('appenddivid');
                $("#fleet_ajax_table tbody tr:first").addClass('active');
                CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '');
            }else{

                var selected_row = $('#selected_row_index').val();
                //alert(selected_row);
                $("#fleet_ajax_table tr").eq(selected_row).addClass('active');
                    // alert(selected_row)
                    // alert('ddd');
                var fetchurl = $("#fleet_ajax_table tbody tr").eq(selected_row-1).find("td:first input.fleet_view").attr('fetchurl');
                var fetchId = $("#fleet_ajax_table tbody tr").eq(selected_row-1).find("td:first input.fleet_view").attr('fetchid');
                var appendDivId = $("#fleet_ajax_table tbody tr").eq(selected_row-1).find("td:first input.fleet_view").attr('appenddivid');
                //alert(fetchId);
                CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '');

                // var fetchurl = $("#fleet_ajax_table tbody tr:first td:first input.fleet_view").attr('fetchurl');
                // var fetchId = $("#fleet_ajax_table tbody tr:first td:first input.fleet_view").attr('fetchid');
                // var appendDivId = $("#fleet_ajax_table tbody tr:first td:first input.fleet_view").attr('appenddivid');
                // $("#fleet_ajax_table tbody tr:first").addClass('active');
                // CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2 = '');
            }

        }else if(table_id == 'customers_ajax_table'){
            
            var selected_row = $('#selected_row_index').val();
            //alert(selected_row);
            $("#customers_ajax_table tr").eq(selected_row).addClass('active');

            var fetchurl = $("#customers_ajax_table tbody tr").eq(selected_row-1).find("td:first input.customer_view").attr('fetchurl');
            var fetchId = $("#customers_ajax_table tbody tr").eq(selected_row-1).find("td:first input.customer_view").attr('fetchid');
            var appendDivId = $("#customers_ajax_table tbody tr").eq(selected_row-1).find("td:first input.customer_view").attr('appenddivid');
           // $("#customers_ajax_table tbody tr:first").addClass('active');
            CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '');
        
        }else if( table_id == 'customers_non_ajax_table'){

            var selected_row = $('#selected_row_index').val();
            //alert(selected_row);
            $("#customers_non_ajax_table tr").eq(selected_row).addClass('active');

            var fetchurl = $("#customers_non_ajax_table tbody tr").eq(selected_row-1).find("td:first input.customer_view").attr('fetchurl');
            var fetchId = $("#customers_non_ajax_table tbody tr").eq(selected_row-1).find("td:first input.customer_view").attr('fetchid');
            var appendDivId = $("#customers_non_ajax_table tbody tr").eq(selected_row-1).find("td:first input.customer_view").attr('appenddivid');
           // $("#customers_ajax_table tbody tr:first").addClass('active');
            CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '');
        
        }else if( table_id == 'transports_table'){

            var selected_row = $('#selected_row_index').val();
            // alert(selected_row);
             $("#transports_table tr").eq(selected_row).addClass('active');
            
            // $("#customers_ajax_table tbody tr:first").addClass('active');
             
            var fetchurl = $("#transports_table tbody tr").eq(selected_row-1).find("td:last span.fetchDetails").attr('fetchurl');
            var fetchId = $("#transports_table tbody tr").eq(selected_row-1).find("td:last span.fetchDetails").attr('fetchid');
            var appendDivId = $("#transports_table tbody tr").eq(selected_row-1).find("td:last span.fetchDetails").attr('appenddivid');
            //$("#transports_table tbody tr:first").addClass('active');
            // alert(fetchurl);
            // alert(fetchId);
            // alert(appendDivId);
            CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '');


        }           

    }, 1000);
    
}


function CallDetailedView1(fetchurl, fetchId, appendDivId, fetchId2 = '') {
    $("#" + appendDivId).html('');
    var formData = { "fetchId": fetchId, "fetchId2": fetchId2 };
    $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchurl,
        data: formData,
        
        success: function(data) {
            $("#" + appendDivId).html(data.html);
        }
    });
    return;
}

function load_profile_score() {

    var fetchurl = base_url+'/product_catalogue/get_profile_score';
    var formData = { "fetchId": 1 };
    $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchurl,
        data: formData,
        
        success: function(data) {
            $("#profile_score_header").html(data.html);
        }
    });
    return;

    
}

function load_item_quantity(item_id) {

    var fetchurl = base_url+'/product_catalogue/get_item_quantity';
    var formData = { "item_id": item_id };
    $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchurl,
        data: formData,
        
        success: function(data) {
            $("#add_item_quantity_label").html(data.Quantity);
        }
    });
    return;

    
}



});