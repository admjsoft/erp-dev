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
    <div class="card">
        <div class="card-content">
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
    <!-- Confirm Modal -->
    <div type="text/html" id="js-tpl-confirm">
        <div class="modal modal-alert confirmDailog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
          <div class="modal-dialog " role="document">
            <form class="modal-content rounded-3 shadow" id="mform" method="get" autocomplete="off" action="">
              <div class="modal-body p-4 text-center">
                <h5 class="mb-2"><?php echo lng('Are you sure want to') ?>  <span class="mtitle">delete</span> ?</h5>
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

