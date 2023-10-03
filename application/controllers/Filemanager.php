<?php

defined('BASEPATH') or exit('No direct script access allowed');
$FMCONFIG = '{"lang":"en","error_reporting":true,"show_hidden":true,"hide_Cols":true,"theme":"light"}';



class Filemanager extends CI_Controller
{
    // Readonly users
    private $readonly_users = array('user');
    // Global readonly, including when auth is not being used
    private $global_readonly = false;
    // user specific directories
    // array('Username' => 'Directory path', 'Username2' => 'Directory path', ...)
    private $directories_users = array();
    // Enable highlight.js (https://highlightjs.org/) on view's page
    private $use_highlightjs = false;
     // highlight.js style
    // for dark theme use 'ir-black'
    private $highlightjs_style = 'vs';
    private $edit_files = true;
    private $default_timezone = 'Etc/UTC'; // UTC
    // Root path for file manager
    // use absolute path of directory i.e: '/var/www/folder' or $_SERVER['DOCUMENT_ROOT'].'/folder'
    private $root_path = '';
    // Will not working if $root_path will be outside of server document root
    private $root_url = '';
    private $http_host = "";
    private $iconv_input_encoding = 'UTF-8';
    private $datetime_format = 'm/d/Y g:i A';
    private $path_display_mode = 'full';
    private $allowed_file_extensions = '';
    private $allowed_upload_extensions = '';
    private $favicon_path = '';
    // e.g. array('myfile.html', 'personal-folder', '*.php', ...)
    private $exclude_items = array();
    // Online office Docs Viewer
    // Availabe rules are 'google', 'microsoft' or false
    // Google => View documents using Google Docs Viewer
    // Microsoft => View documents using Microsoft Web Apps Viewer
    // false => disable online doc viewer
    private $online_viewer = false;
    private $sticky_navbar = true;
    private $max_upload_size_bytes = 5000000000; // size 5,000,000,000 bytes (~5GB)89
    private $upload_chunk_size_bytes = 2000000; // chunk size 2,000,000 bytes (~2MB)
    // Possible rules are 'OFF', 'AND' or 'OR'
    // OFF => Don't check connection IP, defaults to OFF
    // AND => Connection must be on the whitelist, and not on the blacklist
    // OR => Connection must be on the whitelist, or not on the blacklist
    private $ip_ruleset = 'OFF';
    private $ip_silent = true;
    private $ip_whitelist = array(
        '127.0.0.1',    // local ipv4
        '::1'           // local ipv6
    );

    private $ip_blacklist = array(
        '0.0.0.0',      // non-routable meta ipv4
        '::'            // non-routable meta ipv6
    );
    private $config_file = '';
	private $hide_Cols;

    public function __construct()
    {

        parent:: __construct();

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
       /*// if (!$this->aauth->premission(6)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        // } */

        $this->load->model('filemanager_model');
        $this->li_a = 'misc';
		// Remove devJsuite on live url wait
        //$this->load->helper('root_path',$_SERVER['DOCUMENT_ROOT']."/devJsuite/userfiles/filemanager");

        // Root path for file manager
        // use absolute path of directory i.e: '/var/www/folder' or $_SERVER['DOCUMENT_ROOT'].'/folder'
        $this->root_path = $_SERVER['DOCUMENT_ROOT']."/userfiles/filemanager";

        // Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
        // Will not working if $root_path will be outside of server document root
        $this->root_url = '/filemanager';
        $this->http_host = $_SERVER['HTTP_HOST']."";
        define('MAX_UPLOAD_SIZE', $this->max_upload_size_bytes);

        // upload chunk size
        define('UPLOAD_CHUNK_SIZE', $this->upload_chunk_size_bytes);
            if (is_readable($this->config_file)) {
            @include($this->config_file);
        }

        // External CDN resources that can be used in the HTML (replace for GDPR compliance)
        $external = array(
            'css-dropzone' => '<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">',
            'css-font-awesome' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">',
            'css-highlightjs' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/' . $this->highlightjs_style . '.min.css">',
            'js-ace' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.13.1/ace.js"></script>',
            'js-dropzone' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>',
            'js-jquery' => '<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>',
            'js-highlightjs' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>',
            'pre-jsdelivr' => '<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin/><link rel="dns-prefetch" href="https://cdn.jsdelivr.net"/>',
            'pre-cloudflare' => '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin/><link rel="dns-prefetch" href="https://cdnjs.cloudflare.com"/>'
        );

        // --- EDIT BELOW CAREFULLY OR DO NOT EDIT AT ALL ---

        // max upload file size


        // private key and session name to store to the session
        if ( !defined( 'FM_SESSION_ID')) {
            define('FM_SESSION_ID', 'filemanager');
        }

        // Configuration
        $cfg = new FM_Config();

        // Default language
        $lang = isset($cfg->data['lang']) ? $cfg->data['lang'] : 'en';

        // Show or hide files and folders that starts with a dot
        $show_hidden_files = isset($cfg->data['show_hidden']) ? $cfg->data['show_hidden'] : true;

        // PHP error reporting - false = Turns off Errors, true = Turns on Errors
        $report_errors = isset($cfg->data['error_reporting']) ? $cfg->data['error_reporting'] : true;

        // Hide Permissions and Owner cols in file-listing
        $this->hide_Cols = isset($cfg->data['hide_Cols']) ? $cfg->data['hide_Cols'] : true;

        // Theme
        $theme = isset($cfg->data['theme']) ? $cfg->data['theme'] : 'light';
                define('FM_THEME', $theme);
                $lang_list = array(
            'en' => 'English'
        );
                //Generating CSRF Token
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        $is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
            || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

        // update $root_url based on user specific directories
        if (isset($_SESSION[FM_SESSION_ID]['logged']) && !empty($directories_users[$_SESSION[FM_SESSION_ID]['logged']])) {
            $wd = fm_clean_path(dirname($_SERVER['PHP_SELF']));
            $this->root_url =  $this->root_url.$wd.DIRECTORY_SEPARATOR.$directories_users[$_SESSION[FM_SESSION_ID]['logged']];
        }

                    // clean $root_url

        $this->root_url = fm_clean_path($this->root_url);

        // abs path for site
        defined('FM_ROOT_URL') || define('FM_ROOT_URL', ($is_https ? 'https' : 'http') . '://' . $this->http_host . (!empty($this->root_url) ? '/' . $this->root_url : ''));
        defined('FM_SELF_URL') || define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $this->http_host . '/'. $this->root_url );

        // clean and check $root_path
        $this->root_path = rtrim($this->root_path, '\\/');
        $this->root_path = str_replace('\\', '/', $this->root_path);
        if (!@is_dir($this->root_path)) {
            echo "<h1>".lng('Root path')." \"{$this->root_path}\" ".lng('not found!')." </h1>";
            exit;
        }

        defined('FM_SHOW_HIDDEN') || define('FM_SHOW_HIDDEN', $show_hidden_files);
        defined('FM_ROOT_PATH') || define('FM_ROOT_PATH', $this->root_path);
        defined('FM_LANG') || define('FM_LANG', $lang);
        defined('FM_FILE_EXTENSION') || define('FM_FILE_EXTENSION', $this->allowed_file_extensions);
        defined('FM_UPLOAD_EXTENSION') || define('FM_UPLOAD_EXTENSION', $this->allowed_upload_extensions);
        defined('FM_EXCLUDE_ITEMS') || define('FM_EXCLUDE_ITEMS', (version_compare(PHP_VERSION, '7.0.0', '<') ? serialize($this->exclude_items) : $this->exclude_items));
        defined('FM_DOC_VIEWER') || define('FM_DOC_VIEWER', $this->online_viewer);
        define('FM_READONLY', $this->global_readonly);
        define('FM_IS_WIN', DIRECTORY_SEPARATOR == '\\');

        /**************************** Actioan ****************************/
        // always use ?p=
        if (!isset($_GET['p']) && empty($_FILES)) {
            fm_redirect(FM_SELF_URL . '?p=');
        }

        // get path
        $p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');

        // clean path
        $p = fm_clean_path($p);

        // for ajax request - save
        $input = file_get_contents('php://input');
        $_POST = (strpos($input, 'ajax') != FALSE && strpos($input, 'save') != FALSE) ? json_decode($input, true) : $_POST;

