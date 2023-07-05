(function() {
    
    // var base_url = window.location.origin;
    var base_url = window.location.origin+'/BazaarPortal';
    var promotion_ids = new Array();
    var messaging_team_ids = new Array();
    var messaging_cust_ids = new Array();
    var messaging_merchant_ids = new Array();
    var emp_job_ids = new Array();
    
    $.fn.dataTable.ext.errMode = 'none';
    function DataTableBind(table_ele, destroy = false, state_save = false, selected_row='1') {

        //alert(state_save);
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
            //responsive: true,
            'processing': true,
            'serverSide': true,            
            'stateSave' : state_save,
            'serverMethod': 'post',
            // 'responsive': true, 
            'scrollx': false,
            'paging': true,
            //"aoColumns": [{ "bSortable": false },null,null,null,null,null,null,null],
            'ajax': { 'url': ajax_url, 'data': formData },
            initComplete: function(settings, json) {
                //$(this.api().table().container()).find('input').attr('autocomplete', 'off');
                //$(this.api().table().container()).find('input').value('');
                $(this.api().table().container()).find('input[type="search"]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
               
                if (table_ele.attr("id") == 'purchase_orders_table') {
                    var orders_stats_arr = {
                        purchase_orders_count_all: "all_count",
                        purchase_orders_count_new: "new_count",
                        purchase_orders_count_inprogress: "inprogress_count",
                        purchase_orders_count_completed: "completed_count",
                        purchase_orders_count_cancelled: "cancelled_count",
                        purchase_orders_count_abandoned: "abandoned_count",
                        purchase_orders_count_pending: "pending_count",
                        purchase_orders_count_assigned : "assigned_count"
                    };
                    jQuery.each(orders_stats_arr, function(ele_id, stat_key) {
                        var stat_val = json.order_stats[stat_key] !== undefined ? json.order_stats[stat_key] : 0;
                        $("#" + ele_id).html(stat_val);
                    });
                } 



                if (table_id == 'purchase_orders_table') {

                    // alert(state_save);
                    // alert(selected_row);
                    $("#order_view_more_div").html('');

                    if(!state_save)
                    {

                        // var ele = $(this).find(".fetchDetails");
                        // $("#purchase_orders_table").find("tr").removeClass("active");
                        // $(this).addClass("active");

                        var fetchurl = $("#purchase_orders_table tbody tr:first td:last span.fetchDetails").attr('fetchurl');
                        var fetchId = $("#purchase_orders_table tbody tr:first td:last span.fetchDetails").attr('fetchid');
                        var appendDivId = $("#purchase_orders_table tbody tr:first td:last span.fetchDetails").attr('appenddivid');
                        $("#purchase_orders_table tbody tr:first").addClass('active');
                        CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2 = '');
                    }else{
                        $("#purchase_orders_table tbody tr").eq(selected_row).addClass('active');
                        // alert(selected_row);
                        // var selected_row = selected_row-1;
                        var fetchurl = $("#purchase_orders_table tbody tr:eq("+selected_row+") td:last span.fetchDetails").attr('fetchurl');
                        var fetchId = $("#purchase_orders_table tbody tr:eq("+selected_row+") td:last span.fetchDetails").attr('fetchid');
                        var appendDivId = $("#purchase_orders_table tbody tr:eq("+selected_row+") td:last span.fetchDetails").attr('appenddivid');
                        //$("#purchase_orders_table tbody tr:first").addClass('active');
                        CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2 = '');
                        // alert(fetchId);
                        //$("#purchase_orders_table tr").eq(selected_row).click();
                        //selected_row
                    }
                  
                } else if (table_id == 'retailers_ajax_table') {
    
                    var fetchurl = $("#retailers_ajax_table tbody tr:first td:first input.retailer_quick_view").attr('fetchurl');
                    var fetchId = $("#retailers_ajax_table tbody tr:first td:first input.retailer_quick_view").attr('fetchid');
                    var appendDivId = $("#retailers_ajax_table tbody tr:first td:first input.retailer_quick_view").attr('appenddivid');
                    $("#retailers_ajax_table tbody tr:first").addClass('active');
                    CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2 = '');
    
                } else if (table_id == 'employees_active_ajax_table' || table_id == 'employees_in_active_ajax_table' ) {
                    //alert($("#employees_active_ajax_table tr").length);
                    if($('#c_emp_tab').hasClass('active'))
                    {
                        $("#employees_active_ajax_table tbody").find("tr:first").click();
                    }else{
                        $("#employees_in_active_ajax_table tbody").find("tr:first").click();
                    }
                    

                } else if(table_id == 'job_applicants_table'){
                    
                    $("#job_appicant_details_view_more_div").html('');
                    $("#job_applicants_table tbody").find("tr:first").click();
                   
                    
                }else if (table_id == 'pos_customers_ajax_table'){

                    $("#pos_customers_ajax_table tbody").find("tr:first").click();
                   
                    
                }else if (table_id == 'pos_orders_ajax_table'){

                    $("#pos_orders_ajax_table tbody").find("tr:first").click();
                }

                else if(table_id == 'store_management_ajax_table'){
    
                    $("#store_management_ajax_table tbody").find("tr:first").click();
                    
                }

                 else if(table_id == 'new_promotions_table'){
    
                    $("#new_promotions_table tbody").find("tr:first").click();
                    
                }

                else if(table_id == 'promotions_messaging_table'){
    
                    $("#promotions_messaging_table tbody").find("tr:first").click();
                    
                } else if(table_id == 'admin_services_table'){
    
                    $("#promotions_messaging_table tbody").find("tr:first").click();
                    
                }
                
                
            }
        });

    }

  

    if ($('.ajax_data_table').length > 0) {
        $(".ajax_data_table").each(function() {
            DataTableBind($(this));
        });
    }

    function CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2 = '') {
        $("#" + appendDivId).html('');

        // if(fetchId != '' && fetchId != 'undefined')
        // {
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
        //}
        return;
    }

    $("body").on("change", "#purchase_orders_city_dd", function() {
        event.preventDefault();
        var purchase_orders_city = $(this).val();
        $("#purchase_orders_table").attr("purchase_orders_city", purchase_orders_city);
        DataTableBind($("#purchase_orders_table"), true);
    });

    $("body").on("change", "#purchase_orders_status_dd", function() {
        event.preventDefault();
        var purchase_orders_status = $(this).val();
        $("#purchase_orders_table").attr("purchase_orders_status", purchase_orders_status);
        DataTableBind($("#purchase_orders_table"), true);
    });

  
    $("body").on("click", ".purchase_order_status_filter", function(event) {
        event.preventDefault();
        var purchase_order_status_filter = $(this).attr("filter_value");
        $("#purchase_orders_table").attr("purchase_orders_status", purchase_order_status_filter);
        $('.purchase_order_status_filter').removeClass('active');
        $(this).addClass('active');
        DataTableBind($("#purchase_orders_table"), true);
        return;
    });

    $("body").on("click", ".purchase_orders_date_filter", function() {
        event.preventDefault();
        $(".purchase_orders_date_filter").removeClass('active');
        $("#purchase_orders_daterange").removeClass('active');
        $(this).addClass('active');
        var purchase_orders_date = $(this).val();
        $("#purchase_orders_table").attr("purchase_orders_date", purchase_orders_date);
        DataTableBind($("#purchase_orders_table"), true);
        return;
    });
    
    $("body").on("change", "#purchase_orders_daterange", function(event) {
        event.preventDefault();
        $('.purchase_orders_date_filter').removeClass('active');
        $(this).addClass('active');
        var purchase_orders_daterange = $(this).val();        
        $("#purchase_orders_table").attr("purchase_orders_date", purchase_orders_daterange);       
        DataTableBind($("#purchase_orders_table"), true);
        return;
    });

    // window.load_purchase_orders_table = function load_purchase_orders_table(purchase_orders_daterange,page_load) {
    //     alert(page_load);
    //     if (page_load == false) {
    //         $('.purchase_orders_date_filter').removeClass('active');
    //         $(this).addClass('active');
    //         var purchase_orders_daterange = $(this).val();        
    //         $("#purchase_orders_table").attr("purchase_orders_date", purchase_orders_daterange);       
    //         DataTableBind($("#purchase_orders_table"), true);
    //     }
    // }


    $("body").on("click", "#purchase_orders_table tr", function() {
        event.preventDefault();
        var ele = $(this).find(".fetchDetails");
        $("#purchase_orders_table").find("tr").removeClass("active");
        $(this).addClass("active");
        var slected_row_index = ($('#purchase_orders_table tbody tr').index(this));
        $('#selected_row_index').val(slected_row_index);
        //alert(slected_row_index);
        var fetchurl = ele.attr("fetchUrl");
        var fetchId = ele.attr("fetchId");
        var appendDivId = ele.attr("appendDivId");
        CallDetailedView(fetchurl, fetchId, appendDivId);
        return;
    });


    $("body").on("change", ".order_status_change", function() {


        swal({
            title: "Are you sure?",
            text: "You want to update Transport Status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((result) => {
            
            if (result) {

                event.preventDefault();
                var transport_status = $(this).val();

            //   if(transport_status == 'CancelledByUser')
            //   {

            //     swal("Please Enter Cancellation Comments:",{
            //         content:"input",
            //         buttons: true,
            //         dangerMode: true,
            //         })
            //         .then((comments)=>{

            //             if(comments){

                        
            //                 var status = $(this).val();
            //                 var fetchurl = $(this).attr("fetchurl");
            //                 var fetchId = $(this).attr("fetchId");
            //                 var id = $(this).attr("id");
            //                 var comments = comments;

            //                 var formData = { "fetchId": fetchId, "status": status, "comments": comments };

            //                 $.ajax({
            //                     type: "POST",
            //                     dataType: "json",
            //                     url: fetchurl,
            //                     data: formData,
            //                     cache: false,
            //                     success: function(data) {
            //                         if(data.Status)
            //                         {
                                        
            //                             swal(data.Message, {
            //                                 icon: "success",
            //                             });
                
            //                             var selected_row = $('#selected_row_index').val();
            //                             DataTableBind($("#transports_table"), true, true,selected_row);
                                        
            //                         }else{
            //                             swal(data.Message, {
            //                                 icon: "error",
            //                             });
                
            //                             // $(this).val('');
            //                             //  /alert(id);
            //                             //  $("#"+id).val('');
            //                             //setLastSelected(this);
            //                             // var reload_fetch_url = base_url+"/transports/get_transport_data";
            //                             // var reload_fetchId = $("#transport_vm_id").val();
            //                             // var reload_appendDivId = "transport_view_more_div";
            //                             // CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
                        
            //                         }
                
            //                         var reload_fetch_url = base_url+"/transports/get_transport_data";
            //                         var reload_fetchId = $("#transport_vm_id").val();
            //                         var reload_appendDivId = "transport_view_more_div";
            //                         CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
            //                     }
            //                 });
            //         }else{

            //             var reload_fetch_url = base_url+"/transports/get_transport_data";
            //             var reload_fetchId = $("#transport_vm_id").val();
            //             var reload_appendDivId = "transport_view_more_div";
            //             CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
            //         }
            //         });

            //  }else{
                event.preventDefault();
                var status = $(this).val();
                var fetchurl = $(this).attr("fetchurl");
                var fetchId = $(this).attr("fetchId");
                var id = $(this).attr("id");
                var comments = '';
                var formData = { "fetchId": fetchId, "status": status, "comments": comments  };
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    cache: false,
                    success: function(data) {
                        if(data.Status)
                        {
                            
                            swal(data.Message, {
                                icon: "success",
                              });
    
                            //   var selected_row = $('#selected_row_index').val();
                            //   DataTableBind($("#purchase_orders_table"), true, true,selected_row);
                              
                        }else{
                            swal(data.Message, {
                                icon: "error",
                              });
    
                             // $(this).val('');
                            //  /alert(id);
                            //  $("#"+id).val('');
                            //setLastSelected(this);
                            // var reload_fetch_url = base_url+"/retailers/get_retailer_data";
                            // var reload_fetchId = $("#transport_vm_id").val();
                            // var reload_appendDivId = "transport_view_more_div";
                            // CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
            
                        }
    
                        // var reload_fetch_url = base_url+"/retailers/get_retailer_data";
                        // var reload_fetchId = $("#transport_vm_id").val();
                        // var reload_appendDivId = "transport_view_more_div";
                        // CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
                    }
                });
    
             // }  
             var selected_row = $('#selected_row_index').val();
             DataTableBind($("#purchase_orders_table"), true, true,selected_row);


        }else{

            swal("Transport Status Not Changed", {
                icon: "error",
              });
            
             // setLastSelected(this);
                var reload_fetch_url = base_url+"/transports/get_transport_data";
                var reload_fetchId = $("#transport_vm_id").val();
                var reload_appendDivId = "transport_view_more_div";
                CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);

        }
          });
        });
    // Yuvraj employee module code start//

    $("body").on("click", ".employees_date_filter", function() {
        event.preventDefault();
        $(".employees_date_filter").removeClass('active');
        $("#employees_daterange").removeClass('active');
        $(this).addClass('active');
        var employees_date = $(this).val();
        $("#employees_active_ajax_table").attr("join_date", employees_date);
        $("#employees_in_active_ajax_table").attr("join_date", employees_date);
        DataTableBind($("#employees_active_ajax_table"), true);        
        DataTableBind($("#employees_in_active_ajax_table"), true);
        return;
    });
    
    $("body").on("change", "#employees_daterange", function(event) {
        event.preventDefault();
        $('.employees_date_filter').removeClass('active');
        $(this).addClass('active');
        var employees_daterange = $(this).val();        
        $("#employees_active_ajax_table").attr("join_date", employees_daterange); 
        $("#employees_in_active_ajax_table").attr("join_date", employees_daterange);       
        DataTableBind($("#employees_active_ajax_table"), true);
        DataTableBind($("#employees_in_active_ajax_table"), true);
        return;
    });

    $("body").on("change", "#employee_management_city_dd", function() {
        event.preventDefault();
        var emp_mgm_city = $(this).val();
        $("#employees_active_ajax_table").attr("city_id", emp_mgm_city);
        $("#employees_in_active_ajax_table").attr("city_id", emp_mgm_city);
        DataTableBind($("#employees_active_ajax_table"), true);
        DataTableBind($("#employees_in_active_ajax_table"), true);
    });


    $("body").on("click", "#employees_active_ajax_table tr", function() {
        var ele = $(this).find(".fetchDetails");
        $("#employees_active_ajax_table").find("tr").removeClass("active");
        $(this).addClass("active");
        var fetchUrl = ele.attr("fetchUrl");
        var fetchId = ele.attr("fetchId");
        var appendDivId = ele.attr("appendDivId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);

        setTimeout(function() { 
            $('#DataTables_Table_345').DataTable({ "bSort": false });
         },2000);
        return;
    });

       $("body").on("click", "#employees_in_active_ajax_table tr", function() {
        var ele = $(this).find(".fetchDetails");
        $("#employees_in_active_ajax_table").find("tr").removeClass("active");
        $(this).addClass("active");
        var fetchUrl = ele.attr("fetchUrl");
        var fetchId = ele.attr("fetchId");
        var appendDivId = ele.attr("appendDivId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);

        setTimeout(function() { 
            $('#DataTables_Table_345').DataTable({ "bSort": false });
         },2000);
        return;
    });

       $("body").on("click", ".employee_payout_btn", function() {


    key = $(this).attr('fetchId');
    
    var order_ids =  $('#stmt_order_ids'+key).val();
    var employee_id =  $('#stmt_runner_id'+key).val();
    
    
    $('#payout_txn_order_ids').val('');
    $('#payout_txn_date').val('');
    $('#payout_txn_mode').val('');
    $('#payout_txn_summary').val('');
    $('#payout_txn_id').val('');
    
   
    $('#payout_txn_order_ids').val(order_ids);
    $('#payout_txn_statement_id').val(key);
    $('#payout_txn_employee_id').val(employee_id);
    
    $('#transacationpayout').modal('show');
    
});

    $('#employee_payout_txn_change_btn').click(function(event) {
    event.preventDefault();
    var txn_date = $('#payout_txn_date').val();
    var txn_mode = $('#payout_txn_mode').val();
    var txn_summary = $('#payout_txn_summary').val();
    var txn_id = $('#payout_txn_id').val();
    var order_ids = $('#payout_txn_order_ids').val();
    var payout_txn_statement_id = $('#payout_txn_statement_id').val();
    var employee_id = $('#payout_txn_employee_id').val();
    
    
    var fetchUrl = $(this).attr('fetchurl'); 
    if(txn_date != '' && txn_mode != '' && txn_summary != '' && txn_id != '' && payout_txn_statement_id != '')
    {
        $.ajax({
            type: "POST",
            url: fetchUrl,
            data: {
            txn_date: txn_date,
            txn_mode: txn_mode,
            txn_summary: txn_summary,
            txn_id: txn_id,
            order_ids: order_ids,
            payout_txn_statement_id : payout_txn_statement_id
    
            },
            success: function(data) {
    
            if (data) {
    
                $('#transacationpayout').modal('hide');
    
                //alert('transactions Statement updated Succesfully');
                swal('Transactions Statement Updated Succesfully', {
                icon: "success",
                
                 });

                var txn_fetch_url = base_url+'/employees/get_employee_statements';
        
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: txn_fetch_url,
                    data: {
                    employee_id : employee_id
                    },
                    success: function(data) {
            
                    if (data.status) {
                        
                        $('#employee_statements_table_block').html('');
                        $('#employee_statements_table_block').html(data.html);
                        $('#DataTables_Table_345').DataTable({ "bSort": false });
                
            
                    }
            
                    }
                });

               
    
            }else{
                //alert('transactions Statement update failed');
                swal('Transactions Statement Update Failed', {
                icon: "error",
            });
            }
    
            }
        });
    }else{
        swal('Please Enter All Fields', {
            icon: "error",
        });
    }
   
    

  });

    $("body").on("click", ".opnebonusmodal", function() {
                var fetchId = $(this).attr("fetchid");
                var modal = $(this).attr("data-bs-target");
                var fetchUrl = $(this).attr("fetchurl");
                var appendDivId = $(this).attr("appendDivId");
                
                CallDetailedView(fetchUrl, fetchId, appendDivId);

                $(modal).modal('show');
                
            });

    $("body").on("change", ".employee_txn_statement_option", function() {
                event.preventDefault();
                 var fetchUrl = base_url+'/employees/send_employee_statement';
                // var appendDivId = $(this).attr("data-bs-target");


                var statement_dd = $(this).val();
                var myArray = statement_dd.split("_");

                var statement_type  = myArray[0];
                var statement_id  = myArray[1];
                var statement_start_date = $("#stmt_start_date"+statement_id).val();
                var statement_end_date = $("#stmt_end_date"+statement_id).val();
                var statement_order_ids = $("#stmt_order_ids"+statement_id).val();
                var statement_runner_id = $("#stmt_runner_id"+statement_id).val();

                // alert(statement_type);
                // alert(statement_id);
                // alert(statement_start_date);
                // alert(statement_end_date);
                // alert(statement_order_ids);
                // alert(statement_customer_id);
                if(statement_type != '')
                {
                    var formData = { "statement_type": statement_type, "statement_id": statement_id, "statement_start_date": statement_start_date, "statement_end_date": statement_end_date, "statement_order_ids": statement_order_ids, "statement_runner_id": statement_runner_id  };
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: fetchUrl,
                        data: formData,
                        cache: false,
                        success: function(data) {
                        if(statement_type == 'email' || statement_type == 'emailaccounting')
                        {
                            //alert('Statement Mailed Successfully');
                            
                            swal('Statement Mailed Successfully', {
                                icon: "success",
                            });
                        }else{
                            // var pdf_url = base_url+'/uploads/firstcaretrasport_intelmor_invoice.pdf';
                            // //location.replace(pdf_url);
                            // window.open(pdf_url, '_blank');

                            swal('Statement Generated Successfully', {
                                icon: "success",
                            });

                            var pdf_url = data.pdf_url;
                            //location.replace(pdf_url);
                            window.open(pdf_url, '_blank');

                        }
            
                        }
                    });
                }
                
                return;
            });

    $("body").on("click", ".emp_disable_btn", function(e) {
            var emp_id = $('#EmployeeId').val();
            $('#flexSwitchCheckDefault'+emp_id).prop('checked', true);
            $('#empstatus').modal('hide');
        });


     $("body").on("change", ".employee_status_change", function(e) {
            // /event.preventDefault();
            // var checked = $(this).attr("checked");
            var fetchurl2 = $(this).attr("fetchurl");
            // StatusChangeCall($(this));
            // return false;
            if(e.target.checked){
               

                StatusChangeCall($(this));


              }else{

               // alert('ssss');
                var employee_id = $(this).attr("fetchid");
                $('#EmployeeId').val(employee_id);
                $('#empstatus').modal('show');

              }

              DataTableBind($("#employees_active_ajax_table"), true, true);
              DataTableBind($("#employees_in_active_ajax_table"), true, true);
              

        });

        
        $("body").on("click", "#c_emp_tab", function() {
            $("#employees_active_ajax_table tbody").find("tr:first").click();
        });
        $("body").on("click", "#p_emp_tab", function() {
            $("#employees_in_active_ajax_table tbody").find("tr:first").click();
        });


        //job applicants code

    $("body").on("change", "#job_applicants_city_dd", function(event) {
        event.preventDefault();
        var job_applicants_city = $(this).val();
        $("#job_applicants_table").attr("job_applicants_city", job_applicants_city);
        $('#job_applicants_city_id').val(job_applicants_city);
        DataTableBind($("#job_applicants_table"), true);
    });

    $("body").on("click", ".job_applicants_date_filter", function(event) {
        event.preventDefault();
        $(".job_applicants_date_filter").removeClass('active');
        $("#job_applicants_daterange").removeClass('active');
        $(this).addClass('active');
        var job_applicat_date = $(this).val();
        $("#job_applicants_table").attr("job_applicants_date", job_applicat_date);
        $('#job_applicants_download_date').val(job_applicat_date);
        DataTableBind($("#job_applicants_table"), true);
    });


    $("body").on("change", "#job_applicants_daterange", function(event) {
        event.preventDefault();
        $('.job_applicants_date_filter').removeClass('active');
        $(this).addClass('active');
        var job_applicant_date = $(this).val();        
        $("#job_applicants_table").attr("job_applicants_date", job_applicant_date); 
        $('#job_applicants_download_date').val(job_applicant_date);

        DataTableBind($("#job_applicants_table"), true);
        return;
    });

 


     $("body").on("click", "#job_applicants_table tr", function(event) {
        //event.preventDefault();
        var ele = $(this).find(".fetchDetails");
        $("#job_applicants_table").find("tr").removeClass("active");
        $(this).addClass("active");

        var fetchurl = ele.attr("fetchurl");
        var fetchId = ele.attr("fetchId");
        var appendDivId = ele.attr("appendDivId");
        CallDetailedView(fetchurl, fetchId, appendDivId);
        return;
    });

     $("body").on("click", ".job_applicant_view_more", function() {
        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {

                $(appendDivId).find(".modal-body").html(data.html);
                
            }
        });
    });


    $("body").on("click", "#download_job_applicants_btn", function() {

        $('#download_job_applicants_form').submit();
    });

     //add employee

     $("body").on("change", "#JobRole", function() {
    //event.preventDefault();
    var fetchurl = $(this).attr("fetchurl");
    var appendDivId = $(this).attr("appenddivid");
    var fetchId = $(this).val();
    
    var formData = { "fetchId": fetchId };
    $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchurl,
        data: formData,
        cache: false,
        success: function(data) {
            //alert(data.html);
            //$("#"+appendDivId).val('');
            $("#"+appendDivId).val(data.html);

        }
    });
    return;
});

    $("body").on("click", ".get_single_employee_details", function() {
    event.preventDefault();
    var fetchurl = $(this).attr("fetchurl");
    var appendDivId = $(this).attr("data-bs-target");
    var fetchId = $(this).attr("fetchId");
   
    var formData = { "fetchId": fetchId };
    $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchurl,
        data: formData,
        cache: false,
        success: function(data) {
            $(appendDivId).find('.modal-content').html('');
            $(appendDivId).find('.modal-content').html(data.html);
            $(appendDivId).modal('show');
        }
    });
    return;
});

     $("body").on("click", "#editfields", function() {
           // alert('sssss');
            $(".remdisable").removeAttr('disabled');       
        });

     $("body").on("focusout", "#EmailId", function() {
        $("#UserId").attr("readonly", false);
        var email_id = $('#EmailId').val();
        $('#UserId').val(email_id);
        $("#UserId").attr("readonly", true);
        
    });

    $("body").on("focusout", "#EmpEmailId", function() {
        $("#EmpUserId").attr("readonly", false);
        var email_id = $('#EmpEmailId').val();
        $('#EmpUserId').val(email_id);
        $("#EmpUserId").attr("readonly", true);
        
    });

          $("body").on("click", "#complience_add_btn", function(event) {

          var compliance_file = document.getElementById('compliance_file').files[0];
         
          var compliance_date = $('#compliance_date').val();
          var compliance_name = $('#compliance_name').val();
          var compliance_no = $('#compliance_no').val();

         if(compliance_date != '' && compliance_name != '' && compliance_no != '' && compliance_file != undefined)
          {
            var fetchurl = $(this).attr("fetchurl");
          var fetchid = $(this).attr("fetchid");
          var appenddivid = $(this).attr("appenddivid");
        
            var form_data = new FormData();
            form_data.append("file",compliance_file);
            form_data.append("compliance_date",compliance_date);
            form_data.append("compliance_name",compliance_name);
            form_data.append("compliance_no",compliance_no);
            form_data.append("fetchid",fetchid);
            $.ajax({
              url:fetchurl,
              method:'POST',
              data:form_data,
              dataType: "json",
              contentType:false,
              cache:false,
              processData:false,
              beforeSend:function(){
                //$('#msg').html('Loading......');
              },
              success:function(data){
                 
                $('#'+appenddivid).html(data.html);
                $('#compliance_date').val('');
                $('#compliance_name').val('');
                $('#compliance_no').val('');
                $('#compliance_file').val('');
              }
            });
          }else{

            //alert('Please Enter All Fields');
            swal('Please Enter All Fields', {
                icon: "error",
              });
          } 
          
          });


          $("body").on("click", "#equipment_add_btn", function(event) {

            var equipment_image = document.getElementById('equipment_image').files[0];
           
           
            var equipment_name = $('#equipment_name').val();
            var equipment_no = $('#equipment_no').val();

            if(equipment_name != '' && equipment_no != '' && equipment_image != undefined)
            {

            var fetchurl = $(this).attr("fetchurl");
            var fetchid = $(this).attr("fetchid");
            var appenddivid = $(this).attr("appenddivid");
          
              var form_data = new FormData();
              form_data.append("file",equipment_image);
              form_data.append("equipment_name",equipment_name);
              form_data.append("equipment_no",equipment_no);
              form_data.append("fetchid",fetchid);
              $.ajax({
                url:fetchurl,
                method:'POST',
                data:form_data,
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                  //$('#msg').html('Loading......');
                },
                success:function(data){
                   
                  $('#'+appenddivid).html(data.html);
                  $('#equipment_name').val('');
                  $('#equipment_no').val('');
                  $('#equipment_image').val('');
                }
              });

            }else{

                //alert('Please Enter All Fields');
                swal('Please Enter All Fields', {
                    icon: "error",
                  });
              } 

            });

            $("body").on("click", "#documents_add_btn", function(event) {

            var document_image = document.getElementById('document_image').files[0];
           
           
            var document_name = $('#document_name').val();
            var document_date = $('#document_date').val();

            if(document_name != '' && document_date != '' && document_image != undefined)
            {
            var fetchurl = $(this).attr("fetchurl");
            var fetchid = $(this).attr("fetchid");
            var appenddivid = $(this).attr("appenddivid");
          
              var form_data = new FormData();
              form_data.append("file",document_image);
              form_data.append("document_name",document_name);
              form_data.append("document_date",document_date);
              form_data.append("fetchid",fetchid);
              $.ajax({
                url:fetchurl,
                method:'POST',
                data:form_data,
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                  //$('#msg').html('Loading......');
                },
                success:function(data){
                   
                  $('#'+appenddivid).html(data.html);
                  $('#document_name').val('');
                  $('#document_date').val('');
                  $('#document_image').val('');
                }
              });

            }else{

                //alert('Please Enter All Fields');
                swal('Please Enter All Fields', {
                    icon: "error",
                  });
              } 
            });

        $("body").on("click", "#emp_password_chg_btn", function(event) {

        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var fetchId = $(this).attr("fetchId");
        var key = $(this).attr("key");
        var password = $('#'+key).val();
        if(password != '')
        {
            var formData = { "fetchId" : fetchId, "password" : password };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    if(data.Status == 200)
                    {
                        
                        swal(data.Message, {
                            icon: "success",
                          });
                          $('#'+key).val('');
                          
                          
                    }else{
                        swal(data.Message, {
                            icon: "error",
                          });
                    }

                }
            });
        }else{

            swal('Please Enter Password', {
                icon: "error",
              });

        }
      
        return;

    });

        $("body").on("click", "#complience_add_btn1", function(event) {

            var compliance_file = document.getElementById('compliance_file1').files[0];
           
            var compliance_date = $('#compliance_date1').val();
            var compliance_name = $('#compliance_name1').val();
            var compliance_no = $('#compliance_no1').val();

            if(compliance_date != '' && compliance_name != '' && compliance_no != '' && compliance_file != undefined)
            {

            var fetchurl = $(this).attr("fetchurl");
            var fetchid = $(this).attr("fetchid");
            var appenddivid = $(this).attr("appenddivid");
          
              var form_data = new FormData();
              form_data.append("file",compliance_file);
              form_data.append("compliance_date",compliance_date);
              form_data.append("compliance_name",compliance_name);
              form_data.append("compliance_no",compliance_no);
              form_data.append("fetchid",fetchid);
              $.ajax({
                url:fetchurl,
                method:'POST',
                data:form_data,
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                  //$('#msg').html('Loading......');
                },
                success:function(data){
                   
                  $('#'+appenddivid).html(data.html);
                  $('#compliance_date1').val('');
                  $('#compliance_nam1e').val('');
                  $('#compliance_no1').val('');
                  $('#compliance_file1').val('');
                }
              });

            }else{

                //alert('Please Enter All Fields');
                swal('Please Enter All Fields', {
                    icon: "error",
                  });
              } 

            });

        $("body").on("click", "#equipment_add_btn1", function(event) {

                var equipment_image = document.getElementById('equipment_image1').files[0];
               
               
                var equipment_name = $('#equipment_name1').val();
                var equipment_no = $('#equipment_no1').val();

                if(equipment_name != '' && equipment_no != '' && equipment_image != undefined)
                {

                    
                var fetchurl = $(this).attr("fetchurl");
                var fetchid = $(this).attr("fetchid");
                var appenddivid = $(this).attr("appenddivid");
              
                  var form_data = new FormData();
                  form_data.append("file",equipment_image);
                  form_data.append("equipment_name",equipment_name);
                  form_data.append("equipment_no",equipment_no);
                  form_data.append("fetchid",fetchid);
                  $.ajax({
                    url:fetchurl,
                    method:'POST',
                    data:form_data,
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend:function(){
                      //$('#msg').html('Loading......');
                    },
                    success:function(data){
                       
                      $('#'+appenddivid).html(data.html);
                      $('#equipment_name1').val('');
                      $('#equipment_no1').val('');
                      $('#equipment_image1').val('');
                    }
                  });

                }else{

                    //alert('Please Enter All Fields');
                    swal('Please Enter All Fields', {
                        icon: "error",
                      });
                  } 

                });

        $("body").on("click", "#documents_add_btn1", function(event) {

                var document_image = document.getElementById('document_image1').files[0];
               
               
                var document_name = $('#document_name1').val();
                var document_date = $('#document_date1').val();

                if(document_name != '' && document_date != '' && document_image != undefined)
            {

                var fetchurl = $(this).attr("fetchurl");
                var fetchid = $(this).attr("fetchid");
                var appenddivid = $(this).attr("appenddivid");
              
                  var form_data = new FormData();
                  form_data.append("file",document_image);
                  form_data.append("document_name",document_name);
                  form_data.append("document_date",document_date);
                  form_data.append("fetchid",fetchid);
                  $.ajax({
                    url:fetchurl,
                    method:'POST',
                    data:form_data,
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend:function(){
                      //$('#msg').html('Loading......');
                    },
                    success:function(data){
                       
                      $('#'+appenddivid).html(data.html);
                      $('#document_name1').val('');
                      $('#document_date1').val('');
                      $('#document_image1').val('');
                    }
                  });

                }else{

                    //alert('Please Enter All Fields');
                    swal('Please Enter All Fields', {
                        icon: "error",
                      });
                  } 
                });


        //Order view more modal
         $("body").on("click", "#edit-pickup-details", function() {
         $(".pickup-field").show();
          $("#edit-pickup-details-submit").show();
          $(".pickup-details-hide").hide();
          $("#edit-pickup-details").hide();
         });

         $("body").on("click", "#edit-dropoff-details", function() {
         $(".dropoff-field").show();
         $("#edit-dropoff-details-submit").show();
         $(".dropoff-details-hide").hide();
         $("#edit-dropoff-details").hide();
         });

         $("body").on("click", "#edit-retailers-details", function() {
         $(".retailers-field").show();
         $("#edit-retailers-details-submit").show();
         $(".retailers-details-hide").hide();
         $("#edit-retailers-details").hide();
         });

        $("body").on("click", ".order_view_more", function(event) {
        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {
                $(appendDivId).find('.modal-content').html(data.html);

            }
        });
        return;
    });

    $("body").on("click", "#edit-pickup-details-submit", function(event) {
    event.preventDefault();
    var PickupName = $('#PickupName').val();
    var PickupPhoneNumber = $('#PickupPhoneNumber').val();
    var PickupAddress = $('#PickupAddress').val();
    var order_id = $('#order_id').val();
    var fetchUrl = $(this).attr('fetchurl'); 
   
    if(PickupName != '' && PickupPhoneNumber != '' && PickupAddress != '' && order_id != '')
    {
   
        $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchUrl,
        data: {
            PickupName: PickupName,
            PickupPhoneNumber: PickupPhoneNumber,
            PickupAddress: PickupAddress,
            order_id: order_id
        },
        success: function(data) {

            if (data) {

                swal(data.Message, {
                icon: "success",
                });

                $("#PickUpDetails").html(data.html);

                $(".pickup-field").hide();
                $("#edit-pickup-details-submit").hide();
                $(".pickup-details-hide").show();
                $("#edit-pickup-details").show();

            }else{
                 swal(data.Message, {
                icon: "error",
                });
            }

        }
        });
    }else{
        
        swal('Please Enter All Fields', {
                        icon: "error",
                      });
    }

});


    $("body").on("click", "#edit-dropoff-details-submit", function(event) {
    event.preventDefault();
    var DropoffName = $('#DropoffName').val();
    var DropoffPhoneNumber = $('#DropoffPhoneNumber').val();
    var DropoffAddress = $('#DropoffAddress').val();
    var order_id = $('#order_id').val();
    var fetchUrl = $(this).attr('fetchurl'); 
   
    if(DropoffName != '' && DropoffPhoneNumber != '' && DropoffAddress != '' && order_id != '')
    {
   
        $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchUrl,
        data: {
            DropoffName: DropoffName,
            DropoffPhoneNumber: DropoffPhoneNumber,
            DropoffAddress: DropoffAddress,
            order_id: order_id
        },
        success: function(data) {

            if (data) {

                swal(data.Message, {
                icon: "success",
                });

                $("#DropOffDetails").html(data.html);

                $(".dropoff-field").hide();
                $("#edit-dropoff-details-submit").hide();
                $(".dropoff-details-hide").show();
                $("#edit-dropoff-details").show();

            }else{
                 swal(data.Message, {
                icon: "error",
                });
            }

        }
        });
    }else{
        
        swal('Please Enter All Fields', {
                        icon: "error",
                      });
    }

});


    $("body").on("click", "#edit-retailers-details-submit", function(event) {
    event.preventDefault();
    var RunnerId = $('#RunnerDetails').val();
    var order_id = $('#order_id').val();
    var fetchUrl = $(this).attr('fetchurl'); 
   
    if(RunnerId != '' && order_id != '')
    {
   
        $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchUrl,
        data: {
            RunnerId: RunnerId,
            order_id: order_id
        },
        success: function(data) {

            if (data) {

                

                $("#EmployeeDetails").html(data.html);

                 $(".retailers-field").hide();
                 $("#edit-retailers-details-submit").hide();
                 $(".retailers-details-hide").show();
                 $("#edit-retailers-details").show();

                 var selected_row = $('#selected_row_index').val();

                 DataTableBind($("#purchase_orders_table"), true, true,selected_row);

                 swal(data.Message, {
                    icon: "success",
                    });

            }else{
                 swal(data.Message, {
                icon: "error",
                });
            }

        }
        });
    }else{
        
        swal('Please Enter All Fields', {
                        icon: "error",
                      });
    }

});

    $("body").on("change", "#RunnerDetails", function() {
    //event.preventDefault();
    var fetchurl = $(this).attr("fetchurl");
    var appendDivId = $(this).attr("appenddivid");
    var fetchId = $(this).val();
    
    var formData = { "fetchId": fetchId };
    $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchurl,
        data: formData,
        cache: false,
        success: function(data) {
            //alert(data.html);
            myArray = data.html.split("-");
            //$("#"+appendDivId).val('');
            $("#DriverName").val(myArray[0]);
            $("#DriverPhoneNumber").val(myArray[1]);
            $("#DriverEmailId").val(myArray[2]);

        }
    });
    return;
});

    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    var eId = $('#addrunner').find('.expiry_date').attr("id");
    //alert(eId);
    $('#compliance_date').attr('min', maxDate);
    $('#document_date').attr('min', maxDate);
    $('#BirthDay').attr('max', maxDate);



    // Yuvraj employee module code end//
    

    // $("body").on("click", "#purchase_orders_table tr", function() {
    //     event.preventDefault();
    //     var ele = $(this).find(".fetchDetails");
    //     $("#purchase_orders_table").find("tr").removeClass("active");
    //     $(this).addClass("active");
    //     var slected_row_index = ($('#purchase_orders_table tr').index(this));
    //     $('#selected_row_index').val(slected_row_index);
    //     var fetchurl = ele.attr("fetchurl");
    //     var fetchId = ele.attr("fetchId");
    //     var appendDivId = ele.attr("appendDivId");
    //     CallDetailedView(fetchurl, fetchId, appendDivId);
    //     return;
    // });



    // $("body").on("click", ".get_transport_messages", function() {
    //     event.preventDefault();
    //     var fetchUrl = $(this).attr("fetchUrl");
    //     var appendDivId = $(this).attr("appendDivId");
    //     var fetchId = $(this).attr("fetchId");
    //     var fetchType = $(this).attr("fetchType");
    //     var modal = $(this).attr("data-bs-target");
    //     var formData = { "fetchId": fetchId, "fetchType" : fetchType };
    //     $.ajax({
    //         type: "POST",
    //         dataType: "json",
    //         url: fetchUrl,
    //         data: formData,
    //         cache: false,
    //         success: function(data) {
    //             $('#'+ appendDivId).html('');
    //             $('#'+ appendDivId).html(data.html);
    //             $(modal).modal('show');
    //         }
    //     });
    //     return;
    // });


  


    // $("body").on("change", ".transport_status_change", function() {


    //     swal({
    //         title: "Are you sure?",
    //         text: "You want to update Transport Status!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //       })
    //       .then((result) => {
            
    //         if (result) {

    //             event.preventDefault();
    //             var transport_status = $(this).val();

    //           if(transport_status == 'Cancelled')
    //           {

    //             swal("Please Enter Cancellation Comments:",{
    //                 content:"input",
    //                 buttons: true,
    //                 dangerMode: true,
    //                 })
    //                 .then((comments)=>{

    //                     if(comments){

                        
    //                         var status = $(this).val();
    //                         var fetchurl = $(this).attr("fetchurl");
    //                         var fetchId = $(this).attr("fetchId");
    //                         var id = $(this).attr("id");
    //                         var comments = comments;

    //                         var formData = { "fetchId": fetchId, "status": status, "comments": comments };

    //                         $.ajax({
    //                             type: "POST",
    //                             dataType: "json",
    //                             url: fetchurl,
    //                             data: formData,
    //                             cache: false,
    //                             success: function(data) {
    //                                 if(data.Status)
    //                                 {
                                        
    //                                     swal(data.Message, {
    //                                         icon: "success",
    //                                     });
                
    //                                     var selected_row = $('#selected_row_index').val();
    //                                     DataTableBind($("#transports_table"), true, true,selected_row);
                                        
    //                                 }else{
    //                                     swal(data.Message, {
    //                                         icon: "error",
    //                                     });
                
    //                                     // $(this).val('');
    //                                     //  /alert(id);
    //                                     //  $("#"+id).val('');
    //                                     //setLastSelected(this);
    //                                     // var reload_fetch_url = base_url+"/transports/get_transport_data";
    //                                     // var reload_fetchId = $("#transport_vm_id").val();
    //                                     // var reload_appendDivId = "transport_view_more_div";
    //                                     // CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
                        
    //                                 }
                
    //                                 var reload_fetch_url = base_url+"/transports/get_transport_data";
    //                                 var reload_fetchId = $("#transport_vm_id").val();
    //                                 var reload_appendDivId = "transport_view_more_div";
    //                                 CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
    //                             }
    //                         });
    //                 }else{

    //                     var reload_fetch_url = base_url+"/transports/get_transport_data";
    //                     var reload_fetchId = $("#transport_vm_id").val();
    //                     var reload_appendDivId = "transport_view_more_div";
    //                     CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
    //                 }
    //                 });

    //           }else{
    //             event.preventDefault();
    //             var status = $(this).val();
    //             var fetchurl = $(this).attr("fetchurl");
    //             var fetchId = $(this).attr("fetchId");
    //             var id = $(this).attr("id");
    //             var comments = '';
    //             var formData = { "fetchId": fetchId, "status": status, "comments": comments  };
    //             $.ajax({
    //                 type: "POST",
    //                 dataType: "json",
    //                 url: fetchurl,
    //                 data: formData,
    //                 cache: false,
    //                 success: function(data) {
    //                     if(data.Status)
    //                     {
                            
    //                         swal(data.Message, {
    //                             icon: "success",
    //                           });
    
    //                           var selected_row = $('#selected_row_index').val();
    //                           DataTableBind($("#transports_table"), true, true,selected_row);
                              
    //                     }else{
    //                         swal(data.Message, {
    //                             icon: "error",
    //                           });
    
    //                          // $(this).val('');
    //                         //  /alert(id);
    //                         //  $("#"+id).val('');
    //                         //setLastSelected(this);
    //                         // var reload_fetch_url = base_url+"/transports/get_transport_data";
    //                         // var reload_fetchId = $("#transport_vm_id").val();
    //                         // var reload_appendDivId = "transport_view_more_div";
    //                         // CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
            
    //                     }
    
    //                     var reload_fetch_url = base_url+"/transports/get_transport_data";
    //                     var reload_fetchId = $("#transport_vm_id").val();
    //                     var reload_appendDivId = "transport_view_more_div";
    //                     CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
    //                 }
    //             });
    
    //           }  
           


    //     }else{

    //         swal("Transport Status Not Changed", {
    //             icon: "error",
    //           });
            
    //          // setLastSelected(this);
    //             var reload_fetch_url = base_url+"/transports/get_transport_data";
    //             var reload_fetchId = $("#transport_vm_id").val();
    //             var reload_appendDivId = "transport_view_more_div";
    //             CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);

    //     }
    //       });
    //     });

 

    // $("body").on("click", ".transport_vm_status_change_opt", function() {
    //     event.preventDefault();
    //     var status = $(this).attr("fetchvalue");
    //     $('#transport_vm_status_change').attr('fetchvalue',status);
    // });


    // $("body").on("click", "#transport_vm_status_change", function() {
    //     event.preventDefault();
        
    //     var fetchurl = $(this).attr("fetchurl");
    //     var status = $(this).attr("fetchvalue");
    //     var fetchId = $(this).attr("fetchId");
    //     var formData = { "fetchId": fetchId, "status": status };
    //     $.ajax({
    //         type: "POST",
    //         dataType: "json",
    //         url: fetchurl,
    //         data: formData,
    //         cache: false,
    //         success: function(data) {
                
    //             // if(data.Status)
    //             // {
    //             //     alert(data.Message);
    //             // }
    //             // $('#dropdownMenuButton1').attr('value', status);

    //             if(data.Status)
    //                 {
                        
    //                     swal(data.Message, {
    //                         icon: "success",
    //                       });
    //                       $('#dropdownMenuButton1vm').html(status);
                          
    //                      // DataTableBind($("#transports_table"), true);
                          
    //                 }else{
    //                     swal(data.Message, {
    //                         icon: "error",
    //                       });
    //                 }

    //         }
    //     });
    //     return;
    // });


    // $("body").on("click", ".transport_view_more", function(event) {
    //     event.preventDefault();
    //     var fetchurl = $(this).attr("fetchurl");
    //     var appendDivId = $(this).attr("data-bs-target");
    //     var fetchId = $(this).attr("fetchId");
        
    //     var formData = { "fetchId": fetchId };
    //     $.ajax({
    //         type: "POST",
    //         dataType: "json",
    //         url: fetchurl,
    //         data: formData,
    //         cache: false,
    //         success: function(data) {
    //             $(appendDivId).find('.modal-content').html('');
    //             $(appendDivId).find('.modal-content').html(data.html);
    //             $(appendDivId).modal('show');
    //             //$('#txn_approve_order_id').value(fetchId);

    //         }
    //     });
    //     return;
    // });

   

    // $("body").on("click", ".transport_details_edit", function(event) {
    //     // event.preventDefault();
    //     // var fetchurl = $(this).attr("fetchurl");
    //     // var appendDivId = $(this).attr("data-bs-target");
    //      var fetchId = $(this).attr("fetchId"); 
    //      var txn_fetchId = $(this).attr("fetchId");
         
    //      $('#TransportOrderId').val(fetchId); 
    //     // var formData = { "fetchId": fetchId };
    //     // $.ajax({
    //     //     type: "POST",
    //     //     dataType: "json",
    //     //     url: fetchurl,
    //     //     data: formData,
    //     //     cache: false,
    //     //     success: function(data) {
    //     //         $(appendDivId).find('.modal-body').html('');
    //     //         $(appendDivId).find('.modal-body').html(data.html);
    //     //         $(appendDivId).modal('show');
    //     //         //$('#txn_approve_order_id').value(fetchId);

    //     //     }
    //     // });
    //     // return;


    //     swal("Please Choose Option Below!...", {
    //         buttons: {
    //           cancel_btn: {
    //             text: "Cancel Transport",
    //             value: "cancel",
    //           },
    //           edit_btn: {
    //             text: "Edit Transport",
    //             value: "edit",
    //           },
    //           default: {
    //             text: "Exit",
    //             value: "default",
    //           },
    //         },
    //       })
    //       .then((value) => {
    //         switch (value) {
           
    //           case "cancel":
                
    //             swal({
    //                 title: "Are you sure?",
    //                 text: "A cancellation fee will apply to any changes. do you still want to continue",
    //                 icon: "warning",
    //                 buttons: true,
    //                 dangerMode: true,
    //               })
    //               .then((result) => {
                    
    //                 if (result) {
                        
                        
    //                     swal("Please Enter Cancellation Comments:",{
    //                         content:"input",
    //                         buttons: true,
    //                         dangerMode: true,
    //                         })
    //                         .then((comments)=>{
    
    //                             if(comments){
    
                                
    //                                // alert('dddddd');
    //                                 //var id = $(this).attr("id");
    //                                 var txn_comments = comments;
    //                                 var txn_fetchurl = base_url+"/transports/transport_status_change";
    //                                 var txn_status = 'Cancelled';

    //                                 var formData = { "fetchId": txn_fetchId, "status": txn_status, "comments": txn_comments };
    
    //                                 $.ajax({
    //                                     type: "POST",
    //                                     dataType: "json",
    //                                     url: txn_fetchurl,
    //                                     data: formData,
    //                                     cache: false,
    //                                     success: function(data) {
    //                                         if(data.Status)
    //                                         {
                                                
    //                                             swal(data.Message, {
    //                                                 icon: "success",
    //                                             });
                        
    //                                             var selected_row = $('#selected_row_index').val();
    //                                             DataTableBind($("#transports_table"), true, true,selected_row);
                                                
    //                                         }else{
    //                                             swal(data.Message, {
    //                                                 icon: "error",
    //                                             });
                        
                                           
    //                                         }
                        
    //                                         var reload_fetch_url = base_url+"/transports/get_transport_data";
    //                                         var reload_fetchId = $("#transport_vm_id").val();
    //                                         var reload_appendDivId = "transport_view_more_div";
    //                                         CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
    //                                     }
    //                                 });
    //                         }else{
    
    //                             var reload_fetch_url = base_url+"/transports/get_transport_data";
    //                             var reload_fetchId = $("#transport_vm_id").val();
    //                             var reload_appendDivId = "transport_view_more_div";
    //                             CallDetailedView(reload_fetch_url, reload_fetchId, reload_appendDivId);
    //                         }
    //                         });
        
        
    //                 }
    
    
    //               });

    //               break;
                
           
    //           case "edit":
               
    //             var fetchId = $(this).attr("fetchId");
    //             $('#TransportOrderId').val(fetchId); 
    //             $('#transport_details_update_form').submit();
    //             break;
           
    //           default:
    //             break;
    //         }
    //       });

    // });

    // $("body").on("click", ".approve_order_transaction", function() {
    //     event.preventDefault();

    //     var fetchId = $(this).attr("fetchId");
    //     $('#txn_approve_order_id').val(fetchId);

    // });


    $("body").on("change", "#retailers_city_dd", function() {
        event.preventDefault();
        var city_filter = $(this).val();
        var table_id = $(this).attr("table_id");
        var append_attr = $(this).attr("append_attr");
        $("#" + table_id).attr(append_attr, city_filter);
        $("#retailers_download_city").val(city_filter);
        DataTableBind($("#" + table_id), true);
    });
    





    /* customers */

    $("body").on("click", "#retailers_ajax_table tr", function() {
        //event.preventDefault();
        var ele = $(this).find(".retailer_quick_view");
        $("#retailers_ajax_table").find("tr").removeClass("active");
        $(this).addClass("active");
        var slected_row_index = ($('#retailers_ajax_table tbody tr').index(this));
        $('#selected_row_index').val(slected_row_index);

        var fetchUrl = ele.attr("fetchUrl");
        var appendDivId = ele.attr("appendDivId");
        var fetchId = ele.attr("fetchId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });


    $("body").on("change", ".retailer_status_change", function() {
        event.preventDefault();
        var status_type = $(this).attr("status_type");
        var fetchurl = $(this).attr("fetchurl");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId, "status_type": status_type };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {

               
            }
        });
        return;
    });

    $("body").on("click", ".retailer_view_more", function() {
        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {

                $(appendDivId).find(".modal-content").html(data.html);
                
            }
        });
        // alert('sss');
        $('#retailer_transactions_ajax_table').DataTable();
       
    });

    $("body").on("click", ".retailer_edit_details", function() {
        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {

                $(appendDivId).find(".modal-content").html(data.html);
                
            }
        });
        // alert('sss');
       
    });

    
    $("body").on("click", ".retailer_transaction_payout_display", function() {

        var fetchurl = $(this).attr("fetchUrl");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            context: this,
            success: function(data) {
                $('#transaction-payout').remove();
                $(data.html).insertAfter($(this).closest('tr'));
            }
        });
        

    });


    $("body").on("click", "#download_retailers_btn", function() {

        $('#download_retailers_form').submit();
    });



    $("body").on("click", "#customer_payout_txn_change_btn", function(event) {
    event.preventDefault();
    var PayOutDate = $('#PayOutDate').val();
    var PayOutMode = $('#PayOutMode').val();
    var PayOutTxnId = $('#PayOutTxnId').val();
    var PayOutTxnSummary = $('#PayOutTxnSummary').val();
    var OrderId = $('#OrderId').val();
    var fetchUrl = $(this).attr('fetchurl'); 
   
    if(PayOutDate != '' && PayOutMode != '' && PayOutTxnId != '' && OrderId != '')
    {
   
        $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchUrl,
        data: {
            PayOutDate: PayOutDate,
            PayOutMode: PayOutMode,
            PayOutTxnId: PayOutTxnId,
            PayOutTxnSummary: PayOutTxnSummary,
            OrderId: OrderId
        },
        success: function(data) {

            if (data) {

                $('#transaction-payout').remove();
                alert(data.Message);

            }else{

                alert(data.Message);
            }

        }
        });
    }else{
        
        alert('Please Enter All Fields');
    }

});



