<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Search_products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model('search_model');
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        // if (!$this->aauth->premission(1)) {
        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
    }

    //search product in invoice
    public function search()
    {
        $this->load->model('plugins_model', 'plugins');
        $billing_settings = $this->plugins->universal_api(67);
        $result = array();
        $out = array();
        $row_num = $this->input->post('row_num', true);
        $name = $this->input->post('name_startsWith', true);
        $wid = $this->input->post('wid', true);
        $qw = '';
        if ($wid > 0) {
            $qw = "(gtg_products.warehouse='$wid') AND ";
        }
        if ($billing_settings['key2']) $qw .= "(gtg_products.expiry IS NULL OR DATE (gtg_products.expiry)<" . date('Y-m-d') . ") AND ";
        $join = '';

        if ($this->aauth->get_user()->loc) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            $join2 = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            if (BDATA) $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' OR gtg_warehouse.loc=0) AND ';
            else $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            $qw .= '(gtg_warehouse.loc=0) AND ';
        }
        $e = '';
        if ($billing_settings['key1'] == 1) {
            $e .= ',gtg_product_serials.serial';
            $join .= 'LEFT JOIN gtg_product_serials ON gtg_product_serials.product_id=gtg_products.pid';
            $qw .= '(gtg_product_serials.status=0) AND ';
        }

        if ($name) {

            if ($billing_settings['key1'] == 2) {
                $e .= ',gtg_product_serials.serial';
                $query = $this->db->query("SELECT gtg_products.pid,gtg_products.product_name,gtg_products.product_price,gtg_products.product_code,gtg_products.taxrate,gtg_products.disrate,gtg_products.product_des,gtg_products.qty,gtg_products.unit $e  FROM gtg_product_serials LEFT JOIN gtg_products  ON gtg_products.pid=gtg_product_serials.product_id $join WHERE " . $qw . "(UPPER(gtg_product_serials.serial) LIKE '" . strtoupper($name) . "%')  LIMIT 6");
            } else {
                $query = $this->db->query("SELECT gtg_products.pid,gtg_products.product_name,gtg_products.product_price,gtg_products.product_code,gtg_products.taxrate,gtg_products.disrate,gtg_products.product_des,gtg_products.qty,gtg_products.unit $e  FROM gtg_products $join WHERE " . $qw . "(UPPER(gtg_products.product_name) LIKE '%" . strtoupper($name) . "%') OR (UPPER(gtg_products.product_code) LIKE '" . strtoupper($name) . "%') LIMIT 6");
            }

            $result = $query->result_array();
            foreach ($result as $row) {
                $name = array($row['product_name'], amountExchange_s($row['product_price'], 0, $this->aauth->get_user()->loc), $row['pid'], amountFormat_general($row['taxrate']), amountFormat_general($row['disrate']), $row['product_des'], $row['unit'], $row['product_code'], amountFormat_general($row['qty']), $row_num, @$row['serial']);
                array_push($out, $name);
            }
            echo json_encode($out);
        }
    }

    public function puchase_search()
    {
        $result = array();
        $out = array();
        $row_num = $this->input->post('row_num', true);
        $name = $this->input->post('name_startsWith', true);
        $wid = $this->input->post('wid', true);
        $qw = '';
        if ($wid > 0) {
            $qw = "(gtg_products.warehouse='$wid' ) AND ";
        }
        $join = '';
        if ($this->aauth->get_user()->loc) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            if (BDATA) $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' OR gtg_warehouse.loc=0) AND ';
            else $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            $qw .= '(gtg_warehouse.loc=0) AND ';
        }
        if ($name) {
            $query = $this->db->query("SELECT gtg_products.pid,gtg_products.product_name,gtg_products.product_code,gtg_products.fproduct_price,gtg_products.taxrate,gtg_products.disrate,gtg_products.product_des,gtg_products.unit FROM gtg_products $join WHERE " . $qw . "UPPER(gtg_products.product_name) LIKE '%" . strtoupper($name) . "%' OR UPPER(gtg_products.product_code) LIKE '" . strtoupper($name) . "%' LIMIT 6");

            $result = $query->result_array();
            foreach ($result as $row) {
                $name = array($row['product_name'], amountExchange_s($row['fproduct_price'], 0, $this->aauth->get_user()->loc), $row['pid'], amountFormat_general($row['taxrate']), amountFormat_general($row['disrate']), $row['product_des'], $row['unit'], $row['product_code'], $row_num);
                array_push($out, $name);
            }

            echo json_encode($out);
        }
    }

    public function csearch()
    {
        $result = array();
        $out = array();
        $name = $this->input->get('keyword', true);
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' (loc=' . $this->aauth->get_user()->loc . ' OR loc=0) AND ';
            if (!BDATA) $whr = ' (loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $whr = ' (loc=0) AND ';
        }
        if ($name) {
            $query = $this->db->query("SELECT id,name,address,city,phone,email,discount_c,company FROM gtg_customers WHERE $whr (UPPER(name)  LIKE '%" . strtoupper($name) . "%' OR UPPER(phone)  LIKE '" . strtoupper($name) . "%' OR UPPER(company)  LIKE '" . strtoupper($name) . "%') LIMIT 6");
            $result = $query->result_array();
            echo '<ol>';
            $i = 1;
            foreach ($result as $row) {

                //echo "<li onClick=\"selectCustomer('" . $row['id'] . "','" . $row['name'] . " ','" . $row['address'] . "','" . $row['city'] . "','" . $row['phone'] . "','" . $row['email'] . "','" . amountFormat_general($row['discount_c']) . "')\"><span>$i</span><p>" . $row['name'] . " &nbsp; &nbsp  " . $row['phone'] . "</p></li>";
                //echo "<li onClick=\"selectCustomer('" . $row['id'] . "','" . $row['name'] . " ','" . $row['address'] . "','" . $row['city'] . "','" . $row['phone'] . "','" . $row['email'] . "','" . amountFormat_general($row['discount_c']) . "')\"><div class='row'><div class='col-md-4'>$i</div><div class='col-md-4'>" . $row['name'] . "</div><div class='col-md-4'>" . $row['phone'] . "</div></div></li>";
                echo "<li onClick=\"selectCustomer('" . $row['id'] . "','" . $row['name'] . " ','" . $row['address'] . "','" . $row['city'] . "','" . $row['phone'] . "','" . $row['email'] . "','" . amountFormat_general($row['discount_c']) . "','" . $row['company'] . "')\"><div class='row'><div class='col-md-1' style='color: #333333;'>$i</div><div class='col-md-4' style='color: #333333;'>" . $row['company'] . "</div><div class='col-md-4' style='color: #333333;'>" . $row['name'] . "</div><div class='col-md-3' style='color: #333333;'>" . $row['phone'] . "</div></div></li>";

                $i++;
            }
            echo '</ol>';
        }
    }

    public function party_search()
    {
        $result = array();
        $out = array();
        $tbl = 'gtg_customers';
        $name = $this->input->get('keyword', true);

        $ty = $this->input->get('ty', true);
        if ($ty) $tbl = 'gtg_supplier';
        $whr = '';


        if ($this->aauth->get_user()->loc) {
            $whr = ' (loc=' . $this->aauth->get_user()->loc . ' OR loc=0) AND ';
            if (!BDATA) $whr = ' (loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $whr = ' (loc=0) AND ';
        }


        if ($name) {
            $query = $this->db->query("SELECT id,name,address,city,phone,email FROM $tbl  WHERE $whr (UPPER(name)  LIKE '%" . strtoupper($name) . "%' OR UPPER(phone)  LIKE '" . strtoupper($name) . "%') LIMIT 6");
            $result = $query->result_array();
            echo '<ol>';
            $i = 1;
            foreach ($result as $row) {

                echo "<li onClick=\"selectCustomer('" . $row['id'] . "','" . $row['name'] . " ','" . $row['address'] . "','" . $row['city'] . "','" . $row['phone'] . "','" . $row['email'] . "')\"><span>$i</span><p>" . $row['name'] . " &nbsp; &nbsp  " . $row['phone'] . "</p></li>";
                $i++;
            }
            echo '</ol>';
        }
    }

    public function pos_c_search()
    {
        $result = array();
        $out = array();
        $name = $this->input->get('keyword', true);
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' (loc=' . $this->aauth->get_user()->loc . ' OR loc=0) AND ';
            if (!BDATA) $whr = ' (loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $whr = ' (loc=0) AND ';
        }

        if ($name) {
            $query = $this->db->query("SELECT id,name,phone,discount_c FROM gtg_customers WHERE $whr (UPPER(name)  LIKE '%" . strtoupper($name) . "%' OR UPPER(phone)  LIKE '" . strtoupper($name) . "%') LIMIT 6");
            $result = $query->result_array();
            echo '<ol>';
            $i = 1;
            foreach ($result as $row) {
                echo "<li onClick=\"PselectCustomer('" . $row['id'] . "','" . $row['name'] . " ','" . amountFormat_general($row['discount_c']) . "')\"><span>$i</span><p>" . $row['name'] . " &nbsp; &nbsp  " . $row['phone'] . "</p></li>";
                $i++;
            }
            echo '</ol>';
        }
    }


    public function supplier()
    {
        $result = array();
        $out = array();
        $name = $this->input->get('keyword', true);

        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' (loc=' . $this->aauth->get_user()->loc . ' OR loc=0) AND ';
            if (!BDATA) $whr = ' (loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $whr = ' (loc=0) AND ';
        }
        if ($name) {
            $query = $this->db->query("SELECT id,name,address,city,phone,email FROM gtg_supplier WHERE $whr (UPPER(name)  LIKE '%" . strtoupper($name) . "%' OR UPPER(phone)  LIKE '" . strtoupper($name) . "%') LIMIT 6");
            $result = $query->result_array();
            echo '<ol>';
            $i = 1;
            foreach ($result as $row) {
                echo "<li onClick=\"selectSupplier('" . $row['id'] . "','" . $row['name'] . " ','" . $row['address'] . "','" . $row['city'] . "','" . $row['phone'] . "','" . $row['email'] . "')\"><span>$i</span><p>" . $row['name'] . " &nbsp; &nbsp  " . $row['phone'] . "</p></li>";
                $i++;
            }
            echo '</ol>';
        }
    }

    public function pos_search()
    {

        $out = '';
        $this->load->model('plugins_model', 'plugins');
        $billing_settings = $this->plugins->universal_api(67);
        $name = $this->input->post('name', true);
        $cid = $this->input->post('cid', true);
        $wid = $this->input->post('wid', true);
        $qw = '';
        if ($wid > 0) {
            $qw .= "(gtg_products.warehouse='$wid') AND ";
        }
        if ($billing_settings['key2']) $qw .= "(gtg_products.expiry IS NULL OR DATE (gtg_products.expiry)<" . date('Y-m-d') . ") AND ";
        if ($cid > 0) {
            $qw .= "(gtg_products.pcat='$cid') AND ";
        }
        $join = '';
        if ($this->aauth->get_user()->loc) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            if (BDATA) $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' OR gtg_warehouse.loc=0) AND ';
            else $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            $qw .= '(gtg_warehouse.loc=0) AND ';
        }

        $e = '';
        if ($billing_settings['key1'] == 1) {
            $e .= ',gtg_product_serials.serial';
            $join .= 'LEFT JOIN gtg_product_serials ON gtg_product_serials.product_id=gtg_products.pid ';
            $qw .= '(gtg_product_serials.status=0) AND  ';
        }


        $bar = '';
        if (is_numeric($name)) {
            $b = array('-', '-', '-');
            $c = array(3, 4, 11);
            $barcode = $name;
            for ($i = count($c) - 1; $i >= 0; $i--) {
                $barcode = substr_replace($barcode, $b[$i], $c[$i], 0);
            }

            $bar = " OR (gtg_products.barcode LIKE '" . (substr($barcode, 0, -1)) . "%' OR gtg_products.barcode LIKE '" . $name . "%')";
        }
        if ($billing_settings['key1'] == 2) {

            $query = "SELECT gtg_products.*,gtg_product_serials.serial FROM gtg_product_serials  LEFT JOIN gtg_products  ON gtg_products.pid=gtg_product_serials.product_id $join WHERE " . $qw . "gtg_product_serials.serial LIKE '" . strtoupper($name) . "%'  AND (gtg_products.qty>0) LIMIT 16";
        } else {
            $query = "SELECT gtg_products.* $e FROM gtg_products $join WHERE " . $qw . "(UPPER(gtg_products.product_name) LIKE '%" . strtoupper($name) . "%' $bar OR gtg_products.product_code LIKE '" . strtoupper($name) . "%') AND (gtg_products.qty>0) LIMIT 16";
        }


        $query = $this->db->query($query);

        $result = $query->result_array();
        $i = 0;
        echo '<div class="row match-height">';
        foreach ($result as $row) {

            $out .= '    <div class="col-3 border mb-1 "><div class="rounded">
                                 <a   id="posp' . $i . '"  class="select_pos_item btn btn-outline-light-blue round"   data-name="' . $row['product_name'] . '"  data-price="' . amountExchange_s($row['product_price'], 0, $this->aauth->get_user()->loc) . '"  data-tax="' . amountFormat_general($row['taxrate']) . '"  data-discount="' . amountFormat_general($row['disrate']) . '"   data-pcode="' . $row['product_code'] . '"   data-pid="' . $row['pid'] . '"  data-stock="' . amountFormat_general($row['qty']) . '" data-unit="' . $row['unit'] . '" data-serial="' . @$row['serial'] . '" data-description="' . $row['product_des'] . '">
                                        <img class="round"
                                             src="' . base_url('userfiles/product/' . $row['image']) . '"  style="max-height: 100%;max-width: 100%">
                                        <div class="text-xs-center text">

                                            <small style="white-space: pre-wrap;">' . $row['product_name'] . '</small>


                                        </div></a>

                                </div></div>';

            $i++;
            //   if ($i % 4 == 0) $out .= '</div><div class="row">';
        }

        echo $out;
    }

    public function v2_pos_search()
    {

        $sql = "SELECT * from merchant_thirdparty_vendors WHERE VendorName='POS'";
        $query = $this->db->query($sql);
        $third_party_vendors = $query->result_array();
        $pos_id = $third_party_vendors[0]['Id'];

        $out = '';
        $this->load->model('plugins_model', 'plugins');
        $billing_settings = $this->plugins->universal_api(67);
        $name = $this->input->post('name', true);
        $cid = $this->input->post('cid', true);
        $wid = $this->input->post('wid', true);
        $enable_bar = $this->input->post('bar', true);
        $flag_p = false;

        $qw = '';

        if ($wid > 0) {
            $qw .= "(gtg_products.warehouse='$wid') AND ";
        }
        if ($billing_settings['key2']) $qw .= "(gtg_products.expiry IS NULL OR DATE (gtg_products.expiry)<" . date('Y-m-d') . ") AND ";
        if ($cid > 0) {
            $qw .= "(gtg_products.pcat='$cid') AND ";
        }
        $join = '';

        if ($this->aauth->get_user()->loc) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            if (BDATA) $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' OR gtg_warehouse.loc=0) AND ';
            else $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            $qw .= '(gtg_warehouse.loc=0) AND ';
        }

        $e = '';
        if ($billing_settings['key1'] == 1) {
            $e .= ',gtg_product_serials.serial';
            $join .= 'LEFT JOIN gtg_product_serials ON gtg_product_serials.product_id=gtg_products.pid ';
            $qw .= '(gtg_product_serials.status=0) AND  ';
        }

        if(!empty($pos_id))
        {
            $e .= ' ,merchant_items_thirdparty_pricing.Price AS product_price';
            $join .= ' LEFT JOIN merchant_items_thirdparty_pricing ON merchant_items_thirdparty_pricing.ItemId = gtg_products.pid LEFT JOIN merchant_thirdparty_vendors ON merchant_thirdparty_vendors.Id = merchant_items_thirdparty_pricing.ThirdPartyVendorId';
            $qw .= ' (merchant_items_thirdparty_pricing.ThirdPartyVendorId = '.$pos_id.') AND  ';

        }

     
        $bar = '';
        $p_class = 'v2_select_pos_item';
        if ($enable_bar == 'true' and is_numeric($name) and strlen($name) > 8) {
            $flag_p = true;
            $bar = " (gtg_products.barcode = '" . (substr($name, 0, -1)) . "' OR gtg_products.barcode LIKE '" . $name . "%')";

            $query = "SELECT gtg_products.*  FROM gtg_products $join WHERE " . $qw . "$bar AND (gtg_products.qty>0) ORDER BY gtg_products.product_name LIMIT 6";
            $p_class = 'v2_select_pos_item_bar';
        } elseif ($enable_bar == 'false' or !$enable_bar) {
            $flag_p = true;
            if ($billing_settings['key1'] == 2) {

                $query = "SELECT gtg_products.*,gtg_product_serials.serial FROM gtg_product_serials  LEFT JOIN gtg_products  ON gtg_products.pid=gtg_product_serials.product_id $join WHERE " . $qw . "gtg_product_serials.serial LIKE '" . strtoupper($name) . "%'  AND (gtg_products.qty>0) group by gtg_products.pid LIMIT 18";
            } else {

                $query = "SELECT gtg_products.* $e FROM gtg_products $join WHERE " . $qw . "(UPPER(gtg_products.product_name) LIKE '%" . strtoupper($name) . "%' $bar OR gtg_products.product_code LIKE '" . strtoupper($name) . "%') AND (gtg_products.qty>0)  group by gtg_products.pid ORDER BY gtg_products.product_name LIMIT 18";
            }
        }

       

        if ($flag_p) {
            $query = $this->db->query($query);
            $result = $query->result_array();

            // echo $this->db->last_query();
            // exit;
            $i = 0;
            $out = '<div class="row match-height">';
            foreach ($result as $row) {
                if ($bar) $bar = $row['barcode'];
                $out .= '    <div class="col-2 border mb-1"  ><div class=" rounded" >
                                 <a  id="posp' . $i . '"  class="' . $p_class . ' round"   data-name="' . $row['product_name'] . '"  data-price="' . amountExchange_s($row['product_price'], 0, $this->aauth->get_user()->loc) . '"  data-tax="' . amountFormat_general($row['taxrate']) . '"  data-discount="' . amountFormat_general($row['disrate']) . '" data-pcode="' . $row['product_code'] . '"   data-pid="' . $row['pid'] . '"  data-stock="' . amountFormat_general($row['qty']) . '" data-unit="' . $row['unit'] . '" data-serial="' . @$row['serial'] . '" data-description="' . $row['product_des'] . '" data-bar="' . $bar . '">
                                        <img class="round"
                                             src="' . base_url('userfiles/product/' . $row['image']) . '"  style="max-height: 100%;max-width: 100%">
                                        <div class="text-center" style="margin-top: 4px;">

                                            <small style="white-space: pre-wrap;">' . $row['product_name'] . '</small>


                                        </div></a>

                                </div></div>';

                $i++;
            }


            $out .= '</div>';

            echo $out;
        }
    }

    public function group_pos_search()
    {

        $out = '';
        $this->load->model('plugins_model', 'plugins');
        $billing_settings = $this->plugins->universal_api(67);
        $name = $this->input->post('name', true);
        $cid = $this->input->post('cid', true);
        $wid = $this->input->post('wid', true);


        $qw = '';

        if ($wid > 0) {
            $qw .= "(gtg_product_groups.warehouse='$wid') AND ";
        }

        $join = '';

        if ($this->aauth->get_user()->loc) {
            $qw .= "(gtg_product_groups.loc='" . $this->aauth->get_user()->loc . "') AND ";
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            if (BDATA) $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' OR gtg_warehouse.loc=0) AND ';
            else $qw .= '(gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $join = 'LEFT JOIN gtg_warehouse ON gtg_warehouse.id=gtg_products.warehouse';
            $qw .= '(gtg_warehouse.loc=0) AND ';
        }

        $e = '';
        if ($billing_settings['key1'] == 1) {
            $e .= ',gtg_product_serials.serial';
            $join .= 'LEFT JOIN gtg_product_serials ON gtg_product_serials.product_id=gtg_products.pid ';
            $qw .= '(gtg_product_serials.status=0) AND  ';
        }

        $bar = '';

        if (is_numeric($name)) {
            $b = array('-', '-', '-');
            $c = array(3, 4, 11);
            $barcode = $name;
            for ($i = count($c) - 1; $i >= 0; $i--) {
                $barcode = substr_replace($barcode, $b[$i], $c[$i], 0);
            }
            //    echo(substr($barcode, 0, -1));
            $bar = " OR (gtg_products.barcode LIKE '" . (substr($barcode, 0, -1)) . "%' OR gtg_products.barcode LIKE '" . $name . "%')";
            //  $query = "SELECT gtg_products.* FROM gtg_products $join WHERE " . $qw . " $bar AND (gtg_products.qty>0) LIMIT 16";
        }
        if ($billing_settings['key1'] == 2) {

            $query = "SELECT gtg_products.*,gtg_product_serials.serial FROM gtg_product_serials  LEFT JOIN gtg_products  ON gtg_products.pid=gtg_product_serials.product_id $join WHERE " . $qw . "gtg_product_serials.serial LIKE '" . strtoupper($name) . "%'  AND (gtg_products.qty>0) LIMIT 18";
        } else {
            $query = "SELECT gtg_products.* $e FROM gtg_products $join WHERE " . $qw . "(UPPER(gtg_products.product_name) LIKE '%" . strtoupper($name) . "%' $bar OR gtg_products.product_code LIKE '" . strtoupper($name) . "%') AND (gtg_products.qty>0) ORDER BY gtg_products.product_name LIMIT 18";
        }

        $query = $this->db->query($query);
        $result = $query->result_array();
        $i = 0;
        echo '<div class="row match-height">';
        foreach ($result as $row) {

            $out .= '    <div class="col-2 border mb-1"  ><div class=" rounded" >
                                 <a  id="posp' . $i . '"  class="v2_select_pos_item round"   data-name="' . $row['product_name'] . '"  data-price="' . amountExchange_s($row['product_price'], 0, $this->aauth->get_user()->loc) . '"  data-tax="' . amountFormat_general($row['taxrate']) . '"  data-discount="' . amountFormat_general($row['disrate']) . '" data-pcode="' . $row['product_code'] . '"   data-pid="' . $row['pid'] . '"  data-stock="' . amountFormat_general($row['qty']) . '" data-unit="' . $row['unit'] . '" data-serial="' . @$row['serial'] . '" data-description="' . $row['product_des'] . '">
                                        <img class="round"
                                             src="' . base_url('userfiles/product/' . $row['image']) . '"  style="max-height: 100%;max-width: 100%">
                                        <div class="text-center" style="margin-top: 4px;">

                                            <small style="white-space: pre-wrap;">' . $row['product_name'] . '</small>


                                        </div></a>

                                </div></div>';

            $i++;
        }

        echo $out;
    }
}