        // instead globals vars
        define('FM_PATH', $p);
        define('FM_EDIT_FILE', $this->edit_files);
        defined('FM_ICONV_INPUT_ENC') || define('FM_ICONV_INPUT_ENC', $this->iconv_input_encoding);
        defined('FM_USE_HIGHLIGHTJS') || define('FM_USE_HIGHLIGHTJS', $this->use_highlightjs);
        defined('FM_HIGHLIGHTJS_STYLE') || define('FM_HIGHLIGHTJS_STYLE', $this->highlightjs_style);
        defined('FM_DATETIME_FORMAT') || define('FM_DATETIME_FORMAT', $this->datetime_format);


    }

    public function index()
    {

        unset($p, $this->iconv_input_encoding, $this->use_highlightjs, $this->highlightjs_style);
        // get current path
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }

        // check path
        if (!is_dir($path)) {
            fm_redirect(FM_SELF_URL . '?p=');
        }

        // get parent folder
        $parent = fm_get_parent_path(FM_PATH);

        $objects = is_readable($path) ? scandir($path) : array();
        $folders = array();
        $files = array();
        $current_path = array_slice(explode("/",$path), -1)[0];
        if (is_array($objects) && fm_is_exclude_items($current_path)) {
            foreach ($objects as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (!FM_SHOW_HIDDEN && substr($file, 0, 1) === '.') {
                    continue;
                }
                $new_path = $path . '/' . $file;
                if (@is_file($new_path) && fm_is_exclude_items($file)) {
                    $files[] = $file;
                } elseif (@is_dir($new_path) && $file != '.' && $file != '..' && fm_is_exclude_items($file)) {
                    $folders[] = $file;
                }
            }
        }

        if (!empty($files)) {
            natcasesort($files);
        }
        if (!empty($folders)) {
            natcasesort($folders);
        }


        // Mass deleting
        if (isset($_POST['group'], $_POST['delete']) && !FM_READONLY) {
            $path = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $path .= '/' . FM_PATH;
            }

            $errors = 0;
            $files = $_POST['file'];
            if (is_array($files) && count($files)) {
                foreach ($files as $f) {
                    if ($f != '') {
                        $new_path = $path . '/' . $f;
                        if (!fm_rdelete($new_path)) {
                            $errors++;
                        }
                    }
                }
                if ($errors == 0) {
                    fm_set_msg(lng('Selected files and folder deleted'));
                } else {
                    fm_set_msg(lng('Error while deleting items'), 'error');
                }
            } else {
                fm_set_msg(lng('Nothing selected'), 'alert');
            }

            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }
        // Copy folder / file
        if (isset($_GET['copy'], $_GET['finish']) && !FM_READONLY) {
            // from
            $copy = $_GET['copy'];
            $copy = fm_clean_path($copy);
            // empty path
            if ($copy == '') {
                fm_set_msg(lng('Source path not defined'), 'error');
                fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
            }
            // abs path from
            $from = FM_ROOT_PATH . '/' . $copy;
            // abs path to
            $dest = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $dest .= '/' . FM_PATH;
            }
            $dest .= '/' . basename($from);
            // move?
            $move = isset($_GET['move']);
            // copy/move/duplicate
            if ($from != $dest) {
                $msg_from = trim(FM_PATH . '/' . basename($from), '/');
                if ($move) { // Move and to != from so just perform move
                    $rename = fm_rename($from, $dest);
                    if ($rename) {
                        fm_set_msg(sprintf(lng('Moved from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
                    } elseif ($rename === null) {
                        fm_set_msg(lng('File or folder with this path already exists'), 'alert');
                    } else {
                        fm_set_msg(sprintf(lng('Error while moving from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
                    }
                } else { // Not move and to != from so copy with original name
                    if (fm_rcopy($from, $dest)) {
                        fm_set_msg(sprintf(lng('Copied from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
                    } else {
                        fm_set_msg(sprintf(lng('Error while copying from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
                    }
                }
            } else {
            if (!$move){ //Not move and to = from so duplicate
                    $msg_from = trim(FM_PATH . '/' . basename($from), '/');
                    $fn_parts = pathinfo($from);
                    $extension_suffix = '';
                    if(!is_dir($from)){
                    $extension_suffix = '.'.$fn_parts['extension'];
                    }
                    //Create new name for duplicate
                    $fn_duplicate = $fn_parts['dirname'].'/'.$fn_parts['filename'].'-'.date('YmdHis').$extension_suffix;
                    $loop_count = 0;
                    $max_loop = 1000;
                    // Check if a file with the duplicate name already exists, if so, make new name (edge case...)
                    while(file_exists($fn_duplicate) & $loop_count < $max_loop){
                    $fn_parts = pathinfo($fn_duplicate);
                    $fn_duplicate = $fn_parts['dirname'].'/'.$fn_parts['filename'].'-copy'.$extension_suffix;
                    $loop_count++;
                    }
                    if (fm_rcopy($from, $fn_duplicate, False)) {
                        fm_set_msg(sprintf('Copyied from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($fn_duplicate)));
                    } else {
                        fm_set_msg(sprintf('Error while copying from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($fn_duplicate)), 'error');
                    }
            }
            else{
                fm_set_msg(lng('Paths must be not equal'), 'alert');
            }
            }
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }
        // Mass copy files/ folders
        if (isset($_POST['file'], $_POST['copy_to'], $_POST['finish']) && !FM_READONLY) {
            // from
            $path = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $path .= '/' . FM_PATH;
            }
            // to
            $copy_to_path = FM_ROOT_PATH;
            $copy_to = fm_clean_path($_POST['copy_to']);
            if ($copy_to != '') {
                $copy_to_path .= '/' . $copy_to;
            }
            if ($path == $copy_to_path) {
                fm_set_msg(lng('Paths must be not equal'), 'alert');
                fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
            }
            if (!is_dir($copy_to_path)) {
                if (!fm_mkdir($copy_to_path, true)) {
                    fm_set_msg('Unable to create destination folder', 'error');
                    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
                }
            }
            // move?
            $move = isset($_POST['move']);
            // copy/move
            $errors = 0;
            $files = $_POST['file'];
            if (is_array($files) && count($files)) {
                foreach ($files as $f) {
                    if ($f != '') {
                        // abs path from
                        $from = $path . '/' . $f;
                        // abs path to
                        $dest = $copy_to_path . '/' . $f;
                        // do
                        if ($move) {
                            $rename = fm_rename($from, $dest);
                            if ($rename === false) {
                                $errors++;
                            }
                        } else {
                            if (!fm_rcopy($from, $dest)) {
                                $errors++;
                            }
                        }
                    }
                }
                if ($errors == 0) {
                    $msg = $move ? 'Selected files and folders moved' : 'Selected files and folders copied';
                    fm_set_msg($msg);
                } else {
                    $msg = $move ? 'Error while moving items' : 'Error while copying items';
                    fm_set_msg($msg, 'error');
                }
            } else {
                fm_set_msg(lng('Nothing selected'), 'alert');
            }
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }
        // Rename
        if (isset($_GET['ren'], $_GET['to']) && !FM_READONLY) {
            // old name
            $old = $_GET['ren'];
            $old = fm_clean_path($old);
            $old = str_replace('/', '', $old);
            // new name
            $new = $_GET['to'];
            $new = fm_clean_path(strip_tags($new));
            $new = str_replace('/', '', $new);
            // path
            $path = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $path .= '/' . FM_PATH;
            }
            // rename
            if (fm_isvalid_filename($new) && $old != '' && $new != '') {
                if (fm_rename($path . '/' . $old, $path . '/' . $new)) {
                    fm_set_msg(sprintf(lng('Renamed from').' <b>%s</b> '. lng('to').' <b>%s</b>', fm_enc($old), fm_enc($new)));
                } else {
                    fm_set_msg(sprintf(lng('Error while renaming from').' <b>%s</b> '. lng('to').' <b>%s</b>', fm_enc($old), fm_enc($new)), 'error');
                }
            } else {
                fm_set_msg(lng('Invalid characters in file name'), 'error');
            }
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }

        // Delete file / folder
        if (isset($_GET['del']) && !FM_READONLY) {
            $del = str_replace( '/', '', fm_clean_path( $_GET['del'] ) );
            if ($del != '' && $del != '..' && $del != '.') {
                $path = FM_ROOT_PATH;
                if (FM_PATH != '') {
                    $path .= '/' . FM_PATH;
                }
                $is_dir = is_dir($path . '/' . $del);
                if (fm_rdelete($path . '/' . $del)) {
                    $msg = $is_dir ? lng('Folder').' <b>%s</b> '.lng('Deleted') : lng('File').' <b>%s</b> '.lng('Deleted');
                    fm_set_msg(sprintf($msg, fm_enc($del)));
                } else {
                    $msg = $is_dir ? lng('Folder').' <b>%s</b> '.lng('not deleted') : lng('File').' <b>%s</b> '.lng('not deleted');
                    fm_set_msg(sprintf($msg, fm_enc($del)), 'error');
                }
            } else {
                fm_set_msg(lng('Invalid file or folder name'), 'error');
            }
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }


        $head['title'] = 'File Manager';
        $this->load->view('fixed/header', $head);



        // show alert messages
        fm_show_message();

        $num_files = count($files);
        $num_folders = count($folders);
        $all_files_size = 0;
        //$tableTheme = (FM_THEME == "dark") ? "text-white bg-dark table-dark" : "bg-white";

        $table='<form action="" method="post">
            <input type="hidden" name="p" value="'. fm_enc(FM_PATH) .'">
            <input type="hidden" name="group" value="1">
            <input type="hidden" name="token" value="'. $_SESSION['token'].'">
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration dataTable dtr-inline" id="main-table">
                <thead class="thead-white">
                    <tr>';
                 if (!FM_READONLY):
                  $table .= '<th style="width:3%" class="custom-checkbox-header">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="js-select-all-items" onclick="checkbox_toggle()">
                            <label class="custom-control-label" for="js-select-all-items"></label>
                        </div>
                    </th>';
                endif;
                $table .= '<th>'.lng('Name').'</th>';
                $table .= '<th>'.lng('Size').'</th>';
                $table .= '<th>'.lng('Modified').'</th>';
                if (!FM_IS_WIN && !$this->hide_Cols):
                    $table .= '<th>'.lng('Perms').'</th>';
                    $table .= '<th>'.lng('Owner').'</th>';
                endif;
                $table .= '<th>'.lng('Actions').'</th>
            </tr>
            </thead><tbody>';

            // link to parent folder
            if ($parent !== false) {

                $table .= '<tr>';
                if (!FM_READONLY):
                    $table .= '<td class="nosort"></td>';
                endif;
                    $table .= '<td class="border-0" data-sort><a href="?p='.urlencode($parent).'"><i class="fa fa-chevron-circle-left go-back"></i> ..</a></td>
                    <td class="border-0" data-order></td>
                    <td class="border-0" data-order></td>
                    <td class="border-0"></td>';
                if (!FM_IS_WIN && !$this->hide_Cols) {
                        $table .= '<td class="border-0"></td>
                        <td class="border-0"></td>';
                    }
                $table .= '</tr>';

            }
            $ii = 3399;
            foreach ($folders as $f) {
                $is_link = is_link($path . '/' . $f);
                $img = $is_link ? 'icon-link_folder' : 'fa fa-folder-o';
                $modif_raw = filemtime($path . '/' . $f);
                $modif = date(FM_DATETIME_FORMAT, $modif_raw);
                $date_sorting = strtotime(date("F d Y H:i:s.", $modif_raw));
                $filesize_raw = "";
                $filesize = lng('Folder');
                $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                    $owner = posix_getpwuid(fileowner($path . '/' . $f));
                    $group = posix_getgrgid(filegroup($path . '/' . $f));
                    if ($owner === false) {
                        $owner = array('name' => '?');
                    }
                    if ($group === false) {
                        $group = array('name' => '?');
                    }
                } else {
                    $owner = array('name' => '?');
                    $group = array('name' => '?');
                }

                $table .= '<tr>';
                     if (!FM_READONLY):
                        $table .= '<td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">';
                            $table .= '<input type="checkbox" class="custom-control-input" id="'.$ii.'" name="file[]" value="'.fm_enc($f).'">';
                            $table .= '<label class="custom-control-label" for="'.$ii.'"></label>';
                        $table .= '</div>
                        </td>';
                    endif;
                    $table .= '<td data-sort='.fm_convert_win(fm_enc($f)).'>';
                        $table .= '<div class="filename"><a href="?p='.urlencode(trim(FM_PATH . '/' . $f, '/')).'"><i class="'.$img.'"></i> '.fm_convert_win(fm_enc($f)).'</a>'.($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '').'</div>
                    </td>
                    <td data-order="a-'.str_pad($filesize_raw, 18, "0", STR_PAD_LEFT).'">';
                        $table .= $filesize;
                    $table .= '</td>
                    <td data-order="a-'.$date_sorting.'">'.$modif.'</td>';
                    if (!FM_IS_WIN && !$this->hide_Cols):
                        $table .= '<td>';
                        if (!FM_READONLY):
                            $table .= '<a title="Change Permissions" href="?p='.urlencode(FM_PATH).'&amp;chmod='.urlencode($f).'">'.$perms.'</a>';
                            else:
                                $table .= $perms;
                            endif;
                        $table .= '</td>
                        <td>'.$owner['name'] . ':' . $group['name'].'</td>';
                    endif;
                    $table .= '<td class="inline-actions">';
                    if (!FM_READONLY):
                            $table .= '<a title="'.lng('Delete').'" href="'.fm_enc(FM_ROOT_URL).'/delete?p='.urlencode(FM_PATH).'&amp;del='.urlencode($f).'" fpath="'.FM_PATH.'" ffile="'.$f.'" class="btn btn-danger"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                            $table .= '<a title="'.lng('Rename').'" href="#" onclick="rename(\''.fm_enc(addslashes(FM_PATH)).'\', \''.fm_enc(addslashes($f)).'\');return false;" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                            $table .= '<a title="'.lng('CopyTo').'..." href="'.fm_enc(FM_ROOT_URL).'/copyto?p=&amp;copy='.urlencode(trim(FM_PATH . '/' . $f, '/')).'" class="btn btn-primary"><i class="fa fa-files-o" aria-hidden="true" class="btn btn-info"></i></a>';
                         endif;
                        $table .= '<a title="'.lng('DirectLink').'" href="'.base_url().";".$this->root_url .":".(FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f . '/'.'" target="_blank" class="btn btn-blue"><i class="fa fa-share-square-o" aria-hidden="true"></i></a>
                    </td>
                </tr>';

                flush();
                $ii++;
            }

            $ik = 6070;
           foreach ($files as $f) {
                $is_link = is_link($path . '/' . $f);
                $img = $is_link ? 'fa fa-file-text-o' : fm_get_file_icon_class($path . '/' . $f);
                $modif_raw = filemtime($path . '/' . $f);
                $modif = date(FM_DATETIME_FORMAT, $modif_raw);
                $date_sorting = strtotime(date("F d Y H:i:s.", $modif_raw));
                $filesize_raw = fm_get_size($path . '/' . $f);
                $filesize = fm_get_filesize($filesize_raw);
                $filelink = 'filemanager/fileview?p=' . urlencode(FM_PATH) . '&amp;view=' . urlencode($f);
                $all_files_size += $filesize_raw;
                $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                    $owner = posix_getpwuid(fileowner($path . '/' . $f));
                    $group = posix_getgrgid(filegroup($path . '/' . $f));
                    if ($owner === false) {
                        $owner = array('name' => '?');
                    }
                    if ($group === false) {
                        $group = array('name' => '?');
                    }
                } else {
                    $owner = array('name' => '?');
                    $group = array('name' => '?');
                }

                $table .= '<tr>';
                if (!FM_READONLY):
                        $table .= '<td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="'.$ik.'" name="file[]" value="'.fm_enc($f).'">
                            <label class="custom-control-label" for="'.$ik.'"></label>
                        </div>
                        </td>';
                        endif;
                    $table .= '<td data-sort='.fm_enc($f).'>
                        <div class="filename">';
                           if (in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'svg', 'webp', 'avif'))):
                                 $imagePreview = fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f);
                                $table .= '<a href="'.$filelink.'" data-preview-image="'.$imagePreview.'" title="'.fm_enc($f).'">';
                           else:
                                $table .= '<a href="'.$filelink.'" title="'.$f.'">';
                           endif;
                                $table .= '<i class="'.$img.'"></i> '.fm_convert_win(fm_enc($f)).'</a>';
                                $table .= ($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '');
                        $table .= '</div>
                    </td>';
                    $table .= '<td data-order="b-'.str_pad($filesize_raw, 18, "0", STR_PAD_LEFT).'"><span title="'.( $filesize_raw.' bytes').'">
                        '.$filesize.'
                        </span></td>';
                    $table .= '<td data-order="b-'.$date_sorting.'">'.$modif.'</td>';
                    if (!FM_IS_WIN && !$this->hide_Cols):
                        $table .= '<td>';
                        if (!FM_READONLY):
                            $table .='<a title="Change Permissions" href="?p='.urlencode(FM_PATH).'&amp;chmod='.urlencode($f).'">'.$perms.'</a>';
                    else:
                        $table.= $perms;
                    endif;
                        $table.='</td>
                        <td>'.fm_enc($owner['name'] . ':' . $group['name']).'</td>';

                    endif;
                    $table.='<td class="inline-actions">';
                         if (!FM_READONLY):
                           $table.='<a title="'.lng('Delete').'" href="'.fm_enc(FM_ROOT_URL).'/delete?" fpath="'.FM_PATH.'" ffile="'.$f.'" class="btn btn-danger"> <i class="fa fa-trash-o"></i></a>';
                           $table.='<a title="'.lng('Rename').'" href="#" onclick="rename(\''.fm_enc(addslashes(FM_PATH)).'\', \''.fm_enc(addslashes($f)).'\');return false;" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>';
                           $table.='<a title="'.lng('CopyTo').'..."
                               href="'.fm_enc(FM_ROOT_URL).'/copyto?p='.urlencode(FM_PATH).'&amp;copy='.urlencode(trim(FM_PATH . '/' . $f, '/')).'" class="btn btn-primary"><i class="fa fa-files-o"></i></a>';
                        endif;
                        $table.='<a title="'.lng('DirectLink').'" href="'.fm_enc(FM_ROOT_URL ."" . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f).'" target="_blank" class="btn btn-blue"><i class="fa fa-share-square-o"></i></a>';
                        $table.='<a title="'.lng('Download').'" href="'.fm_enc(FM_ROOT_URL).'/download?p='.urlencode(FM_PATH).'&amp;dl='.urlencode($f).'" class="btn btn-success"><i class="fa fa-download"></i></a>';
                       // $table.='<a title="'.lng('Download').'" href="'.fm_enc(FM_ROOT_URL).'/download?p='.urlencode(FM_PATH).'&amp;dl='.urlencode($f).'" onclick="confirmDailog(event, 1211, \''.lng('Download').'\',\''.urlencode($f).'\', this.href,\'download\');"><i class="fa fa-download"></i></a>';
                    $table.='</td>';
                $table.='</tr>';

                flush();
                $ik++;
            }

            if (empty($folders) && empty($files)) {
                $table.='<tfoot>
                    <tr>';
                        if (!FM_READONLY):
                            $table.='<td></td>';
                        endif;
                        $table.='<td colspan="'.((!FM_IS_WIN && !$this->hide_Cols) ? '6' : '4').'"><em>'.lng('Folder is empty').'</em></td>
                    </tr>
                </tbody></tfoot>';
            } else {
               $table.='<tfoot>
                    <tr>';
                        $table.='<td class="gray" colspan="'.((!FM_IS_WIN && !$this->hide_Cols) ? (FM_READONLY ? '6' :'7') : (FM_READONLY ? '4' : '5')).'">';
                            $table.=lng('FullSize').': <span class="badge text-bg-light border-radius-0">'.fm_get_filesize($all_files_size).'</span>';
                            $table.=lng('File').': <span class="badge text-bg-light border-radius-0">'.$num_files.'</span>';
                            $table.=lng('Folder').': <span class="badge text-bg-light border-radius-0">'.$num_folders.'</span>';
                        $table.='</td>
                    </tr>
                </tfoot>';
            }
        $table.='</table>
        </div>

        <div class="row">';
        if (!FM_READONLY):
        $table.='<div class="col-xs-12 col-sm-9">
            <ul class="list-inline footer-action">';
                $table.='<li class="list-inline-item"> <a href="#/select-all" class="btn btn-small btn-outline-blue btn-2" onclick="select_all();return false;"><i class="fa fa-check-square"></i> '.lng('SelectAll').'</a></li>';
                $table.='<li class="list-inline-item"><a href="#/unselect-all" class="btn btn-small btn-outline-primary btn-2" onclick="unselect_all();return false;"><i class="fa fa-window-close"></i> '.lng('UnSelectAll').' </a></li>';
                $table.='<li class="list-inline-item"><a href="#/invert-all" class="btn btn-small btn-outline-warning btn-2" onclick="invert_all();return false;"><i class="fa fa-th-list"></i> '.lng('InvertSelection').' </a></li>';
                $table.='<li class="list-inline-item"><input type="submit" class="hidden" name="delete" id="a-delete" value="Delete" onclick="return confirm(\''.lng('Delete selected files and folders?').'\')">';
                    $table.='<a href="javascript:document.getElementById(\'a-delete\').click();" class="btn btn-small btn-outline-danger btn-2"><i class="fa fa-trash"></i> '.lng('Delete').'</a></li>';
                    /*
                $table.='<li class="list-inline-item"><input type="submit" class="hidden" name="zip" id="a-zip" value="zip" onclick="return confirm(\''.lng('Create archive?').'\')">';
                    $table.='<a href="javascript:document.getElementById(\'a-zip\').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> '.lng('Zip').' </a></li>';
                $table.='<li class="list-inline-item"><input type="submit" class="hidden" name="tar" id="a-tar" value="tar" onclick="return confirm(\''.lng('Create archive?').'\')">';
                    $table.='<a href="javascript:document.getElementById(\'a-tar\').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> '.lng('Tar').' </a></li>';
                $table.='<li class="list-inline-item"><input type="submit" class="hidden" name="copy" id="a-copy" value="Copy">';
                    $table.='<a href="javascript:document.getElementById(\'a-copy\').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-files-o"></i> '.lng('Copy').' </a></li>';*/
            $table.='</ul>
        </div>';
        endif;
        $table.='</div>
        </form>';
        //$table='testing';
        $data['form']=$table;
        $data['message']=fm_show_message();


        $this->load->view('filemanager/list', $data);
        $this->load->view('fixed/footer');


    }
    public function fileview(){
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }

        // file viewer
        if (isset($_GET['view'])) {
            $file = $_GET['view'];
            $file = fm_clean_path($file, false);
            $file = str_replace('/', '', $file);
            if ($file == '' || !is_file($path . '/' . $file) || in_array($file, $this->exclude_items)) {
                fm_set_msg(lng('File not found'), 'error');
                $FM_PATH=FM_PATH; fm_redirect(FM_SELF_URL . '?p=' . urlencode($FM_PATH));
            }

           // fm_show_header(); // HEADER
            //fm_show_nav_path(FM_PATH); // current path

            $file_url = FM_ROOT_URL .'/../userfiles/filemanager'. fm_convert_win((FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file);
            $file_path = $path . '/' . $file;

            $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            $mime_type = fm_get_mime_type($file_path);
            $filesize_raw = fm_get_size($file_path);
            $filesize = fm_get_filesize($filesize_raw);

            $is_zip = false;
            $is_gzip = false;
            $is_image = false;
            $is_audio = false;
            $is_video = false;
            $is_text = false;
            $is_onlineViewer = false;

            $view_title = 'File';
            $filenames = false; // for zip
            $content = ''; // for text
            $online_viewer = strtolower(FM_DOC_VIEWER);

            if($online_viewer && $online_viewer !== 'false' && in_array($ext, fm_get_onlineViewer_exts())){
                $is_onlineViewer = true;
            }
            elseif ($ext == 'zip' || $ext == 'tar') {
                $is_zip = true;
                $view_title = 'Archive';
                $filenames = fm_get_zif_info($file_path, $ext);
            } elseif (in_array($ext, fm_get_image_exts())) {
                $is_image = true;
                $view_title = 'Image';
            } elseif (in_array($ext, fm_get_audio_exts())) {
                $is_audio = true;
                $view_title = 'Audio';
            } elseif (in_array($ext, fm_get_video_exts())) {
                $is_video = true;
                $view_title = 'Video';
            } elseif (in_array($ext, fm_get_text_exts()) || substr($mime_type, 0, 4) == 'text' || in_array($mime_type, fm_get_text_mimes())) {
                $is_text = true;
                $content = file_get_contents($file_path);
            }

            ?>
            <div class="row">
                <div class="col-12">
                    <p class="break-word"><b><?php echo lng($view_title) ?> "<?php echo fm_enc(fm_convert_win($file)) ?>"</b></p>
                    <p class="break-word">
                        <?php $display_path = fm_get_display_path($file_path); ?>
                        <strong><?php echo $display_path['label']; ?>:</strong> <?php echo $display_path['path']; ?><br>
                        <strong>File size:</strong> <?php echo ($filesize_raw <= 1000) ? "$filesize_raw bytes" : $filesize; ?><br>
                        <strong>MIME-type:</strong> <?php echo $mime_type ?><br>
                        <?php
                        // ZIP info
                        if (($is_zip || $is_gzip) && $filenames !== false) {
                            $total_files = 0;
                            $total_comp = 0;
                            $total_uncomp = 0;
                            foreach ($filenames as $fn) {
                                if (!$fn['folder']) {
                                    $total_files++;
                                }
                                $total_comp += $fn['compressed_size'];
                                $total_uncomp += $fn['filesize'];
                            }
                            ?>
                            <?php echo lng('Files in archive') ?>: <?php echo $total_files ?><br>
                            <?php echo lng('Total size') ?>: <?php echo fm_get_filesize($total_uncomp) ?><br>
                            <?php echo lng('Size in archive') ?>: <?php echo fm_get_filesize($total_comp) ?><br>
                            <?php echo lng('Compression') ?>: <?php echo round(($total_comp / max($total_uncomp, 1)) * 100) ?>%<br>
                            <?php
                        }
                        // Image info
                        if ($is_image) {
                            $image_size = getimagesize($file_path);
                            echo '<strong>'.lng('Image size').':</strong> ' . (isset($image_size[0]) ? $image_size[0] : '0') . ' x ' . (isset($image_size[1]) ? $image_size[1] : '0') . '<br>';
                        }
                        // Text info
                        if ($is_text) {
                            $is_utf8 = fm_is_utf8($content);
                            if (function_exists('iconv')) {
                                if (!$is_utf8) {
                                    $content = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $content);
                                }
                            }
                            echo '<strong>'.lng('Charset').':</strong> ' . ($is_utf8 ? 'utf-8' : '8 bit') . '<br>';
                        }
                        ?>
                    </p>
                    <div class="d-flex align-items-center mb-3">
                        <form method="post" class="d-inline ms-2" action="<?php echo base_url('filemanager/download') ?>?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($file) ?>">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                            <button type="submit" class="btn btn-link text-decoration-none fw-bold p-0"><i class="fa fa-cloud-download"></i> <?php echo lng('Download') ?></button> &nbsp;
                        </form>
                        <b class="ms-2"><a href="<?php echo fm_enc($file_url) ?>" target="_blank"><i class="fa fa-external-link-square"></i> <?php echo lng('Open') ?></a></b>
                        <?php
                        // ZIP actions
                        if (!FM_READONLY && ($is_zip || $is_gzip) && $filenames !== false) {
                            $zip_name = pathinfo($file_path, PATHINFO_FILENAME);
                            ?>
                            <form method="post" class="d-inline ms-2">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                <input type="hidden" name="unzip" value="<?php echo urlencode($file); ?>">
                                <button type="submit" class="btn btn-link text-decoration-none fw-bold p-0" style="font-size: 14px;"><i class="fa fa-check-circle"></i> <?php echo lng('UnZip') ?></button>
                            </form>&nbsp;
                            <form method="post" class="d-inline ms-2">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                <input type="hidden" name="unzip" value="<?php echo urlencode($file); ?>">
                                <input type="hidden" name="tofolder" value="1">
                                <button type="submit" class="btn btn-link text-decoration-none fw-bold p-0" style="font-size: 14px;" title="UnZip to <?php echo fm_enc($zip_name) ?>"><i class="fa fa-check-circle"></i> <?php echo lng('UnZipToFolder') ?></button>
                            </form>&nbsp;
                            <?php
                        }
                        if ($is_text && !FM_READONLY) {
                            ?>
                            <b class="ms-2"><a href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>" class="edit-file"><i class="fa fa-pencil-square"></i> <?php echo lng('Edit') ?>
                                </a></b> &nbsp;
                            <b class="ms-2"><a href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>&env=ace"
                                    class="edit-file"><i class="fa fa-pencil-square-o"></i> <?php echo lng('AdvancedEditor') ?>
                                </a></b> &nbsp;
                        <?php } ?>
                        <b class="ms-2"><a href="<?php echo base_url('filemanager')?>?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-chevron-circle-left go-back"></i> <?php echo lng('Back') ?></a></b>
                    </div>
                    <?php
                    if($is_onlineViewer) {
                        if($online_viewer == 'google') {
                            echo '<iframe src="https://docs.google.com/viewer?embedded=true&hl=en&url=' . fm_enc($file_url) . '" frameborder="no" style="width:100%;min-height:460px"></iframe>';
                        } else if($online_viewer == 'microsoft') {
                            echo '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=' . fm_enc($file_url) . '" frameborder="no" style="width:100%;min-height:460px"></iframe>';
                        }
                    } elseif ($is_zip) {
                        // ZIP content
                        if ($filenames !== false) {
                            echo '<code class="maxheight">';
                            foreach ($filenames as $fn) {
                                if ($fn['folder']) {
                                    echo '<b>' . fm_enc($fn['name']) . '</b><br>';
                                } else {
                                    echo $fn['name'] . ' (' . fm_get_filesize($fn['filesize']) . ')<br>';
                                }
                            }
                            echo '</code>';
                        } else {
                            echo '<p>'.lng('Error while fetching archive info').'</p>';
                        }
                    } elseif ($is_image) {
                        // Image content
                        if (in_array($ext, array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'svg', 'webp', 'avif'))) {
                            echo '<p><input type="checkbox" id="preview-img-zoomCheck"><label for="preview-img-zoomCheck"><img src="' . fm_enc($file_url) . '" alt="image" class="preview-img"></label></p>';
                        }
                    } elseif ($is_audio) {
                        // Audio content
                        echo '<p><audio src="' . fm_enc($file_url) . '" controls preload="metadata"></audio></p>';
                    } elseif ($is_video) {
                        // Video content
                        echo '<div class="preview-video"><video src="' . fm_enc($file_url) . '" width="640" height="360" controls preload="metadata"></video></div>';
                    } elseif ($is_text) {
                        if (FM_USE_HIGHLIGHTJS) {
                            // highlight
                            $hljs_classes = array(
                                'shtml' => 'xml',
                                'htaccess' => 'apache',
                                'phtml' => 'php',
                                'lock' => 'json',
                                'svg' => 'xml',
                            );
                            $hljs_class = isset($hljs_classes[$ext]) ? 'lang-' . $hljs_classes[$ext] : 'lang-' . $ext;
                            if (empty($ext) || in_array(strtolower($file), fm_get_text_names()) || preg_match('#\.min\.(css|js)$#i', $file)) {
                                $hljs_class = 'nohighlight';
                            }
                            $content = '<pre class="with-hljs"><code class="' . $hljs_class . '">' . fm_enc($content) . '</code></pre>';
                        } elseif (in_array($ext, array('php', 'php4', 'php5', 'phtml', 'phps'))) {
                            // php highlight
                            $content = highlight_string($content, true);
                        } else {
                            $content = '<pre>' . fm_enc($content) . '</pre>';
                        }
                        echo $content;
                    }

                    ?>
                </div>
            </div>
            <?php
            exit;
        }
    }
    public function download(){
        // Download
        print_r($_GET['dl']);
        $id = $this->input->get('dl');
        if (isset($id) && !empty($id)) {

            $dl = urldecode($id );
            $dl = fm_clean_path($dl);
            $dl = str_replace('/', '', $dl);
            $path = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $path .= '/' . FM_PATH;
            }
            if ($dl != '' && is_file($path . '/' . $dl)) {
                fm_download_file($path . '/' . $dl, $dl, 1024);
                exit;
            } else {
                fm_set_msg(lng('File not found'), 'error');
                $FM_PATH=FM_PATH; fm_redirect(FM_SELF_URL . '?p=' . urlencode($FM_PATH));
            }
        }
    }
    public function copyto(){
        if (isset($_GET['copy']) && !isset($_GET['finish']) && !FM_READONLY) {
                // get current path
            $path = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $path .= '/' . FM_PATH;
            }

            // check path
            if (!is_dir($path)) {
                fm_redirect(FM_SELF_URL . '?p=');
            }
            // get parent folder
            $parent = fm_get_parent_path(FM_PATH);

            $objects = is_readable($path) ? scandir($path) : array();
            $folders = array();
            $files = array();
            $current_path = array_slice(explode("/",$path), -1)[0];
            if (is_array($objects) && fm_is_exclude_items($current_path)) {
                foreach ($objects as $file) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    if (!FM_SHOW_HIDDEN && substr($file, 0, 1) === '.') {
                        continue;
                    }
                    $new_path = $path . '/' . $file;
                    if (@is_file($new_path) && fm_is_exclude_items($file)) {
                        $files[] = $file;
                    } elseif (@is_dir($new_path) && $file != '.' && $file != '..' && fm_is_exclude_items($file)) {
                        $folders[] = $file;
                    }
                }
            }

            if (!empty($files)) {
                natcasesort($files);
            }
            if (!empty($folders)) {
                natcasesort($folders);
            }


            $copy = $_GET['copy'];
            $copy = fm_clean_path($copy);
            if ($copy == '' || !file_exists(FM_ROOT_PATH . '/' . $copy)) {
                fm_set_msg(lng('File not found'), 'error');
                fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
            }

            $head['title'] = 'File Manager';
            $this->load->view('fixed/header', $head);
            $copyhtml='<div class="path">';
            $copyhtml.='<p><b>Copying</b></p>';
            $copyhtml.='<p class="break-word">';
            $copyhtml.='Source path: '.fm_enc(FM_ROOT_URL . '/' . $copy).'<br>';
            $copyhtml.='Destination folder: '.fm_enc(FM_ROOT_URL . '/' . FM_PATH);
            $copyhtml.='</p>';
            $copyhtml.='<p>';
            $copyhtml.='<b><a href="?p='.urlencode(FM_PATH).'&amp;copy='.urlencode($copy).'&amp;finish=1"><i class="fa fa-check-circle"></i> Copy</a></b> &nbsp;';
            $copyhtml.='<b><a href="?p='.urlencode(FM_PATH).'&amp;copy='.urlencode($copy).'&amp;finish=1&amp;move=1"><i class="fa fa-check-circle"></i> Move</a></b> &nbsp;';
            $copyhtml.='<b><a href="?p='.urlencode(FM_PATH).'"><i class="fa fa-times-circle"></i> Cancel</a></b>';
            $copyhtml.='</p>';
            $copyhtml.='<p><i>'.lng('Select folder').'</i></p>';
            $copyhtml.='<ul class="folders break-word">';
                if ($parent !== false) {
                    $copyhtml.='<li><a href="'.fm_enc(FM_ROOT_URL) . '/copyto?p='.urlencode($parent).'&amp;copy='.urlencode($copy).'"><i class="fa fa-chevron-circle-left"></i> ..</a></li>';
                }
                foreach ($folders as $f) {
                    $copyhtml.='<li>';
                    $copyhtml.='<a href="'.fm_enc(FM_ROOT_URL) . '/copyto?p='.urlencode(trim(FM_PATH . '/' . $f, '/')).'&amp;copy='.urlencode($copy).'"><i class="fa fa-folder-o"></i> '.fm_convert_win($f).'</a></li>';
                }
            $copyhtml.='</ul>';
            $copyhtml.='</div>';

            $data['form']=$copyhtml;
            $data['message']=fm_show_message();
            $this->load->view('filemanager/copyto', $data);
            $this->load->view('fixed/footer');
        } elseif (isset($_GET['copy'], $_GET['finish']) && !FM_READONLY) {
            // from
            $copy = $_GET['copy'];
            $copy = fm_clean_path($copy);
            // empty path
            if ($copy == '') {
                fm_set_msg(lng('Source path not defined'), 'error');
                fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
            }
            // abs path from
            $from = FM_ROOT_PATH . '/' . $copy;
            // abs path to
            $dest = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $dest .= '/' . FM_PATH;
            }
            $dest .= '/' . basename($from);
            // move?
            $move = isset($_GET['move']);
            // copy/move/duplicate
            if ($from != $dest) {
                $msg_from = trim(FM_PATH . '/' . basename($from), '/');
                if ($move) { // Move and to != from so just perform move
                    $rename = fm_rename($from, $dest);
                    if ($rename) {
                        fm_set_msg(sprintf(lng('Moved from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
                    } elseif ($rename === null) {
                        fm_set_msg(lng('File or folder with this path already exists'), 'alert');
                    } else {
                        fm_set_msg(sprintf(lng('Error while moving from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
                    }
                } else { // Not move and to != from so copy with original name
                    if (fm_rcopy($from, $dest)) {
                        fm_set_msg(sprintf(lng('Copied from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
                    } else {
                        fm_set_msg(sprintf(lng('Error while copying from').' <b>%s</b> '.lng('to').' <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
                    }
                }
            } else {
            if (!$move){ //Not move and to = from so duplicate
                    $msg_from = trim(FM_PATH . '/' . basename($from), '/');
                    $fn_parts = pathinfo($from);
                    $extension_suffix = '';
                    if(!is_dir($from)){
                    $extension_suffix = '.'.$fn_parts['extension'];
                    }
                    //Create new name for duplicate
                    $fn_duplicate = $fn_parts['dirname'].'/'.$fn_parts['filename'].'-'.date('YmdHis').$extension_suffix;
                    $loop_count = 0;
                    $max_loop = 1000;
                    // Check if a file with the duplicate name already exists, if so, make new name (edge case...)
                    while(file_exists($fn_duplicate) & $loop_count < $max_loop){
                    $fn_parts = pathinfo($fn_duplicate);
                    $fn_duplicate = $fn_parts['dirname'].'/'.$fn_parts['filename'].'-copy'.$extension_suffix;
                    $loop_count++;
                    }
                    if (fm_rcopy($from, $fn_duplicate, False)) {
                        fm_set_msg(sprintf('Copyied from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($fn_duplicate)));
                    } else {
                        fm_set_msg(sprintf('Error while copying from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($fn_duplicate)), 'error');
                    }
            }
            else{
                fm_set_msg(lng('Paths must be not equal'), 'alert');
            }
            }
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }

    }
    public function sharedfolders() {
        echo '<div>Shared Folder</div>';
    }
    public function sharedfiles() {
        echo '<div>Shared Folder</div>';
    }
    public function delete(){
        // Mass deleting

        if (isset($_GET['p'], $_GET['del'], $_GET['token']) && !FM_READONLY) {

            if(!verifyToken($_GET['token'])) {
                fm_set_msg(lng("Invalid Token."), 'error');
            }
            $path = FM_ROOT_PATH;
            if (FM_PATH != '') {
                $path .= '/' . FM_PATH;
            }
            $errors = 0;
            $files = $_GET['del'];
            if (is_array($files) && count($files)) {
                foreach ($files as $f) {
                    if ($f != '') {
                        $new_path = $path . '/' . $f;
                        if (!fm_rdelete($new_path)) {
                            $errors++;
                        }
                    }
                }
                if ($errors == 0) {
                    fm_set_msg(lng('Selected files and folder deleted'));
                } else {
                    fm_set_msg(lng('Error while deleting items'), 'error');
                }
            } else if(!empty($files))
            {
                 $new_path = $path . '/' . $files;
                        if (!fm_rdelete($new_path)) {
                            $errors=$errors+1;
                        }
            if ($errors == 0) {
                    fm_set_msg(lng('Selected files and folder deleted'));
                } else {
                    fm_set_msg(lng('Error while deleting items'), 'error');
                }
            }else{
                fm_set_msg(lng('Nothing selected'), 'alert');
            }

            $FM_PATH=FM_PATH;
            ///fm_redirect(FM_SELF_URL . '?p=' . urlencode($FM_PATH));
            $url='';
            if (empty($FM_PATH)){
            $url=FM_SELF_URL . '?p=';
            }else{
            $url=FM_SELF_URL . '?p=' . urlencode($FM_PATH);
            }
            redirect($url,'refresh');
        }
    }

    /*Get all Events
    public function getEvents()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $result = $this->events_model->getEvents($start, $end);
        echo json_encode($result);
    } */

    /*Add new event
    public function addEvent()
    {
        $title = $this->input->post('title', true);
        $start = $this->input->post('start', true);
        $end = $this->input->post('end', true);
        $description = $this->input->post('description', true);
        $color = $this->input->post('color');

        $result = $this->events_model->addEvent($title, $start, $end, $description, $color);

    } */

    /*Update Event
    public function updateEvent()
    {
        $title = $this->input->post('title', true);
        $id = $this->input->post('id');
        $description = $this->input->post('description', true);
        $color = $this->input->post('color');
        $result = $this->events_model->updateEvent($id, $title, $description, $color);
        echo $result;
    } */

    /*Delete Event
    public function deleteEvent()
    {
        $result = $this->events_model->deleteEvent();
        echo $result;
    } */
    /*
    public function dragUpdateEvent()
    {

        $result = $this->events_model->dragUpdateEvent();
        echo $result;
    } */

    public function create_folder(){
        // Create a new file/folder
        if (isset($_POST['newfilename'], $_POST['newfile'], $_POST['token']) && !FM_READONLY) {
            $type = urldecode($_POST['newfile']);
            $new = str_replace( '/', '', fm_clean_path( strip_tags( $_POST['newfilename'] ) ) );
            if (fm_isvalid_filename($new) && $new != '' && $new != '..' && $new != '.' && verifyToken($_POST['token'])) {
                $path = FM_ROOT_PATH;
                if (FM_PATH != '') {
                    $path .= '/' . FM_PATH;
                }
                if ($type == "file") {
                    if (!file_exists($path . '/' . $new)) {
                        if(fm_is_valid_ext($new)) {
                            @fopen($path . '/' . $new, 'w') or die('Cannot open file:  ' . $new);
                            fm_set_msg(sprintf(lng('File').' <b>%s</b> '.lng('Created'), fm_enc($new)));
                        } else {
                            fm_set_msg(lng('File extension is not allowed'), 'error');
                        }
                    } else {
                        fm_set_msg(sprintf(lng('File').' <b>%s</b> '.lng('already exists'), fm_enc($new)), 'alert');
                    }
                } else {
                    if (fm_mkdir($path . '/' . $new, false) === true) {
                        fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('Created'), $new));
                    } elseif (fm_mkdir($path . '/' . $new, false) === $path . '/' . $new) {
                        fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('already exists'), fm_enc($new)), 'alert');
                    } else {
                        fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('not created'), fm_enc($new)), 'error');
                    }
                }
            } else {
                fm_set_msg(lng('Invalid characters in file or folder name'), 'error');
            }
            $FM_PATH=FM_PATH; fm_redirect(FM_SELF_URL . '?p=' . urlencode($FM_PATH));
        }
    }

}


    /**
     * It prints the css/js files into html
     * @param key The key of the external file to print.
     * @return The value of the key in the  array.
     */
    function print_external($key)
    {
        global $external;

        if (!array_key_exists($key, $external)) {
            // throw new Exception('Key missing in external: ' . key);
            echo "<!-- EXTERNAL: MISSING KEY $key -->";
            return;
        }

        echo "$external[$key]";
    }

    /**
     * Verify CSRF TOKEN and remove after cerify
     * @param string $token
     * @return bool
     */
    function verifyToken($token)
    {
        if (hash_equals($_SESSION['token'], $token)) {
            return true;
        }
        return false;
    }

    /**
     * Delete  file or folder (recursively)
     * @param string $path
     * @return bool
     */
    function fm_rdelete($path)
    {
        if (is_link($path)) {
            return unlink($path);
        } elseif (is_dir($path)) {
            $objects = scandir($path);
            $ok = true;
            if (is_array($objects)) {
                foreach ($objects as $file) {
                    if ($file != '.' && $file != '..') {
                        if (!fm_rdelete($path . '/' . $file)) {
                            $ok = false;
                        }
                    }
                }
            }
            return ($ok) ? rmdir($path) : false;
        } elseif (is_file($path)) {
            return unlink($path);
        }
        return false;
    }

    /**
     * Recursive chmod
     * @param string $path
     * @param int $filemode
     * @param int $dirmode
     * @return bool
     * @todo Will use in mass chmod
     */
    function fm_rchmod($path, $filemode, $dirmode)
    {
        if (is_dir($path)) {
            if (!chmod($path, $dirmode)) {
                return false;
            }
            $objects = scandir($path);
            if (is_array($objects)) {
                foreach ($objects as $file) {
                    if ($file != '.' && $file != '..') {
                        if (!fm_rchmod($path . '/' . $file, $filemode, $dirmode)) {
                            return false;
                        }
                    }
                }
            }
            return true;
        } elseif (is_link($path)) {
            return true;
        } elseif (is_file($path)) {
            return chmod($path, $filemode);
        }
        return false;
    }

    /**
     * Check the file extension which is allowed or not
     * @param string $filename
     * @return bool
     */
    function fm_is_valid_ext($filename)
    {
        $allowed = (FM_FILE_EXTENSION) ? explode(',', FM_FILE_EXTENSION) : false;

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $isFileAllowed = ($allowed) ? in_array($ext, $allowed) : true;

        return ($isFileAllowed) ? true : false;
    }

    /**
     * Safely rename
     * @param string $old
     * @param string $new
     * @return bool|null
     */
    function fm_rename($old, $new)
    {
        $isFileAllowed = fm_is_valid_ext($new);

        if (!is_dir($old)) {
            if (!$isFileAllowed)
                return false;
        }

        return (!file_exists($new) && file_exists($old)) ? rename($old, $new) : null;
    }

    /**
     * Copy file or folder (recursively).
     * @param string $path
     * @param string $dest
     * @param bool $upd Update files
     * @param bool $force Create folder with same names instead file
     * @return bool
     */
    function fm_rcopy($path, $dest, $upd = true, $force = true)
    {
        if (is_dir($path)) {
            if (!fm_mkdir($dest, $force)) {
                return false;
            }
            $objects = scandir($path);
            $ok = true;
            if (is_array($objects)) {
                foreach ($objects as $file) {
                    if ($file != '.' && $file != '..') {
                        if (!fm_rcopy($path . '/' . $file, $dest . '/' . $file)) {
                            $ok = false;
                        }
                    }
                }
            }
            return $ok;
        } elseif (is_file($path)) {
            return fm_copy($path, $dest, $upd);
        }
        return false;
    }

    /**
     * Safely create folder
     * @param string $dir
     * @param bool $force
     * @return bool
     */
    function fm_mkdir($dir, $force)
    {
        if (file_exists($dir)) {
            if (is_dir($dir)) {
                return $dir;
            } elseif (!$force) {
                return false;
            }
            unlink($dir);
        }
        return mkdir($dir, 0777, true);
    }


    /**
     * Safely copy file
     * @param string $f1
     * @param string $f2
     * @param bool $upd Indicates if file should be updated with new content
     * @return bool
     */
    function fm_copy($f1, $f2, $upd)
    {
        $time1 = filemtime($f1);
        if (file_exists($f2)) {
            $time2 = filemtime($f2);
            if ($time2 >= $time1 && $upd) {
                return false;
            }
        }
        $ok = copy($f1, $f2);
        if ($ok) {
            touch($f2, $time1);
        }
        return $ok;
    }

    /**
     * Get mime type
     * @param string $file_path
     * @return mixed|string
     */
    function fm_get_mime_type($file_path)
    {
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file_path);
            finfo_close($finfo);
            return $mime;
        } elseif (function_exists('mime_content_type')) {
            return mime_content_type($file_path);
        } elseif (!stristr(ini_get('disable_functions'), 'shell_exec')) {
            $file = escapeshellarg($file_path);
            $mime = shell_exec('file -bi ' . $file);
            return $mime;
        } else {
            return '--';
        }
    }



    function fm_get_display_path($file_path)
    {
        global $path_display_mode, $root_path, $root_url;
        switch ($path_display_mode) {
            case 'relative':
                return array(
                    'label' => 'Path',
                    'path' => fm_enc(fm_convert_win(str_replace($root_path, '', $file_path)))
                );
            case 'host':
                $relative_path = str_replace($root_path, '', $file_path);
                return array(
                    'label' => 'Host Path',
                    'path' => fm_enc(fm_convert_win('/' . $root_url . '/' . ltrim(str_replace('\\', '/', $relative_path), '/')))
                );
            case 'full':
            default:
                return array(
                    'label' => 'Full Path',
                    'path' => fm_enc(fm_convert_win($file_path))
                );
        }
    }

    /**
     * @param string $file
     * Recover all file sizes larger than > 2GB.
     * Works on php 32bits and 64bits and supports linux
     * @return int|string
     */
    function fm_get_size($file)
    {
        static $iswin;
        static $isdarwin;
        if (!isset($iswin)) {
            $iswin = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
        }
        if (!isset($isdarwin)) {
            $isdarwin = (strtoupper(substr(PHP_OS, 0)) == "DARWIN");
        }

        static $exec_works;
        if (!isset($exec_works)) {
            $exec_works = (function_exists('exec') && !ini_get('safe_mode') && @exec('echo EXEC') == 'EXEC');
        }

        // try a shell command
        if ($exec_works) {
            $arg = escapeshellarg($file);
            $cmd = ($iswin) ? "for %F in (\"$file\") do @echo %~zF" : ($isdarwin ? "stat -f%z $arg" : "stat -c%s $arg");
            @exec($cmd, $output);
            if (is_array($output) && ctype_digit($size = trim(implode("\n", $output)))) {
                return $size;
            }
        }

        // try the Windows COM interface
        if ($iswin && class_exists("COM")) {
            try {
                $fsobj = new COM('Scripting.FileSystemObject');
                $f = $fsobj->GetFile(realpath($file));
                $size = $f->Size;
            } catch (Exception $e) {
                $size = null;
            }
            if (ctype_digit($size)) {
                return $size;
            }
        }

        // if all else fails
        return filesize($file);
    }

    /**
     * Get nice filesize
     * @param int $size
     * @return string
     */
    function fm_get_filesize($size)
    {
        $size = (float) $size;
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = ($size > 0) ? floor(log($size, 1024)) : 0;
        $power = ($power > (count($units) - 1)) ? (count($units) - 1) : $power;
        return sprintf('%s %s', round($size / pow(1024, $power), 2), $units[$power]);
    }

    /**
     * Get total size of directory tree.
     *
     * @param  string $directory Relative or absolute directory name.
     * @return int Total number of bytes.
     */
    function fm_get_directorysize($directory)
    {
        $bytes = 0;
        $directory = realpath($directory);
        if ($directory !== false && $directory != '' && file_exists($directory)) {
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS)) as $file) {
                $bytes += $file->getSize();
            }
        }
        return $bytes;
    }

    /**
     * Get info about zip archive
     * @param string $path
     * @return array|bool
     */
    function fm_get_zif_info($path, $ext)
    {
        if ($ext == 'zip' && function_exists('zip_open')) {
            $arch = @zip_open($path);
            if ($arch) {
                $filenames = array();
                while ($zip_entry = @zip_read($arch)) {
                    $zip_name = @zip_entry_name($zip_entry);
                    $zip_folder = substr($zip_name, -1) == '/';
                    $filenames[] = array(
                        'name' => $zip_name,
                        'filesize' => @zip_entry_filesize($zip_entry),
                        'compressed_size' => @zip_entry_compressedsize($zip_entry),
                        'folder' => $zip_folder
                        //'compression_method' => zip_entry_compressionmethod($zip_entry),
                    );
                }
                @zip_close($arch);
                return $filenames;
            }
        } elseif ($ext == 'tar' && class_exists('PharData')) {
            $archive = new PharData($path);
            $filenames = array();
            foreach (new RecursiveIteratorIterator($archive) as $file) {
                $parent_info = $file->getPathInfo();
                $zip_name = str_replace("phar://" . $path, '', $file->getPathName());
                $zip_name = substr($zip_name, ($pos = strpos($zip_name, '/')) !== false ? $pos + 1 : 0);
                $zip_folder = $parent_info->getFileName();
                $zip_info = new SplFileInfo($file);
                $filenames[] = array(
                    'name' => $zip_name,
                    'filesize' => $zip_info->getSize(),
                    'compressed_size' => $file->getCompressedSize(),
                    'folder' => $zip_folder
                );
            }
            return $filenames;
        }
        return false;
    }


    /**
     * Prevent XSS attacks
     * @param string $text
     * @return string
     */
    function fm_isvalid_filename($text)
    {
        return (strpbrk($text, '/?%*:|"<>') === FALSE) ? true : false;
    }

    /**
     * Save message in session
     * @param string $msg
     * @param string $status
     */
    function fm_set_msg($msg, $status = 'ok')
    {
        $_SESSION[FM_SESSION_ID]['message'] = $msg;
        $_SESSION[FM_SESSION_ID]['status'] = $status;
    }

    /**
     * Check if string is in UTF-8
     * @param string $string
     * @return int
     */
    function fm_is_utf8($string)
    {
        return preg_match('//u', $string);
    }

    /**
     * Get CSS classname for file
     * @param string $path
     * @return string
     */
    function fm_get_file_icon_class($path)
    {
        // get extension
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        switch ($ext) {
            case 'ico':
            case 'gif':
            case 'jpg':
            case 'jpeg':
            case 'jpc':
            case 'jp2':
            case 'jpx':
            case 'xbm':
            case 'wbmp':
            case 'png':
            case 'bmp':
            case 'tif':
            case 'tiff':
            case 'webp':
            case 'avif':
            case 'svg':
                $img = 'fa fa-picture-o';
                break;
            case 'passwd':
            case 'ftpquota':
            case 'sql':
            case 'js':
            case 'ts':
            case 'jsx':
            case 'tsx':
            case 'hbs':
            case 'json':
            case 'sh':
            case 'config':
            case 'twig':
            case 'tpl':
            case 'md':
            case 'gitignore':
            case 'c':
            case 'cpp':
            case 'cs':
            case 'py':
            case 'rs':
            case 'map':
            case 'lock':
            case 'dtd':
                $img = 'fa fa-file-code-o';
                break;
            case 'txt':
            case 'ini':
            case 'conf':
            case 'log':
            case 'htaccess':
            case 'yaml':
            case 'yml':
            case 'toml':
            case 'tmp':
            case 'top':
            case 'bot':
            case 'dat':
            case 'bak':
            case 'htpasswd':
            case 'pl':
                $img = 'fa fa-file-text-o';
                break;
            case 'css':
            case 'less':
            case 'sass':
            case 'scss':
                $img = 'fa fa-css3';
                break;
            case 'bz2':
            case 'zip':
            case 'rar':
            case 'gz':
            case 'tar':
            case '7z':
            case 'xz':
                $img = 'fa fa-file-archive-o';
                break;
            case 'php':
            case 'php4':
            case 'php5':
            case 'phps':
            case 'phtml':
                $img = 'fa fa-code';
                break;
            case 'htm':
            case 'html':
            case 'shtml':
            case 'xhtml':
                $img = 'fa fa-html5';
                break;
            case 'xml':
            case 'xsl':
                $img = 'fa fa-file-excel-o';
                break;
            case 'wav':
            case 'mp3':
            case 'mp2':
            case 'm4a':
            case 'aac':
            case 'ogg':
            case 'oga':
            case 'wma':
            case 'mka':
            case 'flac':
            case 'ac3':
            case 'tds':
                $img = 'fa fa-music';
                break;
            case 'm3u':
            case 'm3u8':
            case 'pls':
            case 'cue':
            case 'xspf':
                $img = 'fa fa-headphones';
                break;
            case 'avi':
            case 'mpg':
            case 'mpeg':
            case 'mp4':
            case 'm4v':
            case 'flv':
            case 'f4v':
            case 'ogm':
            case 'ogv':
            case 'mov':
            case 'mkv':
            case '3gp':
            case 'asf':
            case 'wmv':
            case 'webm':
                $img = 'fa fa-file-video-o';
                break;
            case 'eml':
            case 'msg':
                $img = 'fa fa-envelope-o';
                break;
            case 'xls':
            case 'xlsx':
            case 'ods':
                $img = 'fa fa-file-excel-o';
                break;
            case 'csv':
                $img = 'fa fa-file-text-o';
                break;
            case 'bak':
            case 'swp':
                $img = 'fa fa-clipboard';
                break;
            case 'doc':
            case 'docx':
            case 'odt':
                $img = 'fa fa-file-word-o';
                break;
            case 'ppt':
            case 'pptx':
                $img = 'fa fa-file-powerpoint-o';
                break;
            case 'ttf':
            case 'ttc':
            case 'otf':
            case 'woff':
            case 'woff2':
            case 'eot':
            case 'fon':
                $img = 'fa fa-font';
                break;
            case 'pdf':
                $img = 'fa fa-file-pdf-o';
                break;
            case 'psd':
            case 'ai':
            case 'eps':
            case 'fla':
            case 'swf':
                $img = 'fa fa-file-image-o';
                break;
            case 'exe':
            case 'msi':
                $img = 'fa fa-file-o';
                break;
            case 'bat':
                $img = 'fa fa-terminal';
                break;
            default:
                $img = 'fa fa-info-circle';
        }

        return $img;
    }

    /**
     * Get image files extensions
     * @return array
     */
    function fm_get_image_exts()
    {
        return array('ico', 'gif', 'jpg', 'jpeg', 'jpc', 'jp2', 'jpx', 'xbm', 'wbmp', 'png', 'bmp', 'tif', 'tiff', 'psd', 'svg', 'webp', 'avif');
    }

    /**
     * Get video files extensions
     * @return array
     */
    function fm_get_video_exts()
    {
        return array('avi', 'webm', 'wmv', 'mp4', 'm4v', 'ogm', 'ogv', 'mov', 'mkv');
    }

    /**
     * Get audio files extensions
     * @return array
     */
    function fm_get_audio_exts()
    {
        return array('wav', 'mp3', 'ogg', 'm4a');
    }

    /**
     * Get text file extensions
     * @return array
     */
    function fm_get_text_exts()
    {
        return array(
            'txt',
            'css',
            'ini',
            'conf',
            'log',
            'htaccess',
            'passwd',
            'ftpquota',
            'sql',
            'js',
            'ts',
            'jsx',
            'tsx',
            'mjs',
            'json',
            'sh',
            'config',
            'php',
            'php4',
            'php5',
            'phps',
            'phtml',
            'htm',
            'html',
            'shtml',
            'xhtml',
            'xml',
            'xsl',
            'm3u',
            'm3u8',
            'pls',
            'cue',
            'bash',
            'vue',
            'eml',
            'msg',
            'csv',
            'bat',
            'twig',
            'tpl',
            'md',
            'gitignore',
            'less',
            'sass',
            'scss',
            'c',
            'cpp',
            'cs',
            'py',
            'go',
            'zsh',
            'swift',
            'map',
            'lock',
            'dtd',
            'svg',
            'asp',
            'aspx',
            'asx',
            'asmx',
            'ashx',
            'jsp',
            'jspx',
            'cgi',
            'dockerfile',
            'ruby',
            'yml',
            'yaml',
            'toml',
            'vhost',
            'scpt',
            'applescript',
            'csx',
            'cshtml',
            'c++',
            'coffee',
            'cfm',
            'rb',
            'graphql',
            'mustache',
            'jinja',
            'http',
            'handlebars',
            'java',
            'es',
            'es6',
            'markdown',
            'wiki',
            'tmp',
            'top',
            'bot',
            'dat',
            'bak',
            'htpasswd',
            'pl'
        );
    }

    /**
     * Get mime types of text files
     * @return array
     */
    function fm_get_text_mimes()
    {
        return array(
            'application/xml',
            'application/javascript',
            'application/x-javascript',
            'image/svg+xml',
            'message/rfc822',
            'application/json',
        );
    }

    /**
     * Get file names of text files w/o extensions
     * @return array
     */
    function fm_get_text_names()
    {
        return array(
            'license',
            'readme',
            'authors',
            'contributors',
            'changelog',
        );
    }

    /**
     * Get online docs viewer supported files extensions
     * @return array
     */
    function fm_get_onlineViewer_exts()
    {
        return array('doc', 'docx', 'xls', 'xlsx', 'pdf', 'ppt', 'pptx', 'ai', 'psd', 'dxf', 'xps', 'rar', 'odt', 'ods');
    }

    /**
     * It returns the mime type of a file based on its extension.
     * @param extension The file extension of the file you want to get the mime type for.
     * @return string|string[] The mime type of the file.
     */
    function fm_get_file_mimes($extension)
    {
        $fileTypes['swf'] = 'application/x-shockwave-flash';
        $fileTypes['pdf'] = 'application/pdf';
        $fileTypes['exe'] = 'application/octet-stream';
        $fileTypes['zip'] = 'application/zip';
        $fileTypes['doc'] = 'application/msword';
        $fileTypes['xls'] = 'application/vnd.ms-excel';
        $fileTypes['ppt'] = 'application/vnd.ms-powerpoint';
        $fileTypes['gif'] = 'image/gif';
        $fileTypes['png'] = 'image/png';
        $fileTypes['jpeg'] = 'image/jpg';
        $fileTypes['jpg'] = 'image/jpg';
        $fileTypes['webp'] = 'image/webp';
        $fileTypes['avif'] = 'image/avif';
        $fileTypes['rar'] = 'application/rar';

        $fileTypes['ra'] = 'audio/x-pn-realaudio';
        $fileTypes['ram'] = 'audio/x-pn-realaudio';
        $fileTypes['ogg'] = 'audio/x-pn-realaudio';

        $fileTypes['wav'] = 'video/x-msvideo';
        $fileTypes['wmv'] = 'video/x-msvideo';
        $fileTypes['avi'] = 'video/x-msvideo';
        $fileTypes['asf'] = 'video/x-msvideo';
        $fileTypes['divx'] = 'video/x-msvideo';

        $fileTypes['mp3'] = 'audio/mpeg';
        $fileTypes['mp4'] = 'audio/mpeg';
        $fileTypes['mpeg'] = 'video/mpeg';
        $fileTypes['mpg'] = 'video/mpeg';
        $fileTypes['mpe'] = 'video/mpeg';
        $fileTypes['mov'] = 'video/quicktime';
        $fileTypes['swf'] = 'video/quicktime';
        $fileTypes['3gp'] = 'video/quicktime';
        $fileTypes['m4a'] = 'video/quicktime';
        $fileTypes['aac'] = 'video/quicktime';
        $fileTypes['m3u'] = 'video/quicktime';

        $fileTypes['php'] = ['application/x-php'];
        $fileTypes['html'] = ['text/html'];
        $fileTypes['txt'] = ['text/plain'];
        //Unknown mime-types should be 'application/octet-stream'
        if (empty($fileTypes[$extension])) {
            $fileTypes[$extension] = ['application/octet-stream'];
        }
        return $fileTypes[$extension];
    }

    /**
     * This function scans the files and folder recursively, and return matching files
     * @param string $dir
     * @param string $filter
     * @return array|null
     */
    function scan($dir = '', $filter = '')
    {
        $path = FM_ROOT_PATH . '/' . $dir;
        if ($path) {
            $ite = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
            $rii = new RegexIterator($ite, "/(" . $filter . ")/i");

            $files = array();
            foreach ($rii as $file) {
                if (!$file->isDir()) {
                    $fileName = $file->getFilename();
                    $location = str_replace(FM_ROOT_PATH, '', $file->getPath());
                    $files[] = array(
                        "name" => $fileName,
                        "type" => "file",
                        "path" => $location,
                    );
                }
            }
            return $files;
        }
    }

    /**
     * Parameters: downloadFile(File Location, File Name,
     * max speed, is streaming
     * If streaming - videos will show as videos, images as images
     * instead of download prompt
     * https://stackoverflow.com/a/13821992/1164642
     */
    function fm_download_file($fileLocation, $fileName, $chunkSize = 1024)
    {
        if (connection_status() != 0)
            return (false);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $contentType = fm_get_file_mimes($extension);

        if (is_array($contentType)) {
            $contentType = implode(' ', $contentType);
        }

        $size = filesize($fileLocation);

        if ($size == 0) {
            fm_set_msg(lng('Zero byte file! Aborting download'), 'error');
            $FM_PATH = FM_PATH;
            fm_redirect(FM_SELF_URL . '?p=' . urlencode($FM_PATH));

            return (false);
        }

        @ini_set('magic_quotes_runtime', 0);
        $fp = fopen("$fileLocation", "rb");

        if ($fp === false) {
            fm_set_msg(lng('Cannot open file! Aborting download'), 'error');
            $FM_PATH = FM_PATH;
            fm_redirect(FM_SELF_URL . '?p=' . urlencode($FM_PATH));
            return (false);
        }

        // headers
        header('Content-Description: File Transfer');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header("Content-Transfer-Encoding: binary");
        header("Content-Type: $contentType");

        $contentDisposition = 'attachment';

        if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
            $fileName = preg_replace('/\./', '%2e', $fileName, substr_count($fileName, '.') - 1);
            header("Content-Disposition: $contentDisposition;filename=\"$fileName\"");
        } else {
            header("Content-Disposition: $contentDisposition;filename=\"$fileName\"");
        }

        header("Accept-Ranges: bytes");
        $range = 0;

        if (isset($_SERVER['HTTP_RANGE'])) {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
            str_replace($range, "-", $range);
            $size2 = $size - 1;
            $new_length = $size - $range;
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length");
            header("Content-Range: bytes $range$size2/$size");
        } else {
            $size2 = $size - 1;
            header("Content-Range: bytes 0-$size2/$size");
            header("Content-Length: " . $size);
        }
        $fileLocation = realpath($fileLocation);
        while (ob_get_level())
            ob_end_clean();
        readfile($fileLocation);

        fclose($fp);

        return ((connection_status() == 0) and !connection_aborted());
    }
    /**
     * Clean path
     * @param string $path
     * @return string
     */
    function fm_clean_path($path, $trim = true)
    {
        $path = $trim ? trim($path) : $path;
        $path = trim($path, '\\/');
        $path = str_replace(array('../', '..\\'), '', $path);
        $path = get_absolute_path($path);
        if ($path == '..') {
            $path = '';
        }
        return str_replace('\\', '/', $path);
    }


    /**
     * HTTP Redirect
     * @param string $url
     * @param int $code
     */
    function fm_redirect($url, $code = 302)
    {
        header('Location: ' . $url, true, $code);
        exit;
    }

    /**
     * Check file is in exclude list
     * @param string $file
     * @return bool
     */
    function fm_is_exclude_items($file)
    {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (isset($exclude_items) and sizeof($exclude_items)) {
            unset($exclude_items);
        }

        $exclude_items = FM_EXCLUDE_ITEMS;
        if (version_compare(PHP_VERSION, '7.0.0', '<')) {
            $exclude_items = unserialize($exclude_items);
        }
        if (!in_array($file, $exclude_items) && !in_array("*.$ext", $exclude_items)) {
            return true;
        }
        return false;
    }


    /**
     * Path traversal prevention and clean the url
     * It replaces (consecutive) occurrences of / and \\ with whatever is in DIRECTORY_SEPARATOR, and processes /. and /.. fine.
     * @param $path
     * @return string
     */
    function get_absolute_path($path)
    {
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part)
                continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        return implode(DIRECTORY_SEPARATOR, $absolutes);
    }

    /**
     * Show alert message from session
     */
    function fm_show_message()
    {
        if (isset($_SESSION[FM_SESSION_ID]['message'])) {
            $class = isset($_SESSION[FM_SESSION_ID]['status']) ? $_SESSION[FM_SESSION_ID]['status'] : 'ok';
            $message= '<p class="message ' . $class . '">' . $_SESSION[FM_SESSION_ID]['message'] . '</p>';
            unset($_SESSION[FM_SESSION_ID]['message']);
            unset($_SESSION[FM_SESSION_ID]['status']);
            return $message;
        }
    }



    /**
     * Get parent path
     * @param string $path
     * @return bool|string
     */
    function fm_get_parent_path($path)
    {
        $path = fm_clean_path($path);
        if ($path != '') {
            $array = explode('/', $path);
            if (count($array) > 1) {
                $array = array_slice($array, 0, -1);
                return implode('/', $array);
            }
            return '';
        }
        return false;
    }

    /**
     * @param $obj
     * @return array
     */
    function fm_object_to_array($obj)
    {
        if (!is_object($obj) && !is_array($obj)) {
            return $obj;
        }
        if (is_object($obj)) {
            $obj = get_object_vars($obj);
        }
        return array_map('fm_object_to_array', $obj);
    }

    /**
     * Language Translation System
     * @param string $txt
     * @return string
     */
    function lng($txt) {
        global $lang;

        // English Language
        $tr['en']['AppName']        = 'Tiny File Manager';      $tr['en']['AppTitle']           = 'File Manager';
        $tr['en']['Login']          = 'Sign in';                $tr['en']['Username']           = 'Username';
        $tr['en']['Password']       = 'Password';               $tr['en']['Logout']             = 'Sign Out';
        $tr['en']['Move']           = 'Move';                   $tr['en']['Copy']               = 'Copy';
        $tr['en']['Save']           = 'Save';                   $tr['en']['SelectAll']          = 'Select all';
        $tr['en']['UnSelectAll']    = 'Unselect all';           $tr['en']['File']               = 'File';
        $tr['en']['Back']           = 'Back';                   $tr['en']['Size']               = 'Size';
        $tr['en']['Perms']          = 'Perms';                  $tr['en']['Modified']           = 'Modified';
        $tr['en']['Owner']          = 'Owner';                  $tr['en']['Search']             = 'Search';
        $tr['en']['NewItem']        = 'New Item';               $tr['en']['Folder']             = 'Folder';
        $tr['en']['Delete']         = 'Delete';                 $tr['en']['Rename']             = 'Rename';
        $tr['en']['CopyTo']         = 'Copy to';                $tr['en']['DirectLink']         = 'Direct link';
        $tr['en']['UploadingFiles'] = 'Upload Files';           $tr['en']['ChangePermissions']  = 'Change Permissions';
        $tr['en']['Copying']        = 'Copying';                $tr['en']['CreateNewItem']      = 'Create New Item';
        $tr['en']['Name']           = 'Name';                   $tr['en']['AdvancedEditor']     = 'Advanced Editor';
        $tr['en']['Actions']        = 'Actions';                $tr['en']['Folder is empty']    = 'Folder is empty';
        $tr['en']['Upload']         = 'Upload';                 $tr['en']['Cancel']             = 'Cancel';
        $tr['en']['InvertSelection']= 'Invert Selection';       $tr['en']['DestinationFolder']  = 'Destination Folder';
        $tr['en']['ItemType']       = 'Item Type';              $tr['en']['ItemName']           = 'Item Name';
        $tr['en']['CreateNow']      = 'Create Now';             $tr['en']['Download']           = 'Download';
        $tr['en']['Open']           = 'Open';                   $tr['en']['UnZip']              = 'UnZip';
        $tr['en']['UnZipToFolder']  = 'UnZip to folder';        $tr['en']['Edit']               = 'Edit';
        $tr['en']['NormalEditor']   = 'Normal Editor';          $tr['en']['BackUp']             = 'Back Up';
        $tr['en']['SourceFolder']   = 'Source Folder';          $tr['en']['Files']              = 'Files';
        $tr['en']['Move']           = 'Move';                   $tr['en']['Change']             = 'Change';
        $tr['en']['Settings']       = 'Settings';               $tr['en']['Language']           = 'Language';
        $tr['en']['ErrorReporting'] = 'Error Reporting';        $tr['en']['ShowHiddenFiles']    = 'Show Hidden Files';
        $tr['en']['Help']           = 'Help';                   $tr['en']['Created']            = 'Created';
        $tr['en']['Help Documents'] = 'Help Documents';         $tr['en']['Report Issue']       = 'Report Issue';
        $tr['en']['Generate']       = 'Generate';               $tr['en']['FullSize']           = 'Full Size';
        $tr['en']['HideColumns']    = 'Hide Perms/Owner columns';$tr['en']['You are logged in'] = 'You are logged in';
        $tr['en']['Nothing selected']   = 'Nothing selected';   $tr['en']['Paths must be not equal']    = 'Paths must be not equal';
        $tr['en']['Renamed from']       = 'Renamed from';       $tr['en']['Archive not unpacked']       = 'Archive not unpacked';
        $tr['en']['Deleted']            = 'Deleted';            $tr['en']['Archive not created']        = 'Archive not created';
        $tr['en']['Copied from']        = 'Copied from';        $tr['en']['Permissions changed']        = 'Permissions changed';
        $tr['en']['to']                 = 'to';                 $tr['en']['Saved Successfully']         = 'Saved Successfully';
        $tr['en']['not found!']         = 'not found!';         $tr['en']['File Saved Successfully']    = 'File Saved Successfully';
        $tr['en']['Archive']            = 'Archive';            $tr['en']['Permissions not changed']    = 'Permissions not changed';
        $tr['en']['Select folder']      = 'Select folder';      $tr['en']['Source path not defined']    = 'Source path not defined';
        $tr['en']['already exists']     = 'already exists';     $tr['en']['Error while moving from']    = 'Error while moving from';
        $tr['en']['Create archive?']    = 'Create archive?';    $tr['en']['Invalid file or folder name']    = 'Invalid file or folder name';
        $tr['en']['Archive unpacked']   = 'Archive unpacked';   $tr['en']['File extension is not allowed']  = 'File extension is not allowed';
        $tr['en']['Root path']          = 'Root path';          $tr['en']['Error while renaming from']  = 'Error while renaming from';
        $tr['en']['File not found']     = 'File not found';     $tr['en']['Error while deleting items'] = 'Error while deleting items';
        $tr['en']['Moved from']         = 'Moved from';         $tr['en']['Generate new password hash'] = 'Generate new password hash';
        $tr['en']['Login failed. Invalid username or password'] = 'Login failed. Invalid username or password';
        $tr['en']['password_hash not supported, Upgrade PHP version'] = 'password_hash not supported, Upgrade PHP version';
        $tr['en']['Advanced Search']    = 'Advanced Search';    $tr['en']['Error while copying from']    = 'Error while copying from';
        $tr['en']['Invalid characters in file name']                = 'Invalid characters in file name';
        $tr['en']['FILE EXTENSION HAS NOT SUPPORTED']               = 'FILE EXTENSION HAS NOT SUPPORTED';
        $tr['en']['Selected files and folder deleted']              = 'Selected files and folder deleted';
        $tr['en']['Error while fetching archive info']              = 'Error while fetching archive info';
        $tr['en']['Delete selected files and folders?']             = 'Delete selected files and folders?';
        $tr['en']['Search file in folder and subfolders...']        = 'Search file in folder and subfolders...';
        $tr['en']['Access denied. IP restriction applicable']       = 'Access denied. IP restriction applicable';
        $tr['en']['Invalid characters in file or folder name']      = 'Invalid characters in file or folder name';
        $tr['en']['Operations with archives are not available']     = 'Operations with archives are not available';
        $tr['en']['File or folder with this path already exists']   = 'File or folder with this path already exists';

        $i18n = fm_get_translations($tr);
        $tr = $i18n ? $i18n : $tr;

        if (!strlen($lang)) $lang = 'en';
        if (isset($tr[$lang][$txt])) return fm_enc($tr[$lang][$txt]);
        else if (isset($tr['en'][$txt])) return fm_enc($tr['en'][$txt]);
        else return "$txt";
    }

    /**
     * get language translations from json file
     * @param int $tr
     * @return array
     */
    function fm_get_translations($tr)
    {
        try {
            $content = @file_get_contents('translation.json');
            if ($content !== FALSE) {
                $lng = json_decode($content, TRUE);
                global $lang_list;
                foreach ($lng["language"] as $key => $value) {
                    $code = $value["code"];
                    $lang_list[$code] = $value["name"];
                    if ($tr)
                        $tr[$code] = $value["translation"];
                }
                return $tr;
            }

        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * Encode html entities
     * @param string $text
     * @return string
     */
    function fm_enc($text)
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Convert file name to UTF-8 in Windows
     * @param string $filename
     * @return string
     */
    function fm_convert_win($filename)
    {
        if (FM_IS_WIN && function_exists('iconv')) {
            $filename = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $filename);
        }
        return $filename;
    }


/**
 * Class to work with zip files (using ZipArchive)
 */
class FM_Zipper
{
    private $zip;

    public function __construct()
    {
        $this->zip = new ZipArchive();
    }

    /**
     * Create archive with name $filename and files $files (RELATIVE PATHS!)
     * @param string $filename
     * @param array|string $files
     * @return bool
     */
    public function create($filename, $files)
    {
        $res = $this->zip->open($filename, ZipArchive::CREATE);
        if ($res !== true) {
            return false;
        }
        if (is_array($files)) {
            foreach ($files as $f) {
                $f = fm_clean_path($f);
                if (!$this->addFileOrDir($f)) {
                    $this->zip->close();
                    return false;
                }
            }
            $this->zip->close();
            return true;
        } else {
            if ($this->addFileOrDir($files)) {
                $this->zip->close();
                return true;
            }
            return false;
        }
    }

    /**
     * Extract archive $filename to folder $path (RELATIVE OR ABSOLUTE PATHS)
     * @param string $filename
     * @param string $path
     * @return bool
     */
    public function unzip($filename, $path)
    {
        $res = $this->zip->open($filename);
        if ($res !== true) {
            return false;
        }
        if ($this->zip->extractTo($path)) {
            $this->zip->close();
            return true;
        }
        return false;
    }

    /**
     * Add file/folder to archive
     * @param string $filename
     * @return bool
     */
    private function addFileOrDir($filename)
    {
        if (is_file($filename)) {
            return $this->zip->addFile($filename);
        } elseif (is_dir($filename)) {
            return $this->addDir($filename);
        }
        return false;
    }

    /**
     * Add folder recursively
     * @param string $path
     * @return bool
     */
    private function addDir($path)
    {
        if (!$this->zip->addEmptyDir($path)) {
            return false;
        }
        $objects = scandir($path);
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (is_dir($path . '/' . $file)) {
                        if (!$this->addDir($path . '/' . $file)) {
                            return false;
                        }
                    } elseif (is_file($path . '/' . $file)) {
                        if (!$this->zip->addFile($path . '/' . $file)) {
                            return false;
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
}

/**
 * Class to work with Tar files (using PharData)
 */
class FM_Zipper_Tar
{
    private $tar;

    public function __construct()
    {
        $this->tar = null;
    }

    /**
     * Create archive with name $filename and files $files (RELATIVE PATHS!)
     * @param string $filename
     * @param array|string $files
     * @return bool
     */
    public function create($filename, $files)
    {
        $this->tar = new PharData($filename);
        if (is_array($files)) {
            foreach ($files as $f) {
                $f = fm_clean_path($f);
                if (!$this->addFileOrDir($f)) {
                    return false;
                }
            }
            return true;
        } else {
            if ($this->addFileOrDir($files)) {
                return true;
            }
            return false;
        }
    }

    /**
     * Extract archive $filename to folder $path (RELATIVE OR ABSOLUTE PATHS)
     * @param string $filename
     * @param string $path
     * @return bool
     */
    public function unzip($filename, $path)
    {
        $res = $this->tar->open($filename);
        if ($res !== true) {
            return false;
        }
        if ($this->tar->extractTo($path)) {
            return true;
        }
        return false;
    }

    /**
     * Add file/folder to archive
     * @param string $filename
     * @return bool
     */
    private function addFileOrDir($filename)
    {
        if (is_file($filename)) {
            try {
                $this->tar->addFile($filename);
                return true;
            } catch (Exception $e) {
                return false;
            }
        } elseif (is_dir($filename)) {
            return $this->addDir($filename);
        }
        return false;
    }

    /**
     * Add folder recursively
     * @param string $path
     * @return bool
     */
    private function addDir($path)
    {
        $objects = scandir($path);
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (is_dir($path . '/' . $file)) {
                        if (!$this->addDir($path . '/' . $file)) {
                            return false;
                        }
                    } elseif (is_file($path . '/' . $file)) {
                        try {
                            $this->tar->addFile($path . '/' . $file);
                        } catch (Exception $e) {
                            return false;
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
}

/**
 * Save Configuration
 */
class FM_Config
{
    var $data;

    function __construct()
    {
        global $root_path, $root_url, $FMCONFIG;
        $fm_url = $root_url . $_SERVER["PHP_SELF"];
        $this->data = array(
            'lang' => 'en',
            'error_reporting' => true,
            'show_hidden' => true
        );
        $data = false;
        if (strlen($FMCONFIG)) {
            $data = fm_object_to_array(json_decode($FMCONFIG));
        } else {
            $msg = 'File Manager<br>Error: Cannot load configuration';
            if (substr($fm_url, -1) == '/') {
                $fm_url = rtrim($fm_url, '/');
                $msg .= '<br>';
                $msg .= '<br>Seems like you have a trailing slash on the URL.';
                $msg .= '<br>Try this link: <a href="' . $fm_url . '">' . $fm_url . '</a>';
            }
            die($msg);
        }
        if (is_array($data) && count($data))
            $this->data = $data;
        else
            $this->save();
    }

    function save()
    {
        $fm_file = __FILE__;
        $var_name = '$FMCONFIG';
        $var_value = var_export(json_encode($this->data), true);
        $config_string = "<?php" . chr(13) . chr(10) . "//Default Configuration" . chr(13) . chr(10) . "$var_name = $var_value;" . chr(13) . chr(10);
        if (is_writable($fm_file)) {
            $lines = file($fm_file);
            if ($fh = @fopen($fm_file, "w")) {
                @fputs($fh, $config_string, strlen($config_string));
                for ($x = 3; $x < count($lines); $x++) {
                    @fputs($fh, $lines[$x], strlen($lines[$x]));
                }
                @fclose($fh);
            }
        }
    }
}