$("body").on("change", ".retailer_transactioion_channel_option", function() {
    event.preventDefault();
     //var fetchUrl = base_url+'/employees/send_employee_statement';
     var fetchUrl = $(this).attr("fetchUrl");


    var statement_dd = $(this).val();
    var myArray = statement_dd.split("_");

    var statement_type  = myArray[0];
    var statement_id  = myArray[1];
    var statement_retailer_id = $("#stmt_retailer_id_"+statement_id).val();

    if(statement_type != '')
    {
        var formData = { "statement_type": statement_type, "order_id": statement_id, "retailer_id": statement_retailer_id };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchUrl,
            data: formData,
            cache: false,
            success: function(data) {
            if(statement_type == 'email' || statement_type == 'emailaccounting')
            {
                //alert('Statement Mailed Successfully');
                
                swal('Statement Mailed Successfully', {
                    icon: "success",
                });
            }else{
                // var pdf_url = base_url+'/uploads/firstcaretrasport_intelmor_invoice.pdf';
                // //location.replace(pdf_url);
                // window.open(pdf_url, '_blank');

                swal('Statement Generated Successfully', {
                    icon: "success",
                });

                var pdf_url = data.pdf_url;
                //location.replace(pdf_url);
                window.open(pdf_url, '_blank');

            }

            }
        });
    }
    
    return;
});

    // $("body").on("click", "#DataTables_Table_1 tr", function() {
    //     //event.preventDefault();
    //     var ele = $(this).find(".customer_stmt_view");
    //     var stmt_txn_table = ele.val();
    //     $('#cust_stmt_txn_table_body').html(stmt_txn_table);
    //     $('#cust_stmt_txn_table_div').removeClass('d-none');
    //     $('#cust_stmt_txn_table').DataTable();
    //     return;
    // });

    // $("body").on("click", "#DataTables_Table_2 tr", function() {
    //     //alert('dddd');
    //     //event.preventDefault();
    //     var ele = $(this).find(".customer_stmt_view");
    //     var stmt_txn_table = ele.val();
    //     //alert(stmt_txn_table);
    //     $('#cust_stmt_txn_table_body1').html(stmt_txn_table);
    //     $('#cust_stmt_txn_table_div1').removeClass('d-none');
    //     $('#cust_stmt_txn_table1').DataTable();
    //     return;
    // });

  
    $("body").delegate("#admin_approval_btn", "click", function(){
    
        var fetchurl = $(this).attr("fetchurl");
        //var form_id = $(this).attr("admin_approval_form_id");
        var secret_key = $('#admin_secret_key').val();
        var formData = { "secret_key": secret_key };
        
        if(secret_key != '')
        {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,                
                success: function(data) {
    
                    if(data.Status == 200)
                    {
                       $('#admin_approval_modal').modal('hide');     
                        // swal(data.Message, {
                        //     icon: "success",
                        //   });

                          var form_id = $("#admin_approval_form_id").val(); 
                        //alert(form_id);
                          //$('#'+form_id).find('#admin_approval').val('1'); 
                        //   var form_class = $('#'+form_id).attr('class'); 
                        //   alert(form_class);
                        //  $("#"+form_id).submit();

                        var formData1 = new FormData($('#'+form_id)[0]);
                        //alert(formData);
                        //var form_id = $('#'+form_id).attr("id");
                        var ajax_url = $('#'+form_id).attr("action");
                        var after_save_action = $("#" + form_id).find("#after_save_action").val();
                        var table_reload = $("#" + form_id).find("#table_reload").val();
                       // alert(table_reload);

                        $.ajax({
                            type: "POST",
                            url: ajax_url,
                            data: formData1,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            error: function(jqXHR, textStatus, errorMessage) {},
                            success: function(data) {
                                if (data.Status == 200) {
                                    
                                    $("#"+form_id).find(':input[type=submit]').prop('disabled', false);
                                    DoAfterSaveAction1(form_id, after_save_action, data, table_reload);
                                } else if (data.Status == 500) {
                                    //alert(data.Message);
                                    $("#"+form_id).find(':input[type=submit]').prop('disabled', false);
                                    swal(data.Message, {
                                        icon: "error",
                                      });
                                }
                            }
                        });   


                          
                    }else{
                        swal(data.Message, {
                            icon: "error",
                          });
                    }
    
                    
    
                }
            });
        }else{
            swal('Please Enter Secret Key', {
                icon: "error",
              });
        }
       
        return;
    });

    function DoAfterSaveAction1(form_id, after_save_action, data,table_reload='') {
        if (after_save_action == 'redirect_to') {
            document.location = data.redirect_to;
        } else if (after_save_action == 'reload') {
            location.reload();
        } else if (after_save_action == 'modal_close') {

            //alert(data.Message);
            swal(data.Message, {
                icon: "success",
              });

            $("#" + form_id).closest(".modal").find(".btn-close").click();
        } else {

            swal(data.Message, {
                icon: "success",
              });
        }


        if(form_id == 'cart_item_update_form')
        {
            $('.transport_view_more').click();
            var fetchurl = $("#transports_table tbody tr.active td:last span.fetchDetails").attr('fetchurl');
            var fetchId = $("#transports_table tbody tr.active td:last span.fetchDetails").attr('fetchid');
            var appendDivId = $("#transports_table tbody tr.active td:last span.fetchDetails").attr('appenddivid');
            //$("#transports_table tbody tr:first").addClass('active');
            // alert(fetchurl);
            // alert(fetchId);
            // alert(appendDivId);
            CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2 = '');
           
        
        }

        $("#"+form_id)[0].reset();
        //setTimeout(function() { 
        //alert(table_reload);
        DataTableBind($("#"+table_reload), true);



        // reloading tier values
        var fetchUrl = $("#fee_engine_tier_dd").attr("fetchUrl");
        var appendDivId = $("#fee_engine_tier_dd").attr("appendDivId");
        var fetchId = $("#fee_engine_tier_dd").val();
        CallDetailedView(fetchUrl, fetchId, appendDivId);

        

    
        
    }

   


    // $("body").on("change", "#cust_address_dd", function() {
    //     event.preventDefault();
    //     var cust_address = $(this).val();
    //     $("#selected_cust_address_block").html(cust_address);
    // });

    // $("body").on("change", ".customer_status_change", function() {
    //     event.preventDefault();
    //     var status_type = $(this).attr("status_type");
    //     var fetchurl = $(this).attr("fetchurl");
    //     var fetchId = $(this).attr("fetchId");
    //     var formData = { "fetchId": fetchId, "status_type": status_type };
    //     $.ajax({
    //         type: "POST",
    //         dataType: "json",
    //         url: fetchurl,
    //         data: formData,
    //         cache: false,
    //         success: function(data) {

    //             if (status_type == 'bill') {
    //                 if ($('#BillableAccount').is(':checked'))
    //                 //  ^
    //                     $('#autoUpdate_bb_account').removeClass('d-none')
    //                 else
    //                     $('#autoUpdate_bb_account').addClass('d-none')

    //             }
    //         }
    //     });
    //     return;
    // });

    

    function StatusChangeCall(ele) {

        var status_type = ele.attr("status_type");
        var fetchurl = ele.attr("fetchurl");
        var fetchId = ele.attr("fetchId");
        var formData = { "fetchId": fetchId, "status_type": status_type };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {}
        });
        return;
    }

   
    

    // $("body").on("click", "#adm_pwd_change", function() {
    //     event.preventDefault();
    //     var c_pwd = $('#current_pwd').val();
    //     var n_pwd = $('#new_pwd').val();
    //     var n_c_pwd = $('#new_cnf_pwd').val();
    //     var fetch_id = $(this).attr('fetchid');
    //     var fetchurl = $(this).attr('fetchurl');
    //     if ($('#current_pwd').val() != '' && $('#new_pwd').val() != '' && $('#new_cnf_pwd').val() != '') {

    //         if ($('#new_pwd').val() === $('#new_cnf_pwd').val()) {
    //             var formData = { "fetch_id": fetch_id, "c_pwd": c_pwd, "n_pwd": n_pwd, "n_c_pwd": n_c_pwd };
    //             $.ajax({
    //                 type: "POST",
    //                 dataType: "json",
    //                 url: fetchurl,
    //                 data: formData,
    //                 cache: false,
    //                 success: function(data) {
    //                     //alert(data.Message);
    //                     swal(data.Message, {
    //                         icon: "success",
    //                       });

    //                     $('#current_pwd').val('');
    //                     $('#new_pwd').val('');
    //                     $('#new_cnf_pwd').val('');
    //                 }
    //             });

    //         } else {

    //             //alert('New password & confirm password should be same');
    //             swal('New password & confirm password should be same', {
    //                 icon: "error",
    //               });
    //         }

    //     } else {

    //         //alert('all fields were mandatory');
    //         swal('All Fields Are Mandatory', {
    //             icon: "error",
    //           });
    //     }

    //     return;
    // });


    // $("body").on("click", ".customer_date_filter", function() {

    //     //alert('sddsd');
    //     event.preventDefault();
    //     $(".customer_date_filter").removeClass('active');
    //     $("#customer_date_input_filter").removeClass('active');
    //     $(this).addClass('active');
    //     var customer_date_filter = $(this).val();
    //     $("#retailers_ajax_table").attr("join_date", customer_date_filter);
    //     $("#customers_download_join_date").val(customer_date_filter);
    //     DataTableBind($("#retailers_ajax_table"), true);
    // });

    // window.load_customer_table = function load_customer_table(join_date, page_load) {
    //     if (page_load == false) {
    //         $(".customer_date_filter").removeClass('active');
    //         $("#customer_date_input_filter").addClass('active');
    //         $("#retailers_ajax_table").attr("join_date", join_date);
    //         DataTableBind($("#retailers_ajax_table"), true);
    //     }
    // }

    // $("body").on("click", ".customer_non_date_filter", function() {

    //     //alert('sddsd');
    //     event.preventDefault();
    //     $(".customer_non_date_filter").removeClass('active');
    //     $("#customer_non_date_input_filter").removeClass('active');
    //     $(this).addClass('active');
    //     var customer_date_filter = $(this).val();
    //     $("#customers_non_ajax_table").attr("join_date", customer_date_filter);
    //     $("#customers_download_join_date").val(customer_date_filter);
    //     DataTableBind($("#customers_non_ajax_table"), true);
    // });

    // window.load_non_customer_table = function load_non_customer_table(join_date, page_load) {
    //     if (page_load == false) {
    //         $(".customer_non_date_filter").removeClass('active');
    //         $("#customer_non_date_input_filter").addClass('active');
    //         $("#customers_non_ajax_table").attr("join_date", join_date);
    //         DataTableBind($("#customers_non_ajax_table"), true);
    //     }
    // }

    // window.load_transport_table = function load_transport_table(transport_status_filter, page_load) {

    //     if (page_load == false) {
    //         $(".transport_date_filter").removeClass('active');
    //         $("#transport_date_input_filter").addClass('active');
    //         $("#transports_table").attr("transport_date", transport_status_filter);
    //         DataTableBind($("#transports_table"), true);


    //     }
    // }

  // employee schedule

  
  $("body").on("change", "#calendars1", function() {
    event.preventDefault();
    var schedule_date = $(this).val();
    $("#employee_schedule_ajax_table").attr("schedule_date", schedule_date);
    $("#nav-home-tab").attr("schedule_date", schedule_date);
    DataTableBind($("#employee_schedule_ajax_table"), true);
    return;
    });

    $("body").on("change", "#calendars", function() {
        event.preventDefault();
        var schedule_date = $(this).val();
        $("#employee_schedule_detailed_ajax_table").attr("schedule_date", schedule_date);
        DataTableBind($("#employee_schedule_detailed_ajax_table"), true);
        $('#schedule_date').val(schedule_date);
        return;
    });

    $("body").on("change", "#employee_id", function() {
        var emp_id = $(this).val();
        var myArray = emp_id.split("_");
        var job_role_id = myArray[1];
        $('#employee_jobrole_id').val(job_role_id);
    });
    
    $("body").on("click", ".schedule_delete_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchUrl,
            data: formData,
            cache: false,
            success: function(data) {
               
                  if(data.Status == '200')
                {
                    swal(data.Message, {
                        icon: "success",
                      });
                     
                      
                }else{
                    swal(data.Message, {
                        icon: "error",
                      });

                }
                DataTableBind($("#employee_schedule_detailed_ajax_table"), true);  
                
            }
        });
        return;
    });

    $("body").on("click", ".schedule_details_view", function() {

        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchId = $(this).attr("fetchId");
        //$("#" + appendDivId).html('');
        $('#selected_row_index').val(fetchId);

        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {
                $(appendDivId).find('.modal-content').html('');
                $(appendDivId).find('.modal-content').html(data.html);
                $(appendDivId).modal('show');
            }
        });

        var emp_id = $('#employee_id').val();
        var myArray = emp_id.split("_");
        var job_role_id = myArray[1];
        $('#employee_jobrole_id').val(job_role_id);
        
        return;

    });

    $("body").on("click", "#schedule_add_btn", function(event) {

        var start_date = $('#schedule_start').val();
        var end_date = $('#schedule_end').val();
        // var schedule_id = $('#sch_employee_id').val();
        var schedule_type = $('#schedule_type').val();
        var fetchurl = $(this).attr("fetchurl");
        
    //    if(schedule_id != '')
    //    {
           if(start_date != '' && end_date != '' )
           {    
           
          
              var form_data = new FormData();
              form_data.append("start_date",start_date);
              form_data.append("end_date",end_date);
            //   form_data.append("schedule_id",schedule_id);
               form_data.append("schedule_type",schedule_type);
              $.ajax({
                url:fetchurl,
                method:'POST',
                data:form_data,
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                  //$('#msg').html('Loading......');
                },
                success:function(data){
                   
                  //alert(data.Message);
                  swal(data.Message, {
                    icon: "success",
                  });
                  $('#schedule_start').val('');
                  $('#schedule_end').val('');
                //   $('#sch_employee_id').val('');
                //   $('#schedule_type').val('');
                }
              });

           }else{
            //alert('Please Select On Start & End Dates ');
            swal('Please Select On Start & End Dates', {
                icon: "error",
              });
           }    
        
    //    }else{
    //        alert('Please Select On Employee Schedule');
    //    }
        
        });


        
        $("body").on("change", "#sm_service_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            var fetchId2 = $(this).attr("fetchId");
            fetchId2 = $('#' + fetchId2).val();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");            
            CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2);
            return;
        });

        $("body").on("change", "#sm_merchant_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");
            CallDetailedView(fetchurl, fetchId, appendDivId);

            var fetchurl1 = $(this).attr("fetchurl1");
            var appendDivId1 = $(this).attr("appendDivId1");
            CallDetailedView(fetchurl1, fetchId, appendDivId1);

            // setTimeout(function() {
            //     var owl = $('.browse-cate');
            //     var owl = document.getElementsByClassName("browse-cate");
            //     owl.owlCarousel({
            //         stagePadding: 0,
            //         margin: 10,
            //         nav: true,
            //         loop: true,
            //         autoplay: false,
            //         autoplayTimeout: 900,
            //         dots: false,
            //         responsive: {
            //             0: {
            //                 items: 2
            //             },
            //             600: {
            //                 items: 4
            //             },
            //             1000: {
            //                 items: 4
            //             }
            //         }
            //     })
            // }, 3000);
        

            
            return;
        });
    
        $("body").on("change", "#sm_location_id", function(event) {
            event.preventDefault();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");
            var fetchId = $(this).attr("fetchId");
        
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    $(appendDivId).find('.modal-content').html('');
                    $(appendDivId).find('.modal-content').html(data.html);
                    $(appendDivId).modal('show');
                }
            });
        return;
        });


        $('body').on("click",".pos_item_category",function(){

            var merchant_id = $('#sm_merchant_id').val();
            var location_id = $('#sm_location_id').val();

            if(merchant_id != '' && location_id != '')
            {
                $('.pos_item_category').find('.card').removeClass('card-active');
                $(this).find('.card').addClass('card-active');
                // var merchant_id = $('#sm_merchant_id').val();
                // var location_id = $('#sm_location_id').val();
                var search_key = $('#pos_item_search').val();
                var segment_id = $(this).attr('segment_id');
                var fetchurl = $(this).attr('fetchurl');
                var appendDivId = $(this).attr('appendDivId');
                $("#"+appendDivId).html('');
                var formData = { "merchant_id": merchant_id, "location_id":location_id, "segment_id": segment_id, "search_key":search_key};
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    async: false,
                    cache: false,
                    success: function(data) {
                        $("#"+appendDivId).html( data.html );
                    }
                });
            }else{
                swal('Please Select Merchant Location', {
                    icon: "error",
                });
            }
            
            return;
        });

        $('body').on("change","#pos_item_search",function(){
            if($(this).val().length >= 1) {

                var merchant_id = $('#sm_merchant_id').val();
                var location_id = $('#sm_location_id').val();

                if(merchant_id != '' && location_id != '')
                {

                    $('.pos_item_category').find('.card').removeClass('card-active');            
                    var merchant_id = $('#sm_merchant_id').val();
                    var location_id = $('#sm_location_id').val();
                    var search_key = $(this).val();
                    var fetchurl = $(this).attr('fetchurl');
                    var appendDivId = $(this).attr('appendDivId');
                    $("#"+appendDivId).html('');
                    var formData = { "merchant_id": merchant_id, "location_id":location_id, "search_key": search_key};
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: fetchurl,
                        data: formData,
                        async: false,
                        cache: false,
                        success: function(data) {
                            $("#"+appendDivId).html( data.html );
                        }
                    });
                }
            }            
            return;
        });

        
        $("body").on("click", "#pos_customers_ajax_table tr", function(event) {
            event.preventDefault();
            var ele = $(this).find(".fetchDetails");
            $("#pos_customers_ajax_table").find("tr").removeClass("active");
            $(this).addClass("active");
    
            var fetchurl = ele.attr("fetchurl");
            var fetchId = ele.attr("fetchId");
            var appendDivId = ele.attr("appendDivId");
            CallDetailedView(fetchurl, fetchId, appendDivId);
            DataTableBind($("#pos_customer_orders_ajax_table"), true);
            return;
        });

        $("body").on("click", "#pos_orders_ajax_table tr", function(event) {
            event.preventDefault();
            var ele = $(this).find(".fetchDetails");
            $("#pos_customers_ajax_table").find("tr").removeClass("active");
            $(this).addClass("active");
    
            var fetchurl = ele.attr("fetchurl");
            var fetchId = ele.attr("fetchId");
            var appendDivId = ele.attr("appendDivId");
            CallDetailedView(fetchurl, fetchId, appendDivId);
           // DataTableBind($("#pos_customer_orders_ajax_table"), true);
            return;
        });

        $('body').on("input","#pos_search_customer_mobile_number",function(e){
            e.preventDefault();
            var $that = $(this);
            var maxlength = 10;
            if($that.val().length == maxlength) {
                e.preventDefault();
                var mobile_number = $that.val();
                var fetchurl = $(this).attr('fetchurl');
                var formData = { "mobile_number": mobile_number};
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    async: false,
                    cache: false,
                    success: function(data) {
                        if( data.Status == 500 ){
                            $("#customer_mobile").val( mobile_number );
                            $('#addcustomer').modal('show');
                            $("#CustomerName").html( '******' );
                            $("#CustomerMobile").html( '+91 *******' );
                            $("#CustomerEmail").html( '*****@***.***' );
                            $("#SavePhoneNumber").val( mobile_number );
                            $('#CustomerOtpVerification').val('');
                        }else{
                            CustomerDataAppend(data.customer_data);
                        }
                    }
                });
                LoadCartItems();
                return; 
            }
            $that.val($that.val().substr(0, maxlength));
            e.preventDefault();
            return; 
        });
       
        function CustomerDataAppend( customer_data ){
            $("#CustomerName").html( customer_data.CustomerName );
            $("#CustomerMobile").html( customer_data.CustomerMobile );
            $("#CustomerEmail").html( customer_data.CustomerEmail );
            $("#CustomerId").val( customer_data.CustomerId );
            $('#CustomerOtpVerification').val('');
        }

        $("body").on("click", ".product_modal_btn", function(e) {
            e.preventDefault();
            var ItemId = $(this).attr('ItemId');
            var fetchurl = $(this).attr('fetchurl');
            var formData = { "ItemId": ItemId};
            $("#product_view_modal_body").html('');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.status ){
                        $("#product_view_modal_body").html(data.html);
                    }else{

                    }
                }
            });
            return;
        });


        $("body").on("click", ".pos_add_to_cart", function(e) {
            e.preventDefault();
            var ItemId = $(this).attr("itemid");
            var action_url = $(this).attr("data-url");
            var customer_id = $("#CustomerId").val();
            if(customer_id != '')
            {

                var pos_cart_item_quantity = $("#pos_cart_item_quantity_"+ItemId ).val();
                var pos_search_customer_mobile_number = $("#pos_search_customer_mobile_number").val();
                if( pos_search_customer_mobile_number == undefined || pos_search_customer_mobile_number == '' || pos_search_customer_mobile_number.length != 10 ){
                   
                    swal('Please enter valid mobile number', {
                        icon: "error",
                    });

                    $("#AddItems").modal('hide');
                    $("#pos_search_customer_mobile_number").focus();
                    return false;
                }
                if( pos_cart_item_quantity <= 0 ){
                    //alert("Please select quantity");
                    swal('Please select quantity', {
                        icon: "error",
                    });
                    return false;
                }
                AddToCart(action_url,ItemId,pos_cart_item_quantity);
                return;
            }else{
            swal('Please Enter Valid Customer Details', {
                icon: "error",
            });
    }
        });


        function AddToCart(action_url,ItemId,pos_cart_item_quantity){

            var merchant_id = $('#sm_merchant_id').val();
            var location_id = $('#sm_location_id').val();
            var customer_id = $("#CustomerId").val();
            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(otp_verification_status)
            {
            var formData = { "ItemId": ItemId,'ItemQuantity':pos_cart_item_quantity, 'merchant_id': merchant_id, 'location_id':location_id,  'customer_id':customer_id};
            $.ajax({
                type: "POST",
                dataType: "json",
                url: action_url,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == 200 ){
                        $("#AddItems").modal('hide');
                        LoadCartItems();
                    }else{

                        swal( data.Message, {
                            icon: "error",
                        });
                    }
                }
            });
            return;
        }else{
            swal('Customer Verification Not Done, Please Verify Otp', {
              icon: "error",
          });
      }
        }

      

        function LoadCartItems(){
            var merchant_id = $('#sm_merchant_id').val();
            var location_id = $('#sm_location_id').val();
            var customer_id = $("#CustomerId").val();
            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(otp_verification_status)
            {
            var formData = { "ItemId": '', "merchant_id": merchant_id, "location_id":location_id, "customer_id":customer_id};
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url+'/pos_billing/get_cart_section',
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.status ){
                        $("#pos_cart_items").html(data.html);
                        $("#pos_cart_items_count").html(data.cart_items_count);
                        $('#pos_cart_items_total_amount').html(data.cart_total_amount);

                        $("#pos_cart_items_sub_total").html(data.cart_items_total_amount);
                        $('#pos_cart_items_tax_amount').html(data.tax);
                        $('#pos_cart_items_fee_amount').html(data.fee);
                        $("#pos_cart_items_discount_amount").html(data.discount);
                        $('#pos_cart_items_total_amount1').html(data.cart_total_amount);

                    }else{

                        $("#pos_cart_items").html('');
                        $("#pos_cart_items_count").html('0');
                        $('#pos_cart_items_total_amount').html('0.00');

                        $("#pos_cart_items_sub_total").html('0.00');
                        $('#pos_cart_items_tax_amount').html('0.00');
                        $('#pos_cart_items_fee_amount').html('0.00');
                        $("#pos_cart_items_discount_amount").html('0.00');
                        $('#pos_cart_items_total_amount1').html('0.00');
                        

                    }
                }
            });

        }else{
            $("#pos_cart_items").html('');
            $("#pos_cart_items_count").html('0');
            $('#pos_cart_items_total_amount').html('0.00');

            $("#pos_cart_items_sub_total").html('0.00');
            $('#pos_cart_items_tax_amount').html('0.00');
            $('#pos_cart_items_fee_amount').html('0.00');
            $("#pos_cart_items_discount_amount").html('0.00');
            $('#pos_cart_items_total_amount1').html('0.00');
            
        }
        }

        $("body").on("click", ".clear_cart_item", function(e) {
            var ItemId = $(this).attr('ItemId');
            ClearCart('one',ItemId);
        });

        $("body").on("click", ".clear_cart", function(e) {
            ClearCart('all',false);
        });
    
        
        function ClearCart(CartType,ItemId){

            var merchant_id = $('#sm_merchant_id').val();
            var location_id = $('#sm_location_id').val();
            var customer_id = $("#CustomerId").val();

            var formData = { "ItemId":ItemId,'CartType':CartType, 'merchant_id':merchant_id, 'location_id':location_id, 'customer_id': customer_id  };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url+'/pos_billing/clear_cart',
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == 200 ){
                        LoadCartItems();
                    }else{
                        
                    }
                }
            });
            return;
        }

        function incrementValue1(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    
            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }
    
        function decrementValue1(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    
            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }
        $("body").delegate(".button-plus1", "click", function(e){
        //$('.input-group').on('click', '.button-plus', function(e) {
            incrementValue1(e);
        });
    
        $("body").delegate(".button-minus1", "click", function(e){
            decrementValue1(e);
        });


        $("body").on("click", ".pos_update_cart_item_quantity", function(e) {
            //e.preventDefault();
            var ItemId = $(this).attr("itemid");
            var action_url = $(this).attr("data-url");
            var pos_cart_section_item_quantity = $("#pos_cart_section_item_quantity_"+ItemId).val();
            //alert(pos_cart_section_item_quantity);
            if( pos_cart_section_item_quantity > 0 ){
                AddToCart(action_url,ItemId,pos_cart_section_item_quantity );
            }else{
                ClearCart('one',ItemId);
            }
            return;
        });



        $("body").on("click", "#pos_apply_discount_btn", function(e) {
            e.preventDefault();
             var fetchurl = $(this).attr('fetchurl');
             var pos_discount_type = $('#pos_discount_type').val();
             var pos_discount_percentage = $('#pos_discount_percentage').val();
             var pos_discount_description = $('#pos_discount_description').val();

             var merchant_id = $('#sm_merchant_id').val();
             var location_id = $('#sm_location_id').val();
             var customer_id = $('#CustomerId').val();

             if(merchant_id != '' && location_id != '')
             {

             
             if(pos_discount_description != '' && pos_discount_percentage != ''  )
             {

 
             var formData = { 'customer_id':customer_id, 'merchant_id':merchant_id, 'location_id':location_id ,'pos_discount_type':pos_discount_type, 'pos_discount_percentage':pos_discount_percentage, 'pos_discount_description':pos_discount_description  };
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == '200' ){
                        
                        LoadCartItems();
                        $('#itemdiscount').modal('hide');

                    }else{

                    }
                }
            });
            return;

            }else{
                swal('Please Enter All Details', {
                    icon: "error",
                });
            }
        }else{
            swal('Please Select Merchant & Merchant Location', {
                icon: "error",
            });
        }
        });

        $("body").on("click", "#pos_send_customer_otp", function(e) {
            e.preventDefault();

            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(!otp_verification_status)
            {

            var mobile_number = $('#pos_search_customer_mobile_number').val();

            if(mobile_number != '')
            {

            var maxlength = 10;
            if(mobile_number.length == maxlength) {
                e.preventDefault();
                var customer_id = $('#CustomerId').val();
                var fetchurl = $(this).attr('fetchurl');
                if(customer_id != '')
                {

                        var formData = { "customer_id":customer_id, "mobile_number": mobile_number};
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: fetchurl,
                            data: formData,
                            async: false,
                            cache: false,
                            success: function(data) {
                                if( data.Status == 500 ){
                                    
                                    swal(data.Message, {
                                        icon: "error",
                                      });   
                                    $('#CustomerId').val('');
                                
                                }else{

                                    $("#pos_verify_otp_modal_body").html(data.html);
                                    $('#posotpverify').modal('show');
                                    $('#1').focus();
                                }
                            }
                        });
                        return; 

                    }else{
                        swal('Please Register Customer', {
                            icon: "error",
                          });   
                    }

                    }else{
                        swal('Please Enter Valid Mobile No', {
                            icon: "error",
                        });
                    }
            }else{
                swal('Please Enter Mobile No', {
                    icon: "error",
                });
            }
        }else{
            swal('Customer Verification Already Done', {
                icon: "error",
            });
        } 
        });

       
        $('body').on("click","#pos_verify_customer_otp",function(e){
            // e.preventDefault();
        
         if($('#1').val() != '' && $('#2').val() != '' && $('#3').val() != '' && $('#4').val() != '')
         {
             var mobile_no = $('#otp_customer_mobile').val();
             var customer_id = $('#otp_customer_id').val();
             var otp = $('#1').val()+$('#2').val()+$('#3').val()+$('#4').val();
             var fetchurl = $(this).attr('fetchurl');
             
                 $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: fetchurl,
                     data : { mobile_no : mobile_no , customer_id : customer_id, otp : otp},
                     success: function(data){
         
                         if(data.Status == '200')
                         {
                            
                             $('#posotpverify').modal('hide');
                             $("#CustomerId").val( data.customer_id );
                             $("#CustomerOtpVerification").val(1);
                             
         
                         }else{
         
                            
                             
                         }          
         
                     }
                 });//e.prevenDefault();
         }else{
                 
                 swal('Please Enter Otpp', {
                    icon: "error",
                });
         }
         
         
          });



          
        $("body").on("click", "#SavePosCustomerDetailsBtn", function(e) {
            e.preventDefault();

            var fetchurl = $(this).attr('fetchurl');
            var customer_name = $('#SaveCustomerName').val();
            var phone_no = $('#SavePhoneNumber').val();
            var email_id = $('#SaveEmailId').val();
            var address = $('#SaveAddress').val();
            var latitude = $('#SaveLatitude').val();
            var longitude = $('#SaveLongitude').val();
 
            var formData = { 'customer_name':customer_name, 'phone_no':phone_no, 'email_id' : email_id, 'address' : address,
                              'latitude': latitude, 'longitude': longitude };

            if(customer_name != '' && phone_no != '' && email_id != '' && address != '' )
            {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    async: false,
                    cache: false,
                    success: function(data) {
                        if( data.Status == '200' ){
                            
                            swal(data.Message, {
                                icon: "success",
                            });
                            $('#addcustomer').modal('hide');
                            $('#pos_search_customer_mobile_number').val(phone_no).trigger("input");
                            LoadCartItems();
                        }else{

                        }
                    }
                });
                return;
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
    });

        
        $("body").on("click", ".pos_detailed_display", function(e) {
            e.preventDefault();
             var fetchurl = $(this).attr('fetchurl');
             var modal_id = $(this).attr('data-bs-target');
             
             var merchant_id = $('#sm_merchant_id').val();
             var location_id = $('#sm_location_id').val();
             var customer_id = $('#CustomerId').val();
             var customer_verification = $('#CustomerOtpVerification').val();
             var delivery_type = $('#DeliveryType').val();
             //alert(delivery_type);
             if(customer_verification)
             {
                if(delivery_type)
                {
                    var formData = { 'customer_id':customer_id, 'merchant_id':merchant_id, 'location_id':location_id  };
                    $("#pos_detailed_display_modal_body").html('');
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: fetchurl,
                        data: formData,
                        async: false,
                        cache: false,
                        success: function(data) {
                            if( data.status ){
                                $("#pos_detailed_display_modal_body").html(data.html);
                                $(modal_id).modal('show');
                            }else{

                            }
                        }
                    });
                    return;
                }else{
                
                    swal('Please Select Delivery Type ', {
                        icon: "error",
                    });
                 }
             }else{
                
                swal('Please Verify Customer Authentication', {
                    icon: "error",
                });
             }
 
             
        });

        $("body").on("click", "#pos_place_order", function(e) {
            e.preventDefault();

            var customer_id = $("#CustomerId").val();
            var fetchurl = $(this).attr('fetchurl');
            var merchant_id = $('#sm_merchant_id').val();
            var location_id = $('#sm_location_id').val();
            var city_id = $('#sm_city_id').val();
 
            var formData = { 'merchant_id':merchant_id, 'location_id':location_id, 'customer_id' : customer_id, 'city_id':city_id  };

            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == '200' ){
                        
                        swal(data.Message, {
                            icon: "success",
                        });

                        $('#payinfo').modal('hide');
                        ClearCart('all',false);
                        location.href = 'http://bazaar-portal.deliverease.in/purchase_orders';
                    }else{
                        swal(data.Message, {
                            icon: "error",
                        });
                        //$('#payinfo').modal('hide');
                    }
                }
            });
            return;
        });




        let schedule_date_counter = 0;
        let schedule_date_counter1 = 0;

        $('#schedule_type').change(function(e){

           
           // alert('ssss');      
               if($('#schedule_type').val() == 'WEEK')
               {
                    
                $('#schedule_start').daterangepicker({
                    dateLimit: { days: 6 },
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
               
                });

                $('#schedule_end').daterangepicker({
                    dateLimit: { days: 6 },
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
               
                });
                
               }else if($('#schedule_type').val() == 'MONTH'){
                $('#schedule_start').daterangepicker({
                    dateLimit: { days: 29 },
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
               
                });

                $('#schedule_end').daterangepicker({
                    dateLimit: { days: 29 },
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
               
                });
               }else{
                $('#schedule_start').daterangepicker({
                    dateLimit: { days: 0 },
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
               
                });

                $('#schedule_end').daterangepicker({
                    dateLimit: { days: 0 },
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
               
                });
               }
                schedule_date_counter++;
                schedule_date_counter1++;    
            // alert(schedule_date_counter);
        });
        
        $('#schedule_start').change(function(e){

           //alert(schedule_date_counter);

            if(schedule_date_counter >= 1)
            {
            
            var date = $('#schedule_start').val();
            var n_date = date.split("-");
           // alert(n_date[0]);
           // alert(n_date[1]);
            let date_1 = new Date(n_date[0]);
            let date_2 = new Date(n_date[1]);
            let difference = date_2.getTime() - date_1.getTime();
            //alert(difference);

            var TotalDays = Math.ceil(difference / (1000 * 3600 * 24));

            var date_range = $('#schedule_type').val();

            if(date_range == 'DAY')
            {
                if(TotalDays != 0)
                {
                    //alert ('Please Select One Day To Schedule Clone');
                    
                    swal('Please Select One Day To Schedule Clone', {
                        icon: "error",
                    });
                    $("#schedule_start").focus();
                }
            }else if(date_range == 'WEEK')
            {
                if(TotalDays != 6)
                {
                    //alert ('Please Select a Week To Schedule Clone');
                    
                    swal('Please Select a Week To Schedule Clone', {
                        icon: "error",
                    });
                    $("#schedule_start").focus();
                }

            }else
            {
                if(TotalDays != 30)
                {
                    //alert ('Please Select a Month To Schedule Clone');
                    
                    swal('Please Select a Month To Schedule Clone', {
                        icon: "error",
                    });
                    $("#schedule_start").focus();
                }
            }

            }

            

        });
       

        $('#schedule_end').change(function(e){

            // alert(schedule_date_counter);

             if(schedule_date_counter1 >= 1)
             {
             
             var date = $('#schedule_end').val();
             var n_date = date.split("-");
            // alert(n_date[0]);
            // alert(n_date[1]);
             let date_1 = new Date(n_date[0]);
             let date_2 = new Date(n_date[1]);
             let difference = date_2.getTime() - date_1.getTime();
             //alert(difference);

             var TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
             
             var date_range = $('#schedule_type').val();

             if(date_range == 'DAY')
             {
                 if(TotalDays != 0)
                 {
                    // alert ('Please Select One Day To Schedule Clone');
                     swal('Please Select One Day To Schedule Clone', {
                        icon: "error",
                    });
                     $("#schedule_end").focus();
                 }
             }else if(date_range == 'WEEK')
             {
                 if(TotalDays != 6)
                 {
                    // alert ('Please Select a Week To Schedule Clone');
                     swal('Please Select a Week To Schedule Clone', {
                        icon: "error",
                    });
                     $("#schedule_end").focus();
                 }

             }else
             {
                 if(TotalDays != 30)
                 {
                     //alert ('Please Select a Month To Schedule Clone');
                     swal('Please Select a Month To Schedule Clone', {
                        icon: "error",
                    });
                     $("#schedule_end").focus();
                 }
             }

             }

             

         });



         // yuvraj product catalogue code start

    $("body").on("change", ".merchant_item_status_change", function() {
        event.preventDefault();
        var checked = $(this).attr("checked");
        $(this).attr("checked", checked);
        StatusChangeCall($(this));
        return false;
    });

    $("body").on("click", "#store_management_ajax_table tr", function() {
       
        var ele = $(this).find(".merchant_item_view");
        $("#store_management_ajax_table").find("tr").removeClass("active");
        $(this).addClass("active");
        var fetchurl = ele.attr("fetchurl");
        var fetchId = ele.attr("fetchId");
        var appendDivId = ele.attr("appendDivId");
        CallDetailedView(fetchurl, fetchId, appendDivId);
        return;
    });

    $('body').on("click",".ItemUOM_waight",function(){
        //alert('hi');
        $('#pro-quantity').find('.btn').removeClass('active');
        $(this).addClass('active');
        var fetchurl = $('#pro-quantity').find('.btn').attr('fetchurl');
        var fetchId = $(this).attr('fetchId');
        var appendDivId = $('#pro-quantity').find('.btn').attr('appendDivId');
        CallDetailedView(fetchurl, fetchId, appendDivId);
        })
     
     
     $("#btnEdit-field").click(function(event){
    
      $('.form-control').removeAttr("disabled");
      $('.form-select').removeAttr("disabled");
      $('button').removeAttr("disabled");
      $('.w-25').removeAttr("disabled");
      $('.show-for-sr').removeAttr("disabled");
     
    });

    $("#btnDisableEdit-field").click(function(event){
    
        $('.form-control').attr("disabled", true);
        $('.form-select').attr("disabled", true);    
        $('.w-25').attr("disabled", true);
        $('.show-for-sr').attr("disabled", true);
        $('button').attr("disabled", true);
      });

   

    $("body").on("change", "#Segment", function() {
        event.preventDefault();
        var fetchId = $(this).val();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        CallDetailedView(fetchurl, fetchId, appendDivId);
        return;
    });

   
    $("body").on("change", "#SegmentYuvir", function() {
        alert('hi');
    });
     

     $("body").on("change", "#UnitOfMeasurement", function() {
     $("#UOM_type").html($(this).val());
     });

     // publishing

        
         $("body").on("click", ".Segment", function() {
        event.preventDefault();
        var fetchId = $(this).attr("fetchId");
        //alert(fetchId);
        var fetchId2 = $(this).attr("fetchId2");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2 };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

          $("body").on("click", ".SubSegment", function() {
        event.preventDefault();
        var fetchId = $(this).attr("fetchId");
        var fetchId2 = $(this).attr("fetchId2");
        var fetchId3 = $(this).attr("fetchId3");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        //alert(appendDivId);
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "fetchId3": fetchId3 };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

          $("body").on("click", ".Location", function() {
        event.preventDefault();
        var location = $(this).attr("location");
        var fetchId = $(this).attr("fetchId");
        var fetchId2 = $(this).attr("fetchId2");
        var fetchId3 = $(this).attr("fetchId3");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        //alert(appendDivId);
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "fetchId3": fetchId3, "location": location };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

        $("body").on("change", ".merchant_items_thirdparty_update_price", function(e) {
        e.preventDefault();
        var ThirdPartyVenderId = $(this).attr("fetchid");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        var MerchantId = $("#MerchantId").val();
        var ItemId = $(this).attr("ItemId");
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $("#SegmentId").val();
        var SubSegmentId = $("#SubSegmentId").val();
        var Price = $("#VendorPrice_"+ItemId+"_"+ThirdPartyVenderId ).val();
        
        var formData = { "ItemId": ItemId, "ThirdPartyVenderId": ThirdPartyVenderId, "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId, "SubSegmentId": SubSegmentId, "Price": Price };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                //$("#" + appendDivId).html(data.html);
                console.log(data.Message);
            }
        });
        return;
    });

         $("body").on("change", ".merchant_items_thirdparty_update_status", function(e) {
        e.preventDefault();
        var ThirdPartyVenderId = $(this).attr("fetchid");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        var MerchantId = $("#MerchantId").val();
        var ItemId = $(this).attr("ItemId");
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $("#SegmentId").val();
        var SubSegmentId = $("#SubSegmentId").val();
        
        var formData = { "ItemId": ItemId, "ThirdPartyVenderId": ThirdPartyVenderId, "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId, "SubSegmentId": SubSegmentId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                //$("#" + appendDivId).html(data.html);
                console.log(data.Message);
            }
        });
        return;
    });

         $("body").on("change", ".vendors_thirdparty_update_status", function(e) {
        e.preventDefault();
        if($(this).is(':checked'))
        {
            var status = 1;
        }else{
            var status = 0;
        }
        //var status = $(this).val();
        var fetchId = $(this).attr("fetchid");
        var fetchId2 = $(this).attr("fetchid2");
        var fetchurl = $(this).attr("fetchurl");
        var MerchantId = $("#MerchantId").val();
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $("#SegmentId").val();
        var SubSegmentId = $("#SubSegmentId").val();
        var appendDivId = $(this).attr("appendDivId");
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "status":status, "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId, "SubSegmentId": SubSegmentId};
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                //$("#" + appendDivId).html(data.html);
                console.log(data.Message);
            }
        });
        return;
    });

         $("body").on("change", ".vendors_thirdparty_update_status_segments", function(e) {
        e.preventDefault();

        if($(this).is(':checked'))
        {
            var status = 1;
        }else{
            var status = 0;
        }

        var fetchId = $(this).attr("fetchid");
        var fetchurl = $(this).attr("fetchurl");
        var MerchantId = $("#MerchantId").val();
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $(this).attr("segmentId");
        var appendDivId = $(this).attr("appendDivId");
        var formData = { "status": status, "fetchId": fetchId,  "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

        $("body").on("click", ".publishing_user_activities", function() {
        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var formData = { "fetchId": '' };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {

                $(appendDivId).find(".modal-body").html(data.html);
                
            }
        });
       
    });





    

    // yuvraj product catalogue code end

        //yuvraj code promotions module code start

    $("body").on("click", ".promo_tab_filter", function(event) {
        event.preventDefault();
        $(".promo_tab_filter").removeClass("active");
        $(this).addClass("active");
        var table_id = "new_promotions_table";
        var append_attr = $(this).attr("append_attr");
        var promo_validity = $(this).attr("promo_validity");
        $("#" + table_id).attr(append_attr, promo_validity);
        $("#promotions_type").val(promo_validity);
        DataTableBind($("#" + table_id), true);
        return;
    });

    $("body").on("click", ".promotions_date_filter", function(event) {
        event.preventDefault();
        $(".promotions_date_filter").removeClass('active');
        $("#prmotions_date_input_filter").removeClass('active');
        $(this).addClass('active');
        var promotions_status_filter = $(this).val();
        $("#new_promotions_table").attr("order_date", promotions_status_filter);
        $("#promotions_download_date_filter").val(promotions_status_filter);
        DataTableBind($("#new_promotions_table"), true);
    });

    $("body").on("change", "#promotions_daterange", function(event) {
        event.preventDefault();
        $('.promotions_date_filter').removeClass('active');
        $(this).addClass('active');
        var promotions_daterange = $(this).val();        
        $("#new_promotions_table").attr("order_date", promotions_daterange);       
        DataTableBind($("#new_promotions_table"), true);
        return;
    });

    $("body").on("click", "#new_promotions_table tr", function(event) {
        event.preventDefault();
        var ele = $(this).find(".fetchDetails");
        $("#new_promotions_table tr").removeClass("active");
        $(this).addClass("active");
        var fetchUrl = ele.attr("fetchUrl");
        var appendDivId = ele.attr("appendDivId");
        var fetchId = ele.attr("fetchId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        DataTableBind($("#promotions_surce_table"), true);
        return;
    });

    $("body").on("click", "#download_promotions_btn", function() {
        $('#download_promotions_form').submit();
    });

    $("body").on("change", "#messaging_customers_join_start_date", function(event) {
       
        event.preventDefault();
        var join_start_date = $(this).val();
        $("#messaging_customers_ajax_table").attr("join_start_date", join_start_date);
        $('#messaging_customers_join_start_date').val(join_start_date);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });

    $("body").on("change", "#messaging_customers_join_end_date", function(event) {

        event.preventDefault();
        var join_end_date = $(this).val();
        $("#messaging_customers_ajax_table").attr("join_end_date", join_end_date);
        $('#messaging_customers_join_end_date').val(join_end_date);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });


    $("body").on("change", "#messaging_customers_last_active_start_date", function(event) {

        event.preventDefault();
        var last_active_start_date = $(this).val();
        $("#messaging_customers_ajax_table").attr("last_active_start_date", last_active_start_date);
        $('#messaging_customers_last_active_start_date').val(last_active_start_date);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });

    $("body").on("change", "#messaging_customers_last_active_end_date", function(event) {

        event.preventDefault();
        var last_active_end_date = $(this).val();
        $("#messaging_customers_ajax_table").attr("last_active_end_date", last_active_end_date);
        $('#messaging_customers_last_active_end_date').val(last_active_end_date);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });


    $("body").on("change", "#messaging_customers_min_transports", function(event) {

        event.preventDefault();
        var min_transports = $(this).val();
        $("#messaging_customers_ajax_table").attr("min_transports", min_transports);
        $('#messaging_customers_min_transports').val(min_transports);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });

    $("body").on("change", "#messaging_customers_max_transports", function(event) {

        event.preventDefault();
        var max_transports = $(this).val();
        $("#messaging_customers_ajax_table").attr("max_transports", max_transports);
        $('#messaging_customers_max_transports').val(max_transports);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });


    
    $("body").on("change", "#messaging_customers_min_bill_amount", function(event) {

        event.preventDefault();
        var min_bill_amount = $(this).val();
        $("#messaging_customers_ajax_table").attr("min_bill_amount", min_bill_amount);
        $('#messaging_customers_min_bill_amount').val(min_bill_amount);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });

    $("body").on("change", "#messaging_customers_max_bill_amount", function(event) {

        event.preventDefault();
        var max_bill_amount = $(this).val();
        $("#messaging_customers_ajax_table").attr("max_bill_amount", max_bill_amount);
        $('#messaging_customers_max_bill_amount').val(max_bill_amount);
        DataTableBind($("#messaging_customers_ajax_table"), true);
    });

 // promo filter customers

    $("body").on("change", "#messaging_customers_join_start_date1", function(event) {
       
        event.preventDefault();
        var join_start_date = $(this).val();
        $("#add_promotions_source_table").attr("join_start_date", join_start_date);
        $('#messaging_customers_join_start_date1').val(join_start_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_customers_join_end_date1", function(event) {

        event.preventDefault();
        var join_end_date = $(this).val();
        $("#messaging_customers_ajax_table").attr("join_end_date", join_end_date);
        $('#messaging_customers_join_end_date1').val(join_end_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });


    $("body").on("change", "#messaging_customers_last_active_start_date1", function(event) {

        event.preventDefault();
        var last_active_start_date = $(this).val();
        $("#add_promotions_source_table").attr("last_active_start_date", last_active_start_date);
        $('#messaging_customers_last_active_start_date1').val(last_active_start_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_customers_last_active_end_date1", function(event) {

        event.preventDefault();
        var last_active_end_date = $(this).val();
        $("#add_promotions_source_table").attr("last_active_end_date", last_active_end_date);
        $('#messaging_customers_last_active_end_date1').val(last_active_end_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });


    $("body").on("change", "#messaging_customers_min_transports1", function(event) {

        event.preventDefault();
        var min_transports = $(this).val();
        $("#add_promotions_source_table").attr("min_transports", min_transports);
        $('#messaging_customers_min_transports1').val(min_transports);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_customers_max_transports1", function(event) {

        event.preventDefault();
        var max_transports = $(this).val();
        $("#add_promotions_source_table").attr("max_transports", max_transports);
        $('#messaging_customers_max_transports1').val(max_transports);
        DataTableBind($("#add_promotions_source_table"), true);
    });


    
    $("body").on("change", "#messaging_customers_min_bill_amount1", function(event) {

        event.preventDefault();
        var min_bill_amount = $(this).val();
        $("#add_promotions_source_table").attr("min_bill_amount", min_bill_amount);
        $('#messaging_customers_min_bill_amount1').val(min_bill_amount);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_customers_max_bill_amount1", function(event) {

        event.preventDefault();
        var max_bill_amount = $(this).val();
        $("#add_promotions_source_table").attr("max_bill_amount", max_bill_amount);
        $('#messaging_customers_max_bill_amount1').val(max_bill_amount);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    // promo filter merchants

    $("body").on("change", "#messaging_merchants_join_start_date1", function(event) {
       
        event.preventDefault();
        var join_start_date = $(this).val();
        $("#add_promotions_source_table").attr("join_start_date", join_start_date);
        $('#messaging_merchants_join_start_date1').val(join_start_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_merchants_join_end_date1", function(event) {

        event.preventDefault();
        var join_end_date = $(this).val();
        $("#messaging_customers_ajax_table").attr("join_end_date", join_end_date);
        $('#messaging_merchants_join_end_date1').val(join_end_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });


    $("body").on("change", "#messaging_merchants_last_active_start_date1", function(event) {

        event.preventDefault();
        var last_active_start_date = $(this).val();
        $("#add_promotions_source_table").attr("last_active_start_date", last_active_start_date);
        $('#messaging_merchants_last_active_start_date1').val(last_active_start_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_merchants_last_active_end_date1", function(event) {

        event.preventDefault();
        var last_active_end_date = $(this).val();
        $("#add_promotions_source_table").attr("last_active_end_date", last_active_end_date);
        $('#messaging_merchants_last_active_end_date1').val(last_active_end_date);
        DataTableBind($("#add_promotions_source_table"), true);
    });


    $("body").on("change", "#messaging_merchants_min_transports1", function(event) {

        event.preventDefault();
        var min_transports = $(this).val();
        $("#add_promotions_source_table").attr("min_transports", min_transports);
        $('#messaging_merchants_min_transports1').val(min_transports);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_merchants_max_transports1", function(event) {

        event.preventDefault();
        var max_transports = $(this).val();
        $("#add_promotions_source_table").attr("max_transports", max_transports);
        $('#messaging_merchants_max_transports1').val(max_transports);
        DataTableBind($("#add_promotions_source_table"), true);
    });


    
    $("body").on("change", "#messaging_merchants_min_bill_amount1", function(event) {

        event.preventDefault();
        var min_bill_amount = $(this).val();
        $("#add_promotions_source_table").attr("min_bill_amount", min_bill_amount);
        $('#messaging_merchants_min_bill_amount1').val(min_bill_amount);
        DataTableBind($("#add_promotions_source_table"), true);
    });

    $("body").on("change", "#messaging_merchants_max_bill_amount1", function(event) {

        event.preventDefault();
        var max_bill_amount = $(this).val();
        $("#add_promotions_source_table").attr("max_bill_amount", max_bill_amount);
        $('#messaging_merchants_max_bill_amount1').val(max_bill_amount);
        DataTableBind($("#add_promotions_source_table"), true);
    });
    // merchants filters start

    $("body").on("change", "#messaging_merchants_join_start_date", function(event) {

        event.preventDefault();
        var join_start_date = $(this).val();
        $("#messaging_merchants_ajax_table").attr("join_start_date", join_start_date);
        $('#messaging_merchants_join_start_date').val(join_start_date);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });

    $("body").on("change", "#messaging_merchants_join_end_date", function(event) {

        event.preventDefault();
        var join_end_date = $(this).val();
        $("#messaging_merchants_ajax_table").attr("join_end_date", join_end_date);
        $('#messaging_merchants_join_end_date').val(join_end_date);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });


    $("body").on("change", "#messaging_merchants_last_active_start_date", function(event) {

        event.preventDefault();
        var last_active_start_date = $(this).val();
        $("#messaging_merchants_ajax_table").attr("last_active_start_date", last_active_start_date);
        $('#messaging_merchants_last_active_start_date').val(last_active_start_date);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });

    $("body").on("change", "#messaging_merchants_last_active_end_date", function(event) {

        event.preventDefault();
        var last_active_end_date = $(this).val();
        $("#messaging_merchants_ajax_table").attr("last_active_end_date", last_active_end_date);
        $('#messaging_merchants_last_active_end_date').val(last_active_end_date);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });


    $("body").on("change", "#messaging_merchants_min_transports", function(event) {

        event.preventDefault();
        var min_transports = $(this).val();
        $("#messaging_merchants_ajax_table").attr("min_transports", min_transports);
        $('#messaging_merchants_min_transports').val(min_transports);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });

    $("body").on("change", "#messaging_merchants_max_transports", function(event) {

        event.preventDefault();
        var max_transports = $(this).val();
        $("#messaging_merchants_ajax_table").attr("max_transports", max_transports);
        $('#messaging_merchants_max_transports').val(max_transports);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });


    
    $("body").on("change", "#messaging_merchants_min_bill_amount", function(event) {

        event.preventDefault();
        var min_bill_amount = $(this).val();
        $("#messaging_merchants_ajax_table").attr("min_bill_amount", min_bill_amount);
        $('#messaging_merchants_min_bill_amount').val(min_bill_amount);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });

    $("body").on("change", "#messaging_merchants_max_bill_amount", function(event) {

        event.preventDefault();
        var max_bill_amount = $(this).val();
        $("#messaging_merchants_ajax_table").attr("max_bill_amount", max_bill_amount);
        $('#messaging_merchants_max_bill_amount').val(max_bill_amount);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
    });

    // merchants filters end

    // messaging hub start

    $("body").on("change", "#messaging_hub_city", function(event) {
        event.preventDefault();
        var order_status_filter = $(this).val();
        $("#promotions_messaging_table").attr("messages_city", order_status_filter);
        $("#messaging_hub_download_city").val(order_status_filter);
        DataTableBind($("#promotions_messaging_table"), true);
    });

     $("body").on("change", "#messaging_hub_filter_status", function(event) {
        event.preventDefault();
        var order_status_filter = $(this).val();
        $("#promotions_messaging_table").attr("message_staus", order_status_filter);
        $("#messaging_hub_download_status").val(order_status_filter);
        DataTableBind($("#promotions_messaging_table"), true);
    });

     $("body").on("click", ".messaging_hub_date_filter", function(event) {
        event.preventDefault();
        $(".messaging_hub_date_filter").removeClass('active');
        $("#messaging_hub_date_input_filter").removeClass('active');
        $(this).addClass('active');
        var order_status_filter = $(this).val();
        //alert(order_status_filter);
        $("#promotions_messaging_table").attr("order_date", order_status_filter);
        $("#messaging_hub_download_date_filter").val(order_status_filter);
        DataTableBind($("#promotions_messaging_table"), true);
    });


    $("body").on("change", "#messaging_hub_daterange", function(event) {
        event.preventDefault();
        $('.messaging_hub_date_filter').removeClass('active');
        $(this).addClass('active');
        var messaging_daterange = $(this).val();        
        $("#promotions_messaging_table").attr("order_date", messaging_daterange);       
        DataTableBind($("#promotions_messaging_table"), true);
        return;
    });


      $("body").on("click", "#promotions_messaging_table tr", function(event) {
        event.preventDefault();
        var ele = $(this).find(".fetchDetails");
        $("#promotions_messaging_table").find("tr").removeClass("active");
        $(this).addClass("active");

        var fetchUrl = ele.attr("fetchUrl");
        var appendDivId = ele.attr("appendDivId");
        var fetchId = ele.attr("fetchId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

       $("body").on("change", "#messaging_city_dd", function(event) {
        event.preventDefault();
        var messaging_city = $(this).val();
        $("#messaging_customers_ajax_table").attr("city_id", messaging_city);
        DataTableBind($("#messaging_customers_ajax_table"), true);
        $("#messaging_merchants_ajax_table").attr("city_id", messaging_city);
        DataTableBind($("#messaging_merchants_ajax_table"), true);
        $("#messaging_team_ajax_table").attr("city_id", messaging_city);
        DataTableBind($("#messaging_team_ajax_table"), true);
    });

      $("body").on("click", "#download_messaging_hub_btn", function() {
        $('#download_messaging_hub_form').submit();
    });

      $("body").on("change", "#MessageType", function() {

                var msg_type = $('#MessageType').val();

                if(msg_type == 'email'){

                    // ClassicEditor.destroy(document.querySelector( '#editor' ));

                    // ClassicEditor
                    // .create( document.querySelector( '#editor' ) )
                    // .catch( error => {
                    //     console.error( error );
                    // } );
                    
                    $('#editor_block').removeClass('d-none');
                    $('#MessageContentBlock').addClass('d-none');
                }else{
                    $('#MessageContentBlock').removeClass('d-none');
                    $('#editor_block').addClass('d-none');
                }
                

            });

      $("body").on("change", "input[type=checkbox][name=messaging_customer_id_selection]", function() {
                event.preventDefault();
                var fetchId = $(this).attr("fetchId");
                var MessagingType = $(this).attr("MessagingType");
                if (!messaging_cust_ids.includes(fetchId)) {
                    messaging_cust_ids.push(fetchId);
                } else {
                    var index = messaging_cust_ids.indexOf(fetchId);
                    if (index >= 0) {
                        messaging_cust_ids.splice(index, 1);
                    }
                }
                
                $('#MessagingSourceType').val(MessagingType);
                $('#MessagingSource').val(messaging_cust_ids);
                $('#table_reload').val(messaging_cust_ids);
                // $('#ntf_send_msg_btn').attr("SourceType", MessagingType);
                // $('#ntf_send_msg_btn').attr("Source", messaging_team_ids);
    
    
                return;
            });

      $("body").on("change", "input[type=checkbox][name=messaging_merchant_id_selection]", function() {
                event.preventDefault();
                var fetchId = $(this).attr("fetchId");
                var MessagingType = $(this).attr("MessagingType");
                if (!messaging_merchant_ids.includes(fetchId)) {
                    messaging_merchant_ids.push(fetchId);
                } else {
                    var index = messaging_merchant_ids.indexOf(fetchId);
                    if (index >= 0) {
                        messaging_merchant_ids.splice(index, 1);
                    }
                }
                
                $('#MessagingSourceType').val(MessagingType);
                $('#MessagingSource').val(messaging_merchant_ids);
                // $('#table_reload').val(messaging_merchant_ids);
                // $('#ntf_send_msg_btn').attr("SourceType", MessagingType);
                // $('#ntf_send_msg_btn').attr("Source", messaging_team_ids);
    
    
                return;
            });

      $("body").on("change", "input[type=checkbox][name=messaging_team_id_selection]", function() {
                event.preventDefault();
    
                var fetchId = $(this).attr("fetchId");
                var MessagingType = $(this).attr("MessagingType");
                if (!messaging_team_ids.includes(fetchId)) {
                    messaging_team_ids.push(fetchId);
                } else {
                    var index = messaging_team_ids.indexOf(fetchId);
                    if (index >= 0) {
                        messaging_team_ids.splice(index, 1);
                    }
                }
                
                //alert(messaging_team_ids);
                $('#MessagingSourceType').val(MessagingType);
                $('#MessagingSource').val(messaging_team_ids);
                // $('#table_reload').val(promotion_cust_ids);
                // $('#ntf_send_msg_btn').attr("SourceType", MessagingType);
                // $('#ntf_send_msg_btn').attr("Source", messaging_team_ids);
    
    
                return;
            });

      $("body").on("click", "#customer_send_message_trigger", function() {
            event.preventDefault();
            

            if( messaging_cust_ids.length >= 1)
            {       
                    $('#messging_employess_count').html(messaging_cust_ids.length);
                    $("#notification_team").css("display","none");

                    var fetchurl = $(this).attr("fetchUrl");
                    var formData = { "source": messaging_cust_ids, "channel": 'sms' };
                    $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    cache: false,
                    success: function(data) {
                        $('#messging_single_price').html(data.html.SingleCharge);
                        $('#messging_total_price').html(data.html.TotalCharge);
                        $('#sendmessage').modal('show');
                    }
                    });

                    
            }else{
                swal('Please Select Atleast One Member', {
                    icon: "error",
                });
            }
      });

      $("body").on("click", "#merchant_send_message_trigger", function() {
            event.preventDefault();
            

            if( messaging_merchant_ids.length >= 1)
            {       
                    $('#messging_employess_count').html(messaging_merchant_ids.length);
                    $("#notification_team").css("display","none");

                    var fetchurl = $(this).attr("fetchUrl");
                    var formData = { "source": messaging_merchant_ids, "channel": 'sms' };
                    $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    cache: false,
                    success: function(data) {
                        $('#messging_single_price').html(data.html.SingleCharge);
                        $('#messging_total_price').html(data.html.TotalCharge);
                        $('#sendmessage').modal('show');
                    }
                    });

            }else{
                swal('Please Select Atleast One Merchant', {
                    icon: "error",
                });
            }
      });

       $("body").on("click", "#employee_send_message_trigger", function() {
                event.preventDefault();
    
                if( messaging_team_ids.length >= 1)
                {       
                        $('#messging_employess_count').html(messaging_team_ids.length);
                        $("#notification_team").css("display","block");

                    var fetchurl = $(this).attr("fetchUrl");
                    var formData = { "source": messaging_merchant_ids, "channel": 'notification' };
                    $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    cache: false,
                    success: function(data) {
                        $('#messging_single_price').html(data.html.SingleCharge);
                        $('#messging_total_price').html(data.html.TotalCharge);
                        $('#sendmessage').modal('show');
                    }
                    });
                        
                }else{
                    swal('Please Select Atleast One Employee', {
                        icon: "error",
                    });
                }
            });

       $("body").on("change", "#pr_source_type", function() {
        event.preventDefault();
        var fetchType = $(this).val();
        $("#add_source_btn").attr("source_type", fetchType);
        if (fetchType == 'category') {
            var pr_source_type_txt = 'Categories';
            $('.cust_ex_col').remove();
        } else if (fetchType == 'customer') {
            var pr_source_type_txt = 'Customers';
            $('#spst_cols').html('<th class="px-2 " scope="col">Name</th><th class="px-2 cust_ex_col" scope="col" >Contact No</th><th class="px-2 cust_ex_col" scope="col" >Location</th><th class="px-2 cust_ex_col" scope="col"></th>');
        } else {
            var pr_source_type_txt = 'Merchants';
            $('.cust_ex_col').remove();
        }

        promotion_ids = ['0'];

        $(".pr_source_type_txt").html("Add " + pr_source_type_txt);
        $(".pr_source_type_del_txt").html("Delete " + pr_source_type_txt);
        $(".pr_source_type_ex_txt").html("Existing " + pr_source_type_txt);

        $('#add_promotions_source_table').attr("Source", promotion_ids);
        $('#selected_promotions_source_table').attr("Source", promotion_ids);
        DataTableBind($("#selected_promotions_source_table"), true);

        $('#source').val(promotion_ids);

    });

       $("body").on("click", "#add_source_btn", function() {
        event.preventDefault();
        var fetchType = $(this).attr("source_type");
        var sourceEdit = $(this).attr("sourceEdit");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchurl = $(this).attr("fetchurl");
        var formData = { "fetchType": fetchType, "sourceEdit": sourceEdit  };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {
                $(appendDivId).find('.modal-content').html(data.html);
                DataTableBind($("#add_promotions_source_table"), true);
            }
        });
        return;
    });

       $("body").on("change", "input[type=checkbox][name=promo_id_selection]", function() {
        event.preventDefault();

        var fetchId = $(this).attr("fetchId");
        var PromoType = $(this).attr("PromoType");
        //alert(fetchId);
        if (!promotion_ids.includes(fetchId)) {
            promotion_ids.push(fetchId);
        } else {
            var index = promotion_ids.indexOf(fetchId);
            if (index >= 0) {
                promotion_ids.splice(index, 1);
            }
        }
        $('#Source').val(promotion_ids);
        $('#add_promotions_source_table').attr("Source", promotion_ids);
        $('#add_promotions_source_table').attr("PromoType", PromoType);
        $('#selected_promotions_source_table').attr("Source", promotion_ids);
        $('#selected_promotions_source_table').attr("PromoType", PromoType);
        return;
    });


    $("body").on("click", "#source_filter_submit_btn", function() {
        event.preventDefault();
        $('#selected_promotions_source_table').addClass('ajax_data_table')
        DataTableBind($("#selected_promotions_source_table"), true);
        return;
    });

    $("body").on("click", "#del_source_filter_btn", function() {
        $.each($("#selected_promotions_source_table input[type=checkbox][name='promo_id_selection']:checked"), function() {
            var fetchId = $(this).attr("fetchId");
            var index = promotion_ids.indexOf(fetchId);
            if (index >= 0) {
                promotion_ids.splice(index, 1);
            }
        });

        $('#Source').val(promotion_ids);
        $('#add_promotions_source_table').attr("Source", promotion_ids);
        $('#selected_promotions_source_table').attr("Source", promotion_ids);
        DataTableBind($("#selected_promotions_source_table"), true);

    });


    $("body").on("click", "#job_applicant_send_message_trigger", function() {
            event.preventDefault();
            

            if( emp_job_ids.length >= 1)
            {       
                    $('#messging_employess_count').html(emp_job_ids.length);
                    $("#notification_team").css("display","none");

                    var fetchurl = $(this).attr("fetchUrl");
                    var formData = { "source": emp_job_ids, "channel": 'sms' };
                    $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    cache: false,
                    success: function(data) {
                        $('#messging_single_price').html(data.html.SingleCharge);
                        $('#messging_total_price').html(data.html.TotalCharge);
                        $('#sendmessage').modal('show');
                    }
                    });

                    
            }else{
                swal('Please Select Atleast One Member', {
                    icon: "error",
                });
            }
      });

    $("body").on("change", "input[type=checkbox][name=job_applicant_customer_id_selection]", function() {
                event.preventDefault();
                var fetchId = $(this).attr("fetchId");
                var MessagingType = $(this).attr("MessagingType");
                if (!emp_job_ids.includes(fetchId)) {
                    emp_job_ids.push(fetchId);
                } else {
                    var index = emp_job_ids.indexOf(fetchId);
                    if (index >= 0) {
                        emp_job_ids.splice(index, 1);
                    }
                }
                
                $('#MessagingSourceType').val(MessagingType);
                $('#MessagingSource').val(emp_job_ids);
                $('#table_reload').val(emp_job_ids);
                // $('#ntf_send_msg_btn').attr("SourceType", MessagingType);
                // $('#ntf_send_msg_btn').attr("Source", messaging_team_ids);
    
    
                return;
            });

    $("body").on("click", ".get_schedule_map", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var appendDivId = $(this).attr("href");
        //var appendDivId = $(this).attr("appendDivId");
        var formData = { "fetchId": '', "city": 6 };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchUrl,
            data: formData,
            cache: false,
            success: function(data) {
                load_runner_map(data);
            }
        });
        return;
    });

    function load_runner_map(data) {

        var locations = data.Locations;
        //var locations = JSON.parse(data.Locations);

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: new google.maps.LatLng(data.Latitude, data.Longitude),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }


    }

    window.load_order_table = function load_order_table(order_status_filter, page_load) {
        //alert(page_load);
        if (page_load == false) {
            
            DataTableBind($("#purchase_orders_table"), true);
        }
    }
    
    //yuvraj code promotions module code end
    // dashboard  start
    $( document ).ready(function() {

        var last_segment = window.location.pathname.split('/').pop();
        if(last_segment == 'dashboard')
        {

    
    
           
              load_orders_counts();
            load_orders_type_counts();
            //load_catgory_pie_chart(city, location, order_status_filter);
            load_orders_stacked_chart();
            load_orders_type_stacked_chart();
            load_customer_counts();
            load_customers_stacked_chart();
            load_revenue_pie_chart();

        }
    });

     function load_orders_counts(city,location,date_range,month,year) {
                url = base_url+'/admin/dashboard/get_ajax_orders_counts';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        city: '',
                        location: '',
                        date_range: '',
                        month: '',
                        year: ''
                    },
                    success: function(data) {
            
                        if (data) {
                            var data = JSON.parse(data);
            
                            //$('#total_orders_c').html('');
                            $('#in_progress_orders_c').html('');
                            $('#completed_orders_c').html('');
                            $('#cancelled_orders_c').html('');
                            $('#abandoned_orders_c').html('');
                            $('#new_orders_c').html('');
                            $('#total_orders_c').html(data.total_orders);
                            $('#in_progress_orders_c').html(data.in_progress_orders);
                            $('#completed_orders_c').html(data.completed_orders);
                            $('#cancelled_orders_c').html(data.cancelled_orders);
                            $('#abandoned_orders_c').html(data.abandoned_orders);
                            $('#new_orders_c').html(data.new_orders);
            
                            $('#total_traffic_visited_orders').html('');
                            $('#total_traffic_abandoned_orders').html('');
                            $('#total_traffic_completed_orders').html('');
                            $('#total_traffic_cancelled_orders').html('');
                            $('#total_traffic_visited_orders').html(data.total_orders);
                            $('#total_traffic_abandoned_orders').html(data.abandoned_orders);
                            $('#total_traffic_completed_orders').html(data.completed_orders);
                            $('#total_traffic_cancelled_orders').html(data.cancelled_orders);
                            
                        }
            
                    }
                });
            }

            function load_orders_stacked_chart(city,location,date_range,month,year) {
                url = base_url+'/admin/dashboard/get_ajax_orders';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        city: '',
                        location: '',
                        date_range: '',
                        month: '',
                        year: ''
                    },
                    success: function(data) {
            
                        if (data) {
            
            
                            $('#orders_chart').remove(); 
                            $('#orders_chart_img').remove(); // this is my <canvas> element               
                            $('#orders_chart_block').html('<canvas id="orders_chart" width="550" height="300"><canvas>');
                           
                            
                            var data = JSON.parse(data);
                            
                            var ctx = document.getElementById("orders_chart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data.completed_orders.days,
                                    datasets: [{
                                        label: 'New',
                                        backgroundColor: "#F4B3FF",
                                        data: data.new_orders,
                                        borderRadius: 10,
                                    }, {
                                        label: 'In progress',
                                        backgroundColor: "#ACC2F9",
                                        data: data.in_progress_orders,
                                    }, {
                                        label: 'Completed',
                                        backgroundColor: "#FCC4C4",
                                        data: data.completed_orders.completed_orders,
                                    }, {
                                        label: 'Cancelled',
                                        backgroundColor: "#BAEEFC",
                                        data: data.cancelled_orders,
                                    }, {
                                        label: 'Abandoned',
                                        backgroundColor: "#f9dc93",
                                        data: data.abandoned_orders,
                                    }],
                                },
                                options: {
                                    tooltips: {
                                        displayColors: true,
                                        callbacks: {
                                            mode: 'x',
                                        },
                                    },
                                    scales: {
                                        xAxes: [{
                                            stacked: true,
                                            gridLines: {
                                                display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            stacked: true,
                                            ticks: {
                                                beginAtZero: true,
                                            },
                                            type: 'linear',
                                        }]
                                    },
                                    onClick: function(evt) {
            
                                        // var activePoint = myChart.getElementAtEvent(evt)[0];
                                        // //  var data = activePoint._chart.data;
                                        // //  var datasetIndex = activePoint._datasetIndex;
                                        // //  var label = data.datasets[datasetIndex].label;
                                        // //  var value = data.datasets[datasetIndex].data[activePoint._index];
                                        // var month = activePoint._index;
                                        // //alert(month);
                                        // if (month != '') {
                                        //     get_orders_month_chart(month);
                                        // } else {
                                        //     // $('#myChartmonth_block').hide();
                                        // }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    legend: {
                                        display: false
                                    },
                                }
                            });
            
            
                        }
            
                    }
                });
            }

            function load_customer_counts(city,location,date_range,month,year) {
                url = base_url+'/admin/dashboard/get_ajax_customer_counts';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        city: '',
                        location: '',
                        date_range: '',
                        month: '',
                        year: ''
                    },
                    success: function(data) {
            
                        if (data) {
                            var data = JSON.parse(data);
                            $('#existing_customers_c').html('');
                            $('#new_customers_c').html('');
                            $('#existing_customers_c').html(data.existing_customers_c);
                            $('#new_customers_c').html(data.new_customers_c);
            
                        }
            
                    }
                });
            }


            function load_customers_stacked_chart(city,location,date_range,month,year) {
                url = base_url+'/admin/dashboard/get_ajax_customers';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        city: '',
                        location: '',
                        date_range: '',
                        month: '',
                        year: ''
                    },
                    success: function(data) {
            
                        if (data) {
            
            
            
                            $('#customers_chart').remove(); // this is my <canvas> element
                            $('#customers_chart_img').remove();
                            $('#customers_chart_block').html('<canvas id="customers_chart"  width="550" height="300"><canvas>');
                            var data = JSON.parse(data);
            
                            var ctx = document.getElementById("customers_chart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data.days,
                                    datasets: [{
                                        label: 'Customers',
                                        backgroundColor: "#ACC2F9",
                                        data: data.day_users,
                                    }],
                                },
                                options: {
                                    tooltips: {
                                        displayColors: true,
                                        callbacks: {
                                            mode: 'x',
                                        },
                                    },
                                    scales: {
                                        xAxes: [{
                                            stacked: true,
                                            gridLines: {
                                                display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            stacked: true,
                                            ticks: {
                                                beginAtZero: true,
                                            },
                                            type: 'linear',
                                        }]
                                    },
            
                                    onClick: function(evt) {
            
                                        // var activePoint = myChart.getElementAtEvent(evt)[0];
                                        // //  var data = activePoint._chart.data;
                                        // //  var datasetIndex = activePoint._datasetIndex;
                                        // //  var label = data.datasets[datasetIndex].label;
                                        // //  var value = data.datasets[datasetIndex].data[activePoint._index];
                                        // var month = activePoint._index;
                                        // //alert(month);
                                        // if (month != '') {
                                        //     get_customers_month_chart(month);
                                        // } else {
                                        //     // $('#myChartmonth_block').hide();
                                        // }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    legend: {
                                        display: false
                                    },
                                }
                            });
            
            
                        }
            
                    }
                });
            }

            $("body").on("click", "#nav-home-tab1", function() {
                //alert('orders');
                setTimeout(function() { 

                    var order_status_filter = 'month';
                    var city = $('#dashboard_city_dd').val();
                    var location = '';
    
                    var month = $('#filter_month_dp').val();
                    var year = $('#filter_year_dp').val();
                    load_orders_stacked_chart(city, location, order_status_filter,month,year);

                },1000);
               
            });

            $("body").on("click", "#nav-profile-tab1", function() {
                //alert('customers');
               
                 setTimeout(function() { 
                    var order_status_filter = 'month';
                var city = $('#dashboard_city_dd').val();
                var location = '';

                var month = $('#filter_month_dp').val();
                var year = $('#filter_year_dp').val();


                load_customers_stacked_chart(city, location, order_status_filter,month,year);

                 },1000);
                

            });
            
             function load_revenue_pie_chart(city, location, date_range,month,year) {
                 url = base_url+'/admin/dashboard/get_ajax_revenue';
        $.ajax({
          type: "POST",
          url: url,
          data : { city : '', location : '', date_range : '', month : '', year : ''},
          success: function(data){

            if(data)
            {

              $('#revenue_chart').remove(); // this is my <canvas> element
              $('#revenue_chart_block').html('<canvas id="revenue_chart"  width="450" height="400"><canvas>');
              var data = JSON.parse(data);

              var ctx = document.getElementById("revenue_chart");
                var myChart = new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                    labels: data.services,
                    datasets: [{
                      label: '#',
                      data: data.orders,
                      backgroundColor: [
                        'rgba(224, 30, 132, 1)',
                        'rgba(199, 88, 208, 1)',
                        'rgba(156, 70, 208, 1)',
                        'rgba(142, 108, 239, 1)',
                        'rgba(0, 126, 214, 1)',
                        'rgba(151, 217, 255, 1)',
                        'rgba(95, 183, 212, 1)',
                        'rgba(38, 215, 174, 1)',
                        'rgba(45, 203, 117, 1)',
                        'rgba(213, 243, 11, 1)',
                        'rgba(255, 236, 0, 1)',
                        'rgba(255, 115, 0, 1)'
                      ],
                      borderColor: [
                        'rgba(224, 30, 132, 1)',
                        'rgba(199, 88, 208, 1)',
                        'rgba(156, 70, 208, 1)',
                        'rgba(142, 108, 239, 1)',
                        'rgba(0, 126, 214, 1)',
                        'rgba(151, 217, 255, 1)',
                        'rgba(95, 183, 212, 1)',
                        'rgba(38, 215, 174, 1)',
                        'rgba(45, 203, 117, 1)',
                        'rgba(213, 243, 11, 1)',
                        'rgba(255, 236, 0, 1)',
                        'rgba(255, 115, 0, 1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    //cutoutPercentage: 40,
                    responsive: false,
                    
                    legend : {
                      position: 'right',
                      align : 'center',
                    }
                  }
                });
               
            }

          }
      });
            }

            function load_orders_type_counts(city,location,date_range,month,year) {
                url = base_url+'/admin/dashboard/get_ajax_orders_type_counts';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        city: '',
                        location: '',
                        date_range: '',
                        month: '',
                        year: ''
                    },
                    success: function(data) {
            
                        if (data) {
                            var data = JSON.parse(data);
            
                            //$('#total_orders_c').html('');
                            $('#web_orders_c').html('');
                            $('#pos_orders_c').html('');
                            $('#app_orders_c').html('');
                            $('#phone_orders_c').html('');
                            $('#web_orders_c').html(data.web_orders);
                            $('#pos_orders_c').html(data.pos_orders);
                            $('#app_orders_c').html(data.app_orders);
                            $('#phone_orders_c').html(data.phone_orders);
                        }
            
                    }
                });
            }

            function load_orders_type_stacked_chart(city,location,date_range,month,year) {
                url = base_url+'/admin/dashboard/get_ajax_orders_type';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        city: '',
                        location: '',
                        date_range: '',
                        month: '',
                        year: ''
                    },
                    success: function(data) {
            
                        if (data) {
            
            
                            $('#orders_type_chart').remove(); 
                            $('#orders_type_chart_img').remove(); // this is my <canvas> element               
                            $('#orders_type_chart_block').html('<canvas id="orders_type_chart" width="550" height="300"><canvas>');
                           
                            
                            var data = JSON.parse(data);
                            
                            var ctx = document.getElementById("orders_type_chart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data.web_orders.days,
                                    datasets: [{
                                        label: 'E Commerce',
                                        backgroundColor: "#F4B3FF",
                                        data: data.web_orders.web_orders,
                                        borderRadius: 10,
                                    }, {
                                        label: 'POS',
                                        backgroundColor: "#ACC2F9",
                                        data: data.pos_orders,
                                    }, {
                                        label: 'App',
                                        backgroundColor: "#FCC4C4",
                                        data: data.app_orders,
                                    }, {
                                        label: 'Phone',
                                        backgroundColor: "#BAEEFC",
                                        data: data.phone_orders,
                                    }],
                                },
                                options: {
                                    tooltips: {
                                        displayColors: true,
                                        callbacks: {
                                            mode: 'x',
                                        },
                                    },
                                    scales: {
                                        xAxes: [{
                                            stacked: true,
                                            gridLines: {
                                                display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            stacked: true,
                                            ticks: {
                                                beginAtZero: true,
                                            },
                                            type: 'linear',
                                        }]
                                    },
                                    onClick: function(evt) {
            
                                        // var activePoint = myChart.getElementAtEvent(evt)[0];
                                        // //  var data = activePoint._chart.data;
                                        // //  var datasetIndex = activePoint._datasetIndex;
                                        // //  var label = data.datasets[datasetIndex].label;
                                        // //  var value = data.datasets[datasetIndex].data[activePoint._index];
                                        // var month = activePoint._index;
                                        // //alert(month);
                                        // if (month != '') {
                                        //     get_orders_month_chart(month);
                                        // } else {
                                        //     // $('#myChartmonth_block').hide();
                                        // }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    legend: {
                                        display: false
                                    },
                                }
                            });
            
            
                        }
            
                    }
                });
            }
