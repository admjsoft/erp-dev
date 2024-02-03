<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{
    var $table = 'gtg_products';
    var $column_order = array(null, 'gtg_products.product_name', 'gtg_products.qty', 'gtg_products.product_code', 'gtg_product_cat.title', 'gtg_products.product_price', null); //set column field database for datatable orderable
    var $column_search = array('gtg_products.product_name', 'gtg_products.product_code', 'gtg_product_cat.title', 'gtg_warehouse.title'); //set column field database for datatable searchable
    var $order = array('gtg_products.pid' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($id = '', $w = '', $sub = '')
    {
        $this->db->select('gtg_products.*,gtg_product_cat.title AS c_title,gtg_warehouse.title');
        $this->db->from($this->table);
        $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse');
        if ($sub) {
            $this->db->join('gtg_product_cat', 'gtg_product_cat.id = gtg_products.sub_id');

            if ($this->input->post('group') != 'yes') $this->db->where('gtg_products.merge', 0);
            if ($this->aauth->get_user()->loc) {
                $this->db->group_start();
                $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);
                if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
                $this->db->group_end();
            } elseif (!BDATA) {
                $this->db->where('gtg_warehouse.loc', 0);
            }

            $this->db->where("gtg_products.sub_id=$id");
        } else {
            $this->db->join('gtg_product_cat', 'gtg_product_cat.id = gtg_products.pcat');

            if ($w) {

                if ($id > 0) {
                    $this->db->where("gtg_warehouse.id = $id");
                    // $this->db->where('gtg_products.sub_id', 0);
                }
                if ($this->aauth->get_user()->loc) {
                    $this->db->group_start();
                    $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);

                    if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
                    $this->db->group_end();
                } elseif (!BDATA) {
                    $this->db->where('gtg_warehouse.loc', 0);
                }
            } else {

                if ($this->input->post('group') != 'yes') $this->db->where('gtg_products.merge', 0);
                if ($this->aauth->get_user()->loc) {
                    $this->db->group_start();
                    $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);
                    if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
                    $this->db->group_end();
                } elseif (!BDATA) {
                    $this->db->where('gtg_warehouse.loc', 0);
                }
                if ($id > 0) {
                    $this->db->where("gtg_product_cat.id = $id");
                    $this->db->where('gtg_products.sub_id', 0);
                }
            }
        }

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) // here order processing
        {
            $this->db->order_by($this->column_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($id = '', $w = '', $sub = '')
    {
        if ($id > 0) {
            $this->_get_datatables_query($id, $w, $sub);
        } else {
            $this->_get_datatables_query();
        }
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($id, $w = '', $sub = '')
    {
        if ($id > 0) {
            $this->_get_datatables_query($id, $w, $sub);
        } else {
            $this->_get_datatables_query();
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse');
        if ($this->aauth->get_user()->loc) {

            $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
        } elseif (!BDATA) {
            $this->db->where('gtg_warehouse.loc', 0);
        }
        return $this->db->count_all_results();
    }

    public function addnew($catid, $warehouse, $product_name, $product_code, $product_price, $factoryprice, $taxrate, $disrate, $product_qty, $product_qty_alert, $product_desc, $image, $unit, $barcode, $v_type, $v_stock, $v_alert, $wdate, $code_type, $w_type = '', $w_stock = '', $w_alert = '', $sub_cat = '', $b_id = '', $serial = '',$delivery_order_number='')
    {
        $ware_valid = $this->valid_warehouse($warehouse);
        if (!$sub_cat) $sub_cat = 0;
        if (!$b_id) $b_id = 0;
        $datetime1 = new DateTime(date('Y-m-d'));

        $datetime2 = new DateTime($wdate);

        $difference = $datetime1->diff($datetime2);
        if (!$difference->d > 0) {
            $wdate = null;
        }

        // echo $wdate;
        // exit;


        if ($this->aauth->get_user()->loc) {
            if ($ware_valid['loc'] == $this->aauth->get_user()->loc or $ware_valid['loc'] == '0' or $warehouse == 0) {
                if (strlen($barcode) > 5 and is_numeric($barcode)) {
                    $data = array(
                        'pcat' => $catid,
                        'warehouse' => $warehouse,
                        'product_name' => $product_name,
                        'product_code' => $product_code,
                        'product_price' => $product_price,
                        'fproduct_price' => $factoryprice,
                        'taxrate' => $taxrate,
                        'disrate' => $disrate,
                        'qty' => $product_qty,
                        'product_des' => $product_desc,
                        'alert' => $product_qty_alert,
                        'unit' => $unit,
                        'image' => $image,
                        'barcode' => $barcode,
                        'expiry' => $wdate,
                        'code_type' => $code_type,
                        'sub_id' => $sub_cat,
                        'b_id' => $b_id
                    );
                } else {

                    $barcode = rand(100, 999) . rand(0, 9) . rand(1000000, 9999999) . rand(0, 9);

                    $data = array(
                        'pcat' => $catid,
                        'warehouse' => $warehouse,
                        'product_name' => $product_name,
                        'product_code' => $product_code,
                        'product_price' => $product_price,
                        'fproduct_price' => $factoryprice,
                        'taxrate' => $taxrate,
                        'disrate' => $disrate,
                        'qty' => $product_qty,
                        'product_des' => $product_desc,
                        'alert' => $product_qty_alert,
                        'unit' => $unit,
                        'image' => $image,
                        'barcode' => $barcode,
                        'expiry' => $wdate,
                        'code_type' => 'EAN13',
                        'sub_id' => $sub_cat,
                        'b_id' => $b_id
                    );
                }
                $this->db->trans_start();
                if ($this->db->insert('gtg_products', $data)) {
                    $pid = $this->db->insert_id();
                    $this->movers(1, $pid, $product_qty, 0, 'Stock Initialized');
                    $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                   
                    
                    // $thirdparty_vendors = $this->db->select('Id, VendorName, Status')->get('merchant_thirdparty_vendors')->result_array();
                
                    // if (!empty($thirdparty_vendors)) {
                    //     foreach ($thirdparty_vendors as $th_vendor) {
                    //         $th_data = array(
                    //             "ItemId" => $pid,
                    //             "ThirdPartyVendorId" => $th_vendor['Id'],
                    //             "MerchantId" => '',
                    //             "CityId" => '',
                    //             "LocationId" => '',
                    //             "SegmentId" => $catid,
                    //             "SubSegmentId" => $sub_cat,
                    //             "Price" => $product_price,
                    //             "CrDate" => date('Y-m-d h:i:s', time()),
                    //         );
                    //         $th_f_data[] = $th_data;
                    //     }
                    // }
                
                    // $this->db->insert_batch('merchant_items_thirdparty_pricing', $th_f_data);
                    $this->create_delivery_order($pid,$product_qty,$delivery_order_number,$wdate);
                    echo json_encode(array('status' => 'Success', 'message' =>
                    $this->lang->line('ADDED') . "  <a href='add' class='btn btn-blue btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a> <a href='" . base_url('products') . "' class='btn btn-grey-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a>"));
                } else {
                    echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('ERROR')));
                }
                if ($serial) {
                    $serial_group = array();
                    foreach ($serial as $key => $value) {
                        if ($value) $serial_group[] = array('product_id' => $pid, 'serial' => $value);
                    }
                    $this->db->insert_batch('gtg_product_serials', $serial_group);
                }
                if ($v_type) {
                    foreach ($v_type as $key => $value) {
                        if ($v_type[$key] && numberClean($v_stock[$key]) > 0.00) {
                            $this->db->select('u.id,u.name,u2.name AS variation');
                            $this->db->join('gtg_units u2', 'u.rid = u2.id', 'left');
                            $this->db->where('u.id', $v_type[$key]);
                            $query = $this->db->get('gtg_units u');
                            $r_n = $query->row_array();
                            $data['product_name'] = $product_name . '-' . $r_n['variation'] . '-' . $r_n['name'];
                            $data['qty'] = numberClean($v_stock[$key]);
                            $data['alert'] = numberClean($v_alert[$key]);
                            $data['merge'] = 1;
                            $data['sub'] = $pid;
                            $data['vb'] = $v_type[$key];
                            $this->db->insert('gtg_products', $data);
                            $pidv = $this->db->insert_id();
                            $this->movers(1, $pidv, $data['qty'], 0, 'Stock Initialized');
                            $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                        }
                    }
                }
                if ($w_type) {
                    foreach ($w_type as $key => $value) {
                        if ($w_type[$key] && numberClean($w_stock[$key]) > 0.00 && $w_type[$key] != $warehouse) {
                            $data['product_name'] = $product_name;
                            $data['warehouse'] = $w_type[$key];
                            $data['qty'] = numberClean($w_stock[$key]);
                            $data['alert'] = numberClean($w_alert[$key]);
                            $data['merge'] = 2;
                            $data['sub'] = $pid;
                            $data['vb'] = $w_type[$key];
                            $this->db->insert('gtg_products', $data);
                            $pidv = $this->db->insert_id();
                            $this->movers(1, $pidv, $data['qty'], 0, 'Stock Initialized');
                            $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                        }
                    }
                }
                $this->db->trans_complete();
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
            }
        } else {
            if (strlen($barcode) > 5 and is_numeric($barcode)) {
                $data = array(
                    'pcat' => $catid,
                    'warehouse' => $warehouse,
                    'product_name' => $product_name,
                    'product_code' => $product_code,
                    'product_price' => $product_price,
                    'fproduct_price' => $factoryprice,
                    'taxrate' => $taxrate,
                    'disrate' => $disrate,
                    'qty' => $product_qty,
                    'product_des' => $product_desc,
                    'alert' => $product_qty_alert,
                    'unit' => $unit,
                    'image' => $image,
                    'barcode' => $barcode,
                    'expiry' => $wdate,
                    'code_type' => $code_type,
                    'sub_id' => $sub_cat,
                    'b_id' => $b_id
                );
            } else {
                $barcode = rand(100, 999) . rand(0, 9) . rand(1000000, 9999999) . rand(0, 9);
                $data = array(
                    'pcat' => $catid,
                    'warehouse' => $warehouse,
                    'product_name' => $product_name,
                    'product_code' => $product_code,
                    'product_price' => $product_price,
                    'fproduct_price' => $factoryprice,
                    'taxrate' => $taxrate,
                    'disrate' => $disrate,
                    'qty' => $product_qty,
                    'product_des' => $product_desc,
                    'alert' => $product_qty_alert,
                    'unit' => $unit,
                    'image' => $image,
                    'barcode' => $barcode,
                    'expiry' => $wdate,
                    'code_type' => 'EAN13',
                    'sub_id' => $sub_cat,
                    'b_id' => $b_id
                );
            }
            $this->db->trans_start();
            if ($this->db->insert('gtg_products', $data)) {
                $pid = $this->db->insert_id();
                $this->movers(1, $pid, $product_qty, 0, 'Stock Initialized');
                $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                  
                // $thirdparty_vendors = $this->db->select('Id, VendorName, Status')->get('merchant_thirdparty_vendors')->result_array();
                
                // if (!empty($thirdparty_vendors)) {
                //     foreach ($thirdparty_vendors as $th_vendor) {
                //         $th_data = array(
                //             "ItemId" => $pid,
                //             "ThirdPartyVendorId" => $th_vendor['Id'],
                //             "MerchantId" => '',
                //             "CityId" => '',
                //             "LocationId" => '',
                //             "SegmentId" => $catid,
                //             "SubSegmentId" => $sub_cat,
                //             "Price" => $product_price,
                //             "CrDate" => date('Y-m-d h:i:s', time()),
                //         );
                //         $th_f_data[] = $th_data;
                //     }
                // }
            
                // $this->db->insert_batch('merchant_items_thirdparty_pricing', $th_f_data);
                $this->create_delivery_order($pid,$product_qty,$delivery_order_number,$wdate);
                echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED') . "  <a href='add' class='btn btn-blue btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a> <a href='" . base_url('products') . "' class='btn btn-grey-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
            }
            if ($serial) {
                $serial_group = array();
                foreach ($serial as $key => $value) {
                    if ($value)  $serial_group[] = array('product_id' => $pid, 'serial' => $value);
                }
                $this->db->insert_batch('gtg_product_serials', $serial_group);
            }
            if ($v_type) {
                foreach ($v_type as $key => $value) {
                    if ($v_type[$key] && numberClean($v_stock[$key]) > 0.00) {
                        $this->db->select('u.id,u.name,u2.name AS variation');
                        $this->db->join('gtg_units u2', 'u.rid = u2.id', 'left');
                        $this->db->where('u.id', $v_type[$key]);

                        $query = $this->db->get('gtg_units u');
                        $r_n = $query->row_array();
                        $data['product_name'] = $product_name . '-' . $r_n['variation'] . '-' . $r_n['name'];
                        $data['qty'] = numberClean($v_stock[$key]);
                        $data['alert'] = numberClean($v_alert[$key]);
                        $data['merge'] = 1;
                        $data['sub'] = $pid;
                        $data['vb'] = $v_type[$key];
                        $this->db->insert('gtg_products', $data);
                        $pidv = $this->db->insert_id();
                        $this->movers(1, $pidv, $data['qty'], 0, 'Stock Initialized');
                        $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                    }
                }
            }
            if ($w_type) {
                foreach ($w_type as $key => $value) {
                    if ($w_type[$key] && numberClean($w_stock[$key]) > 0.00 && $w_type[$key] != $warehouse) {

                        $data['product_name'] = $product_name;
                        $data['warehouse'] = $w_type[$key];
                        $data['qty'] = numberClean($w_stock[$key]);
                        $data['alert'] = numberClean($w_alert[$key]);
                        $data['merge'] = 2;
                        $data['sub'] = $pid;
                        $data['vb'] = $w_type[$key];
                        $this->db->insert('gtg_products', $data);
                        $pidv = $this->db->insert_id();
                        $this->movers(1, $pidv, $data['qty'], 0, 'Stock Initialized');
                        $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                    }
                }
            }
            $this->custom->save_fields_data($pid, 4);
            $this->db->trans_complete();
        }
    }

    public function edit($pid, $catid, $warehouse, $product_name, $product_code, $product_price, $factoryprice, $taxrate, $disrate, $product_qty, $product_qty_alert, $product_desc, $image, $unit, $barcode, $code_type, $sub_cat = '', $b_id = '', $vari = null, $serial = null, $wdate = '')
    {
        $this->db->select('qty');
        $this->db->from('gtg_products');
        $this->db->where('pid', $pid);
        $query = $this->db->get();
        $r_n = $query->row_array();
        $ware_valid = $this->valid_warehouse($warehouse);
        $this->db->trans_start();
        if ($this->aauth->get_user()->loc) {
            if ($ware_valid['loc'] == $this->aauth->get_user()->loc or $ware_valid['loc'] == '0' or $warehouse == 0) {
                $data = array(
                    'pcat' => $catid,
                    'warehouse' => $warehouse,
                    'product_name' => $product_name,
                    'product_code' => $product_code,
                    'product_price' => $product_price,
                    'fproduct_price' => $factoryprice,
                    'taxrate' => $taxrate,
                    'disrate' => $disrate,
                    'qty' => $product_qty,
                    'product_des' => $product_desc,
                    'alert' => $product_qty_alert,
                    'unit' => $unit,
                    'image' => $image,
                    'barcode' => $barcode,
                    'code_type' => $code_type,
                    'sub_id' => $sub_cat,
                    'b_id' => $b_id,
                    'expiry' => $wdate
                );

                $this->db->set($data);
                $this->db->where('pid', $pid);

                if ($this->db->update('gtg_products')) {
                    if ($r_n['qty'] != $product_qty) {
                        $m_product_qty = $product_qty - $r_n['qty'];
                        $this->movers(1, $pid, $m_product_qty, 0, 'Stock Changes');
                    }
                    $this->aauth->applog("[Update Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                    echo json_encode(array('status' => 'Success', 'message' =>
                    $this->lang->line('UPDATED') . " <a href='" . base_url('products/edit?id=' . $pid) . "' class='btn btn-blue btn-lg'><span class='fa fa-eye' aria-hidden='true'></span>  </a> <a href='" . base_url('products') . "' class='btn btn-grey-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a>"));
                } else {
                    echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('ERROR')));
                }
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
            }
        } else {
            $data = array(
                'pcat' => $catid,
                'warehouse' => $warehouse,
                'product_name' => $product_name,
                'product_code' => $product_code,
                'product_price' => $product_price,
                'fproduct_price' => $factoryprice,
                'taxrate' => $taxrate,
                'disrate' => $disrate,
                'qty' => $product_qty,
                'product_des' => $product_desc,
                'alert' => $product_qty_alert,
                'unit' => $unit,
                'image' => $image,
                'barcode' => $barcode,
                'code_type' => $code_type,
                'sub_id' => $sub_cat,
                'b_id' => $b_id,
                'expiry' => $wdate
            );
            $this->db->set($data);
            $this->db->where('pid', $pid);
            if ($this->db->update('gtg_products')) {
                if ($r_n['qty'] != $product_qty) {
                    $m_product_qty = $product_qty - $r_n['qty'];
                    $this->movers(1, $pid, $m_product_qty, 0, 'Stock Changes');
                }
                $this->aauth->applog("[Update Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED') . " <a href='" . base_url('products/edit?id=' . $pid) . "' class='btn btn-blue btn-lg'><span class='fa fa-eye' aria-hidden='true'></span>  </a> <a href='" . base_url('products') . "' class='btn btn-grey-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
            }
        }

        if (isset($serial['old'])) {
            $this->db->delete('gtg_product_serials', array('product_id' => $pid, 'status' => 0));
            $serial_group = array();
            foreach ($serial['old'] as $key => $value) {
                if ($value) $serial_group[] = array('product_id' => $pid, 'serial' => $value);
            }
            $this->db->insert_batch('gtg_product_serials', $serial_group);
        }
        if (isset($serial['new'])) {
            $serial_group = array();
            foreach ($serial['new'] as $key => $value) {
                if ($value)  $serial_group[] = array('product_id' => $pid, 'serial' => $value, 'status' => 0);
            }

            $this->db->insert_batch('gtg_product_serials', $serial_group);
        }
        $this->custom->edit_save_fields_data($pid, 4);


        $v_type = @$vari['v_type'];
        $v_stock = @$vari['v_stock'];
        $v_alert = @$vari['v_alert'];
        $w_type = @$vari['w_type'];
        $w_stock = @$vari['w_stock'];
        $w_alert = @$vari['w_alert'];

        if (isset($v_type)) {
            foreach ($v_type as $key => $value) {
                if ($v_type[$key] && numberClean($v_stock[$key]) > 0.00) {
                    $this->db->select('u.id,u.name,u2.name AS variation');
                    $this->db->join('gtg_units u2', 'u.rid = u2.id', 'left');
                    $this->db->where('u.id', $v_type[$key]);
                    $query = $this->db->get('gtg_units u');
                    $r_n = $query->row_array();
                    $data['product_name'] = $product_name . '-' . $r_n['variation'] . '-' . $r_n['name'];
                    $data['qty'] = numberClean($v_stock[$key]);
                    $data['alert'] = numberClean($v_alert[$key]);
                    $data['merge'] = 1;
                    $data['sub'] = $pid;
                    $data['vb'] = $v_type[$key];
                    $this->db->insert('gtg_products', $data);
                    $pidv = $this->db->insert_id();
                    $this->movers(1, $pidv, $data['qty'], 0, 'Stock Initialized');
                    $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                }
            }
        }
        if (isset($w_type)) {
            foreach ($w_type as $key => $value) {
                if ($w_type[$key] && numberClean($w_stock[$key]) > 0.00 && $w_type[$key] != $warehouse) {
                    $data['product_name'] = $product_name;
                    $data['warehouse'] = $w_type[$key];
                    $data['qty'] = numberClean($w_stock[$key]);
                    $data['alert'] = numberClean($w_alert[$key]);
                    $data['merge'] = 2;
                    $data['sub'] = $pid;
                    $data['vb'] = $w_type[$key];
                    $this->db->insert('gtg_products', $data);
                    $pidv = $this->db->insert_id();
                    $this->movers(1, $pidv, $data['qty'], 0, 'Stock Initialized');
                    $this->aauth->applog("[New Product] -$product_name  -Qty-$product_qty ID " . $pid, $this->aauth->get_user()->username);
                }
            }
        }
        $this->db->trans_complete();
    }

    public function prd_stats()
    {

        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' LEFT JOIN  gtg_warehouse on gtg_warehouse.id = gtg_products.warehouse WHERE gtg_warehouse.loc=' . $this->aauth->get_user()->loc;
            if (BDATA) $whr = ' LEFT JOIN  gtg_warehouse on gtg_warehouse.id = gtg_products.warehouse WHERE gtg_warehouse.loc=0 OR gtg_warehouse.loc=' . $this->aauth->get_user()->loc;
        } elseif (!BDATA) {
            $whr = ' LEFT JOIN  gtg_warehouse on gtg_warehouse.id = gtg_products.warehouse WHERE gtg_warehouse.loc=0';
        }
        $query = $this->db->query("SELECT
COUNT(IF( gtg_products.qty > 0, gtg_products.qty, NULL)) AS instock,
COUNT(IF( gtg_products.qty <= 0, gtg_products.qty, NULL)) AS outofstock,
COUNT(gtg_products.qty) AS total
FROM gtg_products $whr");
        echo json_encode($query->result_array());
    }

    public function products_list($id, $term = '')
    {
        $this->db->select('gtg_products.*');
        $this->db->from('gtg_products');
        $this->db->where('gtg_products.warehouse', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse');
            $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse');
            $this->db->where('gtg_warehouse.loc', 0);
        }
        if ($term) {
            $this->db->where("gtg_products.product_name LIKE '%$term%'");
            $this->db->or_where("gtg_products.product_code LIKE '$term%'");
        }
        $query = $this->db->get();
        return $query->result_array();
    }


    public function units()
    {
        $this->db->select('*');
        $this->db->from('gtg_units');
        $this->db->where('type', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function serials($pid)
    {
        $this->db->select('*');
        $this->db->from('gtg_product_serials');
        $this->db->where('product_id', $pid);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function transfer($from_warehouse, $products_l, $to_warehouse, $qty)
    {
        $updateArray = array();
        $move = false;
        $qtyArray = explode(',', $qty);
        $this->db->select('title');
        $this->db->from('gtg_warehouse');
        $this->db->where('id', $to_warehouse);
        $query = $this->db->get();
        $to_warehouse_name = $query->row_array()['title'];

        $i = 0;
        foreach ($products_l as $row) {
            $qty = 0;
            if (array_key_exists($i, $qtyArray)) $qty = $qtyArray[$i];

            $this->db->select('*');
            $this->db->from('gtg_products');
            $this->db->where('pid', $row);
            $query = $this->db->get();
            $pr = $query->row_array();
            $pr2 = $pr;
            $c_qty = $pr['qty'];
            if ($c_qty - $qty < 0) {
            } elseif ($c_qty - $qty == 0) {


                if ($pr['merge'] == 2) {

                    $this->db->select('pid,product_name');
                    $this->db->from('gtg_products');
                    $this->db->where('pid', $pr['sub']);
                    $this->db->where('warehouse', $to_warehouse);
                    $query = $this->db->get();
                    $pr = $query->row_array();
                } else {
                    $this->db->select('pid,product_name');
                    $this->db->from('gtg_products');
                    $this->db->where('merge', 2);
                    $this->db->where('sub', $row);
                    $this->db->where('warehouse', $to_warehouse);
                    $query = $this->db->get();
                    $pr = $query->row_array();
                }


                $c_pid = $pr['pid'];
                $product_name = $pr['product_name'];

                if ($c_pid) {

                    $this->db->set('qty', "qty+$qty", FALSE);
                    $this->db->where('pid', $c_pid);
                    $this->db->update('gtg_products');
                    $this->aauth->applog("[Product Transfer] -$product_name  -Qty-$qty ID " . $c_pid, $this->aauth->get_user()->username);
                    $this->db->delete('gtg_products', array('pid' => $row));
                    $this->db->delete('gtg_movers', array('d_type' => 1, 'rid1' => $row));
                } else {
                    $updateArray[] = array(
                        'pid' => $row,
                        'warehouse' => $to_warehouse
                    );
                    $move = true;
                    $product_name = $pr2['product_name'];
                    $this->db->delete('gtg_movers', array('d_type' => 1, 'rid1' => $row));

                    $this->movers(1, $row, $qty, 0, 'Stock Transferred & Initialized W- ' . $to_warehouse_name);
                    $this->aauth->applog("[Product Transfer] -$product_name  -Qty-$qty W- $to_warehouse_name PID " . $pr2['pid'], $this->aauth->get_user()->username);
                }
            } else {
                $data['product_name'] = $pr['product_name'];
                $data['pcat'] = $pr['pcat'];
                $data['warehouse'] = $to_warehouse;
                $data['product_name'] = $pr['product_name'];
                $data['product_code'] = $pr['product_code'];
                $data['product_price'] = $pr['product_price'];
                $data['fproduct_price'] = $pr['fproduct_price'];
                $data['taxrate'] = $pr['taxrate'];
                $data['disrate'] = $pr['disrate'];
                $data['qty'] = $qty;
                $data['product_des'] = $pr['product_des'];
                $data['alert'] = $pr['alert'];
                $data['	unit'] = $pr['unit'];
                $data['image'] = $pr['image'];
                $data['barcode'] = $pr['barcode'];
                $data['merge'] = 2;
                $data['sub'] = $row;
                $data['vb'] = $to_warehouse;
                if ($pr['merge'] == 2) {
                    $this->db->select('pid,product_name');
                    $this->db->from('gtg_products');
                    $this->db->where('pid', $pr['sub']);
                    $this->db->where('warehouse', $to_warehouse);
                    $query = $this->db->get();
                    $pr = $query->row_array();
                } else {
                    $this->db->select('pid,product_name');
                    $this->db->from('gtg_products');
                    $this->db->where('merge', 2);
                    $this->db->where('sub', $row);
                    $this->db->where('warehouse', $to_warehouse);
                    $query = $this->db->get();
                    $pr = $query->row_array();
                }


                $c_pid = $pr['pid'];
                $product_name = $pr2['product_name'];

                if ($c_pid) {

                    $this->db->set('qty', "qty+$qty", FALSE);
                    $this->db->where('pid', $c_pid);
                    $this->db->update('gtg_products');

                    $this->movers(1, $c_pid, $qty, 0, 'Stock Transferred W ' . $to_warehouse_name);
                    $this->aauth->applog("[Product Transfer] -$product_name  -Qty-$qty W $to_warehouse_name  ID " . $c_pid, $this->aauth->get_user()->username);
                } else {
                    $this->db->insert('gtg_products', $data);
                    $pid = $this->db->insert_id();
                    $this->movers(1, $pid, $qty, 0, 'Stock Transferred & Initialized W ' . $to_warehouse_name);
                    $this->aauth->applog("[Product Transfer] -$product_name  -Qty-$qty  W $to_warehouse_name ID " . $pr2['pid'], $this->aauth->get_user()->username);
                }

                $this->db->set('qty', "qty-$qty", FALSE);
                $this->db->where('pid', $row);
                $this->db->update('gtg_products');
                $this->movers(1, $row, -$qty, 0, 'Stock Transferred WID ' . $to_warehouse_name);
            }


            $i++;
        }

        if ($move) {
            $this->db->update_batch('gtg_products', $updateArray, 'pid');
        }

        echo json_encode(array('status' => 'Success', 'message' =>
        $this->lang->line('UPDATED')));
    }

    public function meta_delete($name)
    {
        if (@unlink(FCPATH . 'userfiles/product/' . $name)) {
            return true;
        }
    }

    public function valid_warehouse($warehouse)
    {
        $this->db->select('id,loc');
        $this->db->from('gtg_warehouse');
        $this->db->where('id', $warehouse);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row;
    }


    public function movers($type = 0, $rid1 = 0, $rid2 = 0, $rid3 = 0, $note = '')
    {
        $data = array(
            'd_type' => $type,
            'rid1' => $rid1,
            'rid2' => $rid2,
            'rid3' => $rid3,
            'note' => $note
        );
        $this->db->insert('gtg_movers', $data);
    }


    public function get_product_codes(){
        $this->db->distinct();
        $this->db->select('product_code');
        $query = $this->db->get('gtg_products');
        return $query->result_array();
    }
    public function get_expire_products_list($post = ''){

        $this->db->select('p.pid,p.product_name,p.product_code, p.pcat,  SUM(p.qty) as qty, p.cr_date,p.expiry, c.title');
        $this->db->from('gtg_products p');
        $this->db->join('gtg_product_cat c', 'p.pcat = c.id', 'left');

        if(!empty($post))
        {
            $cat_id = $post['cat_id'];
            // $start_date = $post['start_date'];
            // $end_date = $post['end_date'];
            $product_code = $post['product_code'];
        }

        if(!empty($cat_id))
        {
            $this->db->where('p.pcat', $cat_id); // Replace $cat_id with the actual category ID
        }

        // Add conditions for start and end dates for expiry
        // if (!empty($start_date)) {
        //     $this->db->where('p.cr_date >=', $start_date);
        // }

        // if (!empty($end_date)) {
        //     $this->db->where('p.cr_date <=', $end_date);
        // }


        if (!empty($product_code)) {
            $this->db->where('p.product_code', $product_code);
        }

        $this->db->group_by('p.product_code');
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;

        // Output the result or use it as needed

    }



    public function get_expire_products_variations_list($post = ''){

        // $this->db->select('p.pid,p.product_name,p.product_code, p.pcat, p.qty, p.cr_date,p.expiry, c.title');
        // $this->db->from('gtg_products p');
        // $this->db->join('gtg_product_cat c', 'p.pcat = c.id', 'left');

        $this->db->select('p.product_code, SUM(p.qty) as total_qty, p.product_name, p.cr_date, p.expiry, c.title');
        $this->db->from('gtg_products p');
        $this->db->join('gtg_product_cat c', 'p.pcat = c.id', 'left');
        


        if(!empty($post))
        {
            $cat_id = $post['cat_id'];
            // $start_date = $post['start_date'];
            // $end_date = $post['end_date'];
            $product_code = $post['product_code'];
        }

        if(!empty($cat_id))
        {
            $this->db->where('p.pcat', $cat_id); // Replace $cat_id with the actual category ID
        }

        // Add conditions for start and end dates for expiry
        // if (!empty($start_date)) {
        //     $this->db->where('p.expiry >=', $start_date);
        // }

        // if (!empty($end_date)) {
        //     $this->db->where('p.expiry <=', $end_date);
        // }


        if (!empty($product_code)) {
            $this->db->where('p.product_code', $product_code);
        }

        $this->db->group_by('p.product_code');
        $this->db->order_by('p.product_name');
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;

        // Output the result or use it as needed

    }

    public function lastdo()
    {
        $this->db->select('parent_do_id');
        $this->db->from('gtg_do_relations');
        $this->db->order_by('parent_do_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return ($query->row()->parent_do_id + 1 );
        } else {
            return 1000;
        }
    }


    public function create_delivery_order($pid,$prodcut_qty,$delivery_order_number,$expire_date)
    {
        // echo $expire_date;
        // exit;
        
        $supplier_do_no = $delivery_order_number;
       
        $lastdo = $this->lastdo();
        $last_child_do = $lastdo."111";
                     

        $data['parent_delivery_order_id'] = $lastdo;
        $data['delivery_order_id'] = $last_child_do;
        $data['supplier_delivery_order_id'] = $supplier_do_no;
        $data['po_id'] = 0;
        $data['p_id'] = $pid;                
        $data['do_expire_date'] = $expire_date; 

        // $data['do_id'] = $lastdo + 1;
        $data['qty'] = $prodcut_qty;
        $data['type'] = 'cr';
        //$n_data[] = $data;


        if(!empty($data)){

            
            $rel_data['type'] = 'default_po';
            $rel_data['parent_do_id'] = $lastdo;
            $rel_data['do_id'] = $last_child_do;
            $rel_data['po_id'] = 0;
            $rel_data['supplier_do_id'] = $supplier_do_no;
            $this->db->insert('gtg_do_relations',$rel_data);
            // Decode the JSON data
           
            if($this->db->insert('gtg_do_delivered_items', $data))
            {

                

                $resp_data['status'] = '200';
                $resp_data['message'] = 'Delivery Order Created for Default Product Successfully';
            } else {

                $resp_data['status'] = '500';
                $resp_data['message'] = 'Delivery Order for Default Product Creating Failed';
            }

            
            
        }else{
            $resp_data['status'] = '500';
            $resp_data['message'] = 'No product Deatils';
        }

        return json_encode($resp_data);
    }

}
