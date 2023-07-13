<style>
  td.inline-actions a {
    display: inline-grid;
    padding: 5px 7px;
    font-size: 16px;
    margin: 2px;
}
 .custom-control-label::after {
    position: relative;
    }
  </style>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-content">
            <nav class="navbar navbar-expand-lg  navbar-light bg-white main-nav" style="">
                <a class="navbar-brand"> File Manager </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <div class="col-xs-6 col-sm-5"><a href="?p="><i class="fa fa-home fa-2x" aria-hidden="true" title="filemanager"></i></a></div>
                    <div class="col-xs-6 col-sm-7">
                        <ul class="navbar-nav justify-content-end " id="abId0.956465670702888">
                            <li class="nav-item mr-2" id="abId0.9620657677779927">
                                <div class="input-group input-group-sm mr-1" style="margin-top:4px;" id="abId0.5669879416559105" abineguid="9B5DAD22A98E459B8DECB72C3FA1DD39">
                                    <input type="text" class="form-control" placeholder="Filter" aria-label="Search" aria-describedby="search-addon2" id="search-addon">
                                    <div class="input-group-append">
                                        <span class="input-group-text brl-0 brr-0" id="search-addon2"><i class="fa fa-search"></i></span>
                                    </div>
                                    <div class="input-group-append btn-group">
                                        <span class="input-group-text dropdown-toggle brl-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                          <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="." id="js-search-modal" data-bs-toggle="modal" data-bs-target="#searchModal">Advanced Search</a>
                                          </div>
                                    </div>
                                </div>
                            </li>
                                                <li class="nav-item">
                                <a title="Upload" class="nav-link" href="?p=&amp;upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload</a>
                            </li>
                            <li class="nav-item">
                                <a title="New Item" class="nav-link" href="#createNewItem" data-bs-toggle="modal" data-bs-target="#createNewItem"><i class="fa fa-plus-square"></i> New Item</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <?php if(!empty($message)){ ?>
            <div class="card-body">
                <!-- Notification -->
                <div class="alert"><?php echo $message; ?></div>
            </div>
            <?php } ?>
            <div id='filemanager' class="card-body">
                    <?php echo $form; ?>
                </div>
        </div>
    </div>
</div>



    <div class="modal fade show" id="createNewItem" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="newItemModalLabel"><i class="fa fa-plus-square fa-fw"></i><?php echo lng('CreateNewItem') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><label for="newfile"><?php echo lng('ItemType') ?> </label></p>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="newfile" id="customRadioInline1" name="newfile" value="file">
                      <label class="form-check-label" for="customRadioInline1"><?php echo lng('File') ?></label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="newfile" id="customRadioInline2" value="folder" checked>
                      <label class="form-check-label" for="customRadioInline2"><?php echo lng('Folder') ?></label>
                    </div>

                    <p class="mt-3"><label for="newfilename"><?php echo lng('ItemName') ?> </label></p>
                    <input type="text" name="newfilename" id="newfilename" value="" class="form-control" placeholder="<?php echo lng('Enter here...') ?>" required>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel') ?></button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> <?php echo lng('CreateNow') ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Advance Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title col-10" id="searchModalLabel">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="<?php echo lng('Search') ?> <?php echo lng('a files') ?>" aria-label="<?php echo lng('Search') ?>" aria-describedby="search-addon3" id="advanced-search" autofocus required>
                  <span class="input-group-text" id="search-addon3"><i class="fa fa-search"></i></span>
                </div>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <div class="lds-facebook"><div></div><div></div><div></div></div>
                <ul id="search-wrapper">
                    <p class="m-2"><?php echo lng('Search file in folder and subfolders...') ?></p>
                </ul>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Confirm Modal -->
    <div type="text/html" id="js-tpl-confirm">
        <div class="modal modal-alert confirmDailog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
          <div class="modal-dialog " role="document">
            <form class="modal-content rounded-3 shadow" id="mform" method="get" autocomplete="off" action="">
              <div class="modal-body p-4 text-center">
                <h5 class="mb-2"><?php echo lng('Are you sure want to') ?> <span class="mtitle"></span> delete ?</h5>
                <p class="mb-1"><span class="mcontent"></span></p>
              </div>
              <div class="modal-footer flex-nowrap p-0">
                <button type="button" id="confirmNo" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal"><?php echo lng('Cancel') ?></button>
                <input type="hidden" name="p" id="folder" value="" >
                <input type="hidden" name="del" id="file" value="" >
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                <button type="submit" id="confirmYes" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal"><strong><?php echo lng('Okay') ?></strong></button>
              </div>
            </form>
          </div>
        </div>
    </div>
<script>
  $(document).ready(function () {
  $('.btn-danger').on('click', function(e) {
       e.preventDefault(); // Prevent the default link behavior
       $('.confirmDailog').modal('show');
       $('#mform').attr('action', $(this).attr('href'));
       $('#folder').attr('value', $(this).attr('fpath'));
       $('#file').attr('value', $(this).attr('ffile'));
       $('.mtitle').val($(this).attr('ffile'));
     //  p='..'&amp;del='.urlencode($f).'
      });

       $('#confirmNo').on('click', function() {
        $('.confirmDailog').modal('hide');
      });

});
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    function rename(e, t) {
      console.log(window.location.search);
      var n = prompt("New name", t);
      null !== n && "" !== n && n != t && (window.location.search = "p=" + encodeURIComponent(e) + "&ren=" + encodeURIComponent(t) + "&to=" + encodeURIComponent(n))
      }
    function change_checkboxes(e, t) {
      for (var n = e.length - 1; n >= 0; n--)
       e[n].checked = "boolean" == typeof t ? t : !e[n].checked
      }
    function get_checkboxes() { for (var e = document.getElementsByName("file[]"), t = [], n = e.length - 1; n >= 0; n--) (e[n].type = "checkbox") && t.push(e[n]); return t }
    function select_all() { change_checkboxes(get_checkboxes(), !0) }
    function unselect_all() { change_checkboxes(get_checkboxes(), !1) }
    function invert_all() { change_checkboxes(get_checkboxes()) }
    function checkbox_toggle() { var e = get_checkboxes(); e.push(this), change_checkboxes(e) }
    </script>
<?php /*
 Code for localization
<script src="<?= assets_url() ?>app-assets/vendors/js/fullcalendar/locale/es.js?v=<?= APPVER ?>"></script>
 */