// dashboard code end
     


     
         // phone orders scripts

         $("body").on("change", "#phone_sm_service_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            var fetchId2 = $(this).attr("fetchId");
            fetchId2 = $('#' + fetchId2).val();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");            
            CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2);
            return;
        });

        $("body").on("change", "#phone_sm_merchant_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");
            CallDetailedView(fetchurl, fetchId, appendDivId);

            var fetchurl1 = $(this).attr("fetchurl1");
            var appendDivId1 = $(this).attr("appendDivId1");
            CallDetailedView(fetchurl1, fetchId, appendDivId1);

            return;
        });
    
        $("body").on("change", "#phone_sm_location_id", function(event) {
            event.preventDefault();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");
            var fetchId = $(this).attr("fetchId");
        
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    $(appendDivId).find('.modal-content').html('');
                    $(appendDivId).find('.modal-content').html(data.html);
                    $(appendDivId).modal('show');
                }
            });
        return;
        });

        $('body').on("click",".phone_orders_item_category",function(){

            var merchant_id = $('#phone_sm_merchant_id').val();
            var location_id = $('#phone_sm_location_id').val();

            if(merchant_id != '' && location_id != '')
            {
                $('.phone_orders_item_category').find('.card').removeClass('card-active');
                $(this).find('.card').addClass('card-active');
               
                var search_key = $('#phone_orders_item_search').val();
                var segment_id = $(this).attr('segment_id');
                var fetchurl = $(this).attr('fetchurl');
                var appendDivId = $(this).attr('appendDivId');
                $("#"+appendDivId).html('');
                var formData = { "merchant_id": merchant_id, "location_id":location_id, "segment_id": segment_id, "search_key":search_key};
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    async: false,
                    cache: false,
                    success: function(data) {
                        $("#"+appendDivId).html( data.html );
                    }
                });
            }else{
                swal('Please Select Merchant Location', {
                    icon: "error",
                });
            }
            return;
        });

        $('body').on("change","#phone_orders_item_search",function(){
            if($(this).val().length >= 1) {
                var merchant_id = $('#phone_sm_merchant_id').val();
                var location_id = $('#phone_sm_location_id').val();

                if(merchant_id != '' && location_id != '')
                {
                    $('.phone_orders_item_category').find('.card').removeClass('card-active');            
                    var merchant_id = $('#phone_sm_merchant_id').val();
                    var location_id = $('#phone_sm_location_id').val();
                    var search_key = $(this).val();
                    var fetchurl = $(this).attr('fetchurl');
                    var appendDivId = $(this).attr('appendDivId');
                    $("#"+appendDivId).html('');
                    var formData = { "merchant_id": merchant_id, "location_id":location_id, "search_key": search_key};
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: fetchurl,
                        data: formData,
                        async: false,
                        cache: false,
                        success: function(data) {
                            $("#"+appendDivId).html( data.html );
                        }
                    });
             

                }else{
                    swal('Please Select Merchant Location', {
                        icon: "error",
                    });
                }
            }
            return;
        });

        $("body").on("click", ".phone_orders_product_modal_btn", function(e) {
            e.preventDefault();
            var ItemId = $(this).attr('ItemId');
            var fetchurl = $(this).attr('fetchurl');
            var formData = { "ItemId": ItemId};
            $("#phone_orders_product_view_modal_body").html('');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.status ){
                        $("#phone_orders_product_view_modal_body").html(data.html);
                    }else{

                    }
                }
            });
            return;
        });

        $('body').on("input","#phone_orders_search_customer_mobile_number",function(e){
            e.preventDefault();
            var $that = $(this);
            var maxlength = 10;
            if($that.val().length == maxlength) {
                e.preventDefault();
                var mobile_number = $that.val();
                var fetchurl = $(this).attr('fetchurl');
                var formData = { "mobile_number": mobile_number};
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    async: false,
                    cache: false,
                    success: function(data) {
                        if( data.Status == 500 ){
                            $("#customer_mobile").val( mobile_number );
                            $('#addcustomer').modal('show');
                            $("#CustomerName").html( '******' );
                            $("#CustomerMobile").html( '+91 *******' );
                            $("#CustomerEmail").html( '*****@***.***' );
                            $("#SavePhoneNumber").val( mobile_number );
                            $('#CustomerOtpVerification').val('');
                        }else{
                            PhoneOrdersCustomerDataAppend(data.customer_data);
                        }
                    }
                });

                PhoneOrdersLoadCartItems();
                return; 
            }
            $that.val($that.val().substr(0, maxlength));
            e.preventDefault();
            return; 


            
        });
       
        function PhoneOrdersCustomerDataAppend( customer_data ){
            $("#CustomerName").html( customer_data.CustomerName );
            $("#CustomerMobile").html( customer_data.CustomerMobile );
            $("#CustomerEmail").html( customer_data.CustomerEmail );
            $("#CustomerId").val( customer_data.CustomerId );
            $('#CustomerOtpVerification').val('');
        }


        $("body").on("click", ".phone_orders_add_to_cart", function(e) {
            e.preventDefault();
            var ItemId = $(this).attr("itemid");
            var action_url = $(this).attr("data-url");
            var customer_id = $("#CustomerId").val();
            if(customer_id != '')
            {
                var phone_orders_cart_item_quantity = $("#phone_orders_cart_item_quantity_"+ItemId ).val();
                var phone_orders_search_customer_mobile_number = $("#phone_orders_search_customer_mobile_number").val();
                if( phone_orders_search_customer_mobile_number == undefined || phone_orders_search_customer_mobile_number == '' || phone_orders_search_customer_mobile_number.length != 10 ){
                
                    swal('Please enter valid mobile number', {
                        icon: "error",
                    });

                    $("#PhoneOrdersAddItems").modal('hide');
                    $("#phone_orders_search_customer_mobile_number").focus();
                    return false;
                }
                if( phone_orders_cart_item_quantity <= 0 ){
                    

                    swal('Please select quantity', {
                        icon: "error",
                    });

                    return false;
                }
                PhoneOrdersAddToCart(action_url,ItemId,phone_orders_cart_item_quantity);
                return;
            }else{
                    swal('Please Enter Valid Customer Details', {
                        icon: "error",
                    });
            }
            
        });


        function PhoneOrdersAddToCart(action_url,ItemId,pos_cart_item_quantity){

            var merchant_id = $('#phone_sm_merchant_id').val();
            var location_id = $('#phone_sm_location_id').val();
            var customer_id = $('#CustomerId').val();

            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(otp_verification_status)
            {

            var formData = { "ItemId": ItemId,'ItemQuantity':pos_cart_item_quantity, 'merchant_id': merchant_id, 'location_id':location_id, 'customer_id':customer_id};
            $.ajax({
                type: "POST",
                dataType: "json",
                url: action_url,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == 200 ){
                        $("#PhoneOrdersAddItems").modal('hide');
                        PhoneOrdersLoadCartItems();
                    }else{

                        swal( data.Message, {
                            icon: "error",
                        });
                    }
                }
            });
            return;
            }else{
                  swal('Customer Verification Not Done, Please Verify Otp', {
                    icon: "error",
                });
            }
        }

        function PhoneOrdersLoadCartItems(){
            var merchant_id = $('#phone_sm_merchant_id').val();
            var location_id = $('#phone_sm_location_id').val();
            var customer_id = $('#CustomerId').val();
            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(otp_verification_status)
            {

            var formData = { "ItemId": '', "merchant_id": merchant_id, "location_id":location_id, "customer_id":customer_id};
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url+'/phone_orders/get_cart_section',
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.status ){
                        $("#phone_orders_cart_items").html(data.html);
                        $("#phone_orders_cart_items_count").html(data.cart_items_count);
                        $('#phone_orders_cart_items_total_amount').html(data.cart_total_amount);

                        $("#phone_orders_cart_items_sub_total").html(data.cart_items_total_amount);
                        $('#phone_orders_cart_items_tax_amount').html(data.tax);
                        $('#phone_orders_cart_items_fee_amount').html(data.fee);
                        $("#phone_orders_cart_items_discount_amount").html(data.discount);
                        $('#phone_orders_cart_items_total_amount1').html(data.cart_total_amount);
                    }else{

                        $("#phone_orders_cart_items").html('');
                        $("#phone_orders_cart_items_count").html('0');
                        $('#phone_orders_cart_items_total_amount').html('0.00');

                        $("#phone_orders_cart_items_sub_total").html('0.00');
                        $('#phone_orders_cart_items_tax_amount').html('0.00');
                        $('#phone_orders_cart_items_fee_amount').html('0.00');
                        $("#phone_orders_cart_items_discount_amount").html('0.00');
                        $('#phone_orders_cart_items_total_amount1').html('0.00');
                        
                    }
                }
            });
            }else{
                $("#phone_orders_cart_items").html('');
                $("#phone_orders_cart_items_count").html('0');
                $('#phone_orders_cart_items_total_amount').html('0.00');

                $("#phone_orders_cart_items_sub_total").html('0.00');
                $('#phone_orders_cart_items_tax_amount').html('0.00');
                $('#phone_orders_cart_items_fee_amount').html('0.00');
                $("#phone_orders_cart_items_discount_amount").html('0.00');
                $('#phone_orders_cart_items_total_amount1').html('0.00');
                
            }

            // $('#phone_orders_cart_items_table').dataTable().fnDestroy();
            // $('#phone_orders_cart_items_table').dataTable();
            
        }

        $("body").on("click", ".phone_orders_clear_cart_item", function(e) {
            var ItemId = $(this).attr('ItemId');
            PhoneOrdersClearCart('one',ItemId);
        });

        $("body").on("click", ".phone_orders_clear_cart", function(e) {
            PhoneOrdersClearCart('all',false);
        });
    
        
        function PhoneOrdersClearCart(CartType,ItemId){

            var merchant_id = $('#phone_sm_merchant_id').val();
            var location_id = $('#phone_sm_location_id').val();
            var customer_id = $('#CustomerId').val();
            
            var formData = { "ItemId":ItemId,'CartType':CartType, 'merchant_id':merchant_id, 'location_id':location_id, 'customer_id': customer_id  };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url+'/phone_orders/clear_cart',
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == 200 ){
                        PhoneOrdersLoadCartItems();
                    }else{
                        
                    }
                }
            });
            return;
        }


        
        $("body").on("click", ".phone_orders_detailed_display", function(e) {
            e.preventDefault();
             var fetchurl = $(this).attr('fetchurl');
             var modal_id = $(this).attr('data-bs-target');
            // payinfo
             var merchant_id = $('#phone_sm_merchant_id').val();
             var location_id = $('#phone_sm_location_id').val();
             var customer_id = $('#CustomerId').val();
             var delivery_type = $('#DeliveryType').val();

             var customer_verification = $('#CustomerOtpVerification').val();
             if(customer_verification)
             {
                if(delivery_type)
                {
                    var formData = { 'merchant_id':merchant_id, 'location_id':location_id , 'customer_id':customer_id };
                    $("#phone_orders_detailed_display_modal_body").html('');
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: fetchurl,
                        data: formData,
                        async: false,
                        cache: false,
                        success: function(data) {
                            if( data.status ){
                                $("#phone_orders_detailed_display_modal_body").html(data.html);
                                $(modal_id).modal('show');
                            }else{

                            }
                        }
                    });
                    return;
                }else{
                    
                    swal('Please Select Delivery Type', {
                        icon: "error",
                    });
                }
             }else{
                
                swal('Please Verify Customer Authentication', {
                    icon: "error",
                });
             }
 
             
        });


        $("body").on("click", "#phone_orders_apply_discount_btn", function(e) {
            e.preventDefault();
             var fetchurl = $(this).attr('fetchurl');
             var discount_type = $('#discount_type').val();
             var discount_percentage = $('#discount_percentage').val();
             var discount_description = $('#discount_description').val();
             var merchant_id = $('#phone_sm_merchant_id').val();
             var location_id = $('#phone_sm_location_id').val();
             var customer_id = $('#CustomerId').val();

             if(merchant_id != '' && location_id != '')
             {

             
             if(discount_type != '' && discount_percentage != ''  )
             {

             var formData = { 'customer_id':customer_id, 'merchant_id':merchant_id, 'location_id':location_id ,'discount_type':discount_type, 'discount_percentage':discount_percentage, 'discount_description':discount_description  };
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == '200' ){
                        
                        PhoneOrdersLoadCartItems();
                        $('#itemdiscount').modal('hide');

                    }else{
                        swal(data.Message, {
                            icon: "error",
                        });
                    }
                }
            });
            
            }else{
                swal('Please Enter All Details', {
                    icon: "error",
                });
            }
        }else{
            swal('Please Select Merchant & Merchant Location', {
                icon: "error",
            });
        }
        });

        

        $("body").on("click", "#phone_orders_send_customer_otp", function(e) {
            e.preventDefault();

            
            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(!otp_verification_status)
            {
            var mobile_number = $('#phone_orders_search_customer_mobile_number').val();
            if(mobile_number != '')
            {
            var maxlength = 10;
            if(mobile_number.length == maxlength) {
                e.preventDefault();
                var customer_id = $('#CustomerId').val();
                var fetchurl = $(this).attr('fetchurl');
                if(customer_id != '')
                {
                    var formData = { "customer_id":customer_id, "mobile_number": mobile_number};
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: fetchurl,
                        data: formData,
                        async: false,
                        cache: false,
                        success: function(data) {
                            if( data.Status == 500 ){
                                
                                swal(data.Message, {
                                    icon: "error",
                                });
                                $('#CustomerId').val('');

                            }else{

                                $("#phone_orders_verify_otp_modal_body").html(data.html);
                                $('#otpverify').modal('show');
                                $('#1').focus();
                                
                            }
                        }
                    });
                }else{
                    swal('Please Register Customer', {
                        icon: "error",
                      });   
                }
                
                return; 
            }else{
                swal('Please Enter Valid Mobile No', {
                    icon: "error",
                  });
            }
            }else{
                swal('Please Enter Mobile No', {
                    icon: "error",
                });
            }

        }else{
            swal('Customer Verification Already Done', {
                icon: "error",
            });
        } 
        });

        $('body').on("click","#phone_orders_verify_customer_otp",function(e){
           // e.preventDefault();
       
        if($('#1').val() != '' && $('#2').val() != '' && $('#3').val() != '' && $('#4').val() != '')
        {
            var mobile_no = $('#otp_customer_mobile').val();
            var customer_id = $('#otp_customer_id').val();
            var otp = $('#1').val()+$('#2').val()+$('#3').val()+$('#4').val();
            var fetchurl = $(this).attr('fetchurl');
            
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data : { mobile_no : mobile_no , customer_id : customer_id, otp : otp},
                    success: function(data){
        
                        if(data.Status == '200')
                        {
                           
                            $('#otpverify').modal('hide');
                            $("#CustomerId").val( data.customer_id );
                            $("#CustomerOtpVerification").val(1);
                            PhoneOrdersLoadCartItems();
        
                        }else{
        
                           
                            
                        }          
        
                    }
                });//e.prevenDefault();
        }else{
                

                swal('Please enter otp', {
                    icon: "error",
                });

        }
        
        
         });

         $("body").delegate(".otp_txt_box", "keyup", function(){
                     
            var c_id = $(this).attr('id');
            var c_id_val = $('#'+c_id).val();
            if (c_id_val.length == 1 ){                      
                var next_id = parseInt(c_id) + 1;                     
                $('#'+next_id).focus();
            }else{
                $('#'+c_id).val(c_id_val.substr(0,1));
            }
        });

        
        $("body").on("click", "#phone_orders_place_order", function(e) {
            e.preventDefault();

            var customer_id = $("#CustomerId").val();
            var fetchurl = $(this).attr('fetchurl');
            var merchant_id = $('#phone_sm_merchant_id').val();
            var location_id = $('#phone_sm_location_id').val();
            var city_id = $('#phone_sm_city_id').val();
 
            var formData = { 'merchant_id':merchant_id, 'location_id':location_id, 'customer_id':customer_id, 'city_id':city_id  };

            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == '200' ){
                        swal(data.Message, {
                            icon: "success",
                        });
                        $('#payinfo').modal('hide');
                        PhoneOrdersClearCart('all',false);
                        location.href = 'http://bazaar-portal.deliverease.in/purchase_orders';
                    }else{
                        swal(data.Message, {
                            icon: "error",
                        });
                        //$('#payinfo').modal('hide');
                    }
                }
            });
            return;
        });


        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    
            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }
    
        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    
            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }
        $("body").delegate(".button-plus", "click", function(e){
        //$('.input-group').on('click', '.button-plus', function(e) {
            incrementValue(e);
        });
    
        $("body").delegate(".button-minus", "click", function(e){
            decrementValue(e);
        });

        $("body").on("click", ".phone_orders_update_cart_item_quantity", function(e) {
            //e.preventDefault();
            var ItemId = $(this).attr("itemid");
            var action_url = $(this).attr("data-url");
            var pos_cart_section_item_quantity = $("#phone_orders_cart_section_item_quantity_"+ItemId ).val();
            //var pos_cart_section_item_quantity = 1;
            if( pos_cart_section_item_quantity > 0 ){
                PhoneOrdersAddToCart(action_url,ItemId,pos_cart_section_item_quantity );
            }else{
                PhoneOrdersClearCart('one',ItemId);
            }
            return;
        });

        

        $("body").on("click", "#SaveCustomerDetailsBtn", function(e) {
            e.preventDefault();

            var fetchurl = $(this).attr('fetchurl');
            var customer_name = $('#SaveCustomerName').val();
            var phone_no = $('#SavePhoneNumber').val();
            var email_id = $('#SaveEmailId').val();
            var address = $('#SaveAddress').val();
            var address1 = $('#SaveAddress1').val();
            var city = $('#SaveCity').val();
            var state = $('#SaveState').val();
            var pin_code = $('#SavePinCode').val();
            var latitude = $('#SaveLatitude').val();
            var longitude = $('#SaveLongitude').val();
            
            if(customer_name != '' && phone_no != '' && email_id != '' && address != '' && city != '' && state != '' && pin_code != '' )
            {
            var formData = { 'customer_name':customer_name, 'phone_no':phone_no, 'email_id' : email_id, 'address' : address,
                             'address1':address1, 'city':city, 'state' : state, 'pin_code' : pin_code, 'latitude': latitude, 'longitude': longitude };

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    async: false,
                    cache: false,
                    success: function(data) {
                        if( data.Status == '200' ){
                            
                            swal(data.Message, {
                                icon: "success",
                            });
                            $('#addcustomer').modal('hide');
                            $('#phone_orders_search_customer_mobile_number').val(phone_no).trigger("input");
                            PhoneOrdersLoadCartItems();
                        }else{

                        }
                    }
                });
                return;
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }

        });



        $("body").on("click", "#order-details-row-addbtn", function(e) {
        $('.add_sku_item').val('');
        $(".sku-row").show();

        });

        $("body").on("click", "#order-details-row-cancelbtn", function(e) {

            $(".sku-row").hide();
    
            });

        

        $("body").on("click", ".order-details-row-deletebtn", function(event) {

            event.preventDefault();
            var fetchurl = $(this).attr("fetchurl");
            var fetchId = $(this).attr("fetchId");
        
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    if(data.Status == '200')
                    {
                        $('#item_row_'+fetchId).remove();
                        $('.order_view_more').click();
                    }
                   
                }
            });
            return;

        });

        $("body").on("click", ".order-details-row-editbtn", function(event) {

            event.preventDefault();            
            var fetchId = $(this).attr("fetchId");
            $('.sku_editale_'+fetchId).removeClass('hide');
            $('.sku_label_editale_'+fetchId).addClass('hide');

        });

        $("body").on("click", ".order-details-row-addbtn", function(event) {

            event.preventDefault();            
            $(".sku-row").show();

        });

        
        $("body").delegate("#order-details-row-addsubmitbtn", "click", function(event){
            event.preventDefault();
            var fetchurl = $(this).attr("fetchurl");
            var fetchId = $(this).attr("fetchId");
            var quantity = $('#item_quantity_'+fetchId).val();
            var item_name = $('#item_name_'+fetchId).val();
            var price = $('#item_price_'+fetchId).val();
            var item_id = $('#item_id_'+fetchId).val();

            var formData = { "fetchId": fetchId, "quantity" : quantity, "item_name" : item_name, "price" : price, "item_id" : item_id };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    if(data.Status == '200')
                    {
                        $('.order_view_more').click();
                    }
                   
                }
            });
            return;

        });


        $("body").on("click", ".order-details-row-updatebtn", function(event) {

            event.preventDefault();
            var fetchurl = $(this).attr("fetchurl");
            var fetchId = $(this).attr("fetchId");
            var quantity = $('#item_quantity_'+fetchId).val();
            var item_name = $('#item_name_'+fetchId).val();
            var price = $('#item_price_'+fetchId).val();
            var item_id = $('#item_id_'+fetchId).val();

            var formData = { "fetchId": fetchId, "quantity" : quantity, "item_name" : item_name, "price" : price, "item_id" : item_id };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    if(data.Status == '200')
                    {
                        $('.order_view_more').click();
                        
                    }
                   
                }
            });
            return;

        });


        $("body").on("click", ".time_slot_details_change", function() {
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("data-bs-target");
            var fetchId = $(this).attr("fetchId");
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    $(appendDivId).find(".modal-body").html('');
                    $(appendDivId).find(".modal-body").html(data.html);
                    $(appendDivId).modal("show");
                }
            });
            return;
        });

        $("body").on("click", ".fe_job_role_change", function() {
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("data-bs-target");
            var fetchId = $(this).attr("fetchId");
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    $(appendDivId).find(".modal-body").html('');
                    $(appendDivId).find(".modal-body").html(data.html);
                    $(appendDivId).modal("show");
    
                }
            });
            return;
        });
    
    
        $("body").on("click", ".fe_holiday_shift_change", function() {
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("data-bs-target");
            var fetchId = $(this).attr("fetchId");
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    $(appendDivId).find(".modal-body").html('');
                    $(appendDivId).find(".modal-body").html(data.html);
                    $(appendDivId).modal("show");
    
                }
            });
            return;
        });
    
    
        $("body").on("change", "#pay_engine_job_role_dd", function() {
       
            var fetchId = $(this).val();    
           // if(fetchId != '')
           // {
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");
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
           
           //return;
           var fetchId = $("#pay_engine_job_role_dd").val();
           var fetchId2 = $("#pay_engine_time_slot_dd").val();    
          // if(fetchId != '')
          // {
           var fetchurl2 = $(this).attr("fetchurl2");
           var appendDivId2 = $(this).attr("appendDivId2");
           var fetchId3 = $("#pay_engine_driver_count_dd").val();    
           var fetchId4 = $("#pay_engine_transport_service_dd").val();
         
          // CallDetailedView(fetchUrl, fetchId, appendDivId);
          // return;
          // }
   
          var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "fetchId3": fetchId3, "fetchId4": fetchId4 };
        //   $.ajax({
        //       type: "POST",
        //       dataType: "json",
        //       url: fetchurl2,
        //       data: formData,
        //       // async: false,
        //       cache: false,
        //       success: function(data) {
        //           $("#" + appendDivId2).html(data.html);
        //       }
        //   });
          return;
   
   
       });
   
       $("body").on("change", "#pay_engine_time_slot_dd", function() {
          
            
           var fetchId = $("#pay_engine_job_role_dd").val(); 
           // if(fetchId != '')
           // {
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");
            var fetchId2 = $(this).val(); 
          
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
           //return;
   
           var fetchId = $("#pay_engine_job_role_dd").val();
           var fetchId2 = $("#pay_engine_time_slot_dd").val();    
          // if(fetchId != '')
          // {
           var fetchurl2 = $(this).attr("fetchurl2");
           var appendDivId2 = $(this).attr("appendDivId2");
           var fetchId3 = $("#pay_engine_driver_count_dd").val();    
           var fetchId4 = $("#pay_engine_transport_service_dd").val();
         
          // CallDetailedView(fetchUrl, fetchId, appendDivId);
          // return;
          // }
   
          var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "fetchId3": fetchId3, "fetchId4": fetchId4 };
        //   $.ajax({
        //       type: "POST",
        //       dataType: "json",
        //       url: fetchurl2,
        //       data: formData,
        //       // async: false,
        //       cache: false,
        //       success: function(data) {
        //           $("#" + appendDivId2).html(data.html);
        //       }
        //   });
          return;
   
   
   
       });


       $("body").on("click", ".fe_driver_pay_attendance_details_change", function() {
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {
                $(appendDivId).find(".modal-body").html('');
                $(appendDivId).find(".modal-body").html(data.html);
                $(appendDivId).modal("show");

            }
        });
        return;
    });

    
    var job_role_fetchId = $('#pay_engine_job_role_dd').val();    

    if(job_role_fetchId != '')
    {
    // var job_role_fetchUrl = $('#pay_engine_job_role_dd').attr("fetchurl");
    // var job_role_appendDivId = $('#pay_engine_job_role_dd').attr("appendDivId");
        
   
    // CallDetailedView(job_role_fetchUrl, job_role_fetchId, job_role_appendDivId);


    var fetchId = $('#pay_engine_job_role_dd').val();    
    // if(fetchId != '')
    // {
     var fetchurl = $('#pay_engine_job_role_dd').attr("fetchurl");
     var appendDivIdNew = $('#pay_engine_job_role_dd').attr("appendDivId");
     var fetchId2 = $("#pay_engine_time_slot_dd").val();
    //alert(appendDivIdNew);
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
            //alert(appendDivIdNew);
            $("#" + appendDivIdNew).html(data.html);
        }
    });

  
    }
   
 
    var attendance_fetchId = $('#pay_engine_transport_service_dd').val();
    var attendance_fetchId2 = $("#pay_engine_job_role_dd").val();

    if(attendance_fetchId != '' && attendance_fetchId2 != '')
    {
        // var attendance_fetchUrl = $('#pay_engine_transport_service_dd').attr("fetchurl");
        // var attendance_appendDivId = $('#pay_engine_transport_service_dd').attr("appendDivId");
       
        // CallDetailedView(attendance_fetchUrl, attendance_fetchId, attendance_appendDivId, attendance_fetchId2);

        var fetchId = $("#pay_engine_job_role_dd").val();
        var fetchId2 = $("#pay_engine_time_slot_dd").val();    
       // if(fetchId != '')
       // {
        var fetchurl = $('#pay_engine_transport_service_dd').attr("fetchurl");
        var appendDivId = $('#pay_engine_transport_service_dd').attr("appendDivId");
        var fetchId3 = $("#pay_engine_driver_count_dd").val();    
        var fetchId4 = $('#pay_engine_transport_service_dd').val();
      
       // CallDetailedView(fetchUrl, fetchId, appendDivId);
       // return;
       // }

       var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "fetchId3": fetchId3, "fetchId4": fetchId4 };
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
       //return;
    
    }
       // $("#order-details-row-deletebtn").click(function(){
            //       $("#sku-first-row").hide();
            //     });
//   $(document).ready(function(){
//     $("#edit-pickup-details").click(function(){
//       $(".pickup-field").show();
//       $("#edit-pickup-details-submit").show();
//       $(".pickup-details-hide").hide();
//       $("#edit-pickup-details").hide();
//     });
//   });

//   $(document).ready(function(){
//     $("#edit-dropoff-details").click(function(){
//       $(".dropoff-field").show();
//       $("#edit-dropoff-details-submit").show();
//       $(".dropoff-details-hide").hide();
//       $("#edit-dropoff-details").hide();
//     });
//   });

//   $(document).ready(function(){
//     $("#edit-retailers-details").click(function(){
//       $(".retailers-field").show();
//       $("#edit-retailers-details-submit").show();
//       $(".retailers-details-hide").hide();
//       $("#edit-retailers-details").hide();
//     });
//   });

//   $(document).ready(function(){
//     $(".edit-icon").click(function(){
//       $(".sku-field").show();
//       $(".sku-price-field").css("display", "inline-block");
//       $(".edit-icon").hide();
//       $(".delete-icon").hide();
//       $(".sku-details-hide").hide();
//       $(".sku-add-btn").hide();
//       $(".sku-submit-btn").show();
//     });
//   });

//   $(document).ready(function(){
//     $("#order-details-row-addbtn").click(function(){
//       $(".sku-row").show();
//     });

//     $("#order-details-row-deletebtn").click(function(){
//       $("#sku-first-row").hide();
//     });
//   });

//   $(document).ready(function(){
//     $(".approve-transction-btn").click(function(){
//       $("#transaction-status").slideDown();
//     });
//   });


     //admin module start

        $("body").on("change", ".city_service_status_change", function() {
        event.preventDefault();
        var status = $(this).val();
        var fetchurl = $(this).attr("fetchurl");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId, "status": status };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {

            }
        });
        return;
    });

         $("body").on("click", ".city_view_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var appendDivId = $(this).attr("appendDivId");
        var fetchId = $(this).attr("fetchId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

         $("body").on("click", ".service_view_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var appendDivId = $(this).attr("appendDivId");
        var fetchId = $(this).attr("fetchId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

         $("body").on("click", "#user_activity_ajax_table tr", function() {
        event.preventDefault();
        var ele = $(this).find(".fetchDetails");
        $("#user_activity_ajax_table").find("tr").removeClass("active");
        $(this).addClass("active");

        var fetchUrl = ele.attr("fetchUrl");
        var appendDivId = ele.attr("appendDivId");
        var fetchId = ele.attr("fetchId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

         $("body").on("change", ".user_role_dd", function() {
        event.preventDefault();
        var role_filter = $(this).val();
        var table_id = $(this).attr("table_id");
        var append_attr = $(this).attr("append_attr");
        $("#" + table_id).attr(append_attr, role_filter);
        DataTableBind($("#" + table_id), true);
    });

         $("body").on("change","#CityId",function(){
            var CityId = $(this).val();
            var element = $(this).find('option:selected'); 
            var citywiseservice = element.attr("CityWiseService")
            var html = '<option value="">Select Merchant Type</option>';
            if( CityId != '' && citywiseservice != '' ){
                citywiseservice = citywiseservice.split("::");
                $.each( citywiseservice, function( index, ServiceData ) {
                    ServiceData = ServiceData.split('_');
                    html += '<option value="'+ServiceData[0]+'">'+ServiceData[1]+'</option>';
                });
            }
            $("#ServiceId").html( html );
        });

         $(document).ready(function(){
         $('#closed_days').select2();
         });

        //admin module end

         // profile module start

        $("body").on("change", ".segment_status_change", function() {
        event.preventDefault();
        var checked = $(this).attr("checked");
        $(this).attr("checked", checked);
        StatusChangeCall($(this));
        return false;
    });

        $("body").on("change", ".sub_segment_status_change", function() {
        event.preventDefault();
        var checked = $(this).attr("checked");
        $(this).attr("checked", checked);
        StatusChangeCall($(this));
        return false;
    });

        $("body").on("change", ".merchant_location_status_change", function() {
        event.preventDefault();
        var checked = $(this).attr("checked");
        $(this).attr("checked", checked);
        StatusChangeCall($(this));
        return false;
    });

        $("body").on("click", "#add_segment_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var fetchId = $(this).attr("fetchId");
        var appendDivId = $(this).attr("appendDivId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

        $("body").on("click", "#edit_segment_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var fetchId = $(this).attr("fetchId");
        var appendDivId = $(this).attr("appendDivId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

        $("body").on("click", "#add_sub_segment_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var fetchId = $(this).attr("fetchId");
        var appendDivId = $(this).attr("appendDivId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

        $("body").on("click", "#edit_sub_segment_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var fetchId = $(this).attr("fetchId");
        var fetchId2 = $(this).attr("fetchId2");
        var appendDivId = $(this).attr("appendDivId");
        CallDetailedView(fetchUrl, fetchId, appendDivId, fetchId2);
        return;
    });

        $("body").on("click", ".edit_merchant_location", function() {

        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var fetchId = $(this).attr("fetchId");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {
                $(appendDivId).find('.modal-content').html(data.html);
            }
        });
        return;

    });

        $("body").on("click", "#edit_merchant_btn", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var fetchId = $(this).attr("fetchId");
        var appendDivId = $(this).attr("appendDivId");
        CallDetailedView(fetchUrl, fetchId, appendDivId);
        return;
    });

         //profile module end

         $("body").delegate("#tax_applicable_type", "click", function(){
            if($(this).val() != 'tax' && $(this).val() != '')
            {
                $('.tax_product_block').removeClass('hide');
            }else{
                $('.tax_product_block').addClass('hide');
            }
            
           });
        
        
           $("body").delegate("#tax_submit_btn", "click", function(){
        
            if($('#tax_applicable_type').val() == 'tax' && $('#tax_applicable_type').val() != '')
            {
                if($('#tax_name').val() != '' && $('#tax_type').val() != '' && $('#tax_amount').val() != '' )
                {
                    $('#tax_settings_details_form').submit();
                }else{
                    swal('Please Enter All Fields', {
                        icon: "error",
                    });
                }
            }else if($('#tax_applicable_type').val() == 'product' &&  $('#tax_applicable_type').val() != ''){
                if($('#tax_name').val() != '' && $('#tax_type').val() != '' && $('#tax_amount').val() != '' && $('#tax_segment').val() != '' && $('#tax_sub_segment').val() != '' )
                {
                    $('#tax_settings_details_form').submit();
                }else{
                    swal('Please Enter All Fields', {
                        icon: "error",
                    });
                }
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });
        
           
           $("body").delegate("#fee_submit_btn", "click", function(){
        
            if($('#fee_name').val() != '' && $('#fee_type').val() != '' && $('#fee_amount').val() != '' &&  $('#fee_applicable_type').val() != '')
            {
                $('#fee_settings_details_form').submit();
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });
        
           $("body").on("click", ".fee_settings_change", function(event) {
            
            event.preventDefault();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("data-bs-target");
            var fetchId = $(this).attr("fetchId");
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
        
                    $(appendDivId).find(".modal-body").html(data.html);
                    $(appendDivId).modal('show');
                    
                }
            });
        });
        
        $("body").on("click", ".tax_settings_change", function(event) {
            
            event.preventDefault();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("data-bs-target");
            var fetchId = $(this).attr("fetchId");
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
        
                    $(appendDivId).find(".modal-body").html(data.html);
                    $(appendDivId).modal('show');
                    
                }
            });
        });
        
        $("body").on("change", ".fee_settings_status_change", function(event) {
            event.preventDefault();
        
            var fetchurl = $(this).attr("fetchurl");
            var fetchId = $(this).attr("fetchId");
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {}
            });
            return;
              
        
        });
        
        $("body").on("change", ".tax_settings_status_change", function(event) {
            event.preventDefault();
        
            var fetchurl = $(this).attr("fetchurl");
            var fetchId = $(this).attr("fetchId");
            var formData = { "fetchId": fetchId };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {}
            });
            return;
              
        
        });
            
        //$('.producthistory').DataTable();

        $("body").on("click", "#add_product_modal_open_btn", function(event) {
            event.preventDefault();

            var fields = ["Name","ItemType","ItemQuantity","Description","Instructions","Specifications","Segment","Metric","UnitOfMeasurement","NoUOMType"];

            var i, l = fields.length;
            var fieldname;
            for (i = 0; i < l; i++) {
                fieldname = fields[i];
                if (document.forms["add_inventory_item_form"][fieldname].value === "") {
                alert(fieldname + " can not be empty");
                return false;
                }
            }
           
            $('#editproduct').modal('show');
        });


        $("body").on("click", "#add_product_modal_submit_btn", function(event) {
            event.preventDefault();

            var fields = ["ItemId","MerchantName","Quantity","Date","Description1","MsrPrice","CostPrice","SalePrice","ProductHistoryStatus"];

            var i, l = fields.length;
            var fieldname;
            for (i = 0; i < l; i++) {
                fieldname = fields[i];
                if (document.forms["add_inventory_item_form1"][fieldname].value === "") {
                
                alert(fieldname + " can not be empty");
                return false;
                }else{
                    $('#'+fieldname).val(document.forms["add_inventory_item_form1"][fieldname].value);
                }
            }
            $('#add_inventory_item_form').submit();
            //$('#editproduct').modal('show');
        });


        $("body").delegate("#bar_code_scanner_btn", "click", function(e){

            $('#pos_scanner_modal').modal('show');
           
            var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
            html5QrcodeScanner.render(onSuccessscanning);
        });
    
        function onSuccessscanning(decoded, decodedresult, action_url) {
            //console.log(`code scanned=${decoded}`, decodedresult);
            var action_url = $("#bar_code_scanner_btn").attr("data-url");
            // alert(decoded);
            // alert(action_url);
            if(decoded != '')
            {
                
                var ItemId = decoded;
                var action_url = action_url;
                var customer_id = $("#CustomerId").val();
                if(customer_id != '')
                {
    
                    var pos_cart_item_quantity = $("#pos_cart_item_quantity_"+ItemId ).val();
                    var pos_search_customer_mobile_number = $("#pos_search_customer_mobile_number").val();
                    if( pos_search_customer_mobile_number == undefined || pos_search_customer_mobile_number == '' || pos_search_customer_mobile_number.length != 10 ){
                       
                        swal('Please enter valid mobile number', {
                            icon: "error",
                        });
    
                        $("#AddItems").modal('hide');
                        $("#pos_search_customer_mobile_number").focus();
                        return false;
                    }
                    if( pos_cart_item_quantity <= 0 ){
                        //alert("Please select quantity");
                        swal('Please select quantity', {
                            icon: "error",
                        });
                        return false;
                    }
                    PosAddToCartFromScanner(action_url,ItemId,pos_cart_item_quantity);
                    return;
                }else{
                swal('Please Enter Valid Customer Details', {
                    icon: "error",
                });
        }
            }else{
    
            }
            //alert(decodedresult);
        }
        
        function PosAddToCartFromScanner(action_url,ItemId,pos_cart_item_quantity){

            // var merchant_id = $('#sm_merchant_id').val();
            // var location_id = $('#sm_location_id').val();
            var customer_id = $("#CustomerId").val();
            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(otp_verification_status)
            {
            var formData = { "ItemId": ItemId,'ItemQuantity':pos_cart_item_quantity, 'customer_id':customer_id};
            $.ajax({
                type: "POST",
                dataType: "json",
                url: action_url,
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.Status == 200 ){
                        $("#AddItems").modal('hide');
                        LoadCartItemsFromScanner(data.MerchantId,data.MerchantLocationId);
                    }else{

                        swal( data.Message, {
                            icon: "error",
                        });
                    }
                }
            });
            return;
        }else{
            swal('Customer Verification Not Done, Please Verify Otp', {
              icon: "error",
          });
      }
        }

        function LoadCartItemsFromScanner(merchant_id,location_id){
            // var merchant_id = $('#sm_merchant_id').val();
            // var location_id = $('#sm_location_id').val();
            var customer_id = $("#CustomerId").val();
            var otp_verification_status = $('#CustomerOtpVerification').val();
            if(otp_verification_status)
            {
            var formData = { "ItemId": '', "merchant_id": merchant_id, "location_id":location_id, "customer_id":customer_id};
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url+'/pos_billing/get_cart_section',
                data: formData,
                async: false,
                cache: false,
                success: function(data) {
                    if( data.status ){
                        $("#pos_cart_items").html(data.html);
                        $("#pos_cart_items_count").html(data.cart_items_count);
                        $('#pos_cart_items_total_amount').html(data.cart_total_amount);

                        $("#pos_cart_items_sub_total").html(data.cart_items_total_amount);
                        $('#pos_cart_items_tax_amount').html(data.tax);
                        $('#pos_cart_items_fee_amount').html(data.fee);
                        $("#pos_cart_items_discount_amount").html(data.discount);
                        $('#pos_cart_items_total_amount1').html(data.cart_total_amount);

                    }else{

                        $("#pos_cart_items").html('');
                        $("#pos_cart_items_count").html('0');
                        $('#pos_cart_items_total_amount').html('0.00');

                        $("#pos_cart_items_sub_total").html('0.00');
                        $('#pos_cart_items_tax_amount').html('0.00');
                        $('#pos_cart_items_fee_amount').html('0.00');
                        $("#pos_cart_items_discount_amount").html('0.00');
                        $('#pos_cart_items_total_amount1').html('0.00');
                        

                    }
                }
            });

        }else{
            $("#pos_cart_items").html('');
            $("#pos_cart_items_count").html('0');
            $('#pos_cart_items_total_amount').html('0.00');

            $("#pos_cart_items_sub_total").html('0.00');
            $('#pos_cart_items_tax_amount').html('0.00');
            $('#pos_cart_items_fee_amount').html('0.00');
            $("#pos_cart_items_discount_amount").html('0.00');
            $('#pos_cart_items_total_amount1').html('0.00');
            
        }
        }

        $("body").on("change", "#stock_mgt_segment_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");            
            CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2);

            $("#store_management_ajax_table").attr("sm_segment_id", fetchId);
            DataTableBind($("#store_management_ajax_table"), true);

            return;
        });

        $("body").on("change", "#stock_mgt_sub_segment_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            var fetchId2 = $("#stock_mgt_segment_id").val();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");            
            CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2);

            $("#store_management_ajax_table").attr("sm_sub_segment_id", fetchId);
            DataTableBind($("#store_management_ajax_table"), true);
            return;
        });

        $("body").on("change", "#stock_mgt_brand_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            $("#store_management_ajax_table").attr("sm_brand_id", fetchId);
            DataTableBind($("#store_management_ajax_table"), true);
        });

        $("body").on("change", "#stock_mgt_brand_id", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            $("#store_management_ajax_table").attr("sm_brand_id", fetchId);
            DataTableBind($("#store_management_ajax_table"), true);
        });


        // $("body").on("change", ".validate_date_picker", function() {
            
        //     var date = $(this).val();
        //     validate_date_picker(date);
        // });

        $("body").on("focusout", ".validate_date_picker", function(event) {
            
            var date = $(this).val();
            var field_id =  $(this).attr('id');
            validate_date_picker(date,field_id);
        });

        function validate_date_picker(date,field_id){
            
            if(date != '')
            {
                if(isNaN(Date.parse(date)) || Date.parse(date) <= 0){
                    swal('Please Enter Valid Date', {
                        icon: "error",
                    });
                    $('#'+field_id).focus();
                }
            }
        }


        $("body").on("change", "#tax_segment", function(event) {
            event.preventDefault();
            var fetchId = $(this).val();
            var fetchurl = $(this).attr("fetchurl");
            var appendDivId = $(this).attr("appendDivId");            
            CallDetailedView(fetchurl, fetchId, appendDivId, fetchId2);
            return;
        });


        // POS Pickup Adresses Date- 10-03-2023 start

         $("body").delegate("#curb_pickup_submit_btn", "click", function(){
        
            if($('#Name').val() != '' && $('#DateTime').val() != '' && $('#PhoneNumber').val() != '')
            {
                $('#curb_slide_pickup_form').submit();
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });

         $("body").delegate("#store_pickup_submit_btn", "click", function(){
        
            if($('#StoreName').val() != '' && $('#StoreDateTime').val() != '' && $('#StorePhoneNumber').val() != '')
            {
                $('#store_pickup_form').submit();
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });

         $("body").delegate("#door_delivery_submit_btn", "click", function(){
        
            if($('#DoorName').val() != '' && $('#DoorDateTime').val() != '' && $('#Address').val() != '')
            {
                $('#door_delivery_form').submit();
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });

         // POS Pickup Adresses Date- 10-03-2023 end

         // Phone Orders Pickup Adresses Date- 10-03-2023 end

         $("body").delegate("#phone_orders_door_delivery_submit_btn", "click", function(){
        
            if($('#DoorName').val() != '' && $('#DoorDateTime').val() != '' && $('#Address').val() != '')
            {
                $('#door_delivery_phone_orders_form').submit();
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });

         $("body").delegate("#phone_orders_curb_pickup_submit_btn", "click", function(){
        
            if($('#Name').val() != '' && $('#DateTime').val() != '' && $('#PhoneNumber').val() != '')
            {
                $('#phone_orders_curb_slide_pickup_form').submit();
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });

          $("body").delegate("#phone_orders_store_pickup_submit_btn", "click", function(){
        
            if($('#StoreName').val() != '' && $('#StoreDateTime').val() != '' && $('#StorePhoneNumber').val() != '')
            {
                $('#phone_orders_store_pickup_form').submit();
            }else{
                swal('Please Enter All Fields', {
                    icon: "error",
                });
            }
            
            
           });


        $("body").on("click", "#adm_pwd_change", function() {
        event.preventDefault();
        var c_pwd = $('#current_pwd').val();
        var n_pwd = $('#new_pwd').val();
        var n_c_pwd = $('#new_cnf_pwd').val();
        var fetch_id = $(this).attr('fetchid');
        var fetchurl = $(this).attr('fetchurl');
        if ($('#current_pwd').val() != '' && $('#new_pwd').val() != '' && $('#new_cnf_pwd').val() != '') {

            if ($('#new_pwd').val() === $('#new_cnf_pwd').val()) {
                var formData = { "fetch_id": fetch_id, "c_pwd": c_pwd, "n_pwd": n_pwd, "n_c_pwd": n_c_pwd };
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    cache: false,
                    success: function(data) {
                        //alert(data.Message);
                        swal(data.Message, {
                            icon: "success",
                          });

                        $('#current_pwd').val('');
                        $('#new_pwd').val('');
                        $('#new_cnf_pwd').val('');
                    }
                });

            } else {

                //alert('New password & confirm password should be same');
                swal('New password & confirm password should be same', {
                    icon: "error",
                  });
            }

        } else {

            //alert('all fields were mandatory');
            swal('All Fields Are Mandatory', {
                icon: "error",
              });
        }

        return;
    });

        $("body").on("click", "#adm_user_bank_update", function() {
        event.preventDefault();
        var BankName = $('#ProfileBankName').val();
        var BankBranch = $('#ProfileBankBranch').val();
        var IfscCode = $('#ProfileIfscCode').val();
        var AccountNo = $('#ProfileAccountNo').val();
        var AccountHolderName = $('#ProfileAccountHolderName').val();
        var PaymentDays = $('#ProfilePaymentDays').val();
        var CommissionType = $('#ProfileCommissionType').val();
        var PaymentPercentage = $('#ProfilePaymentPercentage').val();
        var ConvenienceFee = $('#ProfileConvenienceFee').val();
        var PaytmNo = $('#ProfilePaytmNo').val();
        var GooglepayNo = $('#ProfileGooglepayNo').val();
        var PhonepeNo = $('#ProfilePhonepeNo').val();
        var fetch_id = $(this).attr('fetchid');
        var fetchurl = $(this).attr('fetchurl');
        if ($('#BankName').val() != '' && $('#BankBranch').val() != '' && $('#IfscCode').val() != '') {
                var formData = {"fetch_id": fetch_id,  "BankName": BankName, "BankBranch": BankBranch, "IfscCode": IfscCode, "AccountNo": AccountNo , "AccountHolderName": AccountHolderName, "PaymentDays": PaymentDays, "CommissionType": CommissionType, "PaymentPercentage": PaymentPercentage, "ConvenienceFee": ConvenienceFee, "PaytmNo": PaytmNo, "GooglepayNo": GooglepayNo, "PhonepeNo": PhonepeNo};
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: fetchurl,
                    data: formData,
                    cache: false,
                    success: function(data) {
                        //alert(data.Message);
                        swal(data.Message, {
                            icon: "success",
                          });

                        
                    }
                });

            

        } else {

            //alert('all fields were mandatory');
            swal('All Fields Are Mandatory', {
                icon: "error",
              });
        }

        return;
    });

        $("body").on("click", ".profile_merchant_details_btn", function() {
        event.preventDefault();
        var fetchId = $(this).attr("fetchId");
        var fetchUrl = $(this).attr("fetchUrl");
        var appendDivId = $(this).attr("appendDivId");
        //alert(appendDivId);
        
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchUrl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#"+appendDivId).html(data.html);
            }
        });
        return;
    });

         $("body").on("click", ".merchant_city_details", function() {
        event.preventDefault();
        var fetchId = $(this).attr("fetchId");
        var fetchUrl = $(this).attr("fetchUrl");
        var formData = { "fetchId": fetchId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchUrl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#profile_city_name").html(data.html);
            }
        });
        return;
    });



    
    $("body").on("click", ".get_employee_locations", function() {
        event.preventDefault();

        var fetchUrl = $(this).attr("fetchUrl");
        var appendDivId = $(this).attr("appendDivId");
        var schedule_date = $(this).attr("schedule_date");

       
        var formData = { "schedule_date": schedule_date, "city": "0" };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchUrl,
            data: formData,
            cache: false,
            success: function(data) {
                load_runner_map(data,appendDivId);
            }
        });
        return;
    });

    $("body").on("click", ".get_order_scheduled_employee", function() {
        event.preventDefault();
        var fetchUrl = $(this).attr("fetchUrl");
        var appendDivId = $(this).attr("appendDivId");
        var order_date = $(this).attr("order_date");

        $('#order_schedule_employees_ajax_list').attr('schedule_date',order_date);
        DataTableBind($("#order_schedule_employees_ajax_list"), true);

    
        var formData = { "schedule_date": order_date, "city": "0" };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchUrl,
            data: formData,
            cache: false,
            success: function(data) {
                load_runner_map(data,appendDivId);
            }
        });
        return;
    });

    $("body").on("click", "#order_schedule_employees_ajax_list tr", function() {
        event.preventDefault();
        $("#order_schedule_employees_ajax_list").find("tr").removeClass("active");
        $(this).addClass("active");
        return;
    });
  

    $("body").on("click", "#assign_order_btn", function() {
        event.preventDefault();
        var active_runner_ele = $("#order_schedule_employees_ajax_list").find("tr.active");
        if (active_runner_ele.length == 0) {
            
            swal("Please select Employee", {
                icon: "error",
            });

        } else {
            var order_id = $("#order_vm_id").val();
            var runner_id = active_runner_ele.find(".fetchDetails").attr("fetchId");
            var fetchurl = active_runner_ele.find(".fetchDetails").attr("fetchurl");
            var formData = { "runner_id": runner_id, "order_id": order_id };
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fetchurl,
                data: formData,
                cache: false,
                success: function(data) {
                    
                    swal(data.Message, {
                        icon: "success",
                    });

                    $("#Assigndelivery").find(".btn-close").click();
                }
            });
            
        }
       
        var selected_row = $('#selected_row_index').val();
        DataTableBind($("#purchase_orders_table"), true, true,selected_row);
        return;
    });

    function load_runner_map(data,appendDivId) {

        var locations = data.Locations;
        //var locations = JSON.parse(data.Locations);

        var map = new google.maps.Map(document.getElementById(appendDivId), {
            zoom: 13,
            center: new google.maps.LatLng(data.Latitude, data.Longitude),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }


    }

       $("body").on("change", "#assign_employee_cities", function() {
        event.preventDefault();
        var fetchId = $(this).val();
        $("#order_schedule_employees_ajax_list").attr("city_id", fetchId);
        DataTableBind($("#order_schedule_employees_ajax_list"), true);
        //load_city_runners(fetchId);
        return;
        }); 
        
        // function load_city_runners(fetchId, vehicle = '') {

        //     var fetchUrl = "http://localhost/Deliverease.CMS/admin/orders/get_runner_locations";
        //     // var appendDivId = $(this).attr("appendDivId");
        //     //var fetchId = $(this).attr("fetchId");
        //     var formData = { "fetchId": fetchId, "vehicle": vehicle };
        //     $.ajax({
        //         type: "POST",
        //         dataType: "json",
        //         url: fetchUrl,
        //         data: formData,
        //         cache: false,
        //         success: function(data) {
        //             load_runner_map(data);
        //         }
        //     });
        //     return;
    
        // }

       
        $("body").on("focusout", "#retailers_last_active_end_date", function() {

            var start = $('#retailers_last_active_start_date').val();
            var end = $('#retailers_last_active_end_date').val();    

            if(end != '')
            {
                if(isNaN(Date.parse(end)) || Date.parse(end) <= 0){
                    swal('Please Enter Valid Date', {
                        icon: "error",
                    });
                    $('#'+field_id).focus();
                }else{

                    if( (new Date(start).getTime() <= new Date(end).getTime()))
                    {
                        
                    }else{
                        swal('Please Enter Last Active To Date Greater than Start Date', {
                            icon: "error",
                        });
                        $('#retailers_last_active_end_date').focus(); 
                        $("#retailers_last_active_end_date").show();
                    }

                }
            }else{

                swal('Please Enter Last Active Date', {
                    icon: "error",
                });
            }

            
            
        });


        // $("body").on("change", "#retailers_join_start_date", function() {

        //     event.preventDefault();
        //     var retailers_join_start_date = $(this).val();
        //     $("#retailers_ajax_table").attr("join_start_date", retailers_join_start_date);
        //     $('#retailers_join_start_date').val(retailers_join_start_date);
        //     DataTableBind($("#retailers_ajax_table"), true);
        // });
    
        // $("body").on("change", "#retailers_join_end_date", function() {
    
        //     event.preventDefault();
        //     var retailers_join_end_date = $(this).val();
        //     $("#retailers_ajax_table").attr("join_end_date", retailers_join_end_date);
        //     $('#retailers_join_end_date').val(retailers_join_end_date);
        //     DataTableBind($("#retailers_ajax_table"), true);
        // });



        $("body").on("change", "#retailers_join_start_date", function() {

            var start = $('#retailers_join_start_date').val();
            var end = $('#retailers_join_end_date').val();    

            if(start != '')
            {
                if(isNaN(Date.parse(start)) || Date.parse(start) <= 0){
                    swal('Please Enter Valid Date', {
                        icon: "error",
                    });
                    $('#retailers_join_start_date').focus();
                }else{


                    if(end != '')
                    {
                        if(isNaN(Date.parse(end)) || Date.parse(end) <= 0){
                            swal('Please Enter Valid Date', {
                                icon: "error",
                            });
                            $('#retailers_join_end_date').focus();
                        }else{

                            if( (new Date(start).getTime() <= new Date(end).getTime()))
                            {
                                $("#retailers_ajax_table").attr("join_start_date", start);
                                $("#retailers_ajax_table").attr("join_end_date", end);
                                $('#retailers_join_start_date').val(start);
                                $('#retailers_join_end_date').val(end);
                                DataTableBind($("#retailers_ajax_table"), true);

                            }else{
                                swal('Please Enter Join End Date Greater than Join Start Date', {
                                    icon: "error",
                                });
                                $('#retailers_join_start_date').focus(); 
                                $("#retailers_join_start_date").show();
                            }
                        }
                    
                    }
                }

                
            }else{

                swal('Please Enter Join Start Date', {
                    icon: "error",
                });
            }

            
            
        });

        $("body").on("change", "#retailers_join_end_date", function() {

            var start = $('#retailers_join_start_date').val();
            var end = $('#retailers_join_end_date').val();    

            if(end != '')
            {
                if(isNaN(Date.parse(end)) || Date.parse(end) <= 0){
                    swal('Please Enter Valid Date', {
                        icon: "error",
                    });
                    $('#retailers_join_end_date').focus();
                }else{


                    if(start != '')
                    {
                        if(isNaN(Date.parse(start)) || Date.parse(start) <= 0){
                            swal('Please Enter Valid Date', {
                                icon: "error",
                            });
                            $('#retailers_join_satrt_date').focus();
                        }else{

                            if( (new Date(start).getTime() <= new Date(end).getTime()))
                            {
                                $("#retailers_ajax_table").attr("join_start_date", start);
                                $("#retailers_ajax_table").attr("join_end_date", end);
                                $('#retailers_join_start_date').val(start);
                                $('#retailers_join_end_date').val(end);
                                DataTableBind($("#retailers_ajax_table"), true);

                            }else{
                                swal('Please Enter Join End Date Greater than Join Start Date', {
                                    icon: "error",
                                });
                                $('#retailers_join_end_date').focus(); 
                                $("#retailers_join_end_date").show();
                            }
                        }
                    
                    }else{
                        swal('Please Enter Join Start Date', {
                            icon: "error",
                        });
                        $('#retailers_join_start_date').focus(); 
                    }
                }

                
            }else{

                swal('Please Enter Join End Date', {
                    icon: "error",
                });
            }

            
            
        });



           


    // $("body").on("change", "#retailers_last_active_start_date", function() {

    //     event.preventDefault();
    //     var retailers_last_active_start_date = $(this).val();
    //     $("#retailers_ajax_table").attr("last_active_start_date", retailers_last_active_start_date);
    //     $('#retailers_last_active_start_date').val(retailers_last_active_start_date);
    //     DataTableBind($("#retailers_ajax_table"), true);
    // });

    // $("body").on("change", "#retailers_last_active_end_date", function() {

    //     event.preventDefault();
    //     var retailers_last_active_end_date = $(this).val();
    //     $("#retailers_ajax_table").attr("last_active_end_date", retailers_last_active_end_date);
    //     $('#retailers_last_active_end_date').val(retailers_last_active_end_date);
    //     DataTableBind($("#retailers_ajax_table"), true);
    // });

        $("body").on("change", "#retailers_last_active_start_date", function() {

            var start = $('#retailers_last_active_start_date').val();
            var end = $('#retailers_last_active_end_date').val();    

            if(start != '')
            {
                if(isNaN(Date.parse(start)) || Date.parse(start) <= 0){
                    swal('Please Enter Valid Date', {
                        icon: "error",
                    });
                    $('#retailers_last_active_start_date').focus();
                }else{


                    if(end != '')
                    {
                        if(isNaN(Date.parse(end)) || Date.parse(end) <= 0){
                            swal('Please Enter Valid Date', {
                                icon: "error",
                            });
                            $('#retailers_last_active_end_date').focus();
                        }else{

                            if( (new Date(start).getTime() <= new Date(end).getTime()))
                            {
                                $("#retailers_ajax_table").attr("last_active_start_date", start);
                                $("#retailers_ajax_table").attr("last_active_end_date", end);
                                $('#retailers_last_active_start_date').val(start);
                                $('#retailers_last_active_end_date').val(end);
                                DataTableBind($("#retailers_ajax_table"), true);

                            }else{
                                swal('Please Enter Last Active End Date Greater than Last Active Start Date', {
                                    icon: "error",
                                });
                                $('#retailers_last_active_start_date').focus(); 
                                $("#retailers_last_active_start_date").show();
                            }
                        }
                    
                    }
                }

                
            }else{

                swal('Please Enter Last Active Start Date', {
                    icon: "error",
                });
            }

            
            
        });

        $("body").on("change", "#retailers_last_active_end_date", function() {

            var start = $('#retailers_last_active_start_date').val();
            var end = $('#retailers_last_active_end_date').val();    


            if(end != '')
            {
                if(isNaN(Date.parse(end)) || Date.parse(end) <= 0){
                    swal('Please Enter Valid Date', {
                        icon: "error",
                    });
                    $('#retailers_last_active_end_date').focus();
                }else{


                    if(start != '')
                    {
                        if(isNaN(Date.parse(start)) || Date.parse(start) <= 0){
                            swal('Please Enter Valid Date', {
                                icon: "error",
                            });
                            $('#retailers_last_active_start_date').focus();
                        }else{

                            if( (new Date(start).getTime() <= new Date(end).getTime()))
                            {
                                $("#retailers_ajax_table").attr("last_active_start_date", start);
                                $("#retailers_ajax_table").attr("last_active_end_date", end);
                                $('#retailers_last_active_start_date').val(start);
                                $('#retailers_last_active_end_date').val(end);
                                DataTableBind($("#retailers_ajax_table"), true);

                            }else{
                                swal('Please Enter Last Active End Date Greater than Last Active Start Date', {
                                    icon: "error",
                                });
                                $('#retailers_last_active_end_date').focus(); 
                                $("#retailers_last_active_end_date").show();
                            }
                        }
                    
                    }else{
                        swal('Please Enter Join Start Date', {
                            icon: "error",
                        });
                        $('#retailers_last_active_start_date').focus(); 
                    }
                }

                
            }else{

                swal('Please Enter Last Active End Date', {
                    icon: "error",
                });
            }

            
            
        });



        $("body").on("change", "#retailers_min_bill_amount", function() {
    
            
            var min = $('#retailers_min_bill_amount').val();
            var max = $('#retailers_max_bill_amount').val();   

            if(min != '')
            {
                if(max != '')
                {                   

                    if(min <= max)
                    {
                        $("#retailers_ajax_table").attr("min_bill_amount", min);
                        $("#retailers_ajax_table").attr("max_bill_amount", max);
                        $('#retailers_min_bill_amount').val(min);
                        $('#retailers_max_bill_amount').val(max);
                        DataTableBind($("#retailers_ajax_table"), true);

                    }else{
                        swal('Please Enter Min Bill Amount Greater than Max Bill Amount', {
                            icon: "error",
                        });
                        $('#retailers_max_bill_amount').focus(); 
                    }
                    
                
                }
            
                
            }else{

                swal('Please Enter Min Bill Amount', {
                    icon: "error",
                });
            }

        });


        $("body").on("change", "#retailers_max_bill_amount", function() {
    
            
            var min = $('#retailers_min_bill_amount').val();
            var max = $('#retailers_max_bill_amount').val();   

            if(max != '')
            {
                if(min != '')
                {                   

                    if(min <= max)
                    {
                        $("#retailers_ajax_table").attr("min_bill_amount", min);
                        $("#retailers_ajax_table").attr("max_bill_amount", max);
                        $('#retailers_min_bill_amount').val(min);
                        $('#retailers_max_bill_amount').val(max);
                        DataTableBind($("#retailers_ajax_table"), true);

                    }else{
                        swal('Please Enter Min Bill Amount Greater than Max Bill Amount', {
                            icon: "error",
                        });
                        $('#retailers_max_bill_amount').focus(); 
                    }
                    
                
                }else{
                    swal('Please Enter Min Bill Amount', {
                        icon: "error",
                    });
                    $('#retailers_min_bill_amount').focus(); 
                }
            
                
            }else{

                swal('Please Enter Max Bill Amount', {
                    icon: "error",
                });
            }

        });


             



    $("body").on("change", "#retailers_min_transports", function() {

        event.preventDefault();
        var retailers_min_transports = $(this).val();
        $("#retailers_ajax_table").attr("min_transports", retailers_min_transports);
        $('#retailers_min_transports').val(retailers_min_transports);
        DataTableBind($("#retailers_ajax_table"), true);
    });

    $("body").on("change", "#retailers_max_transports", function() {

        event.preventDefault();
        var retailers_max_transports = $(this).val();

        var retailers_min_transports = $('#retailers_min_transports').val();
        if(retailers_max_transports > retailers_min_transports)
        {
            $("#retailers_ajax_table").attr("max_transports", retailers_max_transports);
            $('#retailers_max_transports').val(retailers_max_transports);
            DataTableBind($("#retailers_ajax_table"), true);
        }else{
            swal('Please Enter MaxOrders Greater thean or Equal to MinOrders', {
                icon: "error",
            });
        }

       
    });


    
    $("body").on("change", "#retailers_min_transports", function() {
    
            
        var min = $('#retailers_min_transports').val();
        var max = $('#retailers_max_transports').val();   

        if(min != '')
        {
            if(max != '')
            {                   

                if(min <= max)
                {
                    $("#retailers_ajax_table").attr("min_transports", min);
                    $("#retailers_ajax_table").attr("max_transports", max);
                    $('#retailers_min_transports').val(min);
                    $('#retailers_max_transports').val(max);
                    DataTableBind($("#retailers_ajax_table"), true);

                }else{
                    swal('Please Enter Min Transports Greater than Max Transports', {
                        icon: "error",
                    });
                    $('#retailers_min_transports').focus(); 
                }
                
            
            }
        
            
        }else{

            swal('Please Enter Min Transports', {
                icon: "error",
            });
        }

    });


    $("body").on("change", "#retailers_max_transports", function() {

        
        var min = $('#retailers_min_transports').val();
        var max = $('#retailers_max_transports').val();   

        if(max != '')
        {
            if(min != '')
            {                   

                if(min <= max)
                {
                    $("#retailers_ajax_table").attr("min_transports", min);
                    $("#retailers_ajax_table").attr("max_transports", max);
                    $('#retailers_min_transports').val(min);
                    $('#retailers_max_transports').val(max);
                    DataTableBind($("#retailers_ajax_table"), true);

                }else{
                    swal('Please Enter Min Transports Greater than Max Transports', {
                        icon: "error",
                    });
                    $('#retailers_min_transports').focus(); 
                }
                
            
            }else{
                swal('Please Enter Min Transports', {
                    icon: "error",
                });
                $('#retailers_min_transports').focus(); 
            }
        
            
        }else{

            swal('Please Enter Max Bill Amount', {
                icon: "error",
            });
        }

    });

    
    $("body").on("click", "#instore_trigger_block", function() {

        var fetchurl = $(this).attr("fetchurl");
        var formData = { "fetchId": "0" };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {
                if(data.Status == '200')
                {
                    $('.pospickup').removeClass('active');
                    $('#instore_trigger').addClass('active');
                    $('#DeliveryType').val('1');
                
                }
                
            }
        });

        
    });
    
    $(document).ready(function() {
        var owl = $('.browse-cate');
        owl.owlCarousel({
            stagePadding: 0,
            margin: 10,
            nav: true,
            loop: true,
            autoplay: false,
            autoplayTimeout: 900,
            dots: false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 4
                }
            }
        })
      });

}());